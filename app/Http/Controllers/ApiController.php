<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
public function PanggilAPI()
    {   
        $response = Http::withBasicAuth('HubudAPI', 'XBZIivudTodZq88pNQsM6UhmTzqP8Nn7')
        ->withOptions([
                'verify' => false,
        ])
        ->get('https://hubud.kemenhub.go.id/hubud/website/pas/pegawai_by_nip_basic?nip=');

        if ($response->successful()) {
            $data = $response->json();
            // Lakukan sesuatu dengan data yang diterima
            dd($data);
        } else {
            // Tangani error jika permintaan gagal
            return view('your.error.view', ['error' => $response->status()]);
        }
    }
}


