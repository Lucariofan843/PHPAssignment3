<?php

interface MovieManagerInterface {

    function create(Movie $movie) : bool;
    function read() : string;

    /**
     * @param int $id
     * @return Movie
     */

    function readOneById(int $id) : Movie;

    /**
     *
     * @param int $id
     * @param Movie $movie
     * @return bool;
     */

    function update(int $id, Movie $movie) : bool;

}
?>