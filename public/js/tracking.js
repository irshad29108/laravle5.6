var global_map, global_markers;
var lat, lng, LatLng, polyline, ingitionStatus, vehicleSpeed, packetTime;
var baseURI = $(".base_URL").val();
var iconBase = baseURI + "/img/objects/";
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
var inputLat = $(".lat")
    .val()
    .trim()
    .split(",");
var inputLong = $(".long")
    .val()
    .trim()
    .split(",");
var vehicles = $(".vehicle")
    .val()
    .trim()
    .split(",");
var speed = "";
// var speed = $(".speed")
//     .val()
//     .trim()
//     .split(",");

var defaultLocation = new google.maps.LatLng(22.988963, 78.219874);
var map = new google.maps.Map(document.getElementById("map"), {
    zoom: 4,
    center: defaultLocation,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    travelMode: google.maps.DirectionsTravelMode.WALKING
});
$(document).ready(function() {
    var locations = [];
    var latArray = inputLat;
    var longArray = inputLong;
    for (let index = 0; index < longArray.length; index++) {
        locations.push({
            lat: parseFloat(latArray[index]),
            lng: parseFloat(longArray[index])
        });
    }
    function initMap() {
        var icon_url;
        var markers = locations.map(function(location, i) {
            if (speed[i] > 0) {
                icon_url = icons.car.stop;
            } else {
                icon_url = icons.car.active;
            }

            var marker = new google.maps.Marker({
                position: location,
                icon: {
                    url: icon_url,
                    size: new google.maps.Size(100, 100),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(38, 32)
                },
                map: map,
                title: vehicles[i],
                zIndex: i
            });
            marker.addListener("click", function() {
                var infowindow = new google.maps.InfoWindow();
                var geocoder = new google.maps.Geocoder();
                var LatLng = new google.maps.LatLng(location);
                geocoder.geocode({ location: LatLng }, function(
                    results,
                    status
                ) {
                    if (status === "OK") {
                        if (results[0]) {
                            let add =
                                '<div id="content" class="card p-0" style="max-width: 240px;">' +
                                '<div class="card-header text-white text-center" style="background-color: #730070;"><h5>VEHICLE LOCATION</h5><b>' +
                                vehicles[i] +
                                "</b></div>" +
                                '<div id="bodyContent"  class="card-body">' +
                                '<b class="mapAddress">' +
                                results[0].formatted_address +
                                "</b>" +
                                "</div>" +
                                "</div>";
                            infowindow.setContent(add);
                            infowindow.open(map, marker);
                        }
                    }
                });
            });
            return marker;
        });
        global_map = map;
        global_markers = markers;
        var markerCluster = new MarkerClusterer(map, markers, {
            imagePath:
                "https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m"
        });
    }
    setTimeout(initMap(), 1000);
});
function mapSetZoom(imei) {
    let indexOfVehicle = vehicles.indexOf(imei);
    let centerCoordinates = new google.maps.LatLng(
        inputLat[indexOfVehicle],
        inputLong[indexOfVehicle]
    );
    map.setCenter(centerCoordinates);
    smoothZoom(map, 18, map.getZoom());
}

function smoothZoom(map, max, counter) {
    if (counter >= max) {
        return;
    } else {
        zoomVar = google.maps.event.addListener(map, "zoom_changed", function(
            event
        ) {
            google.maps.event.removeListener(zoomVar);
            smoothZoom(map, max, counter + 1);
        });
        setTimeout(function() {
            map.setZoom(counter);
        }, 80);
    }
}

function trackVehicle(imei) {
    clearAllIntervals();
    const token = $("._token").val();
    $("a.active")
        .removeClass("active")
        .css("border", "");
    $("a b:contains(" + imei + ")")
        .closest("a")
        .addClass("active");
    $.ajax({
        url: "" + baseURI + "/maps/getLocation",
        type: "post",
        data: {
            _token: token,
            imei: imei
        },
        beforeSend: function() {
            if ($("#mapLoaderImage").hasClass("d-none"))
                $("#mapLoaderImage").removeClass("d-none");
        },
        success: function(response) {
            if (response.data.lat != 0) {
                var lat = parseFloat(response.data.lat);
                var lng = parseFloat(response.data.lng);
                var LatLng = new google.maps.LatLng(lat, lng);
                var map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 16,
                    center: LatLng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    travelMode: google.maps.DirectionsTravelMode.WALKING
                });

                var marker = new google.maps.Marker({
                    icon: {
                        url: icons.car.active,
                        size: new google.maps.Size(100, 100),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(25, 18),
                        scaledSize: new google.maps.Size(50, 38)
                    },
                    position: LatLng,
                    title: "" + imei + "",
                    map: map
                });
                marker.addListener("click", function() {
                    var infowindow = new google.maps.InfoWindow();
                    var geocoder = new google.maps.Geocoder();
                    geocoder.geocode({ location: LatLng }, function(
                        results,
                        status
                    ) {
                        if (status === "OK") {
                            if (results[0]) {
                                // $(".item-location p.item-content")
                                //     .attr("title", results[0].formatted_address)
                                //     .html(results[0].formatted_address);

                                let add =
                                    '<div id="content" class="card p-0" style="max-width: 240px;">' +
                                    '<div class="card-header text-white text-center" style="background-color: #730070;"><h5>VEHICLE LOCATION</h5><b>' +
                                    imei +
                                    "</b></div>" +
                                    '<div id="bodyContent"  class="card-body">' +
                                    '<b class="mapAddress">' +
                                    results[0].formatted_address +
                                    "</b>" +
                                    "</div>" +
                                    "</div>";
                                infowindow.setContent(add);
                                infowindow.open(map, marker);
                            }
                        }
                    });
                });

                // FLAG MARKER
                var flagMarker = new google.maps.Marker({
                    icon: {
                        url: baseURI + "/img/flag.png",
                        size: new google.maps.Size(100, 100),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(10, 40),
                        scaledSize: new google.maps.Size(20, 45)
                    },
                    animation: google.maps.Animation.DROP,
                    position: LatLng,
                    map: map
                });

                flagMarker.addListener("click", function() {
                    var infowindow = new google.maps.InfoWindow();
                    var geocoder = new google.maps.Geocoder();
                    geocoder.geocode({ location: LatLng }, function(
                        results,
                        status
                    ) {
                        if (status === "OK") {
                            if (results[0]) {
                                // $(".item-location p.item-content")
                                //     .attr("title", results[0].formatted_address)
                                //     .html(results[0].formatted_address);

                                let add =
                                    '<div id="content" class="card p-0" style="max-width: 240px;">' +
                                    '<div class="card-header text-white text-center" style="background-color: #730070;"><h5>VEHICLE LOCATION</h5><b>' +
                                    imei +
                                    "</b></div>" +
                                    '<div id="bodyContent"  class="card-body">' +
                                    '<b class="mapAddress">' +
                                    results[0].formatted_address +
                                    "</b>" +
                                    "</div>" +
                                    "</div>";
                                infowindow.setContent(add);
                                infowindow.open(map, flagMarker);
                            }
                        }
                    });
                });
                // FLAG MARKER ENDS

                var counter = 0;
                setInterval(() => {
                    $.ajax({
                        url: "" + baseURI + "/maps/getLocation",
                        type: "post",
                        data: {
                            _token: token,
                            imei: imei
                        },
                        success: function(response) {
                            if (
                                $("#mapLoaderImage").hasClass("d-none") ===
                                false
                            ) {
                                $("#mapLoaderImage").addClass("d-none");
                            }
                            if (lat) {
                                oldLatLng = new google.maps.LatLng(
                                    parseFloat(lat),
                                    parseFloat(lng)
                                );
                            }

                            lat = parseFloat(response.data.lat);
                            lng = parseFloat(response.data.lng);
                            ingitionStatus = parseFloat(response.data.Ignition);
                            vehicleSpeed = parseFloat(response.data.speed);
                            endTime = response.data.reachedOn;
                            var icon_url;
                            switch (ingitionStatus) {
                                case 0:
                                    icon_url = icons.car.stop;
                                    break;
                                case 1:
                                    icon_url = icons.car.stop;
                                    break;
                                default:
                                    icon_url = icons.car.inactive;
                                    break;
                            }
                            LatLng = new google.maps.LatLng(lat, lng);
                            if (
                                lat != 0 ||
                                lng != 0 ||
                                (oldLatLng.lat() != LatLng.lat() &&
                                    oldLatLng.lng() != LatLng.lng())
                            ) {
                                var rotationAngle = google.maps.geometry.spherical.computeHeading(
                                    oldLatLng,
                                    LatLng
                                );
                                if (rotationAngle != 0) {
                                    $('#map img[src*="' + iconBase + '"]').css({
                                        transform:
                                            "rotate(" + rotationAngle + "deg)"
                                    });
                                }
                                marker.setPosition(LatLng);
                                map.panTo(LatLng);
                                // ********* UPDATING END LOCATION IN DOM */
                                // var geocoder = new google.maps.Geocoder();
                                // geocoder.geocode({ location: LatLng }, function(
                                //     results,
                                //     status
                                // ) {
                                //     if (status === "OK") {
                                //         if (results[0]) {
                                //             $(".item-location p#end_location")
                                //                 .attr(
                                //                     "title",
                                //                     results[0].formatted_address
                                //                 )
                                //                 .html(
                                //                     results[0].formatted_address
                                //                 );
                                //         }
                                //     }
                                // });
                                // ********** UPDATING END LOCATION IN DOM ENDS */

                                //************** UPDATING VEHICLE LOCATION IN DOM STARTS */
                                $("#end_location")
                                    .html(endTime)
                                    .attr("title", endTime);
                                var vehicleDiv = $(".kt-notification .d-flex");
                                if (ingitionStatus == 1 && vehicleSpeed > 0) {
                                    vehicleDiv
                                        .find("#vehicleCurrentSpeed")
                                        .html(vehicleSpeed + " KM/H")
                                        .removeClass("text-muted")
                                        .addClass("text-success")
                                        .attr("title", vehicleSpeed + " KM/H");
                                    vehicleDiv
                                        .find("img.img-responsive")
                                        .attr("src", "");
                                    vehicleDiv
                                        .find("img.img-responsive")
                                        .attr(
                                            "src",
                                            "" + icons.car.active);
                                    vehicleDiv
                                        .find(".badge-danger")
                                        .removeClass("badge-danger")
                                        .addClass("badge-success")
                                        .html("RUNNING");
                                } else {
                                    vehicleDiv
                                        .find("img.img-responsive")
                                        .attr("src", "");
                                    vehicleDiv
                                        .find("img.img-responsive")
                                        .attr(
                                            "src",
                                            "" + icons.car.stop);
                                    vehicleDiv
                                        .find(".badge-success")
                                        .removeClass("badge-success")
                                        .addClass("badge-danger")
                                        .html("STOP");
                                }
                                //************** UPDATING VEHICLE STATUS IN DOM */
                                if (
                                    oldLatLng !== "undefined" &&
                                    oldLatLng.lat() != LatLng.lat()
                                ) {
                                    polyline = new google.maps.Polyline({
                                        map: map,
                                        geodesic: true,
                                        path: [oldLatLng, LatLng],
                                        strokeColor: "#c447c2",
                                        strokeOpacity: 1.0,
                                        strokeWeight: 2,
                                        icons: [
                                            {
                                                icon: {
                                                    path:
                                                        google.maps.SymbolPath
                                                            .FORWARD_CLOSED_ARROW
                                                },
                                                offset: "50%"
                                            }
                                        ]
                                    });
                                }
                            }
                            if (
                                oldLatLng.lat() != "undefined" &&
                                oldLatLng.lat() == LatLng.lat()
                            ) {
                                counter++;
                            }
                            // if (counter == 25) {
                            //     clearAllIntervals();
                            //     counter = 0;
                            // }
                        }
                    });
                }, 4000);
            } else {
                var defaultLocation = new google.maps.LatLng(
                    22.988963,
                    78.219874
                );
                var map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 4,
                    center: defaultLocation,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    travelMode: google.maps.DirectionsTravelMode.WALKING
                });
                toastr.error("Vehicle - " + imei + " is not running.");
            }
        }
    });
}

function clearAllIntervals() {
    for (let index = 0; index < 10000; index++) {
        window.clearInterval(index);
    }
    return true;
}

$(document).ready(() => {
    $(".vehicle-search").keyup(() => {
        let searchStr = $(".vehicle-search").val();
        let allItems = $(".kt-quick-panel__content .kt-notification");
        if ($(".vehicle-search").val() != "" && searchStr.length % 3 == 0) {
            KTApp.block(".kt-header", {
                overlayColor: "#000000",
                type: "v2",
                state: "primary",
                message: "Searching matching records..."
            });

            let vehicles = allItems
                .find("b.iacmap-vehicle__item .vehicle_number")
                .filter(searchStr);
            console.log(vehicles);
            // regExSearch = "^\\s" + searchStr + "\\s*$";
            // var response = vehicles.search(regExSearch, true, false);

            KTApp.unblock(".kt-header");
        } else {
            allItems.show();
            KTApp.unblock(".kt-header");
        }
    });
});

// ANIMATE MARKER
// function animatedMove(marker, t, current, moveto, ignStatus) {
//     var lat = current.lat;
//     var lng = current.lng;
//     var currentIgnStatus = ignStatus;
//     var $icon;
//     switch (currentIgnStatus) {
//         case 0:
//             $icon = icons.car.inactive;
//             break;
//         case 1:
//             $icon = icons.car.active;
//             break;
//         default:
//             $icon = icons.car.stop;
//             break;
//     }
//     var deltalat = (moveto.lat - current.lat) / 4;
//     var deltalng = (moveto.lng - current.lng) / 4;

//     var delay = 20 * t;
//     var LatLng;
//     for (var i = 0; i < 4; i++) {
//         var rotationAngle = i;
//         (function(ind) {
//             setTimeout(function() {
//                 var newlat = marker.position.lat();
//                 var newlng = marker.position.lng();
//                 newlat += deltalat;
//                 newlng += deltalng;
//                 latlng = new google.maps.LatLng(newlat, newlng);
//                 oldlat = newlat - deltalat;
//                 oldlng = newlng - deltalng;
//                 oldLatlng = new google.maps.LatLng(oldlat, oldlng);
//                 var rotationAngle = google.maps.geometry.spherical.computeHeading(
//                     oldLatlng,
//                     latlng
//                 );
//                 var markerDOM = $('#map img[src*="' + iconBase + '"]');
//                 markerDOM.attr("src", $icon);
//                 markerDOM.css({
//                     transform: "rotate(" + rotationAngle + "deg)"
//                 });
//                 marker.setPosition(latlng);
//             }, delay * ind);
//         })(i);
//     }
// }
