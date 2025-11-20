<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\VitalSign;
use App\Models\Pemeriksaan;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Users
        $petugas = User::create([
            'name' => 'Budi Santoso',
            'email' => 'petugas@klinik.com',
            'password' => Hash::make('password'),
            'role' => 'petugas',
            'nip' => '19001',
            'phone' => '081234567890',
            'alamat' => 'Jl. Merdeka No. 123, Jakarta'
        ]);

        $perawat = User::create([
            'name' => 'Siti Nurhaliza, AMK',
            'email' => 'perawat@klinik.com',
            'password' => Hash::make('password'),
            'role' => 'perawat',
            'nip' => '19002',
            'phone' => '081234567891',
            'alamat' => 'Jl. Sudirman No. 45, Jakarta'
        ]);

        $dokter1 = User::create([
            'name' => 'Dr. Ahmad Hidayat, Sp.PD',
            'email' => 'dokter@klinik.com',
            'password' => Hash::make('password'),
            'role' => 'dokter',
            'nip' => '19003',
            'spesialis' => 'Penyakit Dalam',
            'phone' => '081234567892',
            'alamat' => 'Jl. Gatot Subroto No. 78, Jakarta'
        ]);

        $dokter2 = User::create([
            'name' => 'Dr. Sari Wulandari, Sp.A',
            'email' => 'dokter2@klinik.com',
            'password' => Hash::make('password'),
            'role' => 'dokter',
            'nip' => '19004',
            'spesialis' => 'Anak',
            'phone' => '081234567893',
            'alamat' => 'Jl. Thamrin No. 90, Jakarta'
        ]);

        // Create Sample Patients
        $pasien1 = Pasien::create([
            'no_ktp' => '3201011990010001',
            'nama_lengkap' => 'Joko Widodo',
            'tanggal_lahir' => '1990-01-15',
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Jl. Kebon Jeruk No. 12, RT 01/RW 02, Kebon Jeruk, Jakarta Barat',
            'no_telepon' => '081234560001',
            'email' => 'joko@email.com',
            'jenis_pasien' => 'BPJS',
            'no_bpjs' => '0001234567890',
            'golongan_darah' => 'A',
            'riwayat_alergi' => 'Alergi obat penisilin',
            'created_by' => $petugas->id
        ]);

        $pasien2 = Pasien::create([
            'no_ktp' => '3201012000020002',
            'nama_lengkap' => 'Ani Yudhoyono',
            'tanggal_lahir' => '2000-05-20',
            'jenis_kelamin' => 'Perempuan',
            'alamat' => 'Jl. Melati No. 34, RT 03/RW 05, Menteng, Jakarta Pusat',
            'no_telepon' => '081234560002',
            'email' => 'ani@email.com',
            'jenis_pasien' => 'Umum',
            'golongan_darah' => 'B',
            'created_by' => $petugas->id
        ]);

        $pasien3 = Pasien::create([
            'no_ktp' => '3201011985030003',
            'nama_lengkap' => 'Bambang Subianto',
            'tanggal_lahir' => '1985-03-10',
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Jl. Mawar No. 56, RT 02/RW 04, Kebayoran Baru, Jakarta Selatan',
            'no_telepon' => '081234560003',
            'email' => 'bambang@email.com',
            'jenis_pasien' => 'BPJS',
            'no_bpjs' => '0001234567891',
            'golongan_darah' => 'O',
            'riwayat_alergi' => 'Alergi makanan laut',
            'created_by' => $petugas->id
        ]);

        // Create Sample Registrations with Full Flow
        $poliklinik = ['Poli Umum', 'Poli Anak', 'Poli Gigi', 'Poli Mata', 'Poli Jantung'];

        // Registration 1 - Completed
        $pendaftaran1 = Pendaftaran::create([
            'pasien_id' => $pasien1->id,
            'tanggal_kunjungan' => Carbon::today(),
            'jam_kunjungan' => '08:00',
            'poliklinik' => 'Poli Umum',
            'dokter_id' => $dokter1->id,
            'keluhan' => 'Demam dan batuk sejak 3 hari yang lalu',
            'jenis_kunjungan' => 'Lama',
            'status' => 'Selesai',
            'petugas_id' => $petugas->id
        ]);

        VitalSign::create([
            'pendaftaran_id' => $pendaftaran1->id,
            'tekanan_darah' => '120/80',
            'nadi' => 80,
            'suhu' => 37.5,
            'pernapasan' => 20,
            'berat_badan' => 70,
            'tinggi_badan' => 170,
            'catatan' => 'Pasien dalam kondisi stabil',
            'perawat_id' => $perawat->id
        ]);

        Pemeriksaan::create([
            'pendaftaran_id' => $pendaftaran1->id,
            'anamnesis' => 'Pasien mengeluh demam tinggi sejak 3 hari yang lalu, disertai batuk berdahak dan pilek. Tidak ada mual atau muntah. Nafsu makan menurun.',
            'pemeriksaan_fisik' => 'Keadaan umum: compos mentis. Tenggorokan: hiperemis. Paru: ronkhi (+/+). Jantung: dalam batas normal.',
            'diagnosis_utama' => 'ISPA (Infeksi Saluran Pernapasan Akut)',
            'diagnosis_tambahan' => 'Faringitis akut',
            'tindakan' => 'Pemberian obat oral',
            'resep_obat' => "1. Paracetamol 500mg 3x1 tablet\n2. Amoxicillin 500mg 3x1 kapsul\n3. OBH Sirup 3x1 sendok makan",
            'catatan_dokter' => 'Pasien dianjurkan istirahat cukup, minum air putih minimal 2 liter/hari, dan hindari makanan berminyak.',
            'rencana_tindak_lanjut' => 'Kontrol',
            'tanggal_kontrol' => Carbon::today()->addDays(3),
            'dokter_id' => $dokter1->id
        ]);

        // Registration 2 - Waiting for Doctor
        $pendaftaran2 = Pendaftaran::create([
            'pasien_id' => $pasien2->id,
            'tanggal_kunjungan' => Carbon::today(),
            'jam_kunjungan' => '09:00',
            'poliklinik' => 'Poli Umum',
            'dokter_id' => $dokter1->id,
            'keluhan' => 'Sakit kepala dan pusing',
            'jenis_kunjungan' => 'Baru',
            'status' => 'Dipanggil',
            'petugas_id' => $petugas->id
        ]);

        VitalSign::create([
            'pendaftaran_id' => $pendaftaran2->id,
            'tekanan_darah' => '130/85',
            'nadi' => 75,
            'suhu' => 36.8,
            'pernapasan' => 18,
            'berat_badan' => 55,
            'tinggi_badan' => 160,
            'perawat_id' => $perawat->id
        ]);

        // Registration 3 - Waiting for Vital Signs
        Pendaftaran::create([
            'pasien_id' => $pasien3->id,
            'tanggal_kunjungan' => Carbon::today(),
            'jam_kunjungan' => '10:00',
            'poliklinik' => 'Poli Jantung',
            'dokter_id' => $dokter1->id,
            'keluhan' => 'Nyeri dada dan sesak napas',
            'jenis_kunjungan' => 'Lama',
            'status' => 'Menunggu',
            'petugas_id' => $petugas->id
        ]);

        // Additional registrations for statistics
        for ($i = 0; $i < 5; $i++) {
            $pendaftaran = Pendaftaran::create([
                'pasien_id' => $pasien1->id,
                'tanggal_kunjungan' => Carbon::today()->subDays(rand(1, 7)),
                'jam_kunjungan' => sprintf('%02d:00', rand(8, 16)),
                'poliklinik' => $poliklinik[array_rand($poliklinik)],
                'dokter_id' => rand(0, 1) ? $dokter1->id : $dokter2->id,
                'keluhan' => 'Keluhan pasien ' . ($i + 1),
                'jenis_kunjungan' => rand(0, 1) ? 'Baru' : 'Lama',
                'status' => 'Selesai',
                'petugas_id' => $petugas->id
            ]);

            VitalSign::create([
                'pendaftaran_id' => $pendaftaran->id,
                'tekanan_darah' => rand(110, 140) . '/' . rand(70, 90),
                'nadi' => rand(60, 100),
                'suhu' => 36 + (rand(0, 20) / 10),
                'pernapasan' => rand(16, 24),
                'berat_badan' => rand(50, 90),
                'tinggi_badan' => rand(150, 180),
                'perawat_id' => $perawat->id
            ]);

            Pemeriksaan::create([
                'pendaftaran_id' => $pendaftaran->id,
                'anamnesis' => 'Anamnesis untuk kunjungan ' . ($i + 1),
                'pemeriksaan_fisik' => 'Pemeriksaan fisik normal',
                'diagnosis_utama' => ['Hipertensi', 'Diabetes', 'ISPA', 'Gastritis', 'Vertigo'][rand(0, 4)],
                'tindakan' => 'Pemberian obat',
                'resep_obat' => 'Resep obat sesuai diagnosis',
                'rencana_tindak_lanjut' => 'Kontrol',
                'tanggal_kontrol' => Carbon::today()->addDays(rand(3, 14)),
                'dokter_id' => rand(0, 1) ? $dokter1->id : $dokter2->id
            ]);
        }

        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('');
        $this->command->info('Login Credentials:');
        $this->command->info('Petugas: petugas@klinik.com / password');
        $this->command->info('Perawat: perawat@klinik.com / password');
        $this->command->info('Dokter: dokter@klinik.com / password');
    }
}