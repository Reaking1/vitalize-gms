<?php
include __DIR__ . '/../layouts/header.php';
include __DIR__ . '/../layouts/navbar.php';

$notifications = $notifications ?? [];
?>

<h2>Notifications</h2>

<?php if (!empty($notifications)): ?>
    <ul>
        <?php foreach ($notifications as $note): ?>
            <li>
                <?= htmlspecialchars($note['message']) ?> <small>(<?= htmlspecialchars($note['created_at']) ?>)</small>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No notifications to show.</p>
<?php endif; ?>

<?php
include __DIR__ . '/../layouts/footer.php';
?>
