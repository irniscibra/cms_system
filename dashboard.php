<?php 
session_start();
require 'config.php';
require "functions.php";
if(!isset($_SESSION['user_id'])){
    header("Location:login.html");
    exit;
}
$username = $_SESSION['username'];
$role = $_SESSION['role'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous"
  />
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">CMS</a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Abmelden</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <h1 class="display-4">Willkommen, <?php echo htmlspecialchars($username); ?>!</h1>
                <p class="lead">Sie sind als <?php echo htmlspecialchars($role); ?> angemeldet.</p>
                <hr class="my-4">
                <p>Dies ist Ihr Dashboard. Von hier aus können Sie verschiedene Aufgaben ausführen.</p>
                <?php if (has_permission($role, 'manage_users')): ?>
                    <a class="btn btn-primary btn-lg" href="manage_users.php" role="button">Benutzer verwalten</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

    <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"
  ></script>
</body>
</html>