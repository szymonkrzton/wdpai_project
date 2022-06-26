const search = document.querySelector('input[placeholder="search movie"]');
const movieContainer = document.querySelector(".movies");

search.addEventListener("keyup", function (event) {
    // if(event.key === "Enter") {
        event.preventDefault();

        const data = {search: this.value};

        fetch("/search", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            return response.json();
        }).then(function (movies) {
           movieContainer.innerHTML = "";
           loadMovies(movies)
        });
    // }
});

function loadMovies(movies) {
    movies.forEach(movie => {
        console.log(movie);
        createMovie(movie);
    });
}

function createMovie(movie) {
    const template = document.querySelector("#movie-template");

    const clone = template.content.cloneNode(true);

    const div = clone.querySelector("div");
    div.id = movie.id;
    const image = clone.querySelector("img");
    image.src = `/public/img/uploads/${movie.img}`;
    const title = clone.querySelector("h2");
    title.innerHTML = movie.title;
    const description = clone.querySelector("p");
    description.innerHTML = movie.description.slice(0, 100) + "...";
    const like = clone.querySelector(".fa-thumbs-up");
    like.innerText = ' '+movie.like;
    const dislike = clone.querySelector(".fa-thumbs-down");
    dislike.innerText = ' '+movie.dislike;

    movieContainer.appendChild(clone);
}