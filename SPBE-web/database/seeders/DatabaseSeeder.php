<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Document;
use App\Models\Indicator;
use App\Models\Aspect;
use App\Models\Domain;
use App\Models\Opd;
use Illuminate\Database\Eloquent\Factories\Sequence;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $kominfo = Opd::factory()->create([
            'opd_name' => 'Dinas Komunikasi dan Informatika',
            'opd_alias' => 'Diskominfo'
        ]);

        User::factory()->for($kominfo)
            ->create([
                'name' => 'Bu Rista',
                'user_type' => 'admin',
                'email' => 'admin@material.com',
                'pangkat' => 'Gol IV/B',
                'password' => ('secret')
        ]);

        User::factory()->for($kominfo)
        ->create([
                'name' => 'Pak Nugroho',
                'user_type' => 'supervisor',
                'email' => 'supervisor@material.com',
                'pangkat' => 'Gol IV/B',
                'password' => ('secret'),
        ]);

        Opd::factory()->hasUsers(1, [
            'name' => 'Alvian Rahmadani Saputra',
            'user_type' => 'user',
            'email' => 'alvian123@gmail.com',
            'pangkat' => 'Gol III/A',
            'password' => ('secret'),
        ])->create([
            'opd_name' => 'Dinas Kesehatan',
            'opd_alias' => 'Dinkes'
        ]);

        Opd::factory()->hasUsers(1,[
            'name' => 'Fahmi Zulkarnain Habib',
            'user_type' => 'user',
            'email' => 'fahmi123@gmail.com',
            'pangkat' => 'Gol IV/A',
            'password' => ('secret'),
        ])->create([
            'opd_name' => 'Badan Pendapatan Daerah',
            'opd_alias' => 'Bapenda'
        ]);

        Opd::factory()->hasUsers(1,[
            'name' => 'Enrico Sakti Dwi Yohanna',
            'user_type' => 'user',
            'email' => 'enrico123@gmail.com',
            'pangkat' => 'Sersan Mayor',
            'password' => ('secret'),
        ])->create([
            'opd_name' => 'Dinas Kependudukan',
            'opd_alias' => 'Dispenduk'
        ]);

        $domain = Domain::factory()->create([
            'domain_name' => 'Kebijakan SPBE'
        ]);

        $aspect = Aspect::factory()
        ->for($domain)
        ->create([
            'aspect_name' => 'Kebijakan Internal terkait Tata Kelola SPBE'
        ]);

        Indicator::factory()->count(10)->sequence(
            ['indicator_name' => 'Tingkat Kematangan Kebijakan Internal Arsitektur SPBE Instansi Pusat/Pemerintah Daerah'],
            ['indicator_name' => 'Tingkat Kematangan Kebijakan Internal Peta Rencana SPBE Instansi Pusat/Pemerintah Daerah'],
            ['indicator_name' => 'Tingkat Kematangan Kebijakan Internal Manajemen Data'],
            ['indicator_name' => 'Tingkat Kematangan Kebijakan Internal Pembangunan Aplikasi SPBE'],
            ['indicator_name' => 'Tingkat Kematangan Kebijakan Internal Layanan Pusat Data'],
            ['indicator_name' => 'Tingkat Kematangan Kebijakan Internal Layanan Jaringan Intra Instansi Pusat/Pemerintah Daerah'],
            ['indicator_name' => 'Tingkat Kematangan Kebijakan Internal Penggunaan Sistem Penghubung Layanan Instansi Pusat/Pemerintah Daerah'],
            ['indicator_name' => 'Tingkat Kematangan Kebijakan Internal Manajemen Keamanan Informasi'],
            ['indicator_name' => 'Tingkat Kematangan Kebijakan Internal Audit TIK'],
            ['indicator_name' => 'Tingkat Kematangan Kebijakan Internal Tim Koordinasi SPBE Instansi Pusat/Pemerintah Daerah'],
        )->for($aspect)
        ->create();
    }
}
