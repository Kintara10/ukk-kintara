<?php

class TransaksiModel extends Model {
    protected $table = 'transaksi';
    
    // Generate unique ticket code
    public function generateTicketCode() {
        $prefix = 'PKR';
        $date = date('Ymd');
        $random = strtoupper(substr(md5(uniqid(rand(), true)), 0, 6));
        return "{$prefix}-{$date}-{$random}";
    }
    
    // Create parking entry
    public function createEntry($data) {
        $data['kode_tiket'] = $this->generateTicketCode();
        $data['waktu_masuk'] = date('Y-m-d H:i:s');
        $data['status'] = 'parkir';
        
        return $this->insert($data);
    }
    
    // Process exit
    public function processExit($transaksiId, $petugasKeluarId) {
        $transaksi = $this->getById($transaksiId);
        
        if (!$transaksi || $transaksi['status'] != 'parkir') {
            return false;
        }
        
        $waktuKeluar = date('Y-m-d H:i:s');
        $waktuMasuk = new DateTime($transaksi['waktu_masuk']);
        $waktuKeluarObj = new DateTime($waktuKeluar);
        
        $interval = $waktuMasuk->diff($waktuKeluarObj);
        $durasiJam = $interval->days * 24 + $interval->h + ($interval->i / 60);
        
        // Calculate fee using TarifModel
        require_once __DIR__ . '/TarifModel.php';
        $tarifModel = new TarifModel();
        $totalBayar = $tarifModel->calculateFee($transaksi['tarif_id'], $durasiJam);
        
        $updateData = [
            'waktu_keluar' => $waktuKeluar,
            'petugas_keluar_id' => $petugasKeluarId,
            'durasi_jam' => round($durasiJam, 2),
            'total_bayar' => $totalBayar,
            'status' => 'selesai'
        ];
        
        return $this->update($transaksiId, $updateData);
    }
    
    // Get active parking sessions
    public function getActiveSessions() {
        $stmt = $this->db->query("
            SELECT 
                t.*,
                k.no_polisi,
                k.jenis_kendaraan,
                k.merk,
                k.warna,
                a.nama_area,
                a.kode_area,
                u.nama_lengkap as petugas_masuk
            FROM {$this->table} t
            JOIN kendaraan k ON t.kendaraan_id = k.id
            JOIN area_parkir a ON t.area_parkir_id = a.id
            JOIN users u ON t.petugas_masuk_id = u.id
            WHERE t.status = 'parkir'
            ORDER BY t.waktu_masuk DESC
        ");
        return $stmt->fetchAll();
    }
    
    // Get transaction by ticket code
    public function getByTicketCode($kodeTicket) {
        $stmt = $this->db->prepare("
            SELECT 
                t.*,
                k.no_polisi,
                k.jenis_kendaraan,
                k.merk,
                k.warna,
                k.nama_pemilik,
                a.nama_area,
                a.kode_area,
                tp.tarif_per_jam,
                tp.tarif_harian,
                u1.nama_lengkap as petugas_masuk,
                u2.nama_lengkap as petugas_keluar
            FROM {$this->table} t
            JOIN kendaraan k ON t.kendaraan_id = k.id
            JOIN area_parkir a ON t.area_parkir_id = a.id
            JOIN tarif_parkir tp ON t.tarif_id = tp.id
            JOIN users u1 ON t.petugas_masuk_id = u1.id
            LEFT JOIN users u2 ON t.petugas_keluar_id = u2.id
            WHERE t.kode_tiket = ?
        ");
        $stmt->execute([$kodeTicket]);
        return $stmt->fetch();
    }
    
    // Get completed transactions
    public function getCompletedTransactions($limit = 100) {
        $stmt = $this->db->prepare("
            SELECT 
                t.*,
                k.no_polisi,
                k.jenis_kendaraan,
                a.nama_area,
                u1.nama_lengkap as petugas_masuk,
                u2.nama_lengkap as petugas_keluar
            FROM {$this->table} t
            JOIN kendaraan k ON t.kendaraan_id = k.id
            JOIN area_parkir a ON t.area_parkir_id = a.id
            JOIN users u1 ON t.petugas_masuk_id = u1.id
            LEFT JOIN users u2 ON t.petugas_keluar_id = u2.id
            WHERE t.status = 'selesai'
            ORDER BY t.waktu_keluar DESC
            LIMIT ?
        ");
        $stmt->execute([$limit]);
        return $stmt->fetchAll();
    }
    
    // Get transactions by date range
    public function getByDateRange($startDate, $endDate) {
        $stmt = $this->db->prepare("
            SELECT 
                t.*,
                k.no_polisi,
                k.jenis_kendaraan,
                a.nama_area
            FROM {$this->table} t
            JOIN kendaraan k ON t.kendaraan_id = k.id
            JOIN area_parkir a ON t.area_parkir_id = a.id
            WHERE DATE(t.waktu_masuk) BETWEEN ? AND ?
            ORDER BY t.waktu_masuk DESC
        ");
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll();
    }
    
    // Get revenue statistics
    public function getRevenueStats($startDate = null, $endDate = null) {
        if ($startDate && $endDate) {
            $stmt = $this->db->prepare("
                SELECT 
                    COUNT(*) as total_transaksi,
                    SUM(total_bayar) as total_pendapatan,
                    AVG(total_bayar) as rata_rata,
                    AVG(durasi_jam) as rata_durasi
                FROM {$this->table}
                WHERE status = 'selesai'
                AND DATE(waktu_keluar) BETWEEN ? AND ?
            ");
            $stmt->execute([$startDate, $endDate]);
        } else {
            $stmt = $this->db->query("
                SELECT 
                    COUNT(*) as total_transaksi,
                    SUM(total_bayar) as total_pendapatan,
                    AVG(total_bayar) as rata_rata,
                    AVG(durasi_jam) as rata_durasi
                FROM {$this->table}
                WHERE status = 'selesai'
            ");
        }
        return $stmt->fetch();
    }
    
    // Get today's revenue
    public function getTodayRevenue() {
        $today = date('Y-m-d');
        $stmt = $this->db->prepare("
            SELECT SUM(total_bayar) as total 
            FROM {$this->table} 
            WHERE status = 'selesai' 
            AND DATE(waktu_keluar) = ?
        ");
        $stmt->execute([$today]);
        $result = $stmt->fetch();
        return $result['total'] ?? 0;
    }
    
    // Get monthly revenue
    public function getMonthlyRevenue($year, $month) {
        $stmt = $this->db->prepare("
            SELECT SUM(total_bayar) as total 
            FROM {$this->table} 
            WHERE status = 'selesai' 
            AND YEAR(waktu_keluar) = ? 
            AND MONTH(waktu_keluar) = ?
        ");
        $stmt->execute([$year, $month]);
        $result = $stmt->fetch();
        return $result['total'] ?? 0;
    }
    
    // Get revenue by vehicle type
    public function getRevenueByVehicleType($startDate = null, $endDate = null) {
        if ($startDate && $endDate) {
            $stmt = $this->db->prepare("
                SELECT 
                    k.jenis_kendaraan,
                    COUNT(*) as jumlah_transaksi,
                    SUM(t.total_bayar) as total_pendapatan
                FROM {$this->table} t
                JOIN kendaraan k ON t.kendaraan_id = k.id
                WHERE t.status = 'selesai'
                AND DATE(t.waktu_keluar) BETWEEN ? AND ?
                GROUP BY k.jenis_kendaraan
            ");
            $stmt->execute([$startDate, $endDate]);
        } else {
            $stmt = $this->db->query("
                SELECT 
                    k.jenis_kendaraan,
                    COUNT(*) as jumlah_transaksi,
                    SUM(t.total_bayar) as total_pendapatan
                FROM {$this->table} t
                JOIN kendaraan k ON t.kendaraan_id = k.id
                WHERE t.status = 'selesai'
                GROUP BY k.jenis_kendaraan
            ");
        }
        return $stmt->fetchAll();
    }
}
