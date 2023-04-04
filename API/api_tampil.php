<?php
require_once('../config/koneksi.php');
$myArray = array();
if ($result = mysqli_query($conn, "SELECT * FROM nilai ORDER BY idnilai ASC")) {
    	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        	$myArray[] = $row;
    	}
	mysqli_close($conn);
    	echo json_encode($myArray);
}
