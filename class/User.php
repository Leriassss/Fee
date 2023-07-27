<?php
class Users
{
     private $_pseudo;
     private $_email;
     private $_tel;
     private $_password;
	 
     public function __construct(array $donnees)
     {
         $this->hydrate($donnees);
     }

public function pseudo() { return $this->_pseudo; }
public function email() { return $this->_email; }
public function tel() { return $this->_tel; }
public function password(){ return $this ->_password;}



public function setPseudo($pseudo)
{
     $pseudo= htmlspecialchars($pseudo);
     $this->_pseudo = $pseudo;
} 

public function setEmail($email)
{
     $email = htmlspecialchars($email);
     $this->_email = $email;
}

public function setTel($tel)
{
     $tel = (int) $tel; 
     $this->_tel = $tel;
}
public function setPassword($password)
{
     $password = htmlspecialchars($password);
     $this->_password = $password;
}

public function hydrate(array $donnees)
{
     foreach ($donnees as $key => $value){
         $method = 'set'.ucfirst($key);
         if (method_exists($this, $method)){
             $this->$method($value);}
     }
}

}
?>