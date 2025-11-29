<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Akunbank;
use App\Models\Amil;
use App\Models\Aplikasi;
use App\Models\Artikel;
use App\Models\Golongan;
use App\Models\Halaman;
use App\Models\Kategori;
use App\Models\Kategoriupz;
use App\Models\Laporan;
use App\Models\Menu;
use App\Models\Mustahik;
use App\Models\Muzaki;
use App\Models\Pembayaran;
use App\Models\Penyaluran;
use App\Models\Upz;
use App\Models\User;
use App\Models\Zakat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@themesbrand.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'avatar' => 'users-images/1J7iwiUja9gMqtHL7eIzR6RbaH0rrzZ5buklDQLy.png',
            'role' => 'admin',
            'status' => '1',
            'created_at' => now(),
        ]);
        User::updateOrCreate([
            'name' => 'Petugas Baznas',
            'username' => 'petugas_baznas',
            'email' => 'baznas@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'avatar' => 'users-images/1J7iwiUja9gMqtHL7eIzR6RbaH0rrzZ5buklDQLy.png',
            'role' => 'petugas_baznas',
            'status' => '1',
            'created_at' => now(),
        ]);
        User::updateOrCreate([
            'name' => 'Petugas UPZ',
            'username' => 'petugas_upz',
            'email' => 'upz@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'avatar' => 'users-images/1J7iwiUja9gMqtHL7eIzR6RbaH0rrzZ5buklDQLy.png',
            'role' => 'petugas_upz',
            'status' => '1',
            'created_at' => now(),
        ]);
        // User::factory(100)->create();

        Kategoriupz::updateOrCreate([
            'name' => 'Baznas',
            'slug' => 'baznas',
        ]);
        Kategoriupz::updateOrCreate([
            'name' => 'UPZ Masjid',
            'slug' => 'upz-masjid',
        ]);
        Kategoriupz::updateOrCreate([
            'name' => 'UPZ Perguruan Tinggi',
            'slug' => 'upz-perguruan-tinggi',
        ]);
        Kategoriupz::updateOrCreate([
            'name' => 'UPZ Instansi Pemerintah',
            'slug' => 'upz-instansi-pemerintah',
        ]);
        Kategoriupz::updateOrCreate([
            'name' => 'UPZ BUMN',
            'slug' => 'upz-bumn',
        ]);
        Kategoriupz::updateOrCreate([
            'name' => 'UPZ Perusahaan Swasta',
            'slug' => 'upz-perusahaan-swasta',
        ]);

        Kategori::create([
            'name' => 'Artikel',
            'slug' => 'artikel',
        ]);
        Kategori::create([
            'name' => 'Cerita Aksi',
            'slug' => 'cerita-aksi',
        ]);

        Upz::updateOrCreate([
            'kategoriupz_id' => 1,
            'nama_upz' => 'Baznas Kabupaten Buton',
            'npwp' => '827491028403000',
            'no_pengukuhan' => '02391029382',
            'tgl_pengukuhan' => now(),
            'alamat' => 'Jl. Moh. Husni Thamrin No.18, Wale, Kec. Wolio, Kota Bau-Bau, Sulawesi Tenggara 93717',
            'telepon' => '0401-221522',
            'fax' => '0401-221522',
            'email' => 'baznasButon@gmail.com',
        ]);
        Upz::updateOrCreate([
            'kategoriupz_id' => 2,
            'nama_upz' => 'Masjid Al-Ikhlas',
            'npwp' => '007491028403000',
            'no_pengukuhan' => '02391029382',
            'tgl_pengukuhan' => now(),
            'alamat' => 'Jl. Example',
            'telepon' => '0401-775566',
            'fax' => '0401-775566',
            'email' => 'example@gmail.com',
        ]);
        Upz::factory(30)->create();

        Amil::updateOrCreate([
            'user_id' => 1,
            'upz_id' => 1,
            'nama' => 'Marta Andika',
            'nik' => '7472020000000000',
            'tempat_lahir' => 'Buton',
            'tanggal_lahir' => '1990-05-01',
            'jenis_kelamin' => 'Laki-Laki',
            'pekerjaan' => 'Administrator Baznas',
            'alamat_kantor' => 'Jl. Moh. Husni Thamrin No.18, Wale, Kec. Wolio, Kota Bau-Bau',
            'alamat_rumah' => 'Jl. Erlangga, No.45',
            'telepon' => '081222452210',
        ]);
        Amil::updateOrCreate([
            'user_id' => 2,
            'upz_id' => 1,
            'nama' => 'Adnan Pratama',
            'nik' => '7472000000000000',
            'tempat_lahir' => 'Buton',
            'tanggal_lahir' => '1992-03-01',
            'jenis_kelamin' => 'Laki-Laki',
            'pekerjaan' => 'Petugas',
            'alamat_kantor' => 'Jl. Moh. Husni Thamrin No.18, Wale, Kec. Wolio, Kota Bau-Bau',
            'alamat_rumah' => 'Jl. Bataraguru No.56',
            'telepon' => '081244852201',
        ]);
        Amil::updateOrCreate([
            'user_id' => 3,
            'upz_id' => 2,
            'nama' => 'Saiful Permata',
            'nik' => '7472000000000000',
            'tempat_lahir' => 'Buton',
            'tanggal_lahir' => '1994-03-01',
            'jenis_kelamin' => 'Laki-Laki',
            'pekerjaan' => 'Wiraswasta',
            'alamat_kantor' => 'Jl. Example',
            'alamat_rumah' => 'Jl. Example',
            'telepon' => '082244547787',
        ]);

        Golongan::updateOrCreate([
            'name' => 'Fakir',
            'slug' => 'fakir',
        ]);
        Golongan::updateOrCreate([
            'name' => 'Miskin',
            'slug' => 'miskin',
        ]);
        Golongan::updateOrCreate([
            'name' => 'Amil',
            'slug' => 'amil',
        ]);
        Golongan::updateOrCreate([
            'name' => 'Mualaf',
            'slug' => 'mualaf',
        ]);
        Golongan::updateOrCreate([
            'name' => 'Riqab',
            'slug' => 'riqab',
        ]);
        Golongan::updateOrCreate([
            'name' => 'Gharim',
            'slug' => 'gharim',
        ]);
        Golongan::updateOrCreate([
            'name' => 'Fii Sabilillah',
            'slug' => 'fii-sabilillah',
        ]);
        Golongan::updateOrCreate([
            'name' => 'Ibnu Sabil',
            'slug' => 'ibnu-sabil',
        ]);

        Muzaki::factory(200)->create();
        Mustahik::factory(200)->create();

        Zakat::updateOrCreate([
            'nama_sumbangan' => 'Zakat Fitrah',
            'jenis_benda' => 'Beras',
            'nilai_ukuran' => '2.5',
        ]);
        Zakat::updateOrCreate([
            'nama_sumbangan' => 'Zakat Fitrah',
            'jenis_benda' => 'Uang',
            'nilai_ukuran' => '45000',
        ]);
        Zakat::updateOrCreate([
            'nama_sumbangan' => 'Zakat Harta',
            'jenis_benda' => 'Uang',
            'nilai_ukuran' => '2.5',
        ]);
        Zakat::updateOrCreate([
            'nama_sumbangan' => 'Zakat Simpanan',
            'jenis_benda' => 'Uang',
            'nilai_ukuran' => '2.5',
        ]);
        Zakat::updateOrCreate([
            'nama_sumbangan' => 'Zakat Profesi',
            'jenis_benda' => 'Uang',
            'nilai_ukuran' => '2.5',
        ]);
        Zakat::updateOrCreate([
            'nama_sumbangan' => 'Zakat Perdagangan',
            'jenis_benda' => 'Uang',
            'nilai_ukuran' => '2.5',
        ]);
        Zakat::updateOrCreate([
            'nama_sumbangan' => 'Infaq',
            'jenis_benda' => 'Uang',
            'nilai_ukuran' => '0',
        ]);

        Pembayaran::factory(200)->create();
        // Penyaluran::factory(50)->create();

        Akunbank::updateOrCreate([
            'nama_bank' => 'BANK MUAMALAT',
            'rekening' => '8230006721',
            'pemilik' => 'BAZNAS Kabupaten Buton',
            'logo_bank' => 'bank-logos/bank-muamalat.png',
        ]);
        Akunbank::updateOrCreate([
            'nama_bank' => 'BANK BSI',
            'rekening' => '7186456976',
            'pemilik' => 'BAZNAS Kabupaten Buton',
            'logo_bank' => 'bank-logos/bank-bsi.png',
        ]);

        Aplikasi::updateOrCreate([
            'nama_lembaga' => 'Badan Amil Zakat Nasional (BAZNAS) Kabupaten Buton',
            'telepon' => '085339068784',
            'fax' => '0401-221522',
            'email' => 'baznasButon@gmail.com',
            'alamat' => 'Jl. Poros Pasar Wajo Wabula, Dongkala, Kec. Ps. Wajo, Kabupaten Buton, Sulawesi Tenggara 93754',
            'maps' => '<iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3971.3500339627703!2d122.87051107572371!3d-5.514955804870647!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1stakawa!5e0!3m2!1sid!2sid!4v1764172797527!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
            'nama_ketua' => 'Punardin, S.Ag',
            'sidebar_lg' => 'BAZNAS BUTON',
            'sidebar_mini' => 'BAZ',
            'title_header' => 'Sistem Informasi BAZNAS Kabupaten Buton',
            'logo' => 'aplikasi-images/baznas.png',
        ]);

        Artikel::updateOrCreate([
            'kategori_id' => 1,
            'user_id' => 1,
            'judul' => 'Pengumuman Pendaftaran Calon Pimpinan Badan Amil Zakat Nasional Provinsi Jawa Barat Periode 2025 - 2030',
            'slug' => 'pengumuman-pendaftaran-calon-pimpinan-badan-amil-zakat-nasional-provinsi-jawa-barat-periode-2025-2030',
            'kutipan' => 'Persyaratan Adminstrasi&nbsp;

                            Warga Negara Indonesia
                            Beragama Islam
                            Bertakwa kepada Allah SWT
                            Berakhlak mulia
                            Berusia minimal 40 tahun per tanggal 31 Agustus 2025
                            Sehat Jasmani Rohani
                            Tidak m...',
            'body' => '<h2>Persyaratan Adminstrasi&nbsp;</h2>
                        <ol>
                        <li>Warga Negara Indonesia</li>
                        <li>Beragama Islam</li>
                        <li>Bertakwa kepada Allah SWT</li>
                        <li>Berakhlak mulia</li>
                        <li>Berusia minimal 40 tahun per tanggal 31 Agustus 2025</li>
                        <li>Sehat Jasmani Rohani</li>
                        <li>Tidak menjadi anggota partai politik</li>
                        <li>Tidak terlibat dalam kegiatan politik praktis</li>
                        <li>Memiliki kompetensi di bidang Pengelolaan Zakat</li>
                        <li>Bersedia untuk bekerja penuh waktu</li>
                        <li>Tidak pernah dijatuhi pidana penjara yang telah memiliki kekuatan hukum tetap atau inkrah</li>
                        <li>Tidak merangkap jabatan sebagai pengurus dan/atau pegawai pengelola zakat lain</li>
                        </ol>
                        <h2>Persyaratan Khusus&nbsp;</h2>
                        <ol>
                        <li>Daftar Riwayat Hidup</li>
                        <li>Kartu Tanda Penduduk/KTP</li>
                        <li>Kartu Nomor Pokok Wajib Pajak/NPWP</li>
                        <li>Pas Foto Peserta berwarna terbaru (Latar Merah)</li>
                        <li>Ijazah terakhir yang di legalisir</li>
                        <li>Salinan Laporan Harta Kekayaan Penyelenggara Negara (LHKPN) paling singkat Dua tahun terakhir</li>
                        <li>Salinan Laporan Harta Kekayaan Aparatur Sipil Negara (LHKASN) paling singkat Dua tahun terakhir</li>
                        <li>Surat Keterangan Sehat Jasmani dan Rohani dari RS pemerintah</li>
                        <li>Surat Rekomendasi dari MUI atau Ormas Islam, Organisasi Profesi atau Kementerian/Lembaga</li>
                        <li>Surat Pernyataan</li>
                        </ol>',
            'gambar' => 'artikel-images/pengumuman-pendaftaran-calon-pimpinan-badan-amil-zakat-nasional-provinsi-jawa-barat-periode-2025-2030.png',
            'views' => 8,
            'status' => 1,
        ]);
        Artikel::updateOrCreate([
            'kategori_id' => 1,
            'user_id' => 1,
            'judul' => 'Mana yang harus di dahulukan kurban atau aqiqah ?',
            'slug' => 'mana-yang-harus-di-dahulukan-kurban-atau-aqiqah',
            'kutipan' => 'Antara aqiqah dan kurban ada persamaan, yakni sama-sama sunah. Hal ini menurut mazhab Syafii (selama tidak nadzar), serta adanya aktivitas penyembelihan terhadap hewan yang telah memenuhi syarat untuk...',
            'body' => '<p>Antara aqiqah dan kurban ada persamaan, yakni sama-sama sunah. Hal ini menurut mazhab Syafii (selama tidak nadzar), serta adanya aktivitas penyembelihan terhadap hewan yang telah memenuhi syarat untuk dipotong. Sementara perbedaan yang ada di antara keduanya lebih pada waktu pelaksanaannya.&nbsp;</p>
                        <h2>Makna Kurban dalam Islam</h2>
                        <p>Sebagai wujud ketaatan dan upaya meraih pahala, umat Islam melaksanakan ibadah kurban secara berjamaah pada Hari Raya Idul Adha, yang jatuh pada 10 Dzulhijjah 1444 H. Meskipun hukumnya sunnah, ibadah kurban sangat dianjurkan bagi umat Islam. Ibadah ini dilakukan dengan menyembelih hewan ternak sebagai bentuk rasa syukur atas nikmat dari Allah SWT serta sebagai bentuk ketaatan seorang hamba kepada Sang Pencipta.</p>
                        <h2>Mana yang harus di dahulukan Kurban atau Akikah?&nbsp;</h2>
                        <p>Para ulama memberi kelonggaran pelaksanaan aqiqah oleh orang tua hingga si bayi tumbuh sampai dengan baligh. Meski begitu lebih baik jika dilaksanakannya tujuh hari setelah kelahiran si bayi.&nbsp; Setelah baligh, anjuran aqiqah tidak lagi dibebankan kepada orang tua melainkan diserahkan kepada sang anak untuk melaksanakan sendiri atau meninggalkannya.&nbsp;</p>
                        <p>Dalam hal ini tentunya melaksanakan aqiqah sendiri lebih baik daripada tidak melaksanakanya.&nbsp; &nbsp;Lantas manakah yang didahulukan antara kurban dan aqiqah? Jawabannya adalah tergantung momentum serta situasi dan kondisi. Apabila mendekati hari raya Idul Adha seperti sekarang ini, maka mendahulukan kurban adalah lebih baik daripada malaksanakan aqiqah.</p>
                        <h2>Bolehkah Kurban Dilakukan Sebelum Aqiqah?</h2>
                        <p>lalu Pertanyaan yang kerap muncul di kalangan umat Islam adalah: bagaimana jika seseorang ingin berkurban, namun belum melaksanakan aqiqah?</p>
                        <p>Jawabannya, diperbolehkan. Sebab, aqiqah dan kurban adalah dua ibadah yang berbeda baik dari segi makna maupun tujuan. Aqiqah merupakan bentuk rasa syukur orang tua atas kelahiran anak yang diwujudkan melalui penyembelihan hewan. Sementara itu, kurban adalah ibadah penyembelihan hewan yang dilakukan semata-mata karena Allah SWT pada waktu tertentu, yaitu saat Idul Adha.</p>
                        <h3>Syarat Seseorang Boleh Melaksanakan Kurban:</h3>
                        <p><strong>1. Beragama Islam</strong></p>
                        <p>Pelaksana kurban haruslah seorang Muslim yang mengikuti ajaran Islam.</p>
                        <p><strong>2. Berakal sehat, sudah baligh, dan merdeka</strong></p>
                        <p>Orang tersebut harus dewasa, memiliki akal sehat, serta bukan budak. Ia harus memahami makna kurban dan mampu bertanggung jawab atas ibadahnya.</p>
                        <p><strong>3. Mampu secara finansial</strong></p>
                        <p>Pelaku kurban harus memiliki kemampuan ekonomi yang memadai. Ukuran &lsquo;mampu&rsquo; ini bisa berbeda tergantung kondisi ekonomi masyarakat setempat.</p>
                        <p>Kesimpulannya, aqiqah bukan syarat sah untuk berkurban. Jadi, seseorang tetap diperbolehkan berkurban meskipun belum melaksanakan aqiqah.</p>',
            'gambar' => 'artikel-images/mana-yang-harus-di-dahulukan-kurban-atau-aqiqah.png',
            'views' => 8,
            'status' => 1,
        ]);
        Artikel::updateOrCreate([
            'kategori_id' => 1,
            'user_id' => 1,
            'judul' => 'Jaga Amalan Setelah Bulan Ramadhan Menjaga Api Iman Tetap Menyala',
            'slug' => 'jaga-amalan-setelah-bulan-ramadhan-menjaga-api-iman-tetap-menyala',
            'kutipan' => 'Ramadhan adalah bulan pendidikan. Ia mengajarkan kita sabar, ikhlas, kedisiplinan, serta kepekaan sosial. Namun, yang lebih penting dari itu semua adalah: apakah nilai-nilai itu tetap hidup setelah Ra...',
            'body' => '<p>Ramadhan adalah bulan pendidikan. Ia mengajarkan kita sabar, ikhlas, kedisiplinan, serta kepekaan sosial. Namun, yang lebih penting dari itu semua adalah: apakah nilai-nilai itu tetap hidup setelah Ramadhan berlalu?</p>
                        <p>Banyak orang beribadah maksimal selama Ramadhan, tapi kembali "normal" begitu Syawal datang. Padahal, tanda diterimanya Ramadhan adalah meningkatnya amal setelahnya.</p>
                        <p>Berikut beberapa amalan penting yang bisa kita jaga sebagai bukti bahwa Ramadhan benar-benar membekas dalam diri:</p>
                        <h2>1. Puasa Sunnah Syawal</h2>
                        <p>Rasulullah SAW bersabda:</p>
                        <p><em>&ldquo;Barangsiapa berpuasa Ramadhan kemudian diikuti dengan enam hari di bulan Syawal, maka ia seperti berpuasa sepanjang tahun.&rdquo; (HR. Muslim)</em></p>
                        <p>Puasa 6 hari di bulan Syawal adalah momentum memperpanjang keberkahan Ramadhan. Bisa dilakukan berurutan atau terpisah, yang penting masih di bulan Syawal.</p>
                        <h2>2. Tilawah dan Tadabbur Al-Qur&rsquo;an</h2>
                        <p>Jika selama Ramadhan kita bisa khatam 1&ndash;2 kali, mengapa setelahnya tidak dijadikan kebiasaan? Tetaplah dekat dengan Al-Qur&rsquo;an, meskipun hanya 1 halaman per hari. Lebih baik konsisten kecil daripada semangat di awal lalu hilang.</p>
                        <h2>3. Sedekah Rutin</h2>
                        <p>Ramadhan mendidik kita untuk peduli. Maka pertahankan semangat memberi! Mulai dari hal kecil: sedekah subuh, bantu tetangga, atau ikut program donasi. Jadikan sedekah sebagai gaya hidup, bukan musiman.</p>
                        <h2>4. Shalat Malam &amp; Dhuha</h2>
                        <p>Tahajud dan dhuha bisa menjadi sarana mendekatkan diri kepada Allah setelah Ramadhan. Jika qiyamul lail saat Ramadhan bisa dilakukan hampir setiap malam, pertahankan minimal 1&ndash;2 kali sepekan di luar Ramadhan.</p>
                        <h2>5. Silaturahmi &amp; Memperbaiki Hubungan</h2>
                        <p>Syawal adalah bulan saling memaafkan. Jangan biarkan dendam memutus ukhuwah. Sambung kembali silaturahmi yang sempat renggang. Maaf yang ikhlas adalah bentuk ibadah hati.</p>
                        <p>Ramadhan boleh berlalu, tapi semangatnya jangan ikut pergi. Jadikan Ramadhan sebagai titik balik, bukan titik singgah. Karena pemenang sejati bukan yang hanya kuat di bulan Ramadhan, tapi yang tetap istiqamah setelahnya.</p>
                        <p><em>&ldquo;Di antara tanda amal diterima adalah amal tersebut dilanjutkan dengan amal shalih lainnya.&rdquo;</em>&nbsp;&ndash; Ibnu Rajab Al-Hanbali</p>
                        <p>Yuk, lanjutkan semangat kebaikan dengan sedekah rutin!</p>
                        <p>Sedekah yang kamu lakukan hari ini bisa menjadi jembatan pahala untuk hari esok.&nbsp;Klik sekarang dan salurkan infak terbaikmu melalui BAZNAS Jabar</p>',
            'gambar' => 'artikel-images/jaga-amalan-setelah-bulan-ramadhan-menjaga-api-iman-tetap-menyala.png',
            'views' => 8,
            'status' => 1,
        ]);
        Artikel::updateOrCreate([
            'kategori_id' => 1,
            'user_id' => 1,
            'judul' => 'Ghibah sebagai Penggugur Pahala Berpuasa',
            'slug' => 'ghibah-sebagai-penggugur-pahala-berpuasa',
            'kutipan' => 'Puasa di bulan Ramadan merupakan salah satu ibadah wajib bagi umat Islam yang bertujuan untuk meningkatkan ketakwaan. Namun, ada berbagai hal yang dapat mengurangi atau bahkan menggugurkan pahala puas...',
            'body' => '<p class="MsoNormal">Puasa di bulan Ramadan merupakan salah satu ibadah wajib bagi umat Islam yang bertujuan untuk meningkatkan ketakwaan. Namun, ada berbagai hal yang dapat mengurangi atau bahkan menggugurkan pahala puasa, salah satunya adalah&nbsp;<strong>ghibah</strong><strong>.</strong>&nbsp;Ghibah atau menggunjing orang lain dikecam dalam Islam karena dapat merusak hubungan sosial dan mengotori hati.</p>
                        <h2><strong>Definisi Ghibah dalam Islam</strong></h2>
                        <p class="MsoNormal">Secara bahasa,&nbsp;<strong>ghibah</strong>&nbsp;berarti menyebutkan keburukan seseorang yang jika ia mendengarnya, ia akan merasa tidak senang. Rasulullah&nbsp;<span dir="RTL" lang="AR-SA">ﷺ</span>&nbsp;menjelaskan dalam sebuah hadits:</p>
                        <p class="MsoNormal"><em>&ldquo;Tahukah kalian apa itu ghibah? Mereka menjawab, &lsquo;Allah dan Rasul-Nya lebih mengetahui.&rsquo; Beliau berkata, &lsquo;Yaitu engkau menyebut saudaramu dengan sesuatu yang ia benci.&rsquo; Seseorang bertanya, &lsquo;Bagaimana jika yang aku katakan itu benar?&rsquo; Rasulullah&nbsp;</em><em><span dir="RTL" lang="AR-SA">ﷺ</span>&nbsp;menjawab, &lsquo;Jika benar, berarti engkau telah menggunjingnya, dan jika tidak benar, maka engkau telah memfitnahnya.&rsquo;&rdquo;</em>&nbsp;(HR. Muslim No. 2589)</p>
                        <p class="MsoNormal">Berdasarkan kesepakan ulama ghibah bahkan hukumnya diharamkan, Rasulullah juga menyamakan ghibah dengan sama saja memakan daging saudara sendiri yang telah mati. Artinya itu adalah hal yang menjijikan.</p>
                        <p class="MsoNormal">Perlu kita waspadai jika Ghibah mencakup berbagai bentuk, baik dalam lisan maupun tulisan. Meski kita tidak membicarakan secara lisan namun menggunakan tulisan atau hate comment di sosial media juga bisa termasuk kedalam ghibah.</p>
                        <h2><strong>Hukum Ghibah saat Berpuasa</strong></h2>
                        <p class="MsoNormal">Sudah jelas kita ketahui jika mekakukan ghibah saat tidak berpuasa saja dilarang lalu bagaimana jika saat berpuasa? Apakah akan membatalkan puasa?</p>
                        <p class="MsoNormal">Pada dasarnya puasa bukan hanya sekadar menahan lapar dan dahaga, tetapi juga menahan diri dari segala bentuk perbuatan yang bisa mengurangi nilai ibadah tersebut. Setidaknya ada lima hal yang dapat mengugurkan pahala puasa berdasarkan hadist rasulullah</p>
                        <p class="MsoNormal"><em>&ldquo;Diriwayatkan dari Anas ra, Rasulullah saw. bersabda : Ada lima perbuatan yang menghapus pahala puasa, yaitu : berbohong, menggunjing, mengadu orang, bersumpah palsu dan memandang lain jenis dengan syahwat&rdquo;.</em></p>
                        <div>Ghibah atau menggunjing termasuk dalam kategori perbuatan buruk yang bisa&nbsp;<strong>menghilangkan pahala puasa</strong>. Sehingga, meskipun seseorang tetap menahan diri dari makan dan minum, namun jika ia tidak menjaga lisannya dari ghibah, puasanya menjadi sia-sia. Namun tidak membatalakn puasanya, artinya puasanya tetap sah.</div>
                        <p class="MsoNormal">Hal ini dijelaskan oleh Imam An-Nawawi (wafat 676 H), dalam kitabnya Al-Majmu&rsquo; Syarhul&nbsp;Muhaddzab: &nbsp;</p>
                        <p class="MsoNormal"><em>&ldquo;Apabila seseorang melakukan ghibah saat puasa, maka ia berdosa dan tidak batal puasanya menurut pandangan kita (mazhab Syafi&rsquo;i), hal ini juga selaras dengan yang dikemukakan oleh mazhab Maliki, Hanafi dan Hanbali. Kecuali menurut pandangan Imam Al-Auza&rsquo;i,menurutnya puasa batal disebabkan perbuatan ghibah dan wajib untuk diqadha.&rdquo;</em></p>
                        <p class="MsoNormal">(Muhyiddin Yahya bin Syaraf An-Nawawi, Al-Majmu&rsquo; Syarhul&nbsp;Muhaddzab, [Beirut: Dar Al-Fikr], juz VI, halaman 356).&nbsp; &nbsp;</p>
                        <p class="MsoNormal">Pendapat yang dilontarkan oleh An-Nawawi ini kemudian didukung dengan pernyataan Syekh Sa&rsquo;id bin Muhammad Baisyan (wafat 1270 H) dalam kitabnya: &nbsp;</p>
                        <p class="MsoNormal" align="right">&nbsp;<span dir="RTL" lang="AR-SA">فَإِذَا اغْتَابَ مَثَلًا حَصَلَ عَلَيْهِ إِثْمُ الْغِيْبَةِ لِذَاتِهَا، وَبَطَلَ ثَوَابُ الصَّوْمِ لَا الصَّوْمُ بِمُخَالَفَةِ الْأَمْرِ الْمَنْدُوْبِ بِتَنْزِيْهِ الصَّوْمِ عَنْهَا، كَمَا دَلَّتْ عَلَيْهِ الْأَحَادِيْثُ، وَنَصَّ عَلَيْهِ الشَّافِعِي وَالْأَصْحَابُ</span>&nbsp;&nbsp;</p>
                        <p class="MsoNormal">&nbsp;Artinya:&nbsp;<em>&ldquo;Apabila seseorang menggunjing (semisal), maka otomatis hasil dosa menggunjing dan pahala puasanya batal. Namun tidak dengan puasanya,&nbsp;sebab hanya menyimpang dari perkara sunah dimana dianjurkan agar menghindarkan puasa dari hal-hal itu (menggunjing), sebagaimana pemahaman beberapa hadits dan telah dijelaskan oleh Imam Asy-Syafi&rsquo;i dan Ashabnya.&rdquo;&nbsp;</em>(Said bin Muhammad Baisyan, Busyral&nbsp;Karim bi Syarhi Masailit&nbsp;Ta&rsquo;lim, [Jeddah: Dar Al-Minhaj], halaman 565).&nbsp;</p>
                        <p class="MsoNormal">Berdasarkan refrensi diatas maka Ghibah menurut tinjauan fiqih dalam kondisi puasa,&nbsp;hukum puasanya tetap sah, hanya saja ia tidak memperoleh pahala ibadah puasa. Oleh karena itu, umat Muslim harus menjaga lisan dan tulisan dalam bentuk kebencian ataupun membuat hoax, terutama saat berpuasa, agar ibadahnya benar-benar diterima oleh Allah SWT.</p>
                        <p class="MsoNormal">Apabila&nbsp;<strong>tidak sengaja melakukan ghibah saat berpuasa,</strong> segera istighfar. Kemudian berjanji untuk tidak mengulanginya, dan jika memungkinkan meminta maaf kepada orang yang telah dibicarakan. Kita juga perlu menjaga lingkungan kita dengan menghindari perkumpulan yang sering membicarakan orang lain, karena dosanya tetap sama meski kita hanya mendengarkan ghibah tanpa menegur atau menghindarinya.</p>',
            'gambar' => 'artikel-images/ghibah-sebagai-penggugur-pahala-berpuasa.png',
            'views' => 8,
            'status' => 1,
        ]);
        Artikel::updateOrCreate([
            'kategori_id' => 2,
            'user_id' => 1,
            'judul' => 'BAZNAS RI Berikan Bantuan Pemulihan Psikososial dan Program Padat Karya bagi 33.000 Warga Gaza di Palestina',
            'slug' => 'baznas-ri-berikan-bantuan-pemulihan-psikososial-dan-program-padat-karya-bagi-33000-warga-gaza-di-palestina',
            'kutipan' => 'Badan Amil Zakat Nasional (BAZNAS) RI menyalurkan bantuan kemanusiaan sebesar Rp7 miliar melalui Badan PBB untuk Pengungsi Palestina (UNRWA) yang difokuskan pada program pemulihan psikososial dan prog...',
            'body' => '<p>Badan Amil Zakat Nasional (BAZNAS) RI menyalurkan bantuan kemanusiaan sebesar Rp7 miliar melalui Badan PBB untuk Pengungsi Palestina (UNRWA) yang difokuskan pada program pemulihan psikososial dan program padat karya bagi 33.000 anak-anak dan warga Palestina yang terdampak konflik di Jalur Gaza.</p>
                        <p>Bantuan tersebut digunakan untuk mendanai operasional 50 konselor yang akan memberikan layanan psikososial di beberapa titik pengungsian di Gaza selama 6 bulan ke depan. Program ini ditargetkan menjangkau 15.000 anak-anak dan 15.000 orang yang mengalami trauma akibat konflik berkepanjangan. BAZNAS juga memberikan bantuan program padat karya (Cash For Work) bagi 3.000 pengungsi Palestina di Gaza.&nbsp;</p>
                        <p>Ketua BAZNAS RI, Prof. Dr. KH. Noor Achmad, MA., menyatakan, BAZNAS RI berkomitmen untuk menjadi jembatan amanah antara masyarakat Indonesia dan warga Palestina.</p>
                        <p>"BAZNAS berkomitmen untuk menjadi jembatan amanah antara masyarakat Indonesia dan saudara-saudara kita di Palestina. Melalui kerja sama dengan UNRWA, kami berharap bantuan ini dapat meringankan beban psikologis yang dialami oleh para pengungsi, terutama anak-anak yang sangat rentan terhadap dampak trauma," ujar Kiai Noor dalam keterangannya di Jakarta, Rabu (7/5/2025).</p>
                        <p>Kiai Noor menyampaikan, penyaluran bantuan ini merupakan bagian dari komitmen BAZNAS RI menyalurkan bantuan sebesar Rp7 miliar melalui UNRWA untuk memastikan bantuan dari masyarakat Indonesia dapat tersalurkan secara tepat sasaran dan efektif.</p>
                        <p>"UNRWA merupakan mitra yang sangat layak untuk dititipkan dana bantuan dari para donatur masyarakat Indonesia, karena lembaga ini memiliki kredibilitas dan profesionalisme tinggi dalam menangani pengungsi Palestina," ucap Kiai Noor.</p>
                        <p>&ldquo;Dengan adanya bantuan ini, kami berharap dapat memberikan kontribusi nyata dalam meringankan penderitaan rakyat Palestina dan memperkuat solidaritas antara masyarakat Indonesia dan Palestina,&rdquo; kata Kiai Noor.</p>
                        <p>Sebagai lembaga pengelola zakat resmi di Indonesia, Kiai Noor menyatakan BAZNAS terus berupaya memaksimalkan manfaat zakat, infak, dan sedekah agar dapat membantu masyarakat yang membutuhkan, baik di dalam negeri maupun luar negeri.</p>
                        <p>"Kami mengajak seluruh masyarakat Indonesia untuk terus menyalurkan zakat, infak, dan sedekahnya melalui BAZNAS. Dengan bersinergi bersama, kita bisa memberikan lebih banyak manfaat dan harapan bagi mereka yang membutuhkan," tutup Kiai Noor.</p>',
            'gambar' => 'artikel-images/baznas-ri-berikan-bantuan-pemulihan-psikososial-dan-program-padat-karya-bagi-33000-warga-gaza-di-palestina.png',
            'views' => 8,
            'status' => 1,
        ]);
        Artikel::updateOrCreate([
            'kategori_id' => 2,
            'user_id' => 1,
            'judul' => 'Dorong Kemandirian Petani, BAZNAS RI Launching Lumbung Pangan ke-8',
            'slug' => 'dorong-kemandirian-petani-baznas-ri-launching-lumbung-pangan-ke-8',
            'kutipan' => 'Badan Amil Zakat Nasional (BAZNAS) RI menggelar panen raya padi bersama para petani binaan Program Lumbung Pangan di Desa Cilapar, Kecamatan Kaligondang, Kabupaten Purbalingga, pada Senin (5/5/2025)....',
            'body' => '<p class="MsoNormal">Badan Amil Zakat Nasional (BAZNAS) RI menggelar panen raya padi bersama para petani binaan Program Lumbung Pangan di Desa Cilapar, Kecamatan Kaligondang, Kabupaten Purbalingga, pada Senin (5/5/2025). Panen dilakukan di lahan seluas 150 hektare yang dikelola oleh 250 petani mustahik binaan BAZNAS.</p>
                        <p class="MsoNormal">Kegiatan ini dihadiri oleh Pimpinan BAZNAS RI, Kolonel Caj (Purn.) Drs. Nur Chamdani, Deputi 2 BAZNAS RI Dr. H. M. Imdadun Rahmat, serta pejabat dari Kementerian Pertanian, Wakil Bupati Purbalingga, dan berbagai tokoh daerah. Dalam kesempatan ini, dilakukan pula penyerahan simbolis bantuan 10 unit hand tractor dari Kementan RI guna mendukung peningkatan produktivitas petani.</p>
                        <p class="MsoNormal">Nur Chamdani menyampaikan bahwa Program Lumbung Pangan merupakan komitmen nyata BAZNAS dalam mendorong ketahanan pangan, mengentaskan kemiskinan, dan memperkuat ekonomi umat. Program ini menjadi bagian dari upaya berkelanjutan BAZNAS dalam pemberdayaan ekonomi mustahik melalui sektor pertanian berbasis agribisnis.</p>
                        <p class="MsoNormal">Kegiatan ini mendapat dukungan penuh dari Pemerintah Kabupaten Purbalingga, Kementan RI, dan BULOG yang turut melakukan pembelian hasil panen. Program ini diharapkan menjadi model pemberdayaan yang berkelanjutan dan dapat direplikasi di daerah lain demi mendukung kesejahteraan petani lokal secara nasional.</p>',
            'gambar' => 'artikel-images/dorong-kemandirian-petani-baznas-ri-launching-lumbung-pangan-ke-8.png',
            'views' => 8,
            'status' => 1,
        ]);
        Artikel::updateOrCreate([
            'kategori_id' => 2,
            'user_id' => 1,
            'judul' => 'BAZNAS RI Fasilitasi Mudik Gratis bagi 850 Guru Ngaji dan Marbot Masjid',
            'slug' => 'baznas-ri-fasilitasi-mudik-gratis-bagi-850-guru-ngaji-dan-marbot-masjid',
            'kutipan' => 'Badan Amil Zakat Nasional (BAZNAS) RI kembali menyelenggarakan program mudik gratis bagi masyarakat kurang mampu. Tahun ini, sebanyak 850 peserta yang terdiri dari marbot masjid, guru ngaji, pendakwah...',
            'body' => '<p>Badan Amil Zakat Nasional (BAZNAS) RI kembali menyelenggarakan program mudik gratis bagi masyarakat kurang mampu. Tahun ini, sebanyak 850 peserta yang terdiri dari marbot masjid, guru ngaji, pendakwah, serta pekerja sektor informal diberangkatkan dari Gedung BAZNAS RI, Jakarta, pada Rabu (26/3/2025).</p>
                        <p>Sebanyak 17 bus telah disiapkan untuk mengantar para pemudik menuju kampung halaman mereka melalui dua rute utama, yaitu jalur pantai utara dan jalur selatan. Kota tujuan dalam program ini mencakup 26 wilayah di Provinsi Jawa Tengah, Jawa Timur, dan Daerah Istimewa Yogyakarta.</p>
                        <p>Program Mudik Bahagia Bersama BAZNAS ini terselenggara berkat dukungan dari sejumlah mitra, di antaranya Paragon Corp, Wafello, Sucofindo, MERDEKA Copper Gold, Asuransi Jiwa Syariah, Wipol, dan Smart Finance.</p>
                        <p>Ketua BAZNAS RI, Prof. Dr. KH. Noor Achmad, MA, memimpin langsung pelepasan para peserta mudik bersama sejumlah pejabat dari BAZNAS dan mitra korporasi, termasuk Wakil Ketua BAZNAS RI Mokhamad Mahdum, SE, MIDEc, Ak, CA, CPA, CWM., serta perwakilan dari PT Smart Finance, Asuransi Jiwa Syariah, Unilever Indonesia Wipol, dan PT Paragon Technology and Innovation.</p>
                        <p>Dalam sambutannya, Prof. Dr. KH. Noor Achmad, MA, menegaskan bahwa program ini merupakan bagian dari upaya BAZNAS untuk membantu para Ibnu Sabil agar dapat berkumpul dengan keluarga mereka saat Lebaran.</p>
                        <p>&ldquo;Alhamdulillah, pada Lebaran tahun ini, BAZNAS tetap konsisten dalam memfasilitasi para Ibnu Sabil agar dapat bertemu dan bersilaturahmi dengan keluarga di kampung halaman," ujar Kiai Noor.</p>
                        <p>Guna menjamin kenyamanan dan keamanan peserta selama perjalanan, BAZNAS turut menghadirkan tim dari BAZNAS Tanggap Bencana (BTB) serta tenaga medis dari Rumah Sehat BAZNAS (RSB).</p>',
            'gambar' => 'artikel-images/baznas-ri-fasilitasi-mudik-gratis-bagi-850-guru-ngaji-dan-marbot-masjid.png',
            'views' => 8,
            'status' => 1,
        ]);
        Artikel::updateOrCreate([
            'kategori_id' => 2,
            'user_id' => 1,
            'judul' => 'Mudah, Cepat, dan Berdampak: Bayar Zakat Melalui BAZNAS',
            'slug' => 'mudah-cepat-dan-berdampak-bayar-zakat-melalui-baznas',
            'kutipan' => 'Badan Amil Zakat Nasional (BAZNAS) RI mengajak masyarakat untuk menunaikan Zakat, Infak, dan Sedekah (ZIS) melalui lembaga resmi seperti BAZNAS. Dengan sistem pembayaran digital yang cepat dan mudah,...',
            'body' => '<p class="MsoNormal">Badan Amil Zakat Nasional (BAZNAS) RI mengajak masyarakat untuk menunaikan Zakat, Infak, dan Sedekah (ZIS) melalui lembaga resmi seperti BAZNAS. Dengan sistem pembayaran digital yang cepat dan mudah, BAZNAS memastikan bahwa dana ZIS sampai pada penerima yang tepat, khususnya di daerah-daerah terpencil, terluar, dan terpinggirkan.</p>
                        <p class="MsoNormal">Pimpinan BAZNAS RI Bidang Pengumpulan, Rizaludin Kurniawan, M.Si., menekankan bahwa sebagai lembaga yang berwenang dalam pengelolaan zakat nasional, BAZNAS terus berinovasi untuk meningkatkan pelayanan dan memberikan kemudahan bagi para muzaki.</p>
                        <p class="MsoNormal">&ldquo;Pembayaran zakat di BAZNAS kini semakin cepat dengan sistem berbasis digital, lebih mudah karena telah bekerja sama dengan ratusan kanal pembayaran, baik digital maupun non-digital, serta berdampak karena perubahan pada mustahik dapat diukur secara jelas,&rdquo; ujar Rizaludin dalam acara Pesantren Kilat Ramadhan by Narasi di Convention Hall Smesco Indonesia, Jakarta, belum lama ini.</p>
                        <p class="MsoNormal">"Cukup kunjungi website resmi baznas.go.id atau gunakan berbagai platform pembayaran online yang bermitra dengan BAZNAS, masyarakat bisa menunaikan zakat dengan mudah dan cepat. BAZNAS juga menyediakan fitur kalkulator zakat untuk membantu perhitungan zakat secara lebih mudah dan akurat," jelasnya.</p>
                        <p class="MsoNormal">Lebih lanjut, Rizaludin mengatakan bahwa menyalurkan zakat melalui lembaga resmi bukan hanya soal efisiensi, tetapi juga sejalan dengan ajaran agama yang sudah diterapkan sejak zaman Rasulullah SAW.</p>
                        <p class="MsoNormal">&ldquo;Sejak perintah zakat diturunkan pada tahun kedua Hijriyah, Rasulullah SAW langsung membentuk lembaga amil zakat untuk mengelola dan menyalurkan zakat dengan baik,&rdquo; ujarnya.</p>
                        <p class="MsoNormal">Menurutnya, penyaluran zakat secara mandiri berisiko menimbulkan riya (pamer) dan bisa kurang tepat sasaran. Oleh karena itu, dibutuhkan sistem pengelolaan profesional agar manfaat zakat dapat lebih luas dan berkelanjutan.</p>
                        <p class="MsoNormal">&ldquo;Zakat adalah instrumen pemerataan ekonomi yang membutuhkan tata kelola yang transparan dan akuntabel,&rdquo; tambahnya.</p>
                        <p class="MsoNormal">Selain memberikan bantuan langsung, BAZNAS juga melakukan pendampingan kepada penerima manfaat agar mereka bisa menjadi lebih mandiri secara ekonomi. Program-program yang dirancang tidak hanya berfokus pada konsumsi, tetapi juga pada pemberdayaan.</p>
                        <p class="MsoNormal">&ldquo;Kami ingin zakat menjadi instrumen pengentasan kemiskinan yang berkelanjutan. Oleh karena itu, BAZNAS memiliki berbagai program pemberdayaan, seperti beasiswa pendidikan, bantuan biaya kelulusan, Program Rumah Layak Huni, serta distribusi sembako dan kebutuhan pokok bagi masyarakat kurang mampu,&rdquo; jelas Rizaludin.</p>',
            'gambar' => 'artikel-images/mudah-cepat-dan-berdampak-bayar-zakat-melalui-baznas.png',
            'views' => 8,
            'status' => 1,
        ]);
        // Artikel::factory(100)->create();

        Halaman::create([
            'user_id' => 1,
            'judul' => 'Tentang Badan Amil Zakat Nasional',
            'slug' => 'tentang-badan-amil-zakat-nasional',
            'konten' => '<p style="text-align: justify;" data-start="297" data-end="805">BAZNAS (Badan Amil Zakat Nasional) Kabupaten Buton merupakan lembaga pemerintah nonstruktural yang memiliki wewenang untuk mengelola zakat, infak, dan sedekah (ZIS) serta dana sosial keagamaan lainnya secara profesional, amanah, dan sesuai dengan prinsip-prinsip syariat Islam. Sebagai lembaga yang telah diakui keberadaannya melalui regulasi nasional, BAZNAS hadir untuk menjembatani antara muzakki (pemberi zakat) dan mustahik (penerima zakat) dalam upaya mewujudkan keadilan sosial dan pengentasan kemiskinan.</p>
                <p style="text-align: justify;" data-start="807" data-end="1276">Keberadaan BAZNAS Kabupaten Buton sangat strategis dalam memperkuat peran sosial umat Islam, khususnya dalam konteks pemerataan ekonomi dan penanggulangan kemiskinan yang masih menjadi tantangan di berbagai daerah. Dengan wilayah geografis yang cukup luas dan beragam latar belakang masyarakat, lembaga ini tidak hanya berperan sebagai penghimpun dana zakat, infak, dan sedekah, tetapi juga sebagai pelaksana program pemberdayaan masyarakat yang inklusif dan berkelanjutan.</p>
                <p style="text-align: justify;" data-start="1278" data-end="1788">Dalam pelaksanaan tugasnya, BAZNAS Kabupaten Buton mengelola dana zakat yang dihimpun dari berbagai sumber, baik perorangan, ASN, perusahaan, maupun lembaga-lembaga lain yang memiliki kepedulian sosial. Dana yang terhimpun tersebut selanjutnya disalurkan melalui berbagai program pendistribusian dan pendayagunaan, seperti bantuan sembako untuk dhuafa, beasiswa pendidikan bagi siswa kurang mampu, bantuan modal usaha untuk pelaku UMKM, pelatihan keterampilan kerja, santunan kesehatan, dan penanggulangan bencana.</p>
                <p style="text-align: justify;" data-start="1790" data-end="2222">Salah satu kekuatan BAZNAS terletak pada prinsip transparansi dan akuntabilitas yang diterapkan dalam setiap proses pengelolaan dana. Setiap penerimaan dan penyaluran dicatat dan dilaporkan secara berkala, baik kepada pemerintah maupun kepada publik. Hal ini bertujuan untuk menjaga kepercayaan masyarakat serta memastikan bahwa dana yang disalurkan benar-benar sampai kepada yang berhak menerimanya sesuai dengan ketentuan syariah.</p>
                <p style="text-align: justify;" data-start="2224" data-end="2853">Seiring dengan perkembangan teknologi informasi, BAZNAS Kabupaten Buton juga mulai berinovasi dengan memanfaatkan sistem digital untuk mendukung proses penghimpunan dan distribusi dana zakat. Digitalisasi ini diwujudkan dalam bentuk sistem informasi zakat berbasis web atau aplikasi online yang memungkinkan masyarakat untuk menyalurkan zakat, melihat laporan penggunaan dana, dan memantau program-program BAZNAS secara langsung melalui perangkat digital. Dengan penerapan sistem ini, proses administrasi menjadi lebih efisien, distribusi lebih cepat dan tepat sasaran, serta pelaporan lebih transparan dan mudah diakses oleh publik.</p>
                <p style="text-align: justify;" data-start="2855" data-end="3201">Selain itu, BAZNAS juga berperan sebagai mitra strategis pemerintah daerah dalam merancang program-program sosial berbasis data kemiskinan lokal. Melalui kolaborasi ini, berbagai intervensi sosial yang dilakukan BAZNAS menjadi lebih terintegrasi dengan program pembangunan daerah, sehingga menciptakan sinergi yang berdampak luas bagi masyarakat.</p>
                <p style="text-align: justify;" data-start="3203" data-end="3678">Secara keseluruhan, peran BAZNAS Kabupaten Buton sangat penting dalam sistem kesejahteraan sosial di daerah. Tidak hanya sebagai lembaga penyalur zakat, tetapi juga sebagai pendorong perubahan sosial, pemberdaya ekonomi umat, dan pelindung hak-hak kelompok rentan. Dengan pengelolaan yang baik, dukungan masyarakat, serta integrasi teknologi informasi, BAZNAS diharapkan mampu menjadi motor penggerak dalam membangun masyarakat yang lebih sejahtera, adil, dan berkeadilan sosial.</p>
                <h4 data-start="1650" data-end="1694"><strong data-start="1655" data-end="1694">Program Unggulan BAZNAS Kabupaten Buton</strong></h4>
                <p data-start="1696" data-end="1750">Beberapa program unggulan yang dijalankan antara lain:</p>
                <ol data-start="1752" data-end="2282">
                <li data-start="1752" data-end="1857">
                <p data-start="1755" data-end="1857"><strong data-start="1755" data-end="1771">Buton Sehat</strong>: Bantuan kesehatan untuk fakir miskin, pembiayaan pengobatan, dan bantuan alat bantu.</p>
                </li>
                <li data-start="1858" data-end="1964">
                <p data-start="1861" data-end="1964"><strong data-start="1861" data-end="1878">Buton Cerdas</strong>: Beasiswa pendidikan bagi siswa miskin dan berprestasi, bantuan perlengkapan sekolah.</p>
                </li>
                <li data-start="1965" data-end="2076">
                <p data-start="1968" data-end="2076"><strong data-start="1968" data-end="1988">Buton Sejahtera</strong>: Program pemberdayaan ekonomi untuk mustahik melalui bantuan modal usaha dan pelatihan.</p>
                </li>
                <li data-start="2077" data-end="2176">
                <p data-start="2080" data-end="2176"><strong data-start="2080" data-end="2097">Buton Peduli</strong>: Respon cepat terhadap bencana alam dan bantuan sosial bagi masyarakat rentan.</p>
                </li>
                <li data-start="2177" data-end="2282">
                <p data-start="2180" data-end="2282"><strong data-start="2180" data-end="2196">Buton Taqwa</strong>: Program dakwah, pembinaan mualaf, dan pembagian Al-Qur&rsquo;an serta perlengkapan ibadah.</p>
                </li>
                </ol>',
            'status' => 1,
        ]);
        Halaman::create([
            'user_id' => 1,
            'judul' => 'Visi Misi',
            'slug' => 'visi-misi',
            'konten' => '<h3 data-start="266" data-end="278"><strong>Visi</strong></h3>
                            <p data-start="280" data-end="390">&ldquo;Zakat, Infaq dan Sadaqahku untuk kesejahteraan umat.&rdquo;</p>
                            <h3 data-start="934" data-end="946"><strong data-start="938" data-end="946">Misi</strong></h3>
                            <ol>
                            <li data-start="951" data-end="1059">Menggairahkan umat islam Kabupaten Buton untuk membayar ZIS.</li>
                            <li data-start="1060" data-end="1165">
                            <p data-start="1063" data-end="1165">Mengembangkan dan meningkatkan kualitas manajemen zakat yang profesional, amanah, efektif dan akuntabel.</p>
                            </li>
                            <li data-start="1166" data-end="1278">
                            <p data-start="1169" data-end="1278">Meninggkatkan jumlah muzakki dan mengurangi jumlah mustahik.</p>
                            </li>
                            <li data-start="1279" data-end="1384">
                            <p data-start="1282" data-end="1384">Mengoptimalkan pemberdayaan zakat bagi peningkatan kualitas dan taraf hidup masyarakat mustahik.</p>
                            </li>
                            </ol>',
            'status' => 1,
        ]);
        Halaman::create([
            'user_id' => 1,
            'judul' => 'Struktur Organisasi',
            'slug' => 'struktur-organisasi',
            'konten' => '<h3 data-start="880" data-end="925"><strong data-start="884" data-end="925"><img style="display: block; margin-left: auto; margin-right: auto;" src="/storage/photos/1/ChatGPT Image 1 Jul 2025, 13.53.13.png" alt="" width="821" height="821"></strong></h3>
                        <h3 data-start="880" data-end="925"><strong data-start="884" data-end="925">Uraian Tugas dan Fungsi Tiap Jabatan:</strong></h3>
                        <h4 data-start="927" data-end="944"><strong data-start="932" data-end="944">1. Ketua</strong></h4>
                        <ul data-start="945" data-end="1135">
                        <li data-start="945" data-end="1009">
                        <p data-start="947" data-end="1009">Memimpin pelaksanaan program dan kebijakan BAZNAS Kabupaten Buton.</p>
                        </li>
                        <li data-start="1010" data-end="1066">
                        <p data-start="1012" data-end="1066">Mengkoordinasikan seluruh wakil ketua dan sekretariat.</p>
                        </li>
                        <li data-start="1067" data-end="1135">
                        <p data-start="1069" data-end="1135">Menjalin kemitraan dengan pemerintah, swasta, dan lembaga lainnya.</p>
                        </li>
                        </ul>
                        <h4 data-start="1137" data-end="1183"><strong data-start="1142" data-end="1183">2. Wakil Ketua I (Bidang Pengumpulan)</strong></h4>
                        <ul data-start="1184" data-end="1434">
                        <li data-start="1184" data-end="1305">
                        <p data-start="1186" data-end="1305">Bertanggung jawab atas perencanaan dan pelaksanaan program penghimpunan zakat, infak, sedekah, dan dana sosial lainnya.</p>
                        </li>
                        <li data-start="1306" data-end="1377">
                        <p data-start="1308" data-end="1377">Membina Unit Pengumpul Zakat (UPZ) di instansi atau wilayah tertentu.</p>
                        </li>
                        <li data-start="1378" data-end="1434">
                        <p data-start="1380" data-end="1434">Menyusun strategi sosialisasi zakat kepada masyarakat.</p>
                        </li>
                        </ul>
                        <h4 data-start="1436" data-end="1503"><strong data-start="1441" data-end="1503">3. Wakil Ketua II (Bidang Pendistribusian &amp; Pendayagunaan)</strong></h4>
                        <ul data-start="1504" data-end="1708">
                        <li data-start="1504" data-end="1602">
                        <p data-start="1506" data-end="1602">Merancang dan melaksanakan program pendistribusian dan pendayagunaan dana zakat kepada mustahik.</p>
                        </li>
                        <li data-start="1603" data-end="1653">
                        <p data-start="1605" data-end="1653">Mengawasi penyaluran bantuan agar tepat sasaran.</p>
                        </li>
                        <li data-start="1654" data-end="1708">
                        <p data-start="1656" data-end="1708">Menyusun laporan realisasi distribusi dan dampaknya.</p>
                        </li>
                        </ul>
                        <h4 data-start="1710" data-end="1783"><strong data-start="1715" data-end="1783">4. Wakil Ketua III (Bidang Perencanaan, Keuangan, dan Pelaporan)</strong></h4>
                        <ul data-start="1784" data-end="2031">
                        <li data-start="1784" data-end="1901">
                        <p data-start="1786" data-end="1901">Bertanggung jawab atas penyusunan anggaran, pencatatan keuangan, serta pelaporan penggunaan dana secara transparan.</p>
                        </li>
                        <li data-start="1902" data-end="1977">
                        <p data-start="1904" data-end="1977">Menyusun rencana kerja tahunan dan laporan akuntabilitas kinerja lembaga.</p>
                        </li>
                        <li data-start="1978" data-end="2031">
                        <p data-start="1980" data-end="2031">Menjamin akurasi dan akuntabilitas keuangan BAZNAS.</p>
                        </li>
                        </ul>
                        <h4 data-start="2033" data-end="2056"><strong data-start="2038" data-end="2056">5. Sekretariat</strong></h4>
                        <ul data-start="2057" data-end="2274">
                        <li data-start="2057" data-end="2104">
                        <p data-start="2059" data-end="2104">Menjalankan fungsi administrasi umum lembaga.</p>
                        </li>
                        <li data-start="2105" data-end="2194">
                        <p data-start="2107" data-end="2194">Mendukung semua aktivitas kelembagaan, termasuk kepegawaian, arsip, dan surat-menyurat.</p>
                        </li>
                        <li data-start="2195" data-end="2274">
                        <p data-start="2197" data-end="2274">Bertugas sebagai penghubung antarbidang dalam pelaksanaan operasional harian.</p>
                        </li>
                        </ul>
                        <h4 data-start="2276" data-end="2299"><strong data-start="2281" data-end="2299">6. Bagian Umum</strong></h4>
                        <ul data-start="2300" data-end="2433">
                        <li data-start="2300" data-end="2364">
                        <p data-start="2302" data-end="2364">Mengelola perlengkapan, logistik, dan pengelolaan aset BAZNAS.</p>
                        </li>
                        <li data-start="2365" data-end="2433">
                        <p data-start="2367" data-end="2433">Mengatur penyelenggaraan rapat, kegiatan, dan dokumentasi lembaga.</p>
                        </li>
                        </ul>
                        <h4 data-start="2435" data-end="2462"><strong data-start="2440" data-end="2462">7. Bagian Keuangan</strong></h4>
                        <ul data-start="2463" data-end="2593">
                        <li data-start="2463" data-end="2507">
                        <p data-start="2465" data-end="2507">Mencatat dan memproses transaksi keuangan.</p>
                        </li>
                        <li data-start="2508" data-end="2543">
                        <p data-start="2510" data-end="2543">Membuat laporan keuangan berkala.</p>
                        </li>
                        <li data-start="2544" data-end="2593">
                        <p data-start="2546" data-end="2593">Menjaga keamanan dan ketepatan pembukuan zakat.</p>
                        </li>
                        </ul>
                        <h4 data-start="2595" data-end="2645"><strong data-start="2600" data-end="2645">8. Bagian Teknologi Informasi &amp; Pelaporan</strong></h4>
                        <ul data-start="2646" data-end="2846">
                        <li data-start="2646" data-end="2702">
                        <p data-start="2648" data-end="2702">Mengelola sistem informasi zakat berbasis digital/web.</p>
                        </li>
                        <li data-start="2703" data-end="2775">
                        <p data-start="2705" data-end="2775">Menyediakan data dan laporan yang dibutuhkan oleh pimpinan dan publik.</p>
                        </li>
                        <li data-start="2776" data-end="2846">
                        <p data-start="2778" data-end="2846">Meningkatkan layanan digital kepada masyarakat muzakki dan mustahik.</p>
                        </li>
                        </ul>
                        <h4 data-start="2848" data-end="2886"><strong data-start="2853" data-end="2886">9. Unit Pengumpul Zakat (UPZ)</strong></h4>
                        <ul data-start="2887" data-end="3093">
                        <li data-start="2887" data-end="2971">
                        <p data-start="2889" data-end="2971">Berfungsi sebagai perpanjangan tangan BAZNAS di instansi atau masyarakat tertentu.</p>
                        </li>
                        <li data-start="2972" data-end="3033">
                        <p data-start="2974" data-end="3033">Mengumpulkan zakat dari lingkungan kerja atau komunitasnya.</p>
                        </li>
                        <li data-start="3034" data-end="3093">
                        <p data-start="3036" data-end="3093">Menyalurkan zakat sesuai arahan dan regulasi dari BAZNAS.</p>
                        </li>
                        </ul>',
            'status' => 1,
        ]);
        Halaman::factory(10)->create();

        Menu::create([
            'name' => 'Profil',
            'slug' => 'profil',
            'type' => 'halaman',
            'target_id' => null,
            'parent_id' => null,
            'order' => 1,
            'status' => 1,
        ]);
        Menu::create([
            'name' => 'Tentang Kami',
            'slug' => 'tentang-kami',
            'type' => 'halaman',
            'target_id' => 1,
            'parent_id' => 1,
            'order' => 1,
            'status' => 1,
        ]);
        Menu::create([
            'name' => 'Visi Misi',
            'slug' => 'visi-misi',
            'type' => 'halaman',
            'target_id' => 2,
            'parent_id' => 1,
            'order' => 2,
            'status' => 1,
        ]);
        Menu::create([
            'name' => 'Struktur Organisasi',
            'slug' => 'struktur-organisasi',
            'type' => 'halaman',
            'target_id' => 3,
            'parent_id' => 1,
            'order' => 3,
            'status' => 1,
        ]);
        Menu::create([
            'name' => 'Layanan',
            'slug' => 'layanan',
            'type' => 'layanan',
            'target_id' => null,
            'parent_id' => null,
            'order' => 2,
            'status' => 1,
        ]);
        Menu::create([
            'name' => 'Rekening Zakat',
            'slug' => 'rekening',
            'type' => 'rekening',
            'target_id' => null,
            'parent_id' => 5,
            'order' => 1,
            'status' => 1,
        ]);
        Menu::create([
            'name' => 'Kalkulator Zakat',
            'slug' => 'kalkulator',
            'type' => 'kalkulator',
            'target_id' => null,
            'parent_id' => 5,
            'order' => 2,
            'status' => 1,
        ]);
        Menu::create([
            'name' => 'Unit Pengumpulan Zakat',
            'slug' => 'upz',
            'type' => 'upz',
            'target_id' => null,
            'parent_id' => 5,
            'order' => 3,
            'status' => 1,
        ]);
        Menu::create([
            'name' => 'Donasi',
            'slug' => 'donasi',
            'type' => 'program',
            'target_id' => null,
            'parent_id' => null,
            'order' => 3,
            'status' => 1,
        ]);
        Menu::create([
            'name' => 'Kabar',
            'slug' => 'artikel',
            'type' => 'artikel',
            'target_id' => null,
            'parent_id' => null,
            'order' => 4,
            'status' => 1,
        ]);

        // Bansos
        $this->call([
            BansosSeeder::class,
        ]);
        // Bansos::create([
        //     'upz_id' => 1,
        //     'amil_id' => 1,
        //     'title' => 'Program Bantuan',
        //     'slug' => 'program-bantuan',
        //     'body' => '<h4 class="color-main mb-3">BAZNAS Kabupaten Buton Salurkan Bantuan Program Pendidikan</h4>
        //                 <p>Badan Amil Zakat Nasional (BAZNAS) Kabupaten Buton telah menjalankan salah satu dari empat Program&nbsp; yaitu Program Bantuan Pendidikan dengan memberikan bantuan kepada 7 orang mahasiswa dan 1 Yayasan Pendidikan. Bantuan ini akan digunakan untuk membiayai pendidikan mereka, termasuk pembayaran biaya kuliah, buku, dan kebutuhan pendidikan lainnya. Program ini bertujuan untuk memberikan kesempatan yang lebih baik bagi mahasiswa yang mungkin menghadapi kendala finansial dalam mengejar pendidikan.</p>
        //                 <p>Penyerahan bantuan ini dilakukan secara simbolis oleh perwakilan dari BAZNAS Kabupaten Buton, yang juga dihadiri oleh penerima bantuan dan keluarganya. Acara tersebut diisi dengan ungkapan terima kasih dari para penerima bantuan kepada BAZNAS dan seluruh donatur yang telah mendukung program-program ini.</p>
        //                 <p>Ketua BAZNAS Kabupaten Buton menyampaikan harapannya bahwa bantuan ini dapat memberikan manfaat yang signifikan bagi penerima dan membantu mereka untuk mencapai tujuan mereka. "Kami berkomitmen untuk terus berperan dalam meningkatkan kesejahteraan masyarakat Kabupaten Buton,&nbsp;khususnya melalui program bantuan pendidikan" kata Ketua BAZNAS.</p>',
        //     'range_start' => '2025-07-12',
        //     'range_end' => '2025-07-03',
        //     'jumlah_donasi' => 5000000,
        //     'image' => 'bansos-images/program-bantuan.webp',
        //     'status' => 1,
        // ])->each(function ($bansos) {
        //     // Buat 3–6 donatur untuk setiap bansos
        //     $donaturs = Bansosdonatur::factory(rand(6, 15))->create([
        //         'bansos_id' => $bansos->id,
        //     ]);

        //     // Hitung total donasi
        //     $total_donasi = $donaturs->sum('nominal_donasi');
        //     $total_penyaluran = 0;

        //     // Buat penyaluran bansos sampai mendekati total donasi
        //     while ($total_penyaluran < $total_donasi) {
        //         $nominal = rand(50_000, 300_000);

        //         if ($total_penyaluran + $nominal > $total_donasi) break;

        //         Bansossaluran::factory()->create([
        //             'bansos_id' => $bansos->id,
        //             'total_nominal' => $nominal,
        //         ]);

        //         $total_penyaluran += $nominal;
        //     }
        // });
        // Bansos::create([
        //     'upz_id' => 1,
        //     'amil_id' => 1,
        //     'title' => 'Program Cerdas (Pendidikan)',
        //     'slug' => 'program-cerdas-pendidikan',
        //     'body' => '<h4 class="color-main mb-3">BAZNAS Kabupaten Buton Salurkan Bantuan Program Pendidikan</h4>
        //                 <p>Badan Amil Zakat Nasional (BAZNAS) Kabupaten Buton telah menjalankan salah satu dari empat Program&nbsp; yaitu Program Bantuan Pendidikan dengan memberikan bantuan kepada 7 orang mahasiswa dan 1 Yayasan Pendidikan. Bantuan ini akan digunakan untuk membiayai pendidikan mereka, termasuk pembayaran biaya kuliah, buku, dan kebutuhan pendidikan lainnya. Program ini bertujuan untuk memberikan kesempatan yang lebih baik bagi mahasiswa yang mungkin menghadapi kendala finansial dalam mengejar pendidikan.</p>
        //                 <p>Penyerahan bantuan ini dilakukan secara simbolis oleh perwakilan dari BAZNAS Kabupaten Buton, yang juga dihadiri oleh penerima bantuan dan keluarganya. Acara tersebut diisi dengan ungkapan terima kasih dari para penerima bantuan kepada BAZNAS dan seluruh donatur yang telah mendukung program-program ini.</p>
        //                 <p>Ketua BAZNAS Kabupaten Buton menyampaikan harapannya bahwa bantuan ini dapat memberikan manfaat yang signifikan bagi penerima dan membantu mereka untuk mencapai tujuan mereka. "Kami berkomitmen untuk terus berperan dalam meningkatkan kesejahteraan masyarakat Kabupaten Buton,&nbsp;khususnya melalui program bantuan pendidikan" kata Ketua BAZNAS.</p>',
        //     'range_start' => '2025-07-01',
        //     'range_end' => '2025-08-03',
        //     'jumlah_donasi' => 20000000,
        //     'image' => 'bansos-images/program-cerdas-pendidikan.jpg',
        //     'status' => 1,
        // ])->each(function ($bansos) {
        //     // Buat 3–6 donatur untuk setiap bansos
        //     $donaturs = Bansosdonatur::factory(rand(6, 15))->create([
        //         'bansos_id' => $bansos->id,
        //     ]);

        //     // Hitung total donasi
        //     $total_donasi = $donaturs->sum('nominal_donasi');
        //     $total_penyaluran = 0;

        //     // Buat penyaluran bansos sampai mendekati total donasi
        //     while ($total_penyaluran < $total_donasi) {
        //         $nominal = rand(50_000, 300_000);

        //         if ($total_penyaluran + $nominal > $total_donasi) break;

        //         Bansossaluran::factory()->create([
        //             'bansos_id' => $bansos->id,
        //             'total_nominal' => $nominal,
        //         ]);

        //         $total_penyaluran += $nominal;
        //     }
        // });
        // Bansos::create([
        //     'upz_id' => 1,
        //     'amil_id' => 1,
        //     'title' => 'Program Makmur (Ekonomi)',
        //     'slug' => 'program-makmur-ekonomi',
        //     'body' => '<h4 class="color-main mb-3">BAZNAS Kabupaten Buton Salurkan Bantuan Program Modal Usaha Kloter II</h4>
        //                 <p>Badan Amil Zakat Nasional (BAZNAS) Kabupaten Buton kembali melanjutkan satu dari empat Program&nbsp; yaitu Program Bantuan Modal Usaha yaitu&nbsp;memberikan bantuan kepada 10 pelaku UMKM. Bantuan ini akan digunakan untuk&nbsp;membantu kebutuhan modal usaha masing-masing pelaku UMKM.&nbsp;</p>
        //                 <p>Penyerahan bantuan ini dilakukan secara simbolis oleh perwakilan dari BAZNAS Kabupaten Buton, yang juga dihadiri oleh penerima bantuan. Acara tersebut diisi dengan ungkapan terima kasih dari para penerima bantuan kepada BAZNAS dan seluruh donatur yang telah mendukung program-program ini.</p>
        //                 <p>Ketua BAZNAS Kabupaten Buton menyampaikan harapannya bahwa bantuan ini dapat memberikan manfaat yang signifikan bagi penerima dan membantu mereka untuk mencapai tujuan mereka. "Kami berkomitmen untuk terus berperan dalam meningkatkan kesejahteraan masyarakat Kabupaten Buton,&nbsp;khususnya melalui Program Bantuan Modal Usaha" kata Ketua BAZNAS.</p>',
        //     'range_start' => '2025-07-02',
        //     'range_end' => '2025-08-04',
        //     'jumlah_donasi' => 25000000,
        //     'image' => 'bansos-images/program-makmur-ekonomi.jpg',
        //     'status' => 1,
        // ])->each(function ($bansos) {
        //     // Buat 3–6 donatur untuk setiap bansos
        //     $donaturs = Bansosdonatur::factory(rand(6, 15))->create([
        //         'bansos_id' => $bansos->id,
        //     ]);

        //     // Hitung total donasi
        //     $total_donasi = $donaturs->sum('nominal_donasi');
        //     $total_penyaluran = 0;

        //     // Buat penyaluran bansos sampai mendekati total donasi
        //     while ($total_penyaluran < $total_donasi) {
        //         $nominal = rand(50_000, 300_000);

        //         if ($total_penyaluran + $nominal > $total_donasi) break;

        //         Bansossaluran::factory()->create([
        //             'bansos_id' => $bansos->id,
        //             'total_nominal' => $nominal,
        //         ]);

        //         $total_penyaluran += $nominal;
        //     }
        // });
        // Bansos::create([
        //     'upz_id' => 1,
        //     'amil_id' => 1,
        //     'title' => 'Program Takwa (Dakwah/Advokasi)',
        //     'slug' => 'program-takwa-dakwahadvokasi',
        //     'body' => '<h4 class="color-main mb-3">BAZNAS Kabupaten Buton Salurkan Bantuan Program Dakwah &amp; Advokasi dan Bantuan Kemanusiaan</h4>
        //                 <p>Setelah kemarin Program Bantuan Pendidikan, kini Badan Amil Zakat Nasional (BAZNAS) Kabupaten Buton Melanjutkan dua dari empat Program&nbsp; yaitu Program Bantuan Dakwah &amp; Advokasi dan Bantuan Kemanusiaan dengan memberikan bantuan kepada 4 pegiat dakwah dan 1 orang bantuan kemanusiaan. Bantuan ini akan digunakan untuk prasarana ibadah dan aktivitas keislaman serta advokasi riqab, dan juga kaum marginal.&nbsp;</p>
        //                 <p>Penyerahan bantuan ini dilakukan secara simbolis oleh perwakilan dari BAZNAS Kabupaten Buton, yang juga dihadiri oleh penerima bantuan. Acara tersebut diisi dengan ungkapan terima kasih dari para penerima bantuan kepada BAZNAS dan seluruh donatur yang telah mendukung program-program ini.</p>
        //                 <p>Ketua BAZNAS Kabupaten Buton menyampaikan harapannya bahwa bantuan ini dapat memberikan manfaat yang signifikan bagi penerima dan membantu mereka untuk mencapai tujuan mereka. "Kami berkomitmen untuk terus berperan dalam meningkatkan kesejahteraan masyarakat Kabupaten Buton,&nbsp;khususnya melalui Program Bantuan Dakwah &amp; Advokasi dan Program Bantuan Kemanusiaan" kata Ketua BAZNAS.</p>',
        //     'range_start' => '2025-07-01',
        //     'range_end' => '2025-07-03',
        //     'jumlah_donasi' => 10000000,
        //     'image' => 'bansos-images/program-takwa-dakwahadvokasi.jpg',
        //     'status' => 1,
        // ])->each(function ($bansos) {
        //     // Buat 3–6 donatur untuk setiap bansos
        //     $donaturs = Bansosdonatur::factory(rand(6, 15))->create([
        //         'bansos_id' => $bansos->id,
        //     ]);

        //     // Hitung total donasi
        //     $total_donasi = $donaturs->sum('nominal_donasi');
        //     $total_penyaluran = 0;

        //     // Buat penyaluran bansos sampai mendekati total donasi
        //     while ($total_penyaluran < $total_donasi) {
        //         $nominal = rand(50_000, 300_000);

        //         if ($total_penyaluran + $nominal > $total_donasi) break;

        //         Bansossaluran::factory()->create([
        //             'bansos_id' => $bansos->id,
        //             'total_nominal' => $nominal,
        //         ]);

        //         $total_penyaluran += $nominal;
        //     }
        // });
        // Bansos::create([
        //     'upz_id' => 1,
        //     'amil_id' => 1,
        //     'title' => 'Program Peduli (Kemanusiaan)',
        //     'slug' => 'program-peduli-kemanusiaan',
        //     'body' => '<p>Sekretariat Daerah Kabupaten Buton bidang Kesejahteraan Masyarakat bekerja sama dengan BAZNAS Kabupaten Buton menyalurkan santunan pada aanak yatim dalam rangka memperingati&nbsp; momentum Peaceful Lebaran Anak Yatim, sebagai Wujud kepedulian dan cinta terhadap generasi penerus bangsa.</p>',
        //     'range_start' => '2025-07-02',
        //     'range_end' => '2025-07-04',
        //     'jumlah_donasi' => 10000000,
        //     'image' => 'bansos-images/program-peduli-kemanusiaan.webp',
        //     'status' => 1,
        // ])->each(function ($bansos) {
        //     // Buat 3–6 donatur untuk setiap bansos
        //     $donaturs = Bansosdonatur::factory(rand(6, 15))->create([
        //         'bansos_id' => $bansos->id,
        //     ]);

        //     // Hitung total donasi
        //     $total_donasi = $donaturs->sum('nominal_donasi');
        //     $total_penyaluran = 0;

        //     // Buat penyaluran bansos sampai mendekati total donasi
        //     while ($total_penyaluran < $total_donasi) {
        //         $nominal = rand(50_000, 300_000);

        //         if ($total_penyaluran + $nominal > $total_donasi) break;

        //         Bansossaluran::factory()->create([
        //             'bansos_id' => $bansos->id,
        //             'total_nominal' => $nominal,
        //         ]);

        //         $total_penyaluran += $nominal;
        //     }
        // });
        // Bansos::create([
        //     'upz_id' => 1,
        //     'amil_id' => 1,
        //     'title' => 'Program Sehat (Kesehatan)',
        //     'slug' => 'program-sehat-kesehatan',
        //     'body' => '<p>BAZNAS mendirikan Rumah Sehat gratis untuk fakir miskin</p>',
        //     'range_start' => '2025-07-01',
        //     'range_end' => '2025-07-04',
        //     'jumlah_donasi' => 30000000,
        //     'image' => 'bansos-images/program-sehat-kesehatan.jpg',
        //     'status' => 1,
        // ])->each(function ($bansos) {
        //     // Buat 3–6 donatur untuk setiap bansos
        //     $donaturs = Bansosdonatur::factory(rand(6, 15))->create([
        //         'bansos_id' => $bansos->id,
        //     ]);

        //     // Hitung total donasi
        //     $total_donasi = $donaturs->sum('nominal_donasi');
        //     $total_penyaluran = 0;

        //     // Buat penyaluran bansos sampai mendekati total donasi
        //     while ($total_penyaluran < $total_donasi) {
        //         $nominal = rand(50_000, 300_000);

        //         if ($total_penyaluran + $nominal > $total_donasi) break;

        //         Bansossaluran::factory()->create([
        //             'bansos_id' => $bansos->id,
        //             'total_nominal' => $nominal,
        //         ]);

        //         $total_penyaluran += $nominal;
        //     }
        // });
        // Bansos::factory(50)->create();
        // Bansos::factory(50)->create()->each(function ($bansos) {
        //     // Buat 3–6 donatur untuk setiap bansos
        //     $donaturs = Bansosdonatur::factory(rand(3, 6))->create([
        //         'bansos_id' => $bansos->id,
        //     ]);

        //     // Hitung total donasi
        //     $total_donasi = $donaturs->sum('nominal_donasi');
        //     $total_penyaluran = 0;

        //     // Buat penyaluran bansos sampai mendekati total donasi
        //     while ($total_penyaluran < $total_donasi) {
        //         $nominal = rand(50_000, 300_000);

        //         if ($total_penyaluran + $nominal > $total_donasi) break;

        //         Bansossaluran::factory()->create([
        //             'bansos_id' => $bansos->id,
        //             'total_nominal' => $nominal,
        //         ]);

        //         $total_penyaluran += $nominal;
        //     }
        // });

        Penyaluran::factory(50)->create();

        Laporan::create([
            'nama_dokumen' => 'Evaluasi Kinerja Tahun 2017',
            'ekstensi' => 'pdf',
            'ukuran' => 11,
            'download' => 82,
            'dokumen' => 'dokumen-file/dokumen-1.pdf',
        ]);
        Laporan::create([
            'nama_dokumen' => 'Evaluasi Kinerja Tahun 2018',
            'ekstensi' => 'pdf',
            'ukuran' => 61,
            'download' => 131,
            'dokumen' => 'dokumen-file/dokumen-1.pdf',
        ]);
        Laporan::create([
            'nama_dokumen' => 'Draf Renja 2019',
            'ekstensi' => 'pdf',
            'ukuran' => 923,
            'download' => 29,
            'dokumen' => 'dokumen-file/dokumen-1.pdf',
        ]);
        Laporan::create([
            'nama_dokumen' => 'Rencana Kerja Tahunan',
            'ekstensi' => 'pdf',
            'ukuran' => 240,
            'download' => 26,
            'dokumen' => 'dokumen-file/dokumen-1.pdf',
        ]);
        Laporan::create([
            'nama_dokumen' => 'Renstra OPD',
            'ekstensi' => 'pdf',
            'ukuran' => 2646,
            'download' => 28,
            'dokumen' => 'dokumen-file/dokumen-1.pdf',
        ]);
        Laporan::create([
            'nama_dokumen' => 'Rencana Kerja (Renja)',
            'ekstensi' => 'pdf',
            'ukuran' => 915,
            'download' => 28,
            'dokumen' => 'dokumen-file/dokumen-1.pdf',
        ]);
        Laporan::create([
            'nama_dokumen' => 'Rencana Aksi',
            'ekstensi' => 'pdf',
            'ukuran' => 12,
            'download' => 27,
            'dokumen' => 'dokumen-file/dokumen-1.pdf',
        ]);
        Laporan::create([
            'nama_dokumen' => 'Peta Program Kerja',
            'ekstensi' => 'pdf',
            'ukuran' => 10,
            'download' => 31,
            'dokumen' => 'dokumen-file/dokumen-1.pdf',
        ]);
        Laporan::create([
            'nama_dokumen' => 'Perjanjian Kinerja',
            'ekstensi' => 'pdf',
            'ukuran' => 3419,
            'download' => 22,
            'dokumen' => 'dokumen-file/dokumen-1.pdf',
        ]);
        Laporan::create([
            'nama_dokumen' => 'Pakta Integritas OPD',
            'ekstensi' => 'pdf',
            'ukuran' => 2603,
            'download' => 18,
            'dokumen' => 'dokumen-file/dokumen-1.pdf',
        ]);
        Laporan::create([
            'nama_dokumen' => 'LKJIP OPD 2017',
            'ekstensi' => 'pdf',
            'ukuran' => 881,
            'download' => 15,
            'dokumen' => 'dokumen-file/dokumen-1.pdf',
        ]);
        Laporan::create([
            'nama_dokumen' => 'Casecading OPD',
            'ekstensi' => 'pdf',
            'ukuran' => 1506,
            'download' => 14,
            'dokumen' => 'dokumen-file/dokumen-1.pdf',
        ]);
        Laporan::create([
            'nama_dokumen' => 'LKJIP',
            'ekstensi' => 'pdf',
            'ukuran' => 187,
            'download' => 14,
            'dokumen' => 'dokumen-file/dokumen-1.pdf',
        ]);
    }
}
