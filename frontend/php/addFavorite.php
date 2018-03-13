<?php

    session_start();

    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('rabbitMQClient.php');

    $request = array();


    $request['type'] = "AddFavorite";
    $request['username'] = $_SESSION["username"];
    $request['restaurant_id'] = $_GET["restId"];

    $returnedValue = createClientForDb($request);
    
    if($returnedValue == "true"){
        echo "true";
    }else{
        echo "false";
    }

?>