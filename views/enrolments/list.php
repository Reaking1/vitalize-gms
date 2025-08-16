<?php
include __DIR__ . '/../layouts/layouts/header.php';
include __DIR__ . '/../layouts/layouts/navbar.php';

// $enrolments: array of enrolment records passed from controller
require_once __DIR__ . '/../../db.php';
require_once __DIR__ . '/../../controllers/EnrolmentController.php';

$controller = new EnrolmentController($pdo);
$enrolments = $controller->getEnrolments();
?>

<h2>Enrolments List</h2>

<?php if (!empty($enrolments)): ?>
<table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr>
            <th>Gymnast Name</th>
            <th>Age</th>
            <th>Experience Level</th>
            <th>Program</th>
            <th>Enrolment Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($enrolments as $enrolment): ?>
            <tr>
                <td><?= htmlspecialchars($enrolment['gymnast_name']) ?></td>
                <td><?= htmlspecialchars($enrolment['age']) ?></td>
                <td><?= htmlspecialchars($enrolment['experience_level']) ?></td>
                <td><?= htmlspecialchars($enrolment['program_name']) ?></td>
                <td><?= htmlspecialchars($enrolment['enrolment_date']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
    <p>No enrolments found.</p>
<?php endif; ?>

<?php
include __DIR__ . '/../layouts/layouts/footer.php';
?>
