let map;
const markers = [];
window.onload = init;
function init() {
    const list = document.getElementById("objects");
    const modalElement = document.getElementById("editModal");
    const modal = new bootstrap.Modal(modalElement);
    const text = document.getElementById("objectName");
    const closeModal = document.getElementById("modalClose");
    const save = document.getElementById("save");
    closeModal.addEventListener("click", function () {
        modal.hide();
    });
    save.addEventListener("click", function (event) {
        const placeId = save.dataset.objectId;
        const objectItem = document.getElementById(placeId);
        const button = objectItem.children[0];
        const name = text.value;
        const token = document.getElementsByName('_token');
        objectItem.textContent = name;
        objectItem.appendChild(button);
        const request = new XMLHttpRequest();
        request.onreadystatechange = () => {
            if (request.readyState == 4 && request.status == 200) {
                if(JSON.parse(request.response).result == "success") {
                    modal.hide();
                }
            }
        };
        request.open("POST", "/updateLocation");
        request.setRequestHeader("Content-Type", "application/json");
        request.setRequestHeader("X-CSRF-TOKEN", token[0].value);
        request.send(JSON.stringify({placeId, name}));
    });
    for(let i = 0; i < list.children.length; i++) {
        getPlace(list.children[i].id, null);
        list.children[i].addEventListener("click", function (event) {
            list.children[i].children[0].onclick = null;
            text.value = list.children[i].textContent.trim();
            save.dataset.objectId = list.children[i].id;
            modal.show();
        });
    }
}
function removePlace(event) {
    const item = event.target.parentElement;
    const placeId = item.id;
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
    const button = document.createElement("i");
    item.className = "list-group-item object-list-item";
    item.textContent = object.place.name;
    item.id = object.placeId;
    button.className = "bi bi-x-lg";
    button.onclick = removePlace;
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
function addMarker(placeId, place) {
    markers.push({placeId, marker: new google.maps.Marker({
            position: place.geometry.location,
            map: map
    })});
}
function getPlace(placeId, callback) {
    const request = {
        placeId,
        fields: ["name", "address_components", "formatted_address", "geometry"],
    };
    const service = new google.maps.places.PlacesService(map);
    service.getDetails(request, (place, status) => {
        if (status === google.maps.places.PlacesServiceStatus.OK && place) {
            addMarker(placeId, place);
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
