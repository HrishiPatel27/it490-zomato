<?php    

    //  Requireing required files
    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('../php/rabbitMQClient.php');

    

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



    


/*
[12-Mar-2018 21:15:46 America/New_York] PHP Deprecated:  Function AMQPQueue::declare() is deprecated in /home/jeet-patel/Documents/it490-zomato/frontend/rabbitmqphp_example/rabbitMQLib.inc on line 215
[12-Mar-2018 21:16:24 America/New_York] PHP Deprecated:  Function AMQPQueue::declare() is deprecated in /home/jeet-patel/Documents/it490-zomato/frontend/rabbitmqphp_example/rabbitMQLib.inc on line 215
[12-Mar-2018 21:16:58 America/New_York] PHP Deprecated:  Function AMQPQueue::declare() is deprecated in /home/jeet-patel/Documents/it490-zomato/frontend/rabbitmqphp_example/rabbitMQLib.inc on line 215
[12-Mar-2018 21:17:22 America/New_York] PHP Deprecated:  Function AMQPQueue::declare() is deprecated in /home/jeet-patel/Documents/it490-zomato/frontend/rabbitmqphp_example/rabbitMQLib.inc on line 215
[12-Mar-2018 21:18:30 America/New_York] PHP Deprecated:  Function AMQPQueue::declare() is deprecated in /home/jeet-patel/Documents/it490-zomato/frontend/rabbitmqphp_example/rabbitMQLib.inc on line 215
[12-Mar-2018 21:56:34 America/New_York] PHP Warning:  require_once(rabbitMQClient.php): failed to open stream: No such file or directory in /home/jeet-patel/Documents/it490-zomato/frontend/sampleDate/testErrorSender.php on line 7
[12-Mar-2018 21:56:34 America/New_York] PHP Fatal error:  require_once(): Failed opening required 'rabbitMQClient.php' (include_path='.:/usr/share/php:/usr/local/lib/system_libs') in /home/jeet-patel/Documents/it490-zomato/frontend/sampleDate/testErrorSender.php on line 7
[12-Mar-2018 21:57:00 America/New_York] PHP Warning:  require_once(rabbitMQClient.php): failed to open stream: No such file or directory in /home/jeet-patel/Documents/it490-zomato/frontend/sampleDate/testErrorSender.php on line 7
[12-Mar-2018 21:57:00 America/New_York] PHP Fatal error:  require_once(): Failed opening required 'rabbitMQClient.php' (include_path='.:/usr/share/php:/usr/local/lib/system_libs') in /home/jeet-patel/Documents/it490-zomato/frontend/sampleDate/testErrorSender.php on line 7
[12-Mar-2018 21:57:24 America/New_York] PHP Warning:  require_once(rabbitMQClient.php): failed to open stream: No such file or directory in /home/jeet-patel/Documents/it490-zomato/frontend/sampleDate/testErrorSender.php on line 7
[12-Mar-2018 21:57:25 America/New_York] PHP Fatal error:  require_once(): Failed opening required 'rabbitMQClient.php' (include_path='.:/usr/share/php:/usr/local/lib/system_libs') in /home/jeet-patel/Documents/it490-zomato/frontend/sampleDate/testErrorSender.php on line 7
[12-Mar-2018 21:58:11 America/New_York] PHP Deprecated:  Function AMQPQueue::declare() is deprecated in /home/jeet-patel/Documents/it490-zomato/frontend/rabbitmqphp_example/rabbitMQLib.inc on line 215
[12-Mar-2018 22:00:05 America/New_York] PHP Warning:  require_once(rabbitMQClient.php): failed to open stream: No such file or directory in /home/jeet-patel/Documents/it490-zomato/frontend/sampleDate/testErrorSender.php on line 7
[12-Mar-2018 22:00:05 America/New_York] PHP Fatal error:  require_once(): Failed opening required 'rabbitMQClient.php' (include_path='.:/usr/share/php:/usr/local/lib/system_libs') in /home/jeet-patel/Documents/it490-zomato/frontend/sampleDate/testErrorSender.php on line 7
[12-Mar-2018 22:04:19 America/New_York] PHP Deprecated:  Function AMQPQueue::declare() is deprecated in /home/jeet-patel/Documents/it490-zomato/frontend/rabbitmqphp_example/rabbitMQLib.inc on line 215
[12-Mar-2018 22:23:46 America/New_York] PHP Deprecated:  Function AMQPQueue::declare() is deprecated in /home/jeet-patel/Documents/it490-zomato/frontend/rabbitmqphp_example/rabbitMQLib.inc on line 215
[12-Mar-2018 21:13:52 America/New_York] PHP Fatal error:  Uncaught Error: Call to undefined function equire_once() in /home/jeet-patel/Documents/it490-zomato/frontend/php/functions.php:14
Stack trace:
#0 /home/jeet-patel/Documents/it490-zomato/frontend/php/functionCases.php(13): include()
#1 {main}
*/
    




?>