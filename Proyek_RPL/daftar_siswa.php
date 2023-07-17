<style>
    <?php include 'style.css'; 
    set_error_handler(function (int $errno, string $errstr) {
        if ((strpos($errstr, 'Undefined array key') === false) && (strpos($errstr, 'Undefined variable') === false)) {
            return false;
        } else {
            return true;
        }
    }, E_WARNING);?>
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

    <title>Daftar Siswa | ReNi</title>
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
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="daftar_siswa.php">Daftar Siswa</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="input_nilai.php">Input Nilai</a>
                    </li>  
                </ul>
                <!-- Tampilin Nama Username sesuai database -->
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
    <!-- Content -->
        <div class="content">
            <h2 align="center">Daftar Siswa/Kelas</h2>
            <br>
            <!-- Form input data siswa -->
            <div class="input_data">
                <h4 style="text-decoration: underline;">Tambah Siswa</h4>
                <br>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <div class="row mb-3" style="max-width:800px">
                        <label for="inputNama" class="col-sm-2 col-form-label" >Nama Lengkap</label>
                        <div class="col-sm-10">
                        <input type="text" name="inputNama" class="form-control" id="inputNama" require>
                        </div>
                    </div>
                    <div class="row mb-3" style="max-width:800px">
                        <label for="inputNis" class="col-sm-2 col-form-label" >NIS</label>
                        <div class="col-sm-10">
                        <input type="number" name="inputNis" class="form-control" id="inputNis" require>
                        </div>
                    </div>
                    <div class="row mb-3" style="max-width:800px">
                        <label for="inputJK" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-auto">

                                <input type="radio" name="inputJK" value="Laki-Laki">Laki-laki
                                <input type="radio" name="inputJK" value="perempuan">Perempuan

                        </div>
                    </div>
                    <div class="row mb-3" style="max-width:800px">
                        <label for="inputKelas" class="col-sm-2 col-form-label">Kelas</label>
                        <div class="col-auto">

                                <input type="radio" name="inputKelas" value="7">7 (Tujuh)
                                <input type="radio" name="inputKelas" value="8">8 (Delapan)
                                <input type="radio" name="inputKelas" value="9">9 (Sembilan)

                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark" style="background-color:#12427b"><i class="fa-solid fa-plus"></i> Tambah</button>
                </form>
                <?php
                    include "connection.php";
                    $nama           = $_POST['inputNama'];
                    $nis            = $_POST['inputNis'];
                    $jenis_kelamin  = $_POST['inputJK'];
                    $kelas          = $_POST['inputKelas'];
                    if(empty($nama)&&empty($nis)&&empty($kelas)&&empty($jenis_kelamin)){
                    ?>
                    <br>
                    <?php

                        echo ("Kolom harus diisi semua");
                    } 
                    else{
                        $insert = mysqli_query($conn, "insert into siswa set nis='$nis', nama='$nama', kelas='$kelas', jenis_kelamin='$jenis_kelamin'");
                    }


                ?>
            </div>
            <div class="batas"></div>
            <div class="main">
                <h3>Daftar Kelas</h3>
                <div class="data_kelas d-flex justify-content-evenly">
                    <a href="kelas_7.php"><button type="button" class="btn_toKelas">Kelas 7</button></a>
                    <a href="kelas_8.php"><button type="button" class="btn_toKelas">Kelas 8</button></a>
                    <a href="kelas_9.php"><button type="button" class="btn_toKelas">Kelas 9</button></a>

                </div>



            </div>

        </div>
    </div>
</body>
</html>