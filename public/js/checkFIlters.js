function load_filters(){
    const data = {
        'filters': true
    };
    $.ajax({
        data: data,
        type: 'get',
        success: function (response) {
            update_filters(JSON.parse(response));
        }
    });
}

function update_filters(filters){
    document.querySelector("#bolt_box").checked = filters["bolt"];
    document.querySelector("#lime_box").checked = filters["lime"];
    document.querySelector("#tier_box").checked = filters["tier"];
    document.querySelector("#panek_box").checked = filters["panek"];
    document.querySelector("#private_vehicles_box").checked = filters["private_vehicles"];
}


function put_filters(){
    let data = {};
    data["bolt"] = document.querySelector("#bolt_box").checked;
    data["lime"] = document.querySelector("#lime_box").checked;
    data["tier"] = document.querySelector("#tier_box").checked;
    data["panek"] = document.querySelector("#panek_box").checked;
    data["private_vehicles"] = document.querySelector("#private_vehicles_box").checked;

    console.log(data);
    $.ajax({
        data: JSON.stringify(data),
        type: 'put',
    });
    window.location.reload();
}