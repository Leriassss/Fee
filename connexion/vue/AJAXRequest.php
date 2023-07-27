<?php
require '../class/Manager.php';
require 'class/AJAXRequest.php';
$query = new AjaxRequest();
echo $query->getFieldFunction();

?>