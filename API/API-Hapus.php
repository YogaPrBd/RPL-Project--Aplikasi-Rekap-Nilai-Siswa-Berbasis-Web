<?php
require_once('../config/koneksi.php');

if (isset($_GET['id'])) {
    $id  = $_GET['id'];
    $sql = $conn->prepare("DELETE FROM nilai WHERE idnilai=?");
    $sql->bind_param('i', $id);
    $sql->execute();
    if ($sql) {
        echo json_encode(array('RESPONSE' => 'SUCCESS'));
        //header("location:../readapi/tampil.php");
    } else {
        echo json_encode(array('RESPONSE' => 'FAILED'));
    }
} else {
    echo "GAGAL";
}