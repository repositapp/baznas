<?php

namespace Database\Seeders;

use App\Models\Bansos;
use App\Models\Bansosdonatur;
use App\Models\Bansossaluran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BansosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bansosPrograms = [
            [
                'upz_id' => 1,
                'amil_id' => 1,
                'title' => 'Paket Logistik Keluarga',
                'slug' => 'paket-logistik-keluarga',
                'body' => '<p class="pg">Bantuan paket sembako dalam kemasan yang layak diberikan kepada mustahik untuk memenuhi kebutuhan pokok.</p>
                            <p class="pg"><strong>Tujuan</strong></p>
                            <ul class="dash">
                            <li class="pg">Terpenuhinya kebutuhan dasar mustahik</li>
                            <li class="pg">Meringankan beban mustahik karena harus membeli bahan makanan pokok</li>
                            <li class="pg">Mencegah mustahik kelaparan</li>
                            </ul>
                            <p class="pg"><strong>Sasaran</strong></p>
                            <ul class="dash">
                            <li class="pg">Disabilitas</li>
                            <li class="pg">Janda dan lansia</li>
                            <li class="pg">Guru mengaji muslim yang dhuafa</li>
                            <li class="pg">Orang yang terkena musibah bencana alam</li>
                            </ul>
                            <p class="pg"><strong>Asnaf</strong><br>Fakir-Miskin</p>',
                'range_start' => '2025-09-12',
                'range_end' => '2025-10-03',
                'jumlah_donasi' => 500000000,
                'image' => 'bansos-images/Paket-Logistik-Keluarga.jpg',
                'status' => 1,
            ],
            [
                'upz_id' => 1,
                'amil_id' => 1,
                'title' => 'Bank Makanan',
                'slug' => 'bank-makanan',
                'body' => '<p class="pg" style="text-align: justify;">Bantuan makanan siap saji bagi mustahik di wilayah kantong kemiskinan. Sumber penyediaan makanan bekerja sama dengan para pengusaha kuliner seperti restoran, hotel, catering maupun dikelola langsung oleh BAZNAS.</p>
                            <p class="pg" style="text-align: justify;"><strong>Tujuan</strong></p>
                            <ul class="dash" style="text-align: justify;">
                            <li class="pg">Tersedianya makanan yang sehat dan bergizi bagi mustahik</li>
                            <li class="pg">Mengurangi pengeluaran pembelian makanan bagi mustahik</li>
                            </ul>
                            <p class="pg" style="text-align: justify;"><strong>Sasaran</strong></p>
                            <ul class="dash" style="text-align: justify;">
                            <li class="pg">Pekerja harian</li>
                            <li class="pg">Keluarga pra sejahtera</li>
                            <li class="pg">Rumah singgah</li>
                            <li class="pg">Pesantren tradisional</li>
                            <li class="pg">Panti sosial Islam</li>
                            </ul>
                            <p class="pg" style="text-align: justify;"><strong>Asnaf</strong><br>Fakir-Miskin</p>',
                'range_start' => '2025-09-01',
                'range_end' => '2025-10-03',
                'jumlah_donasi' => 200000000,
                'image' => 'bansos-images/bank-makanan.jpg',
                'status' => 1,
            ],
            [
                'upz_id' => 1,
                'amil_id' => 1,
                'title' => 'Bantuan Sosial Kemanusiaan',
                'slug' => 'bantuan-sosial-kemanusiaan',
                'body' => '<p class="pg" style="text-align: justify;">Bantuan tunai bagi mustahik perorangan atau keluarga untuk memenuhi kebutuhan hidup selama satu bulan karena memiliki sumber mata pencaharian atau sudah tidak mampu bekerja.</p>
                            <p class="pg" style="text-align: justify;"><strong>Tujuan</strong></p>
                            <ul class="dash" style="text-align: justify;">
                            <li class="pg">Terpenuhinya kebutuhan dasar mustahik selama periode tertentu</li>
                            <li class="pg">Meringankan beban mustahik karena harus memikirkan kebutuhan biaya hidup</li>
                            <li class="pg">Mencegah mustahik kelaparan</li>
                            </ul>
                            <p class="pg" style="text-align: justify;"><strong>Sasaran</strong></p>
                            <ul class="dash" style="text-align: justify;">
                            <li class="pg">Disabilitas</li>
                            <li class="pg">Janda atau lansia</li>
                            <li class="pg">Orang yang tidak memiliki pekerjaan</li>
                            <li class="pg">Orang yang sedang berjuang dijalan Allah</li>
                            <li class="pg">Orang yang terkena musibah bencana alam</li>
                            </ul>
                            <p class="pg" style="text-align: justify;"><strong>Asnaf</strong><br>Fakir-Miskin</p>',
                'range_start' => '2025-09-02',
                'range_end' => '2025-10-04',
                'jumlah_donasi' => 314050000,
                'image' => 'bansos-images/bantuan-sosial-kemanusiaan.jpg',
                'status' => 1,
            ],
            [
                'upz_id' => 1,
                'amil_id' => 1,
                'title' => 'Bantuan Lembaga Sosial Islam',
                'slug' => 'program-takwa-dakwahadvokasi',
                'body' => '<h5 class="text-bold" style="text-align: justify;">SANTUNAN YATIM DAN DHUAFA</h5>
                            <p class="pg" style="text-align: justify;">Bantuan kontribusi kegiatan santunan yang dikelola oleh lembaga sosial islam atau ormas Islam.</p>
                            <p class="pg" style="text-align: justify;"><strong>Tujuan</strong></p>
                            <ul class="dash" style="text-align: justify;">
                            <li class="pg">Terselenggaranya kegiatan santunan</li>
                            <li class="pg">Terpenuhinya kebutuhan operasional peserta kegiatan santunan</li>
                            </ul>
                            <p class="pg" style="text-align: justify;"><strong>Sasaran</strong></p>
                            <ul class="dash" style="text-align: justify;">
                            <li class="pg">Yatim dan piatu</li>
                            <li class="pg">Dhuafa dan lansia</li>
                            <li class="pg">Disabilitas</li>
                            </ul>
                            <p class="pg" style="text-align: justify;"><strong>Asnaf</strong><br>Fakir-Miskin, Fii Sabilillah</p>',
                'range_start' => '2025-09-01',
                'range_end' => '2025-10-20',
                'jumlah_donasi' => 432200000,
                'image' => 'bansos-images/bantuan-lembaga-sosial-islam.jpg',
                'status' => 1,
            ],
            [
                'upz_id' => 1,
                'amil_id' => 1,
                'title' => 'Bantuan Penyandang Disabilitas',
                'slug' => 'bantuan-penyandang-disabilitas',
                'body' => '<p class="pg" style="text-align: justify;">Bantuan bagi lembaga sosial Islam yang membantu penyandang disabilitas atau bagi individu penyandang disabilitas berupa kaki palsu, kursi roda atau alat pendukung aktivitas lainnya.</p>
                            <p class="pg" style="text-align: justify;"><strong>Tujuan</strong></p>
                            <ul class="dash" style="text-align: justify;">
                            <li class="pg">Terbantunya mustahik disabilitas karena tersedianya alat bantu</li>
                            <li class="pg">Perekonomian mustahik disabilitas terbantu karena tidak perlu membeli alat</li>
                            </ul>
                            <p class="pg" style="text-align: justify;"><strong>Sasaran</strong></p>
                            <ul class="dash" style="text-align: justify;">
                            <li class="pg">Penyandang disabilitas</li>
                            </ul>
                            <p class="pg" style="text-align: justify;"><strong>Asnaf</strong><br>Fakir-Miskin</p>',
                'range_start' => '2025-09-02',
                'range_end' => '2025-10-18',
                'jumlah_donasi' => 156000000,
                'image' => 'bansos-images/bantuan-penyandang-disabilitas.jpg',
                'status' => 1,
            ],
            [
                'upz_id' => 1,
                'amil_id' => 1,
                'title' => 'Bantuan Rumah Layak Huni',
                'slug' => 'bantuan-rumah-layak-huni',
                'body' => '<p class="pg" style="text-align: justify;">Program renovasi rumah yang bekerja sama dengan Kementerian Pekerjaan Umum dan Perumahan Rakyat (PUPR) untuk memenuhi kebutuhan dasar mustahik berupa tempat tinggal yang layak, memenuhi persyaratan keselamatan bangunan dan kesehatan.</p>
                            <p class="pg" style="text-align: justify;"><strong>Tujuan</strong></p>
                            <ul class="dash" style="text-align: justify;">
                            <li class="pg">Meningkatkan kualitas tempat tinggal mustahik</li>
                            <li class="pg">Memberikan kenyamanan ibadah bagi mustahik</li>
                            <li class="pg">Mewujudkan hunian yang sehat</li>
                            </ul>
                            <p class="pg" style="text-align: justify;"><strong>Sasaran</strong></p>
                            <ul class="dash" style="text-align: justify;">
                            <li class="pg">Masyarakat berpenghasilan rendah</li>
                            </ul>
                            <p class="pg" style="text-align: justify;"><strong>Asnaf</strong><br>Fakir-Miskin</p>',
                'range_start' => '2025-09-01',
                'range_end' => '2025-11-14',
                'jumlah_donasi' => 300000000,
                'image' => 'bansos-images/bantuan-rumah-layak-huni.jpg',
                'status' => 1,
            ],
        ];

        foreach ($bansosPrograms as $data) {
            $bansos = Bansos::create([
                'upz_id' => 1,
                'amil_id' => 1,
                'title' => $data['title'],
                'slug' => $data['slug'],
                'body' => $data['body'],
                'range_start' => $data['range_start'],
                'range_end' => $data['range_end'],
                'jumlah_donasi' => $data['jumlah_donasi'],
                'image' => $data['image'],
                'status' => 1,
            ]);

            // Donatur (6–15)
            $donaturs = Bansosdonatur::factory(rand(15, 40))->create([
                'bansos_id' => $bansos->id,
            ]);

            $total_donasi = $donaturs->sum('nominal_donasi');
            $total_penyaluran = 0;
            $attempts = 0;
            $maxAttempts = 100;

            // Salurkan bansos hingga mendekati total donasi
            while ($total_penyaluran < $total_donasi && $attempts < $maxAttempts) {
                $nominal = rand(50000, 300000);

                // if ($total_penyaluran + $nominal > $total_donasi) break;
                if ($total_penyaluran + $nominal > $total_donasi) {
                    $nominal = $total_donasi - $total_penyaluran;
                }

                // Bansossaluran::factory()->create([
                //     'bansos_id' => $bansos->id,
                //     'total_nominal' => $nominal,
                // ]);

                Bansossaluran::create([
                    'bansos_id' => $bansos->id,
                    'title' => 'Penyaluran ' . $bansos->title . ' Tahap ' . ($attempts + 1),
                    'jumlah_penerima' => rand(5, 50),
                    'total_nominal' => $nominal,
                    'body' => '<p>Penyaluran tahap ' . ($attempts + 1) . ' dari program ' . $bansos->title . ' kepada penerima manfaat di Kabupaten Buton.</p>',
                ]);

                $total_penyaluran += $nominal;
                $attempts++;
            }
        }
    }
}
