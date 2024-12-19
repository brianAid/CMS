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
   <title>Beranda</title>
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
                              <li class="active"> <a href="index.html">Home</a> </li>
                              <li> <a href="#product">product</a> </li>
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
   <section class="slider_section">
      <div id="main_slider" class="carousel slide banner-main" data-ride="carousel">

         <div class="carousel-inner" style="justify-content:center;">
            <?php $no = 1;
            foreach ($caraousel as $caro) { ?>
               <div class="carousel-item <?php if ($no == 1) {
                  echo "active";
               } ?>">
                  <div class="carousel-img"
                     style="background-image:url('<?= base_url('assets/upload/caraousel/') ?><?= $caro['foto'] ?>')">
                  </div>
               </div>
               <?php $no++;
            } ?>
         </div>

         <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="prev">
            <i class='fa fa-angle-right'></i>
         </a>
         <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
            <i class='fa fa-angle-left'></i>
         </a>

      </div>

   </section>


   <!-- our product -->
   <div class="product">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="title">
                  <h2>our <strong class="black">products</strong></h2>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="product-bg">
      <div class="pt-5 product-bg-white">
         <div id="product" class="container">
            <div class="row mb-3">
               <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12   ">
                  <div class="menu-area">
                     <div class="limit-box">
                        <nav class="main-menu">
                           <ul class="menu-area-main">
                              <li class="active"> <a href="<?= base_url('#product') ?>">Home</a> </li>
                              <?php foreach ($kategori as $kate) { ?>
                                 <li> <a
                                       href="<?= base_url('kategori/') . $kate['id_kategori'] . '#product' ?>"><?= $kate['nama_kategori'] ?></a>
                                 </li>
                              <?php } ?>
                           </ul>
                        </nav>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <?php foreach ($konten as $k) { ?>
                  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                     <div class="product-box">
                        <i><img class="product-img" src="<?= base_url('assets/upload/konten/') . $k['foto'] ?>" /></i>
                        <h3><?= $k['judul'] ?></h3>
                     </div>
                     <div class="link"><a class="buy" href="<?= base_url('post/' . $k['slug']) ?>">Detail</a></div>
                  </div>
               <?php } ?>
            </div>
         </div>
      </div>
   </div>

   <!-- end our product -->




   <footr>
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
   </footr>
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