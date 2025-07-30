<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Esop;
use App\Models\PelaksanaSop;
use App\Models\Flow;

class EsopController extends Controller
{
    function esopTambah() {
        return view('esop.tambah');
    }

        public function esopTampil()
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

        return view('esop.tampil', compact('myEsops', 'allEsops', 'user'));
    }

    function esopSimpan(Request $request) {
    $esop = new Esop();
    $esop->user_id = Auth::id();
    $esop->id_unor = Auth::user()->id_unor;
    $esop->judul_sop = $request->judul_sop;
    $esop->no_sop = $request->no_sop;
    $esop->nama_sop = $request->nama_sop;
    $esop->tgl_ditetapkan = $request->tgl_ditetapkan;
    $esop->tgl_revisi = $request->tgl_revisi;
    $esop->tgl_diberlakukan = $request->tgl_diberlakukan;
    $esop->dasar_hukum = $request->dasar_hukum;
    $esop->kualifikasi_pelaksana = $request->kualifikasi_pelaksana;
    $esop->keterkaitan = $request->keterkaitan;
    $esop->peralatan_perlengkapan = $request->peralatan_perlengkapan;
    $esop->peringatan = $request->peringatan;
    $esop->pencatatan_pendataan = $request->pencatatan_pendataan;
    $esop->cara_mengatasi = $request->cara_mengatasi;

    $esop->save();

    // Redirect ke halaman edit dari data yang baru disimpan
    return redirect()->route('esop.edit', ['id' => $esop->id]);
    }

    function esopEdit($id) {
        $user = Auth::user();
        $query = Esop::where('id', $id);
        
        // Filter akses berdasarkan role
        if ($user->role === 'admin') {
            // Admin dapat mengakses semua SOP
        } elseif ($user->role === 'obu') {
            // OBU dapat mengakses SOP milik sendiri dan SOP dari role upbu
            $query->where(function($q) use ($user) {
                $q->where('user_id', $user->id)
                  ->orWhere(function($subQuery) use ($user) {
                      $subQuery->where('id_unor', $user->id_unor)
                               ->whereHas('user', function($userQuery) {
                                   $userQuery->where('role', 'upbu');
                               });
                  })
                  ->orWhereHas('user', function($userQuery) {
                      $userQuery->where('role', 'upbu');
                  });
            });
        } else {
            // Role lain hanya dapat mengakses SOP milik sendiri atau yang sama id_unor
            $query->where(function($q) use ($user) {
                $q->where('id_unor', $user->id_unor)
                  ->orWhere('user_id', $user->id);
            });
        }
        
        $esop = $query->firstOrFail();
        return view('esop.edit', compact('esop'));
    }

    function esopUpdate(Request $request, $id) {
        $user = Auth::user();
        $query = Esop::where('id', $id);
        
        // Filter akses berdasarkan role
        if ($user->role === 'admin') {
            // Admin dapat mengakses semua SOP
        } elseif ($user->role === 'obu') {
            // OBU dapat mengakses SOP milik sendiri dan SOP dari role upbu
            $query->where(function($q) use ($user) {
                $q->where('user_id', $user->id)
                  ->orWhere(function($subQuery) use ($user) {
                      $subQuery->where('id_unor', $user->id_unor)
                               ->whereHas('user', function($userQuery) {
                                   $userQuery->where('role', 'upbu');
                               });
                  })
                  ->orWhereHas('user', function($userQuery) {
                      $userQuery->where('role', 'upbu');
                  });
            });
        } else {
            // Role lain hanya dapat mengakses SOP milik sendiri atau yang sama id_unor
            $query->where(function($q) use ($user) {
                $q->where('id_unor', $user->id_unor)
                  ->orWhere('user_id', $user->id);
            });
        }
        
        $esop = $query->firstOrFail();
        
        // Update data
        $esop->judul_sop = $request->judul_sop;
        $esop->no_sop = $request->no_sop;
        $esop->nama_sop = $request->nama_sop;
        $esop->tgl_ditetapkan = $request->tgl_ditetapkan;
        $esop->tgl_revisi = $request->tgl_revisi;
        $esop->tgl_diberlakukan = $request->tgl_diberlakukan;
        $esop->dasar_hukum = $request->dasar_hukum;
        $esop->kualifikasi_pelaksana = $request->kualifikasi_pelaksana;
        $esop->keterkaitan = $request->keterkaitan;
        $esop->peralatan_perlengkapan = $request->peralatan_perlengkapan;
        $esop->peringatan = $request->peringatan;
        $esop->pencatatan_pendataan = $request->pencatatan_pendataan;
        $esop->cara_mengatasi = $request->cara_mengatasi;
        $esop->update();

        return redirect()->route('esop.edit', ['id' => $id]);
    }

    function esopDelete($id)
    {
        $user = Auth::user();
        $query = Esop::where('id', $id);
        
        // Filter akses berdasarkan role
        if ($user->role === 'admin') {
            // Admin dapat mengakses semua SOP
        } elseif ($user->role === 'obu') {
            // OBU dapat mengakses SOP milik sendiri dan SOP dari role upbu
            $query->where(function($q) use ($user) {
                $q->where('user_id', $user->id)
                  ->orWhere(function($subQuery) use ($user) {
                      $subQuery->where('id_unor', $user->id_unor)
                               ->whereHas('user', function($userQuery) {
                                   $userQuery->where('role', 'upbu');
                               });
                  })
                  ->orWhereHas('user', function($userQuery) {
                      $userQuery->where('role', 'upbu');
                  });
            });
        } else {
            // Role lain hanya dapat mengakses SOP milik sendiri atau yang sama id_unor
            $query->where(function($q) use ($user) {
                $q->where('id_unor', $user->id_unor)
                  ->orWhere('user_id', $user->id);
            });
        }
        
        $esop = $query->firstOrFail();
        $esop->delete();

        return redirect()->route('dashboard.tampil');
    }

    public function esopFlow($id)
    {
        $user = Auth::user();
        $query = Esop::with('pelaksanas')->where('id', $id);
        
        // Filter akses berdasarkan role
        if ($user->role === 'admin') {
            // Admin dapat mengakses semua SOP
        } elseif ($user->role === 'obu') {
            // OBU dapat mengakses SOP milik sendiri dan SOP dari role upbu
            $query->where(function($q) use ($user) {
                $q->where('user_id', $user->id)
                  ->orWhere(function($subQuery) use ($user) {
                      $subQuery->where('id_unor', $user->id_unor)
                               ->whereHas('user', function($userQuery) {
                                   $userQuery->where('role', 'upbu');
                               });
                  })
                  ->orWhereHas('user', function($userQuery) {
                      $userQuery->where('role', 'upbu');
                  });
            });
        } else {
            // Role lain hanya dapat mengakses SOP milik sendiri atau yang sama id_unor
            $query->where(function($q) use ($user) {
                $q->where('id_unor', $user->id_unor)
                  ->orWhere('user_id', $user->id);
            });
        }
        
        $esop = $query->firstOrFail();
        $flows = Flow::where('esop_id', $id)->orderBy('no_urutan')->get()->keyBy('no_urutan');

        return view('esop.flow', compact('esop', 'flows'));
    }
    
    public function simpanFlow(Request $request, $id)
    {
        $user = Auth::user();
        $query = Esop::where('id', $id);
        
        // Filter akses berdasarkan role
        if ($user->role === 'admin') {
            // Admin dapat mengakses semua SOP
        } elseif ($user->role === 'obu') {
            // OBU dapat mengakses SOP milik sendiri dan SOP dari role upbu
            $query->where(function($q) use ($user) {
                $q->where('user_id', $user->id)
                  ->orWhere(function($subQuery) use ($user) {
                      $subQuery->where('id_unor', $user->id_unor)
                               ->whereHas('user', function($userQuery) {
                                   $userQuery->where('role', 'upbu');
                               });
                  })
                  ->orWhereHas('user', function($userQuery) {
                      $userQuery->where('role', 'upbu');
                  });
            });
        } else {
            // Role lain hanya dapat mengakses SOP milik sendiri atau yang sama id_unor
            $query->where(function($q) use ($user) {
                $q->where('id_unor', $user->id_unor)
                  ->orWhere('user_id', $user->id);
            });
        }
        
        $esop = $query->firstOrFail();

        // Hapus data pelaksana lama (optional)
        $esop->pelaksanas()->delete();

        $request->validate([
            'pelaksana' => 'array',
            'pelaksana.*' => 'nullable|string|max:255',
        ]);

        $pelaksanas = $request->input('pelaksana', []);

        foreach ($pelaksanas as $isi) {
            if (trim($isi) !== '') {
                PelaksanaSop::create([
                    'esop_id' => $esop->id,
                    'isi' => $isi,
                ]);
            }
        }

        return redirect()->route('esop.flow', ['id' => $esop->id]);
    }


    public function updateFlow(Request $request, $id)
    {
        $user = Auth::user();
        $query = Esop::where('id', $id);
        
        // Filter akses berdasarkan role
        if ($user->role === 'admin') {
            // Admin dapat mengakses semua SOP
        } elseif ($user->role === 'obu') {
            // OBU dapat mengakses SOP milik sendiri dan SOP dari role upbu
            $query->where(function($q) use ($user) {
                $q->where('user_id', $user->id)
                  ->orWhere(function($subQuery) use ($user) {
                      $subQuery->where('id_unor', $user->id_unor)
                               ->whereHas('user', function($userQuery) {
                                   $userQuery->where('role', 'upbu');
                               });
                  })
                  ->orWhereHas('user', function($userQuery) {
                      $userQuery->where('role', 'upbu');
                  });
            });
        } else {
            // Role lain hanya dapat mengakses SOP milik sendiri atau yang sama id_unor
            $query->where(function($q) use ($user) {
                $q->where('id_unor', $user->id_unor)
                  ->orWhere('user_id', $user->id);
            });
        }
        
        $esop = $query->firstOrFail();
        
        // Hapus semua data lama
        Flow::where('esop_id', $id)->delete();

        foreach ($request->all() as $key => $value) {
            if (str_starts_with($key, 'uraian_kegiatan_')) {
                $index = (int) str_replace('uraian_kegiatan_', '', $key);
                $uraian = trim($value);

                // Lewati jika kosong atau index invalid
                if ($uraian === '' || $index <= 0) {
                    continue;
                }

                // Ambil data symbols untuk flow ini
                $symbols = [];
                foreach ($request->all() as $symbolKey => $symbolValue) {
                    if (str_starts_with($symbolKey, "symbol_{$index}_") && !empty($symbolValue)) {
                        $pelaksanaIndex = str_replace("symbol_{$index}_", '', $symbolKey);
                        $symbols[$pelaksanaIndex] = $symbolValue;
                    }
                }

                // Ambil data return_to untuk flow ini
                $returnTo = [];
                foreach ($request->all() as $returnKey => $returnValue) {
                    if (str_starts_with($returnKey, "return_to_{$index}_") && !empty($returnValue)) {
                        $pelaksanaIndex = str_replace("return_to_{$index}_", '', $returnKey);
                        $returnTo[$pelaksanaIndex] = (int) $returnValue;
                    }
                }

                Flow::create([
                    'esop_id' => $id,
                    'no_urutan' => $index,
                    'uraian_kegiatan' => $uraian,
                    'kelengkapan' => $request->input("kelengkapan_$index"),
                    'waktu' => $request->input("waktu_$index"),
                    'output' => $request->input("output_$index"),
                    'keterangan' => $request->input("keterangan_$index"),
                    'symbols' => !empty($symbols) ? $symbols : null,
                    'return_to' => !empty($returnTo) ? $returnTo : null,
                ]);
            }
        }

        return redirect()->route('esop.flow', ['id' => $id])->with('success', 'Flow berhasil disimpan');
    }

    public function esopSearch(Request $request)
    {
        $query = $request->get('query');
        $user = Auth::user();
        
        try {
            if (empty($query)) {
                // Jika query kosong, tampilkan semua data
                $esopsQuery = Esop::with('user');
                
                // Filter berdasarkan role
                if ($user->role === 'admin') {
                    // Admin dapat melihat semua data
                } elseif ($user->role === 'obu') {
                    // OBU dapat melihat SOP milik sendiri dan SOP dari role upbu
                    $esopsQuery->where(function($q) use ($user) {
                        $q->where('user_id', $user->id)
                          ->orWhereHas('user', function($userQuery) {
                              $userQuery->where('role', 'upbu');
                          });
                    });
                } else {
                    // Role lain hanya dapat melihat SOP milik sendiri
                    $esopsQuery->where('user_id', $user->id);
                }
                
                $esops = $esopsQuery->orderBy('created_at', 'desc')->get();
            } else {
                // Lakukan pencarian berdasarkan nama_sop atau nama user
                $esopsQuery = Esop::with('user');
                
                // Filter berdasarkan role terlebih dahulu
                if ($user->role === 'admin') {
                    // Admin dapat melihat semua data
                } elseif ($user->role === 'obu') {
                    // OBU dapat melihat SOP milik sendiri dan SOP dari role upbu
                    $esopsQuery->where(function($q) use ($user) {
                        $q->where('user_id', $user->id)
                          ->orWhereHas('user', function($userQuery) {
                              $userQuery->where('role', 'upbu');
                          });
                    });
                } else {
                    // Role lain hanya dapat melihat SOP milik sendiri
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
     * Menampilkan halaman cetak SOP yang menggabungkan data dari esop edit dan flow
     */
    public function esopPrint($id)
    {
        // Memastikan user berhak mengakses SOP ini
        $user = Auth::user();
        $esop = Esop::with(['pelaksanas'])->findOrFail($id);
        
        // Ambil data flow untuk SOP ini
        $flows = Flow::where('esop_id', $id)
                    ->orderBy('no_urutan', 'asc')
                    ->get();
                    
        // Untuk setiap flow, ambil data pelaksana dan simbol
        foreach ($flows as $flow) {
            // Format data pelaksana
            $pelaksanaValues = [];
            $flowPelaksanaData = json_decode($flow->pelaksana_json, true);
            
            if ($flowPelaksanaData && is_array($flowPelaksanaData)) {
                foreach ($flowPelaksanaData as $pelaksanaId => $data) {
                    $pelaksanaValues[$pelaksanaId] = [
                        'symbol' => $data['symbol'] ?? '',
                        'symbol_number' => $data['symbol_number'] ?? '',
                    ];
                }
            }
            
            $flow->pelaksana_values = $pelaksanaValues;
        }
        
        return view('esop.print', compact('esop', 'flows'));
    }
    
}
