<?php
require 'function.php';

// Memproses form login jika ada data yang dikirim
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $username = $_POST['username'];
//     $password = $_POST['password'];

//     if (validateLogin($username, $password, $conn)) {
//         $_SESSION['username'] = $username;
//         header("Location: index.php"); // Ganti dengan halaman dashboard yang sesuai
//     } else {
//         $error = "Username atau password salah!";
//     }
// }
session_start();
if (isset($_SESSION['user'])) {
    // Redirect to index.php if already logged in
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']) ? $_POST['remember'] : false;



    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize user input
    $user = $conn->real_escape_string($user);
    $password = $conn->real_escape_string($password);

    // Hash the password using md5
    $hashedPassword = md5($password);

    // Retrieve user from the database
    $query = "SELECT * FROM `login` WHERE `user`='$user' AND `pass`='$hashedPassword'";
    $result = $conn->query($query);


    if ($result->num_rows == 1) {
        // User found, set session variables
        $_SESSION['user'] = $user;
        

        if ($remember) {
            // Create a remember me cookie
            $token = md5(uniqid(rand(), true));
            $expiry = time() + (60 * 60 * 24 * 30); // 30 days

            // Store the token in the database
            $query = "UPDATE `login` SET `token`='$token', `expiry`='$expiry' WHERE `user`='$user'";
            $conn->query($query);

            // Set the token as a cookie
            setcookie("remember_token", $token, $expiry);
        }

        // Redirect to index.php
        header("Location: index.php");
        exit;
    } else {
        // Invalid username or password
        $error = "Invalid username or password.";
    }

    $conn->close();
}
?>
<html>
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <div class="login-root">
    <div class="box-root flex-flex flex-direction--column" style="min-height: 100vh;flex-grow: 1;">
      <div class="loginbackground box-background--success padding-top--64">
      </div>
      <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9;">
        <div class="box-root padding-top--43 padding-bottom--24 flex-flex flex-justifyContent--center">
          <h1>Login</h1>
          <?php if (isset($error)) { ?>
                                <div>
                                    <script>
                                        alert("<?php echo $error; ?>");
                                    </script>
                                </div>
                            <?php } ?>
        </div>
        <div class="formbg-outer">
          <div class="formbg">
            <div class="formbg-inner padding-horizontal--48">
              <span class="padding-bottom--15" align="center">Login untuk Masuk</span>
              
              <form id="stripe-login" method="post" action="">
                <div class="field padding-bottom--24">
                  <label for="username">Username</label>
                  <input type="username" name="username" id="username" autocomplete="off">
                </div>
                <div class="field padding-bottom--24">
                  <div class="grid--50-50">
                    <label for="password">Password</label>
                  </div>
                  <input type="password" name="password">
                </div>
                <div class="field padding-bottom--24">
                  <input type="submit" name="submit" value="Masuk">
                </div>
             </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
