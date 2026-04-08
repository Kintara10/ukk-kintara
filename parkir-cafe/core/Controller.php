<?php

class Controller {
    
    // Load model
    protected function model($model) {
        $modelPath = __DIR__ . '/../models/' . $model . '.php';
        
        if (file_exists($modelPath)) {
            require_once $modelPath;
            return new $model();
        } else {
            die("Model {$model} not found");
        }
    }
    
    // Load view
    protected function view($view, $data = []) {
        $viewPath = __DIR__ . '/../views/' . $view . '.php';
        
        if (file_exists($viewPath)) {
            extract($data);
            require_once $viewPath;
        } else {
            die("View {$view} not found");
        }
    }
    
    // Redirect helper
    protected function redirect($url) {
        header("Location: " . BASE_URL . $url);
        exit;
    }
    
    // Check if user is logged in
    protected function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }
    
    // Check user role
    protected function checkRole($allowedRoles = []) {
        if (!$this->isLoggedIn()) {
            $this->redirect('/auth/login');
        }
        
        if (!empty($allowedRoles) && !in_array($_SESSION['role'], $allowedRoles)) {
            die("Access denied. You don't have permission to access this page.");
        }
    }
    
    // Flash message
    protected function setFlash($type, $message) {
        $_SESSION['flash'] = [
            'type' => $type,
            'message' => $message
        ];
    }
    
    protected function getFlash() {
        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
            return $flash;
        }
        return null;
    }
}
