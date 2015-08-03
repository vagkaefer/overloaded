<?php

//Essa é uma página de exemplo
//This is a sample  page

include 'overloaded.class.php';
$serverover = new overloaded();
$serverover->set_language('en'); 	//define the language
$serverover->set_autoreload('4'); 	//reloads the page every 4 seconds
$serverover->check(10);

?>

<h1>The server is OK</h1>