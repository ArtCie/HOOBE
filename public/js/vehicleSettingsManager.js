function editVehicle(vehicleId){
    const data = {'vehicleId': vehicleId}
    console.log("SIEMANO");
    fetch("/update_vehicle", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        return response.json();
    }).then(function (settings) {
        setValues(settings["data"][0]);
})
}

function setValues(response){
    const params = '?' +
        'first_name=' + response["first_name"] +
        '&last_name=' + response["last_name"] +
        '&street_name=' + response["street_name"] +
        '&address_number=' + response["address_number"] +
        '&country_name=' + response["country_name"] +
        '&city_name=' + response["city_name"] +
        '&postal_code=' + response["postal_code"] +
        '&vehicle_name=' + response["vehicle_name"] +
        '&vehicle_type=' + response["vehicle_type"] +
        '&production_year=' + response["production_year"] +
        '&last_technical_review_date=' + response["last_technical_review_date"].slice(0, response["last_technical_review_date"].length - 9) +
        '&rent_from=' + response["rent_from"].slice(0, response["rent_from"].length - 9) +
        '&rent_to=' + response["rent_to"].slice(0, response["rent_to"].length - 9) +
        '&price=' + response["price"] +
        '&vehicle_id=' + response["vehicle_id"]
    console.log(params);
    window.location.replace(window.location.protocol + "//" + window.location.host + '/rent_vehicle' + params);

    console.log(response);
}

function removeVehicle(vehicleId){
    const data = {'vehicleId': vehicleId}
    console.log(vehicleId);
    fetch("/remove_vehicle", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        console.log(response);
    });
    const element = document.getElementById("vehicle" + vehicleId);
    element.parentNode.removeChild(element);
}