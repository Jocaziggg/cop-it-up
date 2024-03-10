<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'connect.php';



//echo $_POST['sel1'];



/*
$calcIdrequest = "";
$calcId = "";
$roomName = "";
$WallSurface = "";
$FloorSurface = "";
$CeilingSurface = "";
$WindowsSurface = "";
$DoorsSurface = "";
$TempOut = "";
$TempIn = "";
$DeltaT= "";
$kur = 0;
$userip = "";
$id= "";

/*if(isset($_REQUEST["ip"])){

    $userip = $_POST["ip"];

    try {
        $select = "SELECT ID FROM Users WHERE IP_Address = '$userip'";
        $res = mysqli_query($link, $select);
        $count = mysqli_num_rows($res);
         //echo $count;
        // $kur = 0;

         if($count > $kur){
            $row = $res -> fetch_assoc();
            $id=$row['ID'];
}}}*/


if(isset($_POST['roomName'])){
    
    $roomName = $_POST['roomName'];
    $WallSurface = $_POST['wallSurface'];
    $FloorSurface = $_POST['floorSurface'];
    $CeilingSurface = $_POST['ceilingSurface'];
    $WindowsSurface = $_POST['windowsSurface'];
    $DoorsSurface = $_POST['doorsSurface'];
    $TempOut = $_POST['tempOut'];
    $TempIn = $_POST['tempIn'];
    $userip = $_POST['ip'];

    $doors_u = $_POST['doorsU'];
    /*$doors_t= $_POST['doorsT'];*/
    $windows_u = $_POST['windowsU'];
    /*$windows_t= $_POST['windowsT'];*/

    $rad_t1= $_POST['radiatorT1'];
    $rad_t2= $_POST['radiatorT2'];
    $rad_s1= $_POST['radiatorS1'];

    $vons=$_REQUEST['vons'];
    $durchgefuhrteArbeitens=$_REQUEST['durchgefuhrteArbeitens'];
    $bezeichnung=$_REQUEST['bezeichnung'];
    $mange=$_REQUEST['mange'];
    $offenepukte=$_REQUEST['offenepukte'];
    $intern=$_REQUEST['intern'];
    $Podloga=$_REQUEST['Podloga'];
    $IznadSobe=$_REQUEST['IznadS'];
    $Vent=$_REQUEST['Ventilacija'];



   /* echo $doors_u;
    echo $doors_T;
    echo $windows_u;
    echo $windows_t;


    foreach ($offenepukte as $key => $value ) {
        echo "Material:". $offenepukte[$key].", ";
        echo "Tickness:". $intern[$key].", ";

    }}*/

   /* $selection1 = $_POST['sel1'];
    $selection2 = $_POST['sel2'];
    $selection3 = $_POST['sel3'];
    $tickness1 = $_POST['tickn1'];
    $tickness2 = $_POST['tickn2'];
    $tickness3 = $_POST['tickn3'];

    $WindL = $_POST['WL'];
    $WindLT = $_POST['WLT'];
    $DoorL = $_POST['DL'];
    $DoorLT = $_POST['DLT'];*/

    $wallmat = "Walls";
    $floormat = "Floor";
    $ceiling = "Ceiling";
    $windows = "Windows";
    $door= "Doors";

    $HeatedArea = "";
    $DeltaT = "";

    $ex_Floor = "";
    $in_Floor = "";

    /*
    $roomIdquery = "";
    $roomId = "";
    $Cid = "";
    $id = "";
    $conductivity1 = "":
    $resistance1= "";
    $conductivity2 = "":
    $resistance2 = "";
    $conductivity3 = "":
    $resistance3= "";
    $conductivity4 = "":
    $resistance4= "";
    $conductivity5 = "":
    $resistance5= "";*/
 
    

    try {

        $select = "SELECT ID FROM Users WHERE IP_Address = '$userip'";
        $res = mysqli_query($link, $select);
        $count = mysqli_num_rows($res);
         //echo $count;
         $kur = 0;

         if($count > $kur){
            $row = $res -> fetch_assoc();
            $id=$row['ID'];


        $calcIdrequest = "SELECT MAX(ID) FROM Calculations WHERE User_id = '$id'";
        $calcId = mysqli_query($link, $calcIdrequest);
        $DeltaT= $TempIn - $TempOut;

        
         if(!empty($calcId)){
            $row = $calcId -> fetch_assoc();
            $Cid=$row['MAX(ID)'];
            //mysqli_query($link, "INSERT INTO Rooms (Calc_id, User_id) VALUES ('$Cid', '$id')");
            mysqli_query($link, "INSERT INTO Rooms (Calc_id, User_id, Room_name, Surface_Walls, Surface_Flor, Surface_Ceiling, Surface_Windows, Surface_Doors , DeltaT, Vent_Selection) 
                        VALUES ('$Cid', '$id', '$roomName', '$WallSurface', '$FloorSurface', '$CeilingSurface', '$WindowsSurface', '$DoorsSurface', '$DeltaT', '$Vent')");
            

            if($Cid > $kur){
            $roomIdquery = "SELECT ID FROM Rooms WHERE Calc_id = '$Cid' AND Room_name = '$roomName'";
            $roomId = mysqli_query($link, $roomIdquery);

            $c1select = "SELECT CValue FROM Materials WHERE Material = '$durchgefuhrteArbeitens[0]'";
            $c1query = mysqli_query($link, $c1select);

            if(!empty($roomId)){
                $row = $roomId -> fetch_assoc();
                $rmid=$row['ID'];
            
            foreach($durchgefuhrteArbeitens as $key => $value){

            $c1select = "SELECT CValue FROM Materials WHERE Material = '$durchgefuhrteArbeitens[$key]'";
            $c1query = mysqli_query($link, $c1select);
            $rowc1= $c1query -> fetch_assoc();
            $conductivity1 =$rowc1['CValue'];

            if(!empty($vons[$key]) && !empty($conductivity1)){
                $resistance1 = $vons[$key]/(1000*$conductivity1);
                $uvaluewall = 1/$resistance1;
            }
            

              mysqli_query($link, "INSERT INTO U_Value_Entry (User_id, Room_id, Surface, Layer, Tickness, Conductivity, Resistance, U_Value, Calc_id)
                VALUES ('$id', '$rmid', '$wallmat', '$durchgefuhrteArbeitens[$key]', '$vons[$key]', '$conductivity1', '$resistance1', '$uvaluewall', '$Cid')");
            
            }
            foreach($mange as $key => $value){

                $c2select = "SELECT CValue FROM Materials WHERE Material = '".$mange[$key]."'";
                $c2query = mysqli_query($link, $c2select);
                $rowc2= $c2query -> fetch_assoc();
                $conductivity2 =$rowc2['CValue'];

                if(!empty($bezeichnung[$key]) && !empty($conductivity2)){
                $resistance2 = $bezeichnung[$key]/(1000*$conductivity2);
                $uvaluefloor = 1/$resistance2;
                }
                
                  mysqli_query($link, "INSERT INTO U_Value_Entry (User_id, Room_id, Surface, Layer, Tickness, Conductivity, Resistance, U_Value, Calc_id)
                    VALUES ('$id', '$rmid', '$floormat', '$mange[$key]', '$bezeichnung[$key]', '$conductivity2', '$resistance2', '$uvaluefloor', '$Cid')");
                
            }
            foreach($offenepukte as $key => $value){

                $c3select = "SELECT CValue FROM Materials WHERE Material = '".$offenepukte[$key]."'";
                $c3query = mysqli_query($link, $c3select);
                $rowc3= $c3query -> fetch_assoc();
                $conductivity3 =$rowc3['CValue'];

                if(!empty($intern[$key]) && !empty($conductivity3)){
                    $resistance3 = $vons[$key]/(1000*$conductivity3);
                    $uvaluewindow = 1/$resistance3;
                }
    
                  mysqli_query($link, "INSERT INTO U_Value_Entry (User_id, Room_id, Surface, Layer, Tickness, Conductivity, Resistance, U_Value, Calc_id)
                    VALUES ('$id', '$rmid', '$ceiling', '$offenepukte[$key]', '$intern[$key]', '$conductivity3', '$resistance3', '$uvaluewindow', '$Cid')");
                
            }

            
            if(!empty($doors_u)){
                
                mysqli_query($link, "INSERT INTO U_Value_Entry (User_id, Room_id, Surface, Layer, U_Value, Calc_id)
                    VALUES ('$id', '$rmid', '$door', '$door', '$doors_u', '$Cid')");

            }else{
                $doors_u = 2;
                
                mysqli_query($link, "INSERT INTO U_Value_Entry (User_id, Room_id, Surface, Layer, U_Value, Calc_id)
                    VALUES ('$id', '$rmid', '$door', '$door', '$doors_u', '$Cid')");
            }

            if(!empty($windows_u)){
            
                mysqli_query($link, "INSERT INTO U_Value_Entry (User_id, Room_id, Surface, Layer, U_Value, Calc_id)
                VALUES ('$id', '$rmid', '$windows', '$windows', '$windows_u', '$Cid')");

            }else{
                $windows_u = 2;
                
                mysqli_query($link, "INSERT INTO U_Value_Entry (User_id, Room_id, Surface, Layer, U_Value, Calc_id)
                VALUES ('$id', '$rmid', '$windows', '$windows', '$windows_u', '$Cid')");
            }    
    
            
            
            if(!empty($uvaluewall)){
                $SelectRW = "SELECT SUM(Resistance) FROM U_Value_Entry WHERE Room_id = '$rmid' AND Surface = 'Walls'";
                $queryRW = mysqli_query($link, $SelectRW);
                $rowRW= mysqli_fetch_assoc($queryRW);
                $T_RWall = $rowRW['SUM(Resistance)'];
                mysqli_query($link, "UPDATE Rooms SET R_Walls= '$T_RWall' WHERE ID= '$rmid'");
            }
        
            if(!empty($uvaluefloor)){
                $SelectUF = "SELECT SUM(Resistance) FROM U_Value_Entry WHERE Room_id = '$rmid' AND Surface = 'Floor'";
                $queryUF = mysqli_query($link, $SelectUF);
                $rowUF= $queryUF -> fetch_assoc();
                $T_UFloor = $rowUF['SUM(Resistance)'];
                mysqli_query($link, "UPDATE Rooms SET R_Floor= '$T_UFloor' WHERE ID= '$rmid'");
            }

            if(!empty($uvaluewindow)){
                $SelectUC = "SELECT SUM(Resistance) FROM U_Value_Entry WHERE Room_id = '$rmid' AND Surface = 'Ceiling'";
                $queryUC = mysqli_query($link, $SelectUC);
                $rowUC= $queryUC -> fetch_assoc();
                $T_UCeiling = $rowUC['SUM(Resistance)'];
                mysqli_query($link, "UPDATE Rooms SET R_Ceiling= '$T_UCeiling' WHERE ID= '$rmid'");
            }


            if($Podloga == "Floor on ground"){
                $ex_Floor = 0;
                $in_Floor = 0.14;
            }else {
                $ex_Floor = 0.06;
                $in_Floor = 0.14;
            }

            $U_Val_Walls = 1/($T_RWall + 0.12 + 0.04);
            mysqli_query($link, "UPDATE Rooms SET U_Walls= '$U_Val_Walls' WHERE ID= '$rmid'");

            $U_Val_Floor = 1/($T_UFloor + $ex_Floor + $in_Floor);
            mysqli_query($link, "UPDATE Rooms SET U_Floor= '$U_Val_Floor' WHERE ID= '$rmid'");

            $U_Val_Ceiling = 1/($T_UCeiling + 0.1 + 0.04);
            mysqli_query($link, "UPDATE Rooms SET U_Ceiling= '$U_Val_Ceiling' WHERE ID= '$rmid'");

            mysqli_query($link, "UPDATE Rooms SET U_Door= '$doors_u' WHERE ID= '$rmid'");
            mysqli_query($link, "UPDATE Rooms SET U_Window= '$windows_u' WHERE ID= '$rmid'");



            if(!empty($uvaluewall)){
                $SelectTW = "SELECT (Surface_Walls * U_Walls * DeltaT) FROM Rooms WHERE ID = '$rmid'";
                $queryTW = mysqli_query($link, $SelectTW);
                $rowTW= $queryTW -> fetch_assoc();
                $T_TWall = $rowTW['(Surface_Walls * U_Walls * DeltaT)'];
                mysqli_query($link, "UPDATE Rooms SET T_Loss_Wall = '$T_TWall' WHERE ID= '$rmid'");
            }

            if(!empty($uvaluefloor)){
                $SelectTF = "SELECT (Surface_Flor * U_Floor * DeltaT) FROM Rooms WHERE ID = '$rmid'";
                $queryTF = mysqli_query($link, $SelectTF);
                $rowTF= $queryTF -> fetch_assoc();
                $T_TFloor = $rowTF['(Surface_Flor * U_Floor * DeltaT)'];
                mysqli_query($link, "UPDATE Rooms SET T_Loss_Floor = '$T_TFloor' WHERE ID= '$rmid'");
            }

            if(!empty($uvaluewindow)){
                $SelectTC = "SELECT (Surface_Ceiling * U_Ceiling * DeltaT) FROM Rooms WHERE ID = '$rmid'";
                $queryTC = mysqli_query($link, $SelectTC);
                $rowTC= $queryTC -> fetch_assoc();
                $T_TCeiling = $rowTC['(Surface_Ceiling * U_Ceiling * DeltaT)'];
                mysqli_query($link, "UPDATE Rooms SET T_Loss_Ceiling = '$T_TCeiling' WHERE ID= '$rmid'");
            }

            if(!empty($doors_u)){
                $SelectTD = "SELECT (Surface_Doors * U_Door * DeltaT) FROM Rooms WHERE ID = '$rmid'";
                $queryTD = mysqli_query($link, $SelectTD);
                $rowTD= $queryTD -> fetch_assoc();
                $T_Doors = $rowTD['(Surface_Doors * U_Door * DeltaT)'];
                mysqli_query($link, "UPDATE Rooms SET T_Loss_Door = '$T_Doors' WHERE ID= '$rmid'");
            }

            if(!empty($windows_u)){
                $SelectTWI = "SELECT (Surface_Windows * U_Window * DeltaT) FROM Rooms WHERE ID = '$rmid'";
                $queryTWI = mysqli_query($link, $SelectTWI);
                $rowTWI= $queryTWI -> fetch_assoc();
                $T_Windows = $rowTWI['(Surface_Windows * U_Window * DeltaT)'];
                mysqli_query($link, "UPDATE Rooms SET T_Loss_Window = '$T_Windows' WHERE ID= '$rmid'");
            }

            if(!empty($Podloga)){
                mysqli_query($link, "UPDATE Rooms SET Floor_Case = '$Podloga' WHERE ID= '$rmid'");
            }

            if(!empty($IznadSobe)){
                mysqli_query($link, "UPDATE Rooms SET Ceiling_Case = '$IznadSobe' WHERE ID= '$rmid'");
            }


            if($Podloga == 'Floor on ground' || $Podloga == 'Floor above not heated room' && $IznadSobe == 'Heated room'){

                $TTL = $T_TWall+$T_TFloor+$T_Doors+$T_Windows;
            }
            else if($Podloga == 'Floor on ground' || $Podloga == 'Floor above not heated room' && $IznadSobe == 'Not heated room'){

                $TTL = $T_TWall+$T_TFloor+$T_Ceiling+$T_Doors+$T_Windows;
            }
            else if($Podloga == 'Floor above heated room' && $IznadSobe == 'Not heated room'){

                $TTL = $T_TWall+$T_Ceiling+$T_Doors+$T_Windows;
            }
            else if($Podloga == 'Floor above heated room' && $IznadSobe == 'Heated room'){

                $TTL = $T_TWall+$T_Doors+$T_Windows;
            }
            else{$TTL = 1;}


            mysqli_query($link, "UPDATE Rooms SET T_Loss = '$TTL' WHERE ID = '$rmid'");



            if(!empty($TTL)){
                $SelectSurface = "SELECT Surface_Flor FROM Rooms WHERE ID = '$rmid'";
                $querySurface = mysqli_query($link, $SelectSurface);
                $rowSurface= $querySurface -> fetch_assoc();
                $HeatedArea = $rowSurface['Surface_Flor'];

                $SelectDT = "SELECT DeltaT FROM Rooms WHERE ID = '$rmid'";
                $queryDT = mysqli_query($link, $SelectDT);
                $rowDT= $queryDT -> fetch_assoc();
                $DeltaT = $rowDT['DeltaT'];
            }


            $Outdoor_Temp = 20-85*0.01*$DeltaT;
            $NV_Loss = 0.3 * $HeatedArea * $DeltaT;
            $MV_Loss = 1.21*$HeatedArea*0.1*$DeltaT+1.21*$HeatedArea*0.3*($Outdoor_Temp+12);

            $THL_NVent = $TTL+$NV_Loss;
            $THL_MVent = $TTL+$MV_Loss;



            $LETI_Wall = 0.15;
            $LETI_Ceiling = 0.12;

            if($Podloga == "Floor on ground"){
                $LETI_Floor = 0.1;
            }else {
                $LETI_Floor = 0.18;
            }


            mysqli_query($link, "UPDATE Rooms SET THL_NVent = '$THL_NVent',  THL_MVent = '$THL_MVent', N_Vent = '$NV_Loss', M_Vent = '$MV_Loss' WHERE ID= '$rmid'");



            if(!empty($rad_t1)){
                mysqli_query($link, "UPDATE Rooms SET Radiator1_Type= '$rad_t1', Radiator1_Surface= '$rad_s1' WHERE (User_id ='$id' AND Calc_id = '$Cid' AND ID= '$rmid')");
            }

            if (!empty($rad_t2)) {
                mysqli_query($link, "UPDATE Rooms SET Radiator2_Type= '$rad_t2' WHERE (User_id ='$id' AND Calc_id = '$Cid' AND ID= '$rmid')");
            }

        }



            echo "Radiators:". $rad_t1;
            echo "Radiators:". $rad_s1;
            foreach ($vons as $key => $value ) {
                echo "tickness:". $durchgefuhrteArbeitens[$key].", ";
                echo "mm:". $vons[$key]. " - ";
                echo "ROOM ID:". $rmid;
                echo "CONDUCTIVITY:". $conductivity1;
                echo "RESISTANCE:". $resistance1;
            }


         } 
        }
    }
} 
catch(Exception $e) {
    echo 'Message: ' .$e->getMessage();
  }


}

    /*try {*/
    //mysqli_query($link, "INSERT INTO Rooms (Calc_id, User_id) VALUES ('$calcId', '$id')");
   // mysqli_query($link, "INSERT INTO Rooms (Room_name, Surface_Walls, Surface_Flor, Surface_Ceiling, Surface_Windows, Surface_Doors /*, DeltaT*/) 
    //VALUES ('$roomName', '$WallSurface', '$FloorSurface', '$CeilingSurface', '$WindowsSurface', '$DoorsSurface' /*, '$DeltaT'*/)");
    /*echo $roomName;

}
/*catch(Exception $e) {
    echo 'Message: ' .$e->getMessage();
  }




 */
?>