<?php
class Program {
    private $conn;
    private $table = 'programs';

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
        $sql = "INSERT INTO {$this->table} (name, description, coach, contact, duration, skill_level) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['name'], $data['description'], $data['coach'],
            $data['contact'], $data['duration'], $data['skill_level']
        ]);
    }

    public function update($id, $data) {
        $sql = "UPDATE {$this->table} 
                SET name = ?, description = ?, coach = ?, contact = ?, duration = ?, skill_level = ?
                WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['name'], $data['description'], $data['coach'],
            $data['contact'], $data['duration'], $data['skill_level'], $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
