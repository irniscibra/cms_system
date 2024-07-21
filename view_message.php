<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

$message_id = $_GET['id'];

$stmt = $mysqli->prepare("SELECT m.*, u.username as sender_name FROM messages m JOIN users u ON m.sender_id = u.id WHERE m.id = ?");
$stmt->bind_param('i', $message_id);
$stmt->execute();
$result = $stmt->get_result();
$message = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nachricht anzeigen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container vh-100 mt-5">
        <h2>Nachricht von <?php echo htmlspecialchars($message['sender_name']); ?></h2>
        <p><strong>Gesendet am:</strong> <?php echo htmlspecialchars($message['timestamp']); ?></p>
        <hr>
        <p><?php echo nl2br(htmlspecialchars($message['message'])); ?></p>
    </div>
    <?php include 'includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>