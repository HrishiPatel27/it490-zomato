<?php

    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('rabbitMQClient.php');

    $request = array();

    $request['type'] = "CityByState";
    $request['state'] = $_GET["state"];
 
    //echo $_GET["state"];
    

    $returnedValue = createClientForDb($request);
    
    echo $returnedValue;

    return $returnedValue;
?>
