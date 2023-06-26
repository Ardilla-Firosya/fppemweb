<?php
// Set session variables to be used on home.php page
$_SESSION['email'] = $_POST['email'];
$_SESSION['fullname'] = $_POST['fullname'];
// $_SESSION['last_name'] = $_POST['lastname'];
$_SESSION['address'] = $_POST['address'];
$_SESSION['phone'] = $_POST['phone'];

include_once 'koneksi.php';

// Escape all $_POST variables to protect against SQL injections
$fullname = $koneksi->escape_string($_POST['fullname']);
// $last_name = $koneksi->escape_string($_POST['lastname']);
$email = $koneksi->escape_string($_POST['email']);
$phone = $koneksi->escape_string($_POST['phone']);
$address = $koneksi->escape_string($_POST['address']);
$password = $koneksi->escape_string(password_hash($_POST['password'], PASSWORD_DEFAULT));
$hash = $koneksi->escape_string( md5( rand(0,1000) ) );

// Check if user with that email already exists
$result = $koneksi->query("SELECT * FROM pengguna WHERE EMAIL_PENGGUNA='$email'") or die($koneksi->error);

// We know user email exists if the rows returned are more than 0
if ( $result->num_rows > 0 ) {

    $_SESSION['message'] = 'User with this email already exists!';
    header("location: error.php");

}
else { // Email doesn't already exist in a database, proceed...

    // active is 0 by DEFAULT (no need to include it here)
    $idpengguna = "SELECT CONCAT('U', LPAD(SUBSTRING(ID_PENGGUNA, 2) + 1, 3, '0')) as newID
    FROM pengguna
    ORDER BY ID_PENGGUNA DESC
    LIMIT 1;";
    $idpengguna = $koneksi->query($idpengguna);
    $idpengguna = $idpengguna->fetch_assoc();
    $idpengguna = $idpengguna['newID'];

    $sql = "INSERT INTO pengguna (ID_PENGGUNA, NAMA_PENGGUNA, EMAIL_PENGGUNA, NO_TELP, ALAMAT_PEMBAYAR, PASSWORD_PENGGUNA) VALUES ('$idpengguna','$fullname','$email','$phone','$address','$password')";

    // Add user to the database
    if ( $koneksi->query($sql) ){

        $_SESSION['active'] = 1; //0 until user activates their account with verify.php
        $_SESSION['logged_in'] = true; // So we know the user has logged in
        $q = $koneksi->query("SELECT * FROM pengguna WHERE EMAIL_PENGGUNA='$email'");
        $user = $q->fetch_assoc();
        $_SESSION['sessCustomerID'] = $user['id'];

        header("location: ./");

    }

    else {
        $_SESSION['message'] = 'Registration failed!';
        header("location: error.php");
    }

}
