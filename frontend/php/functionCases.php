<?php

    //  This function starts session
    session_start();

    //   Include required files needed to connect with RabbitMQ
    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('rabbitMQClient.php');

    //  This function includes a file for functions
    include("functions.php");

    //  Variable for type
    $type = $_GET["type"];

    //  Switch case is executed depending on the type of request
    switch ($type) {
            
        case "Login":                                       //  Login 
            
            $username = $_GET["username"];
            $password = $_GET["password"];
            
            $response = login($username, $password);
            echo $response;
            break;
            
        case "RegisterNewUser":
            
            $firstname = $_GET["firstname"];
            $lastname = $_GET["lastname"];
            $username = $_GET["username"];
            $email = $_GET["email"];
            $password = $_GET["password"];
            
            $response = register($firstname, $lastname, $username, $email, $password);
            echo $response;
            break;
            
        case "UsernameVerification":
            
            $username = $_GET["username"];
            
            $response = usernameVerification($username);
            echo $response;
            break;
        
        case "EmailVerification":
            
            $email = $_GET["email"];
            
            $response = emailVerification($email);
            echo $response;
            break;
            
        default:
            return "This is the Default case.";
    }

?>