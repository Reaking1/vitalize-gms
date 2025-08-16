<?php
require_once __DIR__ . '/../config.php';


class ProgressController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Update gymnast progress using enrolment
    public function updateProgress($enrolment_id, $progress_percentage, $notes) {
        $stmt = $this->pdo->prepare("
            INSERT INTO progress (enrolment_id, notes, progress_percentage)
            VALUES (?, ?, ?)
            ON DUPLICATE KEY UPDATE
                progress_percentage = VALUES(progress_percentage),
                notes = VALUES(notes)
        ");
        return $stmt->execute([$enrolment_id, $notes, $progress_percentage]);
    }

    // Get progress for all gymnasts
    public function getAllProgress($program_id = null, $gymnast_id = null) {
        $sql = "
            SELECT g.name AS gymnast_name,
                   p.program_name,
                   pr.notes,
                   pr.progress_percentage,
                   pr.progress_id,
                   pr.last_updated
            FROM progress pr
            JOIN enrolments e ON pr.enrolment_id = e.enrolment_id
            JOIN gymnasts g ON e.gymnast_id = g.gymnast_id
            JOIN programs p ON e.program_id = p.program_id
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

        $sql .= " ORDER BY pr.last_updated DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
