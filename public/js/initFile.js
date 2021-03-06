function initMap() {
    navigator.geolocation.getCurrentPosition(showPosition, err, {maximumAge:60000, timeout:5000, enableHighAccuracy:true});
}

function err(){
    console.log('error');
}

function showPosition(position) {
    $(function () {
        const data = {};
        data['latitude'] = position.coords.latitude;
        data['longitude'] = position.coords.longitude;

        $.ajax({
            data: data,
            type: 'get',
            success: function (response) {
                putMarkers(JSON.parse(response), data);
            }
        });
    });
}

function putMarkers(vehicles, data){
    console.log(vehicles);
    const userPosition = { lat: data['latitude'], lng: data['longitude'] };
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 17,
        center: userPosition,
        mapId: 'f5a8682e636f2b1d',
        fullscreenControl: false,
        zoomControl: false,
        mapTypeControl: false,
        scaleControl: false,
        streetViewControl: false
    });
    const marker = new google.maps.Marker({
        position: userPosition,
        map: map,
        optimized: true
    });


    let geocoder = new google.maps.Geocoder();
    codeAddress(geocoder, map, vehicles["private_vehicles"]);

    const markers = {
      "Bolt": {url: "https://i.ibb.co/x7LVtRQ/Bolt.png", size: new google.maps.Size(50, 50), scaledSize: new google.maps.Size(50, 50)},
      "Tier": {url: "https://i.ibb.co/pX0pgzK/Tier.png", size: new google.maps.Size(50, 50), scaledSize: new google.maps.Size(50, 50)},
      "Lime": {url: "https://i.ibb.co/BnqdwV8/Lime.png", size: new google.maps.Size(50, 50), scaledSize: new google.maps.Size(50, 50)}
    };
    for (const [key, value] of Object.entries(vehicles["scooters"])) {
        for(const scooter of value){
            var result = get_result(key, scooter);

            const infowindow = new google.maps.InfoWindow({
                content: result,
            });


            const newMarker = new google.maps.Marker({
                position : {lat: scooter["lat"], lng: scooter["lng"]},
                map,
                title: key,
                icon: markers[key],
                optimized: true
            });

            newMarker.addListener("click", () => {
            infowindow.open({
                anchor: newMarker,
                map,
                shouldFocus: true,
            });
                });
        }
    }
}

function get_result(key, value){
    switch(key){
        case 'Tier':
            return '<h1> Tier </h1>' +
                    'max speed = ' + value["maxSpeed"] + '<br>' +
                    'battery level = ' + value['batteryLevel']
        case 'Bolt':
            return '<h1> Bolt </h1>' +
                'distance on charge = ' + value['distance_on_charge'] + '<br>' +
                'charge = ' + value['charge']

        case 'Lime':
            return '<h1> Lime </h1>'
        case 'private_vehicles':
            break;
        default:
            return 'error';
    }
                        }

function getDescriptionVehicle(privateVehicle) {
    console.log(privateVehicle);
    var result = '<h1> Private vehicle </h1>'+
        'Address: ' + privateVehicle['address'] + '<br>' +
        'Rental Name: ' + privateVehicle['full_name'] + '<br>' +
        'Email Address: ' + privateVehicle['email'] + '<br>' +
        'Vehicle Name: ' + privateVehicle['name'] + '<br>' +
        'Last Technical Review Date: ' + privateVehicle['last_technical_review_date'] + '<br>' +
        'Production Name: ' + privateVehicle['production_year'] + '<br>' +
        'Price: ' + privateVehicle['price'] + '<br>' +
        'Rent From: ' + privateVehicle['rent_from'] + '<br>' +
        'Rent To: ' + privateVehicle['rent_to'] + '<br>';
    for(const photo of privateVehicle['photos']){
        console.log(photo["name"].substring(4))
        result += '<img src="' + photo["name"].substring(4)+ '" alt="photo" style="width: 25em; height: auto"/> <br>'
    }
    return result;
}

function codeAddress(geocoder, map, privateVehicles) {
    for (const privateVehicle of privateVehicles) {
        geocoder.geocode({'address': privateVehicle["address"]}, function(results, status) {
            if (status === 'OK') {
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    title: privateVehicle['name'],
                    optimized: true,
                    icon: {size: new google.maps.Size(50, 50), scaledSize: new google.maps.Size(50, 50), url:'data:image/png;base64,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'}
                });

                var result = getDescriptionVehicle(privateVehicle);

                const infowindow = new google.maps.InfoWindow({
                    content: result,
                });

                marker.addListener("click", () => {
                    infowindow.open({
                        anchor: marker,
                        map,
                        shouldFocus: true,
                    });
                });

            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }
}