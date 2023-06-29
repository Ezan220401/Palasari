<?php 

require 'functions.php';

$bukunya=query("SELECT * FROM buku");

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Admin Palasari</title>
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;1,600;1,700&display=swap"
      rel="stylesheet"
    />
    <!-- icon -->
    <!-- pastikan terhubung ke internet -->
    <script src="https://unpkg.com/feather-icons"></script>
    <!-- style -->
    <link rel="stylesheet" href="style.css" />

    <link rel="stylesheet" href="style_admin.css">
  </head>
  <body>
    <!-- navbar start -->
    <nav class="navbar">
      <a href="#" class="navbar-logo">Admin<span style="color: gold; font-size: 2rem;"> Palasari</span></a>

      <div class="navbar-nav">
        <a href="#home">Beranda</a>
        <a href="#about">Tentang</a>
        <a href="#dafMenu">Produk</a>
        <a href="#contact">Kontak</a>
      </div>

      <div class="navbar-extra">
        <a href="#" id="menu"><i data-feather="menu"></i></a>
      </div>
    </nav>
    <!-- navbar end -->

    <!-- hero section start -->
    <section class="hero" id="home">
      <main class="content">
        <h1>Bosan? Coba kesini</h1>
        <p>
          <span>Pasar Buku Palasari Bandung</span>, tempat dimana jendela dunia
          ada dimana-mana.
        </p>
        <a href="#about" class="cta">Lanjutkan</a>
      </main>
    </section>
    <!-- hero section end -->

    <!-- about sections start -->
    <section id="about" class="about">
      <h2>Tentang</h2>
      <div class="row">
        <div class="about-img">
          <img src="../img/buku.jpeg" alt="Tentang" />
        </div>
        <main class="content">
          <h3>Sedikit sejarah</h3>
          <p>
            Saat awal tahun 1990-an, terjadi kebakaran di pasar kawasan
            Cikapundung dan para pedagang dipindahkan kesebuah lahan. Namun,
            siapa sangka, lahan yang awalnya parkiran kendaraan itu berubah
            menjadi sarana ilmu yang terkenal.
          </p>

          <h3>"Mau cari buku apa?" <span class="emoji">＼( ^▽^ )／</span></h3>
          <p>
            Adalah kata yang pasti kamu dengar dari banyak kios, ada berbagai
            macam buku, mulai dari buku yang dapat anda jadikan sebagai hiburan
            sampai referensi, seperti komik, novel, sains, agama dan metodologi
            dari berbagai genre, tahun dan bahasa.
          </p>

          <h3>Duh, bukunya ga ketemu <span>( ´•︵•` )</span></h3>
          <p>
            Jangan khawatir, walau ada persaingan, para penjual akan saling
            berkomunikasi untuk membantu anda menemukan buku yang anda cari.
          </p>
          <a href="#dafMenu" class="cta">Lihat Menu</a>
        </main>
      </div>
    </section>
    <!-- about sections end-->

    <!-- menu section start-->
    <section id="dafMenu" class="dafMenu">
      <h2>Produk</h2>
      <p style="align-items: center">Berikut beberapa buku yang mungkin akan menarik hati anda</p>
      <br>
      <a class="tambah" href='tambah.php' class="button" hidden>Tambah Buku</a>
      <container class="row">
        <div>
          <?php $i=1; ?>
          <?php foreach($bukunya as $baris): 
             $nama_konfirmasi = $baris["nama_buku"]; //untuk nanti konfirmasi
         ?>
        <div style="display:flex; flex-direction:row">
            <div style="display: flex; flex-direction:column; margin:10px">
            <img style="width: 200px; height:300px; border-radius:5%" src="../img/<?= $baris["gambar"]; ?>">
            <h3 style="font-size: 2.5rem; color:gold; width:200px;"><?= $baris["nama_buku"]?></h3>
            <h3 style="font-size: 2rem; width:200px; color:white;"><?= $baris["harga"], "K IDR"?><h3>
            
            <a class="hapus" href="hapus.php?id=<?= $baris["id"]; ?>" onclick="
                return confirm('Apa anda yakin ingin menghapus <?= $nama_konfirmasi ?>');" hidden>Hapus
                <!-- tanda tanya untuk mengirim data --></a>
            <br>
            <a class="ubah" href="ubah.php?id=<?= $baris["id"]; ?>" hidden>Ubah
                <!-- tanda tanya untuk mengirim data --></a>
            </div>
            
            <container class="tambahan">
            <p style="font-size: 2rem; width:200px; color:gold;"><b>Deskripsi</b></p>
            <p><?= $baris["deskripsi"]?><br>Karya: <?= $baris["karya"]?></p>
            <a class="link" href="<?= $baris["link"]?>">Link</a>
            <br>
            </container>
        </div>
        <br>
            <body>
    </container>
    <?php $i++; ?>
    <?php endforeach; ?>
      </div>
    </section>
    <!-- menu section end-->

    <!-- contact start -->
    <section id="contact" class="contact">
      <h2>Kontak</h2>
      <p>
        Tersedia juga beberapa seri karya dari penulis dan ilustrator lain,
        penasaran?
      </p>
      <br />
      <iframe
        class="map"
        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15842.638149891383!2d107.6224057!3d-6.9312349!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e87e17fd81e3%3A0x69e1ea8456624ce1!2sPasar%20Buku%20Palasari!5e0!3m2!1sid!2sid!4v1682336128411!5m2!1sid!2sid"
        width="300"
        height="300"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
      ></iframe>
      <br />
    </section>
    <!-- contact end -->

    <!-- footer start -->
    <footer>
      <div class="socials">
        <a
          href="https://www.instagram.com/toko_buku_palasari/"
        >
          <i data-feather="instagram"></i>
        </a>
        <a href="https://www.facebook.com/people/Toko-Buku-Palasari-Bandung/100064547567891/">
          <i data-feather="facebook"></i>
        </a>
        <a href="https://wa.me/+6281374490534">
          <i data-feather="phone"></i>
        </a>
      </div>

      <div class="credit">
        <!-- Clik "Ezra JFP" untuk beralih ke laman admin dengan username dan pasword admin  -->
        <p>
          Created by <a href="admin/login.php"><b>Ezra JFP</b></a
          >| &copy; 2023.
        </p>
      </div>
    </footer>
    <!-- footer end -->

    <!-- feather icons -->
    <script>
      feather.replace();
    </script>

    <!-- my js -->
    <script src="script.js"></script>
  </body>
</html>
