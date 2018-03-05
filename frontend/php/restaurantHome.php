<?php

    session_start();

    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('rabbitMQClient.php');

    $request = array();

    $request['type'] = "UniqueRestaurantInfo";
    $request['restaurant_id'] = $_GET["restId"];

    $data = createClientForDb($request);

?>


<html>

    <head>
    
    </head>
    <body>
    
        <h1><?php echo $data["name"]; ?></h1>
        
        <button onclick = "favoriteThisRestaurant(<?php echo $data["id"]; ?>)">Favorite</button>
    
        <br><br>
        
        <img src = "<?php echo $data["thumbnail"]; ?>" alt = "IMG">
        
        <br><br>
        
        <a href = "<?php echo $data["menu"]; ?>">View Menu</a>
        
        <br><br>
        
        <h2>Suggestions to this restaurant:</h2>
        <?php for($i = 0; $i < count($data["suggestions"]); $i++){ ?>
            <b>Username: </b> <?php echo $data["suggestions"][$i]["username"]; ?>
            <br>    
            <b>Dish Name: </b> <?php echo  $data["suggestions"][$i]["suggestion"]; ?>
            <br><br>
        <?php } ?>
        
        
        <h2>Reviews to this restaurant:</h2>
        <?php for($i = 0; $i < count($data["reviews"]); $i++){ ?>
            <b>Username: </b> <?php echo $data["reviews"][$i]["username"]; ?>
            <br>    
            <b>Rating: </b> <?php echo $data["reviews"][$i]["review_rating"]; ?>
            <br>
            <b>Review: </b> <?php echo  $data["reviews"][$i]["review_text"]; ?>
            <br><br>
        <?php } ?>
        
    </body>
    
    <script src="../js/scripts.js">
    </script>
    
</html>