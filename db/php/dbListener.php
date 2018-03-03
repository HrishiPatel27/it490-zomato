<?php 

    //Requried files

    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('dbFunctions.php');

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
            case "Login":
                echo "<br>in login";
                $response_msg = doLogin($request['username'],$request['password']);
                break;
                
            //New User registration
            case "Register":
                echo "<br>in register";
                $response_msg = register($request['username'], $request['email'], $request['password'], $request['firstname'], $request['lastname'], $request['dob_month'], $request['dob_date'], $request['dob_year'], $request['sex'], $request['street_number'], $request['street_name'], $request['city'], $request['state'], $request['zip'], $request['country']);
                break;
                
            //Search cities of state
            case "CityByState":
                echo "<br>In search type";
                $response_msg = cityByState($request['state']);
        
        }
        
        return array('response_msg'=> $response_msg, 'message'=>'Database request received and processed');
    }

    //creating a new server
    $server = new rabbitMQServer('../rabbitmqphp_example/rabbitMQ_db.ini', 'testServer');
    
    //processes the request sent by client
    $server->process_requests('requestProcessor');
    
    //exit();





?>