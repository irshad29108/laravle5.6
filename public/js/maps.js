var marker, map, polyline;
var baseURI = window.location.href.substr(
    0,
    window.location.href.search("maps")
);
var iconBase = baseURI + "img/objects/";
var icons = {
    car: {
        active: iconBase + "car-marker-green.png",
        inactive: iconBase + "car-marker-yellow.png",
        stop: iconBase + "car-marker-red.png"
    },
    truck: {
        icon: iconBase + "truck.png"
    },
    bus: {
        icon: iconBase + "bus.png"
    }
};
function initialize(locations = [], vehicleType, ignStatus = []) {
    var map_plote = locations.length
        ? locations[0]
        : new google.maps.LatLng(22.988963, 78.219874);
    map = new google.maps.Map(document.getElementById("map"), {
        center: map_plote,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        zoom: 4
    });
    // var markers = [];
    // var path = [];
    // for (var i = 0; i < locations.length; ++i) {
    // var NewMarker = new google.maps.Marker({
    // map: map,
    // position: locations[i]
    // });

    // // MARKER ADDRESS
    // var infowindow = new google.maps.InfoWindow();
    // var i;
    // google.maps.event.addListener(
    // NewMarker,
    // "click",
    // (function(NewMarker, i) {
    // return function() {
    // var latLng = new google.maps.LatLng(locations[i]);
    // var geocoder = new google.maps.Geocoder();
    // geocoder.geocode({ location: latLng }, function(
    // results,
    // status
    // ) {
    // if (status === "OK") {
    // if (results[0]) {
    // let add =
    // '<div id="content" class="card p-0" style="max-width: 240px;">' +
    // '<div class="card-header text-white text-center" style="background-color: #730070;"><h5>VEHICLE LOCATION</h5><b>' +
    // "VehicleNumber" +
    // "</b></div>" +
    // '<div id="bodyContent"  class="card-body">' +
    // '<b class="mapAddress">' +
    // results[0].formatted_address +
    // "</b>" +
    // "</div>" +
    // "</div>";
    // infowindow.setContent(add);
    // infowindow.open(map, NewMarker);
    // }
    // }
    // });
    // };
    // })(NewMarker, i)
    // );
    // // MARKER INFO WINDOW

    // markers.push(marker);
    // path.push(NewMarker.position);
    // }
    marker = new google.maps.Marker({
        icon: {
            url: icons.car.inactive,
            size: new google.maps.Size(100, 100),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(18, 13),
            scaledSize: new google.maps.Size(35, 27)
        },
        position: locations[0],
        map: map
    });
    locations.length ? map.setZoom(14) : "";
    var polyline = new google.maps.Polyline({
        map: map,
        geodesic: true,
        path: locations,
        strokeColor: "#c447c2",
        strokeOpacity: 1.0,
        strokeWeight: 2
    });
    var index = 0;
    var renderLong,
        renderLat = 0;
    if (index < locations.length) {
        setInterval(() => {
            if (locations.length > index + 1)
                animatedMove(
                    marker,
                    7,
                    locations[index],
                    locations[index + 1],
                    ignStatus[index]
                );
            index++;
        }, 1000);
    }

    // var polyline = google.maps.Polyline({
    //     map: map,
    //     geodesic: true,
    //     path: locations,
    //     strokeColor: "#c447c2",
    //     strokeOpacity: 1.0,
    //     strokeWeight: 2
    // });
}

setTimeout(initialize(), 1);

// move marker from position current to moveto in t seconds
function animatedMove(marker, t, current, moveto, ignStatus) {
    var lat = current.lat;
    var lng = current.lng;
    var currentIgnStatus = ignStatus;
    var $icon;
    switch (currentIgnStatus) {
        case 0:
            $icon = icons.car.inactive;
            break;
        case 1:
            $icon = icons.car.active;
            break;
        default:
            $icon = icons.car.stop;
            break;
    }
    var deltalat = (moveto.lat - current.lat) / 2;
    var deltalng = (moveto.lng - current.lng) / 2;

    var delay = 10 * t;
    var LatLng;
    for (var i = 0; i < 2; i++) {
        var rotationAngle = i;
        (function(ind) {
            setTimeout(function() {
                var newlat = marker.position.lat();
                var newlng = marker.position.lng();
                newlat += deltalat;
                newlng += deltalng;
                latlng = new google.maps.LatLng(newlat, newlng);
                oldlat = newlat - deltalat;
                oldlng = newlng - deltalng;
                oldLatlng = new google.maps.LatLng(oldlat, oldlng);
                var rotationAngle = google.maps.geometry.spherical.computeHeading(
                    oldLatlng,
                    latlng
                );
                var markerDOM = $('#map img[src*="' + iconBase + '"]');
                markerDOM.attr("src", $icon);
                markerDOM.css({
                    transform: "rotate(" + rotationAngle + "deg)"
                });
                marker.setPosition(latlng);
                // var polyline = new google.maps.Polyline({
                //     map: map,
                //     geodesic: true,
                //     path: [oldLatlng, latlng],
                //     strokeColor: "#c447c2",
                //     strokeOpacity: 1.0,
                //     strokeWeight: 2
                // });
            }, delay * ind);
        })(i);
    }
}
function getVehiclePlayback(imei, vehicleType) {
    var csrf_token = $("input[name='_token']").val();
    var url = $("input.request_url").val();
    console.log(url);

    $.ajax({
        url: url,
        type: "post",
        dataType: "json",
        data: {
            imei: imei,
            _token: csrf_token
        },
        success: data => {
            var locations = data.path;
            var ignition = data.ignition;
            map.setCenter(locations[0]);
            map.setZoom(14);
            initialize(locations, vehicleType, ignition);
        }
    });
}
