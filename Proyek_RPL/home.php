<style>
    <?php include 'style.css'; ?>
</style>

<?php
    include "connection.php";
    session_start();

    $jmlSiswa = mysqli_query($conn, "SELECT COUNT(nis) as JumlahSiswa from siswa");
    $jmlKelas = mysqli_query($conn, "SELECT COUNT(DISTINCT(kelas)) as JumlahKelas from siswa");
    $maxNilai = mysqli_query($conn, "SELECT MAX(nilai) as maxNilai from nilai");
    $rankKls7 = mysqli_query($conn, "SELECT t1.nis, t1.nama, t1.kelas, AVG(t2.nilai) AS rata_rata
                                        FROM siswa t1
                                        INNER JOIN nilai t2 ON t1.nis = t2.nis
                                        AND t1.kelas = 7
                                        GROUP BY t1.nis, t1.nama, t1.jenis_kelamin
                                        ORDER BY rata_rata DESC
                                        LIMIT 3;");
    $rankKls8 = mysqli_query($conn, "SELECT t1.nis, t1.nama, t1.kelas, AVG(t2.nilai) AS rata_rata
                                        FROM siswa t1
                                        INNER JOIN nilai t2 ON t1.nis = t2.nis
                                        AND t1.kelas = 8
                                        GROUP BY t1.nis, t1.nama, t1.jenis_kelamin
                                        ORDER BY rata_rata DESC
                                        LIMIT 3;");
    $rankKls9 = mysqli_query($conn, "SELECT t1.nis, t1.nama, t1.kelas, AVG(t2.nilai) AS rata_rata
                                        FROM siswa t1
                                        INNER JOIN nilai t2 ON t1.nis = t2.nis
                                        AND t1.kelas = 9
                                        GROUP BY t1.nis, t1.nama, t1.jenis_kelamin
                                        ORDER BY rata_rata DESC
                                        LIMIT 3;");
?>

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
    
    <title>Selamat Datang Di Reni</title>
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
                        <a class="nav-link active" aria-current="page" href="home.php">Home</a>
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
    <!-- Content -->
        <div class="content">
            <h1 align="center">Selamat Datang di ReNi</h1>
            <br>
            <div class="tampil_sum">
                <div class="card_sum">
                    <h5>Jumlah Siswa</h5>
                    <br>
                    <h1><?php 
                    while($jmlSis = mysqli_fetch_row($jmlSiswa)){
                        echo($jmlSis['0']); }?></h1>

                </div>
                <div class="card_sum">
                    <h5>Jumlah Kelas</h5>    
                    <br>
                    <h1><?php 
                    while($jmlKls = mysqli_fetch_row($jmlKelas)){
                        echo($jmlKls['0']); }?></h1>
                </div>
                <div class="card_sum">
                    <h5>Nilai Tertinggi</h5>
                    <br>
                    <h1><?php 
                    while($maxNil = mysqli_fetch_row($maxNilai)){
                        echo($maxNil['0']); }?></h1>
                </div>
            </div>
            <div class="batas"></div>

            <div class="main">
                <!-- daftar kelas 7 -->
                <h3>Daftar 3 Siswa Nilai Tertinggi Kelas 7</h3>
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width:1%; text-align:center;">No</th>
                            <th scope="col" style="width:50%; text-align:center;">Nama</th>
                            <th scope="col" style="width:20%; text-align:center;">Kelas</th>
                            <th scope="col" style="width:20%; text-align:center;">Nilai Rata-rata</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                            while($rank7 = mysqli_fetch_row($rankKls7)){
                        ?>
                        <!-- List Data -->
                        <tr>
                            <th scope="row" style="text-align:center"><?php echo($i);?></th>
                            <td><?php echo($rank7['1']);?></td>
                            <td style="text-align:center"><?php echo($rank7['2']);?></td>
                            <td style="text-align:center"><?php echo($rank7['3']);?></td>
                        </tr>
                        <?php $i++; }?>
                    </tbody>
                </table>
                <br>
                <!-- Daftar Kelas 8 -->
                <h3>Daftar 3 Siswa Nilai Tertinggi Kelas 8</h3>
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width:1%; text-align:center;">No</th>
                            <th scope="col" style="width:50%; text-align:center;">Nama</th>
                            <th scope="col" style="width:20%; text-align:center;">Kelas</th>
                            <th scope="col" style="width:20%; text-align:center;">Nilai Rata-rata</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                            while($rank8 = mysqli_fetch_row($rankKls8)){
                        ?>
                        <!-- List Data -->
                        <tr>
                            <th scope="row" style="text-align:center"><?php echo($i);?></th>
                            <td><?php echo($rank8['1']);?></td>
                            <td style="text-align:center"><?php echo($rank8['2']);?></td>
                            <td style="text-align:center"><?php echo($rank8['3']);?></td>
                        </tr>
                        <?php $i++; }?>
                    </tbody>
                </table>
                <br>
                <!-- Daftar KElas 9 -->
                <h3>Daftar 3 Siswa Nilai Tertinggi Kelas 9</h3>
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width:1%; text-align:center;">No</th>
                            <th scope="col" style="width:50%; text-align:center;">Nama</th>
                            <th scope="col" style="width:20%; text-align:center;">Kelas</th>
                            <th scope="col" style="width:20%; text-align:center;">Nilai Rata-rata</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                            while($rank9 = mysqli_fetch_row($rankKls9)){
                        ?>
                        <!-- List Data -->
                        <tr>
                            <th scope="row" style="text-align:center"><?php echo($i);?></th>
                            <td><?php echo($rank9['1']);?></td>
                            <td style="text-align:center"><?php echo($rank9['2']);?></td>
                            <td style="text-align:center"><?php echo($rank9['3']);?></td>
                        </tr>
                        <?php $i++; }?>
                    </tbody>
                </table>
                
            </div>
        </div>

            
        <div class="foot"></div>
    </div>
</body>
</html>