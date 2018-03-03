<?php
    
    require_once('dbConnection.php');
      $connection = dbConnection();
        
        $query = "SELECT city FROM usadata WHERE state = 'NJ'";
        $result = $connection->query($query);
        
        if($result){
            if($result->num_rows == 0){
                return "False";
            }else{
                while ($row = $result->fetch_assoc()){
                    $city = $row['city'];
                    $citylist[] = $city;
                }
            }
        }
        print_r($citylist);

?>