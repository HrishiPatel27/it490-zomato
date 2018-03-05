<?php
    session_start();

    
    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('rabbitMQClient.php');

    $request = array();


    $request['type'] = "WriteReview";
    $request['username'] = $_SESSION["username"];
    $request['rating'] = $_GET["rating"];
    $request['review_text'] = $_GET["review"];
    $request['restaurant_id'] = $_GET["restId"];

//    echo $_SESSION["username"];
//    echo $_GET["review"];
//    echo $_GET["rating"];
//    echo $_GET["restId"];
    
    $returnedValue = createClientForDb($request);

    
    if($returnedValue == "true"){
        header("Location: searchRestaurant.php");
    }else{
        echo "There was trouble submitting your suggestion.";
    }

?>