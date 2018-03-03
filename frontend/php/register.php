<?php


    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('rabbitMQClient.php');

    $request = array();

    $request['type'] = "Register";
    $request['username'] = $_POST["username"];
    $request['email'] = $_POST["email"];
    $request['password'] = $_POST["password"];
    $request['firstname'] = $_POST["firstname"];
    $request['lastname'] = $_POST["lastname"];
    $request['dob_month'] = $_POST["dob_month"];
    $request['dob_date'] = $_POST["dob_date"];
    $request['dob_year'] = $_POST["dob_year"];
    $request['sex'] = $_POST["sex"];
    $request['street_number'] = $_POST["street_number"];
    $request['street_name'] = $_POST["street_name"];
    $request['city'] = $_POST["city"];
    $request['state'] = $_POST["state"];
    $request['zip'] = $_POST["zip"];
    $request['country'] = $_POST["country"];


    createClientForDb($request);
    

?>