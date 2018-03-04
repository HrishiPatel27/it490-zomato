<?php
  
  require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');

  function restaurantInfo($city_name, $state_name, $cuisine_id){
    
    $city_id = fetchCityId($city_name, $state_name);
    
    $rest_result = fetchRestaurantInfo($city_id, $cuisine_id);
    
    $all_info = array('city_name'=>$city_name, 'state_name'=>$state_name, 'city_id'=>$city_id, 'restaurants'=>$rest_result);
    echo $all_info['city_name'];
    return $all_info;
  }
  
  function fetchCityId($city, $state){
    
    // find city id	
    $q = $city;
    
    $page = "cities";
    $city_state = $city . ", ". $state;
    $url = 'https://developers.zomato.com/api/v2.1/' . $page . '?q=' . $q;

    $header = array(
        'Accept: application/json',
        'user-key: 9e44e998e757ae4c73b2fbd58580a1ad'
    );

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
    
  }
    
  function fetchRestaurantInfo($city_id, $cuisine_id){
    
    $entity_type ="city";
    
    $page = "search";

    $url = 'https://developers.zomato.com/api/v2.1/' . $page . '?entity_id=' . $city_id .'&entity_type=' . $entity_type .'&cuisines=' .$cuisine_id;

    $header = array(
        'Accept: application/json',
        'user-key: 9e44e998e757ae4c73b2fbd58580a1ad'
    );

    $resource = curl_init();
    curl_setopt($resource, CURLOPT_URL, $url);

    curl_setopt($resource, CURLOPT_HTTPHEADER, $header);
    curl_setopt($resource, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($resource, CURLOPT_HTTPGET, 1);

    $result = curl_exec($resource);

    //echo $result;

    curl_close($resource);	

    $zomdata = json_decode($result, true);
    
    $zomrest = $zomdata['restaurants'];
   
	foreach ($zomrest as $restaurants) {
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
  
//	$rest_name = json_encode($rest);
//   echo $rest_name;
    return $rest;

  }

?>