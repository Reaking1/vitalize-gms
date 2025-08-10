<?php
include __DIR__ . '/../layouts/header.php';
include __DIR__ . '/../layouts/navbar.php';

// $programs: list of programs (id, name) passed from controller
// $message: optional success/error message

?>

<h2>Gymnast Enrolment Form</h2>

<?php if (isset($message)) {
    echo "<p style='color:green;'>$message</p>";
} ?>

<form method="POST" action="">
    <label for="program_id">Select Program:</label><br>
    <select name="program_id" id="program_id" required>
        <option value="">-- Select a Program --</option>
        <?php foreach ($programs as $program): ?>
            <option value="<?= htmlspecialchars($program['id']) ?>">
                <?= htmlspecialchars($program['name']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="gymnast_name">Gymnast Name:</label><br>
    <input type="text" id="gymnast_name" name="gymnast_name" required><br><br>

    <label for="age">Age:</label><br>
    <input type="number" id="age" name="age" required min="1"><br><br>

    <label for="experience_level">Experience Level:</label><br>
    <select id="experience_level" name="experience_level" required>
        <option value="">-- Select Experience Level --</option>
        <option value="Beginner">Beginner</option>
        <option value="Intermediate">Intermediate</option>
        <option value="Advanced">Advanced</option>
    </select><br><br>

    <button type="submit">Enrol Gymnast</button>
</form>

<?php
include __DIR__ . '/../layouts/footer.php';
?>
