let map;
const markers = [];
function removePlace(event) {
    const item = event.target.parentElement;
    const placeId = item.children.item(0).value;
    const token = document.getElementsByName('_token');
    const list = document.getElementById("objects");
    const request = new XMLHttpRequest();
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200) {
            if(JSON.parse(request.response).result == "success") {
                list.removeChild(item);
                markers.filter((value) => {
                    if(value.placeId == placeId) {
                        value.marker.setMap(null);
                    }
                });
            }
        }
    }
    request.open("POST", "/removeLocation");
    request.setRequestHeader("Content-Type", "application/json");
    request.setRequestHeader("X-CSRF-TOKEN", token[0].value);
    request.send(JSON.stringify({placeId}));
}
function addObjectToMap(object) {
    const list = document.getElementById("objects");
    const item = document.createElement("li");
    const id = document.createElement("input");
    const button = document.createElement("i");
    item.className = "list-group-item";
    item.textContent = object.place.name;
    id.type = "hidden";
    id.value = object.placeId;
    button.className = "bi bi-x-lg";
    button.onclick = removePlace;
    item.append(id);
    item.append(button);
    list.append(item);
}
function addObject(object) {
    const token = document.getElementsByName('_token');
    const request = new XMLHttpRequest();
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200) {
            addObjectToMap(object);
        }
    }
    request.open("POST", "/addLocation");
    request.setRequestHeader("Content-Type", "application/json");
    request.setRequestHeader("X-CSRF-TOKEN", token[0].value);
    request.send(JSON.stringify(object));
}
function getPlace(placeId, callback) {
    const request = {
        placeId,
        fields: ["name", "address_components", "formatted_address", "geometry"],
    };
    const service = new google.maps.places.PlacesService(map);
    service.getDetails(request, (place, status) => {
        if (status === google.maps.places.PlacesServiceStatus.OK && place) {
            markers.push({placeId, marker: new google.maps.Marker({
                position: place.geometry.location,
                map: map
            })});
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
    map = new google.maps.Map(document.getElementById("map"), {
        center: {lat: 47.8229, lng: 35.1903},
        zoom: 13,
    });
    const token = document.getElementsByName('_token');
    const request = new XMLHttpRequest();
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200 && request.responseText) {
            const locations = JSON.parse(request.response);
            const list = document.getElementById("objects");
            locations.forEach((location) => {
                getPlace(location.placeId, addObjectToMap);
            });
        }
    }
    request.open("GET", "/getLocations");
    request.setRequestHeader("Content-Type", "application/json");
    request.setRequestHeader("X-CSRF-TOKEN", token[0].value);
    request.send();
    map.addListener("click", function (event) {
        const geocoder = new google.maps.Geocoder();
        if(event.placeId) {
            getPlace(event.placeId, addObject);
        }
        else {
            geocodeLatLng(geocoder, map, event.latLng, addObject);
        }
    });
}
