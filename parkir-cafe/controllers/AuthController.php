<?php

class AuthController extends Controller {
    
    private $userModel;
    
    public function __construct() {
        $this->userModel = $this->model('UserModel');
    }
    
    // Show login page
    public function login() {
        // If already logged in, redirect to appropriate dashboard
        if ($this->isLoggedIn()) {
            $this->redirectToDashboard();
        }
        
        $data = [
            'title' => 'Login - Parkir Cafe',
            'flash' => $this->getFlash()
        ];
        
        $this->view('auth/login', $data);
    }
    
    // Process login
    public function processLogin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            
            // Validate input
            if (empty($username) || empty($password)) {
                $this->setFlash('error', 'Username dan password harus diisi');
                $this->redirect('/auth/login');
            }
            
            // Authenticate user
            $user = $this->userModel->authenticate($username, $password);
            
            if ($user) {
                // Set session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
                $_SESSION['role'] = $user['role'];
                
                $this->setFlash('success', 'Login berhasil! Selamat datang ' . $user['nama_lengkap']);
                $this->redirectToDashboard();
            } else {
                $this->setFlash('error', 'Username atau password salah');
                $this->redirect('/auth/login');
            }
        } else {
            $this->redirect('/auth/login');
        }
    }
    
    // Logout
    public function logout() {
        session_destroy();
        $this->setFlash('success', 'Anda telah logout');
        $this->redirect('/auth/login');
    }
    
    // Redirect to appropriate dashboard based on role
    private function redirectToDashboard() {
        switch ($_SESSION['role']) {
            case 'admin':
                $this->redirect('/admin/dashboard');
                break;
            case 'petugas':
                $this->redirect('/petugas/dashboard');
                break;
            case 'owner':
                $this->redirect('/owner/dashboard');
                break;
            default:
                $this->redirect('/auth/login');
        }
    }
}
