function initMap() {
    navigator.geolocation.getCurrentPosition(showPosition);
    //
    //
    // const krk = { lat: 50.071602, lng: 19.942113 };
    // const map = new google.maps.Map(document.getElementById("map"), {
    //     zoom: 17,
    //     center: krk,
    //     mapId: 'f5a8682e636f2b1d',
    //     fullscreenControl: false,
    //     zoomControl: false,
    //     mapTypeControl: false,
    //     scaleControl: false,
    //     streetViewControl: false
    // });
    // const marker = new google.maps.Marker({
    //     position: krk,
    //     map: map,
    // });
}


function showPosition(position) {
    $(function () {
        const data = {};
        // data['latitude'] = position.coords.latitude;
        // data['longitude'] = position.coords.longitude;
        data['latitude'] = 50.09;
        data['longitude'] = 19.94;

        console.log(data);
        $.ajax({
            data: data,
            type: 'get',
            success: function (response) {
                putMarkers(JSON.parse(response));
            }
        });
    });
}

function putMarkers(scooters){

    const krk = { lat: 50.071602, lng: 19.942113 };
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 17,
        center: krk,
        mapId: 'f5a8682e636f2b1d',
        fullscreenControl: false,
        zoomControl: false,
        mapTypeControl: false,
        scaleControl: false,
        streetViewControl: false
    });
    const marker = new google.maps.Marker({
        position: krk,
        map: map,
        optimized: true
    });


    const markers = {
      "Bolt": {url: "https://i.ibb.co/x7LVtRQ/Bolt.png", size: new google.maps.Size(50, 50), scaledSize: new google.maps.Size(50, 50)},
      "Tier": {url: "https://i.ibb.co/pX0pgzK/Tier.png", size: new google.maps.Size(50, 50), scaledSize: new google.maps.Size(50, 50)},
      "Lime": {url: "https://i.ibb.co/BnqdwV8/Lime.png", size: new google.maps.Size(50, 50), scaledSize: new google.maps.Size(50, 50)}
    };
    console.log(scooters);
    for (const [key, value] of Object.entries(scooters)) {
        console.log(key, value);
        for(const scooter of value){
            new google.maps.Marker({
                position : {lat: scooter["lat"], lng: scooter["lng"]},
                map,
                title: key,
                icon: markers[key],
            });
        }
    }
}