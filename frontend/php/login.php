<?php

    session_start();

    
    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('rabbitMQClient.php');

    $request = array();


    $request['type'] = "Login";
    $request['username'] = $_POST["username"];
    $request['password'] = $_POST["password"];

    $returnedValue = createClientForDb($request);
    
    if($returnedValue == "True"){
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["logged"] = true;
        
        header("Location: searchRestaurant.php");
    }else{
        header("Location: ../html/loginRegister.html");
    }
    

?>
