<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "connect.php";


//DATA EXTRACTION

$ip_address = "";

$Heating_solution = "";
$PumpSystem = "";
$PumpProducer = "";
$AmounthSpent = "";
$currency = "";

if(isset($_POST["btn_REPORT"])){

$Heating_solution = $_POST["current_solution"];
$PumpSystem = $_POST["PumpSystemType"];
$PumpProducer = $_POST["PumpProducer"];
$AmounthSpent = $_POST["AmounthSpent"];
$currency = $_POST["currency"];
}

function get_client_ip() {
  
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
      $ipaddress = 'No IP?';
  return $ipaddress;
}

$ip_address = get_client_ip();

$TH1 = 0.6;
$TH2 = 0.8;
$TH3 = 0.9;

$T11C40 = 550;
$T21C40 = 800;
$T22C40 = 1050;
$T33C40 = 1500;

$T11C50 = 800;
$T21C50 = 1140;
$T22C50 = 1500;
$T33C50 = 2200;

$R_TL_T = "";

$UserId_select = "SELECT ID FROM Users WHERE IP_Address = '$ip_address'";
  $User_query = mysqli_query($link, $UserId_select);
  $rowR1= $User_query -> fetch_assoc();
    $Userid = $rowR1['ID'];

$calc_select = "SELECT MAX(ID) FROM Calculations WHERE User_id = '$Userid'";
  $calc_query = mysqli_query($link, $calc_select);
  $rowR2= $calc_query -> fetch_assoc();
    $calc_id = $rowR2['MAX(ID)'];

$Rquery = "SELECT * FROM Rooms Where Calc_id = '$calc_id'";
$Rresult = mysqli_query($link, $Rquery);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="authoring-tool" content="Adobe_Animate_CC">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/floatstyle.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

    <title>COP Calculator</title>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  

    <!-- Bootstrap -->
	<link href="css/bootstrap-4.4.1.css" rel="stylesheet">
	<link href="css/Tool.css" rel="stylesheet">
   <link href="css/main_css.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<style type="text/css">
	</style>

  </head>
  <body>

  	<!-- body code goes here -->
    <div class="Header dropshadow" style = "position: sticky; top: 0rem; background-color: #fff; z-index:+1;">
    <div class="navmanu" id="navmanu" style = "position: absolute; right: 0; top: 0; background-color: #fff; z-index:+1; font-family: 'Ubuntu', sans-serif; font-size: medium; color: gray; ">NEW CALCULATION  |  BLOG </div>
    <div class="Header dropshadow" id="Header" style = "width: 100%; text-align: center;">
		<div class="Logo" id="Logo"><img src="Media/Logo1.png" width="215" height="69" alt=""/></div>
      </div>
    </div>
    <div class = "Container" id="Container">
      
      <div class="Content" id="Content">
        <div class="ToolContainer" id="ToolContainer">
          <div class="Rooms" id="Rooms">
			  
			  <!--<section class="product">
        <button class="pre-btn"><img src="images/arrow.png" alt=""></button>
        <button class="nxt-btn"><img src="images/arrow.png" alt=""></button>
        <div class="product-container">
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">50% off</span>
                    <img src="Slider/product-slider/images/card1.jpg" class="product-thumb" alt="">
                    <button class="card-btn">add to wishlist</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-description">a short line about the cloth..</p>
                    <span class="price">$20</span><span class="actual-price">$40</span>
                </div>
			</div>
		 </div>
			</section>-->
			</div>
          <div id="Tool">
		    <div class="caorusel">
            <div class="slider">



<section class="section3">
            <div class="sc_page1">
                     <div class="sc_page1_title">We need a little help, please support in one of the ways you can seee below:</div>

                     <div style="display: flex; align-items: center;">

                     <div style="width: 45%; padding-top: 25px; height: 650px; font-family: 'Ubuntu', sans-serif; align-items: center;">

                     <div class="containerNap" style="margin-top:3%;">
      <div class="header">
        <h3 class="text-muted" style="color:white;">GripFiles&#8482;</h3>
      </div>

      <div class="jumbotron">
        <div>{%header_text%}</div>
        <p class="lead" id="smallTitle">{%anchor_text%}</p>
        <p>{%offers%}</p>
      </div>



      <div class="footer">

      </div>

    </div><div style="margin-bottom:10%;"></div>

                    </div>
                     <div style="width: 10%; padding-top: 25px; height: 650px; font-family: 'Ubuntu', sans-serif; font-size: 30px; align-items: center;">OR</div>
                     <div style="width: 45%; padding-top: 25px; height: 650px; font-family: 'Ubuntu', sans-serif; align-items: center;">
                     <div style="width:100%;height:0;padding-bottom:100%;position:relative;">
                    </div>




                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    
  </body>
</html>