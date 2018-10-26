<?php
  require("./Database.php");
  $q1 = $_POST['first']; $q2 = $_POST['second']; $q3 = $_POST['third'];
  $sql = "SELECT `id`, `first_name`, `middle_name`, `last_name` FROM doctors WHERE `first_name` LIKE '%$q1%' AND `middle_name` LIKE '%$q2%' AND  `last_name` LIKE '%$q3%' LIMIT 5";
  $db = new Database;
  $res = $db->resultset($sql);
  echo json_encode($res);
?>
