<?php
include_once("koneksi.php");
session_start();
if (!isset($_SESSION['user'])) {
  Header('Location: log-in.php');
}

$idbarang = $_GET['idbarang'];
$number = $_GET['number'];
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
            <h1>Cart</h1>
          </div>
        </div>
        <div class="col-lg-7"></div>
      </div>
    </div>
  </div>
  <!-- End Hero Section -->

  <div class="untree_co-section before-footer-section">
    <div class="container">
      <div class="row mb-5">
        <div class="site-blocks-table">
          <table class="table">
            <thead>
              <tr>
                <th class="product-thumbnail">Image</th>
                <th class="product-name">Product</th>
                <th class="product-price">Price</th>
                <th class="product-quantity">Quantity</th>
                <th class="product-total">Total</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $idbarang = $_GET['idbarang'];
              $query = "SELECT ID_BARANG, NAMA_BARANG, HARGA_BARANG FROM data_barang WHERE ID_BARANG = '$idbarang'";
              $result = mysqli_query($koneksi, $query);
              $i = 1;
              while ($row = mysqli_fetch_assoc($result)) {
                $harga = $row['HARGA_BARANG'];
                $idbarang = $row['ID_BARANG'];
                // $harga = number_format($row['HARGA_BARANG'], 0, '.', ',');
                ?>
                <tr>
                  <td class="product-thumbnail">
                    <img src="images/mebel-<?php echo $number ?>.png" alt="Image" class="img-fluid" />
                  </td>
                  <td class="product-name">
                    <h2 class="h5 text-black">
                      <?php echo $row['NAMA_BARANG'] ?>
                    </h2>
                  </td>
                  <td>
                    <?php echo $harga ?>
                  </td>
                  <td>
                    <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px">
                      <div class="input-group-prepend">
                        <button class="btn btn-outline-black turun" type="button">
                          &minus;
                        </button>
                      </div>
                      <!-- <input type="text" class="form-control text-center quantity-amount" value="" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" /> -->
                      <input type="text" class="form-control text-center quantity-amount" name="quantity" value="1"
                        placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" />
                      <div class="input-group-append">
                        <button class="btn btn-outline-black naik" type="button">
                          &plus;
                        </button>
                      </div>
                    </div>
                  </td>
                  <td id="setPrice">
                    <input type="text" id="totalPrice" value="<?php echo $harga ?>" readonly>
                  </td>
                </tr>
                <?php $i++;
              } ?>

            </tbody>
          </table>
        </div>
      </div>
      <div class="col-md-12 pl-5">
        <div class="row justify-content-end">
          <div class="col-md-7">
            <div class="row">
              <div class="col-md-12 text-right border-bottom mb-5">
                <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <span class="text-black">Subtotal</span>
              </div>
              <div class="col-md-6 text-right">
                <input type="text" id="subtotal" value="<?php echo $harga ?>" readonly>
                <!-- <strong class="text-black" id="subtotal"><?php echo $harga ?></strong> -->
              </div>
            </div>
            <div class="row mb-5">
              <div class="col-md-6">
                <span class="text-black">Total</span>
              </div>
              <div class="col-md-6 text-right">
                <input type="text" id="mengtotal" value="<?php echo $harga ?>" readonly>
                <!-- <strong class="text-black"><?php echo $harga ?></strong> -->
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <form action="add-order.php" method="post">
                  <input type="hidden" name="idbarang" value="<?php echo $idbarang ?>">
                  <input type="hidden" name="harga" value="<?php echo $harga ?>">
                  <input type="hidden" name="jumlah" value="2">
                  <input type="hidden" name="hidden_quantity" value="">
                  <button class="btn btn-black btn-lg py-3 btn-block" type="submit" name="submit" id="submit">Proceed to
                    Checkout</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
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
            Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio
            quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam
            vulputate velit imperdiet dolor tempor tristique. Pellentesque
            habitant
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

  <script>
    var quantityInput = document.querySelector('.quantity-amount');
    var hiddenQuantityInput = document.querySelector('input[name="hidden_quantity"]');
    var increaseButton = document.querySelector('.naik');
    var decreaseButton = document.querySelector('.turun');

    // Get the quantity input and price element
    // const quantityInput = document.querySelector('.quantity-amount');
    const priceElement = document.getElementById('totalPrice');
    const subtotal = document.getElementById('subtotal');
    const total = document.getElementById('mengtotal');

    // Get the initial price value
    const initialPrice = parseFloat(priceElement.value);

    // Get the quantity value

    // Function to calculate the total price
    function calculateTotalPrice() {
      var quantityValue = parseInt(quantityInput.value);
      const quantity = quantityValue;
      console.log(quantity);
      const totalPrice = initialPrice * quantity;
      console.log(totalPrice);
      // priceElement.textContent = totalPrice;
      priceElement.value = totalPrice;
      subtotal.value = totalPrice;
      total.value = totalPrice;
    }

    document.addEventListener('DOMContentLoaded', function () {

      increaseButton.addEventListener('click', function () {
        var quantityValue = parseInt(quantityInput.value);
        quantityInput.value = quantityValue + 1;
        hiddenQuantityInput.value = quantityValue + 1;
        calculateTotalPrice();
      });

      decreaseButton.addEventListener('click', function () {
        var quantityValue = parseInt(quantityInput.value);
        if (quantityValue > 0) {
          quantityInput.value = quantityValue - 1;
          hiddenQuantityInput.value = quantityValue - 1;
          calculateTotalPrice();
        }
      });
    });




    // // Event listener for the increase button
    // document.querySelector('.increase').addEventListener('click', () => {
    //   quantityInput.value = parseFloat(quantityInput.value) + 1;
    //   calculateTotalPrice();
    // });

    // // Event listener for the decrease button
    // document.querySelector('.decrease').addEventListener('click', () => {
    //   if (quantityInput.value > 1) {
    //     quantityInput.value = parseFloat(quantityInput.value) - 1;
    //     calculateTotalPrice();
    //   }
    // });

    // // Event listener for the quantity input change
    // quantityInput.addEventListener('change', () => {
    //   calculateTotalPrice();
    // });
  </script>

  </script>
  <!-- var quantityInputs = document.getElementsByClassName('quantity-amount');

function updatePrice(event) {
  var quantityInput = event.target;
  var row = quantityInput.closest('tr');
  var priceElement = row.querySelector('[id^="setPrice"]');

  var quantity = parseInt(quantityInput.value);
  var price = parseFloat(priceElement.textContent.replace('Rp.', '').replace('.', '').replace(',', '.'));
  var total = quantity * price;
  priceElement.textContent = 'Rp.' + formatPrice(total);
}

for (var i = 0; i < quantityInputs.length; i++) {
  quantityInputs[i].addEventListener('change', updatePrice);
}

function formatPrice(price) {
  return price.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, '.');
} -->
  <script>

  </script>
</body>

</html>