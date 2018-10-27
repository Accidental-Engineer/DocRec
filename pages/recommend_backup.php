<?php
require("../scripts/Database.php");
include "../scripts/parseCategoricalData.php";
//$sql = "SELECT *, (sum(`fatigue`)*1+sum(`headache`)*1+sum(`infection`)*0+sum(`abdominal_pain`)*1+sum(`abdominal_pain`)*0)/(3*(power(sum(`fatigue`),2)+power(sum(`headache`),2)+power(sum(`infection`),2)+power(sum(`abdominal_pain`),2)+power(sum(`abdominal_pain`),2)))  as s froM `appointments` Group by `doctor_id` order by s desc";
$sq = "";
$count = 0;
foreach($_GET as $key => $val){
  $sq .= "sum(`".$key."`)+";
  $count++;
}
$sq .= $sq."0";
$sql = "SELECT doctors.*, (". $sq .")/sqrt(".$count."
*(power(sum(`body_pain`),2)+power(sum(`fatigue`),2)+power(sum(`headache`),2)+power(sum(`infection`),2)
+power(sum(`nausea`),2)+power(sum(`common_cold`),2)+power(sum(`dizziness`),2)+power(sum(`diarrhea`),2)
+power(sum(`constipation`),2)+power(sum(`hypertension`),2)+power(sum(`fever`),2)+power(sum(`cough`),2)
+power(sum(`stress`),2)+power(sum(`perspiration`),2)+power(sum(`migraine`),2)+power(sum(`bloating`),2)
+power(sum(`anorxeia`),2)+power(sum(`muscle_pain`),2)+power(sum(`arthritis`),2)+power(sum(`joint_pain`),2)
+power(sum(`hair_loss`),2)+power(sum(`irritation_in_eyes`),2)+power(sum(`abdominal_pain`),2)+power(sum(`anxiety`),2)))
as s FROM `appointments` , `doctors`  where appointments.doctor_id = doctors.id Group by `doctor_id` order by s desc limit 4";
$db = new Database;
$res = $db->resultset($sql);
// print_r( $res);
// ?>
<html lang="en" class="">
<head>
  <title>DocRec: Recommendations</title>
  <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
  <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel = "stylesheet" href = "../styles/index.css"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
  .docinfo:hover button{
    background: #7e95c2;
    color: white;
  }
    button{
      border: none;
      padding: 8px;
      margin-top: 2px;
      background: #d6dff1;
      color: #757575;
    }

    button.col-md-1{
      box-sizing: border-box;
      border: 1px solid white;
    }
    button.map-marker{
      font-size: 18px;
      padding-bottom: 11px;
    }
    button.num{
      text-align: right;
    }

  </style>
</head>

<body>
  <div class="slots">

  </div>
  <a href = "../index.php" style = "text-decoration: none;"><h1>DocRec</h1></a>
  <h2>Search a doctor</h2>
  <p>Recommendations based on the following symptoms:</p>
  <p style = "color: crimson;">
<?php
$i = 0;
foreach($_GET as $key => $val){
    echo join(split("_",$key), " ");
    if ($i < $count-1) {
      echo ", ";
      $i++;
    }
} ?></p>
  <div class = "col-md-12">
    <?php
      $i = 1;
      foreach($res as $each){
        echo '<div class="docinfo"><button class = "col-md-1 num">'.$i++.'</button><button class = "col-md-10" onclick = "window.location.href = \'./profile.php?q='.$each["id"].'\'">'.$each["first_name"].' '.$each["middle_name"].' '.$each["last_name"].' ('.$spec[$each["specialization"]].'), '.$each["work_place"].'</button><button class = "col-md-1 map-marker" onclick = "window.location.href = \'./showMap.php?lat='.$each["latitude"].'&lon='.$each["longitude"].'\'"><i class="fa fa-map-marker" aria-hidden="true"></i></button></div>';
      }
    ?>
  </div>
  <button id = "prev" class = "col-md-3 submit nav-btn ">< Previous</button><button id = "next" class = "col-md-3 submit nav-btn">Next ></button>
</body>
</html>
