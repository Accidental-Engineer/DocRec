<?php
  require("../scripts/Database.php");
  $sql = "UPDATE `appointments` SET ";
  foreach($_POST as $key => $val){
    $sql = $sql."`".$key."` = '".$val."', ";
  }
  $sql = $sql."`appointment_id` = '".$_POST["appointment_id"]."'";
  $sql = $sql." WHERE `appointment_id` = '".$_POST["appointment_id"]."'";
  $db = new Database;
  $db->execute($sql);
?>
