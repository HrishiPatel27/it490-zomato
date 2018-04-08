<?php
    

//  Error logging
    error_reporting(E_ALL);
    
    ini_set('display_errors', 'Off');
    ini_set('log_errors', 'On');
    ini_set('error_log', dirname(__FILE__). '/../logging/log.txt');

    //  Including required files
    include("functions.php");

    

    //logAndSendErrors();
    

    //  Starting session
    session_start();

    
    
    //  Trowing out the user if the user is not looged in and trying to fetch this page
    gateway();

?>

<!doctype html>
<html lang="en">
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

      <!-- Image and text -->
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

    
    <div class="container-fluid">
        <div class = "row">
            <div class = "col-sm-12" id = "main-holder">

                    <!-- Row for selecting criterias buttons  -->
                    <div class = "row">
                        <div class = "col-sm-12" id = "login-register-button-holder">
                            <div class = "row">
                                
                                <!-- State -->
                                <div class = "col-sm-6 input-group">
                                    
                                    <select class="custom-select mr-sm-2 input-group-addon" name="state" onchange="stateSelected()" id = "state_id">
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

                                    <select class="custom-select mr-sm-2 input-group-addon" name="city" id = "city_id">

                                    </select>
                                </div>

                                <!-- Cuisine -->
                                <div class = "col-sm-6 input-group">
                                    <select class="custom-select mr-sm-2 input-group-addon" name="cuisine" id = "cuisine_id">
                                        <option value="0" selected="1">Cuisine</option>
                                        <option value = "6">Afghani</option>
                                        <option value = "152">African</option>
                                        <option value = "1">American</option>
                                        <option value = "954">Amish</option>
                                        <option value = "151">Argentine</option>
                                        <option value = "175">Armenian</option>
                                        <option value = "3">Asian</option>
                                        <option value = "131">Australian</option>
                                        <option value = "201">Austrian</option>
                                        <option value = "193">BBQ</option>
                                        <option value = "955">Bagels</option>
                                        <option value = "5">Bakery</option>
                                        <option value = "227">Bar Food</option>
                                        <option value = "132">Belgian</option>
                                        <option value = "270">Beverages</option>
                                        <option value = "159">Brazilian</option>
                                        <option value = "182">Breakfast</option>
                                        <option value = "133">British</option>
                                        <option value = "247">Bubble Tea</option>
                                        <option value = "168">Burger</option>
                                        <option value = "22">Burmese</option>
                                        <option value = "30">Cafe</option>
                                        <option value = "491">Cajun</option>
                                        <option value = "956">California</option>
                                        <option value = "111">Cambodian</option>
                                        <option value = "381">Canadian</option>
                                        <option value = "121">Cantonese</option>
                                        <option value = "158">Caribbean</option>
                                        <option value = "202">Central Asian</option>
                                        <option value = "229">Chilean</option>
                                        <option value = "25">Chinese</option>
                                        <option value = "161">Coffee and Tea</option>
                                        <option value = "287">Colombian</option>
                                        <option value = "928">Creole</option>
                                        <option value = "881">Crepes</option>
                                        <option value = "153">Cuban</option>
                                        <option value = "203">Danish</option>
                                        <option value = "192">Deli</option>
                                        <option value = "100">Desserts</option>
                                        <option value = "411">Dim Sum</option>
                                        <option value = "541">Diner</option>
                                        <option value = "958">Dominican</option>
                                        <option value = "959">Donuts</option>
                                        <option value = "268">Drinks Only</option>
                                        <option value = "651">Eastern European</option>
                                        <option value = "316">Ecuadorian</option>
                                        <option value = "149">Ethiopian</option>
                                        <option value = "38">European</option>
                                        <option value = "40">Fast Food</option>
                                        <option value = "112">Filipino</option>
                                        <option value = "298">Fish and Chips</option>
                                        <option value = "318">Fondue</option>
                                        <option value = "45">French</option>
                                        <option value = "501">Frozen Yogurt</option>
                                        <option value = "274">Fusion</option>
                                        <option value = "205">Georgian</option>
                                        <option value = "134">German</option>
                                        <option value = "156">Greek</option>
                                        <option value = "521">Hawaiian</option>
                                        <option value = "143">Healthy Food</option>
                                        <option value = "228">Hungarian</option>
                                        <option value = "233">Ice Cream</option>
                                        <option value = "148">Indian</option>
                                        <option value = "114">Indonesian</option>
                                        <option value = "154">International</option>
                                        <option value = "135">Irish</option>
                                        <option value = "218">Israeli</option>
                                        <option value = "55">Italian</option>
                                        <option value = "207">Jamaican</option>
                                        <option value = "60">Japanese</option>
                                        <option value = "265">Jewish</option>
                                        <option value = "164">Juices</option>
                                        <option value = "178">Kebab</option>
                                        <option value = "67">Korean</option>
                                        <option value = "901">Laotian</option>
                                        <option value = "136">Latin American</option>
                                        <option value = "66">Lebanese</option>
                                        <option value = "69">Malaysian</option>
                                        <option value = "70">Mediterranean</option>
                                        <option value = "73">Mexican</option>
                                        <option value = "137">Middle Eastern</option>
                                        <option value = "74">Mongolian</option>
                                        <option value = "147">Moroccan</option>
                                        <option value = "75">Mughlai</option>
                                        <option value = "117">Nepalese</option>
                                        <option value = "996">New American</option>
                                        <option value = "995">New Mexican</option>
                                        <option value = "961">New Zealand</option>
                                        <option value = "321">Pacific</option>
                                        <option value = "963">Pacific Northwest</option>
                                        <option value = "139">Pakistani</option>
                                        <option value = "183">Patisserie</option>
                                        <option value = "81">Persian</option>
                                        <option value = "162">Peruvian</option>
                                        <option value = "82">Pizza</option>
                                        <option value = "970">Po'Boys</option>
                                        <option value = "219">Polish</option>
                                        <option value = "87">Portuguese</option>
                                        <option value = "983">Pub Food</option>
                                        <option value = "361">Puerto Rican</option>
                                        <option value = "320">Ramen</option>
                                        <option value = "84">Russian</option>
                                        <option value = "998">Salad</option>
                                        <option value = "601">Salvadorean</option>
                                        <option value = "304">Sandwich</option>
                                        <option value = "691">Scandinavian</option>
                                        <option value = "210">Scottish</option>
                                        <option value = "83">Seafood</option>
                                        <option value = "128">Sichuan</option>
                                        <option value = "119">Singaporean</option>
                                        <option value = "611">Somali</option>
                                        <option value = "461">Soul Food</option>
                                        <option value = "267">South African</option>
                                        <option value = "972">South American</option>
                                        <option value = "471">Southern</option>
                                        <option value = "966">Southwestern</option>
                                        <option value = "89">Spanish</option>
                                        <option value = "86">Sri Lankan</option>
                                        <option value = "141">Steak</option>
                                        <option value = "177">Sushi</option>
                                        <option value = "211">Swedish</option>
                                        <option value = "997">Taco</option>
                                        <option value = "190">Taiwanese</option>
                                        <option value = "179">Tapas</option>
                                        <option value = "163">Tea</option>
                                        <option value = "964">Teriyaki</option>
                                        <option value = "150">Tex-Mex</option>
                                        <option value = "95">Thai</option>
                                        <option value = "93">Tibetan</option>
                                        <option value = "761">Tunisian</option>
                                    </select>

                                    <button type="submit" class="btn btn-primary input-group-addon" onclick="searchRestaurants()">Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                
                
                    <!-- Division to hold -->
                    <div class = "row">
                        <div class = "col-sm-12" id = "divToHoldRest">
                                
                            <!--<h1>Select State, City and Cuisines</h1>-->
                            
                            <div class = "row">
                                <div class = "col-12 col-lg-6 offset-lg-3" id = "lookUpRest">
                                    Look up restaurants
                                </div>
                            </div>
                                
                        </div>
                    </div>
                </div>
        </div>
    </div>
      
        <!-- Test Modal for Suggestions -->
        <div class="modal" id="suggestionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Suggestion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class = "row">
                            <div class = "col-sm-12" id = "login-form">
                                <form action = "../php/login.php" method = "POST">
                                    <div class = "row">
                                        <div class = "col-sm-12">
                                            <input type="text" class="form-control  margin-top-for-form-elements" id="suggestionName" placeholder="Dish Name" name = "username">
                                        </div>
                                    </div>
                                    
                                    <br>
                                    
                                    <div class = "row">
                                        <div class = "col-sm-12">
                                            <label for = "suggestionDescription_id">Suggestion Description</label>
                                        </div>
                                    </div>
                                    
                                    <div class = "row">
                                        <div class = "col-sm-12">
                                            
                                            <textarea class="form-control margin-top-for-form-elements" id="suggestionDescription_id" rows = "5">
                                            </textarea>
                                        </div>
                                    </div>
                                    
                                    <div class = "row margin-top-for-form-elements">
                                        <div class = "col-sm-12">
                                             <button type="submit" class="btn btn-primary" >Submit</button>
                                        </div>
                                    </div>
                                   
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <!-- Test Modal for Review -->
        <!-- Register Modal -->
      <!--
        <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Write Review</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class = "row">
                            <div class = "col-sm-12" id = "register-form">
                                <form action = "../php/register.php" method = "POST">
                            
                                    <div class = "row">
                                        <div class = "col-sm-12">
                                            <label for = "suggestionDescription_id">Review</label>
                                        </div>
                                    </div>
                                    
                                    <div class = "row">
                                        <div class = "col-sm-12">                             
                                            <textarea class="form-control margin-top-for-form-elements" id="suggestionDescription_id" rows = "5">
                                            </textarea>
                                        </div>
                                    </div>
                                    
                                    <br>
                                    <div class = "row">
                                        <div class = "col-sm-12">
                                            <input type="text" class="form-control  margin-top-for-form-elements" id="example-number-input" placeholder="Eg: 4.7" name = "username">
                                        </div>
                                    </div>
                                    
                                    <div class = "row margin-top-for-form-elements">
                                        <div class = "col-sm-12">
                                             <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <div class="modal-footer margin-top-for-form-elements">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            
                        </div>
                    </div>
                </div>
            </div>
          </div>
        -->
      
      


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

      <script>
          
                $(document).on('show.bs.modal', '#suggestionModal', function(){
                    alert("Modal is going to be displayed");
                });
            
                $(document).ready(function(){
                   $('#suggestion_button_id').click(function(){
                        alert("Button was clicked");
                    }); 
                });
          
          
            
      </script>
      
      <script src = "../js/scripts.js">
      </script>

        
  </body>
</html>



