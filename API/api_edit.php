<?php
require_once('../config/koneksi.php');

if (isset($_GET['idnilai'])) {
    $id = $_GET['idnilai'];
    $SQL = $conn->prepare("SELECT * FROM nilai WHERE idnilai=? ORDER BY idnilai ASC");
    $SQL->bind_param("i", $id);
    $SQL->execute();
    $hasil = $SQL->get_result();
    $myArray = array();
    while ($users = $hasil->fetch_array(MYSQLI_ASSOC)) {
        $myArray = $users;
    }
    echo json_encode($myArray);
} else {
    echo "data tidak ditemukan";
}