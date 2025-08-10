<?php
require_once __DIR__ . '/../models/Coach.php';

class CoachController {
    private $coachModel;

    public function __construct($db) {
        $this->coachModel = new Coach($db);
    }

    // Show all coaches
    public function listCoaches() {
        return $this->coachModel->getAll();
    }

    // Show a specific coach
    public function viewCoach($id) {
        return $this->coachModel->getById($id);
    }

    // Add a new coach
    public function addCoach($data) {
        return $this->coachModel->create($data);
    }

    // Update coach info
    public function updateCoach($id, $data) {
        return $this->coachModel->update($id, $data);
    }

    // Delete a coach
    public function deleteCoach($id) {
        return $this->coachModel->delete($id);
    }

    // Coach dashboard data
    public function dashboard($coachId) {
        return [
            'assignedPrograms' => $this->coachModel->getAssignedPrograms($coachId),
            'notifications' => $this->coachModel->getNotifications($coachId)
        ];
    }

    // Get notifications for a coach
    public function getNotifications($coachId) {
        return $this->coachModel->getNotifications($coachId);
    }
}
?>
