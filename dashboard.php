<?php
session_start();
require 'config.php';
require "functions.php";
if (!isset($_SESSION['user_id'])) {
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="public/index.php">CMS</a>
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
                    <!--Buttons für Nachrischten  -->
                    <a class="btn btn-primary" href="inbox.php" role="button"><i class="fas fa-inbox"></i> Nachrichten-Postfach</a>
                    <a class="btn btn-secondary" href="new_message.php" role="button"><i class="fas fa-edit"></i> Nachricht erstellen</a>
                    <!-- Buttons basierend auf der Benutzerrolle anzeigen -->
                    <?php if ($role === 'admin') : ?>
                        <a class="btn btn-warning" href="manage_appoinments.php" role="button">Termine verwalten</a>
                        <a class="btn btn-info" href="inhalte_verwalten.php" role="button">Inhalte verwalten</a>
                    <?php elseif ($role === 'user') : ?>
                        <a class="btn btn-primary" href="appointments.php" role="button">Termin buchen</a>
                    <?php endif; ?>

                    <!-- Benutzerverwaltung-Button anzeigen, wenn Berechtigung vorhanden -->
                    <?php if (has_permission($role, 'manage_users')) : ?>
                        <a class="btn btn-primary" href="manage_users.php" role="button">Benutzer verwalten</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>