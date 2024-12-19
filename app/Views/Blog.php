<!DOCTYPE html>
<html lang="en">

<head>
  <!-- basic -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- mobile metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1">
  <!-- site metas -->
  <title><?= $konten['judul'] ?></title>
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- bootstrap css -->
  <link rel="stylesheet" href="<?= base_url('assets/front/') ?>css/bootstrap.min.css">
  <!-- style css -->
  <link rel="stylesheet" href="<?= base_url('assets/front/') ?>css/style.css">
  <!-- Responsive-->
  <link rel="stylesheet" href="<?= base_url('assets/front/') ?>css/responsive.css">
  <!-- Scrollbar Custom CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/front/') ?>css/jquery.mCustomScrollbar.min.css">
  <!-- Tweaks for older IEs-->
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
    media="screen">
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<!-- body -->
<style>
  .carousel-item .active {
    display: flex !important;
    justify-content: center !important;
  }

  .carousel-img {
    margin: 5px auto;
    width: 80%;
    height: 400px;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    border-radius: 8px;
    box-shadow: 4px 4px 8px 1px #ffc221;
  }

  .product-img {
    position: relative;
    z-index: 1;
    transition: transform 0.4s ease;
  }

  .link {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    color: black;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    visibility: hidden;
    z-index: 2;
    transition: opacity 0.4s ease, visibility 0.4s ease;
  }

  .col-xl-3:hover .link {
    opacity: 1;
    visibility: visible;
  }

  .col-xl-3:hover .product-box {
    transform: scale(0.95);
    background: #fdc24f;
  }
</style>

<body class="main-layout">
  <!-- loader  -->
  <div class="loader_bg">
    <div class="loader"><img src="<?= base_url('assets/front/') ?>images/loading.gif" alt="#" /></div>
  </div>
  <!-- end loader -->
  <!-- header -->
  <header>
    <!-- header inner -->
    <div class="header">
      <div class="head_top">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
              <div class="top-box">
                <ul class="sociel_link">
                  <li> <a href="<?= $konfigurasi['facebook'] ?>"><i class="fa fa-facebook-f"></i></a></li>
                  <li> <a href="mailto:<?= $konfigurasi['email'] ?>"><i class="fa fa-envelope"></i></a></li>
                  <li> <a href="<?= $konfigurasi['instagram'] ?>"><i class="fa fa-instagram"></i></a></li>
                  <li> <a href="https://wa.me/+<?= $konfigurasi['no_wa'] ?>"><i class="fa fa-whatsapp"></i></a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="d-flex align-items-center col-xl-8 col-lg-8 col-md-8 col-sm-12">
              <?= $konfigurasi['profil_website'] ?>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col logo_section">
            <div class="full">
              <div class="center-desk">
                <div class="logo "> <a style="color: #ffc221;"
                    href="index.html"><?= $konfigurasi['judul_website'] ?></a> </div>
              </div>
            </div>
          </div>
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12   ">
            <div class="menu-area">
              <div class="limit-box">
                <nav class="main-menu">
                  <ul class="menu-area-main">
                    <li> <a href="<?= base_url() ?>">Home</a> </li>
                    <li class="active"> <a href="#product">product</a> </li>
                    <li> <a href="<?= base_url('register') ?>">signup</a> </li>
                    <li> <a href="<?= base_url('login') ?>">Login</a></li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end header inner -->
  </header>
  <!-- end header -->
  <div class="about">
    <div class="container">
      <div class="row">
        <dir class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
          <div class="about_box">
            <figure><img src="<?= base_url('assets/upload/konten/') . $konten['foto'] ?>" /></figure>
          </div>
        </dir>
        <dir class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
          <div class="about_box">
            <h3><?= $konten['judul'] ?></h3>
            <div>
              <?= $konten['keterangan'] ?>
            </div>
          </div>
        </dir>
      </div>
    </div>
  </div>

  <!-- CHOOSE  -->
  <div class="whyschose">
    <div class="container">

      <div class="row">
        <div class="col-md-7 offset-md-3">
          <div class="title">
            <h2>See <strong class="black">Recent Product</strong></h2>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="choose_bg">
    <div class="container">
      <div class="white_bg">
        <div class="row">
          <?php foreach ($recentKonten as $konten) { ?>
            <dir class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
              <div class="for_box">
                <i><img src="<?= base_url('assets/upload/konten/') . $konten['foto'] ?>" alt="img" /></i>
                <h3></h3>
                <a href="<?= base_url('post/' . $konten['slug']) ?>"><?= $konten['judul'] ?></a>
              </div>
            </dir>
          <?php } ?>

          <div class="col-md-12">
            <a href="<?= base_url('#product') ?>" class="read-more">See All</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end CHOOSE -->


  <!--  footer -->
  <footer>
    <div class="footer">
      <div class="container">
        <div class="row">
          <div class="col text-center">
            <h1 class="text-white"><?= $konfigurasi['judul_website'] ?></h1>
            <span><?= $konfigurasi['profil_website'] ?></span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <ul class="sociel mb-5">
              <li> <a href="<?= $konfigurasi['facebook'] ?>"><i class="fa fa-facebook-f"></i></a></li>
              <li> <a href="mailto:<?= $konfigurasi['email'] ?>"><i class="fa fa-envelope"></i></a></li>
              <li> <a href="<?= $konfigurasi['instagram'] ?>"><i class="fa fa-instagram"></i></a></li>
              <li> <a href="https://wa.me/+<?= $konfigurasi['no_wa'] ?>"><i class="fa fa-whatsapp"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- end footer -->
  <!-- Javascript files-->
  <script src="<?= base_url('assets/front/') ?>js/jquery.min.js"></script>
  <script src="<?= base_url('assets/front/') ?>js/popper.min.js"></script>
  <script src="<?= base_url('assets/front/') ?>js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('assets/front/') ?>js/jquery-3.0.0.min.js"></script>
  <script src="<?= base_url('assets/front/') ?>js/plugin.js"></script>
  <!-- sidebar -->
  <script src="<?= base_url('assets/front/') ?>js/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="<?= base_url('assets/front/') ?>js/custom.js"></script>
  <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
  <script>
    $(document).ready(function () {
      $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
      });

      $(".zoom").hover(function () {

        $(this).addClass('transition');
      }, function () {

        $(this).removeClass('transition');
      });
    });

  </script>
</body>

</html>