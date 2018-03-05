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
                break;
                
            //Search for restaurants
            case "RestaurantInfo":
                echo "<br>In Restaurant info";
                $response_msg = restaurantInfo($request['state'], $request['city'], $request['cuisine_id']);
                break;
                
            //Enter suggestion for restaurant
            case "WriteSuggestion":
                echo "<br>In WriteSuggestion";
                $response_msg = writeSuggestion($request['username'], $request['dish_name'], $request['suggestion'], $request['restaurant_id']);
                break;
            
            //Enter reviews for restaurant
            case "WriteReview":
                $response_msg = writeReview($request['username'], $request['restaurant_id'], $request['rating'], $request['review_text']);
                break;
                
            //Get individual restaurant info
            case "UniqueRestaurantInfo":
                echo "going in function";
                $response_msg = uniqueRestaurantInfo($request['restaurant_id'], $request['username']);
                echo "out of function";
                break;
            
            //Get user profile
            case "UserProfile":
                $response_msg = userProfile($request['username']);
                break;
                
            //Add favorite
            case "AddFavorite":
                $response_msg = addFavorite($request['username'], $request['restaurant_id']);
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