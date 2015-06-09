<!DOCTYPE html>
<html>
<head>
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script src="http://connect.facebook.net/en_US/sdk.js"></script>
<?php
?>
<script>
  FB.init({
    appId      : '1444502819201664',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.2' // use version 2.2
  });
FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
});

function fbLogoutUser() {
    FB.getLoginStatus(function(response) {
        if (response && response.status === 'connected') {
            FB.logout(function(response) {
                document.location.reload();
            });
        }
    });
}

  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      
    } else if (response.status === 'not_authorized') {
      window.location.assign("http://localhost/mashup/login.php")
    } else {
      window.location.assign("http://localhost/mashup/login.php")
    }
  }
var map;
function initialize() {
  var mapProp = {
    center:new google.maps.LatLng(5.2717863,-29.3449961),
    zoom:1,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
  
  loadMarkers ();
}

function loadMarkers () {
	<?php
		$conn = mysqli_connect("localhost", "root", "", "mashup");
		echo 'google.maps.event.addDomListener(window, "load", initialize);';
		$query = "SELECT nomeCorretor,lat,lng FROM localidade";
		$result = mysqli_query($conn, $query)
			or die (mysql_error());
		if ($result){
			while($row = mysqli_fetch_assoc($result)) {
				?>
				var myCenter=new google.maps.LatLng(<?php echo $row["lat"] ?>,<?php echo $row["lng"] ?>);	
				var marker=new google.maps.Marker({
					position:myCenter,
				});
				marker.setMap(map);
			<?php
			}
		}	
		else{
			echo "Ocorreu um erro!";
		}
	?>
}


function addMarker () {
			var endereco = document.getElementById("endereco").value;
			var xmlhttp = new XMLHttpRequest();
			
			xmlhttp.onreadystatechange=function() {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					var data = JSON.parse(innerHTML=xmlhttp.responseText);
					var myCenter=new google.maps.LatLng(data.results[0].geometry.location.lat,data.results[0].geometry.location.lng);	
					var marker=new google.maps.Marker({
					position:myCenter,
					});

					document.getElementById("txt_lat").value = data.results[0].geometry.location.lat;
					document.getElementById("txt_lng").value = data.results[0].geometry.location.lng;
					
					marker.setMap(map);
					document.getElementById('formpost').submit();
				}
			}
			xmlhttp.open("POST", "http://maps.googleapis.com/maps/api/geocode/json?address="+endereco+"&sensor=true", true);
			xmlhttp.send();
			
}

google.maps.event.addDomListener(window, 'load', initialize);

</script>
</head>

<body>
<div id="googleMap" style="width:600px;height:480px;"></div><br> <br> <br>

<form action='engine.php' method="post" id='formpost'>
	<input type="text" id='nome' name='nome' size='30' placeholder='corretor'>
	<input type="text" id='endereco' name='endereco' size="30" placeholder='endereço' > 
	<input type="hidden" id='txt_lat' name='txt_lat'>
	<input type="hidden" id='txt_lng' name='txt_lng'>
	<input type="button" value="Adicionar" onClick="addMarker();">
</form>

<div>
<input value="logout" type="button" onClick="fbLogoutUser();" >
</div>
</body>

</html>