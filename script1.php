<?php
require 'connect.php';

$userip = "";
$userisp = "";
$country = "";
$city = "";
$currency = "";
$population = "";
$id = "";
$userip2 = "";
$conf = "";

if(isset($_REQUEST["ip"])){

    $userip = $_POST["ip"];
    $userisp = $_POST["isp"];
    $country = $_POST["country"];
    $city = $_POST["city"];
    $currency = $_POST["currency"];
    $population = $_POST["population"];
    $conf = $_POST["confirm"];
    
    /*mysqli_query($link, "INSERT INTO Users (IP_Address, UserISP, UserCountry, UserCity) VALUES ('$userip', '$userisp', '$country', '$city')");*/


    /*if($count > 0){

        $getuserid = mysqli_query($select);
        mysqli_query("INSERT INTO Calculations (User_id) VALUES ('$getuserid')");

    } else {
        $getuserid = mysqli_query($select);
        mysqli_query("INSERT INTO Calculations (User_id) VALUES('$getuserid')");
        mysqli_query("INSERT INTO Users (IP_Address, UserISP, UserCountry, UserCity) VALUES ('$userip', '$userisp', '$country', '$city')");

    } */
    try {
            $select = "SELECT ID FROM Users WHERE IP_Address = '$userip'";
            $res = mysqli_query($link, $select);
            $count = mysqli_num_rows($res);
             //echo $count;
            // $kur = 0;

             if($count > $kur){
                $row = $res -> fetch_assoc();
                $id=$row['ID'];
                mysqli_query($link, "INSERT INTO Calculations (User_id, Confirmation) VALUES ('$id', '$conf')");
                echo $id;
             } else {
                 mysqli_query($link, "INSERT INTO Users (IP_Address, UserISP, UserCountry, UserCity, Currency, CPop) VALUES ('$userip', '$userisp', '$country', '$city', '$currency', '$population')");
                 $id=$link ->insert_id;
                 mysqli_query($link, "INSERT INTO Calculations (User_id, Confirmation) VALUES('$id', '$conf')");
                 echo "New User";

             }
    }
    //catch exception
    catch(Exception $e) {
      echo 'Message: ' .$e->getMessage();
    }
}

$userip2 = $userip;
?>