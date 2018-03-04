<?php
    // find restaurant from cuisine_id, lat, lon
    $cuisine_id = "25";
    $lat = "40.732013";
    $lon ="-73.996155";
    
    $page = "search?";

    $url = 'https://developers.zomato.com/api/v2.1/' . $page . 'lat=' . $lat . 'lon=' . $lon . 'cuisine_id=' .$cuisine_id;

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
		$id = @$restaurants[restaurant]['id'];
        $name = @$restaurants[restaurant]['name'];
        $url = @$restaurants[restaurant]['url'];
        $thumb =@$restaurants[restaurant]['thumb'];
        $address = @$restaurants['restaurant'][location]['address'];
        $city_id = @$restaurants['restaurant']['location']['city_id'];
        $rating = @$restaurants['restaurant']['user_rating']['aggregate_rating'];
        $rating_text = @$restaurants['restaurant']['user_rating']['rating_text'];
      
        $rest[] = array("restaurant_id"=>$id , "name"=>$name , "menu_url"=>$url , "thumb"=>$thumb , "address"=>$address ,"city_id"=>$city_id , "rating"=>$rating , "rating_text"=>$rating_text);
		
	}
	
	$rest_name = json_encode($rest);
    echo $rest_name;

    

		
    
?>
      
