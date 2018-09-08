var url = "http://www.omdbapi.com/?i=tt3896198&apikey=d9bbd5b7";

function movieModal(movie_data) {
    $("#movie_modal").css('display', 'block');
    $("#movie_modal img").attr('src', movie_data['poster_url']);
    $("#title").html(movie_data['title'].replace(/'s/g, "s"));
    $("#plot").html(movie_data['plot'].replace(/'s/g, "s"));
    $("#actors").html("Actors: " + movie_data['actors']);
    $("#director").html("Director: " + movie_data['director']);
    $("#genre").html("Genre: " + movie_data['genre']);
    $("#year").html("Year: " + movie_data['year']);
    $("#runtime").html("Runtime: " + movie_data['runtime']);
    $("#rated").html("Rated: " + movie_data['rated']);
    $("#scores").html("<li class='list-group-item'>IMDB Score: " + movieModal['imdb'] + "</li>" + "<li class='list-group-item'>Rotten Tomatoes: " + movie_data['rt'] + "</li>" + "<li class='list-group-item'>Metacritic: " + movie_data['met'] + "</li>");

    // Load comments for title.
    showComments(movie_data['title']);

    if (user == 'admin') {
        var $delete = $("<input>");
        $delete.attr('class', 'btn btn-secondary');
        $delete.attr('id', 'delete_comment');
        $delete.attr('type', 'button');
        $delete.attr('value', 'Delete comment');
        $delete.on('click', function (event) {
            deleteComment(event);
        });

        $("#new_comments .row.col-12.my-1").append($delete);
    } // if
} // movieModal


function closeModal(e) {
    if (!(e.path[0]['id'] == 'add_comment') && !(e.path[0]['id'] == 'delete_comment') && !(e.path[0]['id'] == 'comment_textarea') && !(e.path[0]['type'] == 'radio')) {
        $("#movie_modal").css('display', 'none');
    }
} // closeModal


function SendRequest(e) {
    e.preventDefault();
    data = $("#movie_data").serializeArray();
    data.push({
        name: 'r',
        value: 'json'
    });
    $.get(url, data, GetResult);
} // SendRequest


function GetResult(data) {
    movieData = data;

    $("#movie_title").html(data.Title);
    $("#poster").attr('src', data.Poster);
    $("#description").html(data.Plot);
    $("#ratings").append("<li class='list-group-item bg-dark text-light'>IMDB Rating: " + data.Ratings[0]['Value'] + "<li class='list-group-item bg-dark text-light'>Rotten Tomatoes: " + data.Ratings[1]['Value'] + "<li class='list-group-item bg-dark text-light'>Metacritic: " + data.Ratings[2]['Value']);
} // GetResult


function RemoveFromDataBase() {
    checked = {};
    var i = 0;
    // Add selected movies to array.
    $(".movie_selector").each(function (j, o) {
        if (o.checked) checked[i++] = ($(o).val());
    });
    // Send array to delete.
    $.post('remove_from_databse.php', checked, function (data) {
        $("#php_response").append(data);
    });
    LoadDb();
} // LoadPoster


function AddToDatabase() {
    $.post("add_to_databse.php", movieData, function (data) {
        $("#php_response").append(data);
    });
    LoadDb();
} // AddToDatabase
