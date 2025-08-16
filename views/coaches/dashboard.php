<?php
include __DIR__ . '/../layouts/layouts/header.php';
include __DIR__ . '/../layouts/layouts/navbar.php';

require_once __DIR__ . '/../../db.php';
require_once __DIR__ . '/../../controllers/CoachController.php';

$controller = new CoachController($pdo);
$message = '';

// Handle coach creation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
    $success = $controller->addCoach([
        'name'  => $_POST['name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone']
    ]);
    $message = $success ? "Coach created successfully!" : "Failed to create coach.";
}

// Handle coach deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $controller->deleteCoach($_POST['delete_id']);
    $message = "Coach deleted successfully!";
}

// Fetch all coaches
$coaches = $controller->listCoaches();
?>

<h2>Super Admin: Manage Coaches</h2>

<?php if ($message): ?>
    <p style="color: green;"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<h3>Create New Coach</h3>
<form method="POST">
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Phone:</label><br>
    <input type="text" name="phone"><br><br>

    <button type="submit">Create Coach</button>
</form>

<h3>Existing Coaches</h3>
<?php if (!empty($coaches)): ?>
    <table border="1" cellpadding="8">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Action</th>
        </tr>
        <?php foreach ($coaches as $coach): ?>
            <tr>
                <td><?= htmlspecialchars($coach['name']) ?></td>
                <td><?= htmlspecialchars($coach['email']) ?></td>
                <td><?= htmlspecialchars($coach['phone']) ?></td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="delete_id" value="<?= $coach['coach_id'] ?>">
                        <button type="submit" onclick="return confirm('Delete this coach?')">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>No coaches found.</p>
<?php endif; ?>

<?php
include __DIR__ . '/../layouts/layouts/footer.php';
?>
