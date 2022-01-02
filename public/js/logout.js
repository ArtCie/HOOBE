function logout(){
    let data = {};
    data["logout"] = true;

    console.log(data);
    $.ajax({
        data: JSON.stringify(data),
        type: 'post',
        success: function (response) {
            window.location.reload();
            console.log(response);
        }
    });
}