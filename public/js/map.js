let map;
function addObject(object) {
    console.log(object);
    const list = document.getElementById("objects");
    const item = document.createElement("li");
    item.textContent = object.name;
    list.append(item);
}

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 47, lng: 35 },
        zoom: 8,
    });
    map.addListener("click", function (event) {
        const geocoder = new google.maps.Geocoder();
        if(event.placeId) {

            const request = {
                placeId: event.placeId,
                fields: ["name", "formatted_address", "geometry"],
            };
            const service = new google.maps.places.PlacesService(map);
            service.getDetails(request, (place, status) => {
                if (status === google.maps.places.PlacesServiceStatus.OK && place) {
                    const marker = new google.maps.Marker({
                        map,
                        position: place.geometry.location,
                    });
                    addObject(place);
                }
            });
        }
    });
}
