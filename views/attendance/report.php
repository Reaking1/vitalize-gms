<?php
include __DIR__ . '/../layouts/layouts/header.php';
include __DIR__ . '/../layouts/layouts/navbar.php';
require_once __DIR__ . '/../../db.php';
require_once __DIR__ . '/../../controllers/AttendanceController.php';

// Get filter inputs
$program_id = $_GET['program_id'] ?? null;
$gymnast_id = $_GET['gymnast_id'] ?? null;

// Fetch attendance with progress
$sql = "
    SELECT g.name AS gymnast_name,
           p.program_name,
           a.session_date,
           a.status,
           pr.progress_percentage
    FROM attendance a
    JOIN enrolments e ON a.enrolment_id = e.enrolment_id
    JOIN gymnasts g ON e.gymnast_id = g.gymnast_id
    JOIN programs p ON e.program_id = p.program_id
    LEFT JOIN progress pr ON e.enrolment_id = pr.enrolment_id
    WHERE 1
";

$params = [];
if ($program_id) {
    $sql .= " AND p.program_id = ?";
    $params[] = $program_id;
}
if ($gymnast_id) {
    $sql .= " AND g.gymnast_id = ?";
    $params[] = $gymnast_id;
}

$sql .= " ORDER BY a.session_date DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$attendanceList = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Attendance & Progress Report</h2>

<form method="GET" action="">
    <label for="program_id">Filter by Program:</label>
    <input type="number" name="program_id" id="program_id" value="<?= htmlspecialchars($program_id ?? '') ?>">

    <label for="gymnast_id">Filter by Gymnast:</label>
    <input type="number" name="gymnast_id" id="gymnast_id" value="<?= htmlspecialchars($gymnast_id ?? '') ?>">

    <button type="submit">Filter</button>
</form>

<?php if (!empty($attendanceList)): ?>
<table border="1" cellpadding="8" cellspacing="0" style="margin-top:20px; border-collapse: collapse; width: 100%;">
    <thead>
        <tr>
            <th>Date</th>
            <th>Gymnast</th>
            <th>Program</th>
            <th>Status</th>
            <th>Progress</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($attendanceList as $record): ?>
        <tr>
            <td><?= htmlspecialchars($record['session_date']) ?></td>
            <td><?= htmlspecialchars($record['gymnast_name']) ?></td>
            <td><?= htmlspecialchars($record['program_name']) ?></td>
            <td><?= htmlspecialchars($record['status']) ?></td>
            <td>
                <?php
                    $progress = $record['progress_percentage'] ?? 0;
                ?>
                <div style="background:#eee; width:100px; height:15px; border-radius:5px;">
                    <div style="background:green; width:<?= $progress ?>%; height:15px; border-radius:5px;"></div>
                </div>
                <?= $progress ?>%
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
    <p>No attendance records found.</p>
<?php endif; ?>

<?php
include __DIR__ . '/../layouts/layouts/footer.php';
?>
