
<?php
require '../scripts/Database.php';
include '../scripts/parseCategoricalData.php';
$db = new Database;
$doc_id = $_GET["q"];
$res = $db->resultset("SELECT * FROM doctors WHERE ID = ".$doc_id);
if(!$res){
  header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>DocRec: Profile</title>
  <!-- CSS -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel = "stylesheet" href = "../styles/index.css"/>
  <link rel = "stylesheet" href = "../styles/profile.css"/>

  <!-- JavaScript -->
    <!-- <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
  <!-- End of JavaScript -->

  <style>
    .alert-box{
      display: none;
      border-radius: 3px;
      height: 320px;
      width: 400px;
      position: fixed;
      top: calc(50% - 140px);
      left: calc(50% - 200px);
      padding-top: 10px;
      padding-bottom: 10px;
      background: #7e95c2; /* #1abc9c */
      z-index: 999;
      color: white;
    }
    .alert-input{
      border: none;
      border-radius: 3px;
      height: 35px;
      color: #1abc9c;
    }
    input[type="button"].alert-input{
      color: white;
      background: #203763;
      cursor: pointer;
    }
    .blur{
      opacity: 0.3;
    }
  </style>
  <script>
    $(document).ready(function(){
      $("#rev-btn").on("click", function(){
        $(".alert-box").fadeToggle("slow");
        $(".container").toggleClass("blur");
      });
      $("input[value='Cancel']").on("click", function(){
        $(".alert-box").fadeToggle("slow");
        $(".container").toggleClass("blur");
      });
      $("input[value='Submit']").on("click", function(){
        $.post("../scripts/isAppointmentValid.php",
        {
            apnum: $("input[name='apnum']").val(),
            dob: $("input[name='dob']").val(),
            doc: <?php echo $_GET["q"]; ?>
        },
        function(data, status){
            if(status == "success"){
              console.log(data);
              if(data[0] == '#'){
                $("#AlertError").text("Please enter valid credentials.");
              }
              else{
                window.location.href = "./review.php?q=" + data;
              }
            }else{
              $("#AlertError").text("Please check your internet connection.");
            }
        });
      });
    });
  </script>
</head>
<body>
  <a href = "../index.php" style = "text-decoration: none;"><h1>DocRec</h1></a>
  <h2>Search a doctor</h2>
  <br>
<div class="container" style = "/*position: absolute; top: 75px;*/ min-width: 100%; background: #ecf0f1; min-height: 500px;">
  <div class = "row">
    <div class = "col-md-3 col-sm-4 col-xs-12" >
      <div class = "social-icons" style= "background: rgba(85, 117, 175, 0.76);"><i class = "fa fa-facebook"></i><i class = "fa fa-google-plus"></i><i class = "fa fa-twitter"></i></div>
      <div class = "profile-pic-container" style = ""><img src = "../upload/pro.png"></div>
      <div class = "profile-name"><?php echo $res[0]["first_name"]." ".$res[0]["middle_name"]." ".$res[0]["last_name"]; ?></div>
      <hr class = "bar">
      <div class = "profile-designation"><?php echo $spec[$res[0]["specialization"]]; ?></div>
      <!-- <div class = "utility-icons"><i class = "fa fa-upload"></i><i class = "fa fa-flag"></i><i class = "fa fa-eye"></i></div> -->
      <hr class = "bar">

      <center><button style = "color: white; border: none; border-radius: 5px; width: 80%; padding: 10px; background: rgba(85, 117, 175, 0.76);; margin-bottom: 10px;" onclick = "window.location.href = <?php echo "'./appointment.php?q=".$res[0]["id"]."'"; ?>">Book An Appointment</button></center>
      <center><button style = "color: white; border: none; border-radius: 5px; width: 80%; padding: 10px; background: rgba(85, 117, 175, 0.76);; margin-bottom: 10px;" id = "rev-btn">Review This Doctor</button></center>

    </div>
    <div class = "col-md-9 col-sm-8 col-xs-12">
      <div style = "width: 91%; margin-left: 2%; margin-right: 7%; border-top: 5px solid #adc3ea;">
          <div style = "min-width: 100%; padding-top: 15px; padding-bottom: 15px;"><a href = "#" class = "prolink">Profile</a><a href = "#" class = "prolink">Reviews</a><a href = "#" class = "prolink">Contact</a></div>
          <div style = "text-align: right; font-size: 130%; letter-spacing: 2px;">PROFILE</span>&nbsp;&nbsp;<i class = "fa fa-user-circle" aria-hidden = "true"></i></div>
          <div class = "profile-info container" style = "background: #fbfbfb;    max-width: 100%;">
            <div class = "row">
              <div class = "col-md-6 col-xs-12" style = "text-align: center; border-right: 2px solid #ecf0f1; padding: 15px;">
                <h5><i class = "fa fa-user-circle"></i>&nbsp;&nbsp;Basic Information</h5>
                <small><?php echo $res[0]["first_name"]." ".$res[0]["middle_name"]." ".$res[0]["last_name"]; ?><br><?php echo $res[0]["degree"]; ?><br><?php echo $spec[$res[0]["specialization"]]; ?><br>
                  <?php echo $res[0]["experience"]." years"; ?><br></small>
              </div>
              <div class = "col-md-6 col-xs-12" style = "text-align: center; border-left: 2px solid #ecf0f1; padding: 10px;">
                <h5><i class = "fa fa-info-circle"></i>&nbsp;&nbsp;Profile Statement</h5>
                <p style = "text-align: justify;">I have served in variety of clinical branches and have extensive clinical experience. Please mention your problems in detail while booking an appointment.</p>
              </div>
            </div>
          </div>

          <div style = "text-align: right; font-size: 130%; letter-spacing: 2px;">REVIEWS</span>&nbsp;&nbsp;<i class = "fa fa-comment" aria-hidden = "true"></i></div>
            <?php


              $res = $db->resultset("SELECT descr_title, descr_content, date_of_entry FROM appointments WHERE doctor_id = :doc_id", array(':doc_id' => $doc_id));
              $i = 0; $b = 0;
              if($res){
                foreach($res as $each){
                  if($each['descr_title']){
                    echo '<div class = "profile-info" style = "background: #fbfbfb; margin-bottom: 5px;"><div class = "col-md-12" style = "text-align: center; border-right: 2px solid #ecf0f1; padding: 15px;">
                      <h5><i class = "fa fa-ambulance"></i>&nbsp;&nbsp;'.$each['descr_title'].'</h5>
                      <small>'.$each['descr_content'].'</small>
                      <p style = "text-align: right; font-size: 75%">'.$each['date_of_entry'].'</p>
                    </div></div>';
                    $b = 1;
                  }
                  $i = $i + 1;
                }
              }
              if($b == 0) echo "<div class = 'profile-info' style = 'background: #fbfbfb;'><small><i class = 'fa fa-ambulance'></i>&nbsp;&nbsp;No review is available for this doctor.</small></div>";
              ?>
      </div>
    </div>
  </div>
</div>
        <div class = "alert-box">
          <center>
          <div style = "text-align: left; width: 80%; margin-top: 8px;">Appointment Number</div>
          <div style = "width: 80%; margin-bottom: 8px; margin-top: 8px;"><input class = "alert-input" type = "text" style = "width: 100%;" name = "apnum"/></div>
          <div style = "text-align: left; width: 80%; margin-top: 8px;">Patient's D.O.B.</div>
          <div style = "width: 80%; margin-bottom: 18px; margin-top: 8px;"><input class = "alert-input" type = "date" style = "width: 100%;" name = "dob"/></div>
          <div style = "width: 80%; margin-bottom: 10px; margin-top: 8px;"><input class = "alert-input" type = "button" value = "Submit" style = "width: 100%;"/></div>
          <div style = "width: 80%; margin-bottom: 18px; margin-top: 10px;"><input class = "alert-input" type = "button" value = "Cancel" style = "width: 100%;"/></div>
          <div style = "width: 80%; margin-bottom: 18px; margin-top: 10px;" id = "AlertError"></div>
          <center>
        </div>
</body>
</html>
