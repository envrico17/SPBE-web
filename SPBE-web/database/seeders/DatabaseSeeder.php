<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Document;
use App\Models\Indicator;
use App\Models\Aspect;
use App\Models\Domain;
use App\Models\Opd;
use App\Models\Score;
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

        $form_score_one = Score::factory()->create([
            'score_name' => 'Form Scoring 2023',
            'score_description' => 'Form Scoring 2023',
            'score_date' => '2023'
        ]);

        $domain_one = Domain::factory()->create([
            'domain_name' => 'Kebijakan SPBE'
        ]);
        $domain_two = Domain::factory()->create([
            'domain_name' => 'Tata Kelola SPBE'
        ]);
        $domain_three = Domain::factory()->create([
            'domain_name' => 'Manajemen SPBE'
        ]);
        $domain_four = Domain::factory()->create([
            'domain_name' => 'Layanan SPBE'
        ]);


        $aspect_one = Aspect::factory()->for($domain_one)
        ->create([
            'aspect_name' => 'Kebijakan Internal terkait Tata Kelola SPBE'
        ]);
        $aspect_two = Aspect::factory()->for($domain_two)
        ->create([
            'aspect_name' => 'Perencanaan Strategis SPBE'
        ]);
        $aspect_three = Aspect::factory()->for($domain_two)
        ->create([
            'aspect_name' => 'Teknologi Informasi dan Komunikasi'
        ]);
        $aspect_four = Aspect::factory()->for($domain_two)
        ->create([
            'aspect_name' => 'Penyelenggara SPBE'
        ]);
        $aspect_five = Aspect::factory()->for($domain_three)
        ->create([
            'aspect_name' => 'Penerapan Manajemen SPBE'
        ]);
        $aspect_six = Aspect::factory()->for($domain_three)
        ->create([
            'aspect_name' => 'Audit TIK'
        ]);
        $aspect_seven = Aspect::factory()->for($domain_four)
        ->create([
            'aspect_name' => 'Layanan Administrasi Pemerintahan Berbasis Elektronik'
        ]);
        $aspect_eight = Aspect::factory()->for($domain_four)
        ->create([
            'aspect_name' => 'Layanan Publik Berbasis Elektronik'
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
        )->for($aspect_one)->for($form_score_one)->for($domain_one)->create();

        Indicator::factory()->count(5)->sequence(
            ['indicator_name' => 'Tingkat Kematangan Arsitektur SPBE Instansi Pusat/Pemerintah Daerah'],
            ['indicator_name' => 'Tingkat Kematangan Arsitektur SPBE Instansi Pusat/Pemerintah Daerah'],
            ['indicator_name' => 'Tingkat Kematangan Rencana dan Anggaran SPBE'],
            ['indicator_name' => 'Tingkat Kematangan Inovasi Proses Bisnis SPBE'],
            ['indicator_name' => 'Tingkat Kematangan Pembangunan Aplikasi SPBE'],
        )->for($aspect_two)->for($form_score_one)->for($domain_two)->create();

        Indicator::factory()->count(3)->sequence(
            ['indicator_name' => 'Tingkat Kematangan Layanan Pusat Data'],
            ['indicator_name' => 'Tingkat Kematangan Layanan Jaringan Intra Instansi Pusat/Pemerintah Daerah'],
            ['indicator_name' => 'Tingkat Kematangan Penggunaan Sistem Penghubung Layanan Instansi Pusat/Pemerintah Daerah'],
        )->for($aspect_three)->for($form_score_one)->for($domain_two)->create();

        Indicator::factory()->count(2)->sequence(
            ['indicator_name' => 'Tingkat Kematangan Tim Koordinasi SPBE Instansi Pusat/Pemerintah Daerah'],
            ['indicator_name' => 'Tingkat Kematangan Kolaborasi Penerapan SPBE'],
        )->for($aspect_four)->for($form_score_one)->for($domain_two)->create();

        Indicator::factory()->count(8)->sequence(
            ['indicator_name' => 'Tingkat Kematangan Penerapan Manajemen Risiko SPBE'],
            ['indicator_name' => 'Tingkat Kematangan Penerapan Manajemen Keamanan Informasi'],
            ['indicator_name' => 'Tingkat Kematangan Penerapan Manajemen Data'],
            ['indicator_name' => 'Tingkat Kematangan Penerapan Manajemen Aset TIK'],
            ['indicator_name' => 'Tingkat Kematangan Penerapan Kompetensi Sumber Daya Manusia'],
            ['indicator_name' => 'Tingkat Kematangan Penerapan Manajemen Pengetahuan'],
            ['indicator_name' => 'Tingkat Kematangan Penerapan Manajemen Perubahan'],
            ['indicator_name' => 'Tingkat Kematangan Penerapan Manajemen Layanan SPBE'],
        )->for($aspect_five)->for($form_score_one)->for($domain_three)->create();

        Indicator::factory()->count(3)->sequence(
            ['indicator_name' => 'Tingkat Kematangan Pelaksanaan Audit Infrastruktur SPBE'],
            ['indicator_name' => 'Tingkat Kematangan Pelaksanaan Audit Aplikasi SPBE'],
            ['indicator_name' => 'Tingkat Kematangan Pelaksanaan Audit Keamanan SPBE'],
        )->for($aspect_six)->for($form_score_one)->for($domain_three)->create();

        Indicator::factory()->count(10)->sequence(
            ['indicator_name' => 'Tingkat Kematangan Layanan Perencanaan'],
            ['indicator_name' => 'Tingkat Kematangan Layanan Penganggaran'],
            ['indicator_name' => 'Tingkat Kematangan Layanan Keuangan'],
            ['indicator_name' => 'Tingkat Kematangan Layanan Pengadaan Barang dan Jasa'],
            ['indicator_name' => 'Tingkat Kematangan Layanan Kepegawaian'],
            ['indicator_name' => 'Tingkat Kematangan Layanan Kearsipan Dinamis'],
            ['indicator_name' => 'Tingkat Kematangan Layanan Pengelolaan Barang Milik Negara / Daerah'],
            ['indicator_name' => 'Tingkat Kematangan Layanan Pengawasan Internal Pemerintah'],
            ['indicator_name' => 'Tingkat Kematangan Layanan Akuntabilitas Kinerja Organisasi'],
            ['indicator_name' => 'Tingkat Kematangan Layanan Kinerja Pegawai'],
        )->for($aspect_seven)->for($form_score_one)->for($domain_four)->create();

        Indicator::factory()->count(6)->sequence(
            ['indicator_name' => 'Tingkat Kematangan Layanan Pengaduan Pelayanan Publik'],
            ['indicator_name' => 'Tingkat Kematangan Layanan Data Terbuka'],
            ['indicator_name' => 'Tingkat Kematangan Layanan Jaringan Dokumentasi dan Informasi Hukum (JDIH)'],
            ['indicator_name' => 'Tingkat Kematangan Layanan Publik Sektor 1 (SIAPEL)'],
            ['indicator_name' => 'Tingkat Kematangan Layanan Publik Sektor 2 (JKN-CEKAT)'],
            ['indicator_name' => 'Tingkat Kematangan Layanan Publik Sektor 3 (E-BPHTB)'],
        )->for($aspect_eight)->for($form_score_one)->for($domain_four)->create();
    }
}
