<?php
require 'connect.php';


/*$userip ="";
$userisp = "";
$usercountry = "";
$usercity= "";*/


if(isset($_POST['ip'])){
    $userip = $_POST['ip'];
    $userisp = $_POST['isp'];
    $usercountry = $_POST['country'];
    $usercity = $_POST['city'];

    /*$select = "SELECT ID FROM Users WHERE IP_Address='$userip'";
    $squery = mysqli_query($link, $select);

    $count = mysqli_num_rows($squery);

    /*mysqli_query($link, "INSERT INTO Users (IP_Address, UserISP, UserCountry, UserCity) VALUES ('$userip', '$userisp', '$usercountry', '$usercity')");*/


/*if(isset($_POST['ip'])){
        $currentuserid = mysqli_query($link, "SELECT ID FROM Users WHERE IP_Address = '$userip'");
        mysqli_query($link, "INSERT INTO Calculations (User_id) VALUES ('$currentuserid')");
    } else {
        mysqli_query($link, "INSERT INTO Users (IP_Address, UserISP, UserCountry, UserCity) VALUES ('$userip', '$userisp', '$usercountry', '$usercity')");
        $currentuserid = mysqli_query($link, "SELECT ID FROM Users WHERE IP_Addresss = '$userip'");
        mysqli_query($link, "INSERT INTO Calculations (User_id) VALUES ('$currentuserid')");
    }*/
}

 
?>