<?php
session_start();
require "config.php";
require "functions.php";
require "./lib/PHPMailer/src/PHPMailer.php";
require "./lib/PHPMailer/src/SMTP.php";
require "./lib/PHPMailer/src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../public/login.php");
    exit;
}

$result = $mysqli->query("SELECT a.id, p.name, p.email, a.appointment_date, a.appointment_time, a.confirmed FROM appointments a JOIN patients p ON a.patient_id = p.id");
$appointments = $result->fetch_all(MYSQLI_ASSOC);

// Funktion zum Senden von Bestätigungsmails
function send_confirmation_email($email, $name, $appointment_date, $appointment_time) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // SMTP-Server des E-Mail-Anbieters
        $mail->SMTPAuth = true;
        $mail->Username = 'xyz@gmail.com'; // Deine E-Mail-Adresse
        $mail->Password = 'xx!'; // Dein E-Mail-Passwort
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('xyz@gmail.com', 'Praxis');
        $mail->addAddress($email, $name);

        $mail->isHTML(true);
        $mail->Subject = 'Terminbestätigung';
        $mail->Body    = "Sehr geehrter $name,<br><br>Ihr Termin am $appointment_date um $appointment_time wurde bestätigt. Bitte bringen Sie Ihre Versichertenkarte mit.<br><br>Mit freundlichen Grüßen,<br>Ihre Praxis";

        $mail->send();
        echo 'Termin wurde bestätigt und eine Bestätigungsmail wurde gesendet.';
    } catch (Exception $e) {
        echo "Fehler beim Senden der E-Mail: {$mail->ErrorInfo}";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm_appointment_id'])) {
    $appointment_id = $_POST['confirm_appointment_id'];

    // Termin als bestätigt markieren
    $stmt = $mysqli->prepare("UPDATE appointments SET confirmed = TRUE WHERE id = ?");
    $stmt->bind_param('i', $appointment_id);
    if ($stmt->execute()) {
        // Patientendaten abrufen, um die Bestätigungsmail zu senden
        $stmt = $mysqli->prepare("SELECT p.email, p.name, a.appointment_date, a.appointment_time FROM appointments a JOIN patients p ON a.patient_id = p.id WHERE a.id = ?");
        $stmt->bind_param('i', $appointment_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $appointment = $result->fetch_assoc();
        
        // Bestätigungsmail senden
        send_confirmation_email($appointment['email'], $appointment['name'], $appointment['appointment_date'], $appointment['appointment_time']);
    } else {
        echo "Fehler bei der Bestätigung des Termins.";
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Termine verwalten</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">CMS</a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Abmelden</a>
            </li>
        </ul>
    </div>
</nav>
    <div class="container mt-5">
        <h2>Termine verwalten</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Patient</th>
                    <th>E-Mail</th>
                    <th>Datum</th>
                    <th>Uhrzeit</th>
                    <th>Bestätigt</th>
                    <th>Aktion</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointments as $appointment): ?>
                <tr>
                    <td><?php echo htmlspecialchars($appointment['id']); ?></td>
                    <td><?php echo htmlspecialchars($appointment['name']); ?></td>
                    <td><?php echo htmlspecialchars($appointment['email']); ?></td>
                    <td><?php echo htmlspecialchars($appointment['appointment_date']); ?></td>
                    <td><?php echo htmlspecialchars($appointment['appointment_time']); ?></td>
                    <td><?php echo $appointment['confirmed'] ? 'Ja' : 'Nein'; ?></td>
                    <td>
                        <?php if (!$appointment['confirmed']): ?>
                        <form action="manage_appoinments.php" method="post" style="display:inline;">
                            <input type="hidden" name="confirm_appointment_id" value="<?php echo $appointment['id']; ?>">
                            <button type="submit" class="btn btn-success btn-sm">Bestätigen</button>
                        </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>