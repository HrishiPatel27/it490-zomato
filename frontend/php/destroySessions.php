<?php

    session_start();
    
    //$_SESSION["username"] = "";
    //$_SESSION["status"] = "false"
    
    if(isset($_GET["logout"])){
        session_destroy();
        header("Location: ../html/loginRegister.html");
    }
    
?>