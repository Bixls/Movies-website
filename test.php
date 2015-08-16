<?php
require_once ("DatabaseConnect.php");
require_once ("MovieAdapter.php");
require_once ("configuration.php");
require_once ("movie.php");
require_once ("actor.php");

$connect = new DatabaseConnect();
$adapter = new MovieAdapter();
$adapter->Create();