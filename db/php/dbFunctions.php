<?php 

    //Requried files

    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('rabbitMQClient.php');
    require_once('dbFunctions.php');
    require_once('dbConnection.php');

    //Functions for different cases
    $connection = dbConnection();

    //Function for loggin user in the system and authentication
    function doLogin($username, $password){
        
        $connection = dbConnection();
        
        $query = "SELECT * FROM user WHERE username = '$username'";
        $result = $connection->query($query);
        if($result){
            if($result->num_rows == 0){
                return "False";
            }else{
                while ($row = $result->fetch_assoc()){
                    $salt = $row['salt'];
                    $h_password = sha1($password.$salt);
                    if ($row['h_password'] == $h_password){
                        return "True";
                    }else{
                        return "False";
                    }
                }
            }
        }
    }
    
    //Generating random Alpha-Numeric string for unique salt for every new registration
    function RandomString($length) {
            $randstr = '';
            srand((double) microtime(TRUE) * 1000000);
            //our array add all letters and numbers if you wish
            $chars = array(
                'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'p',
                'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '1', '2', '3', '4', '5',
                '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 
                'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');

            for ($rand = 0; $rand <= $length; $rand++) {
                $random = rand(0, count($chars) - 1);
                $randstr .= $chars[$random];
            }
            return $randstr;
        }
    
    //Hashes password for storing
    function HashPassword($password, $salt){
            $new_pass = $password . $salt;
             return sha1($new_pass);
        }
    
    //  This function registers a new user 
    function register($username, $email, $password, $firstname, $lastname, $dob_month, $dob_date, $dob_year, $sex, $street_number, $street_name, $city, $state, $zip, $country){
        
        //Makes connection to database
        $connection = dbConnection();
        
        //Generates a salt for the new user
        $salt = RandomString(29);
        echo "<br>Salt: ";
        echo $salt;
        
        //Hashes password
        $h_password = HashPassword($password, $salt);
        echo "<br>Hsahed Pass: ";
        echo $h_password;
        
        //Query to check if the username is taken
        $check_username = "SELECT username FROM user WHERE username = '$username'";
        $check_result = $connection->query($check_username);
        
        while ($row = $check_result->fetch_assoc()){
            if ($row['username'] == $username){
                return "Username already taken";
            }
        }
        
        //Query for a new user
        $newuser_query = "INSERT INTO user VALUES ('$username', '$email', '$h_password', '$salt', '$firstname', '$lastname', '$dob_month', '$dob_date', '$dob_year', '$sex', '$street_number', '$street_name', '$city', '$state', '$zip', '$country')";
        
        $result = $connection->query($newuser_query);
        echo "<br>Query executed: ";
        echo $result;
         
        echo '<br><br>register function<br><br>';
        return "True";
    }

    // This function returns cities by state
    function cityByState($state){
        
        $connection = dbConnection();
        
        $query = "SELECT DISTINCT city FROM usadata WHERE state = '$state' ORDER BY city ASC";
        $result = $connection->query($query);
        
        if($result){
            if($result->num_rows == 0){
                return "False";
            }else{
                while ($row = $result->fetch_assoc()){
                    $city = $row['city'];
                    $citylist[] = array($city);
                }
            }
        }
        return json_encode($citylist);
          
    }

    // This function returns restaurant
    function restaurantInfo($state, $city, $cuisine_id){
        
        $connection = dbConnection();
        
        
        //Check for city_id using city and state name
        $cityid_query = "SELECT city_id FROM usadata WHERE city = '$city' AND state = '$state'";
        $cityid_result = $connection->query($cityid_query);
        
        if($cityid_result){
            if($cityid_result->num_rows == 0){
                $restaurant_result_dmz = getRestaurantDmz($state, $city, $cuisine_id);
                
                $rest_result = json_decode($restaurant_result_dmz, true);
                
                $city_id = $rest_result['city_id'];
                $restaurants = $rest_result['restaurants'];
                
                $rest_added_db = addRestaurantDb($city_id, $city, $state, $cuisine_id, $restaurants);
                
                
            }elseif($cityid_result->num_rows == 1){
                while ($row = $cityid_result->fetch_assoc()){
                    $city_id = $row['city_id'];
                    $restaurant_result = getRestaurantDb($cuisine_id, $city_id, $city, $state);
                }
            }
        }
        
        //---------------------------------------------------------------------------//
        
        
        
        //---------------------------------------------------------------------------//
        
        //If there is no city_id available then ask for restaurants with this city_id and cuisine_id from DMZ
        $rest_info = getRestaurantDmz($state, $city, $cuisine_id);
        $cities = $rest_info['city_name'];
        echo $cities;
        return json_encode($rest_info);
        
        
    }

    //This functions fetched existing restaurants from database
    function getRestaurantDb($cuisine_id, $city_id, $city, $state){
        
        //If city_id and restaurant with cuisine_id is available
        $restaurnt_query = "SELECT restaurant.restaurant_id FROM restaurant INNER JOIN (SELECT restaurant_cuisine.restaurant_id FROM restaurant_cuisine WHERE restaurant_cuisine.cuisine_id = '$cuisine_id') WHERE restaurant.city_id = '$city_id'";
        $restaurant_result = $connection->query($query);
        
        if($restaurant_result){
            if($restaurant_result->num_rows == 0){
                $restaurant_result_dmz = getRestaurantDmz($state, $city, $cuisine_id);
                
            }else{
                while ($row = $restaurant_result->fetch_assoc()){
                    
                }
            }
        }
        
    }

    function getRestaurantDmz($state, $city, $cuisine_id){
        
        $request = array();
        $request['type'] = "RestaurantInfo";
        $request['city_name'] = $city;
        $request['state_name'] = $state;
        $request['cuisine_id'] = $cuisine_id;

        $returnedValue = createClientForDmz($request);
        
        return $returnedValue;

        
    }

    //This function adds restaurants in database
    function addRestaurantDb($city_id, $city, $state, $cuisine_id, $restaurants){
        
        //Insert city_id in usadata
        $city_id_query = "UPDATE TABLE usadata SET city_id = '$city_id' WHERE city = '$city' AND state = '$state'";
        $connection->query($city_id_query);
        
        //Insert new restaurants into restaurant table
        for($i = 0; $i < count($restaurants); $i++){
            $rest_id = $restaurants[$i]['restaurant_id'];
            $rest_name = $restaurants[$i]['name'];
            $rest_menu = $restaurants[$i]['menu_url'];
            $rest_thumb = $restaurants[$i]['thumb'];
            $rest_addr = $restaurants[$i]['address'];
            $rest_cityid = $restaurants[$i]['city_id'];
            $rest_rating = $restaurants[$i]['rating'];
            $rest_ratingtext = $restaurants[$i]['rating_text'];
            
            $rest_insert_query = "INSERT INTO restaurant (restaurant_id, restaurant_name, restaurant_address, city_id, menu_url, thumbnail_url, aggregate_rating, rating_text) VALUES ('$rest_id', '$rest_name', '$rest_addr', '$rest_cityid', '$rest_menu', '$rest_thumb', '$rest_rating', '$rest_ratingtext')";
            $connection->query($rest_insert_query);
        }
        
        
        
        
        
        
        
        
        
        
        
        //Insert rest_id and cuisine_id in rest_cuisine
        //$rest_cuisine_query = "INSERT INTO restaurant_cuisine VALUES ('$rest')";
    }


?>