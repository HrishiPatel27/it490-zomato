<?php



    
    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('rabbitMQClient.php');
    

    echo  $_POST["username"];
    echo "<br>";
    echo  $_POST["password"];

    $request = array();

    $request['type'] = "Login";
    $request['username'] = $_POST["username"];
    $request['password'] = $_POST["password"];

    createClientForDb($request);


?>
