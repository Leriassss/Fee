<?php

class APIConnexion
{
     private $_er;
     private $_query;
     private $_response;
     public function __construct(){
          $this->setQuery(); $this->setResponse();$this->setEr();
     }
     public function getEr(){return $this-> _er;}
     public function getQuery(){return $this-> _query;}
     public function getResponse(){ return $this->_response; }
     public function setEr(){ return $this->_er =  new Connexion();}
     public function setQuery(){ return $this->_query =  new AjaxRequest();}
     public function setResponse(){return $this->_response=  new HTTPResponse();}
     public function getData($key){return isset($_GET[$key]) ? $_GET[$key] : null;}
     public function getExists($key){return isset($_GET[$key]);}
     public function method(){ return $_SERVER['REQUEST_METHOD'];}
     public function postData($key){return isset($_POST[$key]) ? $_POST[$key] : null;}
     public function postExists($key){return isset($_POST[$key]);}
     function authConnexion(array $object){         
         if(isset($object["post_mail"])){
             $post_mail = htmlspecialchars($object["post_mail"]);
             if($this->getQuery()->mailBdd($post_mail) == "false" ){
                session_start();
                $_SESSION["connexion"] = "false";
                $this->getResponse()->redirect($object["redirect_url_bad"]);
            }
           else{
                $res = $this->getQuery()->getManager()->getLine($post_mail);
                $pass = $res["PassUtil"];
                $pseudo = $res["PseudoUtil"];
                $mail = $res["MailUtil"];
                $solde = $res["Solde"];
                if(sha1($_POST["password"]) == $pass){
                    if($_POST["stayConnected"] == "on")
                    {
                        $this->getResponse()->setCookie($pseudo,$pass, time() + 24*3600);            
                    } 
                        unset($res["PassUtil"]);
                        unset($res["DateInscription"]);
                        unset($res["IdUtil"]);
                        session_start();
                        $_SESSION["pseudo"] = $pseudo;
                        $_SESSION["mail"] = $mail;
                        $_SESSION["Solde"] = $solde;
                    if($res["Statut"] == "Utilisateur")
                    {
                        $i  = 0;
                        if(isset($pseudo)){
                           $params = htmlspecialchars($pseudo);
                           $q = $this->getEr()->responseQuery('IdInv,SomInv,PtgInv,GainInv,DateIncrement,DateDebutInv,TypeInv,Duree',"INVESTISSEMENT","NomInv", $params);
                           $clients = [];
                           while ($i< count($q))
                           {
                               $cli = implode(",",$q[$i]);
                               array_push($clients,$cli) ;
                               $i += 1;
                           }
                           $clients =  json_encode($clients);
                        }
              
                        $_SESSION["utilisateur"] = json_encode($res);
                        $_SESSION["investissement"] = $clients;
                        $this->getResponse()->redirect($object["redirect_url_user"]);
                    }
                    else if($res["Statut"] == "SuperAdmin") {
                       $this->getResponse()->redirect($object["redirect_url_superadmin"]);
                    }
           
                    
                }
                else{
                     session_start();
                     $_SESSION["connexion"] = "false";
                     $this->getResponse()->redirect($object["redirect_url_bad"]);
                }
           }
        }

     }
}


?>