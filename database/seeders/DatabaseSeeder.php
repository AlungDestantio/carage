<?php
/*
|==========================================================
| CARAGE - DATABASE SEEDER
| FILE: database/seeders/DatabaseSeeder.php
|==========================================================
*/
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Article;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── USERS ─────────────────────────────────────────
        User::create([
            'name'     => 'Admin Carage',
            'email'    => 'admin@carage.id',
            'password' => Hash::make('password'),
            'role'     => 'admin',
            'phone'    => '081234567890',
            'address'  => 'Jl. Raya Darmo No.1, Surabaya',
        ]);

        User::create([
            'name'     => 'Andy Mahasiswa',
            'email'    => 'andy@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'customer',
            'phone'    => '082345678901',
            'address'  => 'Kos Jl. Manyar Kertoarjo No.12, Surabaya Timur',
        ]);

        User::create([
            'name'     => 'Budi Santoso',
            'email'    => 'budi@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'customer',
            'phone'    => '083456789012',
            'address'  => 'Jl. Kenjeran No.45, Surabaya',
        ]);

        // ── CATEGORIES ────────────────────────────────────
        $categories = [
            ['name' => 'Oli & Pelumas',       'slug' => 'oli-pelumas',      'description' => 'Oli mesin, oli gardan, dan pelumas kendaraan'],
            ['name' => 'Rem & Kopling',        'slug' => 'rem-kopling',      'description' => 'Kampas rem, disc brake, master kopling'],
            ['name' => 'Filter',               'slug' => 'filter',           'description' => 'Filter oli, filter udara, filter bahan bakar'],
            ['name' => 'Aki & Elektrikal',     'slug' => 'aki-elektrikal',   'description' => 'Aki, busi, kabel, lampu kendaraan'],
            ['name' => 'Suspensi & Steering',  'slug' => 'suspensi-steering','description' => 'Shockbreaker, tie rod, ball joint'],
            ['name' => 'Body & Eksterior',     'slug' => 'body-eksterior',   'description' => 'Kaca, bumper, spion, aksesoris body'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // ── PRODUCTS ──────────────────────────────────────
        $products = [
            // Oli & Pelumas (category_id: 1)
            ['category_id'=>1,'name'=>'Oli Mesin Shell Helix HX7 1L','slug'=>'oli-shell-helix-hx7-1l','description'=>'Oli mesin semi sintetik Shell Helix HX7 SAE 10W-40 untuk mesin bensin. Perlindungan optimal hingga 10.000 km.','price'=>85000,'stock'=>150,'brand'=>'Shell','sku'=>'OLI-SHELL-HX7-1L','is_featured'=>true,'is_active'=>true],
            ['category_id'=>1,'name'=>'Oli Mesin Castrol GTX 4L','slug'=>'oli-castrol-gtx-4l','description'=>'Oli mineral Castrol GTX SAE 20W-50. Cocok untuk mesin bensin dan diesel lama.','price'=>180000,'stock'=>80,'brand'=>'Castrol','sku'=>'OLI-CASTROL-GTX-4L','is_featured'=>true,'is_active'=>true],
            ['category_id'=>1,'name'=>'Oli Gardan Rexco GL-5 1L','slug'=>'oli-gardan-rexco-gl5','description'=>'Oli gardan SAE 90 untuk differential mobil. Melindungi gigi gardan dari keausan.','price'=>45000,'stock'=>200,'brand'=>'Rexco','sku'=>'OLI-REXCO-GL5-1L','is_featured'=>false,'is_active'=>true],

            // Rem & Kopling (category_id: 2)
            ['category_id'=>2,'name'=>'Kampas Rem Depan Toyota Avanza','slug'=>'kampas-rem-depan-avanza','description'=>'Kampas rem depan (brake pad) untuk Toyota Avanza 2012-2023. Bahan ceramic, anti debu, senyap.','price'=>185000,'stock'=>60,'brand'=>'TDW','sku'=>'REM-PAD-AVANZA-D','is_featured'=>true,'is_active'=>true],
            ['category_id'=>2,'name'=>'Disc Brake Depan Honda Jazz','slug'=>'disc-brake-honda-jazz','description'=>'Piringan rem depan untuk Honda Jazz 2014-2022. Material besi tuang berkualitas tinggi.','price'=>420000,'stock'=>30,'brand'=>'DBA','sku'=>'REM-DISC-JAZZ-D','is_featured'=>false,'is_active'=>true],
            ['category_id'=>2,'name'=>'Master Rem Belakang Universal','slug'=>'master-rem-belakang-universal','description'=>'Master rem belakang universal untuk berbagai tipe mobil. Mudah dipasang.','price'=>150000,'stock'=>45,'brand'=>'TRW','sku'=>'REM-MASTER-BLK-UNV','is_featured'=>false,'is_active'=>true],

            // Filter (category_id: 3)
            ['category_id'=>3,'name'=>'Filter Oli Denso Toyota','slug'=>'filter-oli-denso-toyota','description'=>'Filter oli asli Denso untuk Toyota Avanza, Rush, Innova. Efisiensi filtrasi 99%.','price'=>55000,'stock'=>120,'brand'=>'Denso','sku'=>'FLT-OLI-DENSO-TYT','is_featured'=>false,'is_active'=>true],
            ['category_id'=>3,'name'=>'Filter Udara K&N Universal','slug'=>'filter-udara-kn-universal','description'=>'Filter udara performa tinggi K&N. Dapat dicuci dan digunakan ulang hingga 1 juta km.','price'=>650000,'stock'=>25,'brand'=>'K&N','sku'=>'FLT-UDR-KN-UNV','is_featured'=>true,'is_active'=>true],
            ['category_id'=>3,'name'=>'Filter BBM Avanza/Xenia','slug'=>'filter-bbm-avanza-xenia','description'=>'Filter bahan bakar untuk Toyota Avanza dan Daihatsu Xenia. Mencegah kotoran masuk injector.','price'=>95000,'stock'=>90,'brand'=>'Sakura','sku'=>'FLT-BBM-AVZ-XEN','is_featured'=>false,'is_active'=>true],

            // Aki & Elektrikal (category_id: 4)
            ['category_id'=>4,'name'=>'Aki Kering GS Astra 45AH','slug'=>'aki-kering-gs-astra-45ah','description'=>'Aki MF (Maintenance Free) GS Astra 45AH untuk sedan dan MPV kelas bawah. Bebas perawatan.','price'=>720000,'stock'=>40,'brand'=>'GS Astra','sku'=>'AKI-GS-MF-45AH','is_featured'=>true,'is_active'=>true],
            ['category_id'=>4,'name'=>'Busi NGK Iridium Avanza 1.3','slug'=>'busi-ngk-iridium-avanza','description'=>'Busi NGK Iridium IX untuk Toyota Avanza 1.3. Pembakaran optimal, irit BBM.','price'=>85000,'stock'=>200,'brand'=>'NGK','sku'=>'BUSI-NGK-IRD-AVZ','is_featured'=>true,'is_active'=>true],
            ['category_id'=>4,'name'=>'Lampu Depan H4 LED 6000K','slug'=>'lampu-h4-led-6000k','description'=>'Lampu LED H4 6000K super terang. Plug and play, tahan lama hingga 30.000 jam.','price'=>225000,'stock'=>75,'brand'=>'Philips','sku'=>'LMP-H4-LED-6K','is_featured'=>false,'is_active'=>true],

            // Suspensi & Steering (category_id: 5)
            ['category_id'=>5,'name'=>'Shockbreaker Depan KYB Avanza','slug'=>'shockbreaker-kyb-avanza-depan','description'=>'Shock absorber depan KYB Excel-G untuk Toyota Avanza. OEM quality, nyaman di jalan rusak.','price'=>580000,'stock'=>20,'brand'=>'KYB','sku'=>'SHCK-KYB-AVZ-D','is_featured'=>true,'is_active'=>true],
            ['category_id'=>5,'name'=>'Tie Rod End Kanan Avanza','slug'=>'tie-rod-end-kanan-avanza','description'=>'Tie rod end kanan untuk Toyota Avanza 2011-2023. Material baja tempa, presisi tinggi.','price'=>165000,'stock'=>35,'brand'=>'Moog','sku'=>'TIE-ROD-AVZ-KN','is_featured'=>false,'is_active'=>true],
            ['category_id'=>5,'name'=>'Ball Joint Bawah Innova','slug'=>'ball-joint-bawah-innova','description'=>'Ball joint bawah untuk Toyota Innova diesel/bensin. Mengembalikan presisi kemudi.','price'=>210000,'stock'=>28,'brand'=>'CTR','sku'=>'BJ-BWH-INNOVA','is_featured'=>false,'is_active'=>true],

            // Body & Eksterior (category_id: 6)
            ['category_id'=>6,'name'=>'Spion Elektrik Universal Hitam','slug'=>'spion-elektrik-universal','description'=>'Spion elektrik universal bisa dilipat dengan tombol. Fit untuk berbagai mobil.','price'=>850000,'stock'=>15,'brand'=>'Mugen','sku'=>'SPO-ELK-UNV-HIT','is_featured'=>true,'is_active'=>true],
            ['category_id'=>6,'name'=>'Karpet Dasar All New Avanza','slug'=>'karpet-dasar-all-new-avanza','description'=>'Karpet dasar OEM untuk All New Toyota Avanza 2022+. Bahan premium, anti slip.','price'=>380000,'stock'=>22,'brand'=>'Lester','sku'=>'KRP-DSR-ANW-AVZ','is_featured'=>false,'is_active'=>true],
        ];

        foreach ($products as $prod) {
            Product::create($prod);
        }

        // ── ARTICLES ──────────────────────────────────────
        $articles = [
            [
                'user_id'      => 1,
                'title'        => 'Kapan Waktu yang Tepat Ganti Oli Mesin?',
                'slug'         => 'kapan-waktu-tepat-ganti-oli-mesin',
                'excerpt'      => 'Banyak pemilik mobil masih bingung kapan harus ganti oli. Simak panduan lengkapnya di sini.',
                'content'      => '<p>Oli mesin adalah darah bagi kendaraan Anda. Tanpa oli yang bersih dan cukup, mesin dapat mengalami kerusakan serius. Namun, banyak pemilik kendaraan yang masih bingung kapan waktu yang tepat untuk mengganti oli mesin mereka.</p><h3>Patokan Umum</h3><p>Secara umum, penggantian oli mesin dianjurkan setiap <strong>5.000 - 10.000 km</strong> tergantung jenis oli:</p><ul><li>Oli mineral: setiap 5.000 km</li><li>Oli semi-sintetik: setiap 7.500 km</li><li>Oli full sintetik: setiap 10.000 km</li></ul><h3>Tanda-tanda Oli Harus Diganti</h3><p>Selain patokan km, perhatikan juga tanda-tanda berikut: warna oli sudah kehitaman, suara mesin lebih kasar dari biasanya, indikator oli menyala di dashboard, atau aroma terbakar dari mesin.</p><p>Jangan tunda penggantian oli karena biaya service ringan jauh lebih murah dibanding perbaikan mesin akibat oli kotor!</p>',
                'status'       => 'published',
                'published_at' => now()->subDays(5),
            ],
            [
                'user_id'      => 1,
                'title'        => 'Tips Memilih Aki Mobil yang Tepat',
                'slug'         => 'tips-memilih-aki-mobil-yang-tepat',
                'excerpt'      => 'Aki yang salah bisa bikin mobil susah start. Ketahui cara memilih aki yang sesuai untuk kendaraan Anda.',
                'content'      => '<p>Aki atau baterai adalah komponen vital yang sering dilupakan pemilik mobil. Aki yang lemah atau tidak sesuai spesifikasi bisa menyebabkan mobil susah dinyalakan, terutama di pagi hari.</p><h3>Jenis Aki Mobil</h3><p>Ada dua jenis aki yang umum di pasaran:</p><ul><li><strong>Aki Basah (Konvensional)</strong>: Membutuhkan perawatan rutin, harganya lebih murah.</li><li><strong>Aki Kering (MF/Maintenance Free)</strong>: Bebas perawatan, lebih tahan lama, harga lebih mahal.</li></ul><h3>Cara Memilih Aki yang Tepat</h3><p>Perhatikan spesifikasi berikut saat memilih aki: CCA (Cold Cranking Ampere), kapasitas Ah (Ampere Hour), dan dimensi fisik aki. Pastikan angka-angka ini sesuai dengan rekomendasi buku manual kendaraan Anda.</p>',
                'status'       => 'published',
                'published_at' => now()->subDays(3),
            ],
            [
                'user_id'      => 1,
                'title'        => 'Kenali Tanda-tanda Shockbreaker Mobil Rusak',
                'slug'         => 'tanda-shockbreaker-mobil-rusak',
                'excerpt'      => 'Shockbreaker aus bisa membahayakan keselamatan berkendara. Kenali tandanya sebelum terlambat.',
                'content'      => '<p>Shockbreaker atau peredam kejut adalah komponen suspensi yang bertugas menyerap getaran dan guncangan saat berkendara. Shockbreaker yang aus tidak hanya membuat perjalanan tidak nyaman, tetapi juga berbahaya.</p><h3>Tanda-tanda Shockbreaker Harus Diganti</h3><ul><li>Mobil terasa "memantul" berlebihan saat melewati polisi tidur</li><li>Bagian depan/belakang mobil terasa turun saat berhenti mendadak</li><li>Terdengar suara "jedug" saat melewati jalan bergelombang</li><li>Terdapat bekas oli di body shockbreaker (bocor)</li><li>Ban mengalami keausan tidak merata</li></ul><p>Jika Anda merasakan salah satu tanda di atas, segera periksakan kendaraan ke bengkel terdekat. Di Carage, kami menyediakan berbagai pilihan shockbreaker berkualitas dengan harga terjangkau.</p>',
                'status'       => 'published',
                'published_at' => now()->subDays(1),
            ],
            [
                'user_id'      => 1,
                'title'        => 'Panduan Lengkap Perawatan Rem Mobil',
                'slug'         => 'panduan-perawatan-rem-mobil',
                'excerpt'      => 'Rem adalah sistem keselamatan utama. Pelajari cara merawatnya dengan benar.',
                'content'      => '<p>Sistem pengereman adalah komponen keselamatan paling kritis pada kendaraan. Rem yang tidak berfungsi dengan baik dapat berakibat fatal. Oleh karena itu, perawatan rutin sistem rem sangat penting.</p><h3>Komponen Sistem Rem</h3><p>Sistem rem terdiri dari beberapa komponen utama: kampas rem (brake pad/brake shoe), piringan rem (disc brake/drum), master silinder, dan minyak rem. Semua komponen ini harus dalam kondisi baik untuk performa pengereman yang optimal.</p><h3>Tips Perawatan Rem</h3><ul><li>Ganti kampas rem setiap 30.000-50.000 km atau jika ketebalan sudah kurang dari 3mm</li><li>Periksa kondisi minyak rem setiap 6 bulan</li><li>Hindari pengereman mendadak yang terlalu sering</li><li>Jika terdengar suara berdecit saat mengerem, segera periksakan</li></ul>',
                'status'       => 'draft',
                'published_at' => null,
            ],
        ];

        foreach ($articles as $art) {
            Article::create($art);
        }
    }
}