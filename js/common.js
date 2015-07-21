// load the map widget
function initialize() {
	var latlng = new google.maps.LatLng(50.406689050, 30.489451030);
	var address = WPDATA.address;
	var settings = {
		zoom: 15,
		center: latlng,
		mapTypeControl: true,
		mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
		navigationControl: true,
		navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
		mapTypeId: google.maps.MapTypeId.ROADMAP};
	geocoder = new google.maps.Geocoder();
	var map = new google.maps.Map(document.getElementById("map_canvas"), settings);
	if (geocoder) {
		geocoder.geocode( { 'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
				map.setCenter(results[0].geometry.location);

				var contentString = '<div id="content">'+
					'<h3 id="firstHeading" class="firstHeading">'+
					WPDATA.address+
					'</h3>'+
					'<div id="bodyContent">'+
					'<p>'+
					WPDATA.how_to_get+
					'</p>'+
					'</div>'+
					'</div>';

				var infowindow = new google.maps.InfoWindow({
					content: contentString
					});

				var companyImage = new google.maps.MarkerImage(WPDATA.templateUrl + '/img/marker.png',
					new google.maps.Size(50,73),
					new google.maps.Point(0,0),
					new google.maps.Point(50,50));

				var marker = new google.maps.Marker({
					position: results[0].geometry.location,
					map: map,
					icon: companyImage,
					title:address,
					zIndex: 3
				});

				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(map,marker);
				});

				} else {
					alert("No results found");
				}
			} else {
				alert("Geocode was not successful for the following reason: " + status);
			}
		});
	}
}

// Add icons to mobile menu
$(function() {
	var aTags = document.getElementById('navbar').getElementsByTagName('a');
	var searchText = ['home', 'software engineering', 'company', 'career'];
	var icons = ['glyphicon-home', 'glyphicon-cog', 'glyphicon-list-alt', 'glyphicon-user'];
	var found;

	for (var i = 0; i < aTags.length; i++) {
	  if (aTags[i].textContent.toLowerCase() == searchText[i]) {
		found = aTags[i];
		found.innerHTML = "<i class='hidden-sm hidden-md hidden-lg glyphicon " + icons[i] + "'></i> " + searchText[i];
		}
	}
});
