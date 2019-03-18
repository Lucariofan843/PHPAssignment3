<?php

class Movie {

    private $title = '';
    private $director = '';
    private $artist = '';
    private $genre = '';
    private $rating = '';

    function __construct($title, $director, $artist, $genre, $rating)
    {
        $this->setTitle($title);
        $this->setDirector($director);
        $this->setArtist($artist);
        $this->setGenre($genre);
        $this->setRating($rating);
    }

    function __get($attr_name)
    {
        return $this->$attr_name;
    }

    function __set($attr_name, $value)
    {
        $attr_name = str_replace('_',' ', $attr_name);
        $attr_name = ucwords($attr_name);
        $attr_name = str_replace(' ', '', $attr_name);
        $function = "set$attr_name";
        $this->$function($value);
    }

    function setTitle($title)
    {
        $this->title = trim($title);
    }

    function setDirector($director)
    {
        $this->director = ucwords(trim($director));
    }

    function setArtist($artist)
    {
        $this->artist = ucwords(trim($artist));
    }

    function setGenre($genre)
    {
        $this->genre = trim($genre);
    }

    function setRating($rating)
    {
        $this->rating = trim($rating);
    }
}

?>