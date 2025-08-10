<?php
class SessionController {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Set session variables for logged-in user
    public function login($userId, $username, $role) {
        $_SESSION['user_id'] = $userId;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role; // e.g., 'coach' or 'gymnast'
    }

    // Check if a user is logged in
    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    // Get current user's info
    public function getUser() {
        if ($this->isLoggedIn()) {
            return [
                'id' => $_SESSION['user_id'],
                'username' => $_SESSION['username'],
                'role' => $_SESSION['role']
            ];
        }
        return null;
    }

    // Restrict access based on role
    public function requireRole($role) {
        if (!$this->isLoggedIn() || $_SESSION['role'] !== $role) {
            header("Location: /login.php");
            exit();
        }
    }

    // Log out user
    public function logout() {
        $_SESSION = [];
        session_destroy();
    }
}
?>
