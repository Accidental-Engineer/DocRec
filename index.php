<?php require("./scripts/parseCategoricalData.php"); ?>
<html lang="en" class="">
<head>
  <title>DocRec: Home</title>
  <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
  <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel = "stylesheet" href = "./styles/index.css"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<a href = "./index.php" style = "text-decoration: none;"><h1>DocRec</h1></a>
<h2>Search a doctor</h2>
<button class = "se-btn col-md-4 col-xs-12 act-btn" id = "search-name">Search by name</button><button class = "se-btn col-md-4 col-xs-12" id = "loct-drop">Search by location</button><button class = "se-btn col-md-4 col-xs-12" id = "rec-btn">Get a symptom-based recommendation</button>
<center><button class = "loc-btn col-md-4" id = "gps-loc-btn">Search using GPS location</button><br/><button class = "loc-btn col-md-4" id = "man-loc-btn">Manually select location</button></center>
<p id = "error"></p>
<div id = "main-content-A">
  <div class="search-container col-md-6 col-sm-10 col-xs-12">
    <div class="search-box">
      <div class="search-icon"><i class="fa fa-search"></i></div>
      <input class="search-input" id="search" type="text" placeholder="Search by name">
      <ul class="search-results" id="results"></ul>
    </div>
  </div>
</div>

<div id = "main-content-B" style = "display: none;">
  <center><div id="google_map" class = "col-md-8 col-sm-10 col-xs-12" style="height:600px;"></div></center>
</div>

<div id = "main-content-C">
  <p>Please select all the symptoms you have.</p>
  <form action = "./pages/recommend.php" method = "GET">
    <?php
    $i = 1;
    foreach ($sym as $val) {
      echo '<input type="checkbox" name = "'.$val.'" class = "col-md-2 col-sm-3 col-xs-5" id = "test'.$i.'"/>';
      echo '<label for = "test'.$i.'" class = "col-md-2 col-sm-3 col-xs-5"/>'.$val.'</label>'; $i += 1;
    }
    ?>
    <br><br><br><input class="submit" type = "submit" class = "col-md-4 col-sm-6 col-xs-8" style = ""/>
  </form>
</div>

<script>
  function initMap() {
    var myLatlng = {lat: 22.9734, lng: 78.6569};
    var marker = null;
    var REQUIRED_ZOOM = 15;
    var map = new google.maps.Map(document.getElementById('google_map'), {
      zoom: 5,
      center: myLatlng
    });

    google.maps.event.addListener(map, 'click', function(event) {
        if(map.getZoom() < REQUIRED_ZOOM) {
          alert("You need to zoom in closer to position the cursor accurately." );
          return;
        }
        if(marker == null) {
          marker = new google.maps.Marker({
              position: event.latLng,
              map: map,
              title: 'Your Location'
          });
        }
        else {
          marker.setPosition(event.latLng);
        }
        setTimeout(function(){
          window.location.href = "./pages/showMap.php?lat=" + event.latLng.lat() + "&lon=" + event.latLng.lng();
        }, 500);
    });
  }
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBS5goUdSV7zTRmXa-aeOwHlFH3FLi5b9w&callback=initMap">
</script>

<script>(function() {
  var  resultsOutput, searchInput;


  $("#man-loc-btn").click(function(){
    $("#main-content-A").hide();
    $("#main-content-C").hide();
    $("#main-content-B").show();
  });
  $("#search-name").click(function(){
    $("#main-content-B").hide();
    $("#main-content-C").hide();
    $("#main-content-A").show();
  });
  $("#rec-btn").click(function(){
    $("#main-content-B").hide();
    $("#main-content-A").hide();
    $("#main-content-C").show();
  });
  $(".se-btn").click(function(){
    $(".se-btn").removeClass("act-btn");
    $(this).addClass("act-btn"); $(".loc-btn").fadeOut();
  });

  $("#loct-drop").click(function(){
    $(".loc-btn").fadeIn();
  });
  function showPosition(position){
    var url = "./pages/showMap.php?lat=" + position.coords.latitude + "&lon=" + position.coords.longitude;
    window.location.href = url;
  }
  $("#gps-loc-btn").click(function(){
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        $("#error").text("Geolocation is not supported by this browser.");
    }
  });
  searchInput = document.getElementById('search');
  resultsOutput = document.getElementById('results');
  searchInput.addEventListener('keyup', (e) => {
    var suggested, value;
    var values = ["", "", ""];
    value = searchInput.value.toLowerCase().split(' ');
    for(var i = 0; i < value.length; i += 1) values[i] = value[i];
    $.post("./scripts/handle_search.php",
    {
        first: values[0],
        second: values[1],
        third: values[2]
    },
    function(data, status){
        if(status == "success"){
          //console.log(data);
          var res = ""; data = JSON.parse(data);
          for(var i = 0; i < data.length; i += 1){
             res += "<li><a class = 'result-option' href = './pages/profile.php?q=" + data[i]["id"] + "'>" + data[i]["first_name"] + " " + data[i]["middle_name"] + " " + data[i]["last_name"] + "</a></li>";
          }
          resultsOutput.innerHTML = res;
        }else console.log("Error");
    });
  });
}).call(this);
</script>
</body>
</html>
