function removeUser(email, userid){
    const data = {"email": email};
    console.log(data);
    fetch("/remove_user", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        const element = document.getElementById("remove-all-" + userid.toString());
        element.parentNode.removeChild(element);
    });
}

function removeComment(commentId, idToRemove){
    const data = {"commentId": commentId};
    console.log(data);

    fetch("/remove_comment", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        const element = document.getElementById(idToRemove);
        element.parentNode.removeChild(element);
    });
}

function addArticle(){
    const header = document.getElementById("header").value;
    const content = document.getElementById("content").value;

    const data = {'header': header, 'content': content}

    fetch("/add_article", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        header.value = "SUCCESS";
        content.value = "SUCCESS";
    });
}