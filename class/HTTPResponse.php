<?php
class HTTPResponse
{
    
     public function mailing(){
         
     }
     public function redirect($location)
     {
         header('Location: '.$location);
         exit;
     }
     public function redirect404(){}

     public function setCookie($name, $value = '', $expire = 0, $path =null, $domain = null, $secure = false, $httpOnly = true)
     {
         setcookie($name, $value, $expire, $path, $domain, $secure,$httpOnly);
     }
     public function setSession($pseudo,$mail)
     {
         session_start();
         $_SESSION["pseudo"] = $pseudo;
         $_SESSION["mail"] = $mail;
     }
}
?>