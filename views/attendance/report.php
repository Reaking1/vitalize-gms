<?php
include __DIR__ . '/../layouts/layouts/header.php';
include __DIR__ . '/../layouts/layouts/navbar.php';
?>

<h2>Attendance Report</h2>

<form method="GET" action="">
    <label for="program_id">Filter by Program ID:</label>
    <input type="number" name="program_id" id="program_id" value="<?= htmlspecialchars($_GET['program_id'] ?? '') ?>">
    
    <label for="gymnast_id">Or Filter by Gymnast ID:</label>
    <input type="number" name="gymnast_id" id="gymnast_id" value="<?= htmlspecialchars($_GET['gymnast_id'] ?? '') ?>">
    
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
        </tr>
    </thead>
    <tbody>
    <?php foreach ($attendanceList as $record): ?>
        <tr>
            <td><?= htmlspecialchars($record['date'] ?? $record['attendance_date'] ?? '') ?></td>
            <td><?= htmlspecialchars($record['gymnast_name'] ?? '') ?></td>
            <td><?= htmlspecialchars($record['program_name'] ?? '') ?></td>
            <td><?= htmlspecialchars($record['status']) ?></td>
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
