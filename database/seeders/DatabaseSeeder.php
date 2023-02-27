<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $kandidat = [];
        
        $kandidat[0] = \App\Models\KandidatPemilihan::create([
            'kp_kode' => 'kp01',
            'kp_nama' => "Ir. H. JOKO WIDODO - KH. MA’RUF AMIN",
            'kp_partai' => 'PDI-P',
            'kp_foto_capres' => 'kandidat/1-small.jpeg',
            'kp_foto_cawapres' => 'kandidat/1-1-small.jpeg',
        ]);
        
        $kandidat[1] = \App\Models\KandidatPemilihan::create([
            'kp_kode' => 'kp02',
            'kp_nama' => "ANIES RASYID BASWEDAN - SANDIAGA SALAHUDDIN UNO",
            'kp_partai' => 'Nasdem',
            'kp_foto_capres' => 'kandidat/2-small.jpeg',
            'kp_foto_cawapres' => 'kandidat/2-1-small.png',
        ]);
        
        $kandidat[2] = \App\Models\KandidatPemilihan::create([
            'kp_kode' => 'kp03',
            'kp_nama' => "GANJAR PRANOWO - PRABOWO SUBIANTO",
            'kp_partai' => 'PDI-P',
            'kp_foto_capres' => 'kandidat/3-small.jpeg',
            'kp_foto_cawapres' => 'kandidat/3-1-small.jpeg',
        ]);

        $provinsi = [];

        $provinsi[0] = \App\Models\MasterProvinsi::create([
            'mp_kode' => 'dki',
            'mp_nama' => 'DKI JAKARTA',
        ]);

        $provinsi[1] = \App\Models\MasterProvinsi::create([
            'mp_kode' => 'diy',
            'mp_nama' => 'DI YOGYAKARTA',
        ]);

        $provinsi[2] = \App\Models\MasterProvinsi::create([
            'mp_kode' => 'btn',
            'mp_nama' => 'BANTEN',
        ]);

        for ($i = 1; $i <= 3; $i++) {
            \App\Models\ResumeTerkiniSeluruhIndonesia::create([
                'rtsi_kp_id' => $i,
                'rtsi_kp_kode' => $kandidat[$i - 1]['kp_kode'],
                'rtsi_jumlah_suara' => 0,
                'rtsi_bulan' => date('n'), // 1 - 12
                'rtsi_tahun' => date('Y'), // 2024
            ]);
        }

        for ($i = 1; $i <= 3; $i++) {
            \App\Models\ResumePerbulanSeluruhIndonesia::create([
                'rpsi_kp_id' => $i,
                'rpsi_kp_kode' => $kandidat[$i - 1]['kp_kode'],
                'rpsi_jumlah_suara' => 0,
                'rpsi_bulan' => date('n'), // 1 - 12
                'rpsi_tahun' => date('Y'), // 2024
            ]);
        }

        for ($i = 1; $i <= 3; $i++) {
            for ($j = 1; $j <= 3; $j++) {
                \App\Models\ResumeTerkiniProvinsi::create([
                    'rtp_kp_id' => $i,
                    'rtp_kp_kode' => $kandidat[$i - 1]['kp_kode'],
                    'rtp_mp_id' => $j,
                    'rtp_mp_kode' => $provinsi[$j - 1]['mp_kode'],
                    'rtp_jumlah_suara' => 0,
                    'rtp_bulan' => date('n'), // 1 - 12
                    'rtp_tahun' => date('Y'), // 2024
                ]);
            }
        }

        for ($i = 1; $i <= 3; $i++) {
            for ($j = 1; $j <= 3; $j++) {
                \App\Models\ResumePerbulanProvinsi::create([
                    'rpp_kp_id' => $i,
                    'rpp_kp_kode' => $kandidat[$i - 1]['kp_kode'],
                    'rpp_mp_id' => $j,
                    'rpp_mp_kode' => $provinsi[$j - 1]['mp_kode'],
                    'rpp_jumlah_suara' => 0,
                    'rpp_bulan' => date('n'), // 1 - 12
                    'rpp_tahun' => date('Y'), // 2024
                ]);
            }
        }

        \App\Models\User::create([
            'name' => 'Administrator',
            'avatar' => 'kandidat/1-small.jpeg',
            'email' => 'marinoimola@gmail.com',
            'password' => Hash::make('rahasia!'),
        ]);

        \App\Models\User::create([
            'name' => 'Marino Imola',
            'avatar' => 'kandidat/1-small.jpeg',
            'email' => 'marinoimola@yahoo.com',
            'password' => Hash::make('rahasia!'),
        ]);

        \App\Models\User::create([
            'name' => 'Bara Aksayeth',
            'avatar' => 'kandidat/1-small.jpeg',
            'email' => 'bara@lingkar9.com',
            'password' => Hash::make('rahasia!'),
        ]);

        \App\Models\User::create([
            'name' => 'Ahmad Bahtiarsyah',
            'avatar' => 'kandidat/1-small.jpeg',
            'email' => 'bahtiarsyah@lingkar9.com',
            'password' => Hash::make('admin123'),
        ]);

        \App\Models\User::create([
            'name' => 'Subhan Abdullah',
            'avatar' => 'kandidat/1-small.jpeg',
            'email' => 'subhan@lingkar9.com',
            'password' => Hash::make('admin123'),
        ]);

        \App\Models\User::create([
            'name' => 'Tito Shadam',
            'avatar' => 'kandidat/1-small.jpeg',
            'email' => 'tito@lingkar9.com',
            'password' => Hash::make('admin123'),
        ]);

        \App\Models\User::create([
            'name' => 'Cryan Fajri',
            'avatar' => 'kandidat/1-small.jpeg',
            'email' => 'cryan@rundeglobe.com',
            'password' => Hash::make('admin123'),
        ]);

        \App\Models\User::create([
            'name' => 'Virgianto Eko',
            'avatar' => 'kandidat/1-small.jpeg',
            'email' => 'eko@lingkar9.com',
            'password' => Hash::make('admin123'),
        ]);

        $roomIdAmMi = 'am-mi-' . date('ymd') . cetakStringAngkaAcak(3);

        \App\Models\Inbox::create([
            'in_id' => $roomIdAmMi,
            'in_last_message' => null,
            'in_last_message_time' => null,
            'in_last_sent_user_id' => null,
        ]);

        \App\Models\InboxParticipant::create([
            'ip_in_id' => $roomIdAmMi,
            'ip_user_id' => 1
        ]);

        \App\Models\InboxParticipant::create([
            'ip_in_id' => $roomIdAmMi,
            'ip_user_id' => 2
        ]);

        $roomIdAmMb = 'am-mb-' . date('ymd') . cetakStringAngkaAcak(3);

        \App\Models\Inbox::create([
            'in_id' => $roomIdAmMb,
            'in_last_message' => null,
            'in_last_message_time' => null,
            'in_last_sent_user_id' => null,
        ]);

        \App\Models\InboxParticipant::create([
            'ip_in_id' => $roomIdAmMb,
            'ip_user_id' => 1
        ]);

        \App\Models\InboxParticipant::create([
            'ip_in_id' => $roomIdAmMb,
            'ip_user_id' => 3
        ]);

        $roomIdMiMb = 'mi-mb-' . date('ymd') . cetakStringAngkaAcak(3);

        \App\Models\Inbox::create([
            'in_id' => $roomIdMiMb,
            'in_last_message' => null,
            'in_last_message_time' => null,
            'in_last_sent_user_id' => null,
        ]);

        \App\Models\InboxParticipant::create([
            'ip_in_id' => $roomIdMiMb,
            'ip_user_id' => 2
        ]);

        \App\Models\InboxParticipant::create([
            'ip_in_id' => $roomIdMiMb,
            'ip_user_id' => 3
        ]);

        $a = 'am-ab-' . date('ymd') . cetakStringAngkaAcak(3);

        \App\Models\Inbox::create([
            'in_id' => $a,
            'in_last_message' => null,
            'in_last_message_time' => null,
            'in_last_sent_user_id' => null,
        ]);

        \App\Models\InboxParticipant::create([
            'ip_in_id' => $a,
            'ip_user_id' => 1
        ]);

        \App\Models\InboxParticipant::create([
            'ip_in_id' => $a,
            'ip_user_id' => 4
        ]);

        $b = 'am-sa-' . date('ymd') . cetakStringAngkaAcak(3);

        \App\Models\Inbox::create([
            'in_id' => $b,
            'in_last_message' => null,
            'in_last_message_time' => null,
            'in_last_sent_user_id' => null,
        ]);

        \App\Models\InboxParticipant::create([
            'ip_in_id' => $b,
            'ip_user_id' => 1
        ]);

        \App\Models\InboxParticipant::create([
            'ip_in_id' => $b,
            'ip_user_id' => 5
        ]);

        $c = 'am-ts-' . date('ymd') . cetakStringAngkaAcak(3);

        \App\Models\Inbox::create([
            'in_id' => $c,
            'in_last_message' => null,
            'in_last_message_time' => null,
            'in_last_sent_user_id' => null,
        ]);

        \App\Models\InboxParticipant::create([
            'ip_in_id' => $c,
            'ip_user_id' => 1
        ]);

        \App\Models\InboxParticipant::create([
            'ip_in_id' => $c,
            'ip_user_id' => 6
        ]);

        $d = 'am-cf-' . date('ymd') . cetakStringAngkaAcak(3);

        \App\Models\Inbox::create([
            'in_id' => $d,
            'in_last_message' => null,
            'in_last_message_time' => null,
            'in_last_sent_user_id' => null,
        ]);

        \App\Models\InboxParticipant::create([
            'ip_in_id' => $d,
            'ip_user_id' => 1
        ]);

        \App\Models\InboxParticipant::create([
            'ip_in_id' => $d,
            'ip_user_id' => 7
        ]);

        $e = 'am-ve-' . date('ymd') . cetakStringAngkaAcak(3);

        \App\Models\Inbox::create([
            'in_id' => $e,
            'in_last_message' => null,
            'in_last_message_time' => null,
            'in_last_sent_user_id' => null,
        ]);

        \App\Models\InboxParticipant::create([
            'ip_in_id' => $e,
            'ip_user_id' => 1
        ]);

        \App\Models\InboxParticipant::create([
            'ip_in_id' => $e,
            'ip_user_id' => 8
        ]);
    }
}
