<!--I chose $_POST because I like the privacy it provides from a programmer and user perspective. For a programmer, it has no limit to the information that can be sent through the method, a clean url and other areas in the code that could be
exploited. A user might not think of it as in-depth, but the use of $_POST 'hides' their input from being publicly exposed. Very important for tasks that involve inputting sensitive information, such as
online purchases, online bank transactions, and online job applications-->

<?php

require("movies.php");

extract($_POST);

$titleErr = $directorErr = $ratingErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["title"])) {
        $titleErr = "Movie title is required";
    } else {
        $title = test_input($_POST["title"]);
    }

    if (empty($_POST["director"])) {
        $directorErr = "Director name is required";
    } else {
        $director = test_input($_POST["director"]);
    }

    if (empty($_POST["rating"])) {
        $ratingErr = "Rating is required";
    } else {
        $rating = test_input($_POST["rating"]);
    }
}

$movie = new Movie($title, $director, $artist, $genre, $rating);
if (@$dataSource->getMovieManager()->create($movie)) {
  print "Success\n" . "<a href='index.php?source=$source'>Go back to main page</a>";
} else {
  print "Failure\n" . "<a href='index.php?source=$source'>Go back to main page</a>";
}

function test_input($data)
{
    $data = htmlspecialchars($data);
    return $data;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assignment 3</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
</html>
