<style>
    <?php include 'style.css'; ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="bootstrap/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <title>Login</title>

</head>
<body>
    <div class="container">
        <div class="pagelogin">
            <br>
            <img src="img/judul-putih.png" id="jdl">
            <h3 align="center" style="color: #fff">Sign In</h3>
            <br>
            <div class="formlog">
                <!-- Form Inputan Login -->
                <form action="" method="post">
                    <input type="text" name="username" id="username" class="form-control form-control-md" placeholder=" Username..." require>
                    <br>
                    <input type="password" name="psw" id="psw" class="form-control form-control-md" placeholder=" Password..." require>
                    <br>
                    <div class="cls_btn">
                        <button type="submit" class="btn_signin">Sign In</button>
                    </div>
                </form>
            </div>
            <br>
            <!-- <p style="color:#fff; font-size:12px" align="center">Don't have account? <b><a href="singup.php"  style="color: #00eaff">Sign Up</a></b></p> -->
        </div>
    </div>
</body>
</html>