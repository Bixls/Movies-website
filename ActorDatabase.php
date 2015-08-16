<?php
require_once ("DatabaseConnect.php");

require_once ("configuration.php");

$connect = new DatabaseConnect();

$sql = "CREATE TABLE Actors (a_id int NOT NULL AUTO_INCREMENT,
title varchar(255),
name varchar(255),
role varchar(255),
picture varchar(255),
m_id int,
PRIMARY KEY (a_id),
FOREIGN KEY (m_id) REFERENCES Movies(m_id))";
$query=mysql_query($sql);
if ($query) {
    echo "Actors created successfully";
} else {
    echo "Error creating table";
}

?>
