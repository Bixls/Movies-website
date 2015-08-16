<?php
require_once ("DatabaseConnect.php");
require_once ("MovieAdapter.php");
require_once ("configuration.php");
require_once ("movie.php");
require_once ("actor.php");

$adapter = new MovieAdapter();
$data=$adapter->getData();
print_r($data);