<?php
class Session {
    private $conn;
    private $table = 'sessions';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($programId, $date) {
        $stmt = $this->conn->prepare("INSERT INTO {$this->table} (program_id, session_date) VALUES (?, ?)");
        return $stmt->execute([$programId, $date]);
    }

    public function getByProgram($programId) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE program_id = ?");
        $stmt->execute([$programId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
