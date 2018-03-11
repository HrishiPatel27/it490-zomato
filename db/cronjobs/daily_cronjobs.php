<?php

    require_once('../php/dbConnection.php');

    $connection = dbConnection();

    //Query to delete Unique key generated if any for user in userkey table
    $keydelete_query = "DELETE FROM userkey WHERE time < (NOW() - INTERVAL 24 HOUR)";
    $keydelete_query_result = $connection->query($keydelete_query);
    

?>