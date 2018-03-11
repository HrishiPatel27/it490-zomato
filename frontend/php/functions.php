<?php

    //  Starting sessions 
    //  session_start();

    //  Requireing required files
    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('rabbitMQClient.php');

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

?>