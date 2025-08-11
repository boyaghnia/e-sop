<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Esop;
use Illuminate\Support\Facades\Auth;
use App\Exports\EsopExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboardTampil()
    {
        $user = Auth::user();
        
        // Query untuk table atas - ESOP milik user yang sedang login
        $myEsops = Esop::with('user')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(5, ['*'], 'my_page');
        
        // Query untuk table bawah - berdasarkan role
        $allEsopsQuery = Esop::with('user');
        
        if ($user->role === 'admin') {
            // Admin dapat melihat semua ESOP
            // Tidak ada filter tambahan
        } elseif ($user->role === 'sekretariat' || $user->role === 'direktorat') {
            // Sekretariat dan Direktorat dapat melihat ESOP dari role 'obu', 'upbu' dan milik sendiri
            // OBU dapat melihat ESOP dari role 'upbu'
            $allEsopsQuery->whereHas('user', function($userQuery) {
                $userQuery->where('role', 'obu')->orWhere('role', 'upbu');
            });
        } elseif ($user->role === 'obu') {
            // OBU dapat melihat ESOP dari role 'upbu'
            $allEsopsQuery->whereHas('user', function($userQuery) {
                $userQuery->where('role', 'upbu');
            });
        } else {
            // Role lain (termasuk upbu) hanya melihat ESOP milik sendiri
            $allEsopsQuery->where('user_id', $user->id);
        }
        
        $allEsops = $allEsopsQuery->orderBy('created_at', 'desc')
            ->paginate(5, ['*'], 'all_page');

        // Query untuk table statistik unit kerja (tampilkan juga unit yang belum punya SOP)
        $unitStatsQuery = DB::table('users')
            ->leftJoin('esops', 'esops.user_id', '=', 'users.id')
            ->select(
                'users.id as user_id',
                'users.name as name',
                'users.role as role'
            )
            ->selectRaw('COUNT(esops.id) as total_sop')
            ->selectRaw('SUM(CASE WHEN esops.id IS NOT NULL AND esops.file_path IS NOT NULL AND esops.file_name IS NOT NULL THEN 1 ELSE 0 END) as disahkan')
            ->selectRaw('SUM(CASE WHEN esops.id IS NOT NULL AND (esops.file_path IS NULL OR esops.file_name IS NULL) THEN 1 ELSE 0 END) as draft')
            ->groupBy('users.id', 'users.name', 'users.role');

        if ($user->role === 'admin') {
            // Admin dapat melihat semua unit
        } elseif ($user->role === 'sekretariat' || $user->role === 'direktorat') {
            $unitStatsQuery->whereIn('users.role', ['obu', 'upbu']);
        } elseif ($user->role === 'obu') {
            $unitStatsQuery->where('users.role', 'upbu');
        } else {
            $unitStatsQuery->where('users.id', $user->id);
        }

        $unitStats = $unitStatsQuery->paginate(5, ['*'], 'unit_page');

        // Query untuk statistik berdasarkan role
        $roleStatsQuery = Esop::join('users', 'esops.user_id', '=', 'users.id')
            ->selectRaw('users.role, COUNT(*) as total_sop')
            ->groupBy('users.role');

        if ($user->role === 'admin') {
            // Admin dapat melihat semua role
        } elseif ($user->role === 'sekretariat' || $user->role === 'direktorat') {
            $roleStatsQuery->whereIn('users.role', ['obu', 'upbu']);
        } elseif ($user->role === 'obu') {
            $roleStatsQuery->where('users.role', 'upbu');
        } else {
            $roleStatsQuery->where('users.role', $user->role);
        }

        $roleStats = $roleStatsQuery->get();

        return view('dashboard.tampil', compact('myEsops', 'allEsops', 'unitStats', 'roleStats', 'user'));
    }

    public function dashboardSearch(Request $request)
    {
        $query = $request->get('query');
        $table = $request->get('table', 'all'); // 'my' untuk table atas, 'all' untuk table bawah, 'units' untuk table statistik
        $user = Auth::user();
        
        try {
            if ($table === 'units') {
                $unitStatsQuery = DB::table('users')
                    ->leftJoin('esops', 'esops.user_id', '=', 'users.id')
                    ->select(
                        'users.id as user_id',
                        'users.name as name',
                        'users.role as role'
                    )
                    ->selectRaw('COUNT(esops.id) as total_sop')
                    ->selectRaw('SUM(CASE WHEN esops.id IS NOT NULL AND esops.file_path IS NOT NULL AND esops.file_name IS NOT NULL THEN 1 ELSE 0 END) as disahkan')
                    ->selectRaw('SUM(CASE WHEN esops.id IS NOT NULL AND (esops.file_path IS NULL OR esops.file_name IS NULL) THEN 1 ELSE 0 END) as draft')
                    ->groupBy('users.id', 'users.name', 'users.role');

                if ($user->role === 'admin') {
                    // Admin dapat melihat semua unit
                } elseif ($user->role === 'sekretariat' || $user->role === 'direktorat') {
                    $unitStatsQuery->whereIn('users.role', ['obu', 'upbu']);
                } elseif ($user->role === 'obu') {
                    $unitStatsQuery->where('users.role', 'upbu');
                } else {
                    $unitStatsQuery->where('users.id', $user->id);
                }

                if (!empty($query)) {
                    $unitStatsQuery->where('users.name', 'LIKE', '%' . $query . '%');
                }

                $units = $unitStatsQuery->get();

                return response()->json([
                    'success' => true,
                    'data' => $units,
                    'message' => 'Data berhasil diambil'
                ]);
            }

            if (empty($query)) {
                if ($table === 'my') {
                    // Table atas - ESOP milik user yang sedang login
                    $esops = Esop::with('user')
                        ->where('user_id', $user->id)
                        ->orderBy('created_at', 'desc')
                        ->get();
                } else {
                    // Table bawah - berdasarkan role
                    $esopsQuery = Esop::with('user');
                    
                    if ($user->role === 'admin') {
                        // Admin dapat melihat semua ESOP
                    } elseif ($user->role === 'sekretariat' || $user->role === 'direktorat') {
                        // Sekretariat, Direktorat, dan Balai dapat melihat ESOP dari role 'obu' dan 'upbu'
                        $esopsQuery->whereHas('user', function($userQuery) {
                            $userQuery->where('role', 'obu')->orWhere('role', 'upbu');
                        });
                    } elseif ($user->role === 'obu') {
                        // OBU dapat melihat ESOP dari role 'upbu'
                        $esopsQuery->whereHas('user', function($userQuery) {
                            $userQuery->where('role', 'upbu');
                        });
                    } else {
                        // Role lain (termasuk upbu) hanya melihat ESOP milik sendiri
                        $esopsQuery->where('user_id', $user->id);
                    }
                    
                    $esops = $esopsQuery->orderBy('created_at', 'desc')->get();
                }
            } else {
                if ($table === 'my') {
                    // Pencarian di table atas - ESOP milik user yang sedang login
                    $esops = Esop::with('user')
                        ->where('user_id', $user->id)
                        ->where(function($searchQuery) use ($query) {
                            $searchQuery->where('nama_sop', 'LIKE', '%' . $query . '%')
                                ->orWhere('judul_sop', 'LIKE', '%' . $query . '%')
                                ->orWhere('no_sop', 'LIKE', '%' . $query . '%');
                        })
                        ->orderBy('created_at', 'desc')
                        ->get();
                } else {
                    // Pencarian di table bawah - berdasarkan role
                    $esopsQuery = Esop::with('user');
                    
                    if ($user->role === 'admin') {
                        // Admin dapat melihat semua ESOP
                    } elseif ($user->role === 'sekretariat' || $user->role === 'direktorat') {
                        // Sekretariat, Direktorat, dan Balai dapat melihat ESOP dari role 'obu' dan 'upbu'
                        $esopsQuery->whereHas('user', function($userQuery) {
                            $userQuery->where('role', 'obu')->orWhere('role', 'upbu');
                        });
                    } elseif ($user->role === 'obu') {
                        // OBU dapat melihat ESOP dari role 'upbu'
                        $esopsQuery->whereHas('user', function($userQuery) {
                            $userQuery->where('role', 'upbu');
                        });
                    } else {
                        // Role lain (termasuk upbu) hanya melihat ESOP milik sendiri
                        $esopsQuery->where('user_id', $user->id);
                    }
                    
                    // Tambahkan kondisi pencarian
                    $esops = $esopsQuery->where(function($searchQuery) use ($query) {
                            $searchQuery->where('nama_sop', 'LIKE', '%' . $query . '%')
                                ->orWhere('judul_sop', 'LIKE', '%' . $query . '%')
                                ->orWhere('no_sop', 'LIKE', '%' . $query . '%')
                                ->orWhereHas('user', function($userQuery) use ($query) {
                                    $userQuery->where('name', 'LIKE', '%' . $query . '%');
                                });
                        })
                        ->orderBy('created_at', 'desc')
                        ->get();
                }
            }

            return response()->json([
                'success' => true,
                'data' => $esops,
                'message' => 'Data berhasil diambil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Export SOPs to Excel from dashboard
     */
    public function exportSop(Request $request)
    {
        $type = $request->get('type', 'all');
        
        // Validate type
        if (!in_array($type, ['all', 'approved', 'draft'])) {
            return redirect()->back()->with('error', 'Tipe export tidak valid');
        }
        
        // Map type for EsopExport class
        $exportType = $type === 'approved' ? 'disahkan' : $type;
        
        // Generate filename based on type
        $typeNames = [
            'all' => 'SOP',
            'approved' => 'SOP_Disahkan',
            'draft' => 'SOP_Draft'
        ];
        
        $filename = $typeNames[$type] . '_' . date('d-m-Y_H-i-s') . '.xlsx';
        
        try {
            return Excel::download(new EsopExport($exportType), $filename);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengexport data: ' . $e->getMessage());
        }
    }

    
}
