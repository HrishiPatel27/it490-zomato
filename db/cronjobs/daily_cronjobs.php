<?php

//    require_once('../php/dbConnection.php');
    require_once('/home/hrishi/Documents/it490-zomato/db/rabbitmqphp_example/path.inc');
    require_once('/home/hrishi/Documents/it490-zomato/db/rabbitmqphp_example/get_host_info.inc');
    require_once('/home/hrishi/Documents/it490-zomato/db/rabbitmqphp_example/rabbitMQLib.inc');
    

//    $connection = dbConnection();
//
//    //Query to delete Unique key generated if any for user in userkey table
//    $keydelete_query = "DELETE FROM userkey WHERE time < (NOW() - INTERVAL 24 HOUR)";
//    $keydelete_query_result = $connection->query($keydelete_query);

//    $logAndSendErrors = logAndSendErrors();
//
//    function logAndSendErrors(){
//        
        $file = fopen("/home/hrishi/Documents/it490-zomato/db/logging/log.txt","r");
        $errorArray = [];
        while(! feof($file)){
            array_push($errorArray, fgets($file));
        }
//        for($i = 0; $i < count($errorArray); $i++){
//            echo $errorArray[$i];
//            echo "<br>";
//        }

        fclose($file);


        $request = array();
        $request['type'] = "db";  
        $request['error_string'] = $errorArray;
        $returnedValue = createClientForRmq($request);

        $fp = fopen("/home/hrishi/Documents/it490-zomato/db/logging/logHistory.txt", "a");
        for($i = 0; $i < count($errorArray); $i++){
            fwrite($fp, $errorArray[$i]);
        }

        file_put_contents("/home/hrishi/Documents/it490-zomato/db/logging/log.txt", "");

    function createClientForRmq($request){
        $client = new rabbitMQClient("/home/hrishi/Documents/it490-zomato/db/rabbitmqphp_example/rabbitMQ_rmq.ini", "testServer");
       
        if(isset($argv[1])){
            $msg = $argv[1];
        }
        else{
            $msg = "client";
        }
        $response = $client->send_request($request);
        return $response;
    }


   // }
    
    

?>