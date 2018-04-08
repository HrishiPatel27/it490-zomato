<?php 
    
    require_once('simple_html_dom.php');

	//NOTE: When the menu link is hard coded and passed to function it scrappes the data and sends to Database, but when the menu link is sent from database it shows error
    //NOTE: To see that the below code works, uncomment the following lines and you'll see the result
	//NOTE: Also change the path for the url sent in curl_download function as per your system folder

//    $list = getMenu("https://www.zomato.com/parsippany-nj/chand-palace-parsippany/menu?utm_source=api_basic_user&utm_medium=api&utm_campaign=v2.1&openSwipeBox=menu&showMinimal=1#tabtop");
//
//    echo var_dump($list);

    function curl_download($url){

        if (!function_exists('curl_init')){
            echo 'cURL is not installed. Install and try again.';
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $output = curl_exec($ch);
        curl_close($ch);
            
        //Scrappes data between two divs
        $start = strpos($output, '<div id="menu-container" class="relative">');
        $end = strpos($output, '<div class="right-column-container col-l-4" style="min-height: 8274px;">', $start);
        $length = $end-$start;
        $output = substr($output, $start, $length);
		echo "SIZE OF: <br><br>";
		//echo var_dump($output);
        return $output;

    }

    function getMenu($url){
           
        //Executes wget system function for menu_url and stores the webpage on local directory
        shell_exec("wget -U Mozilla/5.0 --output-document menu.html $url");

        //Returns the scrapped string of menu
		//NOTE: Change the file path if running on your system
        $result = curl_download('file:///home/ajay/Downloads/DMZ/it490-zomato/dmz/php/menu.html');

        //echo gettype($result);
        $class_name = "tmi-name";
        
        if(strpos($result, $class_name)){
            //Making html dom object to parse data from the string
            $html = str_get_html($result);
            //Parsing through the class to get dishes information
            $rows = $html->find('[class="tmi-name ft16 mt10 mb5"]');

            if(count($rows)>1){
                for($i=0; $i<count($rows); $i++){
                    //Making an array to store dish name, price and description
                    $items[] = array('item'=>$rows[$i]->plaintext);
                }
            }elseif(count($rows == 0)){
                    return "False";
            }

            //Making an array for only dishname
            for($i=0; $i<count($items); $i++){
                $name = $items[$i]['item'];
                $substring = substr($name, 0, strpos($name, '$'));
                if($substring != ''){
                    $names[] = array('item'=>$substring);
                }
            }

            //echo var_dump($items);
			unlink('menu.html');
            return $names;
        }else{
            return "False";
        }
    }
    

?>