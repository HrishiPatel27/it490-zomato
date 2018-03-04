<?php
    session_start();

    
    if (!$_SESSION["logged"]){
        header("Location: ../html/loginRegister.html");
    }


?>

<!doctype html>
<html lang="en">
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

      <!-- Image and text -->
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#">
        <img src="/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
        Ciphers
      </a>


      <div class="btn-group">
          <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php echo $_SESSION["username"] ?>
          </button>
          <div class="dropdown-menu dropdown-menu-left">
              <button class="dropdown-item" type="button">My Profile</button>
              <button class="dropdown-item" type="button">About</button>
              <a href = "destroySessions.php?logout=true">
                  <button class="dropdown-item" type="button">Logout</button>
              </a>
          </div>
      </div>
    </nav>


    <div class="container-fluid">
        <div class = "row">
            <div class = "col-sm-12" id = "main-holder">

                    <!-- Row for login and Register modal buttons  -->
                    <div class = "row">
                        <div class = "col-sm-12" id = "login-register-button-holder">
                            <div class = "row margin-top-for-form-elements">
                                
                                        <!-- State -->
                                        <div class = "col-sm-3">
                                            <select class="custom-select mr-sm-2" name="state" onchange="stateSelected()" id = "state_selection_id">
                                                <option value="0" selected="1">State</option>
                                                <option value="AL">Alabama</option>
                                                <option value="AK">Alaska</option>
                                                <option value="AZ">Arizona</option>
                                                <option value="AR">Arkansas</option>
                                                <option value="CA">California</option>
                                                <option value="CO">Colorado</option>
                                                <option value="CT">Connecticut</option>
                                                <option value="DE">Delaware</option>
                                                <option value="DC">District Of Columbia</option>
                                                <option value="FL">Florida</option>
                                                <option value="GA">Georgia</option>
                                                <option value="HI">Hawaii</option>
                                                <option value="ID">Idaho</option>
                                                <option value="IL">Illinois</option>
                                                <option value="IN">Indiana</option>
                                                <option value="IA">Iowa</option>
                                                <option value="KS">Kansas</option>
                                                <option value="KY">Kentucky</option>
                                                <option value="LA">Louisiana</option>
                                                <option value="ME">Maine</option>
                                                <option value="MD">Maryland</option>
                                                <option value="MA">Massachusetts</option>
                                                <option value="MI">Michigan</option>
                                                <option value="MN">Minnesota</option>
                                                <option value="MS">Mississippi</option>
                                                <option value="MO">Missouri</option>
                                                <option value="MT">Montana</option>
                                                <option value="NE">Nebraska</option>
                                                <option value="NV">Nevada</option>
                                                <option value="NH">New Hampshire</option>
                                                <option value="NJ">New Jersey</option>
                                                <option value="NM">New Mexico</option>
                                                <option value="NY">New York</option>
                                                <option value="NC">North Carolina</option>
                                                <option value="ND">North Dakota</option>
                                                <option value="OH">Ohio</option>
                                                <option value="OK">Oklahoma</option>
                                                <option value="OR">Oregon</option>
                                                <option value="PA">Pennsylvania</option>
                                                <option value="RI">Rhode Island</option>
                                                <option value="SC">South Carolina</option>
                                                <option value="SD">South Dakota</option>
                                                <option value="TN">Tennessee</option>
                                                <option value="TX">Texas</option>
                                                <option value="UT">Utah</option>
                                                <option value="VT">Vermont</option>
                                                <option value="VA">Virginia</option>
                                                <option value="WA">Washington</option>
                                                <option value="WV">West Virginia</option>
                                                <option value="WI">Wisconsin</option>
                                                <option value="WY">Wyoming</option>
                                            </select>
                                        </div>

                                        <!-- City -->
                                        <div class = "col-sm-3">
                                            <select class="custom-select mr-sm-2" name="city" id = "city_id">
                                               
                                            </select>
                                        </div>

                                        <!-- Cuisine -->
                                        <div class = "col-sm-3">
                                            <select class="custom-select mr-sm-2" name="cuisine" id = "cuisine_id">
                                                <option value="0" selected="1">Cuisine</option>
                                                <option value = "6">Afghani</option>
                                                <option value = "1">American</option>
                                                <option value = "2">Andhra</option>
                                                <option value = "4">Arabian</option>
                                                <option value = "175">Armenian</option>
                                                <option value = "3">Asian</option>
                                                <option value = "292">Awadhi</option>
                                                <option value = "193">BBQ</option>
                                                <option value = "5">Bakery</option>
                                                <option value = "10">Bengali</option>
                                                <option value = "270">Beverages</option>
                                                <option value = "7">Biryani</option>
                                                <option value = "247">Bubble Tea</option>
                                                <option value = "168">Burger</option>
                                                <option value = "30">Cafe</option>
                                                <option value = "994">Charcoal Chicken</option>
                                                <option value = "25">Chinese</option>
                                                <option value = "35">Continental</option>
                                                <option value = "100">Desserts</option>
                                                <option value = "38">European</option>
                                                <option value = "40">Fast Food</option>
                                                <option value = "45">French</option>
                                                <option value = "274">Fusion</option>
                                                <option value = "47">Goan</option>
                                                <option value = "156">Greek</option>
                                                <option value = "181">Grill</option>
                                                <option value = "48">Gujarati</option>
                                                <option value = "143">Healthy Food</option>
                                                <option value = "49">Hyderabadi</option>
                                                <option value = "233">Ice Cream</option>
                                                <option value = "148">Indian</option>
                                                <option value = "55">Italian</option>
                                                <option value = "60">Japanese</option>
                                                <option value = "164">Juices</option>
                                                <option value = "65">Kashmiri</option>
                                                <option value = "178">Kebab</option>
                                                <option value = "62">Kerala</option>
                                                <option value = "63">Konkan</option>
                                                <option value = "67">Korean</option>
                                                <option value = "66">Lebanese</option>
                                                <option value = "157">Lucknowi</option>
                                                <option value = "102">Maharashtrian</option>
                                                <option value = "70">Mediterranean</option>
                                                <option value = "73">Mexican</option>
                                                <option value = "1015">Mithai</option>
                                                <option value = "1018">Modern Indian</option>
                                                <option value = "75">Mughlai</option>
                                                <option value = "231">North Eastern</option>
                                                <option value = "50">North Indian</option>
                                                <option value = "278">Oriental</option>
                                                <option value = "290">Parsi</option>
                                                <option value = "82">Pizza</option>
                                                <option value = "88">Rajasthani</option>
                                                <option value = "1023">Rolls</option>
                                                <option value = "998">Salad</option>
                                                <option value = "304">Sandwich</option>
                                                <option value = "83">Seafood</option>
                                                <option value = "993">Sindhi</option>
                                                <option value = "85">South Indian</option>
                                                <option value = "90">Street Food</option>
                                                <option value = "177">Sushi</option>
                                                <option value = "213">Swiss</option>
                                                <option value = "163">Tea</option>
                                                <option value = "95">Thai</option>
                                                <option value = "308">Vegetarian</option>
                                                <option value = "1024">Wraps</option>
                                                
                                            </select>
                                        </div>

                                        <!-- Submit -->
                                        <div class = "col-sm-3">
                                            <button type="submit" class="btn btn-primary">Search</button>
                                        </div>
                                    </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      
      <script
			  src="https://code.jquery.com/jquery-3.3.1.js"
			  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
			  crossorigin="anonymous"></script>
      
      
      <script src = "../js/scripts.js"> </script>
      
  </body>
</html>



