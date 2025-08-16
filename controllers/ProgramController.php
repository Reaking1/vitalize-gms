<?php
require_once __DIR__ . '/../config.php';

class ProgramController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    //get all programs
public function getPrograms() {
    $stmt = $this->pdo->query("
        SELECT 
            p.program_id AS id,
            p.program_name AS name,
            c.name AS coach,
            COALESCE(p.duration_weeks, 0) AS duration,  -- default to 0 if null
            p.skill_level
        FROM programs p
        LEFT JOIN coaches c ON p.coach_id = c.coach_id
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// Get single program by ID
public function getProgramById($id) {
    $stmt = $this->pdo->prepare("
        SELECT 
            p.program_id AS id,
            p.program_name AS name,
            p.description,
            c.name AS coach,
            c.contact,
            p.duration_weeks AS duration,
            p.skill_level
        FROM programs p
        LEFT JOIN coaches c ON p.coach_id = c.coach_id
        WHERE p.program_id = ?
    ");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
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

  
}
?>
