<?php
include __DIR__ . '/../layouts/layouts/header.php';
include __DIR__ . '/../layouts/layouts/navbar.php';

require_once __DIR__ . '/../../controllers/ProgramController.php';
require_once __DIR__ . '/../../db.php';

$controller = new ProgramController($pdo);
$message = null;
$program = null;
$isEdit = false;
$stmt = $pdo->query("SELECT coach_id, name FROM coaches");
$coaches = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Editing?
if (isset($_GET['id'])) {
    $program = $controller->getProgramById($_GET['id']);
    $isEdit = true;
}

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 $name = $_POST['name'];
    $description = $_POST['description'];
    $coach_id = $_POST['coach_id'];
    $duration_weeks = $_POST['duration_weeks'];
    $skill_level = $_POST['skill_level'];

    if ($program) {
        $controller->editProgram($program['id'], $name, $description, $coach_id, $duration_weeks, $skill_level);
        $message = "Program updated successfully!";
    } else {
        $controller->addProgram($name, $description, $coach_id, $duration_weeks, $skill_level);
        $message = "Program added successfully!";
    }
}
?>

<h2><?= $isEdit ? "Edit Program" : "Add New Program" ?></h2>

<?php if ($message): ?>
    <p style="color:green;"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="POST" action="">
    <label for="name">Program Name:</label><br>
    <input type="text" name="name" id="name" required 
           value="<?= htmlspecialchars($program['name'] ?? '') ?>"><br><br>

    <label for="description">Description:</label><br>
    <textarea name="description" id="description" required><?= htmlspecialchars($program['description'] ?? '') ?></textarea><br><br>

    <label for="coach">Coach:</label>
<select name="coach_id" id="coach">
    <?php foreach ($coaches as $coach): ?>
        <option value="<?= $coach['coach_id'] ?>"><?= $coach['name'] ?></option>
    <?php endforeach; ?>
</select>
<br><br>

    <label for="contact">Coach Contact:</label><br>
    <input type="text" name="contact" id="contact" 
           value="<?= htmlspecialchars($program['contact'] ?? '') ?>"><br><br>

    <label for="duration">Duration (weeks):</label><br>
<input type="number" name="duration_weeks" id="duration" required min="1" 
       value="<?= htmlspecialchars($program['duration'] ?? '') ?>"><br><br>


    <label for="skill_level">Skill Level:</label><br>
    <select name="skill_level" id="skill_level" required>
        <option value="">Select Skill Level</option>
        <?php
        $levels = ['Beginner', 'Intermediate', 'Advanced'];
        foreach ($levels as $level):
            $selected = ($program['skill_level'] ?? '') === $level ? 'selected' : '';
        ?>
            <option value="<?= $level ?>" <?= $selected ?>><?= $level ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit"><?= $isEdit ? 'Update Program' : 'Create Program' ?></button>
</form>

<?php
include __DIR__ . '/../layouts/layouts/footer.php';
?>
