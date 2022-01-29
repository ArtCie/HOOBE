function editVehicle(vehicleId){

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