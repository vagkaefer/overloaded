<?php

//Essa é uma página de exemplo
//This is a sample  page

include 'overloaded.class.php';
$serverover = new overloaded();
$serverover->check(30);

?>

<h1>The server is OK</h1>