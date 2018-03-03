<?php

      function RandomString($length = 29) {
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
        
        $salt = RandomString();
        
        echo $salt.'   ';
        echo sha1($salt);

?>e68SNNEeeuaP6quGgq76eDJgEMXhO24TW   d8de3e787c8b5d007f484aebe6b62e6c4e8dbe04