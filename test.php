<?php
require_once ("DatabaseConnect.php");
require_once ("MovieAdapter.php");
require_once ("configuration.php");
require_once ("movie.php");
require_once ("actor.php");

$adapter = new MovieAdapter();
$img=$_FILES['img'];
$data=$adapter->uploadImage($img);
print_r($data);