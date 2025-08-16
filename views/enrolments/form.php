<?php
include __DIR__ . '/../layouts/layouts/header.php';
include __DIR__ . '/../layouts/layouts/navbar.php';
// $programs: list of programs (id, name) passed from controller
// $message: optional success/error message
require_once __DIR__ . '/../../db.php';
require_once __DIR__ . '/../../controllers/EnrolmentController.php';

// fetch students
$stmt = $pdo->query("SELECT gymnast_id, name FROM gymnasts");
$gymnasts = $stmt->fetchAll(PDO::FETCH_ASSOC);
// fetch programs
$stmt = $pdo->query("SELECT program_id, program_name FROM programs");
$programs = $stmt->fetchAll(PDO::FETCH_ASSOC);


// handle form submit
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $gymnast_name = $_POST['gymnast_name'];
    $age = $_POST['age'];
    $experience_level = $_POST['experience_level'];
    $program_id = $_POST['program_id'];

    $controller = new EnrolmentController($pdo);
    $controller->enrolGymnast($gymnast_name, $age, $experience_level, $program_id);

    header("Location: list.php");
    exit;
}
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
    <option value="<?= htmlspecialchars($program['program_id']) ?>">
        <?= htmlspecialchars($program['program_name']) ?>
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
include __DIR__ . '/../layouts/layouts/footer.php';
?>
