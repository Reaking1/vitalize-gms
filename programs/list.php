<?php
include __DIR__ . '/../layouts/header.php';
include __DIR__ . '/../layouts/navbar.php';

// $programs: array of program records passed from controller
?>

<h2>Gymnastics Programs</h2>

<form method="GET" action="" style="margin-bottom:20px;">
    <input type="text" name="search" placeholder="Search programs..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
    <select name="skill_level">
        <option value="">All Skill Levels</option>
        <option value="Beginner" <?= (($_GET['skill_level'] ?? '') === 'Beginner') ? 'selected' : '' ?>>Beginner</option>
        <option value="Intermediate" <?= (($_GET['skill_level'] ?? '') === 'Intermediate') ? 'selected' : '' ?>>Intermediate</option>
        <option value="Advanced" <?= (($_GET['skill_level'] ?? '') === 'Advanced') ? 'selected' : '' ?>>Advanced</option>
    </select>
    <button type="submit">Filter</button>
    <a href="form.php" style="margin-left:20px;">Add New Program</a>
</form>

<?php if (!empty($programs)): ?>
<table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr>
            <th>Program Name</th>
            <th>Coach</th>
            <th>Duration (weeks)</th>
            <th>Skill Level</th>
            <th>Enrolled Gymnasts</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($programs as $program): ?>
        <tr>
            <td><?= htmlspecialchars($program['name']) ?></td>
            <td><?= htmlspecialchars($program['coach']) ?></td>
            <td><?= htmlspecialchars($program['duration']) ?></td>
            <td><?= htmlspecialchars($program['skill_level']) ?></td>
            <td><?= htmlspecialchars($program['enrolled_count'] ?? 0) ?></td>
            <td>
                <a href="view.php?id=<?= $program['id'] ?>">View</a> |
                <a href="form.php?id=<?= $program['id'] ?>">Edit</a> |
                <a href="delete.php?id=<?= $program['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
    <p>No programs found.</p>
<?php endif; ?>

<?php
include __DIR__ . '/../layouts/footer.php';
?>
