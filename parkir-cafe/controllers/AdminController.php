<?php

class AdminController extends Controller {
    
    private $userModel;
    private $tarifModel;
    private $areaModel;
    private $kendaraanModel;
    private $transaksiModel;
    
    public function __construct() {
        $this->checkRole(['admin']);
        $this->userModel = $this->model('UserModel');
        $this->tarifModel = $this->model('TarifModel');
        $this->areaModel = $this->model('AreaModel');
        $this->kendaraanModel = $this->model('KendaraanModel');
        $this->transaksiModel = $this->model('TransaksiModel');
    }
    
    // Dashboard
    public function dashboard() {
        $data = [
            'title' => 'Admin Dashboard',
            'total_users' => $this->userModel->getTotalUsers(),
            'total_vehicles' => $this->kendaraanModel->getTotalVehicles(),
            'total_capacity' => $this->areaModel->getTotalCapacity(),
            'total_occupied' => $this->areaModel->getTotalOccupied(),
            'today_revenue' => $this->transaksiModel->getTodayRevenue(),
            'active_sessions' => count($this->transaksiModel->getActiveSessions()),
            'area_stats' => $this->areaModel->getAreaStats(),
            'recent_transactions' => $this->transaksiModel->getCompletedTransactions(10),
            'flash' => $this->getFlash()
        ];
        
        $this->view('admin/dashboard', $data);
    }
    
    // ==================== USER CRUD ====================
    
    public function users() {
        $data = [
            'title' => 'Kelola User',
            'users' => $this->userModel->getAll(),
            'flash' => $this->getFlash()
        ];
        
        $this->view('admin/users/index', $data);
    }
    
    public function createUser() {
        $data = [
            'title' => 'Tambah User'
        ];
        
        $this->view('admin/users/create', $data);
    }
    
    public function storeUser() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validate
            if ($this->userModel->usernameExists($_POST['username'])) {
                $this->setFlash('error', 'Username sudah digunakan');
                $this->redirect('/admin/createUser');
            }
            
            $userData = [
                'username' => trim($_POST['username']),
                'password' => $_POST['password'],
                'nama_lengkap' => trim($_POST['nama_lengkap']),
                'role' => $_POST['role'],
                'email' => trim($_POST['email']),
                'no_telp' => trim($_POST['no_telp']),
                'status' => $_POST['status']
            ];
            
            if ($this->userModel->createUser($userData)) {
                $this->setFlash('success', 'User berhasil ditambahkan');
                $this->redirect('/admin/users');
            } else {
                $this->setFlash('error', 'Gagal menambahkan user');
                $this->redirect('/admin/createUser');
            }
        }
    }
    
    public function editUser($id) {
        $data = [
            'title' => 'Edit User',
            'user' => $this->userModel->getById($id)
        ];
        
        if (!$data['user']) {
            $this->setFlash('error', 'User tidak ditemukan');
            $this->redirect('/admin/users');
        }
        
        $this->view('admin/users/edit', $data);
    }
    
    public function updateUser($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validate
            if ($this->userModel->usernameExists($_POST['username'], $id)) {
                $this->setFlash('error', 'Username sudah digunakan');
                $this->redirect('/admin/editUser/' . $id);
            }
            
            $userData = [
                'username' => trim($_POST['username']),
                'nama_lengkap' => trim($_POST['nama_lengkap']),
                'role' => $_POST['role'],
                'email' => trim($_POST['email']),
                'no_telp' => trim($_POST['no_telp']),
                'status' => $_POST['status']
            ];
            
            // Only update password if provided
            if (!empty($_POST['password'])) {
                $userData['password'] = $_POST['password'];
            }
            
            if ($this->userModel->updateUser($id, $userData)) {
                $this->setFlash('success', 'User berhasil diupdate');
                $this->redirect('/admin/users');
            } else {
                $this->setFlash('error', 'Gagal mengupdate user');
                $this->redirect('/admin/editUser/' . $id);
            }
        }
    }
    
    public function deleteUser($id) {
        // Prevent deleting own account
        if ($id == $_SESSION['user_id']) {
            $this->setFlash('error', 'Tidak dapat menghapus akun sendiri');
            $this->redirect('/admin/users');
        }
        
        if ($this->userModel->delete($id)) {
            $this->setFlash('success', 'User berhasil dihapus');
        } else {
            $this->setFlash('error', 'Gagal menghapus user');
        }
        
        $this->redirect('/admin/users');
    }
    
    // ==================== TARIF CRUD ====================
    
    public function tarif() {
        $data = [
            'title' => 'Kelola Tarif Parkir',
            'tarif' => $this->tarifModel->getAll(),
            'flash' => $this->getFlash()
        ];
        
        $this->view('admin/tarif/index', $data);
    }
    
    public function createTarif() {
        $data = [
            'title' => 'Tambah Tarif Parkir'
        ];
        
        $this->view('admin/tarif/create', $data);
    }
    
    public function storeTarif() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tarifData = [
                'jenis_kendaraan' => $_POST['jenis_kendaraan'],
                'tarif_per_jam' => $_POST['tarif_per_jam'],
                'tarif_harian' => $_POST['tarif_harian'],
                'denda_kehilangan' => $_POST['denda_kehilangan'],
                'keterangan' => trim($_POST['keterangan']),
                'status' => $_POST['status']
            ];
            
            if ($this->tarifModel->insert($tarifData)) {
                $this->setFlash('success', 'Tarif parkir berhasil ditambahkan');
                $this->redirect('/admin/tarif');
            } else {
                $this->setFlash('error', 'Gagal menambahkan tarif parkir');
                $this->redirect('/admin/createTarif');
            }
        }
    }
    
    public function editTarif($id) {
        $data = [
            'title' => 'Edit Tarif Parkir',
            'tarif' => $this->tarifModel->getById($id)
        ];
        
        if (!$data['tarif']) {
            $this->setFlash('error', 'Tarif tidak ditemukan');
            $this->redirect('/admin/tarif');
        }
        
        $this->view('admin/tarif/edit', $data);
    }
    
    public function updateTarif($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tarifData = [
                'jenis_kendaraan' => $_POST['jenis_kendaraan'],
                'tarif_per_jam' => $_POST['tarif_per_jam'],
                'tarif_harian' => $_POST['tarif_harian'],
                'denda_kehilangan' => $_POST['denda_kehilangan'],
                'keterangan' => trim($_POST['keterangan']),
                'status' => $_POST['status']
            ];
            
            if ($this->tarifModel->update($id, $tarifData)) {
                $this->setFlash('success', 'Tarif parkir berhasil diupdate');
                $this->redirect('/admin/tarif');
            } else {
                $this->setFlash('error', 'Gagal mengupdate tarif parkir');
                $this->redirect('/admin/editTarif/' . $id);
            }
        }
    }
    
    public function deleteTarif($id) {
        if ($this->tarifModel->delete($id)) {
            $this->setFlash('success', 'Tarif parkir berhasil dihapus');
        } else {
            $this->setFlash('error', 'Gagal menghapus tarif parkir');
        }
        
        $this->redirect('/admin/tarif');
    }
    
    // ==================== AREA CRUD ====================
    
    public function area() {
        $data = [
            'title' => 'Kelola Area Parkir',
            'areas' => $this->areaModel->getAll(),
            'flash' => $this->getFlash()
        ];
        
        $this->view('admin/area/index', $data);
    }
    
    public function createArea() {
        $data = [
            'title' => 'Tambah Area Parkir'
        ];
        
        $this->view('admin/area/create', $data);
    }
    
    public function storeArea() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $areaData = [
                'nama_area' => trim($_POST['nama_area']),
                'kode_area' => strtoupper(trim($_POST['kode_area'])),
                'kapasitas' => $_POST['kapasitas'],
                'jenis_kendaraan' => $_POST['jenis_kendaraan'],
                'lokasi' => trim($_POST['lokasi']),
                'status' => $_POST['status']
            ];
            
            if ($this->areaModel->insert($areaData)) {
                $this->setFlash('success', 'Area parkir berhasil ditambahkan');
                $this->redirect('/admin/area');
            } else {
                $this->setFlash('error', 'Gagal menambahkan area parkir');
                $this->redirect('/admin/createArea');
            }
        }
    }
    
    public function editArea($id) {
        $data = [
            'title' => 'Edit Area Parkir',
            'area' => $this->areaModel->getById($id)
        ];
        
        if (!$data['area']) {
            $this->setFlash('error', 'Area tidak ditemukan');
            $this->redirect('/admin/area');
        }
        
        $this->view('admin/area/edit', $data);
    }
    
    public function updateArea($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $areaData = [
                'nama_area' => trim($_POST['nama_area']),
                'kode_area' => strtoupper(trim($_POST['kode_area'])),
                'kapasitas' => $_POST['kapasitas'],
                'jenis_kendaraan' => $_POST['jenis_kendaraan'],
                'lokasi' => trim($_POST['lokasi']),
                'status' => $_POST['status']
            ];
            
            if ($this->areaModel->update($id, $areaData)) {
                $this->setFlash('success', 'Area parkir berhasil diupdate');
                $this->redirect('/admin/area');
            } else {
                $this->setFlash('error', 'Gagal mengupdate area parkir');
                $this->redirect('/admin/editArea/' . $id);
            }
        }
    }
    
    public function deleteArea($id) {
        if ($this->areaModel->delete($id)) {
            $this->setFlash('success', 'Area parkir berhasil dihapus');
        } else {
            $this->setFlash('error', 'Gagal menghapus area parkir');
        }
        
        $this->redirect('/admin/area');
    }
    
    // ==================== KENDARAAN CRUD ====================
    
    public function kendaraan() {
        $data = [
            'title' => 'Kelola Kendaraan',
            'kendaraan' => $this->kendaraanModel->getAll(),
            'flash' => $this->getFlash()
        ];
        
        $this->view('admin/kendaraan/index', $data);
    }
    
    public function createKendaraan() {
        $data = [
            'title' => 'Tambah Kendaraan'
        ];
        
        $this->view('admin/kendaraan/create', $data);
    }
    
    public function storeKendaraan() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $kendaraanData = [
                'no_polisi' => strtoupper(trim($_POST['no_polisi'])),
                'jenis_kendaraan' => $_POST['jenis_kendaraan'],
                'merk' => trim($_POST['merk']),
                'warna' => trim($_POST['warna']),
                'nama_pemilik' => trim($_POST['nama_pemilik']),
                'no_telp_pemilik' => trim($_POST['no_telp_pemilik'])
            ];
            
            if ($this->kendaraanModel->insert($kendaraanData)) {
                $this->setFlash('success', 'Kendaraan berhasil ditambahkan');
                $this->redirect('/admin/kendaraan');
            } else {
                $this->setFlash('error', 'Gagal menambahkan kendaraan');
                $this->redirect('/admin/createKendaraan');
            }
        }
    }
    
    public function editKendaraan($id) {
        $data = [
            'title' => 'Edit Kendaraan',
            'kendaraan' => $this->kendaraanModel->getById($id)
        ];
        
        if (!$data['kendaraan']) {
            $this->setFlash('error', 'Kendaraan tidak ditemukan');
            $this->redirect('/admin/kendaraan');
        }
        
        $this->view('admin/kendaraan/edit', $data);
    }
    
    public function updateKendaraan($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $kendaraanData = [
                'no_polisi' => strtoupper(trim($_POST['no_polisi'])),
                'jenis_kendaraan' => $_POST['jenis_kendaraan'],
                'merk' => trim($_POST['merk']),
                'warna' => trim($_POST['warna']),
                'nama_pemilik' => trim($_POST['nama_pemilik']),
                'no_telp_pemilik' => trim($_POST['no_telp_pemilik'])
            ];
            
            if ($this->kendaraanModel->update($id, $kendaraanData)) {
                $this->setFlash('success', 'Kendaraan berhasil diupdate');
                $this->redirect('/admin/kendaraan');
            } else {
                $this->setFlash('error', 'Gagal mengupdate kendaraan');
                $this->redirect('/admin/editKendaraan/' . $id);
            }
        }
    }
    
    public function deleteKendaraan($id) {
        if ($this->kendaraanModel->delete($id)) {
            $this->setFlash('success', 'Kendaraan berhasil dihapus');
        } else {
            $this->setFlash('error', 'Gagal menghapus kendaraan');
        }
        
        $this->redirect('/admin/kendaraan');
    }
    
    // ==================== ACTIVITY LOG ====================
    
    public function activityLog() {
        $data = [
            'title' => 'Log Aktivitas',
            'transactions' => $this->transaksiModel->getCompletedTransactions(50),
            'flash' => $this->getFlash()
        ];
        
        $this->view('admin/activity_log', $data);
    }
}
