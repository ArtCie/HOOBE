function validRentalDetails(){
    let rentingDetails = validRentingDetails();
    let vehicleDetails = validVehicleDetails();
    let rentalDetails = validRentalDetail();
    if(!rentingDetails["errors"] && !vehicleDetails["errors"] && !rentalDetails["errors"]){
        delete rentingDetails["errors"];
        delete vehicleDetails["errors"];
        delete rentalDetails["errors"];

        let data = {
            "rentingDetails": rentingDetails,
            "vehicleDetails": vehicleDetails,
            "rentalDetails": rentalDetails
        }
        fetch("/save_vehicle", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            return response;
        }).then(function (response) {
            console.log(response);
            window.location.replace(window.location.protocol + "//" + window.location.host + '/main_page');
        });
    }
}


function validRentingDetails(){

    let errors = [];

    let firstName = document.getElementById("first_name");
    firstName = validName(firstName, errors, "first name");

    let lastName = document.getElementById("last_name");
    lastName = validName(lastName, errors, "last name");

    let address = document.getElementById("address");
    address = validName(address, errors, "address");

    let addressNumber = document.getElementById("address_number");
    addressNumber = validNumber(addressNumber, errors);

    let country = document.getElementById("country");
    country = validCountry(country, errors);

    let city = document.getElementById("city");
    city = validCity(city);

    let postalCode = document.getElementById("postal_code");
    postalCode = validPostalCode(postalCode, errors);

    displayErrors(errors, "errors");

    return {
        "firstName": firstName,
        "lastName": lastName,
        "address": address,
        "addressNumber": addressNumber,
        "country": country,
        "city": city,
        "postalCode": postalCode,
        "errors": errors.length !== 0
    }

}


function validName(name, errors, variable_name) {
    if(name.value === "" || !(/^[a-z A-Z]+$/.test(name.value))){
        errors.push("Wrong " + variable_name + "!");
        name.style.color = "red";
    }
    else{
        name.style.color = "black";
    }
    return buildString(name.value);
}

function buildString(name){
    let text_split = name.split(" ");
    let result = ""
    for (const name of text_split){
        result += name.charAt(0).toUpperCase() + name.slice(1) + " ";
    }
    return result.slice(0, -1);
}

function validNumber(addressNumber, errors) {
    if(!(/\d/.test(addressNumber.value))){
        errors.push("Address number is not valid!")
        addressNumber.style.color="red";
    }
    else{
        addressNumber.style.color="black";
    }
    return addressNumber.value;
}

function validCountry(country, errors) {
    let country_name = country.value.charAt(0).toUpperCase() + country.value.slice(1);
    let countries = [
        "Poland",
        "Germany",
        "United States",
        "England"
    ]
    if(!countries.includes(country_name)){
        country.style.color="red";
        errors.push("Country is not valid!");
    }
    else{
        country.style.color="black";
    }
    return country_name;
}

function validCity(city) {
    return buildString(city.value)
}

function validPostalCode(postalCode, errors) {
    if(!postalCode.value.match("[0-9]{2}-[0-9]{3}")){
        errors.push("Wrong postal code!")
        postalCode.style.color="red";
    }
    else{
        postalCode.style.color="black";
    }
    return postalCode.value.substr(0,6);
}

function validVehicleDetails() {
    let errors = [];

    let vehicleType = document.getElementById("vehicle_type");
    vehicleType = validIfEmpty(vehicleType, errors);

    let vehicleName = document.getElementById("vehicle_name");
    vehicleName = validIfEmpty(vehicleName, errors);

    let productionYear = document.getElementById("production_year");
    productionYear = validYear(productionYear, errors);

    let lastTechnicalReviewDate = document.getElementById("last_technical_review_date");
    lastTechnicalReviewDate = validTechnicalReviewDate(lastTechnicalReviewDate, errors);


    displayErrors(errors, "errors-vehicle");


    return {
        "vehicleType": vehicleType,
        "vehicleName": vehicleName,
        "productionYear": productionYear,
        "lastTechnicalReviewDate": lastTechnicalReviewDate,
        "errors": errors.length !== 0
    }
}

function displayErrors(errors, id_name) {
    if (errors) {
        let result = "";
        let i = 0;
        for (const error of errors) {
            result += error + "<br />";
            if (i === 2) {
                break;
            }
            i += 1;
        }
        document.getElementsByClassName(id_name)[0].innerHTML = result;
    }
}

function validIfEmpty(name, errors){
    if(name.value === ""){
        name.style.color = "red";
        errors.push("Wrong vehicle type!")
    }
    else{
        name.style.color = "black";
    }
    return name.value.toLowerCase();
}

function validYear(productionYear, errors){
    const year = new Date().getFullYear();
    let is_integer = Number.isInteger(parseInt(productionYear.value));
    if(!is_integer){
        productionYear.style.color="red";
        errors.push("Wrong production year!");
    }
    else{
        const prodYear = parseInt(productionYear.value);
        if(prodYear > year){
            productionYear.style.color="red";
            errors.push("Production year needs to be in the past lol");
        }
        else if(year - prodYear > 30){
            productionYear.style.color="red";
            errors.push("Vehicle is too old!");
        }
        else{
            productionYear.style.color="black";
        }
    }
    return productionYear.value;
}


function validTechnicalReviewDate(lastTechnicalReviewDate, errors) {
    let dateObj = Date.parse(lastTechnicalReviewDate.value);
    let todayDate = new Date();
    let dateDiffDays = Math.floor((todayDate - dateObj) / (1000*60*60*24))
    if(dateDiffDays < 0 ){
        lastTechnicalReviewDate.style.color="red";
        errors.push("Wrong review date!");
    }
    else if(dateDiffDays > 366){
        lastTechnicalReviewDate.style.color="red";
        errors.push("Technical review is not active!");
    }

    return dateObj;
}

function validRentalDetail(){
    let errors = [];

    let rentFrom = document.getElementById("rent_from");
    let rentFromDate = validDate(rentFrom, errors);

    let rentTo = document.getElementById("rent_to");
    let rentToDate = validDate(rentTo, errors);

    validDates(rentFrom, rentTo);

    let price = document.getElementById("price");
    price = validPrice(price, errors);

    let isNegotiable = document.getElementById("is_negotiable").checked;


    displayErrors(errors, "errors-rental-details");


    return {
        "rentFrom": rentFromDate,
        "rentTo": rentToDate,
        "price": price,
        "isNegotiable": isNegotiable,
        "errors": errors.length !== 0
    }
}


function validDate(date, errors) {
    let dateObj = Date.parse(date.value);
    let todayDate = new Date();
    let dateDiffDays = Math.floor((todayDate - dateObj) / (1000*60*60*24))
    if(dateDiffDays > 0 ){
        date.style.color="red";
        errors.push("Wrong date!");
    }
    return dateObj;
}

function validDates(dateFrom, dateTo, errors){
    let dateFromObj = Date.parse(dateFrom.value);
    let dateToObj = Date.parse(dateTo.value);

    if(Math.floor((dateToObj - dateFromObj) / (1000*60*60*24)) < 0){
        errors.push("Date until must be before date from!");
    }
}

function validPrice(price, errors){
    let priceValue = parseFloat(price.value);
    if(!priceValue){
        errors.push("Wrong price value!");
        price.style.color = "red";
    }
    else{
        price.style.color = "black";
    }
    return priceValue;

}
