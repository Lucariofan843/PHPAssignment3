<?php
require("movies.php");

$id = null;

if (isset($_GET) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $movie = $dataSource->getMovieManager()->readOneById($id);
}

if (isset($_POST) && !empty($_POST)) {
    extract($_POST);
    $movie = new Movie($title, $director, $artist, $genre, $rating);
    if ($dataSource->getMovieManager()->update($id, $movie)) {
        header('Location: movielist.php');
    }
}

$genres = ['action' => null, 'horror' => null, 'animation' => null,'drama' => null, 'fantasy' => null];
$genres[strtolower($movie->genre)] = 'selected';
$ratings = ['1' => null, '2' => null, '3' => null, '4' => null, '5' => null];
$ratings[$movie->rating] = 'checked';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assignment 3</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li class="active"><a href="?source=<?php echo $dataSource->getSource()?>">Add Movie Entry</a></li>
            <li><a href="movielist.php?source=<?php echo $dataSource->getSource()?>">Movie Entries</a></li>
        </ul>
        <h1 class="text-center">Edit Entry</h1>
    </div>
</nav>

<form action="" method="post">
    <input type="hidden" name="source" value="<?php echo $source ?>">
    <div class="form-group">
        <label class="control-label">Movie Title:
            <input type="text" class="form-control" name="title" value="<?php echo $movie->title ?>" required>
        </label>
    </div>
    <div class="form-group">
        <label>Director name:
            <input type="text" class="form-control" name="director" value="<?php echo $movie->director ?>" required>
        </label></div>
    <div class="form-group">
        <label>Artists:
            <input type="text" class="form-control" name="artist" value="<?php echo $movie->artist ?>">
        </label></div>
    <div class="form-group">
        <label>Movie Genre:
            <select class="form-control" name="genre" value="<?php echo $movie->genre ?>">
                <option <?php echo $genres['action'] ?> value="action">Action</option>
                <option <?php echo $genres['animation'] ?> value="animation">Animation</option>
                <option <?php echo $genres['drama'] ?> value="drama">Drama</option>
                <option <?php echo $genres['fantasy'] ?> value="fantasy">Fantasy</option>
                <option <?php echo $genres['horror'] ?> value="horror">Horror</option>
            </select>
        </label></div>
    <div class="form-group">
        <label>Movie Rating: </label>

        <div class="radio">
            <label class="radio-inline"><input <?php echo $ratings['1'] ?> type="radio" name="rating" value="1" required>1</label>
            <label class="radio-inline"><input <?php echo $ratings['2'] ?> type="radio" name="rating" value="2" required>2</label>
            <label class="radio-inline"><input <?php echo $ratings['3'] ?> type="radio" name="rating" value="3" required>3</label>
            <label class="radio-inline"><input <?php echo $ratings['4'] ?> type="radio" name="rating" value="4" required>4</label>
            <label class="radio-inline"><input <?php echo $ratings['5'] ?> type="radio" name="rating" value="5" required>5</label>
        </div>

    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>

<div class=""></div>

</body>
</html>