<?php
require_once ("DatabaseConnect.php");

require_once ("configuration.php");

$connect = new DatabaseConnect();

$sql = "CREATE TABLE Actors (id int NOT NULL AUTO_INCREMENT,
title varchar(255),
name varchar(255),
role varchar(255),
picture varchar(255),
movie_id int,
PRIMARY KEY (id),
FOREIGN KEY (movie_id) REFERENCES Persons(id))";
$query=mysql_query($sql);
if ($query) {
    echo "Actors created successfully";
} else {
    echo "Error creating table";
}

?>
