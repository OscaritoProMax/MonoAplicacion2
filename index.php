<?php

//header("location: views/dishes.php");
$c = $_GET['c'] ?? 'Dishescontroller';
$m = $_GET['m'] ?? 'index';

require_once("controllers/" . $c . ".php");

$controller = new $c();
$controller->$m();
?>
