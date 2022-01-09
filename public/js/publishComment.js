function publishComment(articleId){
    let content = document.getElementById("comment-content").value;
    if(content.length <  6){
        alert("Comment is too short!");
    }
    else{
        let data = {'articleId': articleId, 'comment': content}
        fetch("/publish_comment", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            return response.json();
        }).then(function (response) {
            console.log(response["email"]);
            console.log(response["insert_timestamp"]);
            console.log(response["comment"]);
            document.getElementById('comment0').insertAdjacentHTML('beforebegin',
                '                <div class="comment">\n' +
                '                    <div class="comment-header">\n' +
                '                        <div class="comment-author">\n' +
                                            response["email"] + '\n' +
                '                        </div>\n' +
                '                        <div class="comment-date">\n' +
                                            response["insert_timestamp"] + '\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                '                    <div class="comment-content">\n' +
                                            response["comment"] +'\n' +
                '                    </div>\n' +
                '                </div>');
        });
    }
}