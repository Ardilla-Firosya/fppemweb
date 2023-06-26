<?php
/* User login process, checks if user exists and password is correct */
// session_start();

// Escape email to protect against SQL injections
$email = $koneksi->escape_string($_POST['email']);
$password = $koneksi->escape_string($_POST['password']);

$result = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE EMAIL_PENGGUNA='$email'");
// $result = $koneksi->query("SELECT * FROM pengguna WHERE EMAIL_PENGGUNA='$email'");

if ($result->num_rows == 0) { // User doesn't exist
    $_SESSION['message'] = "User with that email doesn't exist!";
    header("location: error.php");
} else { // User exists
    $hasil = mysqli_fetch_assoc($result);

    // print_r($_POST['password']);
    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    // $password = $_POST['email'];
    echo $password;
    $huh = password_verify($password, $hasil['PASSWORD_PENGGUNA']);
    echo "  huh?: " . $huh . " im pass " . $password;
    if (password_verify($password, $hasil['PASSWORD_PENGGUNA'])) {

        echo "Password is valid!";
        $_SESSION['user'] = $hasil;
        Header("Location: index.php");

        // $_SESSION['email'] = $user['EMAIL_PENGGUNA'];
        // $_SESSION['first_name'] = $user['NAMA_PENGGUNA'];
        // $_SESSION['last_name'] = $user['last_name'];
        // $_SESSION['active'] = $user['active'];
        // $_SESSION['address'] = $user['ALAMAT_PEMBAYAR'];
        // $_SESSION['phone'] = $user['NO_TELP'];
        // set customer ID in session
        // $_SESSION['sessCustomerID'] = $user['id'];
        // This is how we'll know the user is logged in
        // $_SESSION['logged_in'] = true;

        // if ($_SESSION['email']==="admin@eshop.com") {
        //   header("location: admin.php");
        // }
        // else
    } else {
        $_SESSION['message'] = "You have entered wrong password, try again!";
        // header("location: error.php");
    }
}