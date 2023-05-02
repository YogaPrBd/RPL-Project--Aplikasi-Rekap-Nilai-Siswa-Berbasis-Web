<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gagal Login</title>
</head>
<body>
<?php
session_start();
include "../connection.php";
$username = $_POST['username'];
$password = md5($_POST['password']);

$sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";

$login = mysqli_query($conn, $sql);
$ketemu = mysqli_num_rows($login);
$r = mysqli_fetch_array($login);

if ($ketemu > 0) {
    $_SESSION['username'] = $r['username'];
    $_SESSION['level'] = $r['level'];

    echo "<script>
        window.location.replace('../index.php');
    </script>";
} else {?>
    <center><h3>Login gagal! username & password tidak benar<br></h3>
    <a href=../index.php><button class="btn btn-primary">ULANGI LAGI</button></a></center>
    <?php
}

mysqli_close($con);?>
</body>
</html>
