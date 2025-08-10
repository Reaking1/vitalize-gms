<?php
class Coach {
    private $conn;
    private $table = 'coaches';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $sql = "INSERT INTO {$this->table} (name, email, phone) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$data['name'], $data['email'], $data['phone']]);
    }

    public function update($id, $data) {
        $sql = "UPDATE {$this->table} SET name = ?, email = ?, phone = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$data['name'], $data['email'], $data['phone'], $id]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getAssignedPrograms($coachId) {
        $sql = "SELECT * FROM programs WHERE coach_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$coachId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNotifications($coachId) {
        $sql = "SELECT * FROM notifications WHERE coach_id = ? ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$coachId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
