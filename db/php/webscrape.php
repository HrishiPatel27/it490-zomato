<?php 
    
    require_once('simple_html_dom.php');
    
    $list = getMenu("https://www.zomato.com/parsippany-nj/chand-palace-parsippany/menu?utm_source=api_basic_user&utm_medium=api&utm_campaign=v2.1&openSwipeBox=menu&showMinimal=1#tabtop");

    echo var_dump($list);

    function curl_download($url){

            if (!function_exists('curl_init')){
                die('cURL is not installed. Install and try again.');
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

            return $output;

    }

    function getMenu($url){
           
        //Executes wget system function for menu_url and stores the webpage on local directory
        shell_exec("wget -U Mozilla/5.0 --output-document menu.html $url");

        //Returns the scrapped string of menu
        $result = curl_download('file:///home/hrishi/Downloads/menu.html');

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

            return $names;
        }else{
            return "False";
        }
    }
    

?>