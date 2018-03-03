<?php 

    //Requried files

    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('dbFunctions.php');
    require_once('dbConnection.php');

    //Functions for different cases

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
        
        /*
        //SQL Query for inserting data into user table
        $newuser_query = "INSERT INTO user (email, h_password, salt, firstname, lastname, dob_month, dob_date, dob_year, sex, street_number, street_name, city, state, zip, country) VALUES ('$email', '$h_password', '$salt', '$firstname', '$lastname', '$dob_month', '$dob_date', '$dob_year', '$sex', '$street_number', '$street_name', '$city', '$state', '$zip', '$country')";
        */
        
//        echo $username;
//        echo $email;
//        echo $password;
//        echo $firstname;
//        echo $lastname;
//        echo $dob_month;
//        echo $dob_date;
//        echo $dob_year;
//        echo $sex;
//        echo $street_number;
//        echo $street_name;
//        echo $city;
//        echo $state;
//        echo $zip;
//        echo $country;
        
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
        
        /*
        //SQL query to check if the new user was successfully entered
        $check_query = "SELECT * FROM user WHERE email = '$email'";
        $result1 = $connection->query($check_query);
        
        if($result1){
            if($result1->num_rows == 0){
                return '<br>New user was not entered correctly';
            }else{
                while ($row = $result1->fetch_assoc()){
                    if ($row['email'] == $email){
                        return '<br>New user inserted';
                    }
                }
            }
        
        }
        */   
        echo '<br><br>register function<br><br>';
        return "True";
    }

    // This function returns cities by state
    function cityByState($state){
        
        $connection = dbConnection();
        
        $query = "SELECT city FROM usadata WHERE state = '$state'";
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
    function 




?>