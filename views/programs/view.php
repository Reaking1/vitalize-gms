<?php
include __DIR__ . '/../layouts/layouts/header.php';
include __DIR__ . '/../layouts/layouts/navbar.php';

// $program: associative array with program data passed by controller
require_once __DIR__ . '/../../controllers/ProgramController.php';
require_once __DIR__ . '/../../db.php';

$controller = new ProgramController($pdo);

if (!isset($_GET['id'])) {
    die("Program ID is required");
}

$program = $controller->getProgramById($_GET['id']);
?>

<h2>Program Details: <?= htmlspecialchars($program['name'] ?? '') ?></h2>

<p><strong>Description:</strong> <?= nl2br(htmlspecialchars($program['description'] ?? '')) ?></p>
<p><strong>Coach:</strong> <?= htmlspecialchars($program['coach'] ?? '') ?></p>
<p><strong>Contact:</strong> <?= htmlspecialchars($program['contact'] ?? '') ?></p>
<p><strong>Duration:</strong> <?= htmlspecialchars($program['duration'] ?? '') ?> weeks</p>
<p><strong>Skill Level:</strong> <?= htmlspecialchars($program['skill_level'] ?? '') ?></p>

<a href="list.php">Back to Programs List</a>

<?php
include __DIR__ . '/../layouts/layouts/footer.php';
?>
