<?php
// Load dependencies
require_once __DIR__ . '/controllers/ProgramController.php';
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/config.php'; 


// Layout includes
include __DIR__ . '/views/layouts/layouts/header.php';
include __DIR__ . '/views/layouts/layouts/navbar.php';

// Fetch programs
$programController = new ProgramController($pdo);
$programs = $programController->getPrograms();
?>

<h2>Available Gymnastics Programs</h2>

<!-- Link to add a new program -->
<p>
   <a href="<?= BASE_URL ?>views/programs/form.php">➕ Add New Program</a> | 
<a href="<?= BASE_URL ?>views/enrolments/form.php">📝 Enrol a Gymnast</a> | 
<a href="<?= BASE_URL ?>views/attendance/mark.php">📅 Mark Attendance</a> | 
<a href="<?= BASE_URL ?>views/progress/view.php">📊 View Progress</a>
</p>

<?php if (!empty($programs)): ?>
<table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr>
            <th>Program Name</th>
            <th>Coach</th>
            <th>Duration (weeks)</th>
            <th>Skill Level</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($programs as $program): ?>
    <tr>
        <tr>
    <td><?= htmlspecialchars($program['name'] ?? $program['program_name'] ?? '') ?></td>
    <td><?= htmlspecialchars($program['coach'] ?? $program['coach_name'] ?? '') ?></td>
    <td><?= htmlspecialchars($program['duration'] ?? $program['duration_weeks'] ?? '') ?></td>
    <td><?= htmlspecialchars($program['skill_level'] ?? '') ?></td>
    <td>
        <a href="<?= BASE_URL ?>views/programs/view.php?id=<?= urlencode($program['id']) ?>">👁 View</a> |
        <a href="<?= BASE_URL ?>views/programs/form.php?id=<?= urlencode($program['id']) ?>">✏ Edit</a> |
        <a href="<?= BASE_URL ?>views/programs/delete.php?id=<?= urlencode($program['id']) ?>"
           onclick="return confirm('Are you sure you want to delete this program?');">🗑 Delete</a> |
        <a href="<?= BASE_URL ?>views/enrolments/form.php?program_id=<?= urlencode($program['id']) ?>">📝 Enrol</a> |
        <a href="<?= BASE_URL ?>views/progress/view.php?program_id=<?= urlencode($program['id']) ?>">📊 Progress</a> |
        <a href="<?= BASE_URL ?>views/attendance/mark.php?program_id=<?= urlencode($program['id']) ?>">📅 Attendance</a>
    </td>
    </tr>
<?php endforeach; ?>

    </tbody>
</table>
<?php else: ?>
    <p>No programs available at this time.</p>
<?php endif; ?>

<?php
include __DIR__ . '/views/layouts/layouts/footer.php';
?>
