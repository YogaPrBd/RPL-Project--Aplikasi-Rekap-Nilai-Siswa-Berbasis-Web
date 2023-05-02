<?php
require_once("config.php");

if(isset($_POST['register'])){

    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
    $nim = filter_input(INPUT_POST, 'nim', FILTER_SANITIZE_NUMBER_INT);
    $kelas = filter_input(INPUT_POST, 'kelas', FILTER_SANITIZE_NUMBER_INT);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    $sql = "INSERT INTO nama_tabel (nama, nim, kelas, email, password) 
            VALUES (:nama, :nim, :kelas, :email, :password)";
    $stmt = $db->prepare($sql);

    $params = array(
        ":nama" => $nama,
        ":nim" => $nim,
        ":kelas" => $kelas,
        ":password" => $password,
        ":email" => $email
    );

    $saved = $stmt->execute($params);
    if($saved) header("Location: login.php");
}
?>