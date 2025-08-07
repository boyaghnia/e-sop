<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'role' => 'admin',
                'id_unor' => 'admin',
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
            ],
            [
                'role' => 'obu',
                'id_unor' => 'otbanx',
                'name' => 'Otoritas Bandar Udara Wilayah X',
                'password' => Hash::make('password'),
            ],
            [
                'role' => 'upbu',
                'id_unor' => 'kamur',
                'name' => 'UPBU Kelas III Kamur',
                'password' => Hash::make('password'),
            ],
            [
                'role' => 'upbu',
                'id_unor' => 'ewer',
                'name' => 'UPBU Kelas III Ewer',
                'password' => Hash::make('password'),
            ],
            [
                'role' => 'upbu',
                'id_unor' => 'kimaam',
                'name' => 'UPBU Kelas III Kimaam',
                'password' => Hash::make('password'),
            ],
            [
                'role' => 'obu',
                'id_unor' => 'otban9',
                'name' => 'Otoritas Bandar Udara Wilayah IX',
                'password' => Hash::make('password'),
            ],
            [
                'role' => 'sekretariat',
                'id_unor' => 'ortala',
                'name' => 'Bagian Organisasi & Tata Laksana',
                'password' => Hash::make('password'),
            ],
            [
                'role' => 'sekretariat',
                'id_unor' => 'sdm',
                'name' => 'Bagian Sumber Daya Manusia',
                'password' => Hash::make('password'),
            ],
            [
                'role' => 'direktorat',
                'id_unor' => 'dbu',
                'name' => 'Direktorat Bandar Udara',
                'password' => Hash::make('password'),
            ],
            [
                'role' => 'direktorat',
                'id_unor' => 'dau',
                'name' => 'Direktorat Angkutan Udara',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(
                ['id_unor' => $user['id_unor']],
                array_merge($user, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
