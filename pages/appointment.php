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
<html lang="en" class="">
<head>
    <title>DocRec: Book an Appointment</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel = "stylesheet" href = "../styles/index.css"/>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
          box-sizing: border-box;
        }
        body{
          padding: 0;
        }
        form {
          padding: 0 10%;
        }
        form section {
          width: calc(50% - 40px);
          padding: 20px;
          background: #16a085;
          margin: 20px;
          border-radius: 5px;
        }
        form section.left {
          float: left;
        }
        form section.right {
          float: right;
        }
        form section .input-container {
          padding: 10px;
        }
        form section .input-container label {
          display: block;
          margin-bottom: 4px;
          color: white;
          font-size: 16px;
          text-shadow: 0px 2px 1px #65ad6b;
          font-family: 'Quicksand', sans-serif;
        }
        form section .input-container input,
        form section .input-container textarea {
          width: 100%;
          padding: 5px 10px;
          height: 40px;
          border-radius: 5px;
          border: none;
          background: rgba(26, 188, 156, 0.5);
          font-family: 'Quicksand', sans-serif;
          font-size: 16px;
          color: #757575;
        }
        form section .input-container input:focus,
        form section .input-container textarea:focus {
          outline: none;
          background: white;
        }
        form section .input-container textarea {
          height: 122px;
          padding: 15px 10px;
          resize: none;
        }

        form:after {
          content: "";
          display: block;
          clear: both;
        }
        @media (max-width: 992px) {
          form {
            padding: 0 5%;
          }
        }
        @media (max-width: 768px) {
          form {
            margin-bottom: 50px;
          }
          form section {
            width: 100%;
            margin: 0;
          }
          form section.left {
            margin-bottom: -30px;
          }
        }

        /* hover style just for information */
        label:hover:before {
          border: 2px solid #4778d9!important;
        }
        label{
          font-weight: normal !important;
        }
        .dropdown-menu>.active>a, .dropdown-menu>.active>a:focus, .dropdown-menu>.active>a:hover{
          background-color: #16a085 !important;
        }
        /* Drop-down menu starts here */
        ul.multiselect-container{
          width: 100%;
          background-color: #1abc9c;
        }
        label.checkbox {
          color: black !important;
          font-size: 14px !important;
          text-shadow: 0 0 1px white !important;
          font-family: 'Arial' !important;
        }
        div.btn-group{
          width: 100%;
        }
        button.multiselect{
          width: 100%;
          color: gray;
          background-color: #1abc9c;
        }
        input[type="button"].submitBtn{
          background: #1abc9c !important;
          color: white !important;
          margin-top: 20px !important;
          height: 55px !important;
          outline: 5px auto -webkit-focus-ring-color;
        }
        input[type="radio"]{
          visibility: hidden;
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
        $('#sexOpt').multiselect({
            columns: 1,
            placeholder: 'Select Sex',
            search: true
        });
        $('#symOpt').multiselect({
            columns: 1,
            placeholder: 'Select Symptoms',
            search: true
        });
        $(".submitBtn").on("click", function(){
          $.post("../scripts/book_appointment.php",
          {
              name: $("input[name='Name']").val(),
              mobile: $("input[name='Mobile']").val(),
              sex: $("select[name='sexOpt']").val(),
              email: $("input[name='Email']").val(),
              address: $("input[name='Address']").val(),
              dob: $("input[name='dob']").val(),
              symptoms: $("select[name='symOpt[]']").val(),
              problem: $("#problem").val(),
              doctor_id: <?php echo $res[0]["id"]; ?>
          },
          function(data, status){
              if(status == "success"){
                console.log(data);
                if(data[0] != '#'){
                  $(".alert-box").fadeToggle("slow").html('<center>Your have booked an appointment. Kindly keep the appointment number safe. Your appointment number is ' + data + '.<br><br><input class = "alert-input" type = "button" value = "Home" style = "width: 100%;"/></center>');
                  $("form").toggleClass("blur");
                }
                else{
                  $(".alert-box").fadeToggle("slow").html('<center>Kindly fill the form properly.<br><br><input class = "alert-input" type = "button" value = "OK" style = "width: 100%;"/></center>');
                  $("form").toggleClass("blur");                }
                $("input[value='Home']").on("click", function(){
                  window.location.href = "../index.php";
                });
                $("input[value='OK']").on("click", function(){
                  $(".alert-box").fadeToggle("slow");
                  $("form").toggleClass("blur");
                });
              }else{
                $(".alert-box").fadeToggle("slow").html('<center>The process cannot be completed right now due to some technical issues. Please try after some time.<input class = "alert-input" type = "button" value = "OK" style = "width: 100%;"/></center>');
                $("form").toggleClass("blur");              }
          });
        });
      });
    </script>
</head>
<body>
  <a href = "../index.php" style = "text-decoration: none;"><h1>DocRec</h1></a>
  <h2>Search a doctor</h2>
    <center>
      <div style = "background: #16a085; border-radius: 3px; margin-bottom: 5px; padding: 6px; width: 90%; color: white; text-shadow: 0 0 2px black;">
      Book an appointment with <?php echo $res[0]["first_name"]." ".$res[0]["middle_name"]." ".$res[0]["last_name"]." (".$spec[$res[0]["specialization"]].")"; ?>
      </div>
    </center>
<form action="">
  <section class="left">
    <div class="input-container">
      <label for="name">Patient's Name</label>
      <input type="text" name = "Name"/>
    </div>
    <div class="input-container">
      <label for="sex" required>Sex</label>
      <select name="sexOpt" id="sexOpt">
        <option value="0">Female</option>
        <option value="1">Male</option>
        <option value="2">Other</option>
      </select>
    </div>
    <div class="input-container">
      <label for="phone">Mobile</label>
      <input type="text" name = "Mobile"/>
    </div>
    <div class="input-container">
      <label for="email">Email</label>
      <input type="text" name = "Email"/>
    </div>
    <div class="input-container">
      <label for="address">Address</label>
      <input type="text" name = "Address"/>
    </div>
  </section>
  <section class="right">
    <div class="input-container">
      <label for="address">D.O.B.</label>
      <input type="date" name = "dob"/>
    </div>
    <div class="input-container">
      <label for="symptoms">Symptoms</label>
      <select name="symOpt[]" multiple id="symOpt">
        <?php
        foreach ($sym as $val) {
          echo '<option value="'.$val.'">'.$val.'</option>';
        }
        ?>
      </select>
    </div>
    <div class="input-container">
      <label for="comments">Problem</label>
      <textarea name="comments" id="#problem"></textarea>
    </div>
    <div class="input-container">
      <input type = "button" class = "submitBtn" value = "Book"/>
     </div>
  </section>
</form>
<div class = "alert-box">
  <!-- <center>
  <div style = "text-align: left; width: 80%; margin-top: 8px;">Appointment Number</div>
  <div style = "width: 80%; margin-bottom: 8px; margin-top: 8px;"><input class = "alert-input" type = "text" style = "width: 100%;"/></div>
  <div style = "text-align: left; width: 80%; margin-top: 8px;">Patient's D.O.B.</div>
  <div style = "width: 80%; margin-bottom: 18px; margin-top: 8px;"><input class = "alert-input" type = "date" style = "width: 100%;"/></div>
  <div style = "width: 80%; margin-bottom: 10px; margin-top: 8px;"><input class = "alert-input" type = "button" value = "Submit" style = "width: 100%;"/></div>
  <div style = "width: 80%; margin-bottom: 18px; margin-top: 10px;"><input class = "alert-input" type = "button" value = "Cancel" style = "width: 100%;"/></div>
  <center> -->
</div>
</body>
</html>
