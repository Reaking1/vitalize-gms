<?php
// Adjust paths based on your project root; if index.php is in vitalize-gms root:
require_once __DIR__ . '/controllers/ProgramController.php';
require_once __DIR__ . '/db.php';

$programController = new ProgramController($pdo);

// Fetch all programs (can add filtering or search later)
$programs = $programController->getPrograms();

include __DIR__ . '/views/layouts/header.php';
include __DIR__ . '/views/layouts/navbar.php';
?>

<h2>Available Gymnastics Programs</h2>

<?php if (!empty($programs)): ?>
<table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr>
            <th>Program Name</th>
            <th>Coach</th>
            <th>Duration (weeks)</th>
            <th>Skill Level</th>
            <th>Details</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($programs as $program): ?>
        <tr>
            <td><?= htmlspecialchars($program['name'] ?? $program['program_name'] ?? '') ?></td>
            <td><?= htmlspecialchars($program['coach'] ?? $program['coach_name'] ?? '') ?></td>
            <td><?= htmlspecialchars($program['duration'] ?? $program['duration_weeks'] ?? '') ?></td>
            <td><?= htmlspecialchars($program['skill_level'] ?? '') ?></td>
            <td><a href="/views/programs/view.php?id=<?= $program['id'] ?>">View</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
    <p>No programs available at this time.</p>
<?php endif; ?>

<?php
include __DIR__ . '/views/layouts/footer.php';
?>
