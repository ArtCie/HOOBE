function changeLikeState(articleId){
    console.log(articleId);
    $(".heart").toggleClass("is-active");

    let heartState = document.querySelector(".heart");
    let data = {};
        data["state"] = heartState.className.includes('is-active');
        data["articleId"] = articleId;
        console.log(JSON.stringify(data));
    fetch("/update_like", {
        method: "PUT",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        return response;
    }).then(function (response) {
        console.log(response);
    });
}