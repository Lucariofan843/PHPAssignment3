<?php

require("MovieManagerInterface.php");

class FileMovieManager implements MovieManagerInterface {

    private $path = '';

    function __construct(string $path)
    {
        $this->path = $path;
    }

    function create(Movie $movie) : bool
    {
        $fp = fopen($this->path, 'ab');
        if (!$fp) {
            return false;
        }

        $content="$movie->title,$movie->director,$movie->artist,$movie->genre,$movie->rating\n";
        if (empty($_POST["title"]) or empty($_POST["director"]) or empty($_POST["rating"])) {
            return false;
        }
        if (!fwrite($fp, $content)) {
            return false;
        }
        if (!fclose($fp)) {
            return false;
        }
        return true;
    }

    function read() : string {
        return file_get_contents($this->path);
    }

    /**
     * @param int $id
     * @return Movie
     */
    function readOneById(int $id): Movie
    {
        $contents = $this->read();
        $array = explode("\n", $contents);
        $movieLines = $array[$id];
        $movieInfo = explode(",", $movieLines);
        $title = $movieInfo[0];
        $director = $movieInfo[1];
        $artist = $movieInfo[2];
        $genre = $movieInfo[3];
        $rating = $movieInfo[4];
        $movie = new Movie($title, $director, $artist, $genre, $rating);
        return $movie;
    }

    /**
     *
     * @param int $id
     * @param Movie $movie
     * @return bool;
     */
    function update(int $id, Movie $movie): bool
    {
        $contents = $this->read();
        $array = explode("\n", $contents);
        $content="$movie->title,$movie->director,$movie->artist,$movie->genre,$movie->rating";
        $array[$id] = $content;
        $updated = implode("\n", $array);
        $fp = fopen($this->path, 'w');
        if (!fwrite($fp, $updated)) {
            return false;
        }
        if (!fclose($fp)) {
            return false;
        }
        return true;
    }

}

?>