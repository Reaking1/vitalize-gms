<?php
class Enrolment {
    private $conn;
    private $table = 'enrolments';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function enrolGymnast($programId, $gymnastId) {
        $sql = "INSERT INTO {$this->table} (program_id, gymnast_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$programId, $gymnastId]);
    }

    public function getByProgram($programId) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE program_id = ?");
        $stmt->execute([$programId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
