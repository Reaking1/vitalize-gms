<?php
require_once __DIR__ . '/../config.php';

class EnrolmentController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Insert gymnast if not exists, return gymnast_id
    private function getOrCreateGymnast($name, $age, $experience_level) {
        // check if gymnast exists
        $stmt = $this->pdo->prepare("SELECT gymnast_id FROM gymnasts WHERE name = ? AND age = ? LIMIT 1");
        $stmt->execute([$name, $age]);
        $gymnast = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($gymnast) {
            return $gymnast['gymnast_id'];
        }

        // else create new gymnast
        $stmt = $this->pdo->prepare("
            INSERT INTO gymnasts (name, age, experience_level)
            VALUES (?, ?, ?)
        ");
        $stmt->execute([$name, $age, $experience_level]);
        return $this->pdo->lastInsertId();
    }

    // Enrol gymnast in a program
 public function enrolGymnast($gymnast_name, $age, $experience_level, $program_id) {
    // get or create gymnast
    $gymnast_id = $this->getOrCreateGymnast($gymnast_name, $age, $experience_level);

    // insert into enrolments
    $stmt = $this->pdo->prepare("
        INSERT INTO enrolments (gymnast_id, program_id, enrolment_date)
        VALUES (?, ?, NOW())
    ");
    return $stmt->execute([$gymnast_id, $program_id]);
}


    // Get all enrolments
    public function getAllEnrolments() {
        $stmt = $this->pdo->query("
            SELECT g.name AS gymnast_name, g.age, g.experience_level,
                   p.program_name,
                   e.enrol_date AS enrolment_date
            FROM enrolments e
            JOIN gymnasts g ON e.gymnast_id = g.gymnast_id
            JOIN programs p ON e.program_id = p.program_id
            ORDER BY e.enrol_date DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

   public function getEnrolments() {
    $stmt = $this->pdo->query("
        SELECT e.enrolment_id,
               g.name AS gymnast_name,
               g.age,
               g.experience_level,
               p.program_name,
               e.enrolment_date
        FROM enrolments e
        JOIN gymnasts g ON e.gymnast_id = g.gymnast_id
        JOIN programs p ON e.program_id = p.program_id
        ORDER BY e.enrolment_date DESC
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function addEnrolment($gymnast_id, $program_id) {
    $stmt = $this->pdo->prepare("
        INSERT INTO enrolments (gymnast_id, program_id, enrolment_date)
        VALUES (?, ?, NOW())
    ");
    return $stmt->execute([$gymnast_id, $program_id]);
}
}

  
?>
