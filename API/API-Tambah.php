<?php
require_once('../config/koneksi.php');

if (isset($_POST['idmapel']) && isset($_POST['nis']) && isset($_POST['nilai'])) {
	$id_mapel           = $_POST['idmapel'];
    $nis                = $_POST['nis'];
    $nilai              = $_POST['nilai'];
	$sql = $conn->prepare("INSERT INTO produk (idmapel, nis, nilai) VALUES (?, ?, ?)");
	$sql->bind_param('ssdd', $id_mapel, $nis, $nilai);
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