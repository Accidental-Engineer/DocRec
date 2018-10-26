<?php
require("./Database.php");
  function generateRandomString($length = 16) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
  }
  $apnumber = generateRandomString();
  if($_POST){
    $num = count($_POST["symptoms"]);
    $sql = "INSERT INTO `appointments`
    (`appointment_id`, `doctor_id`,
      `patient_fullname`, `dob`, `mobile`,
       `email`, `address`";

    foreach ($_POST["symptoms"] as $key => $value) {
      $sql = $sql.", `".join("_", explode(" ", $value))."`";
    }
    $sql = $sql.") VALUES ('".$apnumber."', ".$_POST["doctor_id"].", '".$_POST["name"]."', ";
    $sql = $sql."'".$_POST["dob"]."', '".$_POST["mobile"]."', '".$_POST["email"]."', '".$_POST["address"]."'";
    for($i = 0; $i < $num; $i++){
      $sql = $sql.", 6";
    }
    $sql = $sql.");";
  }

  $db = new Database;
  $res = $db->execute($sql);
  if($res){
    echo $apnumber;
  }
  else echo "#";
?>
