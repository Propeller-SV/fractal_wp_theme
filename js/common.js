function initialize() {
    var latlng = new google.maps.LatLng(50.406689050, 30.489451030);
    var settings = {
        zoom: 15,
        center: latlng,
        mapTypeControl: true,
        mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
        navigationControl: true,
        navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
        mapTypeId: google.maps.MapTypeId.ROADMAP};
    var map = new google.maps.Map(document.getElementById("map_canvas"), settings);
    var contentString = '<div id="content">'+
        '<div id="siteNotice">'+
        '</div>'+
        '<h3 id="firstHeading" class="firstHeading">Yasna, 5 St.</h3>'+
        '<div id="bodyContent">'+
        '<p>from Lybidska metro to stop Kirovohrad: bus № 239(17), trolley bus №42.</p>'+
        '</div>'+
        '</div>';
    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    var companyImage = new google.maps.MarkerImage(WPURLS.templateUrl + '/img/marker.png',
        new google.maps.Size(50,73),
        new google.maps.Point(0,0),
        new google.maps.Point(50,50));

    var companyShadow = new google.maps.MarkerImage('images/logo_shadow.png',
        new google.maps.Size(130,50),
        new google.maps.Point(0,0),
        new google.maps.Point(65, 50));

    var companyPos = new google.maps.LatLng(50.406689050, 30.489451030);

    var companyMarker = new google.maps.Marker({
        position: companyPos,
        map: map,
        icon: companyImage,
        shadow: companyShadow,
        title:"Yasna, 5 St.",
        zIndex: 3});

    google.maps.event.addListener(companyMarker, 'click', function() {
        infowindow.open(map,companyMarker);
    });
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
      // } else if (aTags[i].textContent.toLowerCase() == searchText[1]){
      //   found = aTags[i];
      //   found.innerHTML = "<i class='hidden-sm hidden-md hidden-lg glyphicon glyphicon-cog'></i> Software Engineering"
      // } else if (aTags[i].textContent.toLowerCase() == searchText[2]){
      //   found = aTags[i];
      //   found.innerHTML = "<i class='hidden-sm hidden-md hidden-lg glyphicon glyphicon-list-alt'></i> Company"
      // } else if (aTags[i].textContent.toLowerCase() == searchText[3]){
      //   found = aTags[i];
      //   found.innerHTML = "<i class='hidden-sm hidden-md hidden-lg glyphicon glyphicon-user'></i> Career"
      // }
    }
});
