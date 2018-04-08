<?php

//    include("../php/functions.php");
//
//    logAndSendErrors();


    //  Error logging
    error_reporting(E_ALL);
    
    ini_set('display_errors', 'On');
    ini_set('log_errors', 'On');
    //ini_set('error_log', dirname(__FILE__). '/../logging/log.txt');

    //  Requireing required files
    require_once('/home/ajay/Downloads/DMZ/it490-zomato/dmz/rabbitmqphp_example/path.inc');
    require_once('/home/ajay/Downloads/DMZ/it490-zomato/dmz/rabbitmqphp_example/get_host_info.inc');
    require_once('/home/ajay/Downloads/DMZ/it490-zomato/dmz/rabbitmqphp_example/rabbitMQLib.inc');
    //require_once('../php/rabbitMQClient.php');

    $file = fopen("/home/ajay/Downloads/DMZ/it490-zomato/dmz/logging/log.txt","r");
    $errorArray = [];
    while(! feof($file)){
        array_push($errorArray, fgets($file));
    }

    fclose($file);

    $request = array();
    $request['type'] = "dmz";  
    $request['error_string'] = $errorArray;
    $returnedValue = createClientForRmq($request);

    $fp = fopen("/home/ajay/Downloads/DMZ/it490-zomato/dmz/logging/logHistory.txt", "a");
    for($i = 0; $i < count($errorArray); $i++){
        fwrite($fp, $errorArray[$i]);
    }

    file_put_contents("/home/ajay/Downloads/DMZ/it490-zomato/dmz/logging/log.txt", "");

    function createClientForRmq($request){
            $client = new rabbitMQClient("/home/ajay/Downloads/DMZ/it490-zomato/dmz/rabbitmqphp_example/rabbitMQ_rmq.ini", "testServer");

            if(isset($argv[1])){
                $msg = $argv[1];
            }
            else{
                $msg = "client";
            }


            $response = $client->send_request($request);

            return $response;
        }

?>