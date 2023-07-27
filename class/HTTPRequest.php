<?php
class HTTPRequest
{
     private $_ob;
     public function cookieData($key){return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;}
     public function cookieExists($key){return isset($_COOKIE[$key]);}
     public function getData($key){return isset($_GET[$key]) ? $_GET[$key] : null;}
     public function getExists($key){return isset($_GET[$key]);}
     public function method(){ return $_SERVER['REQUEST_METHOD'];}
     public function postData($key){return isset($_POST[$key]) ? $_POST[$key] : null;}
     public function postExists($key){return isset($_POST[$key]);}
     public function requestURI(){return $_SERVER['REQUEST_URI'];}
     public function completeSendData(){
         $queryMethod = $this->method();
         echo $queryMethod;
         if($queryMethod == 'GET')
         {
            $this->_ob= array('pseudo' => $this->getData('userName'),
            'email' => $this->getData('mail'),
            'tel' => $this->getData('userTel'),
            'password' => sha1($this->getData('password')));
         }
         else 
         {
            $this->_ob= array('pseudo' => $this->postData('userName'),
            'email' => $this->postData('mail'),
            'tel' => $this->postData('userTel'),
            'password' => sha1($this->postData('password'))
         );
         }
         return $this->_ob;
     }
}
?>