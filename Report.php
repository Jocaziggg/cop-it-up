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
$R_TL_CC = "";
$R_TL_FC = "";

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

if(!empty($Userid)){
  mysqli_query($link, "UPDATE Users SET Current_Heating_System = '$Heating_solution', Interested_in_HPType = '$PumpSystem', Interested_in_HPBrand = '$PumpProducer', Expences = '$AmounthSpent', Currency_selected = '$currency' WHERE ID = '$Userid'");
}

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
 <!-- <nav>
         <ul>
            <li><a href="#"><i class="fa-regular fa-file-pdf"></i><span>Get pdf</span></a></li>
            <li><a href="#"><i class="fab fa-buy me a coffe"></i><span>Twitter</span></a></li>
            <li><a href="#"><i class="fab fa-instagram"></i><span>Instagram</span></a></li>
            <li><a href="#"><i class="fab fa-linkedin-in"></i><span>Linkedin</span></a></li>
            <li><a href="#"><i class="fab fa-github"></i><span>Github</span></a></li>
            <li><a href="#"><i class="fab fa-pinterest"></i><span>Pinterest</span></a></li>
         </ul>
  </nav>-->
  	<!-- body code goes here -->
    <div class="Header dropshadow" style = "position: sticky; top: 0rem; background-color: #fff; z-index:+1;">
    <div class="navmanu" id="navmanu" style = "position: absolute; right: 0; top: 0; background-color: #fff; z-index:+1; font-family: 'Ubuntu', sans-serif; font-size: medium; color: gray; ">
    </div>
    <div class="Header dropshadow" id="Header" style = "width: 100%; text-align: center;">
		<div class="Logo" id="Logo"><img src="Media/Logo1.png" width="215" height="69" alt=""/></div>
      </div>
    </div>
    <div class = "Container" id="Container">
      
      <div class="Content" id="Content">
        <div class="ToolContainer" id="ToolContainer">

        <div id="report_pdf">
                     <div class="sc_page1_title">Your Report</div>

                     <div class="sc_page1_desc11">In this report You can find heat loss details for every room. In 'Overall' section You will find the capacity of a heat pump that You need for Your property. You can also download pdf and use it to make the best deal. Thank you.</div>

                     <div class="sc_page1_desc">


        <?php
        $Rrow = "";
        $RadCaseChect = "";
        $RadCaseChect2 = "";

          while($Rrow = $Rresult -> fetch_assoc())
          { $RadCaseChect = $Rrow['Radiator1_Type'];
            $RadCaseChect2 = $Rrow['Radiator2_Type'];
            if($RadCaseChect == 'selec' && $RadCaseChect2 !== 'selec'){
        ?>

              <table class="report_table1">
	  
	    <tr>
	      <td>Room</td>
	      <td colspan="6">Termal loss (W)</td>
	      <td colspan="6">Radiators - New instalation</td>
        </tr>

	    <tr>
	      <td rowspan="3"><?php echo $Rrow['Room_name']; ?></td>
	      <td>Walls</td>
	      <td>Floor</td>
	      <td>Ceiling</td>
	      <td>Windows & Doors</td>
        <td>Ventilation</td>
	      <td style="font-weight:bold">Total (W)</td>
	      <td colspan="3">40⁰C</td>
	      <td colspan="3">50⁰C</td>
        </tr>
	    <tr>
      
	      <td rowspan="2"><?php $R_TL_W = $Rrow['T_Loss_Wall']; echo $R_TL_W; ?></td>

	      <td rowspan="2"><?php $RF_Case = $Rrow['Floor_Case'];
                              if($RF_Case !== 'Floor above heated room'){
                              $R_TL_F = $Rrow['T_Loss_Floor'];}
                              else {$R_TL_F = "No losses";} 
                              
                              if($R_TL_F == "No losses"){echo $R_TL_F;} else{echo(round($R_TL_F,2));} $R_TL_FC = round($Rrow['T_Loss_Floor'],2);?></td>


	      <td rowspan="2"><?php $RC_Case = $Rrow['Ceiling_Case'];
                              if($RC_Case !== 'Heated room'){
                              $R_TL_C = $Rrow['T_Loss_Ceiling'];}
                              else{$R_TL_C = "No losses";} 
                              
                              if($R_TL_C == "No losses"){echo $R_TL_C;} else{echo(round($R_TL_C,2));} $R_TL_CC = round($Rrow['T_Loss_Ceiling'],2);?></td>


	      <td rowspan="2"><?php $R_TL_D1 = $Rrow['T_Loss_Window']; 
                              $R_TL_D2 = $Rrow['T_Loss_Door'];
                              $R_TL_D = $R_TL_D1 + $R_TL_D2;
                              echo $R_TL_D; ?></td>
        <td rowspan="2"><?php $N_Vent = $Rrow['N_Vent'];
                              $M_Vent = $Rrow['M_Vent'];
                              $Vent_Case = $Rrow['Vent_Selection'];
                              if($Vent_Case == 'Nat'){$VentLoss = $N_Vent;}else{$VentLoss = $M_Vent;}
                              echo $VentLoss;
        ?></td>

	      <td rowspan="2" style="font-weight:bold"><?php if($Vent_Case == 'Nat'){$R_TL_T = $Rrow['THL_NVent'];}else{$R_TL_T = $Rrow['THL_MVent'];} echo $R_TL_T; ?></td>

	      <td>Height 0.6 m</td>
	      <td>Height 0.8 m</td>
	      <td>Height 0.9 m</td>
	      <td>Height 0.6 m</td>
	      <td>Height 0.8 m</td>
	      <td>Height 0.9 m</td>
        </tr>

        <?php
       
          
        ?>

	    <tr>
	      <td>
        <?php 
        $RTC1 = "";
        $RT1 = $Rrow['Radiator2_Type'];
        switch ($RT1) {
          case $RT1 == 'T11':
            $RTC1 = 550;
            break;
          case $RT1 == 'T21':
            $RTC1 = 800;
            break;
          case $RT1 == 'T22':
            $RTC1 = 1050;
            break;
          case $RT1 == 'T33':
            $RTC1 = 1500;
            break;
          default:
          $RTC1 = 0;
        }
        if($RTC1 !== 0){
        $RR41 = $R_TL_T/$RTC1/0.6; echo(round($RR41,1))." m";}else{$RR41 = "--"; echo $RR41." m";}
        ?>
        </td>
	      <td>
        <?php 
        if($RTC1 !== 0){
        $RR42 = $R_TL_T/$RTC1/0.8; echo(round($RR42,1))." m";}else{$RR42 = "--"; echo$RR42." m";}
        ?>
        </td>
	      <td>
        <?php
        if($RTC1 !== 0){
        $RR43 = $R_TL_T/$RTC1/0.9; echo(round($RR43,1))." m";}else{$RR43 = "--"; echo$RR43." m";}
        ?>
        </td>
	      <td>
        <?php 
        $RTC2 = "";
        $RT2 = $Rrow['Radiator2_Type'];
        switch ($RT2) {
          case $RT2 == 'T11':
            $RTC2 = 800;
            break;
          case $RT2 == 'T21':
            $RTC2 = 1140;
            break;
          case $RT2 == 'T22':
            $RTC2 = 1500;
            break;
          case $RT2 == 'T33':
            $RTC2 = 2200;
            break;
          default:
          $RTC2 = 0;
        }
        if($RTC2 !== 0){
        $RR51 = $R_TL_T/$RTC2/0.6; echo(round($RR51,1))." m";}else{$RR51 = "--"; echo $RR51." m";}
        ?>
        </td>
	      <td>
        <?php
        if($RTC2 !== 0){
        $RR52 = $R_TL_T/$RTC2/0.8; echo(round($RR52,1))." m";}else{$RR52 = "--"; echo $RR52." m";}
        ?>
        </td>
	      <td>
        <?php
        if($RTC2 !== 0){
        $RR53 = $R_TL_T/$RTC2/0.9; echo(round($RR53,1))." m";}else{$RR53 = "--"; echo$RR53." m";}
        ?>
        </td>
      </tr>
  <tr>
    <td colspan="13" style= "text-align: left;">
      <?php
      $HPS = "";
      $UV_Walls = $Rrow['U_Walls'];
      $UV_Windows = $Rrow['U_Window'];
      $UV_Ceiling = $Rrow['U_Ceiling'];
      $UV_Floor = $Rrow['U_Floor'];
      $R_Surface = $Rrow['Surface_Flor'];
      ?>
      <?php 
      if($UV_Walls>0.15*$R_Surface){echo "U-Value for Walls in this room is too heigh, You are loosing to much heat through Your walls. We heighly recomend that You invest in wall isolation prior to upgradeing to a heatpump. Please note, this will significately improve Your heating and lower Your heating costs regardless of Your current heating system. <br>";}else{echo "";}
      if($UV_Windows>0.1*$R_Surface){echo "U-Value of Windows in this room is too heigh. You are loosing to much heat through Your windows, we heighly suggest that You invest in upgradeing Your windows to a more modern solution. <br>";}else {echo "";}
      if($UV_Ceiling>0.12*$R_Surface && $RC_Case !== 'Heated room'){echo "U-Value for ceiling in this room is too heigh, You are loosing to much heat through Your ceiling/roof. We heighly recomend that You invest in ceiling/roof isolation prior to upgradeing to a heatpump, since over 40% of total hetloss is usually lost through ceiling/roof due to a natural upwords flow of hot air. <br>";}else {echo "";}
      if($UV_Ceiling>0.12*$R_Surface && $RC_Case == 'Heated room'){echo "U-Value ceiling - since there is a heated room above this one, the U-value of ceeling is irelevant but if the room above turns not to be heated at some point, ceiling would couse additional " . $R_TL_CC . "W of heat loss, which is above allowed and isolation should be improved. <br>";}
      else if($RC_Case == 'Heated room'){echo "U-Value ceiling - since there is a heated room above this one, the U-value of ceeling is irelevant but if the room above turns not to be heated at some point, ceiling would couse additional " . $R_TL_CC . "W of heat loss, which is in acceptable limits. <br>";}
      
      if($UV_Floor>0.12*$R_Surface && $RF_Case !== 'Floor above heated room'){echo "U-Value for floor in this room is too heigh, You are loosing to much heat through Your floor. We heighly recomend that You invest in floor isolation prior to upgradeing to a heatpump, since this room waste to much energy. <br>";}else {echo "";}
      if($UV_Floor>0.12*$R_Surface && $RF_Case == 'Floor above heated room'){echo "U-Value floor - since there is a heated room beneath this one, the U-value of floor is irelevant but if the room beneath turns not to be heated at some point, floor would couse additional " . $R_TL_FC . "W of heat loss, which is above allowed and isolation should be improved. <br>";}
      else if($RF_Case == 'Floor above heated room'){echo "U-Value floor - since there is a heated room beneath this one, the U-value of floor is irelevant but if the room beneath turns not to be heated at some point, floor would couse additional " . $R_TL_CC . "W of heat loss, which is in acceptable limits. <br>";}
      
      echo "<br>Radiators:<br>
      In 'Radiators - New instalation' section You can find the suggested length of radiator type " . $RT2 . " for the flow temperature of 40 and 50 degrees.<br>
      Please note that the length of the radiator varys in relation to the standard radiator heights (example: 0.6 m...) so that You can choose the best solution for Your room layout.<br>
      Note: There are radiators which are out of proposed standars. If the space in the room is an issue, You can consult Your preferred radiator manufacterer to find a solution that will satysfy the heatloss in this room.";
      ?>
    </td>
  </tr>
</table>
<br>
<?php
          }else if($RadCaseChect !== 'selec' && $RadCaseChect2 == 'selec'){
        ?>
        <table class="report_table1">
	  
    <tr>
      <td>Room</td>
      <td colspan="6">Termal loss (W)</td>
      <td colspan="2">Radiators - Current instalation</td>
      </tr>

    <tr>
      <td rowspan="3"><?php echo $Rrow['Room_name']; ?></td>
      <td>Walls</td>
      <td>Floor</td>
      <td>Ceiling</td>
      <td>Windows & Doors</td>
      <td>Ventilation</td>
      <td style="font-weight:bold">Total (W)</td>
      <td>40⁰C</td>
      <td>50⁰C</td>
      </tr>
    <tr>
    
      <td rowspan="2"><?php $R_TL_W = $Rrow['T_Loss_Wall']; echo $R_TL_W; ?></td>

      <td rowspan="2"><?php $RF_Case = $Rrow['Floor_Case'];
                            if($RF_Case !== 'Floor above heated room'){
                            $R_TL_F = $Rrow['T_Loss_Floor'];}
                            else {$R_TL_F = "No losses";}

                            if($R_TL_F == "No losses"){echo $R_TL_F;} else{echo(round($R_TL_F,2));} $R_TL_FC = round($Rrow['T_Loss_Floor'],2);?></td>


      <td rowspan="2"><?php $RC_Case = $Rrow['Ceiling_Case'];
                            if($RC_Case !== 'Heated room'){
                            $R_TL_C = $Rrow['T_Loss_Ceiling'];}
                            else{$R_TL_C = "No losses";}
                            
                            if($R_TL_C == "No losses"){echo $R_TL_C;} else{echo(round($R_TL_C,2));} $R_TL_CC = round($Rrow['T_Loss_Ceiling'],2);?></td>


      <td rowspan="2"><?php $R_TL_D1 = $Rrow['T_Loss_Window']; 
                            $R_TL_D2 = $Rrow['T_Loss_Door'];
                            $R_TL_D = $R_TL_D1 + $R_TL_D2;
                            echo $R_TL_D; ?></td>
      <td rowspan="2"><?php $N_Vent = $Rrow['N_Vent'];
                            $M_Vent = $Rrow['M_Vent'];
                            $Vent_Case = $Rrow['Vent_Selection'];
                            if($Vent_Case == 'Nat'){$VentLoss = $N_Vent;}else{$VentLoss = $M_Vent;}
                            echo $VentLoss;
                            $RRO4 = "";
                            $RRO5 = "";?></td>

      <td rowspan="2" style="font-weight:bold"><?php if($Vent_Case == 'Nat'){$R_TL_T = $Rrow['THL_NVent'];}else{$R_TL_T = $Rrow['THL_MVent'];} echo $R_TL_T; ?></td>

      
      </tr>

      <?php
    
        
      ?>

    <tr>
      <td>
      <?php
      $RTCO1 = "";
      $RTO1 = $Rrow['Radiator1_Type'];
      switch ($RTO1) {
        case $RTO1 == 'T11':
          $RTCO1 = 550;
          break;
        case $RTO1 == 'T21':
          $RTCO1 = 800;
          break;
        case $RTO1 == 'T22':
          $RTCO1 = 1050;
          break;
        case $RTO1 == 'T33':
          $RTCO1 = 1500;
          break;
        default:
        $RTCO1 = 0;
      }
      $RRO4 = "";
      $R_Sur = $Rrow['Radiator1_Surface'];
      $RRO_C4 = $R_Sur*$RTCO1;
      if($RRO_C4 > $R_TL_T){$RRO4 = "#1BAE70";}else{$RRO4 = "#ff0000";}
      ?>
      <p style= "color: <?php echo $RRO4;?>"><?php echo $RRO_C4." W";?></p>
      </td>

      <td>
      <?php
      $RTCO2 = "";
      $RTO2 = $Rrow['Radiator1_Type'];
      switch ($RTO2) {
        case $RTO2 == 'T11':
          $RTCO2 = 800;
          break;
        case $RTO2 == 'T21':
          $RTCO2 = 1140;
          break;
        case $RTO2 == 'T22':
          $RTCO2 = 1500;
          break;
        case $RTO2 == 'T33':
          $RTCO2 = 2200;
          break;
        default:
        $RTCO2 = 0;
      }
      $RRO5 = "";
      $RRO_C5 = $R_Sur*$RTCO2;
      if($RRO_C5 > $R_TL_T){$RRO5 = "#1BAE70";}else{$RRO5 = "#ff0000";}
      ?>
      <p style= "color: <?php echo $RRO5;?>"><?php echo $RRO_C5." W";?></p>
      </td>

      </tr>
      <tr>
    <td colspan="13" style= "text-align: left;">
      <?php
      $HPS = "";
      $UV_Walls = $Rrow['U_Walls'];
      $UV_Windows = $Rrow['U_Window'];
      $UV_Ceiling = $Rrow['U_Ceiling'];
      $UV_Floor = $Rrow['U_Floor'];
      $R_Surface = $Rrow['Surface_Flor'];
      ?>
      <?php 
      if($UV_Walls>0.15*$R_Surface){echo "U-Value for walls in this room is too heigh, You are loosing to much heat through Your walls. We heighly recomend that You invest in wall isolation prior to upgradeing to a heatpump. Please note, this will significately improve Your heating and lower Your heating costs regardless of Your current heating system. <br>";}else{echo "";}
      if($UV_Windows>0.1*$R_Surface){echo "U-Value of windows in this room is too heigh. You are loosing to much heat through Your windows, we heighly suggest that You invest in upgradeing Your windows to a more modern solution. <br>";}else {echo "";}
      if($UV_Ceiling>0.12*$R_Surface && $RC_Case !== 'Heated room'){echo "U-Value for ceiling in this room is too heigh, You are loosing to much heat through Your ceiling/roof. We heighly recomend that You invest in ceiling/roof isolation prior to upgradeing to a heatpump, since over 40% of total hetloss is usually lost through ceiling/roof due to a natural upwords flow of hot air. <br>";}else {echo "";}
      if($UV_Ceiling>0.12*$R_Surface && $RC_Case == 'Heated room'){echo "U-Value ceiling - since there is a heated room above this one, the U-value of ceeling is irelevant but if the room above turns not to be heated at some point, ceiling would couse additional " . $R_TL_CC . "W of heat loss, which is above allowed and isolation should be improved. <br>";}
      else if($RC_Case == 'Heated room'){echo "U-Value ceiling - since there is a heated room above this one, the U-value of ceeling is irelevant but if the room above turns not to be heated at some point, ceiling would couse additional " . $R_TL_CC . "W of heat loss, which is in acceptable limits. <br>";}
      
      if($UV_Floor>0.12*$R_Surface && $RF_Case !== 'Floor above heated room'){echo "U-Value for floor in this room is too heigh, You are loosing to much heat through Your floor. We heighly recomend that You invest in floor isolation prior to upgradeing to a heatpump, since this room waste to much energy. <br>";}else {echo "";}
      if($UV_Floor>0.12*$R_Surface && $RF_Case == 'Floor above heated room'){echo "U-Value floor - since there is a heated room beneath this one, the U-value of floor is irelevant but if the room beneath turns not to be heated at some point, floor would couse additional " . $R_TL_FC . "W of heat loss, which is above allowed and isolation should be improved. <br>";}
      else if($RF_Case == 'Floor above heated room'){echo "U-Value floor - since there is a heated room beneath this one, the U-value of floor is irelevant but if the room beneath turns not to be heated at some point, floor would couse additional " . $R_TL_CC . "W of heat loss, which is in acceptable limits. <br>";}

      echo "<br>Radiators:<br>";
      if($RRO4 == '#ff0000' && $RRO5 == '#ff0000'){echo "Your current radiators are not sufficient to satisfy heat loss in this room for desired temperature. You should upgrade Your current radiators or, if possible add aditional ones. You can use 'New instalation' section in our tool to check which type and size of radiator would be most suttable for this room.<br>";}else{echo "";}
      if($RRO4 == '#ff0000' && $RRO5 == '#1BAE70'){echo "Your current radiators satisfy the demand for heatloss at flow temperature above 40C. The radiators in this room are heatpump ready, but we suggest if possible to upgrade or add additional ratiator in order to lower the flow temperature further, since lower the flow temperature is, the lower are the running costs of the heatpump.<br>";}else{echo "";}
      if($RRO4 == '#1BAE70' && $RRO5 == '#1BAE70'){echo "Your current radiators satisfy the demand for heatloss at flow temperature of 40C. The radiators in this room are heatpump ready.<br>";}else{echo "";}
      ?>
    </td>
  </tr>
</table>
<br>
        <?php
          }
          else if($RadCaseChect !== 'selec' && $RadCaseChect2 !== 'selec'){
        ?>

            <table class="report_table1">
	  
            <tr>
              <td>Room</td>
              <td colspan="6">Termal loss (W)</td>
              <td colspan="6">Radiators - New instalation</td>
              <td colspan="2">Radiators - Current instalation</td>
              </tr>
        
            <tr>
              <td rowspan="3"><?php echo $Rrow['Room_name']; ?></td>
              <td>Walls</td>
              <td>Floor</td>
              <td>Ceiling</td>
              <td>Windows & Doors</td>
              <td>Ventilation</td>
              <td style="font-weight:bold">Total (W)</td>
              <td colspan="3">40⁰C</td>
              <td colspan="3">50⁰C</td>
              <td>40⁰C</td>
              <td>50⁰C</td>
              </tr>
            <tr>
            
              <td rowspan="2"><?php $R_TL_W = $Rrow['T_Loss_Wall']; echo $R_TL_W; ?></td>
        
              <td rowspan="2"><?php $RF_Case = $Rrow['Floor_Case'];
                                    if($RF_Case !== 'Floor above heated room'){
                                    $R_TL_F = $Rrow['T_Loss_Floor'];}
                                    else {$R_TL_F = "No losses";}
        
                                    if($R_TL_F == "No losses"){echo $R_TL_F;} else{echo(round($R_TL_F,2));} $R_TL_FC = round($Rrow['T_Loss_Floor'],2);?></td>
        
        
              <td rowspan="2"><?php $RC_Case = $Rrow['Ceiling_Case'];
                                    if($RC_Case !== 'Heated room'){
                                    $R_TL_C = $Rrow['T_Loss_Ceiling'];}
                                    else{$R_TL_C = "No losses";}
                                    
                                    if($R_TL_C == "No losses"){echo $R_TL_C;} else{echo(round($R_TL_C,2));} $R_TL_CC = round($Rrow['T_Loss_Ceiling'],2);?></td>
        
        
              <td rowspan="2"><?php $R_TL_D1 = $Rrow['T_Loss_Window']; 
                                    $R_TL_D2 = $Rrow['T_Loss_Door'];
                                    $R_TL_D = $R_TL_D1 + $R_TL_D2;
                                    echo $R_TL_D; ?></td>
              <td rowspan="2"><?php $N_Vent = $Rrow['N_Vent'];
                                    $M_Vent = $Rrow['M_Vent'];
                                    $Vent_Case = $Rrow['Vent_Selection'];
                                    if($Vent_Case == 'Nat'){$VentLoss = $N_Vent;}else{$VentLoss = $M_Vent;}
                                    echo $VentLoss;
                                    $RRO4 = "";
                                    $RRO5 = "";?></td>
        
              <td rowspan="2" style="font-weight:bold"><?php if($Vent_Case == 'Nat'){$R_TL_T = $Rrow['THL_NVent'];}else{$R_TL_T = $Rrow['THL_MVent'];} echo $R_TL_T; ?></td>
        
              
              

              <td>Height 0.6 m</td>
	      <td>Height 0.8 m</td>
	      <td>Height 0.9 m</td>
	      <td>Height 0.6 m</td>
	      <td>Height 0.8 m</td>
	      <td>Height 0.9 m</td>

        <td rowspan="2">
      <?php
      $RTCO1 = "";
      $RTO1 = $Rrow['Radiator1_Type'];
      switch ($RTO1) {
        case $RTO1 == 'T11':
          $RTCO1 = 550;
          break;
        case $RTO1 == 'T21':
          $RTCO1 = 800;
          break;
        case $RTO1 == 'T22':
          $RTCO1 = 1050;
          break;
        case $RTO1 == 'T33':
          $RTCO1 = 1500;
          break;
        default:
        $RTCO1 = 0;
      }
      $RRO4 = "";
      $R_Sur = $Rrow['Radiator1_Surface'];
      $RRO_C4 = $R_Sur*$RTCO1;
      if($RRO_C4 > $R_TL_T){$RRO4 = "#1BAE70";}else{$RRO4 = "#ff0000";}
      ?>
      <p style= "color: <?php echo $RRO4;?>"><?php echo $RRO_C4." W";?></p>
      </td>

      <td rowspan="2">
      <?php
      $RTCO2 = "";
      $RTO2 = $Rrow['Radiator1_Type'];
      switch ($RTO2) {
        case $RTO2 == 'T11':
          $RTCO2 = 800;
          break;
        case $RTO2 == 'T21':
          $RTCO2 = 1140;
          break;
        case $RTO2 == 'T22':
          $RTCO2 = 1500;
          break;
        case $RTO2 == 'T33':
          $RTCO2 = 2200;
          break;
        default:
        $RTCO2 = 0;
      }
      $RRO5 = "";
      $RRO_C5 = $R_Sur*$RTCO2;
      if($RRO_C5 > $R_TL_T){$RRO5 = "#1BAE70";}else{$RRO5 = "#ff0000";}
      ?>
      <p style= "color: <?php echo $RRO5;?>"><?php echo $RRO_C5." W";?></p>
      </td>

    </tr>

	    <tr>
	      <td>
        <?php 
        $RTC1 = "";
        $RT1 = $Rrow['Radiator2_Type'];
        switch ($RT1) {
          case $RT1 == 'T11':
            $RTC1 = 550;
            break;
          case $RT1 == 'T21':
            $RTC1 = 800;
            break;
          case $RT1 == 'T22':
            $RTC1 = 1050;
            break;
          case $RT1 == 'T33':
            $RTC1 = 1500;
            break;
          default:
          $RTC1 = 0;
        }
        if($RTC1 !== 0){
        $RR41 = $R_TL_T/$RTC1/0.6; echo(round($RR41,1))." m";}else{$RR41 = "--"; echo $RR41." m";}
        ?>
        </td>
	      <td>
        <?php 
        if($RTC1 !== 0){
        $RR42 = $R_TL_T/$RTC1/0.8; echo(round($RR42,1))." m";}else{$RR42 = "--"; echo$RR42." m";}
        ?>
        </td>
	      <td>
        <?php
        if($RTC1 !== 0){
        $RR43 = $R_TL_T/$RTC1/0.9; echo(round($RR43,1))." m";}else{$RR43 = "--"; echo$RR43." m";}
        ?>
        </td>
	      <td>
        <?php 
        $RTC2 = "";
        $RT2 = $Rrow['Radiator2_Type'];
        switch ($RT2) {
          case $RT2 == 'T11':
            $RTC2 = 800;
            break;
          case $RT2 == 'T21':
            $RTC2 = 1140;
            break;
          case $RT2 == 'T22':
            $RTC2 = 1500;
            break;
          case $RT2 == 'T33':
            $RTC2 = 2200;
            break;
          default:
          $RTC2 = 0;
        }
        if($RTC2 !== 0){
        $RR51 = $R_TL_T/$RTC2/0.6; echo(round($RR51,1))." m";}else{$RR51 = "--"; echo $RR51." m";}
        ?>
        </td>
	      <td>
        <?php
        if($RTC2 !== 0){
        $RR52 = $R_TL_T/$RTC2/0.8; echo(round($RR52,1))." m";}else{$RR52 = "--"; echo $RR52." m";}
        ?>
        </td>
	      <td>
        <?php
        if($RTC2 !== 0){
        $RR53 = $R_TL_T/$RTC2/0.9; echo(round($RR53,1))." m";}else{$RR53 = "--"; echo$RR53." m";}
        ?>
        </td>
      </tr>
  
    <tr>
    <td colspan="15" style= "text-align: left;">
      <?php
      $HPS = "";
      $UV_Walls = $Rrow['U_Walls'];
      $UV_Windows = $Rrow['U_Window'];
      $UV_Ceiling = $Rrow['U_Ceiling'];
      $UV_Floor = $Rrow['U_Floor'];
      $R_Surface = $Rrow['Surface_Flor'];
      ?>
      <?php 
      if($UV_Walls>0.15*$R_Surface){echo "U-Value for walls in this room is too heigh, You are loosing to much heat through Your walls. We heighly recomend that You invest in wall isolation prior to upgradeing to a heatpump. Please note, this will significately improve Your heating and lower Your heating costs regardless of Your current heating system. <br>";}else{echo "";}
      if($UV_Windows>0.1*$R_Surface){echo "U-Value of windows in this room is too heigh. You are loosing to much heat through Your windows, we heighly suggest that You invest in upgradeing Your windows to a more modern solution. <br>";}else {echo "";}
      if($UV_Ceiling>0.12*$R_Surface && $RC_Case !== 'Heated room'){echo "U-Value for ceiling in this room is too heigh, You are loosing to much heat through Your ceiling/roof. We heighly recomend that You invest in ceiling/roof isolation prior to upgradeing to a heatpump, since over 40% of total hetloss is usually lost through ceiling/roof due to a natural upwords flow of hot air. <br>";}else {echo "";}
      if($UV_Ceiling>0.12*$R_Surface && $RC_Case == 'Heated room'){echo "U-Value ceiling - since there is a heated room above this one, the U-value of ceeling is irelevant but if the room above turns not to be heated at some point, ceiling would couse additional " . $R_TL_CC . "W of heat loss, which is above allowed and isolation should be improved. <br>";}
      else if($RC_Case == 'Heated room'){echo "U-Value ceiling - since there is a heated room above this one, the U-value of ceeling is irelevant but if the room above turns not to be heated at some point, ceiling would couse additional " . $R_TL_CC . "W of heat loss, which is in acceptable limits. <br>";}
      
      if($UV_Floor>0.12*$R_Surface && $RF_Case !== 'Floor above heated room'){echo "U-Value for floor in this room is too heigh, You are loosing to much heat through Your floor. We heighly recomend that You invest in floor isolation prior to upgradeing to a heatpump, since this room waste to much energy. <br>";}else {echo "";}
      if($UV_Floor>0.12*$R_Surface && $RF_Case == 'Floor above heated room'){echo "U-Value floor - since there is a heated room beneath this one, the U-value of floor is irelevant but if the room beneath turns not to be heated at some point, floor would couse additional " . $R_TL_FC . "W of heat loss, which is above allowed and isolation should be improved. <br>";}
      else if($RF_Case == 'Floor above heated room'){echo "U-Value floor - since there is a heated room beneath this one, the U-value of floor is irelevant but if the room beneath turns not to be heated at some point, floor would couse additional " . $R_TL_CC . "W of heat loss, which is in acceptable limits. <br>";}

      echo "<br>Radiators - New instalation:<br>
      In 'Radiators - New instalation' section You can find the suggested length of radiator type " . $RT2 . " for the flow temperature of 40 and 50 degrees.<br>
      Please note that the length of the radiator varys in relation to the standard radiator heights (example: 0.6 m...) so that You can choose the best solution for Your room layout.<br>
      Note: There are radiators which are out of proposed standars. If the space in the room is an issue, You can consult Your preferred radiator manufacterer to find a solution that will satysfy the heatloss in this room.<br>";

      echo "<br>Radiators - Current instalation:<br>";
      if($RRO4 == '#ff0000' && $RRO5 == '#ff0000'){echo "Your current radiators are not sufficient to satisfy heat loss in this room for desired temperature. You should upgrade Your current radiators or, if possible add aditional ones. You can use 'New instalation' section in our tool to check which type and size of radiator would be most suttable for this room.<br>";}else{echo "";}
      if($RRO4 == '#ff0000' && $RRO5 == '#1BAE70'){echo "Your current radiators satisfy the demand for heatloss at flow temperature above 40C. The radiators in this room are heatpump ready, but we suggest if possible to upgrade or add additional ratiator in order to lower the flow temperature further, since lower the flow temperature is, the lower are the running costs of the heatpump.<br>";}else{echo "";}
      if($RRO4 == '#1BAE70' && $RRO5 == '#1BAE70'){echo "Your current radiators satisfy the demand for heatloss at flow temperature of 40C. The radiators in this room are heatpump ready.<br>";}else{echo "";}
      ?>
    </td>
  </tr>
</table>
<br>

<?php    
      } else {
    ?>    

<table class="report_table1">
	  
    <tr>
      <td>Room</td>
      <td colspan="6">Termal loss (W)</td>
      </tr>

    <tr>
      <td rowspan="3"><?php echo $Rrow['Room_name']; ?></td>
      <td>Walls</td>
      <td>Floor</td>
      <td>Ceiling</td>
      <td>Windows & Doors</td>
      <td>Ventilation</td>
      <td style="font-weight:bold">Total (W)</td>
      </tr>
    <tr>
    
      <td rowspan="2"><?php $R_TL_W = $Rrow['T_Loss_Wall']; echo $R_TL_W; ?></td>

      <td rowspan="2"><?php $RF_Case = $Rrow['Floor_Case'];
                            if($RF_Case !== 'Floor above heated room'){
                            $R_TL_F = $Rrow['T_Loss_Floor'];}
                            else {$R_TL_F = "No losses";}

                            if($R_TL_F == "No losses"){echo $R_TL_F;} else{echo(round($R_TL_F,2));} $R_TL_FC = round($Rrow['T_Loss_Floor'],2);?></td>


      <td rowspan="2"><?php $RC_Case = $Rrow['Ceiling_Case'];

                            if($RC_Case !== 'Heated room'){
                            $R_TL_C = $Rrow['T_Loss_Ceiling'];}
                            else{$R_TL_C = "No losses";}

                            if($R_TL_C == "No losses"){echo $R_TL_C;} else{echo(round($R_TL_C,2));} $R_TL_CC = round($Rrow['T_Loss_Ceiling'],2);?></td>


      <td rowspan="2"><?php $R_TL_D1 = $Rrow['T_Loss_Window']; 
                            $R_TL_D2 = $Rrow['T_Loss_Door'];
                            $R_TL_D = $R_TL_D1 + $R_TL_D2;
                            echo $R_TL_D; ?></td>
      <td rowspan="2"><?php $N_Vent = $Rrow['N_Vent'];
                            $M_Vent = $Rrow['M_Vent'];
                            $Vent_Case = $Rrow['Vent_Selection'];
                            if($Vent_Case = 'Nat'){$VentLoss = $N_Vent;}else{$VentLoss = $M_Vent;}
                            echo $VentLoss;
      ?></td>

      <td rowspan="2" style="font-weight:bold"><?php if($Vent_Case = 'Nat'){$R_TL_T = $Rrow['THL_NVent'];}else{$R_TL_T = $Rrow['THL_MVent'];} echo $R_TL_T; ?></td>


      </tr>

      <?php
     
        
      ?>

    <tr>


      </tr>
      <tr>
    <td colspan="13" style= "text-align: left;">
      <?php
      $HPS = "";
      $UV_Walls = $Rrow['U_Walls'];
      $UV_Windows = $Rrow['U_Window'];
      $UV_Ceiling = $Rrow['U_Ceiling'];
      $UV_Floor = $Rrow['U_Floor'];
      $R_Surface = $Rrow['Surface_Flor'];
      ?>
      <?php 
      if($UV_Walls>0.15*$R_Surface){echo "U-Value for Walls in this room is too heigh, You are loosing to much heat through Your walls. We heighly recomend that You invest in wall isolation prior to upgradeing to a heatpump. Please note, this will significately improve Your heating and lower Your heating costs regardless of Your current heating system. <br>";}else{echo "";}
      if($UV_Windows>0.1*$R_Surface){echo "U-Value of Windows in this room is too heigh. You are loosing to much heat through Your windows, we heighly suggest that You invest in upgradeing Your windows to a more modern solution. <br>";}else {echo "";}
      if($UV_Ceiling>0.12*$R_Surface && $RC_Case !== 'Heated room'){echo "U-Value for ceiling in this room is too heigh, You are loosing to much heat through Your ceiling/roof. We heighly recomend that You invest in ceiling/roof isolation prior to upgradeing to a heatpump, since over 40% of total hetloss is usually lost through ceiling/roof due to a natural upwords flow of hot air. <br>";}else {echo "";}
      if($UV_Ceiling>0.12*$R_Surface && $RC_Case == 'Heated room'){echo "U-Value ceiling - since there is a heated room above this one, the U-value of ceeling is irelevant but if the room above turns not to be heated at some point, ceiling would couse additional " . $R_TL_CC . "W of heat loss, which is above allowed and isolation should be improved. <br>";}
      else if($RC_Case == 'Heated room'){echo "U-Value ceiling - since there is a heated room above this one, the U-value of ceeling is irelevant but if the room above turns not to be heated at some point, ceiling would couse additional " . $R_TL_CC . "W of heat loss, which is in acceptable limits. <br>";}
      
      if($UV_Floor>0.12*$R_Surface && $RF_Case !== 'Floor above heated room'){echo "U-Value for floor in this room is too heigh, You are loosing to much heat through Your floor. We heighly recomend that You invest in floor isolation prior to upgradeing to a heatpump, since this room waste to much energy. <br>";}else {echo "";}
      if($UV_Floor>0.12*$R_Surface && $RF_Case == 'Floor above heated room'){echo "U-Value floor - since there is a heated room beneath this one, the U-value of floor is irelevant but if the room beneath turns not to be heated at some point, floor would couse additional " . $R_TL_FC . "W of heat loss, which is above allowed and isolation should be improved. <br>";}
      else if($RF_Case == 'Floor above heated room'){echo "U-Value floor - since there is a heated room beneath this one, the U-value of floor is irelevant but if the room beneath turns not to be heated at some point, floor would couse additional " . $R_TL_CC . "W of heat loss, which is in acceptable limits. <br>";}
      
      ?>
    </td>
  </tr>
</table>
<br>
        <?php
          }}
        ?>


        <?PHP 
        if(!empty($R_TL_T)){
          $SelectAW = "SELECT SUM(T_Loss_Wall) FROM Rooms WHERE Calc_id = '$calc_id'";
          $queryAW = mysqli_query($link, $SelectAW);
          $rowAW= mysqli_fetch_assoc($queryAW);}
          $TS_W= $rowAW['SUM(T_Loss_Wall)'];

        if(!empty($R_TL_T)){
          $SelectAF = "SELECT SUM(T_Loss_Floor) FROM Rooms WHERE Calc_id = '$calc_id'";
          $queryAF = mysqli_query($link, $SelectAF);
          $rowAF = mysqli_fetch_assoc($queryAF);}
          $TS_WF =  $rowAF['SUM(T_Loss_Floor)'];

        if(!empty($R_TL_T)){
          $SelectAC = "SELECT SUM(T_Loss_Ceiling) FROM Rooms WHERE Calc_id = '$calc_id'";
          $queryAC = mysqli_query($link, $SelectAC);
          $rowAC = mysqli_fetch_assoc($queryAC);}
          $TS_WC =  $rowAC['SUM(T_Loss_Ceiling)'];

        if(!empty($R_TL_T)){
          $SelectAWI = "SELECT SUM(T_Loss_Window) FROM Rooms WHERE Calc_id = '$calc_id'";
          $queryAWI = mysqli_query($link, $SelectAWI);
          $rowAWI = mysqli_fetch_assoc($queryAWI);}
          $TS_WWI =  $rowAWI['SUM(T_Loss_Window)'];

        if(!empty($R_TL_T)){
          $SelectAD = "SELECT SUM(T_Loss_Door) FROM Rooms WHERE Calc_id = '$calc_id'";
          $queryAD = mysqli_query($link, $SelectAD);
          $rowAD = mysqli_fetch_assoc($queryAD);}
          $TS_WD =  $rowAD['SUM(T_Loss_Door)'];

        if(!empty($R_TL_T)){
          $SelectAN = "SELECT SUM(N_Vent) FROM Rooms WHERE Calc_id = '$calc_id'";
          $queryAN = mysqli_query($link, $SelectAN);
          $rowAN = mysqli_fetch_assoc($queryAN);}
          $TS_WN =  $rowAN['SUM(N_Vent)'];

        if(!empty($R_TL_T)){
          $SelectAM = "SELECT SUM(M_Vent) FROM Rooms WHERE Calc_id = '$calc_id'";
          $queryAM = mysqli_query($link, $SelectAM);
          $rowAM = mysqli_fetch_assoc($queryAM);}
          $TS_WM =  $rowAM['SUM(M_Vent)'];

        if(!empty($R_TL_T)){
          $SelectANT = "SELECT SUM(THL_NVent) FROM Rooms WHERE Calc_id = '$calc_id'";
          $queryANT = mysqli_query($link, $SelectANT);
          $rowANT = mysqli_fetch_assoc($queryANT);}
          $TS_WNT =  $rowANT['SUM(THL_NVent)'];

        if(!empty($R_TL_T)){
          $SelectAMT = "SELECT SUM(THL_MVent) FROM Rooms WHERE Calc_id = '$calc_id'";
          $queryAMT = mysqli_query($link, $SelectAMT);
          $rowAMT = mysqli_fetch_assoc($queryAMT);}
          $TS_WMT =  $rowAMT['SUM(THL_MVent)'];
        
        ?>
<br>
<div class="sc_page1_desc2" style="font-weight:bold; font-size: 22px;">Overall:</div>
<table class="report_table1">
	  
    <tr>
      <td rowspan="4" style="font-weight:bold"><?php echo "Sum for property" ?></td>
      <td colspan="6">Termal loss (W)</td>
    </tr>

    <tr>
      <td>Walls</td>
      <td>Floor</td>
      <td>Ceiling</td>
      <td>Windows & Doors</td>
      <td>Ventilation</td>
      <td style="font-weight:bold">Total (W)</td>
    </tr>

    <tr>
    
      <td rowspan="2">
        <?php echo (round($TS_W,2)); ?>
      </td>

      <td rowspan="2">
        <?php echo(round($TS_WF,2));?>
      </td>

      <td rowspan="2">
        <?php echo(round($TS_WC,2));?>
      </td>

      <td rowspan="2">
        <?php 
          $R_TL_DS = $TS_WWI + $TS_WD;
          echo (round($R_TL_DS,2)); 
        ?>
      </td>

      <td rowspan="2">
        <?php 
          if($Vent_Case = 'Nat')
            {$VentLossS = $TS_WN;}else{$VentLossS = $TS_WM;}
            echo (round($VentLossS,2));
        ?>
      </td>

      <td rowspan="2" style="font-weight:bold"><?php if($Vent_Case = 'Nat'){$R_TL_TS = $TS_WNT;}else{$R_TL_TS = $TS_WMT;} echo (round($R_TL_TS,2)); ?></td>


    </tr>

      <?php
     
        
      ?>

    <tr>


    </tr>
      <tr>
    <td colspan="13" style = "font-weight:bold; color:#7a7d7a; font-size: 18px; padding-left: 50px; padding-right: 50px; text-align: left;"><br>
      <?php
      $HPS = "";
      //$UV_Walls = $Rrow['U_Walls'];
      //$UV_Windows = $Rrow['U_Ceiling'];
      //$UV_Ceiling = $Rrow['U_Window'];

      switch ($R_TL_TS) {
        case $R_TL_TS>0 && $R_TL_TS<5000:
          $HPS = 5;
          echo "- Your total Heat loss is <h33 style='color:#1BAE70;'>" . (round($R_TL_TS)) . " W.</h33> <br> - Sugested Heatpump capacity is <h34 style='color:#1BAE70;'>5 KW.</h34>";
          break;
        case $R_TL_TS>5000 && $R_TL_TS<8000:
          $HPS = 8;
          echo "- Your total Heat loss is <h33 style='color:#1BAE70;'>" . (round($R_TL_TS)) . " W. </h33><br> - Sugested Heatpump capacity is <h34 style='color:#1BAE70;'>8 KW.</h34>";
          break;
        case $R_TL_TS>8000 && $R_TL_TS<10000:
          $HPS = 10;
          echo "- Your total Heat loss is <h33 style='color:#1BAE70;'>" . (round($R_TL_TS)) . " W. </h33><br> - Sugested Heatpump capacity is <h34 style='color:#1BAE70;'>10 KW.</h34>";
          break;
        case $R_TL_TS>10000 && $R_TL_TS<12000:
          $HPS = 12;
          echo "- Your total Heat loss is <h33 style='color:#1BAE70;'>" . (round($R_TL_TS)) . " W. </h33><br> - Sugested Heatpump capacity is <h34 style='color:#1BAE70;'>12 KW.</h34>";
          break;
        case $R_TL_TS>12000 && $R_TL_TS<14000:
          $HPS = 14;
          echo "- Your total Heat loss is <h33 style='color:#1BAE70;'>" . (round($R_TL_TS)) . " W. </h33><br> - Sugested Heatpump capacity is <h34 style='color:#1BAE70;'>14 KW.</h34>";
          break;
        case $R_TL_TS>14000 && $R_TL_TS<16000:
          $HPS = 16;
          echo "- Your total Heat loss is <h33 style='color:#1BAE70;'>" . (round($R_TL_TS)) . " W. </h33><br> - Sugested Heatpump capacity is <h34 style='color:#1BAE70;'>16 KW.</h34>";
          break;
        default:
          echo "The heatloss fot this property is too large for sugested air sourced heatpump range. The property is ither porlly isolated or simply too large. In case of a larger properties, you should consult desired manufacterer for the offer. Feel free to use this report in that purpose. <br>";
      }
      ?>
    <button id="exportic" onclick="window.scrollTo({top: 0}); window.print();" target="_blank" class="exportic" style="border: 0; display: block; margin: 2rem 0 1rem 0;">
        <img style="border: 0; width: 184px; height: 64px;" src="images/PDF-icon-1.jpg" >
      </button>
      
      <?php 
      //if($UV_Walls>0.15){echo "U-Value for Walls in this room is too heigh, you are loosing to much heat through your walls. We heighly recomend that you invest in wall isolation prior to upgradeing to a heatpump. Pleaee note, this wil significately improve your heating and lower your heating costs regardless of your current heating system. <br>";}else{echo "";}
      //if($UV_Windows>0.1){echo "U-value of Windows in this room is too heigh. you are loosing to much heat through your windows, we heighly suggest that you invest in upgradeing your windows to a more modern solution. <br>";}else {echo "";}
      //if($UV_Ceiling>0.12){echo "U-Value for ceiling in this room is too heigh, you are loosing to much heat through your ceiling/roof. We heighly recomend that you invest in ceiling/roof isolation prior to upgradeing to a heatpump, since over 40% of total hetloss is usually lost through ceiling/roof due to a natural upwords flow of hot air. <br>";}else {echo "";}
      ?>
    <br></td>

  </tr>
 
</table>
    

        <br><a href ="calculator3.php" target="_blank"><button id="New_calc" class="btn_NEXT1" name="btn_REPORT">New calculation</button></a>   <a href ="https://www.cop-it-up.com/" target="_blank"><button id="Blog" class="btn_NEXT1" name="btn_REPORT">Blog</button></a> <a href="https://www.buymeacoffee.com/copitup" target="_blank"><img src="images/bmc-full-logo-no-background.png" style="width: 289px; height: 63px; margin-left: 40px;"></a><br>

                     </div>

                     <div class="sc_page1_desc"></div>

                  </div>
            </div>


        </div>
        </div>
        </div>

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

    <!-- html2pdf script-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>


    <script
			src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
			integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
			crossorigin="anonymous"
			referrerpolicy="no-referrer"
		></script>

    <script src="custom.js"></script>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
    <script src="js/jquery-3.4.1.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/popper.min.js"></script> 
    <script src="js/bootstrap-4.4.1.js"></script>
    <script src="Tool.js"></script>

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



  </body>
</html>