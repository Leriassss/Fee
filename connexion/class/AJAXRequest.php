<?php
class AjaxRequest{
      private $_db;

      public function __construct(){
         $this->setDb();
    }
     public function db(){return $this->_db;}
     public function setDb(){
        try
        {
             $db = new PDO('mysql:host=localhost;dbname=PROJET', 'root', '',
             array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
             return $this->_db = $db;
        }
        catch (Exception $e)
        {
             die('Erreur : ' . $e->getMessage());
        }
     }
     public function getManager(){
		 $manager = new Manager($this->db());
		  return $manager;}
     public function getBddArray(){
		 return $this->getManager()->getList();}
     public  function userNameBdd($value){
         $pseudoBdd = [];
         $i = 0;
         while( $i < count($this->getBddArray())){
               array_push($pseudoBdd, $this->getBddArray()[$i]["PseudoUtil"]);
               $i += 1;}
             if(in_array(htmlspecialchars($value) , $pseudoBdd)){return "true";}
             else{return "false";}
       }

     public  function mailBdd($value){
         $mailBdd = [];
         $i = 0;
         while( $i < count($this->getBddArray())){
             array_push($mailBdd, $this->getBddArray()[$i]["MailUtil"]);
             $i += 1;}
         if(in_array(htmlspecialchars($value), $mailBdd)){return "true";}
         else{return "false";}
     }
     public  function userTelBdd($value){
        $telBdd = [];
        $i = 0;
        while( $i < count($this->getBddArray())){array_push($telBdd , $this->getBddArray()[$i]["TelUtil"]);$i += 1;}
		 $value = (int) $value;
         if(in_array($value, $telBdd)){return "true";}
         else{return "false";}     
     }
     public  function passwordBdd($value){
      $passwordBdd= [];
      $i = 0;
      while( $i < count($this->getBddArray())){array_push($passwordBdd , $this->getBddArray()[$i]["PassUtil"]);$i += 1;}
       if(in_array(htmlspecialchars($value), $passwordBdd)){return "true";}
       else{return "false";}     
   }

   public function getFieldFunction(){
       foreach ($_POST as $key => $value){
            $method = $key.'Bdd';
            if(method_exists($this, $method)){
                 return $this->$method($value);}
         }
     }
}



?>