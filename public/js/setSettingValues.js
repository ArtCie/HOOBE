function initSettings(){
    fetch("/get_settings", {
        method: "GET",
        headers: {
            'Content-Type': 'application/json'
        },
    }).then(function (response) {
        return response.json();
    }).then(function (settings) {
        set_settings(settings);
    });
}

function set_settings(settings){
    console.log(settings);
    console.log(settings["birthday"]);
    console.log(settings["email"]);
    document.getElementsByName('email_address')[0].placeholder=settings["email"];
    document.getElementsByName('birthday')[0].placeholder=settings["birthday"];
}
