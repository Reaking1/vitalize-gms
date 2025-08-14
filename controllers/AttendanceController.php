<?php
require_once __DIR__ . '/../config.php';


class AttendanceController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Mark attendance
    public function markAttendance($gymnast_id, $program_id, $status) {
        $stmt = $this->pdo->prepare("
            INSERT INTO attendance (gymnast_id, program_id, attendance_date, status)
            VALUES (?, ?, CURDATE(), ?)
        ");
        return $stmt->execute([$gymnast_id, $program_id, $status]);
    }

    // Get attendance records
    public function getAttendance($program_id) {
        $stmt = $this->pdo->prepare("
            SELECT g.name, a.attendance_date, a.status
            FROM attendance a
            JOIN gymnasts g ON a.gymnast_id = g.gymnast_id
            WHERE a.program_id = ?
        ");
        $stmt->execute([$program_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
