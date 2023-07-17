<style>
    <?php include 'style.css'; 
    set_error_handler(function (int $errno, string $errstr) {
        if ((strpos($errstr, 'Undefined array key') === false) && (strpos($errstr, 'Undefined variable') === false)) {
            return false;
        } else {
            return true;
        }
    }, E_WARNING);?>
    <?php 
        include 'style.css';
        include "connection.php";
    ?>
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link rel="stylesheet" href="style.css">
    
    <title>Input Nilai | Rani</title>
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
                        <a class="nav-link" href="daftar_siswa.php">Daftar Siswa</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link active" href="input_nilai.php">Input Nilai</a>
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
    <?php
        $sqlSiswa = "SELECT t1.nis, t1.nama FROM siswa t1";
        $sqlSiswaRow = mysqli_query($conn, $sqlSiswa);

        $sqlMapel = "SELECT t1.idmapel, t1.nama_mapel FROM mata_pelajaran t1";
        $sqlMapelRow = mysqli_query($conn, $sqlMapel);
    ?>
    <!-- Content -->
    <div class="content">
            <h2 align="center">Input Nilai Siswa</h2>
            <br>
            <!-- Form input data siswa -->
            <div class="input_data">
                <h4 style="text-decoration: underline;">Input Nilai</h4>
                <br>
                <!-- form -->
                <div class="panel-body">
                    <form method="POST" class="row g-3" style="width: 95%;">
                        <div class="control-group after-add-more row g-3">
                            <div class="col-md-4">
                                <label for="namasiswa" class="form-label">Nama Siswa</label>
                                <div class="col-auto">
                                    <select class="form-select" id="inputNama" name="inputNama" style="min-width: 200px;" required>
                                        <option selected>Pilih Nama Siswa...</option>
                                        <?php
                                            while($siswa = mysqli_fetch_row($sqlSiswaRow)){
                                        ?>
                                        <!-- Value isi 'NIS' dan text Nama -->
                                        <option name=pilihnama value="<?php echo($siswa['0']);?>"><?php echo($siswa['1']);?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="Input Mapel" class="form-label">Mata Pelajaran</label>
                                <div class="col-auto">
                                    <select class="form-select" id="inputMapel" name="inputMapel" style="min-width: 200px;" require>
                                        <option selected>Pilih Mata Pelajaran...</option>
                                        <?php
                                            while($mapel = mysqli_fetch_row($sqlMapelRow)){
                                        ?>
                                        <option name=pilihmata_pelajaran value="<?php echo($mapel['0']);?>"><?php echo($mapel['1']);?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="inputNilai" class="form-label">Nilai</label>
                                <div class="col-auto">
                                    <input type="Number" class="form-control" id="inputNilai" name="inputnilai" style="min-width: 200px;" placeholder="Masukkan Angka" require>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-info add-more" type="button">
                                    <i class="fa-solid fa-plus"></i> Tambah Input
                                </button>
                            </div>
                        </div>
                        <div class="space" style="height: 30px;"></div>
                        <div class="col-md-10"></div>
                        
                        <div class="col-md-2">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-dark" style="background-color:#12427b"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                            </div>
                        </div>
                       
                    </form>
                    <!-- Ini form hidden /tambah inputan -->
                    <div class="copy invisible" style="width: 100%; margin-top:-40px">
                        <div class="control-group row g-4">
                            <div class="col-md-4">
                                <label for="namasiswa" class="form-label">Nama Siswa</label>
                                <div class="col-auto">
                                    <select class="form-select" id="inputNama" name="idsiswa[]" style="min-width: 200px;" required>
                                        <option selected>Pilih Nama Siswa...</option>
                                        <!-- Value isi 'NIS' dan text Nama -->
                                        <option value="2323221">Ferry Munandar</option>
                                        <option value="346378272">Arkan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="Input Mapel" class="form-label">Mata Pelajaran</label>
                                <div class="col-auto">
                                    <select class="form-select" id="inputMapel" name="idmapel[]" style="min-width: 200px;">
                                        <option selected>Pilih Mata Pelajaran...</option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="inputNilai" class="form-label">Nilai</label>
                                <div class="col-auto">
                                    <input type="Number" class="form-control" id="inputNilai" name="nilai[]" style="min-width: 200px;" placeholder="Masukkan Angka" require>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <label for="inputNilai" class="form-label" invisible>Action</label>
                                <div class="col-auto">
                                <button class="btn btn-danger remove" type="button"><i class="fa-regular fa-xmark" style="font-size: 22px;"></i></button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
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
    <div class="thisfoot"></div>
    <!-- fungsi javascript untuk menampilkan form dinamis  -->
    <!-- penjelasan :
    saat tombol add-more ditekan, maka akan memunculkan div dengan class copy -->
    <script type="text/javascript">
        $(document).ready(function() {
        $(".add-more").click(function(){ 
            var html = $(".copy").html();
            $(".after-add-more").after(html);
        });

        // saat tombol remove dklik control group akan dihapus 
        $("body").on("click",".remove",function(){ 
            $(this).parents(".control-group").remove();
        });
        });
    </script>
</body>
</html>
<?php
    include "connection.php";
    $pilihnama           = $_POST['inputNama'];
    $pilihmata_pelajaran  = $_POST['inputMapel'];
    $inputnilai          = $_POST['inputnilai'];
    if(empty($pilihnama)&&empty($pilihmata_pelajaran)&&empty($inputnilai)){
        echo ("Kolom harus diisi semua");
    } 
    else{
        $insert = mysqli_query($conn, "INSERT INTO nilai (idmapel, nilai, nis)
                                        VALUES ($pilihmata_pelajaran, $inputnilai, $pilihnama)");
    }
?>