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

//    echo var_dump($data);
    

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
    
        
        
        <!-- Username -->
        <div class = "row rowsMyProfile">
            <div class = "col-lg-12">
                <h2>Welcome, <?php echo $_SESSION["username"]; ?></h2>
            </div>
        </div>
        
        <!-- Suggestions -->
        <div class = "row rowsMyProfile">
            <div class = "col-lg-12">
                <h2>Suggestions by <?php echo $_SESSION["username"]; ?></h2>
            </div>
            
            <div class = "col-lg-12" >
                <div class = "row">

                    <?php if($data["suggestions"][0]["restaurant_name"] == "false"){ ?>
                        <div class = "col-lg-12">
                            <div class = "custom-card myProfileSuggestionCade" style = "text-align: center;">
                                <h4>You have not suggested anything yet</h4>
                            </div>
                        </div>
                    <?php }else { ?>
                    <!-- Loop starts here -->
                    <?php for($i = 0; $i < count($data["suggestions"]); $i++){ ?>
                    <div class = "col-lg-3">
                        <div class = "custom-card myProfileSuggestionCade">
                            <h4><b><?php echo $data["suggestions"][$i]["restaurant_name"]; ?></b></h4>
                            <h5><?php echo  $data["suggestions"][$i]["dish_name"]; ?></h5>
                            <p><?php echo  $data["suggestions"][$i]["suggestion"]; ?></p>
                        </div>
                    </div>
                    <?php } }?>
                    <!-- Loop ends here -->
                    
                </div>
            </div>
        </div>
        
        <!--  Reviews -->
        <div class = "row rowsMyProfile">
            <div class = "col-lg-12">
                <h2>Reviews by <?php echo $_SESSION["username"]; ?>:</h2>
            </div>
            
            <div class = "col-lg-12">
                <div class = "row">

                    <?php if($data["reviews"][0]["restaurant_name"] == "false"){ ?>
                        <div class = "col-lg-12">
                            <div class = "custom-card myProfileSuggestionCade" style = "text-align: center;">
                                <h4>You have not given reviews to any restaurant yet</h4>
                            </div>
                        </div>
                    <?php }else { ?>
                    <!-- Loop starts here -->
                    <?php for($i = 0; $i < count($data["reviews"]); $i++){ ?>
                    <div class = "col-lg-3">
                        <div class = "custom-card myProfileSuggestionCade">
                            <h4><b><?php echo $data["reviews"][$i]["restaurant_name"]; ?></b></h4>
                            <h5><?php echo  $data["reviews"][$i]["review_rating"]; ?></h5>
                            <p><?php echo  $data["reviews"][$i]["review_text"]; ?></p>
                        </div>
                    </div>
                    <?php } }?>
                    <!-- Loop ends here -->
                    
                </div>
            </div>
        </div>
        
        <!-- Favorites -->
        <div class = "row rowsMyProfile">
            <div class = "col-lg-12">
                <h2>Favorites of <?php echo $_SESSION["username"]; ?>:</h2>
            </div>
            
            <div class = "col-lg-12">
                <div class = "row">
                    
                    <?php if($data["favorites"][0]["restaurant_id"] == "false"){ ?>
                        <div class = "col-lg-12">
                            <div class = "custom-card myProfileSuggestionCade" style = "text-align: center;">
                                <h4>You don't have any favorites yet</h4>
                            </div>
                        </div>
                    <?php }else { ?>
                    <!-- Loop starts here -->
                    <?php for($i = 0; $i < count($data["favorites"]); $i++){ ?>
                    <div class = "col-lg-3">
                        <?php $restIdLink = "restaurantHome.php?restId=" .  $data["favorites"][$i]["restaurant_id"]; ?>
                        
                        <div class = "custom-card myProfileSuggestionCade">
                            <h4><a href = "<?php echo $restIdLink; ?>"  >              
                                
                            <?php echo $data["favorites"][$i]["restaurant_name"]; ?>
                            </a></h4>
                        </div>
                    </div>
                    <?php } }?>
                    <!-- Loop ends here -->
                </div>
            </div>
        </div>
        
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