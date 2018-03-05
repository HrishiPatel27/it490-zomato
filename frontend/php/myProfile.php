<?php

    session_start();
    
    if (!$_SESSION["logged"]){
        header("Location: ../html/loginRegister.html");
    }
    

    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('rabbitMQClient.php');

    $request = array();

    $request['type'] = "UserProfile";
    $request['username'] = $_SESSION["username"];

    $data = createClientForDb($request);
    

?>


<html>

    <head>
    
    </head>
    <head>
    
        <h1><?php echo $_SESSION["username"]; ?></h1>
        
        <h2>Suggestions by <?php echo $_SESSION["username"]; ?>:</h2>
        <?php for($i = 0; $i < count($data["suggestions"]); $i++){ ?>
            <b>Restaurant Name: </b> <?php echo $data["suggestions"][$i]["restaurant_name"]; ?>
            <br>    
            <b>Dish Name: </b> <?php echo  $data["suggestions"][$i]["dish_name"]; ?>
            <br>    
            <b>Suggestion: </b> <?php echo  $data["suggestions"][$i]["suggestion"]; ?>
            <br><br>
        <?php } ?>
        
        <br>
        
        <h2>Reviews <?php echo $_SESSION["username"]; ?>:</h2>
        <?php for($i = 0; $i < count($data["reviews"]); $i++){ ?>
            <b>Restaurant Name: </b> <?php echo $data["reviews"][$i]["restaurant_name"]; ?>
            <br>    
            <b>Rating: </b> <?php echo  $data["reviews"][$i]["review_rating"]; ?>
            <br>    
            <b>Review: </b> <?php echo  $data["reviews"][$i]["review_text"]; ?>
            <br><br>
        <?php } ?>
        
        <br>
        
        <h2><?php echo $_SESSION["username"]; ?>'s favorites:</h2>
        <?php for($i = 0; $i < count($data["favorites"]); $i++){ ?>
            <b>Restaurant Name: </b>
            <a href = "restaurantHome.php?restId=" <?php echo $data["favorites"][$i]["restaurant_id"]; ?>>
                <?php echo $data["favorites"][$i]["restaurant_name"]; ?>
            </a>
        <br>
        <?php } ?>
        
        
    </head>
</html>