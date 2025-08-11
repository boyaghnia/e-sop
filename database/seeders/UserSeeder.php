<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data dari API Hubud menggunakan Basic Auth (pakai config + fallback env)
        $hubudUser = config('services.hubud.user') ?? env('HUBUD_USER');
        $hubudPass = config('services.hubud.pass') ?? env('HUBUD_PASS');

        if (!$hubudUser || !$hubudPass) {
            $this->command->warn('HUBUD_USER/HUBUD_PASS kosong. Lewati fetch API Hubud. Cek .env & config/services.php.');
        } else {
            try {
                $http = Http::withBasicAuth($hubudUser, $hubudPass);

                // Opsi CA bundle custom via env/config (opsional & lebih aman daripada bypass)
                $hubudCA = config('services.hubud.ca_path') ?? env('HUBUD_CA_PATH');
                if ($hubudCA) {
                    $http = $http->withOptions(['verify' => $hubudCA]);
                }

                // Di environment lokal, boleh bypass SSL jika HUBUD_SSL_VERIFY=false
                $sslVerify = config('services.hubud.ssl_verify');
                if (is_null($sslVerify)) {
                    $sslVerify = filter_var(env('HUBUD_SSL_VERIFY', false), FILTER_VALIDATE_BOOLEAN);
                }
                if (app()->environment('local') && !$sslVerify) {
                    $http = $http->withoutVerifying();
                }

                $response = $http->get('https://hubud.kemenhub.go.id/hubud/website/pas/satker?');

                if ($response->successful()) {
                    $apiData = $response->json();
                    if (isset($apiData['result']['satker']) && is_array($apiData['result']['satker'])) {
                        foreach ($apiData['result']['satker'] as $satker) {
                            // Tentukan role berdasarkan kata kunci pada beberapa field
                            $sourceText = strtolower(trim(
                                ($satker['satker'] ?? '') . ' ' .
                                ($satker['deskripsi'] ?? '') . ' ' .
                                ($satker['pengelola'] ?? '') . ' ' .
                                ($satker['penyelenggara'] ?? '')
                            ));

                            $resolvedRole = null;
                            if (str_contains($sourceText, 'sekretariat')) {
                                // Prioritaskan sekretariat jika muncul bersama "direktorat"
                                $resolvedRole = 'sekretariat';
                            } elseif (str_contains($sourceText, 'direktorat')) {
                                $resolvedRole = 'direktorat';
                            } elseif (str_contains($sourceText, 'otoritas')) {
                                $resolvedRole = 'obu';
                            } elseif (str_contains($sourceText, 'balai')) {
                                $resolvedRole = 'balai';
                            } elseif (str_contains($sourceText, 'upbu')) {
                                $resolvedRole = 'upbu';
                            }

                            // Fallback jika tidak ada kata kunci yang cocok
                            $resolvedRole = $resolvedRole ?? 'upbu';

                            // id_uker: pakai title (lowercase, tanpa spasi); jika null fallback ke id_satker
                            $idUker = isset($satker['title']) ? strtolower(str_replace(' ', '', $satker['title'])) : null;
                            if (!$idUker) {
                                $idUker = $satker['id_satker'] ?? null;
                            }
                            if (!$idUker) {
                                $this->command->warn('Lewati satker tanpa id_uker & id_satker: ' . ($satker['title'] ?? '-'));
                                continue;
                            }

                            DB::table('users')->updateOrInsert(
                                ['id_uker' => $idUker],
                                [
                                    'role' => $resolvedRole,
                                    'id_uker' => $idUker,
                                    'id_satker' => $satker['id_satker'],
                                    'deskripsi' => $satker['deskripsi'] ?? null,
                                    'satker' => $satker['satker'] ?? null,
                                    'id_bandara' => $satker['id_bandara'] ?? null,
                                    'otban' => $satker['otban'] ?? null,
                                    'title' => $satker['title'] ?? null,
                                    'penyelenggara' => $satker['penyelenggara'] ?? null,
                                    'name' => $satker['satker'] ?? null,
                                    'modify' => $satker['modify'] ?? null,
                                    'isactive' => isset($satker['isactive']) ? (bool) $satker['isactive'] : true,
                                    'pengelola' => $satker['pengelola'] ?? null,
                                    'password' => Hash::make('password'),
                                    'created_at' => now(),
                                    'updated_at' => now(),
                                ]
                            );
                        }
                    }
                } else {
                    $this->command->warn('Gagal mengambil data dari API Hubud (HTTP '. $response->status() .'). Seeder lanjut tanpa data API.');
                }
            } catch (ConnectionException $e) {
                $this->command->warn('Tidak bisa terhubung ke API Hubud: ' . $e->getMessage());
            }
        }

        $users = [
            [
                'role' => 'admin',
                'id_uker' => 'admin',
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
            ],
            // [
            //     'role' => 'obu',
            //     'id_uker' => 'otbanx',
            //     'name' => 'Otoritas Bandar Udara Wilayah X',
            //     'password' => Hash::make('password'),
            // ],
            // [
            //     'role' => 'obu',
            //     'id_uker' => 'otban9',
            //     'name' => 'Otoritas Bandar Udara Wilayah IX',
            //     'password' => Hash::make('password'),
            // ],
            // [
            //     'role' => 'sekretariat',
            //     'id_uker' => 'ortala',
            //     'name' => 'Bagian Organisasi & Tata Laksana',
            //     'password' => Hash::make('password'),
            // ],
            // [
            //     'role' => 'sekretariat',
            //     'id_uker' => 'sdm',
            //     'name' => 'Bagian Sumber Daya Manusia',
            //     'password' => Hash::make('password'),
            // ],
            // [
            //     'role' => 'direktorat',
            //     'id_uker' => 'dbu',
            //     'name' => 'Direktorat Bandar Udara',
            //     'password' => Hash::make('password'),
            // ],
            // [
            //     'role' => 'direktorat',
            //     'id_uker' => 'dau',
            //     'name' => 'Direktorat Angkutan Udara',
            //     'password' => Hash::make('password'),
            // ],
            // [
            //     'role' => 'balai',
            //     'id_uker' => 'hatpen',
            //     'name' => 'Balai Kesehatan Penerbangan',
            //     'password' => Hash::make('password'),
            // ],
            // [
            //     'role' => 'balai',
            //     'id_uker' => 'btp',
            //     'name' => 'Balai Teknik Penerbangan',
            //     'password' => Hash::make('password'),
            // ],
        ];

        

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(
                ['id_uker' => $user['id_uker']],
                array_merge($user, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
