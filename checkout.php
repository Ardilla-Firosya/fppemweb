<?php
include_once "koneksi.php";
session_start();
if (!isset($_SESSION['user'])) {
  Header('Location: log-in.php');
}

$idbarang = $_GET['idbarang'];
$jumlahbarang = $_GET['jumlah'];
$totalharga = $_GET['harga'];
$detailTRid = $_GET['idtr'];
// echo "<pre>";
// echo print_r($_SESSION['user']);
// echo "</pre>";
$idpengguna = $_SESSION['user']['ID_PENGGUNA'];
// echo $idpengguna;

if (isset($_POST['submit'])) {
  $query = "SELECT CONCAT('T', LPAD(SUBSTRING(ID_TRANSAKSI, 3) + 1, 3, '0')) as newT
FROM transaksi t 
ORDER BY DETAIL_TRANSAKSI_ID DESC
LIMIT 1;";
  $newT = $koneksi->query($query);
  $newT = $newT->fetch_assoc();
  $newT = $newT['newT'];

  $query = "INSERT INTO transaksi (ID_TRANSAKSI, DETAIL_TRANSAKSI_ID, ID_KURIR, ID_PENGGUNA, TOTAL_TRANSAKSI)
VALUES ('$newT', '$detailTRid', 'K1', '$idpengguna', '$totalharga')";
  $hasil = mysqli_query($koneksi, $query);

  if ($hasil) {
    header('Location: invoice.php?idTr=' . $newT);
    echo "<alert>success</alert>";
  } else {
    echo "<alert>failed</alert>";
  }
}
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
      <a class="navbar-brand" href="index.html">My Room<span>.</span></a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
        aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsFurni">
        <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li><a class="nav-link" href="shop.php">Shop</a></li>
          <li><a class="nav-link" href="about.php">About us</a></li>
          <li><a class="nav-link" href="contact.php">Contact us</a></li>
        </ul>

        <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
          <li>
            <a class="nav-link" href="#"><img src="images/user.svg" /></a>
          </li>
          <li>
            <a class="nav-link" href="cart.php"><img src="images/cart.svg" /></a>
          </li>
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
            <h1>Checkout</h1>
          </div>
        </div>
        <!-- <div class="col-lg-7"></div> -->
      </div>
    </div>
  </div>
  <!-- End Hero Section -->

  <div class="untree_co-section">
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-md-3">
          <div class="row mb-5">
            <div class="col-md-12">
              <h2 class="h3 mb-3 text-black">Your Order</h2>
              <div class="p-3 p-lg-5 border bg-white">
                <form action="" method="post">
                  <div class="form-group mb-3">
                    <label for="c_country" class="text-black">Kurir <span class="text-danger">*</span></label>
                    <select id="c_country" class="form-control">
                      <option value="1">Pilih Kurir</option>
                      <?php
                      $query = "SELECT ID_KURIR, NAMA_KURIR FROM kurir";
                      $result = mysqli_query($koneksi, $query);
                      while ($row = mysqli_fetch_array($result)) {
                        echo "<option name='kurir' value='" . $row['ID_KURIR'] . "'>" . $row['NAMA_KURIR'] . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                  <table class="table site-block-order-table mb-5">
                    <thead>
                      <th>Product</th>
                      <th>Total</th>
                    </thead>
                    <tbody>
                      <?php
                      $query = "select p.NAMA_PENGGUNA, dt.JUMLAH_BARANG, db.NAMA_BARANG, db.HARGA_BARANG, TOTAL_TRANSAKSI from transaksi t
                join detail_transaksi dt on dt.DETAIL_TRANSAKSI_ID = t.DETAIL_TRANSAKSI_ID
                join data_barang db on db.ID_BARANG = dt.ID_BARANG
                join kurir k on k.ID_KURIR = t.ID_KURIR
                join pengguna p on p.ID_PENGGUNA = t.ID_PENGGUNA
                WHERE t.ID_TRANSAKSI = 'T001'
                GROUP by p.NAMA_PENGGUNA
                ;";
                      $result = mysqli_query($koneksi, $query);
                      $totalharga = 0;
                      while ($row = mysqli_fetch_array($result)) {
                        $totalharga += $row['HARGA_BARANG'];
                        ?>
                        <tr>
                          <td>
                            <?php echo $row['NAMA_BARANG'] ?> <strong class="mx-2">x</strong>
                            <?php $row['JUMLAH_BARANG'] ?>
                          </td>
                          <td>Rp.
                            <?php echo $row['HARGA_BARANG'] ?>
                          </td>
                        </tr>
                        <?php
                      }
                      ?>
                    </tbody>
                  </table>

                  <div class="border p-3 mb-3">
                    <h3 class="h6 mb-0">
                      <a class="d-block" data-bs-toggle="collapse" href="#collapsebank" role="button"
                        aria-expanded="false" aria-controls="collapsebank">Direct Bank Transfer</a>
                    </h3>

                    <div class="collapse" id="collapsebank">
                      <div class="py-2">
                        <p class="mb-0">
                          Make your payment directly into our bank account.
                          Please use your Order ID as the payment reference.
                          Your order won’t be shipped until the funds have
                          cleared in our account.
                        </p>
                      </div>
                    </div>
                  </div>

                  <div class="border p-3 mb-3">
                    <h3 class="h6 mb-0">
                      <a class="d-block" data-bs-toggle="collapse" href="#collapsecheque" role="button"
                        aria-expanded="false" aria-controls="collapsecheque">Cheque Payment</a>
                    </h3>

                    <div class="collapse" id="collapsecheque">
                      <div class="py-2">
                        <p class="mb-0">
                          Make your payment directly into our bank account.
                          Please use your Order ID as the payment reference.
                          Your order won’t be shipped until the funds have
                          cleared in our account.
                        </p>
                      </div>
                    </div>
                  </div>

                  <div class="border p-3 mb-5">
                    <h3 class="h6 mb-0">
                      <a class="d-block" data-bs-toggle="collapse" href="#collapsepaypal" role="button"
                        aria-expanded="false" aria-controls="collapsepaypal">Paypal</a>
                    </h3>

                    <div class="collapse" id="collapsepaypal">
                      <div class="py-2">
                        <p class="mb-0">
                          Make your payment directly into our bank account.
                          Please use your Order ID as the payment reference.
                          Your order won’t be shipped until the funds have
                          cleared in our account.
                        </p>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <button class="btn btn-black btn-lg py-3 btn-block" onclick="window.location='thankyou.html'"
                      name="submit" type="submit" id="submit">
                      Place Order
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- </form> -->
    </div>
  </div>

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