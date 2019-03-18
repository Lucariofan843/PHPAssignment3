<?php

require("movies.php");

$dataSourceStatus = $dataSource->getStatus();
$buttons = $dataSource->buttons();
$data = @$dataSource->getMovieManager()->read();
$table_body = $dataSource->list($data);
$source = $dataSource->getSource();
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
            <li class="active"><a href="index.php?source=<?php echo $source ?>">Add Movie Entry</a></li>
            <li><a href="movielist.php?source=<?php echo $source ?>">Movie Entries</a></li>
        </ul>
    </div>
</nav>


<div class="container">
   <?php echo $dataSourceStatus ?>
    <?php echo $buttons ?>
    <div class="row">
        <table class="table">
            <thead>
            <tr>
                <th>Movie</th>
                <th>Director</th>
                <th>Artists</th>
                <th>Genre</th>
                <th>Rating</th>
            </tr>
            </thead>
            <tbody>
              <?php echo $table_body ?>
            </tbody>
        </table>
    </div>
</div>

</body>

</html>