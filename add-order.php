<?php
include_once('koneksi.php');
session_start();
if (!isset($_SESSION['user'])) {
  Header('Location: log-in.php');
}

if (isset($_POST['submit'])) {
  $idbarang = $_POST['idbarang'];
  $jumlahbarang = $_POST['jumlah'];
  $totalharga = $_POST['harga'];

  $query = "SELECT CONCAT('DT', LPAD(SUBSTRING(DETAIL_TRANSAKSI_ID, 3) + 2, 3, '0')) as newDT
    FROM detail_transaksi
    ORDER BY DETAIL_TRANSAKSI_ID DESC
    LIMIT 1;";
  $newDT = $koneksi->query($query);
  $newDT = $newDT->fetch_assoc();
  $newDT = $newDT['newDT'];

  $query = "INSERT INTO DETAIL_TRANSAKSI (DETAIL_TRANSAKSI_ID, ID_BARANG, JUMLAH_BARANG, SUB_TOTAL) 
    VALUES ('$newDT', '$idbarang', '$jumlahbarang', '$totalharga')";
  $hasil = mysqli_query($koneksi, $query);
  $detailTRid = mysqli_insert_id($koneksi);


  // $query = "SELECT CONCAT('T', LPAD(SUBSTRING(ID_TRANSAKSI, 2) + 1, 3, '0')) as newT
  // FROM transaksi t 
  // ORDER BY DETAIL_TRANSAKSI_ID DESC
  // LIMIT 1;";
  // $newT = $koneksi->query($query);
  // $newT = $newT->fetch_assoc();
  // $newT = $newT['newT'];

  // $query = "INSERT INTO transaksi (ID_TRANSAKSI, DETAIL_TRANSAKSI_ID, ID_KURIR, ID_PENGGUNA, TOTAL_TRANSAKSI)
  // VALUES ('$newT', '$detailTRid', 'K001', 'U001', '$totalharga')";
  // $hasil = mysqli_query($koneksi, $query);


  // Add user to the database
  if ($hasil) {
    header("location: checkout.php?idbarang=$idbarang&idtr=$newDT&jumlah=$jumlahbarang&harga=$totalharga");
  } else {
    $_SESSION['message'] = 'Registration failed!';
    header("location: error.php");
  }
}
?>