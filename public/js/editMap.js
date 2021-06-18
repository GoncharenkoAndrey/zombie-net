let map;
let marker;
function setLocation(object) {
    const location = document.getElementById("location");
    location.value = object.placeId;
}
function getPlace(placeId, callback) {
    const request = {
        placeId,
        fields: ["name", "address_components", "formatted_address", "geometry"],
    };
    const service = new google.maps.places.PlacesService(map);
    service.getDetails(request, (place, status) => {
        if (status === google.maps.places.PlacesServiceStatus.OK && place) {
            marker = new google.maps.Marker({
                    position: place.geometry.location,
                    map: map
                });
            if(callback) {
                callback({place, placeId});
            }
        }
    });
}
function geocodeLatLng(geocoder, map, latLng, callback) {
    const latlng = {
        lat: latLng.lat(),
        lng: latLng.lng(),
    };
    geocoder.geocode({location: latlng}, (results, status) => {
        if (status === "OK") {
            if (results[0]) {
                if (results[0].place_id) {
                    getPlace(results[0].place_id, callback);
                }
            } else {
                window.alert("No results found");
            }
        } else {
            window.alert("Geocoder failed due to: " + status);
        }
    });
}
function initMap() {
    map = new google.maps.Map(document.getElementById("userMap"), {
        center: {lat: 47.8229, lng: 35.1903},
        zoom: 13,
    });
    map.addListener("click", function (event) {
        const geocoder = new google.maps.Geocoder();
        if(event.placeId) {
            getPlace(event.placeId, setLocation);
        }
        else {
            geocodeLatLng(geocoder, map, event.latLng, setLocation);
        }
    });
}
