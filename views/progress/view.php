<?php
include __DIR__ . '/../layouts/layouts/header.php';
include __DIR__ . '/../layouts/layouts/navbar.php';

// $gymnastProgress: array of progress notes passed from controller
// Expected format: [
//   ['program_name' => ..., 'gymnast_name' => ..., 'note' => ..., 'completion_percentage' => ..., 'date' => ...],
// ]

?>

<h2>Gymnast Progress</h2>

<?php if (!empty($gymnastProgress)): ?>

    <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr>
                <th>Program</th>
                <th>Gymnast</th>
                <th>Progress Note</th>
                <th>Completion</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($gymnastProgress as $progress): ?>
                <tr>
                    <td><?= htmlspecialchars($progress['program_name']) ?></td>
                    <td><?= htmlspecialchars($progress['gymnast_name']) ?></td>
                    <td><?= nl2br(htmlspecialchars($progress['note'])) ?></td>
                    <td>
                        <div style="background:#eee; width: 150px; border-radius: 5px; overflow: hidden;">
                            <div style="width: <?= (int)$progress['completion_percentage'] ?>%; background: #4caf50; color: white; text-align: center;">
                                <?= (int)$progress['completion_percentage'] ?>%
                            </div>
                        </div>
                    </td>
                    <td><?= htmlspecialchars($progress['date'] ?? '') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php else: ?>
    <p>No progress notes found for this gymnast.</p>
<?php endif; ?>

<?php
include __DIR__ . '/../layouts/layouts/footer.php';
?>
