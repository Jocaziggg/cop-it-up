<?php
require "connect.php";
/*include 'script1.php';*/
//include 'script2.php';

$query = "SELECT * FROM Materials";

$result = mysqli_query($link, $query);

$options = "";

while($row = mysqli_fetch_array($result))
{
    $options = $options.'<option value="'.$row[2].'">'.$row[2].'</option>';
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

$UserId_select = "SELECT ID FROM Users WHERE IP_Address = '$ip_address'";
  $User_query = mysqli_query($link, $UserId_select);
  $rowR1= $User_query -> fetch_assoc();
    $Userid = $rowR1['ID'];

$calc_select = "SELECT MAX(ID) FROM Calculations WHERE User_id = '$Userid'";
  $calc_query = mysqli_query($link, $calc_select);
  $rowR2= $calc_query -> fetch_assoc();
    $calc_id = $rowR2['MAX(ID)'];
    $calcNew_id = $calc_id;

$Squery = "SELECT * FROM Rooms Where Calc_id = '$calcNew_id'";
$Sresult = mysqli_query($link, $Squery);


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="authoring-tool" content="Adobe_Animate_CC">

  <meta name="keywords" content="heat, loss, pump, calculator, efficiency, energy, isolation, thermodynamics, calculation, radiator, size">
  <meta name="description" content="Heat loss calculation is essential for the best efficiency od heat pump. 
  COP calculator can help you calculate the heat loss for your property, so you can choose the best heating device.
  Also, you can find out if you need to improve your isolation and raise energy efficiency of your object. 
  This calculator can also help you to size up your radiator system for the best use of energy and heat pump potential.">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <title>COP Calculator</title>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Bootstrap -->
	<link href="css/bootstrap-4.4.1.css" rel="stylesheet">
	<link href="css/Tool.css" rel="stylesheet">
   <link href="css/main_css.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<style type="text/css">
	</style>
  
<!-- Slidr CSS1 -->
<link rel="stylesheet" href="css/swiper-bundle.min.css" />

<!-- Slidr CSS2 -->
<link rel="stylesheet" href="css/style.css" />

<script async src="https://www.googletagmanager.com/gtag/js?id=AW-11348894680"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-11348894680');
</script>

  </head>
  <body>

  	<!-- body code goes here -->
    <div class = "Container" id="Container">
      <div class="Header dropshadow" id="Header">
      <div class="navmanu" id="navmanu" style = "position: absolute; right: 0; top: 0; background-color: #fff; z-index:+1;"></div>
		<div class="Logo" id="Logo"><a href="https://www.cop-it-up.com/" target="_blank"><img src="Media/Logo1.png" width="215" height="69" alt=""/></a></div>
      </div>
      <div class="Content" id="Content">

        <!-- Slider -->

<!--<div class="container swiper" id="swiperer" hidden>
<div class="slide-container">
    <?php /*
        $Rrow = "";
        $RadCaseChect = "";
        
          while($Srow = $Sresult -> fetch_assoc())
          {  $RadCaseChect = $Srow['Room_name'];
            if($RadCaseChect !== ''){

              $Vent = $Srow['Vent_Selection'];
              $MVent = $Srow['THL_MVent'];
              $NVent = $Srow['THL_NVent'];
              $THL = "";
              if($Vent == 'Nat'){$THL = $NVent;}else {$THL = $MVent;}
            }
        ?>
        <div class="card-wrapper swiper-wrapper">
          <div class="card swiper-slide">
            <div class="image-box">
            <div class="sc_page2_title"><?php echo $Srow['Room_name'];?></div>
            </div>
            <div class="profile-details">
              
              <div class="name-job">
                <h3 class="name">Heat loss</h3>
                <h4 class="job"><?php echo $THL?></h4>
              </div>
              <div class="name-job">
              <button name="del_room" value="" id="del_room" class="btn_DELETE">DELETE</button>
              </div>
            </div>
          </div>
        </div>
        <?php
          }*/
        ?>
      </div>
      <div class="swiper-button-next swiper-navBtn"></div>
      <div class="swiper-button-prev swiper-navBtn"></div>
    </div>-->

            
<!-- Slider END-->
        <div class="ToolContainer" id="ToolContainer">
          <div class="Rooms" id="Rooms">

</div>

      <div id="Tool">
		    <div class="caorusel">
            <div class="slider">
               <section class="section1">
                  <div class="sc_page1">
                     <div class="sc_page1_title">Welcome to COP-IT-UP tool</div>
                     <div class="sc_page1_desc11">This Tool will help you determine which Heat Pump size will best fit your needs, so that you can have the most optimal heating device. We advise you to read the text on the <a href="https://www.cop-it-up.com/" style="color: #1BAE70" target="_blank">blog</a> that tells more about this calculation and the use of the tool itself.
                     </div>
                     <div class="sc_page1_confirm">
                      <input type="checkbox" name="confirm" id="confirm">
                      </div>
                      <div class="sc_page1_confirm2"><label for="confirm">I agree with the <a href="https://www.cop-it-up.com/terms-and-conditions/#Tcalc" style="color: #1BAE70" target="_blank">terms and conditions</a> for using this tool</label>
                      </div>
                      </div>
                     <div class="sc_page1_submit">
                        <button class="btn_start" onclick="init1()" style="margin:0px;">START</button>
      <!--<script type="text/javascript">
      $.getJSON('https://ipapi.co/json/', function(ip){
        var data = {
          ip: ip.ip,
          isp: ip.org,<label for="vehicle1"> I have a bike</label>
          country: ip.country_name,
          city: ip.region
        };
        console.log(data);
        $.ajax({
          url: 'script.php',
          type: 'post',
          data: data
        })
      })
    </script>-->
                     </div>

                     <div class="sc_page1_submit">
                        <p style="color: red; font-weight: bold; font-family:'Ubuntu', sans-serif; vertical-alignment: middle;" id="errorMessage1" hidden></p>
                     </div>

                  </div>
               </section>
               
               
  <!-- Page 3_Add input fields--> 
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function () {
                let i = 1;
                $('#add').click(function () {
                    i++;
                    $('#dynamic_field').append('<div class="form-row" id="row' + i + '"> <div class="col"><select id="selection1" class="inputic1 mat" name="durchgefuhrte_arbeiten[]"><?php echo $options; ?></select></div> <div class="col"> <div class= "munit"><input type="text" id= "tic1" class="inputic1 tic" name="von[]" placeholder="Tickness"><h3>mm</h3></div></div> <div class="col-2"> <td><button type="button" name="add" class="btn btn-danger btn_remove" id="' + i + '"><i class="fa fa fa-trash"></i></button></td> </div> </div>');
                });
                $(document).on('click', '.btn_remove', function () {
                    var button_id = $(this).attr("id");

                    $('#row' + button_id + '').remove();
                });



                $('#add2').click(function () {
                    i++;
                    $('#dynamic_field2').append('<div class="form-row"  id="row2' + i + '"> <div class="col"> <select id="selection2" class="inputic1 mat" name="mange[]"><?php echo $options; ?></select> </div> <div class="col"> <div class= "munit"><input type="text" id= "tic2" class="inputic1 tic"  name="bezeichnung[]" placeholder="Tickness"><h3>mm</h3></div></div> <div class="col-2"> <td><button type="button" name="add" class="btn btn-danger btn_remove2" id="' + i + '"><i class="fa fa fa-trash"></i></button></td> </div> </div>');
                });
                $(document).on('click', '.btn_remove2', function () {
                    var button_id = $(this).attr("id");

                    $('#row2' + button_id + '').remove();
                });


                $('#add3').click(function () {
                    i++;
                    $('#dynamic_field3').append('<div class="form-row" id="row3' + i + '"> <div class="col"> <select id="selection3" class="inputic1 mat" name="offene_pukte[]"><?php echo $options; ?></select> </div> <div class="col"><div class= "munit"><input type="text" id= "tic3" class="inputic1 tic" name="intern[]" placeholder="Tickness"><h3>mm</h3></div></div> <div class="col-2"> <td><button type="button" name="add"  class="btn btn-danger btn_remove3" id="' + i + '"><i class="fa fa fa-trash"></i></button></td> </div> </div>');
                });
                $(document).on('click', '.btn_remove3', function () {
                    var button_id = $(this).attr("id");

                    $('#row3' + button_id + '').remove();
                });



            });
        </script>

      <?php


      ?>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="js/jquery-3.4.1.min.js"></script>

	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/popper.min.js"></script> 
  <script src="js/bootstrap-4.4.1.js"></script>
  <script src="ToolS.js"></script>

  <script src="https://code.createjs.com/1.0.0/createjs.min.js"></script>
<script src="Model1_Walls.js?1684073915538"></script>
<script>
var canvas, stage, exportRoot, anim_container, dom_overlay_container, fnStartAnimation;
function init1() {
	canvas = document.getElementById("canvas");
	anim_container = document.getElementById("animation_container");
	dom_overlay_container = document.getElementById("dom_overlay_container");
	var comp=AdobeAn.getComposition("4EAFFC76CFB54346B84A4C537F52DCA6");
	var lib=comp.getLibrary();
	var loader = new createjs.LoadQueue(false);
	loader.addEventListener("fileload", function(evt){handleFileLoad(evt,comp)});
	loader.addEventListener("complete", function(evt){handleComplete(evt,comp)});
	var lib=comp.getLibrary();
	loader.loadManifest(lib.properties.manifest);
}
function handleFileLoad(evt, comp) {
	var images=comp.getImages();	
	if (evt && (evt.item.type == "image")) { images[evt.item.id] = evt.result; }	
}
function handleComplete(evt,comp) {
	//This function is always called, irrespective of the content. You can use the variable "stage" after it is created in token create_stage.
	var lib=comp.getLibrary();
	var ss=comp.getSpriteSheet();
	var queue = evt.target;
	var ssMetadata = lib.ssMetadata;
	for(i=0; i<ssMetadata.length; i++) {
		ss[ssMetadata[i].name] = new createjs.SpriteSheet( {"images": [queue.getResult(ssMetadata[i].name)], "frames": ssMetadata[i].frames} )
	}
	exportRoot = new lib.Model1_Walls();
	stage = new lib.Stage(canvas);	
	//Registers the "tick" event listener.
	fnStartAnimation = function() {
		stage.addChild(exportRoot);
		createjs.Ticker.framerate = lib.properties.fps;
		createjs.Ticker.addEventListener("tick", stage);
	}	    
	//Code to support hidpi screens and responsive scaling.
	AdobeAn.makeResponsive(false,'both',false,1,[canvas,anim_container,dom_overlay_container]);	
	AdobeAn.compositionLoaded(lib.properties.id);
	fnStartAnimation();
}
</script>
 <!-- Slider js -->
<script src="js/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>
  <!-- Slider js END-->


  </body>
</html>