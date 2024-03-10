<?php

define('DB_SERVER', 'cop-it-up.com');
define('DB_USERNAME', 'shopping');
define('DB_PASSWORD', '2vVPZYbdaYp5');
define('DB_NAME', 'shopping_cop-it-up');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link === false){
    die("error: Not connected");
}

?>