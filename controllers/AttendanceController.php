<?php
require_once __DIR__ . '/../config.php';


class AttendanceController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Mark attendance using enrolment_id
    public function markAttendance($enrolment_id, $status, $session_date = null) {
        $date = $session_date ?? date('Y-m-d');

        $stmt = $this->pdo->prepare("
            INSERT INTO attendance (enrolment_id, session_date, status)
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([$enrolment_id, $date, $status]);
    }

    // Get attendance records for a program
    public function getAttendanceByProgram($program_id) {
        $stmt = $this->pdo->prepare("
            SELECT a.session_date, a.status,
                   g.name AS gymnast_name, g.age, g.experience_level
            FROM attendance a
            JOIN enrolments e ON a.enrolment_id = e.enrolment_id
            JOIN gymnasts g ON e.gymnast_id = g.gymnast_id
            WHERE e.program_id = ?
            ORDER BY a.session_date DESC
        ");
        $stmt->execute([$program_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get attendance records for a gymnast
    public function getAttendanceByGymnast($gymnast_id) {
        $stmt = $this->pdo->prepare("
            SELECT a.session_date, a.status,
                   p.program_name
            FROM attendance a
            JOIN enrolments e ON a.enrolment_id = e.enrolment_id
            JOIN programs p ON e.program_id = p.program_id
            WHERE e.gymnast_id = ?
            ORDER BY a.session_date DESC
        ");
        $stmt->execute([$gymnast_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
