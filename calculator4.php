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

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous"> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">

    

    <title>COP Calculator</title>



    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>





<!-- REFRESH SPECIFIC DIV -->

    <script>

    function relonce(){

      let called = 0;

      return function(){

        if(called === 0){

          window.location.reload();

        called++;

        }

      }

    }

    relonce();



    </script>





    <!-- Bootstrap -->

    <link href="css/bootstrap-4.4.1.css" rel="stylesheet">

    <link href="css/Tool.css" rel="stylesheet">

    <link href="css/main_css.css" rel="stylesheet">

	  <link href="css/style.css" rel="stylesheet">

   

    <style type="text/css">

    </style>

  

  <link href="css/styleS.css" rel="stylesheet">



    <!-- Slidr CSS1 -->

    <link rel="stylesheet" href="css/swiper-bundle.min.css" />



    <!-- Slidr CSS2 -->

    <link rel="stylesheet" href="css/style.css" />



    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  </head>



  <body>

<!-- body code goes here -->





<!-- SIDE POPUP DIV START -->

  <div class="wrapperP side-panel-open">

  <button class="side-panel-toggle" type="button">

    <span class="spP-icon-open">Rooms</span>

    <span class="spP-icon-close">Rooms</span>

  </button>



  <div id= "sidePanel" class="side-panel">

  <div class="containerbackground"> 

    No Rooms added yet 

  </div> 



  <?php 

    $Rrow = "";

    $RadCaseChect = "";

            

    while($Srow = $Sresult -> fetch_assoc()) {  

      

      $RadCaseChect = $Srow['Room_name'];

      if($RadCaseChect !== '') {

        $RID = $Srow['ID'];

        $Vent = $Srow['Vent_Selection'];

        $MVent = $Srow['THL_MVent'];

        $NVent = $Srow['THL_NVent'];

        $THL = "";

        if($Vent == 'Nat') {

          $THL = $NVent;

        } else {

          $THL = $MVent;

        }

      }



  ?>

    <div id = "RboxT" style = "background-color: #fff;">

      <div id = "<?php echo $Srow['ID'];?>" class="Rbox">

        <div class="RoNamebox">

          <?php echo $Srow['Room_name'];?>

        </div>

        <div class="Rval">

          <h3 class="name">Heat loss</h3>

          <h4 class="job"><?php echo $THL;?></h4>

        </div>

        <div class="name-job">

          <input type ="hidden" id = "hidid" name="id" value ="<?php echo $RID;?>">

          <input type ="submit" value="Delete" name="delete" onclick="delete_room(<?php echo $RID;?>)" class="btn btn_DELETE">

        </div>

      </div>

    </div>

                

             

  <?php

    }

  ?>



  </div></div>

<!-- SIDE POPUP DIV END -->



  	

    <div class="Container" id="Container">

      <div class="Header dropshadow" id="Header">

      <div class="navmanu" id="navmanu" style = "position: absolute; right: 0; top: 0; background-color: #fff; z-index:+1;">

      </div>

      <div class="Logo" id="Logo">

        <img src="Media/Logo1.png" width="215" height="69" alt=""/>

      </div>

    </div>



    

   <!--  <div class="Content" id="Content">



       Slider -->



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

      <div class="Rooms" id="Rooms"></div>



      <div id="Tool">

		    <div class="caorusel">

          <div class="slider">

               

            <section class="section2">

              <div class="sc_page2">

                <div class="sc_page2_title">Add new room</div>

                  <div class="row">

                    <div class="seg col-md-3">

                      <div class="formblock"><label for="room_name">Enter the Room name*</label><br>

                      <input type="text" id="room_name" name ="room_name" class="inputic1" placeholder="Living room, Bathroom, etc..." required></div>

                    </div>



                    <div class="seg col-md-9">

                        Please add the room name. <br>We recomand you to use standard room nameing (Leaving room, sleeping room, etc...), <br> so that your end report looks beter.

                    </div>

                  </div>

                  <!-- end row -->



                  <div class="row">

                    <div class="seg col-md-3">

                      <div class="formblock">

                        <label for="room_S-Walls">Enter total wall surface (m2)*</label>

                        <br>

                        <input type="text" id="room_S-Walls" name ="room_S-Walls" class="inputic1" placeholder="Total wall surface (m2)" required>

                      </div>

                    </div>



                    <div class="seg col-md-4">

                      <iframe class="iframe1" src="Model1_Walls.html" width="360" height="144" scrolling="no"></iframe>

                    </div>

                    <div class="seg col-md-5">

                      Please measure the total surface of external walls in this room. Surface should be entered in square meters only for wall surface without doors and windows. (only green surface in the model on the left). Enter the value in form field on the left.

                    </div>

                  </div>

                  <!-- end row -->



                  <div class="row">

                    <div class="seg col-md-3">

                      <div class="formblock">

                        <label for="room_S-Floor">Enter floor surface (m2)*</label>

                        <br>

                        <input type="text" id="room_S-Floor" name ="room_S-Floor" class="inputic1" placeholder="Floor surface (m2)" required>

                      </div>

                      <br><br>

                    </div>



                    <div class="seg col-md-4">

                      <iframe class="iframe1" src="Model2_Floor.html" width="360" height="144" scrolling="no"></iframe>

                    </div>

                    <div class="seg col-md-5">

                      Measure the surface of the floor in the room. Please add the value in form field on the left. Surface value should be added in square meters.

                    </div>

                  </div>

                  <!-- end row -->



                  <div class="row">

                      <div class="seg col-md-3 ">

                        <div class="formblock"><label for="room_S-ceiling">Enter ceiling surface (m2)*</label><br>

                            <input type="text" id="room_S-ceiling" name ="room_S-ceiling" class="inputic1" placeholder="Ceiling surface (m2)" required>

                          </div>

                        </div>



                      <div class="seg col-md-4 ">

                      <iframe class="iframe1" src="Model3_Ceiling.html" width="360" height="144" scrolling="no"></iframe>

                      </div>

                      <div class="seg col-md-5 ">

                      Measure the surface of the ceiling in the room. Please add the value in form field on the left. Surface value should be added in square meters.

                      </div>

                  </div>

                  <!-- end row -->



                  <div class="row">

                      <div class="seg col-md-3 ">

                      <div class="formblock"><label for="room_S-Windows">Enter total windows surface (m2)*</label><br>

                          <input type="text" id="room_S-Windows" name ="room_S-Windows" class="inputic1" placeholder="Total windows surface (m2)" required></div>

                      </div>



                      <div class="seg col-md-4 "><iframe class="iframe1" src="Model3_Windows.html" width="350" height="144" scrolling="no">



                      </iframe>

                      </div>

                      <div class="seg col-md-5 ">

                            Please measure surface of the windows in the room (together with balcony doors). Enter the value in the form field. Surface should be entered in square meters.

                      </div>

                  </div>

                  <!-- end row -->



                  <div class="row">

                      <div class="seg col-md-3 ">

                      <div class="formblock"><label for="room_S-Doors">Enter total Doors surface (m2)*</label><br>

                          <input type="text" id="room_S-Doors" name ="room_S-Doors" class="inputic1" placeholder="Total Doors surface (m2)" required></div>

                    </div>



                    <div class="seg col-md-4 "><iframe class="iframe1" src="Model3_Dors.html" width="350" height="144" scrolling="no">



                    </iframe>

                      </div>

                      <div class="seg col-md-5 ">

                            Please measure the surface of the doors in the room. (balcony doors should be counted as windows). Enter the value in the form field. Surface should be entered in square meters.

                      </div>

                  </div>

                  <!-- end row -->



                  <div class="row">

                    <div class="seg col-md-3 ">

                      <div class="formblock"><label for="room_Temp-out">Min. Expected temperature outside (c)*</label><br>

                          <input type="text" id="room_Temp-out" name ="room_Temp-out" class="inputic1" placeholder="Please add value in c" required></div>

                    </div>



                    <div class="seg col-md-9 ">Here you should enter the minimum expected temperature that can be outside<br>You can check some historical data on this. <br> (For example "-12c")

                    </div>

                  </div>

                  <!-- end row -->



                  <div class="row">

                      <div class="seg col-md-3 ">

                      <div class="formblock"><label for="room_Temp-in">Desired temperature inside (c)</label><br>

                          <input type="text" id="room_Temp-in" name ="room_Temp-in" class="inputic1" placeholder="Please add value in c" required></div>

                    </div>



                    <div class="seg col-md-9 ">In this field please enter the maximum desired temperature inside this room.<br>(Best proposed 23c).

                    </div>

                  </div>

                  <!-- end row -->



                  <div class="row">

                      <div class="seg col-md-3 ">

                      <div class="formblock"><label for="room_Temp-in">The room lies on:</label><br>

                                <select id="Podloga" class="inputic1" name="FloorT" placeholder="Case" style="height: 30px;">

                                  <option value="select">Select</option>

                                  <option value="Floor on ground">Floor on ground</option>

                                  <option value="Floor above heated room">Floor above heated room</option>

                                  <option value="Floor above not heated room">Floor above not heated room</option>

                                  </select>

                      </div><br>

                      <div class="formblock"><label for="room_Temp-in">The room lies under:</label><br>

                              <select id="Iznadsobe" class="inputic1" name="CeilingT" placeholder="Case" style="height: 30px;">

                              <option value="select"selected>Select</option>

                              <option value="Heated room">Heated room</option>

                              <option value="Not heated room">Not heated room</option>

                              </select>

                      </div>

                    </div>



                    <div class="seg col-md-9 ">Please select if this room is on ground or on floor above other room.<br>

                    </div>

                  </div>

                  <!-- end row -->



                  <div class="row">

                      <div class="seg col-md-3 ">

                      <div class="formblock"><label for="room_Temp-in">Ventilation in the room</label><br>

                                <select id="Ventilacija" class="inputic1" name="VentT" placeholder="Case" style="height: 30px;">

                                  <option value="select" selected>Select</option>

                                  <option value="Nat">Natural ventilation</option>

                                  <option value="Mech">Mechanical ventilation</option>

                                  </select>

                          </div>

                    </div>



                    <div class="seg col-md-9 ">Please select the ventilation in the room.<br>Natural ventilation stands for usual "open window" ventilation.<br>Mechanical ventilation stands for using "pype" ventilation systems only.

                    </div>

                  </div>

                  <!-- end row -->



                  <div class="row">

                      <div class="seg col-md12">

                      <div class="formblock"><label for="btn_NEXT1">Go to the next section</label><br>

                          <button type="submit" onclick="init1()" name="" value="" id="btn_NEXT1" class="btn_NEXT1">NEXT</button>

                      </div>

                      </div>

                      <div class="seg col-md-9"><p style="color: red; font-weight: bold; font-family:'Ubuntu', sans-serif; vertical-alignment: middle;" id="errorMessage" hidden></p>

                    </div>

                  </div>

                  <!-- end row -->

                </div>

              </div>

            </section>

            

            

            <section class="section3 hide" >

              <div class="sc_page2">

                <div class="row">

                  <div class="sc_page2_title col-md-12">Calculate U/R value</div>



                  <div class="sc_page1_desc col-md-12">Here we will calculate U-value for walls, floor and ceiling. U-Value for doors and windows You can get from the manufacturer and include in calculation. Othervise, You can leave the fields for doors and windows emphty. For windows, You can use some of the standard values for a certain type of window.
                  <br><br></div>

                </div>  

                <!-- end row -->



                <div class="row">

                    <div class="seg col-md-4">

                    <div id="dynamic_field">

                      <h2>Add thickness of wall material</h2>

                      <div class="form-row" >

                          <div class="col">



                      <select id="selection1" class="inputic1 mat" name="durchgefuhrte_arbeiten[]">

                      <?php echo $options; ?>

                      </select>

                            

                          </div>

                          <div class="col"><div class= "munit">

                              <input type="text" id= "tic1" class="inputic1 tic" name="von[]" placeholder="Tickness"><h3>mm</h3></div>

                          </div>

                          <div class="col-2">

                              <td><button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button></td>

                          </div>

                      </div>

                  </div>

                  </div>

                  <div class="seg col-md-8">

                  <iframe class="iframe1" src="Wall_layers/Model4_Wall_layers.html" style="width: 100%;" height="288px" scrolling="yes"></iframe>

                 </div> 

                </div>  

                <!-- end row -->

                <div class="row">

                    <div class="seg col-md-4">

                      <div id="dynamic_field2">

                          <h2>Add thickness of floor material</h2>

                          <div class="form-row">



                              <div class="col">



                              <select id="selection2" class="inputic1 mat" name="mange[]"><?php echo $options; ?></select>



                              </div>

                              <div class="col"><div class= "munit">

                                  <input type="text" id= "tic2" class="inputic1 tic" name="bezeichnung[]" placeholder="Tickness"><h3>mm</h3></div>

                              </div>

                              <div class="col-2">

                                  <td><button type="button" name="add" id="add2" class="btn btn-success"><i class="fa fa-plus"></i></button></td>

                              </div>

                          </div>

                      </div>

                    </div>

                    <div class="seg col-md-8"><iframe class="iframe1" src="Model4_Floor_layers.html?12" style="width: 100%;" height="288" scrolling="yes"></iframe></div>

                </div>    

                <!-- end row -->

                <div class="row">

                    <div class="seg col-md-4">

                      <div id="dynamic_field3">

                          <h2>Add thickness of ceiling material</h2>

                          <div class="form-row">

                              <div class="col">

                              <select id="selection3" class="inputic1 mat" name="offene_pukte[]"><?php echo $options; ?></select>

                              </div>

                              <div class="col"><div class= "munit">

                                  <input type="text" id= "tic3" class="inputic1 tic" name="intern[]" placeholder="Tickness"><h3>mm</h3></div>

                              </div>



                              <div class="col-2">

                                  <td><button type="button" name="add" id="add3" class="btn btn-success"><i class="fa fa-plus"></i></button></td>

                              </div>

                          </div>

                      </div>

                    </div>

                    <div class="seg col-md-8"><iframe class="iframe1" src="Ceiling_layers/Model4_Ceiling_layers.html?12" style="width:100%" height="288" scrolling="yes"></iframe></div>

                </div>  

                <!-- end row -->

                <div class="row">

                    <div class="seg col-md-4">

                      <div id="dynamic_field2">

                        <div class="form-row">

                          <div class="col"><h2>U value Doors</h2>

                            <input type="text" id="doorsu" class="inputic1 mat" name="doorsu" placeholder="Doors type/Material">

                          </div>

                          <div class="col">

                            <!--<h2>Tickness</h2>

                            <input type="text" id="doorst" class="inputic1 tic" name="doorst" placeholder="U-value">-->

                          </div>

                        </div>

                      </div>

                    </div>



                    <div class="seg col-md-8">

                      U-value for your doors you can get from the manufacturer. <br> If you are not able to find it, please leave the field emphty. <br> Standard averige value will be taken in count. <br> (not affecting significatlly the end result)

                    </div>

                  </div>

                </div> 

                <!-- end row -->



                <div class="row">

                  <div class="seg col-md-4">

                    <div id="dynamic_field2">

                      <div class="form-row">

                        <div class="col"><h2>U value Windows</h2>

                          <input type="text" id="windowsu" class="inputic1 mat" name="Windowsu" placeholder="Windows type/Material">

                        </div>

                        <div class="col">

                          <!--<h2>Tickness</h2>

                          <input type="text" id="windowst" class="inputic1 tic" name="Windowst" placeholder="U-value">-->

                        </div>

                      </div>

                    </div>

                  </div>

                  <div class="seg col-md-8">

                    U-value for your windows you can get from the manufacturer.

                    <br>

                    If you are not  able to find it, please add one of the standard values from below.

                    <br>
                    <br>

                    <table style="width: 400px; border: 1px solid gray; padding-left: 5px; text-align: left;"><tr style="border: 1px solid gray; padding-left: 5px;"><td style="padding-left: 5px;"> Single Glazing</td><td style="padding-left: 5px;">5.2</td></tr><tr style="border: 1px solid gray; padding-left: 5px;"><td style="padding-left: 5px;"> Double Glazing</td><td style="padding-left: 5px;">2.6</td></tr><tr style="border: 1px solid gray; padding-left: 5px;"><td style="padding-left: 5px;"> Secondary Glazing </td><td style="padding-left: 5px;">2.7</td></tr><tr style="border: 1px solid gray; padding-left: 5px;"><td style="padding-left: 5px;"> Triple Glazing </td><td>0.7 or 0.8</td></tr></div></table>

                  </div>   

                </div>  

                <!-- end row -->



                <div class="row">

                  <div class="seg col-md-4">

                    <div id="dynamic_field2">

                      <div class="form-row">

                          <div class="col">

                            <h2>Go to the next section</h2>

                            <button name="" value="" id="btn_NEXT2" class="btn_NEXT1">NEXT</button>

                          </div>

                          <div class="col">

                            <!--<h2>Tickness</h2>

                            <input type="text" id="windowst" class="inputic1 tic" name="Windowst" placeholder="U-value">-->

                          </div>

                        </div>

                    </div>

                  </div>

                  

                  <div class="seg col-md-8">

                    <p style="color: red; font-weight: bold; font-family:'Ubuntu', sans-serif; vertical-alignment: middle;" id="errorMessage2" hidden></p>

                    <br>

                  </div>  

                

                </div>

              </div>

            </section>



            <section class="section4 hide">

              <div class="sc_page2">

                <div class="sc_page2_title">Radiators</div>



                <div class="sc_page1_desc">

                  In this section you can find out if your current radiator system is sufficient enough to cover heat loss in this room. <br>If you are planning new installation, here you can calculate the size of the radiators needed for your system to be heat pump ready. <br><br>Please choose "Existing" or "New Installation" option from below. <br>You can also add data in both of these sections if you would like to check two scenarios.<br><br>If you don't use radiators in this room, just add new room or complete calculation.

                </div>



                <div class="RadioBox">

                  <div class= "formblock2">

                  <label for="radio1">Existing instalation</label><br>

                  <button onclick="show1()" class="btn_radio" name="radiobtn" id="radio1" value=""></button>

                  </div>

                  <div class= "formblock2">

                  <label for="radio2">New instalation</label><br>

                  <button onclick="show2()" class="btn_radio" name="radiobtn" id="radio2" value=""></button>

                  </div>

                  <!--<button onclick="show3()" id="btn_SKIP3" class="btn_NEXT1">SKIP</button>-->

                </div>



                <div class="room_container1" id= "sec4">

                  <div class="CalcHold clearfix">

                    <div id="rad1">

                      <div class="calc calc1">

                        <div id="dynamic_field2">

                          <div class="form-row2">

                            <div class="col"><h2>Radiator type</h2>

                              <select id="radt" class="inputic1 mat1" name="radiatorT" placeholder="Type" style="height: 30px;"

                              >

                                <option value="select">Select Type</option>

                                <option value="T11">T11</option>

                                <option value="T21">T21</option>

                                <option value="T22">T22</option>

                                <option value="T33">T33</option>

                              </select>

                            </div>

                            <br>

                            <div class="col"><h2>Radiator surface</h2>

                              <input type="text" id="rads" class="inputic1 tic1" name="radiatorS" placeholder="(height * width)" style="height: 30px;">

                          </div>

                        </div>

                      </div>

                    </div>

                    <div class="dis dis1">

                      Select the radiator type and add the combined surface of all radiators in square meters.<br>

                      Below you can find the most common radiator types so you can recognize which tipe you have.

                      <br><br><br>

                      <img src="images/Radiator-Types-263x300.png" alt="">

                    </div>

                  </div>

                  <div class="CalcHold clearfix">

                    <div id="rad2">

                      <div class="calc calc1">

                        <div id="dynamic_field2">

                          <div class="form-row2">

  

                            <div class="col"><h2>Radiator type</h2>

                              <select id="radt2" class="inputic1 mat1" name="radiatorT2" placeholder="Type">

                                <option value="select">Select Type</option>

                                <option value="T11">T11</option>

                                <option value="T21">T21</option>

                                <option value="T22">T22</option>

                                <option value="T33">T33</option>

                              </select>

                            </div>

                            <br>

                          </div>

                        </div>

                      </div>

                      <div class="dis dis1">

                        Below you can find the most common radiator types. Please note: Rad type 22 or 23 putout more power for the same radiator surface but are significantly thicker. Most common type that people choose is 22.

                        <br><br><br>

                        <img src="images/Radiator-Types-263x300.png" alt="">

                      </div>

                    </div>

                  </div>

                  <div class="CalcHold clearfix">

                    <div id = "rad3">

                      <div class="">

                        <div class="formblock">

                          <button type="submit" name="" value="" id="btn_NEWR" class="btn_NEXT1 m-2">ADD NEW ROOM</button>

                          <button id="btn_COMPLETE1" class="btn_NEXT1 m-2">COMPLETE CALCULATION</button>

                        </div>

                      </div>

                

                    </div>

                  </div>

                </div>

              </div>

            </section>

               

            <section class="section5 hide" >

                <div class="sc_page2">

                  <div class="sc_page2_title">Complete calculation</div>

                  <div class="sc_page1_desc">Please provide a few additional information before submiting.</div>

                <div class="">



               <form action="Report.php" method="POST">



                  <div class="seg seg93">

                    <div class="formblock"><label for="room_name">What is your current heating solution?</label><br>

                    <input type="text" id="current_solution" name ="current_solution" class="inputic1" placeholder="Natural gass, Electricity, etc..."></div>

                  </div>

    

                  <div class="seg seg93">

                   <div class="formblock"><label for="room_S-Walls">What is your prefered Heating pump system?</label><br>

                   <select id="PumpSystemType" class="inputic1" name="PumpSystemType" placeholder="Type">

                                    <option value="select">Choose</option>

                                    <option value="Monoblock">Monoblock</option>

                                    <option value="Split">Split</option>

                                  </select>

                                </div>

                  </div>

    

                 <!-- <div class="seg seg94"></div>--> 

    

                  <div class="seg seg95">

                   <div class="formblock"><label for="room_S-Floor">Do you have a favorite heating pump producer?</label><br>

                   <select id="PumpProducer" class="inputic1" name="PumpProducer" placeholder="Type">

                                    <option value="select">Choose</option>

                                    <option value="Samsung">Samsung</option>

                                    <option value="Panasonic">Panasonic</option>

                                    <option value="LG">LG</option>

                                    <option value="Mitsubishi Electric">Mitsubishi Electric</option>

                                    <option value="Johnson Contrls">Johnson Contrls</option>

                                    <option value="Daikin">Daikin</option>

                                    <option value="Carrier Corporation">Carrier Corporation</option>

                                    <option value="TRANE">TRANE</option>

                                    <option value="Danfoss Power Solutions Co.">Danfoss Power Solutions Co.</option>

                                    <option value="Ingersoll-Rand">Ingersoll-Rand</option>

                                    <option value="Vaillant">Vaillant</option>

                                    <option value="Lennox International">Lennox International</option>

                                    <option value="NIBE Industrier AB">NIBE Industrier AB</option>

                                    <option value="Dimplex">Dimplex</option>

                                    <option value="Calorex">Calorex</option>

                                    <option value="Kensa">Kensa</option>

                                    <option value="Xylem">Xylem</option>

                                    <option value="RHEEM">RHEEM</option>

                                    <option value="GOODMAN">GOODMAN</option>

                                    <option value="Griffith & Petz">Griffith & Petz</option>

                                    <option value="Viessmann">Viessmann</option>

                                    <option value="Bosch">Bosch</option>

                                    <option value="Midea">Midea</option>

                                  </select>

                                </div>

                  </div>

    

                  <!-- <div class="seg seg96"></div>--> 

    

                  <div class="seg seg97">

                   <div class="formblock"><label for="room_S-ceiling">How much you have been spending on heating per year so far?</label><br>

                        <input type="text" id="AmounthSpent" name ="AmounthSpent" class="inputic1" placeholder="">

                        <select id="currency" class="inputic1" name="currency" placeholder="Type">

                                    <option value="EUR">EUR</option>

                                    <option value="AUD">AUD</option>

                                    <option value="CAD">CAD</option>

                                    <option value="DKK">DKK</option>

                                    <option value="SEK">SEK</option>

                                    <option value="CHF">CHF</option>

                                    <option value="USD">USD</option>

                                    <option value="BAM">BAM</option>

                                    <option value="NOK">NOK</option>

                                    <option value="GBP">GBP</option>

                                    <option value="RUR">RUR</option>

                                    <option value="TRY">TRY</option>

                                    <option value="HRK">HRK</option>

                                    <option value="HUF">HUF</option>

                                    

                                  </select></div>

                  </div>

                  

    

                 <!-- <div class="seg seg98"></div>--> 

                  

    

                  <div class="seg seg99">

                   <div class="formblock"><label for="btn_NEXT1"></label><br>

                    <button id="btn_REPORT" class="btn_NEXT1" name="btn_REPORT">Go to report</button>

                  </div></div>

                  <!--<div class="seg seg918"></div>--> 

              

              </form>



                </div>

              </div>

    </section>



            </div>

            

          </div>



          </div>

          <div class="controls">

            <ul>

               <li id="li1" class="selected"></li>

               <li id="li2">Object details</li>

               <li id="li3">U/R value</li>

               <li id="li4">Radiators</li>

               <li id="li5">Submit</li>

            </ul>

         </div>

		</div>



      <!-- <div class="Footer dropshadow" id="Footer">FOOTER CONTENT</div>--> 



    </div></div>

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



<!-- Popup ROOMS js --> 

<script>document.querySelector(".side-panel-toggle").addEventListener("click", () => {

  document.querySelector(".wrapperP").classList.toggle("side-panel-open");

});</script>



<script>document.querySelector("#btn_SKIP3").addEventListener("click", () => {

  $("#sec4").load(window.location.href + " #sec4");

});</script>





  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 

	<script src="js/jquery-3.4.1.min.js"></script>



	<!-- Include all compiled plugins (below), or include individual files as needed -->

	<script src="js/popper.min.js"></script> 

  <script src="js/bootstrap-4.4.1.js"></script>

  <script src="Tool.js"></script>

  <script src="ToolR.js"></script>



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