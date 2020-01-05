
<?php
	$coordiantes_query = "SELECT * FROM coordinates_default";
	$coordiantes = $connection->query($coordiantes_query);
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/hmac-sha1.js" integrity="sha256-4QSstzebg0vZJJ48/LIZasv5CiK7EJR/6yofvjDe0QU=" crossorigin="anonymous"></script>
<script>
	var map;
	function initMap() {
		var locations = [
			<?php if ($coordiantes->num_rows > 0) {
				while ($row = $coordiantes->fetch_assoc()) {
					if($row['status'] == 1) {
						$title = "'".print_r($row['title'],true)."'";
						$marker_color = "'".print_r($row['marker_color'],true)."'";

						echo "[". $title .",".$row['coordX'].",".$row['coordY'].",".$row['id'].",".$marker_color."],";
					}
			} } ?>
		];
		var bounds = new google.maps.LatLngBounds ();
		map = new google.maps.Map(document.getElementById('map'), {
			center: new google.maps.LatLng(45.638715, 24.901684),
			zoom: 8,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			styles: [
				{
					"elementType": "geometry",
					"stylers": [
					{
						"color": "#212121"
					}
					]
				},
				{
					"elementType": "labels.icon",
					"stylers": [
					{
						"visibility": "off"
					}
					]
				},
				{
					"elementType": "labels.text.fill",
					"stylers": [
					{
						"color": "#757575"
					}
					]
				},
				{
					"elementType": "labels.text.stroke",
					"stylers": [
					{
						"color": "#212121"
					}
					]
				},
				{
					"featureType": "administrative",
					"elementType": "geometry",
					"stylers": [
					{
						"color": "#757575"
					}
					]
				},
				{
					"featureType": "administrative.country",
					"elementType": "labels.text.fill",
					"stylers": [
					{
						"color": "#9e9e9e"
					}
					]
				},
				{
					"featureType": "administrative.land_parcel",
					"stylers": [
					{
						"visibility": "off"
					}
					]
				},
				{
					"featureType": "administrative.locality",
					"elementType": "labels.text.fill",
					"stylers": [
					{
						"color": "#bdbdbd"
					}
					]
				},
				{
					"featureType": "poi",
					"elementType": "labels.text.fill",
					"stylers": [
					{
						"color": "#757575"
					}
					]
				},
				{
					"featureType": "poi.park",
					"elementType": "geometry",
					"stylers": [
					{
						"color": "#181818"
					}
					]
				},
				{
					"featureType": "poi.park",
					"elementType": "labels.text.fill",
					"stylers": [
					{
						"color": "#616161"
					}
					]
				},
				{
					"featureType": "poi.park",
					"elementType": "labels.text.stroke",
					"stylers": [
					{
						"color": "#1b1b1b"
					}
					]
				},
				{
					"featureType": "road",
					"elementType": "geometry.fill",
					"stylers": [
					{
						"color": "#2c2c2c"
					}
					]
				},
				{
					"featureType": "road",
					"elementType": "labels.text.fill",
					"stylers": [
					{
						"color": "#8a8a8a"
					}
					]
				},
				{
					"featureType": "road.arterial",
					"elementType": "geometry",
					"stylers": [
					{
						"color": "#373737"
					}
					]
				},
				{
					"featureType": "road.highway",
					"elementType": "geometry",
					"stylers": [
					{
						"color": "#3c3c3c"
					}
					]
				},
				{
					"featureType": "road.highway.controlled_access",
					"elementType": "geometry",
					"stylers": [
					{
						"color": "#4e4e4e"
					}
					]
				},
				{
					"featureType": "road.local",
					"elementType": "labels.text.fill",
					"stylers": [
					{
						"color": "#616161"
					}
					]
				},
				{
					"featureType": "transit",
					"elementType": "labels.text.fill",
					"stylers": [
					{
						"color": "#757575"
					}
					]
				},
				{
					"featureType": "water",
					"elementType": "geometry",
					"stylers": [
					{
						"color": "#000000"
					}
					]
				},
				{
					"featureType": "water",
					"elementType": "labels.text.fill",
					"stylers": [
					{
						"color": "#3d3d3d"
					}
					]
				}
				]
		});

		var infowindow = new google.maps.InfoWindow();

		let WeatherLocations = [];
		let DataDisplay = [];
		var LatLngList = [];
		var bounds = new google.maps.LatLngBounds();

		var marker, i, weatherByCoordsRAW;

		// GET MY WEATHER DATA AND PUSH THE DATA TO INFO BUBBLE
		for (i = 0; i < locations.length; i++) { 
			let name = locations[i][0];
			
			// $.getJSON("http://api.openweathermap.org/data/2.5/weather?lat="+locations[i][1]+"&lon="+locations[i][2]+"&appid=7a27417787c2bea7d429df742eaf139d", function() {
			// 	console.log("location: " + name + " done");
			// }).done(function (data) {
			// 	WeatherLocations.push({
			// 		name,
			// 		temp: Math.floor(data.main.temp - 273.15),
			// 		feelLike: Math.floor(data.main.feels_like - 273.15),
			// 		humidity: data.main.humidity
			// 	})
			// 	DataDisplay.push(
			// 		`Location: ${name} <br />
			// 		Temperature: ${ Math.floor(data.main.temp - 273.15)} <br />
			// 		Feels Like: ${Math.floor(data.main.feels_like - 273.15)} <br />
			// 		Humidity: ${data.main.humidity} <br /> `
			// 	);
			// });

				var url = 'https://weather-ydn-yql.media.yahoo.com/forecastrss';
				var method = 'GET';
				var app_id = '1CFH0V44';
				var consumer_key = 'dj0yJmk9YkFWcmJ0RTd1YU00JmQ9WVdrOU1VTkdTREJXTkRRbWNHbzlNQS0tJnM9Y29uc3VtZXJzZWNyZXQmc3Y9MCZ4PTI4';
				var consumer_secret = '11bcfde07ba22405919d0095e45e6d40e7772cec';
				var concat = '&';
				var query = {
					"lat": locations[i][1],
					"lon": locations[i][2],
					"u": "c",
					"format": "json"
				};
				var oauth = {
					'oauth_consumer_key': consumer_key,
					'oauth_nonce': Math.random().toString(36).substring(2),
					'oauth_signature_method': 'HMAC-SHA1',
					'oauth_timestamp': parseInt(new Date().getTime() / 1000).toString(),
					'oauth_version': '1.0'
				};

				var merged = {}; 
				$.extend(merged, query, oauth);
				// Note the sorting here is required
				var merged_arr = Object.keys(merged).sort().map(function(k) {
				return [k + '=' + encodeURIComponent(merged[k])];
				});
				var signature_base_str = method
				+ concat + encodeURIComponent(url)
				+ concat + encodeURIComponent(merged_arr.join(concat));

				var composite_key = encodeURIComponent(consumer_secret) + concat;
				var hash = CryptoJS.HmacSHA1(signature_base_str, composite_key);
				var signature = hash.toString(CryptoJS.enc.Base64);

				oauth['oauth_signature'] = signature;
				var auth_header = 'OAuth ' + Object.keys(oauth).map(function(k) {
				return [k + '="' + oauth[k] + '"'];
				}).join(',');

				$.ajax({
					url: url + '?' + $.param(query),
					headers: {
						'Authorization': auth_header,
						'X-Yahoo-App-Id': app_id 
					},
					method: 'GET',
					success: function(data){
						console.log(data);
						WeatherLocations.push({
							name,
							city: data.location.city,
							temp: data.current_observation.condition.temperature,
							windSpeed: data.current_observation.wind.speed,
							humidity: data.current_observation.atmosphere.humidity,
							lat: data.location.lat,
							long: data.location.long
						})
						DataDisplay.push(
							`Location: ${name} <br />
							City: ${data.location.city} <br />
							Temperature: ${data.current_observation.condition.temperature} <br />
							Wind Speed: ${data.current_observation.wind.speed} <br />
							Humidity: ${data.current_observation.atmosphere.humidity} <br /> 
							Latitude: ${data.location.lat} <br />
							Longitude: ${data.location.long} <br />`
						);
					}
				}).then(() => {
					for (i = 0; i < WeatherLocations.length; i++) {
						marker = new google.maps.Marker({
							position: new google.maps.LatLng(WeatherLocations[i].lat, WeatherLocations[i].long),
							map: map,
							icon: {
								url: "http://maps.google.com/mapfiles/ms/icons/"+locations[i][4]+"-dot.png",
								scaledSize: new google.maps.Size(50, 50) // scaled size
							},
						});
						LatLngList.push(
							new google.maps.LatLng (WeatherLocations[i].lat, WeatherLocations[i].long)
						);
						bounds.extend(LatLngList[i]);
						
						google.maps.event.addListener(marker, 'click', (function(marker, i) {
							return function() {
								// we can place the content weather here
								infowindow.setContent(DataDisplay[i]);
								infowindow.open(map, marker);
							}
						})(marker, i));
					}
				}).then(() => {
					for (var i = 0, LtLgLen = LatLngList.length; i < LtLgLen; i++) {
						bounds.extend (LatLngList[i]);
					}
					map.fitBounds(bounds);
				})
		}


}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAssHpNB_Hpj_hFKudAalPultvahAojIng&callback=initMap"
async defer></script>