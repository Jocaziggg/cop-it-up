<?php
require "connect.php";


if(isset($_POST['hidID'])){

    $id = $_POST['hidID'];

    $query = "DELETE FROM Rooms WHERE ID = '$id'";
    $query_run = mysqli_query($link, $query);

    if($query_run){
        echo '<script> alert(Room is deleted) </script>';
    }
    else {
        echo '<script> alert(Room is not deleted) </script>';
    }
}