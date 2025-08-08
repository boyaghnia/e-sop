<?php

namespace App\Exports;

use App\Models\Esop;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class EsopExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithEvents
{
    protected $type;

    public function __construct($type = 'all')
    {
        $this->type = $type;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $user = Auth::user();
        
        // Base query berdasarkan role
        $baseQuery = Esop::with('user');
        
        if ($user->role === 'admin') {
            // Admin dapat melihat semua ESOP
        } elseif ($user->role === 'sekretariat' || $user->role === 'direktorat' || $user->role === 'balai') {
            // Sekretariat dan Direktorat dapat melihat ESOP dari role 'obu', 'upbu' dan milik sendiri
            $baseQuery->where(function($q) use ($user) {
                $q->where('user_id', $user->id)
                  ->orWhereHas('user', function($userQuery) {
                      $userQuery->where('role', 'obu')->orWhere('role', 'upbu');
                  });
            });
        } elseif ($user->role === 'obu') {
            // OBU dapat melihat ESOP dari role 'upbu'
            $baseQuery->whereHas('user', function($userQuery) {
                $userQuery->where('role', 'upbu');
            });
        } else {
            // Role lain (termasuk upbu) hanya melihat ESOP milik sendiri
            $baseQuery->where('user_id', $user->id);
        }

        // Filter berdasarkan type
        switch ($this->type) {
            case 'disahkan':
                $baseQuery->whereNotNull('file_path')
                         ->whereNotNull('file_name')
                         ->where('file_path', '!=', '')
                         ->where('file_name', '!=', '');
                break;
            case 'draft':
                $baseQuery->where(function($q) {
                    $q->whereNull('file_path')
                      ->orWhereNull('file_name')
                      ->orWhere('file_path', '')
                      ->orWhere('file_name', '');
                });
                break;
            default:
                // 'all' - tidak ada filter tambahan
                break;
        }

        // Urutkan berdasarkan role hierarchy dan tanggal
        return $baseQuery->leftJoin('users', 'esops.user_id', '=', 'users.id')
                        ->orderByRaw("CASE users.role 
                            WHEN 'sekretariat' THEN 1
                            WHEN 'direktorat' THEN 2
                            WHEN 'balai' THEN 3
                            WHEN 'obu' THEN 4
                            WHEN 'upbu' THEN 5
                            ELSE 6
                        END")
                        ->orderBy('esops.created_at', 'desc')
                        ->select('esops.*')
                        ->get();
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            'No',
            'Role',
            'Unit Organisasi',
            'Nama SOP',
            'Tanggal Pembuatan',
            'Status'
        ];
    }

    /**
    * @param mixed $esop
    */
    public function map($esop): array
    {
        static $no = 1;
        
        // Format role dengan kapitalisasi yang sesuai
        $role = $esop->user->role ?? '-';
        $formattedRole = $this->formatRole($role);
        
        return [
            $no++,
            $formattedRole,
            $esop->user->name ?? '-',
            $esop->nama_sop,
            $esop->created_at->format('d/m/Y'),
            ($esop->file_path && $esop->file_name) ? 'Disahkan' : 'Draft'
        ];
    }

    /**
     * Format role sesuai dengan ketentuan kapitalisasi
     */
    private function formatRole($role): string
    {
        switch (strtolower($role)) {
            case 'admin':
                return '-'; // Admin tidak perlu ditampilkan
            case 'sekretariat':
                return 'Sekretariat';
            case 'direktorat':
                return 'Direktorat';
            case 'balai':
                return 'Balai';
            case 'obu':
                return 'OBU';
            case 'upbu':
                return 'UPBU';
            default:
                return ucfirst($role);
        }
    }

    /**
    * @param Worksheet $sheet
    */
    public function styles(Worksheet $sheet)
    {
        // Auto-size all columns
        foreach(range('A','F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        
        return [
            // Style the first row as bold text with background color
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => 'solid', 'color' => ['rgb' => '4F46E5']]
            ],
            
            // Set minimum column widths
            'A' => ['width' => 5],   // No
            'B' => ['width' => 15],  // Role
            'C' => ['width' => 25],  // Unit Organisasi
            'D' => ['width' => 35],  // Nama SOP
            'E' => ['width' => 15],  // Tanggal Pembuatan
            'F' => ['width' => 12],  // Status
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Ambil jumlah kolom secara otomatis
                $lastColumn = $sheet->getHighestColumn();
                $lastRow = $sheet->getHighestRow();

                // Terapkan filter untuk semua kolom (baris pertama = heading)
                $sheet->setAutoFilter("A1:{$lastColumn}{$lastRow}");
            }
        ];
    }
}
