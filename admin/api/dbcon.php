<?php

$db = mysqli_connect("127.0.0.1","root","","teknologiwebsitedb");

if(!$db)
{
    die("Connection failed: " . mysqli_connect_error());
}

?>