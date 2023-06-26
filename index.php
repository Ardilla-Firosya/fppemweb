<?php
include_once("koneksi.php");

// echo "<pre>";
// print_r($_SESSION['user']);
// print_r($_SESSION['message']);
// echo "</pre>";

?>

<!-- /*
* Bootstrap 5
* Template Name: Furni
* Template Author: Untree.co
* Template URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="author" content="Untree.co" />
  <link rel="shortcut icon" href="favicon.png" />

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
  <link href="css/tiny-slider.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet" />
  <title>My Room</title>
</head>

<body>
  <!-- Start Header/Navigation -->
  <nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">
    <div class="container">
      <a class="navbar-brand" href="index.php">My Room<span>.</span></a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
        aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsFurni">
        <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li><a class="nav-link" href="shop.php">Shop</a></li>
          <li><a class="nav-link" href="about.php">About us</a></li>
          <li><a class="nav-link" href="contact.php">Contact us</a></li>
          <li><a class="nav-link" href="graph.php">Grafik</a></li>
        </ul>


      </div>
    </div>
  </nav>
  <!-- End Header/Navigation -->

  <!-- Start Hero Section -->
  <div class="hero">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-lg-5">
          <div class="intro-excerpt">
            <h1>
              Setiawan
              <span clsas="d-block"><br />
                Webstore</span>
            </h1>
            <p class="mb-4">
              Toko Funiture Pilihan untuk Mewujudkan Interior Impian Anda.
              <br />Pilih Kualitas, Wujudkan Keindahan Bersama Meubel Kami.
            </p>
            <p>
              <a href="" class="btn btn-secondary me-2">Shop Now</a><a href="#"
                class="btn btn-white-outline">Explore</a>
            </p>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="hero-img-wrap">
            <img src="images/couch.png" class="img-fluid" />
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Hero Section -->

  <!-- Start Product Section -->
  <div class="product-section">
    <div class="container">
      <div class="row">

        <!-- Start Column 1 -->
        <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
          <h2 class="mb-4 section-title">Best Seller Kami</h2>
          <p class="mb-4">
            Best Seller kami adalah produk unggulan yang telah memikat hati
            pelanggan kami dengan keunggulan dan kualitasnya yang luar biasa.
          </p>
          <p><a href="shop.html" class="btn">Explore</a></p>
        </div>
        <!-- End Column 1 -->


        <?php
        $query = "SELECT ID_BARANG, NAMA_BARANG, HARGA_BARANG FROM data_barang LIMIT 3";
        $result = mysqli_query($koneksi, $query);
        $i = 1;
        while ($row = mysqli_fetch_assoc($result)) {
          $harga = number_format($row['HARGA_BARANG'], 0, '.', ',');
          ?>
          <!-- Start Column 2 -->
          <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
            <a class="product-item" href="cart.php?idbarang=<?php echo $row['ID_BARANG'] ?>&number=<?php echo $i ?>">
              <img src="./images/mebel-<?php echo $i ?>.png" class="img-fluid product-thumbnail" />
              <h3 class="product-title">
                <?php echo $row['NAMA_BARANG'] ?>
              </h3>
              <strong class="product-price">Rp.
                <?php echo $harga ?>
              </strong>

              <span class="icon-cross">
                <img src="images/cross.svg" class="img-fluid" />
              </span>
            </a>
          </div>
          <!-- End Column 2 -->
          <?php $i++;
        } ?>
      </div>
    </div>
  </div>
  <!-- End Product Section -->

  <!-- Start Why Choose Us Section -->
  <div class="why-choose-section">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-lg-6">
          <h2 class="section-title">Why Choose Us</h2>
          <p>
            My Room memberikan pelayanan pelanggan yang unggul dan profesional. Tim yang berdedikasi siap membantu Anda
            dalam memilih furnitur yang sesuai dengan kebutuhan dan memberikan saran desain yang terbaik. Dari
            konsultasi awal hingga pengiriman, My Room menjamin pengalaman pelanggan yang lancar, ramah, dan
            memuaskan.
          </p>

          <div class="row my-5">
            <div class="col-6 col-md-6">
              <div class="feature">
                <div class="icon">
                  <img src="images/truck.svg" alt="Image" class="imf-fluid" />
                </div>
                <h3>Fast &amp; Free Shipping</h3>
                <p>
                  Pengiriman cepat dan aman bagi para customer.
                </p>
              </div>
            </div>

            <div class="col-6 col-md-6">
              <div class="feature">
                <div class="icon">
                  <img src="images/bag.svg" alt="Image" class="imf-fluid" />
                </div>
                <h3>Easy to Shop</h3>
                <p>
                  Lebih mudah untuk berbelanja karena berbasis online.
                </p>
              </div>
            </div>

            <div class="col-6 col-md-6">
              <div class="feature">
                <div class="icon">
                  <img src="images/support.svg" alt="Image" class="imf-fluid" />
                </div>
                <h3>24/7 Support</h3>
                <p>
                  Kami juga setia melayani 24 jam untuk para customer tercinta.
                </p>
              </div>
            </div>

            <div class="col-6 col-md-6">
              <div class="feature">
                <div class="icon">
                  <img src="images/return.svg" alt="Image" class="imf-fluid" />
                </div>
                <h3>Hassle Free Returns</h3>
                <p>
                  Pengembalian tanpa repot jika barang atau meubel mengalami cacat produk.
                </p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-5">
          <div class="img-wrap">
            <img src="images/why-choose-us-img.jpg" alt="Image" class="img-fluid" />
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Why Choose Us Section -->

  <br>
  <p></p>
  </br>

  <!-- Start Footer Section -->
  <footer class="footer-section">
    <div class="container relative">
      <div class="sofa-img">
        <img src="images/sofa.png" alt="Image" class="img-fluid" />
      </div>
      <div class="row g-5 mb-5">
        <div class="col-lg-4">
          <div class="mb-4 footer-logo-wrap">
            <a href="#" class="footer-logo">My Room<span>.</span></a>
          </div>
          <p class="mb-4">
            Dari pilihan bahan berkualitas hingga sentuhan akhir yang sempurna, My Room memberikan perpaduan yang
            harmonis antara keindahan dan kepraktisan. Desain yang inovatif dan fungsional memastikan bahwa setiap
            ruangan dapat digunakan secara optimal tanpa mengorbankan estetika.
          </p>

          <ul class="list-unstyled custom-social">
            <li>
              <a href="#"><span class="fa fa-brands fa-facebook-f"></span></a>
            </li>
            <li>
              <a href="#"><span class="fa fa-brands fa-twitter"></span></a>
            </li>
            <li>
              <a href="#"><span class="fa fa-brands fa-instagram"></span></a>
            </li>
            <li>
              <a href="#"><span class="fa fa-brands fa-linkedin"></span></a>
            </li>
          </ul>
        </div>

        <div class="col-lg-8">
          <div class="row links-wrap">
            <div class="col-6 col-sm-6 col-md-3">
              <ul class="list-unstyled">
                <li><a href="#">About us</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Contact us</a></li>
              </ul>
            </div>

            <div class="col-6 col-sm-6 col-md-3">
              <ul class="list-unstyled">
                <li><a href="#">Support</a></li>
                <li><a href="#">Knowledge base</a></li>
                <li><a href="#">Live chat</a></li>
              </ul>
            </div>

            <div class="col-6 col-sm-6 col-md-3">
              <ul class="list-unstyled">
                <li><a href="#">Jobs</a></li>
                <li><a href="#">Our team</a></li>
                <li><a href="#">Leadership</a></li>
                <li><a href="#">Privacy Policy</a></li>
              </ul>
            </div>

            <div class="col-6 col-sm-6 col-md-3">
              <ul class="list-unstyled">
                <li><a href="#">Nordic Chair</a></li>
                <li><a href="#">Kruzo Aero</a></li>
                <li><a href="#">Ergonomic Chair</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="border-top copyright">
        <div class="row pt-4">
          <div class="col-lg-6">
            <p class="mb-2 text-center text-lg-start">
              Copyright &copy;
              <script>
                document.write(new Date().getFullYear());
              </script>
              . All Rights Reserved.
            </p>
          </div>

          <div class="col-lg-6 text-center text-lg-end">
            <ul class="list-unstyled d-inline-flex ms-auto">
              <li class="me-4"><a href="#">Terms &amp; Conditions</a></li>
              <li><a href="#">Privacy Policy</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- End Footer Section -->

  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/tiny-slider.js"></script>
  <script src="js/custom.js"></script>
</body>

</html>