<?php

class TarifModel extends Model {
    protected $table = 'tarif_parkir';
    
    // Get active tarif
    public function getActiveTarif() {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE status = 'aktif'");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    // Get tarif by jenis kendaraan
    public function getByJenisKendaraan($jenis) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE jenis_kendaraan = ? AND status = 'aktif'");
        $stmt->execute([$jenis]);
        return $stmt->fetch();
    }
    
    // Calculate parking fee
    public function calculateFee($tarifId, $durasiJam) {
        $tarif = $this->getById($tarifId);
        
        if (!$tarif) {
            return 0;
        }
        
        // If duration is more than 24 hours, use daily rate
        if ($durasiJam >= 24) {
            $days = ceil($durasiJam / 24);
            return $days * $tarif['tarif_harian'];
        } else {
            // Use hourly rate, minimum 1 hour
            $hours = ceil($durasiJam);
            return $hours * $tarif['tarif_per_jam'];
        }
    }
    
    // Get tarif statistics
    public function getTarifStats() {
        $stmt = $this->db->query("
            SELECT 
                jenis_kendaraan,
                tarif_per_jam,
                tarif_harian,
                status
            FROM {$this->table}
            ORDER BY jenis_kendaraan
        ");
        return $stmt->fetchAll();
    }
}
