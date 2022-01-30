function loadLikeState(like){
    $( document ).ready(function() {
        if(like === '1'){
            $(".heart").toggleClass("is-active");
        }
    })

}