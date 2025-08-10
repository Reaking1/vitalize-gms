<?php
require_once __DIR__ . '/../config/db.php';

class EnrolmentController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Enrol gymnast in a program
    public function enrolGymnast($gymnast_id, $program_id) {
        $stmt = $this->pdo->prepare("
            INSERT INTO enrolments (gymnast_id, program_id, enrol_date)
            VALUES (?, ?, NOW())
        ");
        return $stmt->execute([$gymnast_id, $program_id]);
    }

    // Get enrolments for a program
    public function getEnrolmentsByProgram($program_id) {
        $stmt = $this->pdo->prepare("
            SELECT g.name, g.age, g.experience_level, e.enrol_date
            FROM enrolments e
            JOIN gymnasts g ON e.gymnast_id = g.gymnast_id
            WHERE e.program_id = ?
        ");
        $stmt->execute([$program_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
