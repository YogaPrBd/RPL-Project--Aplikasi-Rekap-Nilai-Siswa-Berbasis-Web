<?php
    require_once('connection.php');
    
    $myArray = array();
    if ($result = mysqli_query($conn, "SELECT * FROM nilai INNER JOIN siswa ON nilai.nis = siswa.nis 
                                INNER JOIN mata_pelajaran ON nilai.idmapel = mata_pelajaran.idmapel"))
    {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)){
            $myArray[] = $row;

        }
        mysqli_close($conn);
            echo json_encode($myArray);
    }
?>