	<!DOCTYPE html>
	<html>
	<head>
		<title></title>
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
  <link href="css/tiny-slider.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet" />
		<script type="text/javascript" src="Charts.js"></script>
	</head>

	<body>
        <nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">
    <div class="container">
      <a class="navbar-brand" href="index.php">My Room<span>.</span></a>

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
          <li class="nav-item active"><a class="nav-link" href="graph.php">Grafik</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <h3 class="m-3">Grafik Penjualan Produk</h3>
<div style="width: 600px;height: 400px">
                                <canvas id="myChart"></canvas>
                            </div>
		
								<?php
	include 'koneksi.php';
	$query1 = mysqli_query($koneksi, "SELECT detail_transaksi.ID_BARANG, data_barang.nama_barang, SUM(SUB_TOTAL) AS subtotal, transaksi.tanggal_transaksi FROM detail_transaksi JOIN data_barang ON detail_transaksi.ID_BARANG = data_barang.ID_BARANG JOIN transaksi ON detail_transaksi.DETAIL_TRANSAKSI_ID = transaksi.DETAIL_TRANSAKSI_ID WHERE transaksi.tanggal_transaksi BETWEEN '2023-06-01' AND '2023-06-30' GROUP BY data_barang.nama_barang;");

	 while ($row = mysqli_fetch_array($query1)) {
                                $category_name[] = $row['nama_barang'];
                                $total_revenue[] = $row['subtotal'];

                                $category_name_string = "'" . implode("','", $category_name) . "'";
                                $total_revenue_string = implode(",", $total_revenue);
                            }
	?>
	                            <script>
	                                var ctx = document.getElementById("myChart").getContext('2d');
	                                var myChart = new Chart(ctx, {
	                                    type: 'bar',
	                                    data: {
	                                        labels: <?php echo json_encode($category_name); ?>,
	                                        datasets: [{
	                                            label: 'Grafik Total Penjualan',
	                                            data: <?php echo json_encode($total_revenue); ?>,
	                                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
	                                            borderColor: 'rgba(255,99,132,1)',
	                                            borderWidth: 1
	                                        }]
	                                    },
	                                    options: {
	                                        scales: {
	                                            yAxes: [{
	                                                ticks: {
	                                                    beginAtZero: true
	                                                }
	                                            }]
	                                        }
	                                    }
	                                });
	                            </script>
	</body>
	</html>