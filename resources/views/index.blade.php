<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>CV Pramudya Putra</title>
  <meta content="" name="description" />
  <meta content="" name="keywords" />
  {{-- Favicons --}}
  <link href="{{ asset('images/favicon.png') }}" rel="icon" />
  <link href="{{ asset('images/apple-touch-icon.png') }}" rel="apple-touch-icon" />
  {{-- Fonts --}}
  {{-- <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet"> --}}
  <link href="https://fonts.googleapis.com" rel="preconnect" />
  <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&amp;display=swap" rel="stylesheet" />
  {{-- Vendor CSS Files --}}
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet" />
  <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
  {{-- Main CSS File --}}
  <link href="{{ asset('css/main.css') }}" rel="stylesheet" />
  </link>
</head>

<body class="sarter-page-page">
  <header class="header d-flex align-items-center sticky-top" id="header">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
      <a class="logo d-flex align-items-center me-auto" href="{{ route('home') }}">
        <img alt="" src="{{ asset('images/logo.png') }}" />
      </a>
      <nav class="navmenu" id="navmenu">
        <ul>
          <li><a href="#hero">Home</a></li>
          <li><a href="#about">Tentang Kami</a></li>
          <li><a href="#product">Produk</a></li>
          <li><a href="#galeri">Galeri</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>
  <main class="main">
    {{-- Hero Section --}}
    <section class="hero section" id="hero">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="fade-up">
            <h1>Solusi <span style="color:#bc1010;">Percetakan</span> &amp;
              <span style="color:#bc1010;">Pengadaan</span><br />
              Untuk Bisnis Anda
            </h1>
            <p>Melayani kebutuhan cetak, dokumen, dan promosi dengan
              kualitas tinggi profesional, dan tepat waktu.
              Didukung tim berpengalaman &amp; teknologi modern untuk memastikan hasil maksimal.</p>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="100">
            <img alt="Percetakan &amp; Pengadaan" class="img-fluid animated" src="{{ asset('images/hero-img.png') }}" />
          </div>
        </div>
      </div>
    </section>
    {{-- /Hero Section --}}
    {{-- About Us Section --}}
    <section class="about section light-background" id="about">
      <div class="container" data-aos="fade-up">
        {{-- Judul --}}
        <div class="section-title">
          <span>Tentang Kami</span>
          <h2>Tentang Kami</h2>
        </div>
        <div class="row gy-4 align-items-center">
          <div class="col-lg-6">
            <img alt="Tentang Kami" class="img-fluid rounded" src="{{ asset('images/Logo.png') }}" />
          </div>
          <div class="col-lg-6">
            <p>CV. Pramudya Putra adalah perusahaan percetakan dan pengadaan barang serta jasa umum yang berdiri sejak
              2005 di Banjaran, Bandung. Kami melayani kebutuhan cetak untuk individu, instansi, dan bisnis dengan hasil
              berkualitas tinggi, didukung tenaga profesional dan mesin modern. Layanan kami mencakup brosur, banner,
              undangan, dokumen kantor, desain grafis, ATK, serta kebutuhan promosi lainnya. Dengan integritas,
              profesionalisme, dan inovasi, kami siap menjadi mitra strategis jangka panjang bagi pelanggan.</p>
          </div>
        </div>
      </div>
    </section>
    <section class="misi section" id="visi">
      {{-- Visi Title --}}
      <div class="container section-title" data-aos="fade-up">
        <span>Visi Perusahaan</span>
        <h2>Visi Perusahaan</h2>
        <p>Menjadi perusahaan percetakan dan pengadaan umum yang unggul, terpercaya, dan berdaya saing tinggi di tingkat
          regional maupun nasional,
          dengan mengedepankan kualitas layanan, inovasi berkelanjutan, serta komitmen terhadap kepuasan pelanggan dan
          etika usaha.</p>
      </div>{{-- End Visi Title --}}
    </section>
    {{-- Misi Section --}}
    <section class="missions section light-background" id="missions">
      {{-- Section Title --}}
      <div class="container section-title" data-aos="fade-up">
        <span>Misi Perusahaan</span>
        <h2>Misi Perusahaan</h2>
      </div>{{-- End Section Title --}}
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-4 d-flex" data-aos="fade-up" data-aos-delay="100">
            <div class="mission-item position-relative">
              <div class="icon"><i class="bi bi-box-seam icon"></i></div>
              <h4 class="fw-semibold">Produk Berkualitas</h4>
              <p class="fs-6">Menyediakan Produk dan Layanan Berkualitas Tinggi.</p>
            </div>
          </div>{{-- End mission Item --}}
          <div class="col-lg-4 d-flex" data-aos="fade-up" data-aos-delay="200">
            <div class="mission-item position-relative">
              <div class="icon"><i class="bi bi-emoji-smile icon"></i></div>
              <h4 class="fw-semibold">Kepuasan Pelanggan</h4>
              <p class="fs-6">Menumbuhkan Kepuasan dan Loyalitas Pelanggan.</p>
            </div>
          </div>{{-- End mission Item --}}
          <div class="col-lg-4 d-flex" data-aos="fade-up" data-aos-delay="300">
            <div class="mission-item position-relative">
              <div class="icon"><i class="bi bi-award icon"></i></div>
              <h4 class="fw-semibold">Profesional &amp; Integritas</h4>
              <p class="fs-6">Menjalankan Usaha Secara Profesional dan Berintegritas.</p>
            </div>
          </div>{{-- End mission Item --}}
        </div>
      </div>
    </section>
    {{-- End About Section --}}
    {{-- Produk Section --}}
    <section class="product section" id="product">
      {{-- Section Title --}}
      <div class="container section-title" data-aos="fade-up">
        <span>Produk</span>
        <h2>Produk</h2>
        <p>Berbagai layanan percetakan dan pengadaan barang &amp; jasa kami.</p>
      </div>{{-- End Section Title --}}
      <div class="container">
        <div class="isotope-layout" data-default-filter=".filter-digital" data-layout="masonry" data-sort="original-order">
          <ul class="product-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
            <li class="filter-active" data-filter=".filter-digital">Digital &amp; Offset</li>
            <li data-filter=".filter-admin">Administratif</li>
            <li data-filter=".filter-promosi">Promosi</li>
            <li data-filter=".filter-kemasan">Produk Kemasan</li>
            <li data-filter=".filter-pengadaan">Pengadaan Barang &amp; Jasa Lainnya</li>
          </ul>{{-- End product Filters --}}
          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
            {{-- Percetakan Digital & Offset --}}
            <div class="col-lg-4 col-md-6 product-item isotope-item filter-digital">
              <img alt="" class="img-fluid rounded" src="{{ asset('images/product/1.png') }}" />
              <div class="product-info">
                <h4>Brosur</h4>
                <p>Untuk promosi produk &amp; layanan Anda</p>
                <a class="details-link" href="https://wa.me/6281323000049"><i class="bi bi-whatsapp" style="color: rgb(3, 214, 3);"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 product-item isotope-item filter-digital">
              <img alt="" class="img-fluid rounded" src="{{ asset('images/product/2.png') }}" />
              <div class="product-info">
                <h4>Flyer</h4>
                <p>Desain menarik untuk distribusi massal</p>
                <a class="details-link" href="https://wa.me/6281323000049"><i class="bi bi-whatsapp" style="color: rgb(3, 214, 3);"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 product-item isotope-item filter-digital">
              <img alt="" class="img-fluid rounded" src="{{ asset('images/product/3.png') }}" />
              <div class="product-info">
                <h4>Kalender</h4>
                <p>Kalender meja &amp; dinding custom logo</p>
                <a class="details-link" href="https://wa.me/6281323000049"><i class="bi bi-whatsapp" style="color: rgb(3, 214, 3);"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 product-item isotope-item filter-digital">
              <img alt="" class="img-fluid rounded" src="{{ asset('images/product/4.png') }}" />
              <div class="product-info">
                <h4>Undangan</h4>
                <p>Cetak undangan acara resmi &amp; private</p>
                <a class="details-link" href="https://wa.me/6281323000049"><i class="bi bi-whatsapp" style="color: rgb(3, 214, 3);"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 product-item isotope-item filter-digital">
              <img alt="" class="img-fluid rounded" src="{{ asset('images/product/5.png') }}" />
              <div class="product-info">
                <h4>Poster</h4>
                <p>Cetak A3+ untuk promosi event &amp; produk</p>
                <a class="details-link" href="https://wa.me/6281323000049"><i class="bi bi-whatsapp" style="color: rgb(3, 214, 3);"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 product-item isotope-item filter-digital">
              <img alt="" class="img-fluid rounded" src="{{ asset('images/product/brosur.png') }}" />
              <div class="product-info">
                <h4>Custom Kebutuhan</h4>
                <p>Pesan sesuai spesifikasi &amp; keperluan Anda</p>
                <a class="details-link" href="https://wa.me/6281323000049"><i class="bi bi-whatsapp" style="color: rgb(3, 214, 3);"></i></a>
              </div>
            </div>
            {{-- Percetakan Administratif --}}
            <div class="col-lg-4 col-md-6 product-item isotope-item filter-admin">
              <img alt="" class="img-fluid rounded" src="{{ asset('images/product/6.png') }}" />
              <div class="product-info">
                <h4>Kop Surat</h4>
                <p>Identitas resmi perusahaan</p>
                <a class="details-link" href="https://wa.me/6281323000049"><i class="bi bi-whatsapp" style="color: rgb(3, 214, 3);"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 product-item isotope-item filter-admin">
              <img alt="" class="img-fluid rounded" src="{{ asset('images/product/7.png') }}" />
              <div class="product-info">
                <h4>Nota</h4>
                <p>Pencatatan transaksi rapi</p>
                <a class="details-link" href="https://wa.me/6281323000049"><i class="bi bi-whatsapp" style="color: rgb(3, 214, 3);"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 product-item isotope-item filter-admin">
              <img alt="" class="img-fluid rounded" src="{{ asset('images/product/8.png') }}" />
              <div class="product-info">
                <h4>Invoice</h4>
                <p>Penagihan profesional</p>
                <a class="details-link" href="https://wa.me/6281323000049"><i class="bi bi-whatsapp" style="color: rgb(3, 214, 3);"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 product-item isotope-item filter-admin">
              <img alt="" class="img-fluid rounded" src="{{ asset('images/product/9.png') }}" />
              <div class="product-info">
                <h4>Kwitansi</h4>
                <p>Nomor urut &amp; stempel</p>
                <a class="details-link" href="https://wa.me/6281323000049"><i class="bi bi-whatsapp" style="color: rgb(3, 214, 3);"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 product-item isotope-item filter-admin">
              <img alt="" class="img-fluid rounded" src="{{ asset('images/product/10.png') }}" />
              <div class="product-info">
                <h4>Amplop</h4>
                <p>Dengan logo instansi</p>
                <a class="details-link" href="https://wa.me/6281323000049"><i class="bi bi-whatsapp" style="color: rgb(3, 214, 3);"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 product-item isotope-item filter-admin">
              <img alt="" class="img-fluid rounded" src="{{ asset('images/product/11.png') }}" />
              <div class="product-info">
                <h4>Map</h4>
                <p>Untuk arsip &amp; presentasi</p>
                <a class="details-link" href="https://wa.me/6281323000049"><i class="bi bi-whatsapp" style="color: rgb(3, 214, 3);"></i></a>
              </div>
            </div>
            {{-- <div class="col-lg-4 col-md-6 product-item isotope-item filter-admin">
              <img src="assets/images/product/1.png" class="img-fluid rounded" alt="">
              <div class="product-info">
                <h4>Custom Kebutuhan</h4>
                <p>Menyesuaikan dokumen Anda</p>
                <a href="https://wa.me/6281323000049" class="details-link"><i class="bi bi-whatsapp"
                    style="color: rgb(3, 214, 3);"></i></a>
              </div>
            </div> --}}
            {{-- Percetakan Promosi --}}
            <div class="col-lg-4 col-md-6 product-item isotope-item filter-promosi">
              <img alt="" class="img-fluid rounded" src="{{ asset('images/product/12.png') }}" />
              <div class="product-info">
                <h4>Spanduk</h4>
                <p>Bahan outdoor tahan lama</p>
                <a class="details-link" href="https://wa.me/6281323000049"><i class="bi bi-whatsapp" style="color: rgb(3, 214, 3);"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 product-item isotope-item filter-promosi">
              <img alt="" class="img-fluid rounded" src="{{ asset('images/product/13.png') }}" />
              <div class="product-info">
                <h4>Banner</h4>
                <p>Ukuran fleksibel sesuai event</p>
                <a class="details-link" href="https://wa.me/6281323000049"><i class="bi bi-whatsapp" style="color: rgb(3, 214, 3);"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 product-item isotope-item filter-promosi">
              <img alt="" class="img-fluid rounded" src="{{ asset('images/product/14.png') }}" />
              <div class="product-info">
                <h4>X-Banner</h4>
                <p>Ringkas untuk booth promosi</p>
                <a class="details-link" href="https://wa.me/6281323000049"><i class="bi bi-whatsapp" style="color: rgb(3, 214, 3);"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 product-item isotope-item filter-promosi">
              <img alt="" class="img-fluid rounded" src="{{ asset('images/product/15.png') }}" />
              <div class="product-info">
                <h4>Roll Up Banner</h4>
                <p>Praktis dibawa &amp; dipasang</p>
                <a class="details-link" href="https://wa.me/6281323000049"><i class="bi bi-whatsapp" style="color: rgb(3, 214, 3);"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 product-item isotope-item filter-promosi">
              <img alt="" class="img-fluid rounded" src="{{ asset('images/product/16.png') }}" />
              <div class="product-info">
                <h4>Sticker</h4>
                <p>Untuk branding &amp; kemasan</p>
                <a class="details-link" href="https://wa.me/6281323000049"><i class="bi bi-whatsapp" style="color: rgb(3, 214, 3);"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 product-item isotope-item filter-promosi">
              <img alt="" class="img-fluid rounded" src="{{ asset('images/product/1.png') }}" />
              <div class="product-info">
                <h4>Custom Kebutuhan</h4>
                <p>Pesan sesuai promosi Anda</p>
                <a class="details-link" href="https://wa.me/6281323000049"><i class="bi bi-whatsapp" style="color: rgb(3, 214, 3);"></i></a>
              </div>
            </div>
            {{-- Kemasan (3) --}}
            {{-- Percetakan Produk Kemasan --}}
            <div class="col-lg-4 col-md-6 product-item isotope-item filter-kemasan">
              <img alt="" class="img-fluid rounded" src="{{ asset('images/product/17.png') }}" />
              <div class="product-info">
                <h4>Label Produk</h4>
                <p>Sticker merk &amp; barcode</p>
                <a class="details-link" href="https://wa.me/6281323000049"><i class="bi bi-whatsapp" style="color: rgb(3, 214, 3);"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 product-item isotope-item filter-kemasan">
              <img alt="" class="img-fluid rounded" src="{{ asset('images/product/18.png') }}" />
              <div class="product-info">
                <h4>Box Kemasan</h4>
                <p>Dus cetak offset custom</p>
                <a class="details-link" href="https://wa.me/6281323000049"><i class="bi bi-whatsapp" style="color: rgb(3, 214, 3);"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 product-item isotope-item filter-kemasan">
              <img alt="" class="img-fluid rounded" src="{{ asset('images/product/19.png') }}" />
              <div class="product-info">
                <h4>Paper Bag</h4>
                <p>Tas kertas printing logo</p>
                <a class="details-link" href="https://wa.me/6281323000049"><i class="bi bi-whatsapp" style="color: rgb(3, 214, 3);"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 product-item isotope-item filter-kemasan">
              <img alt="" class="img-fluid rounded" src="{{ asset('images/product/1.png') }}" />
              <div class="product-info">
                <h4>Custom Kebutuhan</h4>
                <p>Desain &amp; ukuran sesuai produk</p>
                <a class="details-link" href="https://wa.me/6281323000049"><i class="bi bi-whatsapp" style="color: rgb(3, 214, 3);"></i></a>
              </div>
            </div>
            {{-- Pengadaan Barang & Jasa Lainnya --}}
            <div class="col-lg-4 col-md-6 product-item isotope-item filter-pengadaan">
              <img alt="" class="img-fluid rounded" src="{{ asset('images/product/20.png') }}" />
              <div class="product-info">
                <h4>ATK</h4>
                <p>Peralatan tulis &amp; kantor</p>
                <a class="details-link" href="https://wa.me/6281323000049"><i class="bi bi-whatsapp" style="color: rgb(3, 214, 3);"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 product-item isotope-item filter-pengadaan">
              <img alt="" class="img-fluid rounded" src="{{ asset('images/product/21.png') }}" />
              <div class="product-info">
                <h4>Merchandise Promosi</h4>
                <p>Mug, kaos, payung, souvenir</p>
                <a class="details-link" href="https://wa.me/6281323000049"><i class="bi bi-whatsapp" style="color: rgb(3, 214, 3);"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    {{-- /Produk Section --}}
    {{-- Galeri Mesin Section --}}
    <section class="product section light-background" id="galeri">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <span>Galeri Mesin</span>
          <h2>Galeri Mesin</h2>
          <p>Pada bagian ini ditampilkan beberapa dokumentasi mesin cetak yang kami gunakan dalam proses produksi
            percetakan.</p>
        </div>
        <div class="container" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper init-swiper" data-breakpoints='{ "320": { "slidesPerView": 1, "spaceBetween": 40 }, "1200": { "slidesPerView": 3, "spaceBetween": 20 } }' data-delay="5000" data-speed="600">
            <script class="swiper-config" type="application/json">
              {
                "loop": true,
                "speed": 600,
                "autoplay": {
                  "delay": 2000
                },
                "slidesPerView": "auto",
                "pagination": {
                  "el": ".swiper-pagination",
                  "type": "bullets",
                  "clickable": true
                },
                "breakpoints": {
                  "320": {
                    "slidesPerView": 1,
                    "spaceBetween": 40
                  },
                  "1200": {
                    "slidesPerView": 3,
                    "spaceBetween": 20
                  }
                }
              }
            </script>
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <img alt="Mesin 1" class="img-fluid rounded" src="{{ asset('images/Galeri/Img1.jpg') }}" />
              </div>
              <div class="swiper-slide">
                <img alt="Mesin 2" class="img-fluid rounded" src="{{ asset('images/Galeri/Img2.jpg') }}" />
              </div>
              <div class="swiper-slide">
                <img alt="Mesin 3" class="img-fluid rounded" src="{{ asset('images/Galeri/Img3.jpg') }}" />
              </div>
              <div class="swiper-slide">
                <img alt="Mesin 4" class="img-fluid rounded" src="{{ asset('images/Galeri/Img4.jpg') }}" />
              </div>
              <div class="swiper-slide">
                <img alt="Mesin 5" class="img-fluid rounded" src="{{ asset('images/Galeri/Img5.jpg') }}" />
              </div>
            </div>
            <div class="swiper-pagination"></div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <footer class="footer" id="footer">
    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a class="d-flex align-items-center" href="{{ route('home') }}">
            <img alt="" class="img-fluid w-50" src="{{ asset('images/logo.png') }}" />
          </a>
          <div class="footer-contact pt-3">
            <p>Kp. Kebon Kalapa RT. 03 RW. 03 No. 49</p>
            <p>Banjaran - Bandung</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+62813 2300 0049</span></p>
            <p><strong>Email:</strong> <span>egisagitha@gmail.com </span></p>
          </div>
        </div>
        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#hero">Home</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#about">Tentang Kami</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#product">Produk</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#galeri">Galeri</a></li>
          </ul>
        </div>
        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#product">Percetakan Digital &amp; Offset</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#product">Percetakan Administratif</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#product">Percetakan Promosi &amp;produk Kemasan</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#product">Pengadaan Barang &amp; Jasa Lainnya</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">CV Pramudya Putra</strong> <span>All Rights
          Reserved</span></p>
    </div>
  </footer>
  {{-- Scroll Top --}}
  <a class="scroll-top d-flex align-items-center justify-content-center" href="#" id="scroll-top"><i class="bi bi-arrow-up-short"></i></a>
  {{-- Preloader --}}
  <div id="preloader"></div>
  {{-- Vendor JS Files --}}
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>
  {{-- Main JS File --}}
  <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
{{-- <div class="col-lg-4 col-md-12">
          <h4>Follow Us</h4>
          <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
          <div class="social-links d-flex">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div> --}}