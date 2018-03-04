<?php

    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('rabbitMQClient.php');

    $request = array();

    $request['type'] = "RestaurantInfo";
    $request['state'] = $_GET["state"];
    $request['city'] = $_GET["city"];
    $request['cuisine_id'] = $_GET["cuisine_id"];
 
    $returnedValue = createClientForDb($request);
    
    echo $returnedValue;

    return $returnedValue;
?>
