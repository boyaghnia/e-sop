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

    function esopTampil() {
        $esops = Esop::all();
        return view('esop.tampil', compact('esops'));
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
        $esop = Esop::where('id_unor', Auth::user()->id_unor)
            ->where('id', $id)
            ->firstOrFail();
        return view('esop.edit', compact('esop'));
    }

    function esopUpdate(Request $request, $id) {
    $esop = Esop::where('id_unor', Auth::user()->id_unor)
        ->where('id', $id)
        ->firstOrFail();
    $esop->id_unor = Auth::user()->id_unor;
    $esop->user_id = Auth::id();
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

    // Tetap di halaman edit setelah update
    return redirect()->route('esop.edit', ['id' => $id]);
    }

    function esopDelete($id)
    {
        $esop = Esop::where('id_unor', Auth::user()->id_unor)
            ->where('id', $id)
            ->firstOrFail();

        $esop->delete();

        return redirect()->route('esop.tampil');
    }

    public function esopFlow($id)
    {
        $esop = Esop::with('pelaksanas')->where('id_unor', Auth::user()->id_unor)->findOrFail($id);

        $flows = Flow::where('esop_id', $id)->orderBy('no_urutan')->get()->keyBy('no_urutan');

        return view('esop.flow', compact('esop', 'flows'));
    }
    
    public function simpanFlow(Request $request, $id)
    {

        $esop = Esop::findOrFail($id);

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
    

    
}
