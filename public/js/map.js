ymaps.ready(init);
function init(){
    const myMap = new ymaps.Map("map", {
        center: [47.838909, 35.139384],
        zoom: 7,
        type: "yandex#hybrid"
    });
    let mark;
    myMap.events.add('click', function (e) {
        if(mark) {
            myMap.geoObjects.remove(mark);
        }
        const coords = e.get('coords');
        const data = new FormData();
        const token = document.getElementsByName('_token');
        const session = document.getElementById("session");
        data.append("latitude", coords[0]);
        data.append("longitude", coords[1]);
        data.append("_token", token[0].value);
        data.append("_token", session.value);
        const request = new XMLHttpRequest();
        request.open("POST", "/addLocation");
        request.onreadystatechange = () => {
            if (request.readyState = 4 && request.status == 200) {
                mark = new ymaps.Placemark(coords, {
                    balloonContent: '',
                    iconCaption: ''
                });
                myMap.geoObjects.add(mark);
            }
        }
        request.send(data);

    });
}
