<?php
include_once __DIR__ . "./CLASSES/MEDIA/media.php";

session_start();

if (!isset($_GET["albumTitle"])) {
    header("Location: error.php?ErrorMSG=Bad%20Request!");
    die();
}

$title = $_GET["albumTitle"];

$_SESSION["lastVisitedAlbumID"] = $_GET["albumID"];

$content = array();
array_push($content, "medialistview.php");

//not working, I'll fix later
// if($_SESSION["userID"] == $_GET["userID"])
// {
    array_push($content, "postcreateview.php");
// }

require_once __DIR__ . "/HTML/masterpage.php";

