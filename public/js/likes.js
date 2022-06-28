// const likeButtons = document.querySelectorAll(".fa-thumbs-up");
// const dislikeButtons = document.querySelectorAll(".fa-thumbs-down");
//
//
// function giveLike() {
//     const likes = this;
//     const container = likes.parentElement.parentElement.parentElement;
//     const id = container.getAttribute("id");
//
//     fetch(`/like/${id}`)
//         .then(function () {
//             likes.innerHTML = parseInt(likes.innerHTML) + 1;
//             likes.style.color = 'green';
//         })
// }
//
// function giveDislike() {
//     const dislikes = this;
//     const container = dislikes.parentElement.parentElement.parentElement;
//     const id = container.getAttribute("id");
//
//     fetch(`/dislike/${id}`)
//         .then(function () {
//             dislikes.innerHTML = parseInt(dislikes.innerHTML) + 1;
//             dislikes.style.color = 'red';
//         })
// }
//
// likeButtons.forEach(button => button.addEventListener("click", giveLike));
// dislikeButtons.forEach(button => button.addEventListener("click", giveDislike));

$(document).ready(function (){
    $('.like-btn').on('click', function (){
        const likes = this;
        const container = likes.parentElement.parentElement.parentElement;
        const id_movie = container.getAttribute("id");

        const clicked_btn = $(this);


        let action = 'like';
        if(clicked_btn.hasClass('fa-thumbs-up-2')) {
            action = 'unlike';
        }


        $.ajax({
            url: 'rating',
            type: 'post',
            data: {
                'action': action,
                'id_movie': id_movie
            },
            success: function (data){
                console.log(data);
                const res = JSON.parse(data);

                if(action == 'like') {
                    clicked_btn.addClass('fa-thumbs-up-2');
                } else if(action == 'unlike') {
                    clicked_btn.removeClass('fa-thumbs-up-2');
                }

                clicked_btn.siblings('span.likes').text(res.likes);
                clicked_btn.siblings('span.dislikes').text(res.dislikes);

                clicked_btn.siblings('i.fa-thumbs-down-2').removeClass('fa-thumbs-down-2');
            }
        })
    })


    $('.dislike-btn').on('click', function (){
        const likes = this;
        const container = likes.parentElement.parentElement.parentElement;
        const id_movie = container.getAttribute("id");

        const clicked_btn = $(this);


        let action = 'dislike';
        if(clicked_btn.hasClass('fa-thumbs-down-2')) {
            action = 'undislike';
        }


        $.ajax({
            url: 'rating',
            type: 'post',
            data: {
                'action': action,
                'id_movie': id_movie
            },
            success: function (data){
                console.log(data);
                const res = JSON.parse(data);

                if(action == 'dislike') {
                    clicked_btn.addClass('fa-thumbs-down-2');
                } else if(action == 'undislike') {
                    clicked_btn.removeClass('fa-thumbs-down-2');
                }

                clicked_btn.siblings('span.likes').text(res.likes);
                clicked_btn.siblings('span.dislikes').text(res.dislikes);

                clicked_btn.siblings('i.fa-thumbs-up-2').removeClass('fa-thumbs-up-2');
            }
        })
    })
})