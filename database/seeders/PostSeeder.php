<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\File;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = File::create([
            'path' => 'uploads/images/posts/idul_adha.jpg',
        ]);
        Post::create([
            'title' => 'Idul Adha',
            'content' => "<p style='text-align: justify; '><span lang='IN' style='font-size:12.0pt;line-height:107%;font-family:'Times New Roman',serif;mso-fareast-font-family:Calibri;mso-fareast-theme-font:minor-latin;mso-ansi-language:IN;mso-fareast-language: EN-US;mso-bidi-language:AR-SA'>Hari raya Iedul Adha, hari raya yang ditunggu oleh para peternak terutama peternak kambing semisal kami ini, kami menyebutnya panen rayanya peternak. Setiap tahun sekitar 50 sampai dengan 100 ekor peternakan kami mendapat pesanan hewan qurban. Pemesan kami tak hanya pesan untuk dikirimkan hidup namun ada pula yang minta untuk di sembelih di tempat kami dan dikirim siap bagi. Banyak juga para pelanggan yang memesan hewan qurban membeli, disembelihkan dan&nbsp; meminta kami untuk mentasarufkan ke daerah di sekitar kandang untuk masyarakat duafa dan tuna netra.</span><br></p>",
            'image' => $file->uuid,
            'status' => 'public'
        ]);
        $file = File::create([
            'path' => 'uploads/images/posts/magang.jpg',
        ]);
        Post::create([
            'title' => 'Magang',
            'content' => "<p style='text-align: justify; '><span lang='IN' style='font-size:12.0pt;line-height: 107%;font-family:'Times New Roman',serif;mso-fareast-font-family:Calibri; mso-fareast-theme-font:minor-latin;mso-ansi-language:IN;mso-fareast-language: EN-US;mso-bidi-language:AR-SA'>Kami membuka juga kelas magang sepekanan dengan program &acirc;&#128;&#156;sepekan menggila bersama juragan kambing&acirc;&#128;&#157;. Para pemuda Aqil baliq diajak untuk mengikuti kegiatan peternakan dengan &acirc;&#128;&#156;Menggali Informasi Langsung Action&acirc;&#128;&#157; dan mengamati bakat yang kami observasi dengan praktisi &acirc;&#128;&#156; tallent mapping&acirc;&#128;&#157; sehingga para pemuda mampu mengambil hikmah dari kegiatan dan mencatatkannya dalam portofolio.</span><br></p>",
            'image' => $file->uuid,
            'status' => 'public'
        ]);
        $file = File::create([
            'path' => 'uploads/images/posts/outbond.jpg',
        ]);
        Post::create([
            'title' => 'Family Camp dan Out Bound',
            'content' => "<p style='text-align: justify;'><span lang='IN' style='font-size:12.0pt;line-height: 107%;font-family:'Times New Roman',serif;mso-fareast-font-family:Calibri; mso-fareast-theme-font:minor-latin;mso-ansi-language:IN;mso-fareast-language: EN-US;mso-bidi-language:AR-SA'>Family camp dan outbound kami buka untuk memenuhi permintaan dari sekolahan sekolahan yang memiliki program tahunan outing class. Ditempat kami memiliki lokasi lapangan kecil dan &nbsp;dekat dengan sungai dan hutan sehingga memungkinkan para siswa untuk melakukan bermalam di tenda dan esok paginya melakukan kegiatan flying fox, susur sungai dan susur hutan.</span><br></p>",
            'image' => $file->uuid,
            'status' => 'public'
        ]);
        $file = File::create([
            'path' => 'uploads/images/posts/pemeliharaan.jpg',
        ]);
        Post::create([
            'title' => 'Pemeliharaan kambing dan domba',
            'content' => "<p style='text-align: justify; '><span lang='IN' style='font-size:12.0pt;line-height: 107%;font-family:'Times New Roman',serif;mso-fareast-font-family:Calibri; mso-fareast-theme-font:minor-latin;mso-ansi-language:IN;mso-fareast-language: EN-US;mso-bidi-language:AR-SA'>Kami bergerak di&nbsp; bidang peternakan kambing &Atilde;&cent;&acirc;&#130;&not;&Aring;&#147;Fatabar arm&Atilde;&cent;&acirc;&#130;&not;&Acirc;&#157;dengan produk makanan&nbsp; (food)&nbsp; berbasis daging segar dan olahannya sedangkan produk minuman (beverage) berbasis susu segar dan olahannya. Agar tetap bertahan sediannya harus mampu memastikan enam (6) hal agar usaha kami tetap berjalan, yakni : varietas kambing berkualitas dengan populasi memadai, ketersediaan pakan murah berkualitas, standar operasional pengelolaan kandang di tegakkan dengan pengawasan dari petugas dinas peternakan (Petugas Puskeswan Kecamatan Geyer), perputaran keuangan yang sehat, produk dan olahannya layak konsumsi,&nbsp; yang itu semua akan sempurna jikalau di dukung pasar ( market) yang tepat sehingga produk peternakan kami sampai ke konsumen akhir.</span><br></p>",
            'image' => $file->uuid,
            'status' => 'public'
        ]);
    }
}
