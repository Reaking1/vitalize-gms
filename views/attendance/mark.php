<?php
include __DIR__ . '/../layouts/layouts/header.php';
include __DIR__ . '/../layouts/layouts/navbar.php';

require_once __DIR__ . '/../../db.php';
require_once __DIR__ . '/../../controllers/AttendanceController.php';
require_once __DIR__ . '/../../controllers/ProgressController.php';

// Fetch all current enrolments to show in a dropdown
$stmt = $pdo->query("
    SELECT e.enrolment_id, g.name AS gymnast_name, p.program_name
    FROM enrolments e
    JOIN gymnasts g ON e.gymnast_id = g.gymnast_id
    JOIN programs p ON e.program_id = p.program_id
    ORDER BY p.program_name, g.name
");
$enrolments = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle form submission
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enrolment_id = $_POST['enrolment_id'];
    $status = $_POST['status'];
    $date = $_POST['date'];
    $progress_percent = $_POST['progress_percent'] ?? null;
    $notes = $_POST['notes'] ?? '';

    // Initialize controllers
    $attendanceController = new AttendanceController($pdo);
    $progressController = new ProgressController($pdo);

    // 1. Mark attendance
    $success1 = $attendanceController->markAttendance($enrolment_id, $status, $date);

    // 2. Fetch gymnast_id and program_id from enrolment
    $stmt = $pdo->prepare("SELECT gymnast_id, program_id FROM enrolments WHERE enrolment_id = ?");
    $stmt->execute([$enrolment_id]);
    $enrolment = $stmt->fetch(PDO::FETCH_ASSOC);

    $success2 = false;
    if ($enrolment) {
        // 3. Update progress
        $success2 = $progressController->updateProgress(
            $enrolment['gymnast_id'],
            $enrolment['program_id'],
            $progress_percent ?? 0,
            $notes
        );
    }

    $message = ($success1 && $success2) ? 'Attendance & Progress updated successfully!' : 'Failed to update.';
}
?>

<h2>Mark Attendance & Enter Progress</h2>

<?php if ($message): ?>
    <p style="color:green;"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="POST" action="">
    <label for="enrolment_id">Select Gymnast & Program:</label><br>
    <select name="enrolment_id" id="enrolment_id" required>
        <option value="">-- Select Gymnast --</option>
        <?php foreach ($enrolments as $e): ?>
            <option value="<?= $e['enrolment_id'] ?>">
                <?= htmlspecialchars($e['gymnast_name'] . " — " . $e['program_name']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="status">Attendance Status:</label><br>
    <select name="status" id="status" required>
        <option value="Present">Present</option>
        <option value="Absent">Absent</option>
        <option value="Late">Late</option>
    </select><br><br>

    <label for="progress_percent">Progress (% Completion):</label><br>
    <input type="number" name="progress_percent" id="progress_percent" min="0" max="100"><br><br>

    <label for="notes">Progress Note / Scorecard:</label><br>
    <textarea name="notes" id="notes" rows="4"></textarea><br><br>

    <label for="date">Date:</label><br>
    <input type="date" name="date" id="date" required value="<?= date('Y-m-d') ?>"><br><br>

    <button type="submit">Submit</button>
</form>

<?php
include __DIR__ . '/../layouts/layouts/footer.php';
?>
