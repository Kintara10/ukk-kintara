<?php

class Model {
    protected $db;
    protected $table;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    // Get all records
    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    // Get record by ID
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    // Insert record
    public function insert($data) {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        
        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute(array_values($data));
    }
    
    // Update record
    public function update($id, $data) {
        $setClause = implode(', ', array_map(function($key) {
            return "{$key} = ?";
        }, array_keys($data)));
        
        $sql = "UPDATE {$this->table} SET {$setClause} WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        
        $values = array_values($data);
        $values[] = $id;
        
        return $stmt->execute($values);
    }
    
    // Delete record
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    // Custom query
    public function query($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
    
    // Get last insert ID
    public function lastInsertId() {
        return $this->db->lastInsertId();
    }
}
