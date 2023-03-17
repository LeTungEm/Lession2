<?php
include("./src/Config/config.php");
include_once("./src/Models/Db.php");
include_once("./src/Models/Category.php");

$Category = new Category();


include("./src/Views/index.php");



?>