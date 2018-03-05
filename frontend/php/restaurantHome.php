<?php

    session_start();

    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('rabbitMQClient.php');

    $request = array();

    $request['type'] = "UniqueRestaurantInfo";
    $request['username'] = $_SESSION["username"];
    $request['restaurant_id'] = $_GET["restId"];

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
    
    
        <h1><?php echo $data["name"]; ?></h1>
        
        <button onclick = "favoriteThisRestaurant(<?php echo $data["id"]; ?>)" id="favButton">Favorite</button>
        
        <br><br>
        
        <b>Favorite: </b><?php echo $data["favorite"]; ?>
    
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
    
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
      
      <script
			  src="https://code.jquery.com/jquery-3.3.1.js"
			  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
			  crossorigin="anonymous"></script>
    
    <script src="../js/scripts.js">
    </script>
    
</html>