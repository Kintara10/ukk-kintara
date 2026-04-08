<?php

class UserModel extends Model {
    protected $table = 'users';
    
    // Authenticate user
    public function authenticate($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE username = ? AND status = 'aktif'");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        
        return false;
    }
    
    // Get users by role
    public function getByRole($role) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE role = ?");
        $stmt->execute([$role]);
        return $stmt->fetchAll();
    }
    
    // Check if username exists
    public function usernameExists($username, $excludeId = null) {
        if ($excludeId) {
            $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM {$this->table} WHERE username = ? AND id != ?");
            $stmt->execute([$username, $excludeId]);
        } else {
            $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM {$this->table} WHERE username = ?");
            $stmt->execute([$username]);
        }
        
        $result = $stmt->fetch();
        return $result['count'] > 0;
    }
    
    // Create user with hashed password
    public function createUser($data) {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return $this->insert($data);
    }
    
    // Update user
    public function updateUser($id, $data) {
        // Hash password if provided
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['password']);
        }
        
        return $this->update($id, $data);
    }
    
    // Get total users count
    public function getTotalUsers() {
        $stmt = $this->db->query("SELECT COUNT(*) as total FROM {$this->table}");
        $result = $stmt->fetch();
        return $result['total'];
    }
    
    // Get active users count
    public function getActiveUsers() {
        $stmt = $this->db->query("SELECT COUNT(*) as total FROM {$this->table} WHERE status = 'aktif'");
        $result = $stmt->fetch();
        return $result['total'];
    }
}
