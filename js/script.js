(function($){

    /* Google-Maps */
    if (GBrowserIsCompatible()) {
        var m = $("#map")[0];
        if (m) {
            // Mittelpunkt der Karte
            var map = new GMap2(m);
            
            // Position (Länge, Breite)
            var point = new GLatLng(53.555045414405996,9.995241165161133);
            
            // Bedienelemente für Zoom und Pan anzeigen
            map.setMapType(G_NORMAL_MAP); /* 2D-Karte */
            // map.setMapType(G_HYBRID_MAP); /* Satelllitenbild & Straßen */
            // map.setMapType(G_SATELLITE_MAP); /* Satellitenaufnahme */
            // map.setMapType(G_PHYSICAL_MAP); /* Gelände */
            map.setUIToDefault(); /* Standard-Navigation */
            // map.addControl(new GOverviewMapControl()); /* Übersichtskarte einblenden */
            // map.addControl(new GScaleControl()); /* Massstab einblenden */
            // map.addControl(new GLargeMapControl()); /* Große Navigation (alt) */
            // map.addControl(new GSmallMapControl()); /* Kleine Navigation (alt) */
            // map.addControl(new GMapTypeControl()); /* Karte, Satellite, Hybrid (alt) */
            map.enableScrollWheelZoom();
            map.enableContinuousZoom(); 

            // Icon
            var MyIcon = new GIcon(G_DEFAULT_ICON);
            MyIcon.image = "css/img/googlemaps/pin.png";
            //MyIcon.shadow = "css/img/googlemaps/pin_shadow.png";
            //MyIcon.shadowSize=new GSize(19,19);
            MyIcon.iconSize = new GSize(20, 34);
            MyIcon.iconWindowAnchor = new GPoint(10, 10);

            // GMarkerOptions Objekt
            markerOptions = { icon:MyIcon };
            var inactiveMirror = new GIcon(G_DEFAULT_ICON);
            var activeMirror = new GIcon(G_DEFAULT_ICON);

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
            map.addOverlay(marker = new GMarker(point,MyIcon)); 

            // Infofenster anhängen (HTML)
            GEvent.addListener(marker, 'click', function() {
                marker.openInfoWindowHtml("<strong>###FIRMENNAME###</strong><br />###STRASSE###<br />###PLZ ORT###");
            });
        }
    }
    
})(window.jQuery);


