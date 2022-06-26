const likeButtons = document.querySelectorAll(".fa-thumbs-up");
const dislikeButtons = document.querySelectorAll(".fa-thumbs-down");


function giveLike() {
    const likes = this;
    const container = likes.parentElement.parentElement.parentElement;
    const id = container.getAttribute("id");

    fetch(`/like/${id}`)
        .then(function () {
            likes.innerHTML = parseInt(likes.innerHTML) + 1;
            likes.style.color = 'green';
        })
}

function giveDislike() {
    const dislikes = this;
    const container = dislikes.parentElement.parentElement.parentElement;
    const id = container.getAttribute("id");

    fetch(`/dislike/${id}`)
        .then(function () {
            dislikes.innerHTML = parseInt(dislikes.innerHTML) + 1;
            dislikes.style.color = 'red';
        })
}

likeButtons.forEach(button => button.addEventListener("click", giveLike));
dislikeButtons.forEach(button => button.addEventListener("click", giveDislike));