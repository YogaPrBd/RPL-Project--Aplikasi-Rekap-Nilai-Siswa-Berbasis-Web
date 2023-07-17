<?php
    include "connection.php";
    session_start();

    set_error_handler(function (int $errno, string $errstr) {
        if ((strpos($errstr, 'Undefined array key') === false) && (strpos($errstr, 'Undefined variable') === false)) {
            return false;
        } else {
            return true;
        }
    }, E_WARNING);
?>

<style>
    <?php include 'style.css'; ?>
</style>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="fontawesome/css/brands.css" rel="stylesheet">
    <link href="fontawesome/css/solid.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="bootstrap/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.2.1/chart.min.js" integrity="sha512-v3ygConQmvH0QehvQa6gSvTE2VdBZ6wkLOlmK7Mcy2mZ0ZF9saNbbk19QeaoTHdWIEiTlWmrwAL4hS8ElnGFbA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="style.css">
    
    <title>Setiing | ReNi</title>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark" >
            <div class="container-fluid" style="background-color:#12427b; min-height:60px">
                <a class="navbar-brand" href="home.php">ReNi</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="daftar_siswa.php">Daftar Siswa</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="input_nilai.php">Input Nilai</a>
                    </li>  
                </ul>
                <!-- Tampilin Nama Username -->
                <ul class="navbar-nav">
                <li class="nav-item dropdown" >
                        <a class="nav-link active dropdown" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user"></i> Username
                        </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="setting.php">Setting</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <!-- Fungsi Untuk Logout -->
                                <li><a class="dropdown-item" href="logout.php">Logout <i class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
                            </ul>
                </li>
                </ul>
                </div>
            </div>
        </nav>
    <!-- Akhir Nav -->
        <div class="content">
            <h2 align="center">Setting</h2>
            <br>
            <div class="card-setting">
                <h4>Profile</h4>
                <!-- Form edit Username -->
                <form class="row g-1 needs-validation" novalidate>
                    <?php
                        $search = "SELECT username, nama FROM user WHERE username = '". $_SESSION['username'] ."' LIMIT 1";
                        $searchResult = mysqli_query($conn, $search);
                        
                        while($nama = mysqli_fetch_row($searchResult)){
                    ?>
                    <div class="col-md-4">
                        <label for="validationNama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="validationNama" value="<?php echo($nama['1']);?>" required>
                    </div>
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                        <label for="validationUser" class="form-label">Username</label>
                        <input type="text" class="form-control" id="validationUser" value="<?php echo($nama['0']);?>"  required>
                    </div>
                    <?php } ?>
                    
                    <div class="col-12"></div>
                    <br>
                    <div class="col-md-3"></div>
                    <div class="col-4">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
            <div class="card-setting">
                <h4>Password</h4>
                <!-- Form edit Password -->
                <form name="GantiPassword" method="post" class="row g-1 needs-validation" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="col-md-4">
                        <label for="validationPassLama" class="form-label">Password Lama</label>
                        <input type="password" class="form-control" name="validationPassLama"  required>
                    </div>
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                        <label for="validationPassBaru" class="form-label">Password Baru</label>
                        <input type="password" class="form-control" name="validationPassBaru"  required>
                    </div>
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                        <label for="validationPassKonf" class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" name="validationPassKonf"  required>
                    </div>
                    <div class="col-12"></div>
                    <br>
                    <div class="col-md-3"></div>
                    <div class="col-3">
                        <button class="btn btn-primary" type="submit" name="GantiPassword" value="GantiPassword">Save</button>
                    </div>
                    <?php
                        if($_POST['GantiPassword']){
                            $oldPass = md5($_POST['validationPassLama']);
                            $newPass = md5($_POST['validationPassBaru']);
                            $newPassConf = md5($_POST['validationPassKonf']);

                            $sql1 = "SELECT * FROM user WHERE username = '". $_SESSION['username'] ."' and password = '". $oldPass ."' LIMIT 1";
                            $result = mysqli_query($conn, $sql1);
                            $sql1Row = mysqli_num_rows($result);

                            if($newPassConf == $newPass && $sql1Row == 1){
                                $sql = "UPDATE user set password = '". $newPass ."' WHERE username = '" . $_SESSION['username'] . "'";
                                mysqli_query($conn, $sql);
                                echo ("Password berhasil diubah");
                            }else{
                                echo ("Password yang dimasukkan belum benar");
                            }
                    }
                    ?>
                </form>
            </div>
            <div class="batas"></div>
        </div>
    </div>
</body>
</html>