<?php
require '../../class/Connexion.php';
require '../../class/Manager.php';
require '../../class/HTTPResponse.php';
require '../class/AJAXRequest.php';
require '../class/API.php';

$query = new AjaxRequest();
$reponse = new HTTPResponse();
$api = new APIConnexion();
$object  = array('post_mail' => $_POST["mail"], 
         'redirect_url_bad' => "../vue/auth-signin.php",
         'redirect_url_user' => "../../dashboardUtilisateur/Utilisateur/vue/index.php",
         'redirect_url_superadmin' => "../../dashboardUtilisateur/Super-Administrateur/vue/index.php",
         'redirect_url_connexion'  =>  "../vue/auth-signup.html");
$api->authConnexion($object); 

?>
