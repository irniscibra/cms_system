<?php 
$host = "localhost";
$db = "cms";
$user = "root";
$password = "";

$mysqli = new mysqli($host,$user,$password,$db);


if ($mysqli->connect_error) {
    die('Verbindungsfehler (' . $mysqli->connect_errno . ') '
        . $mysqli->connect_error);
}
?>