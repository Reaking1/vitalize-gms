<?php require_once __DIR__ . '/../../../config.php'; ?>

<nav>
    <ul style="list-style:none; padding:0; display:flex; gap:15px; background:#333; color:#fff; margin:0;">
    <li>
        <a href="<?= BASE_URL ?>" style="color:#fff; text-decoration:none;">Home</a></li>
        <li><a href="<?= BASE_URL ?>views/programs/list.php" style="color:#fff; text-decoration:none;">Programs</a></li>
        <li><a href="<?= BASE_URL ?>views/enrolments/list.php" style="color:#fff; text-decoration:none;">Enrolments</a></li>
        <li><a href="<?= BASE_URL ?>views/attendance/report.php" style="color:#fff; text-decoration:none;">Attendance</a></li>
        <li><a href="<?= BASE_URL ?>views/progress/view.php" style="color:#fff; text-decoration:none;">Progress</a></li>
        <li><a href="<?= BASE_URL ?>views/coaches/dashboard.php" style="color:#fff; text-decoration:none;">Coaches</a></li>
</nav>
<hr />
