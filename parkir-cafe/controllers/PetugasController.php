<?php

class PetugasController extends Controller {
    
    private $kendaraanModel;
    private $areaModel;
    private $tarifModel;
    private $transaksiModel;
    
    public function __construct() {
        $this->checkRole(['petugas']);
        $this->kendaraanModel = $this->model('KendaraanModel');
        $this->areaModel = $this->model('AreaModel');
        $this->tarifModel = $this->model('TarifModel');
        $this->transaksiModel = $this->model('TransaksiModel');
    }
    
    // Dashboard
    public function dashboard() {
        $data = [
            'title' => 'Petugas Dashboard',
            'active_sessions' => $this->transaksiModel->getActiveSessions(),
            'today_revenue' => $this->transaksiModel->getTodayRevenue(),
            'area_stats' => $this->areaModel->getAreaStats(),
            'flash' => $this->getFlash()
        ];
        
        $this->view('petugas/dashboard', $data);
    }
    
    // Vehicle Entry Form
    public function entry() {
        $data = [
            'title' => 'Kendaraan Masuk',
            'areas' => $this->areaModel->getActiveAreas(),
            'tarif' => $this->tarifModel->getActiveTarif(),
            'flash' => $this->getFlash()
        ];
        
        $this->view('petugas/entry', $data);
    }
    
    // Process Entry
    public function processEntry() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $noPolisi = strtoupper(trim($_POST['no_polisi']));
            $jenisKendaraan = $_POST['jenis_kendaraan'];
            $areaId = $_POST['area_parkir_id'];
            
            // Check area capacity
            if (!$this->areaModel->hasCapacity($areaId)) {
                $this->setFlash('error', 'Area parkir penuh');
                $this->redirect('/petugas/entry');
            }
            
            // Get or create vehicle
            $kendaraanData = [
                'no_polisi' => $noPolisi,
                'jenis_kendaraan' => $jenisKendaraan,
                'merk' => trim($_POST['merk']),
                'warna' => trim($_POST['warna']),
                'nama_pemilik' => trim($_POST['nama_pemilik']),
                'no_telp_pemilik' => trim($_POST['no_telp_pemilik'])
            ];
            
            $kendaraanId = $this->kendaraanModel->getOrCreate($kendaraanData);
            
            // Get tarif
            $tarif = $this->tarifModel->getByJenisKendaraan($jenisKendaraan);
            
            if (!$tarif) {
                $this->setFlash('error', 'Tarif untuk jenis kendaraan ini tidak ditemukan');
                $this->redirect('/petugas/entry');
            }
            
            // Create transaction
            $transaksiData = [
                'kendaraan_id' => $kendaraanId,
                'area_parkir_id' => $areaId,
                'petugas_masuk_id' => $_SESSION['user_id'],
                'tarif_id' => $tarif['id']
            ];
            
            if ($this->transaksiModel->createEntry($transaksiData)) {
                // Increment area occupancy
                $this->areaModel->incrementOccupancy($areaId);
                
                $kodeTicket = $this->transaksiModel->getById($this->transaksiModel->lastInsertId())['kode_tiket'];
                
                $this->setFlash('success', 'Kendaraan berhasil masuk. Kode Tiket: ' . $kodeTicket);
                $this->redirect('/petugas/dashboard');
            } else {
                $this->setFlash('error', 'Gagal mencatat kendaraan masuk');
                $this->redirect('/petugas/entry');
            }
        }
    }
    
    // Vehicle Exit Form
    public function exit() {
        $data = [
            'title' => 'Kendaraan Keluar',
            'flash' => $this->getFlash()
        ];
        
        $this->view('petugas/exit', $data);
    }
    
    // Search Ticket
    public function searchTicket() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $kodeTicket = strtoupper(trim($_POST['kode_tiket']));
            
            $transaksi = $this->transaksiModel->getByTicketCode($kodeTicket);
            
            if (!$transaksi) {
                $this->setFlash('error', 'Tiket tidak ditemukan');
                $this->redirect('/petugas/exit');
            }
            
            if ($transaksi['status'] != 'parkir') {
                $this->setFlash('error', 'Tiket sudah digunakan atau tidak valid');
                $this->redirect('/petugas/exit');
            }
            
            $data = [
                'title' => 'Proses Keluar',
                'transaksi' => $transaksi,
                'flash' => $this->getFlash()
            ];
            
            $this->view('petugas/process_exit', $data);
        } else {
            $this->redirect('/petugas/exit');
        }
    }
    
    // Process Exit
    public function processExit() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $transaksiId = $_POST['transaksi_id'];
            $areaId = $_POST['area_id'];
            
            if ($this->transaksiModel->processExit($transaksiId, $_SESSION['user_id'])) {
                // Decrement area occupancy
                $this->areaModel->decrementOccupancy($areaId);
                
                // Get updated transaction for receipt
                $transaksi = $this->transaksiModel->getById($transaksiId);
                
                $data = [
                    'title' => 'Struk Pembayaran',
                    'transaksi' => $this->transaksiModel->getByTicketCode($transaksi['kode_tiket'])
                ];
                
                $this->view('petugas/receipt', $data);
            } else {
                $this->setFlash('error', 'Gagal memproses keluar');
                $this->redirect('/petugas/exit');
            }
        }
    }
}
