<?php
/* Main page with two forms: sign up and log in */
require 'koneksi.php';
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <title>Sign-Up/Login</title>
  <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="./css/style-login.css">
</head>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['login'])) { //user logging in
    $password = $_POST['email'];
    echo $password . "<br>";
    require 'login.php';

  } elseif (isset($_POST['register'])) { //user registering

    require 'register.php';

  }
}
?>

<body>
  <div class="form">

    <ul class="tab-group">
      <li class="tab"><a href="#signup">Sign Up</a></li>
      <li class="tab active"><a href="#login">Log In</a></li>
    </ul>

    <div class="tab-content">

      <div id="login">
        <h1>Welcome Back!</h1>

        <form action="log-in.php" method="post" autocomplete="off">

          <div class="field-wrap" style="height:35px">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email" required autocomplete="off" name="email" />
          </div>

          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password" required autocomplete="off" name="password" />
          </div>

          <button class="button button-block" name="login" />Log In</button>

        </form>

      </div>

      <div id="signup">
        <h1>Sign Up for Free</h1>

        <form action="log-in.php" method="post" autocomplete="off">

          <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email" required autocomplete="off" name='email' />
          </div>

          <div class="field-wrap">
            <label>
              Set A Password<span class="req">*</span>
            </label>
            <input type="password" required autocomplete="off" name='password' />
          </div>

          <div class="field-wrap">
            <label>
              Full Name<span class="req">*</span>
            </label>
            <input type="text" required autocomplete="off" name='fullname' />
          </div>

          <div class="field-wrap">
            <label>
              Address<span class="req">*</span>
            </label>
            <input type="text" required autocomplete="off" name='address' />
          </div>

          <div class="field-wrap">
            <label>
              Phone Number<span class="req">*</span>
            </label>
            <input type="tel" required autocomplete="off" name='phone' />
          </div>



          <button type="submit" class="button button-block" name="register" />Register</button>

        </form>

      </div>

    </div><!-- tab-content -->

  </div> <!-- /form -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="js/index.js"></script>

</body>

</html>