function initMap() {
    const map = new google.maps.Map(document.getElementById("userMap"), {
        center: {lat: 47.8229, lng: 35.1903},
        zoom: 13,
    });
    const locationId = document.getElementById("location");
    const request = {
        placeId: locationId.value,
        fields: ["name", "address_components", "formatted_address", "geometry"],
    };
    const service = new google.maps.places.PlacesService(map);
    service.getDetails(request, (place, status) => {
        if (status === google.maps.places.PlacesServiceStatus.OK && place) {
            map.setCenter(place.geometry.location);
            new google.maps.Marker({
                    position: place.geometry.location,
                    map: map
            });
        }
    });
}
