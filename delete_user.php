<?php 

session_start();
require "config.php";
require "functions.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $id = $_POST['user_id'];
    $stmt = $mysqli->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $stmt->close();
    
    header("Location:dashboard.php");
    exit;
}
?>