<?php
include __DIR__ . '/../layouts/layouts/header.php';
include __DIR__ . '/../layouts/layouts/navbar.php';

// $program: associative array with program data if editing, otherwise null
// $message: success or error message

$isEdit = isset($program);
?>

<h2><?= $isEdit ? "Edit Program" : "Add New Program" ?></h2>

<?php if (isset($message)) {
    echo "<p style='color:green;'>$message</p>";
} ?>

<form method="POST" action="">
    <label for="name">Program Name:</label><br>
    <input type="text" name="name" id="name" required value="<?= htmlspecialchars($program['name'] ?? '') ?>"><br><br>

    <label for="description">Description:</label><br>
    <textarea name="description" id="description" required><?= htmlspecialchars($program['description'] ?? '') ?></textarea><br><br>

    <label for="coach">Coach Name:</label><br>
    <input type="text" name="coach" id="coach" required value="<?= htmlspecialchars($program['coach'] ?? '') ?>"><br><br>

    <label for="contact">Coach Contact:</label><br>
    <input type="text" name="contact" id="contact" required value="<?= htmlspecialchars($program['contact'] ?? '') ?>"><br><br>

    <label for="duration">Duration (weeks):</label><br>
    <input type="number" name="duration" id="duration" required min="1" value="<?= htmlspecialchars($program['duration'] ?? '') ?>"><br><br>

    <label for="skill_level">Skill Level:</label><br>
    <select name="skill_level" id="skill_level" required>
        <option value="">Select Skill Level</option>
        <?php
        $levels = ['Beginner', 'Intermediate', 'Advanced'];
        foreach ($levels as $level):
            $selected = (isset($program['skill_level']) && $program['skill_level'] === $level) ? 'selected' : '';
        ?>
            <option value="<?= $level ?>" <?= $selected ?>><?= $level ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit"><?= $isEdit ? 'Update Program' : 'Create Program' ?></button>
</form>

<?php
include __DIR__ . '/../layouts/layouts/footer.php';
?>
