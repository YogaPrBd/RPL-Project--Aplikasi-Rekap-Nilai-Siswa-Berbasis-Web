<style>
    <?php include 'style.css'; ?>
</style>

<?php
    include "connection.php";
    session_start();
    $sql = "SELECT t1.nis, t1.nama, t1.kelas, t1.jenis_kelamin, AVG(t2.nilai) AS rata_rata
                FROM siswa t1
                INNER JOIN nilai t2 ON t1.nis = t2.nis
                AND t1.kelas = 9
                GROUP BY t1.nis, t1.nama, t1.jenis_kelamin
                ORDER BY t1.nis ASC";
    $sqlRow = mysqli_query($conn, $sql);
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
    
    <title>Daftar Siswa Kelas 9| ReNi</title>
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
        <div class="content">
            <h2 align="center">Daftar Siswa Kelas 9</h2>
            <br>
            <div class="batas"></div>
            <div class="for-btn d-flex justify-content-between">
                <a href="daftar_siswa.php"><button type="button" class="btn_back"><i class="fa-solid fa-arrow-left"></i> Back</button></a>
	            <a href="cetak/cetak_siswa9.php"><button type="button" class="btn_cetak"><i class="fa-regular fa-print"></i>Cetak</button></a>
            </div>
            <br>
            <form class="d-flex" style="max-width: 50%;">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>&nbsp;
                <a href="kelas_9.php"><button type="link" class="btn btn-outline-secondary">Reset</button></a>
            </form>
                <br>
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-light">
                        <tr class="align-middle">
                            <th scope="col" style="width:2%; text-align:center;">No</th>
                            <th scope="col" style="width:32%; text-align:center;">Nama</th>
                            <th scope="col" style="width:15%; text-align:center;">Jenis Kelamin</th>
                            <th scope="col" style="width:8%; text-align:center;">Kelas</th>
                            <th scope="col" style="width:13%; text-align:center;">Nilai Rata-Rata</th>
                            <th scope="col" style="width:22%; text-align:center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- List Data Siswa -->
                        <?php
                            while($siswa = mysqli_fetch_row($sqlRow)){
                        ?>
                        <tr class="align-middle">
                            <th scope="row" style="text-align:center"><?php echo($siswa['0']);?></th>
                            <td><?php echo($siswa['1']);?></td>
                            <td style="text-align:center"><?php echo($siswa['3']);?></td>
                            <td style="text-align:center"><?php echo($siswa['2']);?></td>
                            <td style="text-align:center"><?php echo($siswa['4']);?></td>
                            <!-- Aksi -->
                            <td style="text-align:center">
                                <button type="button" class="btn btn-outline-info"><i class="fa-regular fa-info"></i> Details</button>
                                <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalEdit"> <i class="fa-regular fa-pencil"></i> Edit </button>&nbsp;
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalHapus"><i class="fa-regular fa-trash"></i> Hapus</button>
                            </td>

                            <!-- Modal Edit data -->
                                <div class="modal fade" id="modalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel"><i class="fa-regular fa-pencil"></i> Edit Siswa</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <form action="" method="post">
                                        <div class="row mb-3" style="max-width:800px">
                                            <label for="inputNama" class="col-sm-2 col-form-label" >Nama Lengkap</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputNama" value="Muhammad Ferry Munandar" require>
                                            </div>
                                        </div>
                                        <div class="row mb-3" style="max-width:800px">
                                            <label for="inputJK" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                            <div class="col-auto">
                                                <select class="form-select" id="inputJK">
                                                   
                                                    <option  value="Laki-Laki">Laki-Laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3" style="max-width:800px">
                                            <label for="inputKelas" class="col-sm-2 col-form-label">Kelas</label>
                                            <div class="col-auto">
                                                <select class="form-select" id="inputKelas" require>
                                                    
                                                    <option value="7">7 (Tujuh)</option>
                                                    <option value="8">8 (Delapan)</option>
                                                    <option value="9">9 (Sembilan)</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                    
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-dark" style="background-color:#12427b">Simpan</button>
                                    </form>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                <!-- Akhir Modal Edit -->
                                <!-- Modal Hapus -->
                                <div class="modal fade" id="modalHapus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Hapus Siswa</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <form action="" method="post">
                                        Anda Yakin Hapus siswa <b>Muhammad Ferry Munandar</b>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-dark" style="background-color:#12427b">Hapus</button>
                                    </form>
                                    </div>
                                    </div>
                                </div>
                                </div>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>

    </div>
</body>
</html>