<?php

    $host = '127.0.0.1';
    $user = 'root';
    $pass = 'Allmenmustdie$95';
    $database = 'it490';

    $conn = mysqli_connect($host,$user,$pass,$database);

    if(!$conn){
        echo "Not connected<br>";
    }else{
        echo "Connected<br>";
    }

?>