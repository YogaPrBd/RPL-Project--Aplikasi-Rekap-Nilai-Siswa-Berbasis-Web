<?php
require_once('../config/koneksi.php');

if (isset($_POST['id'])) {
    $id_nilai           = $_POST['idnilai'];
    $id_mapel           = $_POST['idmapel'];
    $nis                = $_POST['nis'];
    $nilai              = $_POST['nilai'];
    $sql = $conn->prepare("UPDATE nilai SET idmapel=?, nis=?, nilai=? WHERE idnilai=?");
    $sql->bind_param('ssddd', $id_mapel, $nis, $nilai, $id_nilai);
    $sql->execute();
    if ($sql) {
        //echo json_encode(array('RESPONSE' => 'SUCCESS'));
        header("location:../readapi/tampil.php");
    } else {
        echo json_encode(array('RESPONSE' => 'FAILED'));
    }
} else {
    echo "GAGAL";
}