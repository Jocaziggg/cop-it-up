<?php

$servername = "cop-it-up.com";
$username = "shopping";
$password = "2vVPZYbdaYp5";
$dbname = "shopping_cop-it-up";

$link = mysqli_connect($servername, $username, $password, $dbname);

if($link === false){
    die("error: Not connected");
}

?>