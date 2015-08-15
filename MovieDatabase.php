<?php
require_once ("DatabaseConnect.php");

require_once ("configuration.php");

$connect = new DatabaseConnect();

$sql = "CREATE TABLE Movies (id int NOT NULL AUTO_INCREMENT,
title varchar(255),
poster varchar(255),
rating float,
description varchar(255),
genre varchar(255),
type varchar(255),
year int,
release_time varchar(255),
run_time varchar(255),
keyword varchar(255),
big_picture varchar(255),
parent_id int,
PRIMARY KEY (id))";
$query=mysql_query($sql);
if ($query) {
    echo "Movies created successfully";
} else {
    echo "Error creating table";
}

?>
