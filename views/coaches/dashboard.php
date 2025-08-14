<?php
include __DIR__ . '/../layouts/layouts/header.php';
include __DIR__ . '/../layouts/layouts/navbar.php';

$user = $user ?? null; // assume $user set from session or controller
$assignedPrograms = $assignedPrograms ?? [];
$notifications = $notifications ?? [];
?>

<h2>Welcome, <?= htmlspecialchars($user['username'] ?? 'Coach') ?>!</h2>

<h3>Your Assigned Programs</h3>
<?php if (!empty($assignedPrograms)): ?>
    <ul>
        <?php foreach ($assignedPrograms as $program): ?>
            <li>
                <strong><?= htmlspecialchars($program['name']) ?></strong> — Duration: <?= htmlspecialchars($program['duration']) ?> weeks — Skill Level: <?= htmlspecialchars($program['skill_level']) ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>You currently have no assigned programs.</p>
<?php endif; ?>

<h3>Notifications</h3>
<?php if (!empty($notifications)): ?>
    <ul>
        <?php foreach ($notifications as $note): ?>
            <li>
                <?= htmlspecialchars($note['message']) ?> <em>(<?= htmlspecialchars($note['created_at']) ?>)</em>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No new notifications.</p>
<?php endif; ?>

<?php
include __DIR__ . '/../layouts/layouts/footer.php';
?>
