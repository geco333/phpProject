<?php
    session_start();
?>


    <!doctype html>
    <html lang="en">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">

        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

        <script src="comments.js"></script>
        <script src="SendRequest.js"></script>
        <script src="BuildUi.js"></script>
    </head>

    <body class='container-fluid bg-dark text-light'>
        <div class="row" id="main_row">
            <div class="col-3" id='first_col'>
                <!--
                    -----------------
                    |*|             |
                    |*|-------------|
                    |-|             |
                    | |             |
                    | |             |
                    | |             |
                    |---------------|
                    |               |
                    -----------------
                -->
                <div class="row">
                    <div class="col">
                        <form class="p-1" onsubmit="SendRequest(event)" action="" name="movie_data" id="movie_data" method="post">
                            <div class="form-group">
                                <label class="font-weight-bold" for="movie_title">Movie title:</label>
                                <input type="text" class="form-control" name="t" placeholder="Forrest gump">
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Type:</label>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" value="short" name="plot" checked>
                                    <label class="form-check-label mr-2">Short</label>

                                    <input class="form-check-input" type="radio" value="full" name="plot">
                                    <label class="form-check-label">Full</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold" for="year">Year:</label>
                                <input type="year" class="form-control" name=y placeholder="1984">
                            </div>

                            <div>
                                <button class="btn btn-primary mb-1" type="submit" id="btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!--
                    -----------------
                    | |             |
                    | |-------------|
                    |-|             |
                    |*|             |
                    |*|             |
                    |*|             |
                    |---------------|
                    |               |
                    -----------------
                -->
                <div class='row' id='card_row'>
                    <div class='col'>
                        <div class="card bg-dark text-light" id="movie_card">
                            <div class="card-body">
                                <h5 class="card-title" id="movie_title"></h5>

                                <img class="card-img-top p-1" id="poster" />

                                <p class="card-text" id="description">
                                </p>

                                <ul class="list-group" id="ratings">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--
                -----------------
                | |*************|
                | |-------------|
                |-|             |
                | |             |
                | |             |
                | |             |
                |---------------|
                |               |
                -----------------
            -->
            <div class="col">
                <div class="row pt-1 mb-1">
                    <div class="col">
                        <label>Search:</label>

                        <div class="d-inline-flex" id='search_div'>
                            <input id="search_value" type="text" placeholder="Search database">

                            <div id='autocomlete'>
                            </div>
                        </div>

                        <select id="search_key">
                            <option value="title">Title</option>
                            <option value="year">Year</option>
                            <option value="imdb">IMDB Rating</option>
                            <option value="rt">Rotten Tomatoes Score</option>
                            <option value="met">Metascore</option>
                            <option value="actors">Actor</option>
                            <option value="revenue">Box office</option>
                            <option value="country">Country</option>
                            <option value="genre">Genre</option>
                            <option value="director">Director</option>
                            <option value="language">Language</option>
                            <option value="rated">Rating</option>
                        </select>

                        <input type="button" value='Search' onclick="LoadDb()">
                    </div>
                </div>

                <!--SORT-->
                <div class="row mb-1">
                    <div class="col">
                        <label>Sort by:</label>
                        <select id="sort_key" onchange="LoadDb()">
                            <option value="title" selected>Title</option>
                            <option value="year">Year</option>
                            <option value="revenue">Box office</option>
                            <optgroup value='by_score' label="By Score:">
                                <option value="imdb">IMDB Score</option>
                                <option value="rt">Rotten Tomatoes Score</option>
                                <option value="met">Metacritic Score</option>
                            </optgroup>
                        </select>

                        <!--FILTER-->
                        <label>Filter by: </label>
                        <select id="filter_key" onchange="LoadDb()">
                            <option>No Filter</option>

                            <optgroup value='by_rated' label='Rated'>
                                <option>G</option>
                                <option>PG</option>
                                <option>PG13</option>
                                <option>R</option>
                                <option>NC-17</option>
                            </optgroup>

                            <optgroup value='by_score' label="Scores">
                                <option value='imdb'>IMDB Score</option>
                                <option value='rt'>Rotten Tomatoes</option>
                                <option value='imdb'>Metacritic</option>
                            </optgroup>
                        </select>

                        <!--FILTER CONDITION-->
                        <span id='filter_condition'>
                           <select>
                                <option value='='>=</option>
                                <option value='<'>&lt</option>
                                <option value='>'>&gt</option>
                            </select>
                            
                            <input type='text' id='filter_text' placeholder='Enter filter condition' onchange='LoadDb()'>
                        </span>
                    </div>
                </div>

                <!--
                    -----------------
                    | |             |
                    | |-------------|
                    |-|*************|
                    | |*************|
                    | |*************|
                    | |*************|
                    |---------------|
                    |               |
                    -----------------
                -->

                <div class="row" id="db_row">
                    <div class="col" id="db_view" onload="ShowDb()">

                        <div class="modal" id="movie_modal">
                            <div class="container" onclick='closeModal(event)'>

                                <!-- First row: poster + info. -->
                                <div class="row" id="movie_row">

                                    <div class="col">
                                        <img class="modal-content" id="modal_img">
                                    </div>

                                    <div class="col" id='movie_info'>
                                        <div class="h4" id="title"></div>
                                        <br>
                                        <div class="h6" id="plot"></div>
                                        <br>
                                        <div id="actors"></div>
                                        <div id="director"></div>
                                        <div id="genre"></div>
                                        <div id="score"></div>
                                        <div id="rated"></div>
                                        <div id="released"></div>
                                        <div id="runtime"></div>
                                        <div id="site"></div>
                                        <div id="year"></div>
                                        <div>
                                            <ul id="scores">
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Second row: comments. -->
                                <div class="row">
                                    <div class="col" id="comments"></div>
                                </div>

                                <!-- Third row: new comment textarea. -->
                                <div class="row my-1" id="new_comments">
                                    <textarea class="col-8" id="comment_textarea" placeholder='Enter a new comment.'></textarea>

                                    <!-- fourth row: comments buttons. -->
                                    <div class="row col-12 my-1">
                                        <input class="btn btn-secondary" id="add_comment" type="button" onclick='addComment(event)' value='Add comment'>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-columns " id="db">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
