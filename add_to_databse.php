<?php
    if(isset($_POST))
    {        
        //echo var_dump($_POST);
                
        // Make PDO object.
        $db = new PDO('mysql:host=localhost;dbname=moviesdb;charset=utf8', 'root', '',[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES=> false, ]);
        
        // Check if title exists in database.
        $query = $db->query("SELECT title FROM maintable WHERE title = '" . $_POST['Title'] . "'");
        
        // If title does not exists in database add it.
        if($query->rowCount() == 0)
        {                 
            $stmt_main = $db->prepare("INSERT INTO maintable (title, year, actors, poster_url, revenue, country, genre, director, language, plot, rated, runtime) VALUES (:title, :year, :actors, :poster_url, :revenue, :country, :genre, :director, :language, :plot, :rated, :runtime)");            
            
            $stmt_main->execute(['title' => $_POST['Title'], 'year' => $_POST['Year'], 'actors' => $_POST['Actors'], 'poster_url' => $_POST['Poster'], 'revenue' => $_POST['BoxOffice'], 'country' => $_POST['Country'], 'genre' => $_POST['Genre'], 'director' => $_POST['Director'], 'language' => $_POST['Language'], 'plot' => $_POST['Plot'], 'rated' => $_POST['Rated'], 'runtime' => $_POST['Runtime']]);
            
            $stmt_ratings = $db->prepare("INSERT INTO ratings (title, imdb, rt, met) VALUES (:title, :imdb, :rt, :met)");
            
            $stmt_ratings->execute(['title' => $_POST['Title'], 'imdb' => $_POST['Ratings'][0]['Value'], 'rt' => $_POST['Ratings'][1]['Value'], 'met' => $_POST['Ratings'][2]['Value']]);
        } // if
    } // if
?>
