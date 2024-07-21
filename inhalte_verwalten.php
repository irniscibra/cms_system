<?php 
session_start();
require "config.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Fetch sections content
$sections = $mysqli->query("SELECT * FROM sections")->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $section_id = $_POST['section_id'];
    $content = $_POST['content'];
    $image_url = $_POST['image_url'];

    $stmt = $mysqli->prepare("UPDATE sections SET content = ?, image_url = ? WHERE id = ?");
    $stmt->bind_param('ssi', $content, $image_url, $section_id);
    $stmt->execute();
    header("Location: /cms_system/index.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
    <h2>Website Inhalte verwalten</h2>
    <?php foreach ($sections as $section): ?>
    <form action="admin_dashboard.php" method="POST" class="mb-5">
        <input type="hidden" name="section_id" value="<?php echo $section['id']; ?>">
        <div class="mb-3">
            <label for="content-<?php echo $section['id']; ?>" class="form-label"><?php echo ucfirst($section['section_name']); ?> Inhalt</label>
            <textarea class="form-control" id="content-<?php echo $section['id']; ?>" name="content" rows="5"><?php echo $section['content']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="image_url-<?php echo $section['id']; ?>" class="form-label">Bild URL (optional)</label>
            <input type="text" class="form-control" id="image_url-<?php echo $section['id']; ?>" name="image_url" value="<?php echo $section['image_url']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Speichern</button>
    </form>
    <?php endforeach; ?>
</div>
<?php include './includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>