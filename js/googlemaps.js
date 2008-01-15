// Google Maps

$(document).ready(function() {
    if (GBrowserIsCompatible()) {
        var m = $("#map")[0];
        if (m) {
            // Mittelpunkt der Karte
            var map = new GMap2(m);
            
            // Bedienelemente für Zoom und Pan anzeigen (auswählen!)
            // map.addControl(new GLargeMapControl());
            // map.addControl(new GSmallMapControl());
            // map.addControl(new GMapTypeControl());

            // Position des Geschäfts (Länge, Breite)
            var point = new GLatLng(53.555045414405996,9.995241165161133);

            // Vergrösserungsfaktor: 
            // 0: Welt
            // 1: Halbkugel
            // [...]
            // 16: Ein paar Straßenzüge
            // 20: Maximal
            var zoomLevel = 15;
            
            // Zentrum setzen
            map.setCenter(point, zoomLevel);
            
            // Markierung hineinpieksen
            var marker = new GMarker(point);
            map.addOverlay(marker);

            // Infofenster anhängen (HTML)
            GEvent.addListener(marker, 'click', function() {
                marker.openInfoWindowHtml("<strong>###FIRMENNAME###</strong><br />###STRASSE###<br />###PLZ ORT###");
            });
        }
    }
});