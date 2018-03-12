<?php

    //Requried files

    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('dmzFunctions.php');

    //This will route the request from server to function
    function requestProcessor($request){
        echo "received request".PHP_EOL;
        echo $request['type'];
        var_dump($request);
       
        if(!isset($request['type'])){
            return array('message'=>"ERROR: Message type is not supported");
        }
        switch($request['type']){
               
            //Login & Authentication request   
            case "RestaurantInfo":
                $response_msg = restaurantInfo($request['city_name'],$request['state_name'],$request['cuisine_id']);
                break;
            
			//Get menu for restaurant
			case "GetMenu":
				$response_msg = getMenu($request['menu_url']);
				break;
        }
       
        return $response_msg;
    
    }

    //creating a new server
    $server = new rabbitMQServer('../rabbitmqphp_example/rabbitMQ_db.ini', 'testServer');
   
    //processes the request sent by client
    $server->process_requests('requestProcessor');
   
    //exit();





?>