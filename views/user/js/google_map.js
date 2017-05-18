

function init_map() {
    var var_location = new google.maps.LatLng(10.670282924574199,-63.250987976789474);

    var var_mapoptions = {
        center: var_location,
        zoom: 18,
        scrollwheel: false
    };

        var mapElement = document.getElementById('map-container');

    var myMap = new google.maps.Map(mapElement, var_mapoptions);


    var var_marker = new google.maps.Marker({
        position: var_location,
        map: myMap,
        title:"Representaciones Jemaro.C.A"});

}

google.maps.event.addDomListener(window, 'load', init_map);

