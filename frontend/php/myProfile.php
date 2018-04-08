<?php


    //  Error logging
//    error_reporting(E_ALL);
//    
//    ini_set('display_errors', 'Off');
//    ini_set('log_errors', 'On');
//    ini_set('error_log', dirname(__FILE__). '/../logging/log.txt');

    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('rabbitMQClient.php');

    
    
    //logAndSendErrors();

    session_start();
    
    if (!$_SESSION["logged"]){
        header("Location: ../html/loginRegister.html");
    }
    

    

    $request = array();

    $request['type'] = "UserProfile";
    $request['username'] = $_SESSION["username"];

    $data = createClientForDb($request);
    

?>


<html>

    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Barlow:400,700" rel="stylesheet">

    <!-- Custom CSS  -->
    <link rel="stylesheet" href="../css/styles.css">

    <title>Ciphers</title>
  </head>
    <body>
        
        <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="searchRestaurant.php">
        <img src="/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
        Ciphers
      </a>


      <div class="btn-group">
          <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php echo $_SESSION["username"] ?>
          </button>
          <div class="dropdown-menu dropdown-menu-left">
              <a href = "myProfile.php">
                <button class="dropdown-item" type="button">My Profile</button>
              </a>
              <button class="dropdown-item" type="button">About</button>
              <a href = "destroySessions.php?logout=true">
                  <button class="dropdown-item" type="button">Logout</button>
              </a>
          </div>
      </div>
    </nav>
    
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
        
        
    </body>
    
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
      
      <script
			  src="https://code.jquery.com/jquery-3.3.1.js"
			  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
			  crossorigin="anonymous"></script>
</html>