<?php
require_once __DIR__ . '/../config.php';

class ProgramController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Add new program
    public function addProgram($name, $description, $coach_id, $duration_weeks, $skill_level) {
        $stmt = $this->pdo->prepare("
            INSERT INTO programs (program_name, description, coach_id, duration_weeks, skill_level)
            VALUES (?, ?, ?, ?, ?)
        ");
        return $stmt->execute([$name, $description, $coach_id, $duration_weeks, $skill_level]);
    }

    // Edit program
    public function editProgram($id, $name, $description, $coach_id, $duration_weeks, $skill_level) {
        $stmt = $this->pdo->prepare("
            UPDATE programs
            SET program_name = ?, description = ?, coach_id = ?, duration_weeks = ?, skill_level = ?
            WHERE program_id = ?
        ");
        return $stmt->execute([$name, $description, $coach_id, $duration_weeks, $skill_level, $id]);
    }

    // Delete program
    public function deleteProgram($id) {
        $stmt = $this->pdo->prepare("DELETE FROM programs WHERE program_id = ?");
        return $stmt->execute([$id]);
    }

    // View all programs
    public function getPrograms() {
        $stmt = $this->pdo->query("
            SELECT p.*, c.name AS coach_name
            FROM programs p
            LEFT JOIN coaches c ON p.coach_id = c.coach_id
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
