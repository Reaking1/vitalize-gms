<?php
// Include common layout parts
include __DIR__ . '/../layouts/layouts/header.php';
include __DIR__ . '/../layouts/layouts/navbar.php';

// Show success message if set
if (isset($message)) {
    echo "<p style='color:green;'>$message</p>";
}
?>

<h2>Mark Attendance</h2>

<form method="POST" action="">
    <label for="program_id">Program ID:</label><br>
    <input type="number" name="program_id" id="program_id" required><br><br>

    <label for="gymnast_id">Gymnast ID:</label><br>
    <input type="number" name="gymnast_id" id="gymnast_id" required><br><br>

    <label for="status">Status:</label><br>
    <select name="status" id="status" required>
        <option value="Present">Present</option>
        <option value="Absent">Absent</option>
        <option value="Late">Late</option>
    </select><br><br>

    <label for="date">Date:</label><br>
    <input type="date" name="date" id="date" required value="<?= date('Y-m-d') ?>"><br><br>

    <button type="submit">Mark Attendance</button>
</form>

<?php
include __DIR__ . '/../layouts/layouts/footer.php';
?>

