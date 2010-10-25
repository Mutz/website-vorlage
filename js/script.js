(function($){

    /* Google-Maps */
    initialize();

})(window.jQuery);


function initialize() {
    var latlng = new google.maps.LatLng(53.555045414405996, 9.995241165161133);
    var myOptions = {
        center: latlng,
        zoom: 15,
        scaleControl: true,
        disableDefaultUI: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP, // SATELLITE, HYBRID, TERRAIN
        mapTypeControl: true,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU, // HORIZONTAL_BAR, DEFAULT
            position: google.maps.ControlPosition.TOP_RIGHT, // TOP, TOP_RIGHT, LEFT, RIGHT, BOTTOM_LEFT, BOTTOM, BOTTOM_RIGHT
        },

        navigationControl: true,
        navigationControlOptions: {
            style: google.maps.NavigationControlStyle.SMALL, // ZOOM_PAN, ANDROID, DEFAULT
        }
    };

    var map = new google.maps.Map(document.getElementById("map"), myOptions);

    // var image = 'css/img/googlemaps/pin.png';
    var image = new google.maps.MarkerImage('css/img/googlemaps/pin.png',
            new google.maps.Size(20, 34),
            new google.maps.Point(0, 0),
            new google.maps.Point(10, 34));

    var shadow = new google.maps.MarkerImage('css/img/googlemaps/shadow-pin.png',
            new google.maps.Size(20,34),
            new google.maps.Point(0, 0),
            new google.maps.Point(0, 32));

    var marker = new google.maps.Marker({
        position: latlng,
        icon: image
    });

    var contentString = '<div id="mapcontent">' +
        '<h2>####</h2>' +
        '<p>###</p>' +
        '</div>';

    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    google.maps.event.addListener(marker, 'click', function(){
        infowindow.open(map, marker);
    });

    marker.setMap(map);
}
