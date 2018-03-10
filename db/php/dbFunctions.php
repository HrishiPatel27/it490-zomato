<?php 

    //Requried files

    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('rabbitMQClient.php');
    require_once('dbConnection.php');


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
                    $h_password = hashPassword($password, $salt);
                    if ($row['h_password'] == $h_password){
                        return true;
                    }else{
                        return false;
                    }
                }
            }
        }
    }

    // This function checks is username is already taken
    function checkUsername($username){
        
        $connection = dbConnection();
        
        //Query to check if the username is taken
        $check_username = "SELECT username FROM user WHERE username = '$username'";
        $check_result = $connection->query($check_username);
        
        while ($row = $check_result->fetch_assoc()){
            if ($row['username'] == $username){
                return "False";
            }else{
                return "True";
            }
        }
    }

    // This function checks if email is valid
    function checkEmail($email){
        
        $connection = dbConnection();
        
        //Query to check if the email is email
        $check_email = "SELECT email FROM user WHERE email = '$email'";
        $check_result = $connection->query($check_email);
        
        while ($row = $check_result->fetch_assoc()){
            if ($row['email'] == $email){
                return "True";
            }else{
                return "False";
            }
        }
    }

    // This function sends user email with username and password
    function sendEmail($email){
        
        $subject = "Change password within 24 hours";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: <hp335@njit.edu>";
        
        $username = get_credentials($email);
        
        $uniquekey = generateUniqueKey(4);
        
        $storekey = storeUniqueKey($username, $uniquekey);
        
        $message = "<b>Username:</b> " . "$username" . "<br>" . "<b>Unique Key:</b> " . "$uniquekey" . "<br><br>" . "Please reset the password in 24 hours. Click on the link below and reset your password by providing your Email, Username and Unique Key.<br><br>" . "link";
        
        mail($email, $subject, $message, $headers);
        
        return true;
    }

    // This functions returns credentials of user with email provided
    function get_credentials($email){
        
        $connection = dbConnection();
        
        //Query for fetching credentials
        $credentials_query = "SELECT username FROM user WHERE email = '$email'";
        $credentials_query_result = $connection->query($credentials_query);
        
        $row = $credentials_query_result->fetch_assoc();
        $user = $row['username'];
        return $user;
    }

    // This function generates unique for reset password
    function generateUniqueKey($length){
        
        $randstr = '';
            srand((double) microtime(TRUE) * 1000000);
           
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

    // This function stores Unique generated for user
    function storeUniqueKey($username, $uniquekey){
        
        //Query to store unique key for username
        $storekey_query = "INSERT INTO userkey VALUES ('$username', '$uniquekey', NOW())";
        $storekey_query_result = $connection->query($storekey_query);
        
        return $storekey_query_result;
    }
    
    //Generating random Alpha-Numeric string for unique salt for every new registration
    function randomString($length) {
            $randstr = '';
            srand((double) microtime(TRUE) * 1000000);
           
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
    function hashPassword($password, $salt){
            $new_pass = $password . $salt;
             return hash("sha256", $new_pass);
        }
    
    //  This function registers a new user 
    function register($username, $email, $password, $firstname, $lastname){
        
        //Makes connection to database
        $connection = dbConnection();
        
        //Generates a salt for the new user
        $salt = randomString(29);
        
        //Hashes password
        $h_password = hashPassword($password, $salt);
        
        //Query for a new user
        $newuser_query = "INSERT INTO user VALUES ('$username', '$email', '$h_password', '$salt', '$firstname', '$lastname')";
        
        $result = $connection->query($newuser_query);
        
        return true;
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
        echo "In restaurantInfo function";
        
        //Check for city_id using city and state name
        $cityid_query = "SELECT city_id FROM usadata WHERE city = '$city' AND state = '$state'";
        $cityid_query_result = $connection->query($cityid_query);
        
        echo "City id searching done";
        
        while ($row = $cityid_query_result->fetch_assoc()){
            $city_id = $row['city_id'];
            if($city_id == 0){
                echo "request to dmz sent";
                $restaurant_result_dmz = getRestaurantDmz($state, $city, $cuisine_id);
                echo "data came from dmz";
            
                $city_id = $restaurant_result_dmz['city_id'];
                $restaurants = $restaurant_result_dmz['restaurants'];

                echo "Now entering addRestaurantDb function";
                $rest_added_db = addRestaurantDb($city_id, $city, $state, $cuisine_id, $restaurants);

                $restaurnt_query = "SELECT * FROM restaurant INNER JOIN (SELECT DISTINCT restaurant_cuisine.restaurant_id FROM restaurant_cuisine WHERE restaurant_cuisine.cuisine_id = '$cuisine_id') AS R1 ON restaurant.restaurant_id = R1.restaurant_id  WHERE restaurant.city_id = '$city_id'";
                $restaurant_result = $connection->query($restaurnt_query);
                $rest = [];
                while ($row = $restaurant_result->fetch_assoc()){
                    $id = $row['restaurant_id'];
                    $name = $row['restaurant_name'];
                    $url = $row['menu_url'];
                    $thumb = $row['thumbnail_url'];
                    $address = $row['restaurant_address'];
                    $city_id = $row['city_id'];
                    $rating = $row['aggregate_rating'];
                    $rating_text = $row['rating_text'];

                    $rest[] = array("restaurant_id"=>$id , "name"=>$name , "menu_url"=>$url , "thumb"=>$thumb , "address"=>$address ,"city_id"=>$city_id , "rating"=>$rating , "rating_text"=>$rating_text);
                }
                $all_info = array('city_name'=>$city, 'state_name'=>$state, 'city_id'=>$city_id, 'restaurants'=>$rest);
                
                echo "Left addRestaurantDb function";
                
                
                return json_encode($all_info);
                
            }
            if($city_id != 0){
                $restaurant_result_db = getRestaurantDb($cuisine_id, $city_id, $city, $state);
                echo "Data stored and sent to FE";
                return json_encode($restaurant_result_db);
            }
        } 
    }

    //This functions fetched existing restaurants from database
    function getRestaurantDb($cuisine_id, $city_id, $city, $state){
        
        $connection = dbConnection();
        
        //If city_id and restaurant with cuisine_id is available
        $restaurnt_query = "SELECT * FROM restaurant INNER JOIN (SELECT DISTINCT restaurant_cuisine.restaurant_id FROM restaurant_cuisine WHERE restaurant_cuisine.cuisine_id = '$cuisine_id') AS R1 ON restaurant.restaurant_id = R1.restaurant_id  WHERE restaurant.city_id = '$city_id'";
                
        $restaurant_result = $connection->query($restaurnt_query);
        
        if($restaurant_result){
            if($restaurant_result->num_rows == 0){
                
                $restaurant_result_dmz = getRestaurantDmz($state, $city, $cuisine_id);
                
                $city_id = $restaurant_result_dmz['city_id'];
                $restaurants = $restaurant_result_dmz['restaurants'];
                
                $rest_added_db = addRestaurantDb($city_id, $city, $state, $cuisine_id, $restaurants);
                
                $restaurnt_query1 = "SELECT * FROM restaurant INNER JOIN (SELECT DISTINCT restaurant_cuisine.restaurant_id FROM restaurant_cuisine WHERE restaurant_cuisine.cuisine_id = '$cuisine_id') AS R1 ON restaurant.restaurant_id = R1.restaurant_id  WHERE restaurant.city_id = '$city_id'";
                $restaurant_result1 = $connection->query($restaurnt_query1);
                $rest = [];
                while ($row = $restaurant_result1->fetch_assoc()){
                    $id = $row['restaurant_id'];
                    $name = $row['restaurant_name'];
                    $url = $row['menu_url'];
                    $thumb = $row['thumbnail_url'];
                    $address = $row['restaurant_address'];
                    $city_id = $row['city_id'];
                    $rating = $row['aggregate_rating'];
                    $rating_text = $row['rating_text'];

                    $rest[] = array("restaurant_id"=>$id , "name"=>$name , "menu_url"=>$url , "thumb"=>$thumb , "address"=>$address ,"city_id"=>$city_id , "rating"=>$rating , "rating_text"=>$rating_text);
                }
                $all_info = array('city_name'=>$city, 'state_name'=>$state, 'city_id'=>$city_id, 'restaurants'=>$rest);
                return $all_info;
                
            }elseif($restaurant_result->num_rows > 0){
                $rest = [];
                while ($row = $restaurant_result->fetch_assoc()){
                    $id = $row['restaurant_id'];
                    $name = $row['restaurant_name'];
                    $url = $row['menu_url'];
                    $thumb = $row['thumbnail_url'];
                    $address = $row['restaurant_address'];
                    $city_id = $row['city_id'];
                    $rating = $row['aggregate_rating'];
                    $rating_text = $row['rating_text'];

                    $rest[] = array("restaurant_id"=>$id , "name"=>$name , "menu_url"=>$url , "thumb"=>$thumb , "address"=>$address ,"city_id"=>$city_id , "rating"=>$rating , "rating_text"=>$rating_text);
                }
                $all_info = array('city_name'=>$city, 'state_name'=>$state, 'city_id'=>$city_id, 'restaurants'=>$rest);
                return $all_info;
                return "there are restaurants in database";
            }
        }
        
    }

    function getRestaurantDmz($state, $city, $cuisine_id){
        
        echo "In dmz function";
        $request = array();
        $request['type'] = "RestaurantInfo";
        $request['city_name'] = $city;
        $request['state_name'] = $state;
        $request['cuisine_id'] = $cuisine_id;

        $returnedValue = createClientForDmz($request);
        echo "Leaving dmz with data";
        return $returnedValue;
        
    }

    //This function adds restaurants in database
    function addRestaurantDb($city_id, $city, $state, $cuisine_id, $restaurants){
        
        $connection = dbConnection();
        echo "In addRestaurantDb function";
        
        //Insert city_id in usadata
        $city_id_query = "UPDATE usadata SET city_id = '$city_id' WHERE city = '$city' AND state = '$state'";
        $city_id_query_result = $connection->query($city_id_query);
        
        echo $city_id_query_result;
        echo "City_id added in usadata";
            
        //Insert new restaurants into restaurant table
        echo "Now adding new restaurants";
        for($i = 0; $i < count($restaurants); $i++){
            $rest_id = $restaurants[$i]['restaurant_id'];
            $rest_name = $restaurants[$i]['name'];
            $rest_menu = $restaurants[$i]['menu_url'];
            $rest_thumb = $restaurants[$i]['thumb'];
            $rest_addr = $restaurants[$i]['address'];
            $rest_cityid = $restaurants[$i]['city_id'];
            $rest_rating = $restaurants[$i]['rating'];
            $rest_ratingtext = $restaurants[$i]['rating_text'];
            
            //Inserts new restaurant in restaurant table
            $rest_insert_query = "INSERT INTO restaurant (restaurant_id, restaurant_name, restaurant_address, city_id, menu_url, thumbnail_url, aggregate_rating, rating_text) VALUES ('$rest_id', '$rest_name', '$rest_addr', '$rest_cityid', '$rest_menu', '$rest_thumb', '$rest_rating', '$rest_ratingtext')";
            $rest_insert_query_result = $connection->query($rest_insert_query);
            //echo $rest_insert_query_result;
            
            //Inserts new rest_id and cuisine_id in restaurant_cuisine table
            $rest_cuisine_query = "INSERT INTO restaurant_cuisine VALUES ('$rest_id', '$cuisine_id')";
            $connection->query($rest_cuisine_query);
        }
        
        
        //Insert rest_id and cuisine_id in rest_cuisine
        
        return 'true';
        
    }

    //This function enters suggestion for restaurant from user
    function writeSuggestion($username, $dish_name, $suggestion, $restaurant_id){
        
        $connection = dbConnection();
        
        $addsuggestion_query = "INSERT INTO suggestion VALUES ('$username', '$restaurant_id', '$suggestion', '$dish_name')";
        $result = $connection->query($addsuggestion_query);
        
        return "true";
    }

    //This function enters reviews for restaurant from user
    function writeReview($username, $restaurant_id, $review_rating, $review_text){
        
        $connection = dbConnection();
        
        $addreview_query = "INSERT INTO review VALUES ('$username', '$restaurant_id', '$review_text', '$review_rating')";
        $result = $connection->query($addreview_query);
        return "true";
    }

    //This function fetches individual restaurant info
    function uniqueRestaurantInfo($restaurant_id, $user){
        
        $connection = dbConnection();
        
        //echo "in function";
        //Getting suggestions in restaurant and storing in $suggestioninfo
        
        $getsuggestion_query = "SELECT * FROM suggestion WHERE restaurant_id = '$restaurant_id'";
        $getsuggestion_query_result = $connection->query($getsuggestion_query);
        //echo "Executed suggestions query         ";
        if($getsuggestion_query_result){
            if($getsuggestion_query_result->num_rows == 0){
                $suggestionresult = "false";
                $suggestioninfo[] = array('username'=>$suggestionresult, 'suggestion'=>$suggestionresult);
            }else{
                while($row = $getsuggestion_query_result->fetch_assoc()){
                    $suggestion = $row['suggestion'];
                    $dish_name = $row['dish_name'];
                    $user = $row['username'];
                    $suggestioninfo[] = array('username'=>$user, 'suggestion'=>$dish_name);
                }
            }
        }
        
        //Getting reviews in restaurant and storing in $reviewsinfo
        
        $getreview_query = "SELECT * FROM review WHERE restaurant_id = '$restaurant_id'";
        $getreview_query_result = $connection->query($getreview_query);
        //echo "Executed reviews query        ";
        if($getreview_query_result){
            if($getreview_query_result->num_rows == 0){
                $reviewresult = "false";
                $reviewsinfo[] = array('username'=>$reviewresult, 'review_rating'=>$reviewresult, 'review_text'=>$reviewresult);
            }else{
                while($row = $getreview_query_result->fetch_assoc()){
                    $review_rating = $row['review_rating'];
                    $review_text = $row['review_text'];
                    $user = $row['username'];
                    $reviewsinfo[] = array('username'=>$user, 'review_rating'=>$review_rating, 'review_text'=>$review_text);
                }   
            }
        }
        
        //Getting favorite restaurant of user
        $getfavorite_query = "SELECT * FROM favorite WHERE restaurant_id = '$restaurant_id' AND username = '$user'";
        $getfavorite_query_result = $connection->query($getfavorite_query);
        
        if($getfavorite_query_result){
            if($getfavorite_query_result->num_rows == 0){
                $favoriteinfo = "false";
            }elseif($getfavorite_query_result->num_rows > 0){
                $favoriteinfo = "true";  
            }
        }
        
        //Getting restaurant info and storing in $restinfo
        
        $getrestaurant_query = "SELECT * FROM restaurant WHERE restaurant_id = '$restaurant_id'";
        $getrestaurant_query_result = $connection->query($getrestaurant_query);
        //echo "Executed restruatn query       ";
        if($getrestaurant_query_result){
            if($getrestaurant_query_result->num_rows == 0){
                return "False";
            }else{
                $restinfo = [];
                while($row = $getrestaurant_query_result->fetch_assoc()){
                    $name = $row['restaurant_name'];
                    $thumbnail = $row['thumbnail_url'];
                    $menu_url = $row['menu_url'];
                    //echo "1   ";
                }
                $restinfo = array('name'=>$name, 'id'=>$restaurant_id, 'thumbnail'=>$thumbnail, 'menu'=>$menu_url, 'suggestions'=>$suggestioninfo, 'reviews'=>$reviewsinfo, 'favorite'=>$favoriteinfo);
                //echo "Final list prepared      ";
            }
        }
        
        
        //Combine all infos together and return $allinfo 
        //print_r("Result: ".$restinfo);
        //echo "leaving function";
        //echo count($restinfo);
        print_r($restinfo);
     return $restinfo;
            
    }

    //This function fetched restaurnt, suggestions, reviews of user
    function userProfile($username){
        
        $connection = dbConnection();
        //Getting suggestions in restaurant and storing in $suggestioninfo
        
        $getsuggestion_query = "select * from (select * from suggestion natural join restaurant) as r1 where username = '$username'";
        $getsuggestion_query_result = $connection->query($getsuggestion_query);
        
        if($getsuggestion_query_result){
            if($getsuggestion_query_result->num_rows == 0){
                $suggestionresult = 'false';
                $suggestioninfo[] = array('restaurant_name'=>$suggestionresult, 'suggestion'=>$suggestionresult, 'dish_name'=>$suggestionresult);
            }else{
                while($row = $getsuggestion_query_result->fetch_assoc()){
                    $suggestion = $row['suggestion'];
                    $dish_name = $row['dish_name'];
                    $restaurant_name = $row['restaurant_name'];
                    $suggestioninfo[] = array('restaurant_name'=>$restaurant_name, 'suggestion'=>$suggestion, 'dish_name'=>$dish_name);
                }
            }
        }
        
        //Getting reviews in restaurant and storing in $reviewsinfo
        
        $getreview_query = "select * from (select * from review natural join restaurant) as r1 where username = '$username'";
        $getreview_query_result = $connection->query($getreview_query);
        
        if($getreview_query_result){
            if($getreview_query_result->num_rows == 0){
                $reviewsresult = "false";
                $reviewsinfo[] = array('restaurant_name'=>$reviewsresult, 'review_rating'=>$reviewsresult, 'review_text'=>$reviewsresult);
            }else{
                while($row = $getreview_query_result->fetch_assoc()){
                    $review_rating = $row['review_rating'];
                    $review_text = $row['review_text'];
                    $restaurant_name = $row['restaurant_name'];
                    $reviewsinfo[] = array('restaurant_name'=>$restaurant_name, 'review_rating'=>$review_rating, 'review_text'=>$review_text);
                }   
            }
        }
        
        //Getting favorite list of user and storing in $favoritelist
        
        $getfavorite_query = "select * from (select * from favorite natural join restaurant) as r1 where username = '$username'";
        $getfavorite_query_result = $connection->query($getfavorite_query);
        
        if($getfavorite_query_result){
            if($getfavorite_query_result->num_rows == 0){
                $favoriteresult = "false";
                 $favoriteinfo[] = array('restaurant_name'=>$favoriteresult, 'restaurant_id'=>$favoriteresult);
            }else{
                while($row = $getfavorite_query_result->fetch_assoc()){
                    $restaurant_id = $row['restaurant_id'];
                    $restaurant_name = $row['restaurant_name'];
                    $favoriteinfo[] = array('restaurant_name'=>$restaurant_name, 'restaurant_id'=>$restaurant_id);
                }   
            }
        }
        
        $allinfo = [];
        
        $allinfo = array('suggestions'=>$suggestioninfo, 'reviews'=>$reviewsinfo, 'favorites'=>$favoriteinfo);
        
        return $allinfo;
        
        
        
    }

    //This function add favorite restaurant of user
    function addFavorite($username, $restaurant_id){
        
        $connection = dbConnection();
        
        $addfavorite_query = "INSERT INTO favorite VALUES ('$username', '$restaurant_id')";
        $$addfavorite_query_result = $connection->query($addfavorite_query);
        return "true";
    }

    //This function removes favorite of a user
    function  removeFavorite($usename, $password){
        
        $connection = dbConnection();
        
        $removefavorite_query = "DELETE FROM favorite WHERE username = '$username' AND restaurant_id = '$restaurant_id'";
        
        
        
    }
    



?>