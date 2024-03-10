<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'connect.php';

$userip = "";
$chSolution = "";
$PumpType = "";
$PumpProducer = "";
$AmounthSpent = "";
$currency = "";
$id = "";
$calc = "";

/*function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
 
$userip = get_client_ip();

//echo "Your IP address is: " . get_client_ip();*/


if(isset($_REQUEST["ipr"])){

    $userip = $_POST["ipr"];
    $chSolution = $_POST["chSolution"];
    $PumpType = $_POST["PumpType"];
    $PumpProducer = $_POST["PumpProducer"];
    $AmounthSpent = $_POST["AmounthSpent"];
    $currency = $_POST["currency"];
}

    try {
        $selectid = "SELECT ID FROM Users WHERE IP_Address = '$userip'";
        $resid = mysqli_query($link, $selectid);
        if(!empty($selectid)){
            $rowid = $resid -> fetch_assoc();
            $id=$rowid['ID'];
            mysqli_query($link, "UPDATE Users SET Current_Heating_System= '$chSolution ', Interested_in_HPType= '$PumpType', 
            Interested_in_HPBrand= '$PumpProducer', Expences= '$AmounthSpent', Currency_selected= '$currency' WHERE (User_id ='$id' AND Calc_id = '$Cid' AND ID= '$rmid')");
        }

        $selectCalc= "SELECT top 1 ID FROM Calculations WHERE User_id = '$id' ORDER BY ID DESC";
        $resCalc = mysqli_query($link, $selectCalc);
        if(!empty($selectCalc)){
            $rowCalc = $resCalc -> fetch_assoc();
            $calc=$rowCalc['ID'];
        }

        echo "ID:". $id;
        echo "CALC:". $calc;




    } catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
      }



?>