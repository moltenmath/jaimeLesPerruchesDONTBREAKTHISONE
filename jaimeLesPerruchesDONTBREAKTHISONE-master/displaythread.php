<?php
  session_start();
  
  if(!isset($_GET["threadTitle"])){
    header("Location: error.php?ErrorMSG=Bad%20Request!");
    die();
  }

  $title=$_GET["threadTitle"];

  $content = array();
  array_push($content, "postlistview.php");
  array_push($content, "postcreateview.php");

  require_once __DIR__ . "/HTML/masterpage.php";
?>
