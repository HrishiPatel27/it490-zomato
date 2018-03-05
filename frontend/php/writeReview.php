<html>
    <head>

    </head>
    <body>
    
        <form action = "sendReview.php" method="GET">
            <input type="text" name = "restId" value = "<?php echo $_GET["restId"]; ?>">
            <br><br>
            
            Review:<br>
            <textarea name = "review">
            </textarea>
            
            Rating:<br>
            <input type = "text" name = "rating">
            
            <br>
            <button type = "submit">Submit</button>
        
        </form>
    
    </body>
</html>