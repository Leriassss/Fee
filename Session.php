<?php
     session_start();
     if(isset($_SESSION["pseudo"]) && isset($_SESSION["mail"])){}
     else{header("Location : http://localhost:4700/Projet/index.php");exit;}
?>
