<?php

class AreaModel extends Model {
    protected $table = 'area_parkir';
    
    // Get active areas
    public function getActiveAreas() {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE status = 'aktif'");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    // Get available areas for vehicle type
    public function getAvailableAreas($jenisKendaraan) {
        $stmt = $this->db->prepare("
            SELECT * FROM {$this->table} 
            WHERE status = 'aktif' 
            AND (jenis_kendaraan = ? OR jenis_kendaraan = 'semua')
            AND terisi < kapasitas
        ");
        $stmt->execute([$jenisKendaraan]);
        return $stmt->fetchAll();
    }
    
    // Check if area has capacity
    public function hasCapacity($areaId) {
        $area = $this->getById($areaId);
        return $area && $area['terisi'] < $area['kapasitas'];
    }
    
    // Increment area occupancy
    public function incrementOccupancy($areaId) {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET terisi = terisi + 1 WHERE id = ?");
        return $stmt->execute([$areaId]);
    }
    
    // Decrement area occupancy
    public function decrementOccupancy($areaId) {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET terisi = terisi - 1 WHERE id = ? AND terisi > 0");
        return $stmt->execute([$areaId]);
    }
    
    // Get area statistics
    public function getAreaStats() {
        $stmt = $this->db->query("
            SELECT 
                id,
                nama_area,
                kode_area,
                kapasitas,
                terisi,
                (kapasitas - terisi) as tersedia,
                ROUND((terisi / kapasitas * 100), 2) as persentase_terisi
            FROM {$this->table}
            WHERE status = 'aktif'
        ");
        return $stmt->fetchAll();
    }
    
    // Get total capacity
    public function getTotalCapacity() {
        $stmt = $this->db->query("SELECT SUM(kapasitas) as total FROM {$this->table} WHERE status = 'aktif'");
        $result = $stmt->fetch();
        return $result['total'] ?? 0;
    }
    
    // Get total occupied
    public function getTotalOccupied() {
        $stmt = $this->db->query("SELECT SUM(terisi) as total FROM {$this->table} WHERE status = 'aktif'");
        $result = $stmt->fetch();
        return $result['total'] ?? 0;
    }
}
