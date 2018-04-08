<?php

    //  Error logging
    error_reporting(E_ALL);
    
    ini_set('display_errors', 'Off');
    ini_set('log_errors', 'On');
    ini_set('error_log', dirname(__FILE__). '/../logging/log.txt');

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

    $request['type'] = "UniqueRestaurantInfo";
    $request['username'] = $_SESSION["username"];
    $request['restaurant_id'] = $_GET["restId"];

    $data = createClientForDb($request);

//    echo $data;
    


/*
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
    <body onload = "checkForFavorite(<?php echo $data["favorite"]; ?>)">
        
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
        
        <button onclick = "favoriteThisRestaurant(<?php echo $data["id"]; ?>)" id="favButton"></button>
        
        <br><br>
    
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

*/

?>


<html>

    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
        
        <!-- Bootstrap local -->
          <link rel = "stylesheet" href = "../bootstrap/css/bootstrap.min.css">

    <!-- Google fonts -->
<!--    <link href="https://fonts.googleapis.com/css?family=Barlow:400,700" rel="stylesheet">-->

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
        
        
        
        
        <div class = "container-fluid">
            <div class = "row">                             
                <div class = "col-lg-12 col-12">
                    
                    <!-- Row for Thumbnail, name and Favorite button -->
                    <div class = "row" id = "row1Unique">                     <!-- Row 1 -->
                        <div class = "col-lg-2 col-2">    <!-- Thumbnail -->
                            
                            <?php
                                
                                $imgUrl = "";
                                if ($data["thumbnail"] == ""){
                                    $imgUrl = "../asset/food-image.png";
                                }else{
                                   $imgUrl =  $data["thumbnail"] == "";
                                }
    
                            ?>
                            
                            <img src = "<?php echo $imgUrl; ?>" id = "uniqueThumb">
                        </div>
                        
                        <div class = "col-lg-10 col-10">    <!-- Name and addres -->
                            <div class = "row">
                                <div class = "col-lg-12 col-12" id = "uniqueName">   
                                    <?php echo $data["name"]; ?>
                                </div>
                                
                                <?php   
                                    $valueOnButton = "";
                                    if($data["favorite"] == "False"){
                                        $valueOnButton = "False";
                                    }else{
                                        $valueOnButton = "True";
                                    }
                                
                                ?>
                                
                                
                                

                                <?php
                                    
                                $idForFavButton = $data["id"] . $_SESSION["username"];
                                
                                ?>

                                
                                <div class = "col-lg-12 col-12">   
                                    <button class = "btn btn-primary" value = "<?php echo  $valueOnButton ?>" onclick = "onClickOfFavorite(<?php echo $data["id"]; ?> , '<?php echo $idForFavButton; ?>')" id = "<?php echo $data["id"] . $_SESSION["username"]; ?>">
                                    
                                        <?php 
                                            if($data["favorite"] == "False"){
                                                echo "Add to Favorite";
                                            }else{
                                                echo "Remove from Favorite";
                                            }
                                        ?>
                                        
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <!-- Row for Menu items -->
                    <div class = "row" id = "row3Unique">                         <!-- Row 3 -->
                        <div class = "col-lg-12 col-12" id = "menuItemLabel">
                            Menu Items
                        </div>
                        
                        <div class = "col-lg-12 col-12">
                        
                            <!--  If there are no items in menu  -->
                            <?php if($data["menu"][0]["dish_name"] == "False"){     ?>
                                <div class = "row">
                                    <div class = "col-lg-2 col-4">
                                        <div class = "custom-card uniqueMenuItemClass">
                                            No dishes found in the menu!
                                        </div>
                                    </div>
                                </div>
                            <?php  }else{  ?>
                            
                                <div class = "row">
                                    
                            
                            <!-- If there are any items in the menu -->
                            <?php 
                                for($i = 0; $i < count($data["menu"]); $i++){ 
                            ?>
                                    
                                    <div class = "col-lg-2 col-4">
                                        <div class = "custom-card uniqueMenuItemClass">
                                            <?php echo $data["menu"][$i]["dish_name"]; ?>
                                        </div>
                                    </div>
                            <?php   }   ?>
                                    
                                </div>
                            
                            <?php  }  ?>
                            
                        
                        </div>
                    </div>
                     
                    <!-- Row for Suggestions -->
                    <div class = "row" id = "row3Unique">                         <!-- Row 4 -->
                        <div class = "col-lg-12 col-12" id = "menuItemLabel">
                            Suggestion
                        </div>
                        
                        <div class = "col-lg-12 col-12">
                            
                            
                            <!--  If there are no suggestions for the restaurant  -->
                            <?php if($data["suggestions"][0]["suggestion"] == "False"){     ?>
                                <div class = "row">
                                    <div class = "col-lg-2 col-4">
                                        <div class = "custom-card uniqueMenuItemClass">
                                            There are no suggestions to the restaurant!
                                        </div>
                                    </div>
                                </div>
                            <?php  }else{ ?>
                            
                            <div class = "row" id = "">
                            
                            <?php 
                                for($i = 0; $i < count($data["suggestions"]); $i++){ 
                            ?>
                                <div class = "col-lg-2 col-4">
                                    <div class = "custom-card uniqueMenuItemClass">
                                        <div class = "row">
                                            <div class = "col-lg-12 col-12">
                                                <?php echo $data["suggestions"][$i]["suggestion"]; ?>
                                            </div>
                                            <div class = "col-lg-12 col-12 suggestionUserName">
                                                <?php echo $data["suggestions"][$i]["username"]; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php  } ?>
                                
                            </div>
                            <?php  } ?>
                        </div>
                    </div>
                    
                    <!-- Row for Reviews -->
                    <div class = "row" id = "row3Unique">                         <!-- Row 4 -->
                        <div class = "col-lg-12 col-12" id = "menuItemLabel">
                            Reviews
                        </div>
                        
                        <div class = "col-lg-12 col-12">

                            <!--  If there are no suggestions for the restaurant  -->
                            <?php if($data["reviews"][0]["username"] == "False"){     ?>
                                <div class = "row">
                                    <div class = "col-lg-2 col-4">
                                        <div class = "custom-card uniqueMenuItemClass">
                                            No one has reviewed this restaurant yet!
                                        </div>
                                    </div>
                                </div>
                            <?php  }else{ ?>
                            
                            <div class = "row" id = "">
                            
                            <?php 
                                for($i = 0; $i < count($data["reviews"]); $i++){ 
                            ?>
                                <div class = "col-lg-2 col-4">
                                    <div class = "custom-card uniqueMenuItemClass">
                                        <div class = "row">
                                            <div class = "col-lg-12 col-12">
                                                <?php echo $data["reviews"][$i]["review_text"]; ?>
                                            </div>
                                            <div class = "col-lg-12 col-12 suggestionUserName">
                                                Rating: <?php echo $data["reviews"][$i]["review_rating"]; ?>
                                            </div>
                                            <div class = "col-lg-12 col-12 suggestionUserName">
                                                <?php echo $data["reviews"][$i]["username"]; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php  } ?>
                                
                            </div>
                            <?php  } ?>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>
        
        
        
        
    </body>
    
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>-->
    
    <!--Local Bootstrap JS -->
          <script src = "../bootstrap/js/bootstrap.min.js">
              
          </script>
  
      
      <script
			  src="https://code.jquery.com/jquery-3.3.1.js"
			  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
			  crossorigin="anonymous"></script>
    
    <script src="../js/scripts.js">
    </script>
</html>
