<?php

    //  Error logging
    error_reporting(E_ALL);
    
    ini_set('display_errors', 'Off');
    ini_set('log_errors', 'On');
    ini_set('error_log', dirname(__FILE__). '/../logging/log.txt');


    //  Requireing required files
    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('rabbitMQClient.php');

    

    

    //  Starting sessions 
    //  session_start();

    

    //  This function will check if the user not logged in and trying to fetch innerwebpage
    function gateway(){
        if (!$_SESSION["logged"]){
            header("Location: ../html/loginRegister.html");
        }
    }

    //  This function will send login request to RabbotMQ
    function login($username, $password){
        
        $request = array();
        
        $request['type'] = "Login";
        $request['username'] = $username;
        $request['password'] = $password;

        $returnedValue = createClientForDb($request);
        
        if($returnedValue == 1){
            $_SESSION["username"] = $username;
            $_SESSION["logged"] = true;
        }else{
            session_destroy();
        }
       
        return $returnedValue;
    }

    //  This function will send register request to RabbitMQ
    function register($firstname, $lastname, $username, $email, $password){
        
        $request = array();
        
        $request['type'] = "Register";
        $request['username'] = $username;
        $request['password'] = $password;
        $request['firstname'] = $firstname;
        $request['lastname'] = $lastname;
        $request['email'] = $email;

        $returnedValue = createClientForDb($request);

        return $returnedValue;
    }

    //  This function will check for a already exists
    function usernameVerification($username){
        
        $request = array();
        
        $request['type'] = "CheckUsername";
        $request['username'] = $username;

        $returnedValue = createClientForDb($request);

        return $returnedValue;
    } 

    //  This function will check for a already exists
    function emailVerification($email){
        
        $request = array();
        
        $request['type'] = "CheckUsername";
        $request['email'] = $email;

        $returnedValue = createClientForDb($request);

        return $returnedValue;
    } 

    //  This function will send the request to write a suggestion
    function writeSuggestion($username, $restId, $desc, $title){

        $request = array();

        $request['type'] = "WriteSuggestion";
        $request['username'] = $username;
        $request['dish_name'] = $title;
        $request['suggestion'] = $desc;
        $request['restaurant_id'] = $restId;

        $returnedValue = createClientForDb($request);
        return $returnedValue;
    } 

    //  This function will send th erequest to write a review 
    function writeReview($username, $restId, $rating, $review){
        
        $request = array();

        $request['type'] = "WriteReview";
        $request['username'] = $username;
        $request['rating'] = $rating;
        $request['review_text'] = $review;
        $request['restaurant_id'] = $restId;

        $returnedValue = createClientForDb($request);
        return $returnedValue;
    }

    //  This function will be called when add favorite is called
    function addFavorite($restId){
        
        $request = array();
        
        $request['type'] = "AddFavorite";
        $request['username'] = $_SESSION["username"];
        $request['restaurant_id'] = $restId;

        $returnedValue = createClientForDb($request);

        return $returnedValue;
    }

    //  This function will remove a restaurant from fav
    function removeFavorite($restId){
        
        $request = array();
        
        $request['type'] = "RemoveFavorite";
        $request['username'] = $_SESSION["username"];
        $request['restaurant_id'] = $restId;

        $returnedValue = createClientForDb($request);

        return $returnedValue;
    }

    //  This function will log errors
//    function logAndSendErrors(){
//        
////        echo "In Log errors function";
//        
//        $file = fopen("../logging/log.txt","r");
//        $errorArray = [];
//        while(! feof($file)){
//            array_push($errorArray, fgets($file));
//        }
//        
////        for($i = 0; $i < count($errorArray); $i++){
////            echo $errorArray[$i];
////            echo "<br>";
////        }
//
//        fclose($file);
//
//
//        $request = array();
//        $request['type'] = "frontend";  
//        $request['error_string'] = $errorArray; 
//        $returnedValue = createClientForRmq($request);
//
//        $fp = fopen("../logging/logHistory.txt", "a");
//        for($i = 0; $i < count($errorArray); $i++){
//            fwrite($fp, $errorArray[$i]);
//        }
//
//        file_put_contents("../logging/log.txt", "");
//
//
//    }
    
    

?>