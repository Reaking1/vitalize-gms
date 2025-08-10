<?php
class ProgressNote {
    private $conn;
    private $table = 'progress_notes';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addNote($programId, $gymnastId, $note, $completion) {
        $stmt = $this->conn->prepare("INSERT INTO {$this->table} (program_id, gymnast_id, note, completion_percentage) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$programId, $gymnastId, $note, $completion]);
    }

    public function getByGymnast($gymnastId) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE gymnast_id = ?");
        $stmt->execute([$gymnastId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
