<?php

namespace App\Exports;

use App\Models\Esop;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EsopExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithEvents
{
    protected string $type;
    protected ?string $search;

    /**
     * @param string      $type   Jenis data yang akan diekspor: 'all', 'disahkan', atau 'draft'
     * @param string|null $search Kata kunci pencarian (opsional)
     */
    public function __construct(string $type = 'all', ?string $search = null)
    {
        $this->type   = $type;
        $this->search = $search;
    }

    /**
     * Kumpulkan data berdasarkan role user, jenis status dan kata kunci pencarian.
     * Data diurutkan berdasarkan hierarki role dan tanggal pembuatan.
     */
    public function collection()
    {
        $user = Auth::user();
        $baseQuery = Esop::with('user');

        // Filter berdasarkan peran pengguna
        if ($user->role === 'sekretariat' || $user->role === 'direktorat' || $user->role === 'balai') {
            $baseQuery->where(function($q) use ($user) {
                $q->where('user_id', $user->id)
                  ->orWhereHas('user', function($userQuery) {
                      $userQuery->where('role', 'obu')
                                ->orWhere('role', 'upbu');
                  });
            });
        } elseif ($user->role === 'obu') {
            $baseQuery->whereHas('user', function($userQuery) {
                $userQuery->where('role', 'upbu');
            });
        } elseif ($user->role !== 'admin') {
            $baseQuery->where('user_id', $user->id);
        }

        // Filter status berdasarkan tipe eksport
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
                // 'all' tidak menambah filter status
                break;
        }

        // Filter berdasarkan kata kunci pencarian
        if ($this->search) {
            $search = $this->search;
            $baseQuery->where(function ($q) use ($search) {
                $q->where('nama_sop', 'LIKE', "%{$search}%")
                  ->orWhere('judul_sop', 'LIKE', "%{$search}%")
                  ->orWhere('no_sop', 'LIKE', "%{$search}%")
                  ->orWhereHas('user', function($uq) use ($search) {
                      $uq->where('name', 'LIKE', "%{$search}%");
                  });
            });
        }

        // Gabungkan dengan tabel users untuk sorting berdasarkan role
        return $baseQuery
            ->leftJoin('users', 'esops.user_id', '=', 'users.id')
            ->orderByRaw("
                CASE users.role
                    WHEN 'sekretariat' THEN 1
                    WHEN 'direktorat'  THEN 2
                    WHEN 'balai'       THEN 3
                    WHEN 'obu'         THEN 4
                    WHEN 'upbu'        THEN 5
                    ELSE 6
                END
            ")
            ->orderBy('esops.created_at', 'desc')
            ->select('esops.*')
            ->get();
    }

    /**
     * Header kolom untuk file Excel.
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
     * Pemetaan setiap baris data ke kolom Excel.
     *
     * @param  Esop $esop
     * @return array
     */
    public function map($esop): array
    {
        static $no = 1;

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
     * Format tulisan role agar kapitalisasi sesuai.
     */
    private function formatRole($role): string
    {
        switch (strtolower($role)) {
            case 'admin':       return '-';
            case 'sekretariat': return 'Sekretariat';
            case 'direktorat':  return 'Direktorat';
            case 'balai':       return 'Balai';
            case 'obu':         return 'OBU';
            case 'upbu':        return 'UPBU';
            default:            return ucfirst($role);
        }
    }

    /**
     * Pengaturan gaya untuk sheet Excel.
     */
    public function styles(Worksheet $sheet)
    {
        // Auto-size semua kolom
        foreach(range('A','F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        return [
            // Baris header (A1-F1) berwarna latar ungu dan teks putih tebal
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => 'solid', 'color' => ['rgb' => '4F46E5']]
            ],
            // Definisi minimal lebar kolom
            'A' => ['width' => 5],
            'B' => ['width' => 15],
            'C' => ['width' => 25],
            'D' => ['width' => 35],
            'E' => ['width' => 15],
            'F' => ['width' => 12],
        ];
    }

    /**
     * Mendaftarkan event untuk sheet Excel, misalnya menambahkan AutoFilter.
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $lastColumn = $sheet->getHighestColumn();
                $lastRow    = $sheet->getHighestRow();

                // Terapkan auto filter dari A1 sampai kolom/row terakhir
                $sheet->setAutoFilter("A1:{$lastColumn}{$lastRow}");
            },
        ];
    }
}