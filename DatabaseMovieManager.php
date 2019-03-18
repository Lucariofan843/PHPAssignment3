<?php

class DatabaseMovieManager implements MovieManagerInterface {

    private $connection = null;
    private $host = '';
    private $username = '';
    private $passwd = '';
    private $dbname = '';

    function __construct(string $host, string $username, string  $passwd, string $dbname)
    {
        $this->host = $host;
        $this->username = $username;
        $this->passwd = $passwd;
        $this->dbname = $dbname;
    }

    private function connect()
    {
        $this->connection = new mysqli($this->host, $this->username, $this->passwd, $this->dbname);
        if ($this->connection->connect_error) {
            echo 'Error connection';
            exit;
        }
    }

    private function disconnect() {
        if ($this->connection){
            $this->connection->close();
        }
    }

    function testConnection()
    {
        $this->connect();
        echo "Done!";
        $this->disconnect();
    }

    function create(Movie $movie): bool
    {
        $this->connect();
        $query = "INSERT INTO movie(title, director, artist, genre, rating) VALUES (?,?,?,?,?)";
        $statement = $this->connection->prepare($query);
        $title = $movie->title;
        $director = $movie->director;
        $artist = $movie->artist;
        $genre = $movie->genre;
        $rating = $movie->rating;
        $statement->bind_param('ssssi', $title, $director, $artist, $genre, $rating);
        $statement->execute();
        $this->disconnect();
        if ($statement->affected_rows > 0) {
            return true;
        }
        return false;
    }

    function read(): string
    {
        $this->connect();
        $query = "SELECT * FROM movie";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $statement->bind_result($id, $title, $director, $artist, $genre, $rating);
        $returnString = '';
        while ($statement->fetch()){
            $returnString .= "$title, $director, $artist, $genre, $rating, $id\n";
        }
        $this->disconnect();
        return $returnString;
    }

    /**
     * @param int $id
     * @return Movie
     */
    function readOneById(int $id): Movie
    {
        $this->connect();
        $query = "SELECT title, director, artist, genre, rating FROM movie where id = $id";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $statement->bind_result($title, $director, $artist, $genre, $rating);
        while ($statement->fetch()){
            $returnObj = new Movie($title, $director, $artist, $genre, $rating);
        }
        $this->disconnect();
        return $returnObj;

    }

    /**
     *
     * @param int $id
     * @param Movie $movie
     * @return bool;
     */
    function update(int $id, Movie $movie): bool
    {
        $this->connect();
        $query = "UPDATE movie SET title=?, director=?, artist=?, genre=?, rating=? WHERE id=?";
        $statement = $this->connection->prepare($query);
        $title = $movie->title;
        $director = $movie->director;
        $artist = $movie->artist;
        $genre = $movie->genre;
        $rating = $movie->rating;
        $statement->bind_param('ssssii',$title, $director, $artist, $genre, $rating, $id);
        $statement->execute();
        $this->disconnect();
        if ($statement->affected_rows > 0) {
            return true;
        }
        return false;
    }

}

?>