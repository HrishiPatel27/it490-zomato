<?php

    /*
        This file creates new rabbit MQ client instances
    */

    //  Required files
    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');

    //  creates rabbitMq client instance for Database server
    function createClientForDb($request){
        $client = new rabbitMQClient("../rabbitmqphp_example/rabbitMQ_db.ini", "testServer");
        
        if(isset($argv[1])){
            $msg = $argv[1];
        }
        else{
            $msg = "client";
        }
        
        //  sending request for response with data
        $response = $client->send_request($request);
        //$response = $client->publish($request);
        
        //  not needed but just incase
        //echo PHP_EOL."client received response".PHP_EOL;
        //print_r($response);
        //echo "\n\n";
        //echo $argv[0]." END".PHP_EOL;
        
        return $response;
    }

    /*
    //  creates rabbitMq client instance for DMZ server
    function createClientForDmz($request){
        
        return $response;
    }
    */



?>