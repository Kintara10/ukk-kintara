<?php

class KendaraanModel extends Model {
    protected $table = 'kendaraan';
    
    // Find by plate number
    public function findByPlateNumber($noPolisi) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE no_polisi = ?");
        $stmt->execute([$noPolisi]);
        return $stmt->fetch();
    }
    
    // Get or create vehicle
    public function getOrCreate($data) {
        // Check if vehicle exists
        $existing = $this->findByPlateNumber($data['no_polisi']);
        
        if ($existing) {
            // Update vehicle info if provided
            if (isset($data['merk']) || isset($data['warna']) || isset($data['nama_pemilik'])) {
                $updateData = [];
                if (isset($data['merk'])) $updateData['merk'] = $data['merk'];
                if (isset($data['warna'])) $updateData['warna'] = $data['warna'];
                if (isset($data['nama_pemilik'])) $updateData['nama_pemilik'] = $data['nama_pemilik'];
                if (isset($data['no_telp_pemilik'])) $updateData['no_telp_pemilik'] = $data['no_telp_pemilik'];
                
                if (!empty($updateData)) {
                    $this->update($existing['id'], $updateData);
                }
            }
            return $existing['id'];
        } else {
            // Create new vehicle
            $this->insert($data);
            return $this->lastInsertId();
        }
    }
    
    // Get vehicles by type
    public function getByType($jenisKendaraan) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE jenis_kendaraan = ? ORDER BY created_at DESC");
        $stmt->execute([$jenisKendaraan]);
        return $stmt->fetchAll();
    }
    
    // Search vehicles
    public function search($keyword) {
        $stmt = $this->db->prepare("
            SELECT * FROM {$this->table} 
            WHERE no_polisi LIKE ? 
            OR nama_pemilik LIKE ? 
            OR merk LIKE ?
            ORDER BY created_at DESC
        ");
        $searchTerm = "%{$keyword}%";
        $stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
        return $stmt->fetchAll();
    }
    
    // Get total vehicles
    public function getTotalVehicles() {
        $stmt = $this->db->query("SELECT COUNT(*) as total FROM {$this->table}");
        $result = $stmt->fetch();
        return $result['total'];
    }
    
    // Get vehicles count by type
    public function getCountByType() {
        $stmt = $this->db->query("
            SELECT 
                jenis_kendaraan,
                COUNT(*) as jumlah
            FROM {$this->table}
            GROUP BY jenis_kendaraan
        ");
        return $stmt->fetchAll();
    }
}
