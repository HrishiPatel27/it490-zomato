<?php
  
  	require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
	require_once('testAPI.php');


	//  This function will log errors
    function logAndSendErrors(){
        
        $file = fopen("../logging/log.txt","r");
        $errorArray = [];
        while(! feof($file)){
            array_push($errorArray, fgets($file));
        }
        for($i = 0; $i < count($errorArray); $i++){
            echo $errorArray[$i];
            echo "<br>";
        }

        fclose($file);


        $request = array();
        $request['type'] = "frontend";  
        $request['error_string'] = $errorArray;
        $returnedValue = createClientForRmq($request);

        $fp = fopen("../logging/logHistory.txt", "a");
        for($i = 0; $i < count($errorArray); $i++){
            fwrite($fp, $errorArray[$i]);
        }

        file_put_contents("../logging/log.txt", "");


    }


 	function restaurantInfo($city_name, $state_name, $cuisine_id){
    
		//Request to zomato api for cityid for city, state
		$city_id = fetchCityId($city_name, $state_name);
		
		//If no city_id found from zomato api request
		if($city_id == "False"){
			return "False";
		}
		
		//Request to zomato api for the city, state using city_id
		$rest_result = fetchRestaurantInfo($city_name, $city_id, $cuisine_id);

		//Array containing all information of restaurant for city, state 
		$all_info = array('city_name'=>$city_name, 'state_name'=>$state_name, 'city_id'=>$city_id, 'restaurants'=>$rest_result);
		
		echo "Data sent to db";
		return $all_info;
  }
  
 	function fetchCityId($cityname, $state){
    
		// find city id	   
		$page = "cities";
		$city = str_replace(' ', '%20', $cityname);
		$city_state = $cityname . ", ". $state;
		$q = $city;

		//url for request to zomato api for city_id
		$url = 'https://developers.zomato.com/api/v2.1/' . $page . '?q=' . $q;
		  
		$header = array(
			'Accept: application/json',
			'user-key: 9e44e998e757ae4c73b2fbd58580a1ad'
		);
		
		//curl initialization
		$resource = curl_init();
		curl_setopt($resource, CURLOPT_URL, $url);
		curl_setopt($resource, CURLOPT_HTTPHEADER, $header);
		curl_setopt($resource, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($resource, CURLOPT_HTTPGET, 1);

		$result = curl_exec($resource);

		//echo $result;

		curl_close($resource);	
		$id_name = [];
		$zomdata = json_decode($result, true);
		$zomcities = $zomdata ['location_suggestions'];
		foreach($zomcities as $city_info) {
			$id = @$city_info['id'];
			$city_name = @$city_info['name'];
			if ($city_name == $city_state){
				return $id;
			}
		}
		//If no cities found
		return "False";

	  }
    
	function fetchRestaurantInfo($city_name, $city_id, $cuisine_id){
    
		//Url for request to zomato api for restaurant with city_id and cuisine_id
		$entity_type ="city";
		$page = "search";
		$url = 'https://developers.zomato.com/api/v2.1/' . $page . '?entity_id=' . $city_id .'&entity_type=' . $entity_type .'&cuisines=' .$cuisine_id;

		$header = array(
			'Accept: application/json',
			'user-key: 9e44e998e757ae4c73b2fbd58580a1ad'
		);
		
		//curl intialization
		$resource = curl_init();
		curl_setopt($resource, CURLOPT_URL, $url);

		curl_setopt($resource, CURLOPT_HTTPHEADER, $header);
		curl_setopt($resource, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($resource, CURLOPT_HTTPGET, 1);

		$result = curl_exec($resource);

		//echo $result;

		curl_close($resource);	

		$zomdata = json_decode($result, true);
		
		//Loads all restaurants information
		$zomrest = $zomdata['restaurants'];

		foreach ($zomrest as $restaurants) {
			$rest_city = @$restaurants['restaurant']['location']['city'];
			//echo $rest_city;
			//checks if restaurant is of requested city
			if($rest_city == $city_name){
				$id = @$restaurants['restaurant']['id'];
				$name = @$restaurants['restaurant']['name'];
				$url = @$restaurants['restaurant']['url'];
				$thumb =@$restaurants['restaurant']['thumb'];
				$address = @$restaurants['restaurant']['location']['address'];
				$city_id = @$restaurants['restaurant']['location']['city_id'];
				$rating = @$restaurants['restaurant']['user_rating']['aggregate_rating'];
				$rating_text = @$restaurants['restaurant']['user_rating']['rating_text'];

				$rest[] = array("restaurant_id"=>$id , "name"=>$name , "menu_url"=>$url , "thumb"=>$thumb , "address"=>$address ,"city_id"=>$city_id , "rating"=>$rating , "rating_text"=>$rating_text);
			}
		}
		//echo $rest_name;
		return $rest;
  }

    

?>