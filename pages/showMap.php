<?php
  $lat = $_GET["lat"];
  $lon = $_GET["lon"];
?>
<html>
<head>
  <title>Docrec: Select A Doctor</title>
  <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
  <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel = "stylesheet" href = "../styles/index.css"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <a href = "../index.php" style = "text-decoration: none;"><h1>DocRec</h1></a>
  <h2>Search a doctor</h2>
  <div id = "main-content-B">
    <center><div id="google_map" class = "col-md-8 col-sm-10 col-xs-12" style="height:400px;"></div></center>
  </div>
  <script src="http://maps.google.com/maps/api/js?key=AIzaSyD-ozRVmuytiOjhCfyvLXl4A63xLHQ7IQk" type="text/javascript"></script>
  <script type="text/javascript">
    var locations = [
      ['Ranjit Damodar Deshmukh', 25.6205, 85.1581, 1],
      ['Ruchika Prasad Singh', 25.6009, 85.1983, 2],
      ['Suman Rajshree Pandey', 25.621, 85.1229, 3]
    ];

    var map = new google.maps.Map(document.getElementById('google_map'), {
      zoom: 10,
      center: new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lon; ?>),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        title: locations[i][0],
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent('<a href = "./profile.php?q=' + locations[i][3] + '">' + locations[i][0] + '</a>');
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  </script>
</body>
</html>
