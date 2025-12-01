<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\Pemeriksaan;
use App\Models\User;
use App\Models\VitalSign;
use Carbon\Carbon;
use Faker\Factory as Faker;

class DiseaseSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Ensure we have a doctor and nurse
        $dokter = User::where('role', 'dokter')->first();
        if (!$dokter) {
            $dokter = User::create([
                'name' => 'Dr. Dummy',
                'email' => 'dokter.dummy@example.com',
                'password' => bcrypt('password'),
                'role' => 'dokter',
                'spesialis' => 'Umum'
            ]);
        }

        $perawat = User::where('role', 'perawat')->first();
        if (!$perawat) {
            $perawat = User::create([
                'name' => 'Ns. Dummy',
                'email' => 'perawat.dummy@example.com',
                'password' => bcrypt('password'),
                'role' => 'perawat'
            ]);
        }

        $petugas = User::where('role', 'petugas')->first();
        if (!$petugas) {
            $petugas = User::create([
                'name' => 'Petugas Dummy',
                'email' => 'petugas.dummy@example.com',
                'password' => bcrypt('password'),
                'role' => 'petugas'
            ]);
        }

        $diseases = [
            'Diabetes Melitus',
            'Hipertensi',
            'Penyakit Jantung Koroner',
            'Gagal Ginjal Kronis',
            'Kanker Payudara',
            'Tuberkulosis (TBC)',
            'Demam Berdarah Dengue',
            'Influenza',
            'Gastritis',
            'Asma Bronkial'
        ];

        // Create 5 cases for each disease
        foreach ($diseases as $disease) {
            for ($i = 0; $i < rand(3, 8); $i++) {
                // 1. Create Pasien
                $pasien = Pasien::create([
                    'no_rm' => 'RM' . $faker->unique()->numerify('######'),
                    'no_ktp' => $faker->unique()->numerify('################'),
                    'nama_lengkap' => $faker->name,
                    'tanggal_lahir' => $faker->date('Y-m-d', '2000-01-01'),
                    'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                    'alamat' => $faker->address,
                    'no_telepon' => $faker->phoneNumber,
                    'jenis_pasien' => 'Umum',
                    'created_by' => $petugas->id
                ]);

                // 2. Create Pendaftaran
                $pendaftaran = Pendaftaran::create([
                    'no_antrian' => 'POL' . date('dmy') . $faker->unique()->numerify('###'),
                    'pasien_id' => $pasien->id,
                    'tanggal_kunjungan' => Carbon::now()->subDays(rand(0, 30)), // Random date within last 30 days
                    'jam_kunjungan' => $faker->time('H:i'),
                    'poliklinik' => 'Poli Umum',
                    'dokter_id' => $dokter->id,
                    'perawat_id' => $perawat->id,
                    'petugas_id' => $petugas->id,
                    'keluhan' => 'Keluhan terkait ' . $disease,
                    'jenis_kunjungan' => 'Baru',
                    'status' => 'Selesai'
                ]);

                // 3. Create Vital Sign
                VitalSign::create([
                    'pendaftaran_id' => $pendaftaran->id,
                    'tekanan_darah' => '120/80',
                    'nadi' => 80,
                    'suhu' => 36.5,
                    'pernapasan' => 20,
                    'berat_badan' => 60,
                    'tinggi_badan' => 170,
                    'perawat_id' => $perawat->id
                ]);

                // 4. Create Pemeriksaan
                Pemeriksaan::create([
                    'pendaftaran_id' => $pendaftaran->id,
                    'dokter_id' => $dokter->id,
                    'anamnesis' => 'Pasien mengeluh gejala ' . $disease,
                    'pemeriksaan_fisik' => 'Kondisi umum baik',
                    'diagnosis_utama' => $disease,
                    'tindakan' => 'Pemberian obat',
                    'rencana_tindak_lanjut' => 'Pulang'
                ]);
            }
        }
    }
}
