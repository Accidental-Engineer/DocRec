<?php
  require("../scripts/Database.php"); $q = $_GET["q"];
  include '../scripts/parseCategoricalData.php';
  $db = new Database;
  $app = $db->resultset("SELECT * FROM appointments WHERE id = ".$q.";");
  if(count($app)){
    $doc = $db->resultset("SELECT * FROM doctors WHERE id = ".$app[0]["doctor_id"].";");
?>
<html lang="en" class="">
<head>
  <title>DocRec: Review A Doctor</title>
  <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
  <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel = "stylesheet" href = "../styles/index.css"/>
  <link rel = "stylesheet" href = "../styles/rating.css"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    button{
      box-sizing: border-box;
      border: 1px solid white;
      padding: 8px;
      margin-top: 2px;
      background: #7e95c2;
      color: white;
    }
    #submit-btn{
      /* border: 5px solid white; */
      background: #3c4f73;
      margin-top: 15px;
      width: 100%;
      height: 50px;
    }
    #submit-btn:hover{
      color: white;
      background: #203763;
    }
    label:hover:before{
      border: none !important;
    }
    .rev-field{
      color:white;
      width: 100%; background: #7e95c2;  border: none; border-radius: 3px; padding: 5px;
    }
    .rev-field::-webkit-input-placeholder{
      color: rgba(255, 255, 255, 0.4);
    }
    .rev-field::-moz-placeholder{
      color: rgba(255, 255, 255, 0.4);
    }
    .rev-field:-ms-input-placeholder{
      color: rgba(255, 255, 255, 0.4);
    }
    .rev-field:-moz-placeholder{
      color: rgba(255, 255, 255, 0.4);
    }
    .rev > div{
      margin-top: 5px;
    }
    input.rev-field{
      height: 35px;
    }
    textarea.rev-field{
      height: 80px;
    }
    .text-left{
      text-align: left;
    }

    /* Alert Box */
    .alert-box{
      display: none;
      border-radius: 3px;
      height: 200px;
      width: 400px;
      position: fixed;
      top: calc(50% - 100px);
      left: calc(50% - 200px);
      padding: 20px;
      background: #16a085; /* #1abc9c */
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
      background: #1abc9c;
      cursor: pointer;
    }
    .blur{
      opacity: 0.3;
    }
  </style>
  <script>
  $(document).ready(function(){

    $("#submit-btn").on("click", function(){
      $.post("../scripts/handle_review.php",
      {
          <?php
            foreach ($app[0] as $key => $value) {
              if($value != 6) continue;
              echo $key.": "; ?>$("input[name=<?php echo "'".$key."'";?>]:checked").val(), <?php
            }
          ?>
          descr_title: $("input.rev-field").val(),
          descr_content: $("textarea.rev-field").val(),
          appointment_id: <?php echo "'".$app[0]["appointment_id"]."'"; ?>
      },
      function(data, status){
          if(status == "success"){
            //console.log(data);
            window.location.href = '../index.php';
          }
       });
    });
  });
  </script>
</head>

<body>
  <a href = "../index.php" style = "text-decoration: none;"><h1>DocRec</h1></a>
  <h2>Search a doctor</h2>
  <div class = "container">
  <p>Review <?php echo $doc[0]["first_name"]." ".$doc[0]["middle_name"]." ".$doc[0]["last_name"]." (".$spec[$doc[0]["specialization"]]; ?>)</p>
  <p>Your Appointment Number: <?php echo $app[0]["appointment_id"]; ?></p>
  <div class = "row">
    <?php
      $i = 1;
      foreach ($app[0] as $key => $value) {
        if($value == 6){
          echo '<button class = "col-md-6 symptom-name">'.join(" ", explode("_", $key)).'</button>
          <button class = "col-md-6 symptom-rating">
            <fieldset class="rating">
              <input type="radio" id="'.$i.'star5" name="'.$key.'" value="5" /><label class = "full" for="'.$i.'star5" title="Awesome - 5 stars"></label>
              <input type="radio" id="'.$i.'star4" name="'.$key.'" value="4" /><label class = "full" for="'.$i.'star4" title="Pretty good - 4 stars"></label>
              <input type="radio" id="'.$i.'star3" name="'.$key.'" value="3" /><label class = "full" for="'.$i.'star3" title="Meh - 3 stars"></label>
              <input type="radio" id="'.$i.'star2" name="'.$key.'" value="2" /><label class = "full" for="'.$i.'star2" title="Kinda bad - 2 stars"></label>
              <input type="radio" id="'.$i.'star1" name="'.$key.'" value="1" /><label class = "full" for="'.$i.'star1" title="Sucks big time - 1 star"></label>
            </fieldset>
          </button>';
          $i += 1;
        }
      }
    ?>
  </div>
  <div class = "row rev" style = "color: grey; margin: 10px;">
    <div class = "col-md-2"></div><div class = "col-md-8 text-left">&nbsp;Write your review:</div><div class = "col-md-2"></div>
    <div class = "col-md-2"></div><div class = "col-md-8"><textarea class = "rev-field" placeholder = "What did you like or dislike? How did the prescription work out for you? How did the treatment help?"></textarea></div><div class = "col-md-2"></div>
    <div class = "col-md-2"></div><div class = "col-md-8 text-left">&nbsp;Add a headline:</div><div class = "col-md-2"></div>
    <div class = "col-md-2"></div><div class = "col-md-8"><input type = "text" class = "rev-field" placeholder = "What's most important to know?"/></div><div class = "col-md-2"></div>
    <div class = "col-md-2"></div><div class = "col-md-8"><button id = "submit-btn" >Submit</button></div><div class = "col-md-2"></div>
  </div>
</div>
<div class = "alert-box">
</div>
</body>
</html>
<?php
}
else{
  header("Location: ../index.php");
}
?>
