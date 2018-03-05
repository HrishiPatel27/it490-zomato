<?php

        session_start();
    
    if (!$_SESSION["logged"]){
        header("Location: ../html/loginRegister.html");
    }

?>


<html>

    <head>

    </head>
    <body>
    
        <form action = "sendSuggestion.php" method="GET">
            <input type="text" name = "restId" value = "<?php echo $_GET["restId"]; ?>">
            <br><br>
            
            Suggestion Title:<br>
            <input type = "text" name = "dishName">
            
            <br>
            Suggestion Description:<br>
            <textarea name = "suggestionDesc">
            </textarea>
            
            <br>
            <button type = "submit">Submit</button>
        
        </form>
    
    </body>
</html>