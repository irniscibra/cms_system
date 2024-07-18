<?php
require 'config.php'; // Datenbank verbindung
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // echo "geklappt";
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check ob Benutzername oder email bereits existieren 

    $stmt = $mysqli->prepare("SELECT * FROM users WHERE username= ? OR email= ?");
    $stmt->bind_param('ss', $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Benutzername oder email sind bereits vergeben";
    } else {
        $stmt = $mysqli->prepare("INSERT INTO users(username,email,password) VALUES(?,?,?)");
        $stmt->bind_param('sss', $username, $email, $password);

        if ($stmt->execute()) {
            echo "Registrierung erflogreich !";
            header("Location:login.html");
        } else {
            echo "Fehler bei der Registrierung";
        }
    }
}
