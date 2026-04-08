<?php

class OwnerController extends Controller {
    
    private $transaksiModel;
    private $areaModel;
    private $kendaraanModel;
    
    public function __construct() {
        $this->checkRole(['owner']);
        $this->transaksiModel = $this->model('TransaksiModel');
        $this->areaModel = $this->model('AreaModel');
        $this->kendaraanModel = $this->model('KendaraanModel');
    }
    
    // Dashboard
    public function dashboard() {
        $today = date('Y-m-d');
        $thisMonth = date('m');
        $thisYear = date('Y');
        
        $data = [
            'title' => 'Owner Dashboard',
            'today_revenue' => $this->transaksiModel->getTodayRevenue(),
            'monthly_revenue' => $this->transaksiModel->getMonthlyRevenue($thisYear, $thisMonth),
            'revenue_stats' => $this->transaksiModel->getRevenueStats(),
            'revenue_by_type' => $this->transaksiModel->getRevenueByVehicleType(),
            'area_stats' => $this->areaModel->getAreaStats(),
            'active_sessions' => count($this->transaksiModel->getActiveSessions()),
            'flash' => $this->getFlash()
        ];
        
        $this->view('owner/dashboard', $data);
    }
    
    // Reports
    public function reports() {
        $startDate = $_GET['start_date'] ?? date('Y-m-01');
        $endDate = $_GET['end_date'] ?? date('Y-m-d');
        
        $data = [
            'title' => 'Laporan Transaksi',
            'start_date' => $startDate,
            'end_date' => $endDate,
            'transactions' => $this->transaksiModel->getByDateRange($startDate, $endDate),
            'revenue_stats' => $this->transaksiModel->getRevenueStats($startDate, $endDate),
            'revenue_by_type' => $this->transaksiModel->getRevenueByVehicleType($startDate, $endDate),
            'flash' => $this->getFlash()
        ];
        
        $this->view('owner/reports', $data);
    }
}
