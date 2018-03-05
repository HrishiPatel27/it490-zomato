<?php

    session_start();

    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('rabbitMQClient.php');

    $request = array();

    $request['type'] = "UniqueRestaurantInfo";
    $request['restaurant_id'] = $_GET["restId"];

    $data = createClientForDb($request);

    //$data1 = json_decode($data);
    echo $data["name"];
    echo "<br>";
    echo $data["id"];
    echo "<br>";
    echo $data["thumbnail"];
    echo "<br>";
    echo $data["menu"];
    echo "<br>";
    
    echo $data["suggestions"]["suggestion"];
//    for($i = 0; $i < count($data["suggestions"]); $i++){
//        echo $data["suggestions"][$i];
//        echo "<br>";
//        echo $data["suggestions"][$i];
//        echo "<br><br>";
//    }
?>