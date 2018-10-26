<?php
  require("./Database.php");
  //print_r($_POST);
  $apnum = $_POST["apnum"];
  $dob = $_POST["dob"];
  $doc = $_POST["doc"];
  $db = new Database;
  $res = $db->resultset("SELECT * FROM `appointments` WHERE `appointment_id` = '".$apnum."' AND `dob` = '".$dob."' AND doctor_id = ".$doc.";");
  if(count($res)){
    echo $res[0]["id"];
  }
  else echo "#";
?>
