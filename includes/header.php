<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/cms_system/public/index.php">Praxis Dr. Mustermann</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="/cms_system/public/index.php">Startseite</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/cms_system/public/about.php">Über uns</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/cms_system/public/services.php">Dienstleistungen</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/cms_system/public/contact.php">Kontakt</a>
            </li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="../dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../logout.php">Abmelden</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="/cms_system/public/login.php">Anmelden</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/cms_system/public/register.php">Registrieren</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>