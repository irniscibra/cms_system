<?php
session_start();
require 'config.php';
require 'functions.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];

    // Überprüfen, ob der Benutzer bereits als Patient registriert ist
    $stmt = $mysqli->prepare("SELECT * FROM patients WHERE user_id = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $patient = $result->fetch_assoc();

    if (!$patient) {
        // Falls der Benutzer noch kein Patient ist, ihn als Patient hinzufügen
        $stmt = $mysqli->prepare("INSERT INTO patients (user_id, name, email) VALUES (?, ?, ?)");
        $stmt->bind_param('iss', $user_id, $_SESSION['username'], $_SESSION['email']);
        $stmt->execute();
        $patient_id = $stmt->insert_id;
    } else {
        $patient_id = $patient['id'];
    }

    // Überprüfen, ob der Termin schon vergeben ist
    $stmt = $mysqli->prepare("SELECT * FROM appointments WHERE appointment_date = ? AND appointment_time = ?");
    $stmt->bind_param('ss', $appointment_date, $appointment_time);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Dieser Termin ist bereits vergeben.";
    } else {
        $stmt = $mysqli->prepare("INSERT INTO appointments (patient_id, appointment_date, appointment_time) VALUES (?, ?, ?)");
        $stmt->bind_param('iss', $patient_id, $appointment_date, $appointment_time);

        if ($stmt->execute()) {
            echo "Termin erfolgreich gebucht.";
        } else {
            echo "Fehler bei der Buchung des Termins.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Termin buchen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
</head>
<body>
    <?php include './includes/header.php'; ?>
    <div class="container mt-5">
        <h2>Termin buchen</h2>
        <form action="appointments.php" method="post">
            <div class="mb-3">
                <label for="appointment_date" class="form-label">Datum</label>
                <input type="text" class="form-control" id="appointment_date" name="appointment_date" required>
            </div>
            <div class="mb-3">
                <label for="appointment_time" class="form-label">Uhrzeit</label>
                <input type="time" class="form-control" id="appointment_time" name="appointment_time" required>
            </div>
            <button type="submit" class="btn btn-primary">Termin buchen</button>
        </form>
    </div>
    <?php include './includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#appointment_date').datepicker({
                format: 'yyyy-mm-dd',
                startDate: new Date(),
                autoclose: true
            });
        });
    </script>
</body>
</html>