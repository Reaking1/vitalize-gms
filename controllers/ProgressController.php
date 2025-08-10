<?php
require_once __DIR__ . '/../config/db.php';

class ProgressController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Update gymnast progress
    public function updateProgress($gymnast_id, $program_id, $progress_percent, $notes) {
        $stmt = $this->pdo->prepare("
            INSERT INTO progress (gymnast_id, program_id, progress_percent, notes, last_updated)
            VALUES (?, ?, ?, ?, NOW())
            ON DUPLICATE KEY UPDATE
                progress_percent = VALUES(progress_percent),
                notes = VALUES(notes),
                last_updated = NOW()
        ");
        return $stmt->execute([$gymnast_id, $program_id, $progress_percent, $notes]);
    }

    // Get gymnast progress
    public function getProgress($gymnast_id, $program_id) {
        $stmt = $this->pdo->prepare("
            SELECT progress_percent, notes, last_updated
            FROM progress
            WHERE gymnast_id = ? AND program_id = ?
        ");
        $stmt->execute([$gymnast_id, $program_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
