<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assignment 3</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head><?php
require ("DataSource.php");
$dataSourceStatus = $dataSource->getStatus();
$buttons = $dataSource->buttons();
$source = $dataSource->getSource();
?>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li class="active"><a href="?source=<?php echo $source?>">Add Movie Entry</a></li>
            <li><a href="movielist.php?source=<?php echo $source ?>">Movie Entries</a></li>
        </ul>
    </div>
</nav>
<?php echo $dataSourceStatus?>
<?php echo $buttons?>
<form action="input.php?source=<?php echo $source ?>" method="post">
<input type="hidden" name="source" value="<?php echo $source ?>">
<?php require("FileMovieManager.php"); ?>
 <?php require("Movie.php"); ?>
    <?php require("DatabaseMovieManager.php"); ?>

    <div class="form-group">
        <label class="control-label">Movie Title:
            <input type="text" class="form-control" name="title" required>
        </label>
    </div>
    <div class="form-group">
        <label>Director name:
            <input type="text" class="form-control" name="director" required>
        </label></div>
    <div class="form-group">
        <label>Artists:
            <input type="text" class="form-control" name="artist">
        </label></div>
    <div class="form-group">
        <label>Movie Genre:
            <select class="form-control" name="genre">
                <option>Action</option>
                <option>Animation</option>
                <option>Drama</option>
                <option>Fantasy</option>
                <option>Horror</option>
            </select>
        </label></div>
    <div class="form-group">
        <label>Movie Rating: </label>

        <div class="radio">
            <label class="radio-inline"><input type="radio" name="rating" value="1" required>1</label>
            <label class="radio-inline"><input type="radio" name="rating" value="2" required>2</label>
            <label class="radio-inline"><input type="radio" name="rating" value="3" required>3</label>
            <label class="radio-inline"><input type="radio" name="rating" value="4" required>4</label>
            <label class="radio-inline"><input type="radio" name="rating" value="5" required>5</label>
        </div>

    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>

<div class=""></div>

</body>
</html>