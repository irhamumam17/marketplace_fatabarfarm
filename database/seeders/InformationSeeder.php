<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StoreInformation;

class InformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StoreInformation::create([
            'type' => 'lokasi',
            'detail' => '{"longitude":"-7.245829","latitude":"110.8960153","alamat":"<span lang=\"IN\" style=\"font-size:12.0pt;line-height:\n107%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:Calibri;\nmso-fareast-theme-font:minor-latin;mso-ansi-language:IN;mso-fareast-language:\nEN-US;mso-bidi-language:AR-SA\">Fatabar Farm and out bound berlokasi di RT.04\nRW.02 Dusun Timongo, Desa Monggot Kecamatan Geyer, Kabupaten Grobogan, Jawa\nTengah<\/span><br>","province_id":"10","city_id":348,"waktu_kerja":{"hari_mulai":"rabu","hari_selesai":"jumat","waktu_mulai":"08:48","waktu_selesai":"14:46"},"kontak":"0980989800"}'
        ]);
        StoreInformation::create([
            'type' => 'sejarah',
            'detail' => '<p class="MsoNormal" style="text-align:justify;text-indent:36.0pt;line-height: 150%"><span lang="IN" style="font-size:12.0pt;line-height:150%;font-family:&quot;Times New Roman&quot;,serif">Fatabar Farm berdiri 15 Februari 2018 diambil tanggal ini karena bertepatan dengan ulang tahun owner peternakan Fatabar Farm.Peternakan ini berada di RT.04 RW. 02 Dusun Timongo, Desa Monggot, Kecamatan Geyer, Kabupaten Grobogan. <o:p></o:p></span></p> <p class="MsoNormal" style="text-align:justify;text-indent:36.0pt;line-height: 150%"><span lang="IN" style="font-size:12.0pt;line-height:150%;font-family:&quot;Times New Roman&quot;,serif">Peternakan Fatabar Farm di rintis oleh seorang pemuda yang kala itu masih anak anak berusia 13 tahun lulusan SD dan memutuskan untuk mengambil pendidikan rumahan (Home Education ) dengan alasan ia sudah menemukan bakat peternak dan mengujinya dengan mengikuti program magang 2 bulan di salah satu peternakan di Kabupaten Lumajang, Jawa timur. Berawal dari 2 ekor kambing dan berlanjut dengan 10 domba, banyak suka duka yang telah ia lalui dari kematian kambing yang tinggi akibat pemilihan bakalan yang belum baik, pakan yang belum benar, standar opersional peternakan (SOP) yang belum tegak, keuangan yang masih belum untung malah buntung karena cash flow buruk dan pemasaran hanya di waktu hari raya qurban saja.<o:p></o:p></span></p> <p class="MsoNormal" style="text-align:justify;text-indent:36.0pt;line-height: 150%"><span lang="IN" style="font-size:12.0pt;line-height:150%;font-family:&quot;Times New Roman&quot;,serif">Dari pengalaman itu maka sejak Oktober 2019 Peternakan Fatabar Farm berfokus pada pembiakan kambing perah dengan jenis Sapera ( Sanen peranakan etawa) dengan alasan kambing tetap berkembangbiak yang artinya induk akan terus bertambah dan akan menambah populasi, selain itu kambing perah dapat menghasilkan susu setiap hari pasca kelahiran anaknya karena jenis kambing ini menghasilkan susu melimpah. Sehingga kondisi peternakan Fatabar farm sedikit demi sedikit mulai untung dan mulai berjalan dg cash flow yang mulai membaik.<o:p></o:p></span></p> <p class="MsoNormal" style="text-align:justify;text-indent:36.0pt;line-height: 150%"><span lang="IN" style="font-size:12.0pt;line-height:150%;font-family:&quot;Times New Roman&quot;,serif">Dalam masa pandemi pun susu kambing kami banyak diminati oleh karenanya kami terus berinovasi tidak hanya dengan produk susu murni saja namun juga memproduksi olahan susu menjadi milky jelly drink yang berasal dari susu kambing.</span></p><p class="MsoNormal" style="text-align:justify;text-indent:36.0pt;line-height: 150%"><span style="font-size: 12pt; font-family: &quot;Times New Roman&quot;, serif;">Dengan kondisi itu maka penambahan mesin produksi dan standar produksi pun mulai kami tingkatkan dengan pengadaan peralatan pasteurisasi dan didukung dengan pemasaran offline dan online&nbsp; maka peternakan ini terus berkembang baik.</span></p>'
        ]);
        StoreInformation::create([
            'type' => 'visi_misi',
            'detail' => '<p class="MsoNormal" style="line-height:150%"><span lang="IN" style="font-size: 12.0pt;line-height:150%;font-family:&quot;Times New Roman&quot;,serif">Visi peternakan Fatabar Farm : Peternakan yang terpadu dengan pendidikan ( Integreted&nbsp; Edufarm) yang berbasis peternakan dan pertanian.<o:p></o:p></span></p> <span lang="IN" style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif; mso-fareast-font-family:Calibri;mso-fareast-theme-font:minor-latin;mso-ansi-language: IN;mso-fareast-language:EN-US;mso-bidi-language:AR-SA">Misi Peternakan Fatabar Farm : Membangun kedaulatan pangan dengan menghasilkan susu dan daging kambing yang halal, sehat dan murah sehingga mampu meningkatkan nutrisi masyarakat.</span>'
        ]);
        StoreInformation::create([
            'type' => 'program',
            'detail' => '{"title":"Titipan Hewan Qurban","content":"<p style=\"text-align: justify; \"><span lang=\"IN\" style=\"font-size:12.0pt;line-height:\n107%;font-family:\"Times New Roman\",serif;mso-fareast-font-family:Calibri;\nmso-fareast-theme-font:minor-latin;mso-ansi-language:IN;mso-fareast-language:\nEN-US;mso-bidi-language:AR-SA\">Program ini menyasar daerah daerah tengah hutan\nyang tidak ada warga yang menunaikan ibadah penyembelihan hewan Qurban di\nwilayah Kabupaten Grobogan, kaum dhuafa dan Ikatan Tuna Netra Muslim Indonesia Kabupaten Grobogan.<\/span><br><\/p>\n"}'
        ]);
        StoreInformation::create([
            'type' => 'program',
            'detail' => '{"title":"Pondok pesantren Tahfidz Al Quran","content":"<p style=\"text-align: justify; \"><span lang=\"IN\" style=\"font-size:12.0pt;line-height:\n107%;font-family:\"Times New Roman\",serif;mso-fareast-font-family:Calibri;\nmso-fareast-theme-font:minor-latin;mso-ansi-language:IN;mso-fareast-language:\nEN-US;mso-bidi-language:AR-SA\">Program ini berbasis pada pemaknaan dan\nkecintaan pada kitab suci Alquran, diharapkan para santri mampu menjaga Al\nquran dengan menjadikan panduan tidak hanya sebatas menghafal dan menjadikannya\nmantra semata.<\/span><br><\/p>\n"}'
        ]);
        StoreInformation::create([
            'type' => 'program',
            'detail' => '{"title":"Sepekan Menggila","content":"<p style=\"text-align: justify; \"><span lang=\"IN\" style=\"font-size:12.0pt;line-height:\n107%;font-family:\"Times New Roman\",serif;mso-fareast-font-family:Calibri;\nmso-fareast-theme-font:minor-latin;mso-ansi-language:IN;mso-fareast-language:\nEN-US;mso-bidi-language:AR-SA\">Program ini di khususkan untuk para pemuda aqil\nbaliq untuk merecovery fitrah iman, fitrah bakat, fitrah belajar, fitrah\nindividu dan sosial, fitrah jasmani, fitrah seksual, Fitrah bahasa dan estetika\nsehingga para pemuda mampu berkarya dan berakhlak mulia.<\/span><br><\/p>\n"}'
        ]);

    }
}
