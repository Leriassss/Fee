<?php
require '../../class/User.php';
require '../../class/Manager.php';
require '../../class/HTTPRequest.php';
require '../../class/HTTPResponse.php';

$query = new HTTPRequest();
$newUser = new Users($query->completeSendData());
try{$db = new PDO('mysql:host=localhost;dbname=PROJET', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));}
catch (Exception $e){die('Erreur : ' . $e->getMessage());}
$manager = new Manager($db);
$manager->add($newUser);
$reponse = new HTTPResponse();
$reponse->redirect("../../redirecting.php");
?>

