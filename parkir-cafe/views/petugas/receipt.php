<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran Parkir - <?= $transaksi['kode_tiket'] ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Courier New', monospace;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        
        .receipt-container {
            background: white;
            max-width: 400px;
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        
        .receipt {
            padding: 30px 25px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 3px double #333;
        }
        
        .header h1 {
            font-size: 28px;
            margin-bottom: 5px;
            letter-spacing: 2px;
        }
        
        .header .subtitle {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }
        
        .ticket-code {
            background: #f0f0f0;
            padding: 15px;
            text-align: center;
            margin: 20px 0;
            border-radius: 8px;
            border: 2px dashed #333;
        }
        
        .ticket-code .label {
            font-size: 11px;
            color: #666;
            margin-bottom: 5px;
        }
        
        .ticket-code .code {
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 2px;
            font-family: 'Courier New', monospace;
        }
        
        .barcode {
            text-align: center;
            margin: 10px 0;
        }
        
        .barcode-lines {
            display: flex;
            justify-content: center;
            gap: 2px;
            margin-bottom: 5px;
        }
        
        .barcode-line {
            width: 3px;
            height: 40px;
            background: #000;
        }
        
        .barcode-line.thick {
            width: 5px;
        }
        
        .section {
            margin: 20px 0;
            padding: 15px 0;
            border-top: 1px dashed #999;
        }
        
        .row {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;
            font-size: 14px;
        }
        
        .row .label {
            color: #666;
        }
        
        .row .value {
            font-weight: bold;
            text-align: right;
        }
        
        .highlight-box {
            background: #fff9e6;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
            border-left: 4px solid #f59e0b;
        }
        
        .total-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            margin: 20px -25px;
            text-align: center;
        }
        
        .total-section .label {
            font-size: 14px;
            margin-bottom: 5px;
            opacity: 0.9;
        }
        
        .total-section .amount {
            font-size: 32px;
            font-weight: bold;
            letter-spacing: 1px;
        }
        
        .footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px dashed #999;
            color: #666;
            font-size: 12px;
        }
        
        .footer p {
            margin: 5px 0;
        }
        
        .actions {
            padding: 20px;
            background: #f9fafb;
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }
        
        .btn-print {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }
        
        .btn-print:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
        }
        
        .btn-back {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }
        
        @media print {
            body {
                background: white;
                padding: 0;
            }
            
            .receipt-container {
                box-shadow: none;
                border-radius: 0;
            }
            
            .actions {
                display: none;
            }
            
            .total-section {
                background: #333 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <div class="receipt">
            <div class="header">
                <h1>🅿️ PARKIR CAFE</h1>
                <div class="subtitle">Struk Pembayaran Parkir</div>
                <div style="font-size: 11px; color: #999;">Jl. Contoh No. 123, Jakarta</div>
            </div>
            
            <div class="ticket-code">
                <div class="label">KODE TIKET</div>
                <div class="code"><?= $transaksi['kode_tiket'] ?></div>
            </div>
            
            <div class="barcode">
                <div class="barcode-lines">
                    <div class="barcode-line"></div>
                    <div class="barcode-line thick"></div>
                    <div class="barcode-line"></div>
                    <div class="barcode-line"></div>
                    <div class="barcode-line thick"></div>
                    <div class="barcode-line"></div>
                    <div class="barcode-line thick"></div>
                    <div class="barcode-line"></div>
                    <div class="barcode-line"></div>
                    <div class="barcode-line thick"></div>
                    <div class="barcode-line"></div>
                    <div class="barcode-line"></div>
                    <div class="barcode-line thick"></div>
                    <div class="barcode-line"></div>
                    <div class="barcode-line thick"></div>
                </div>
            </div>
            
            <div class="section">
                <div class="row">
                    <span class="label">No. Polisi:</span>
                    <span class="value"><?= $transaksi['no_polisi'] ?></span>
                </div>
                <div class="row">
                    <span class="label">Jenis Kendaraan:</span>
                    <span class="value"><?= ucfirst($transaksi['jenis_kendaraan']) ?></span>
                </div>
                <div class="row">
                    <span class="label">Merk / Warna:</span>
                    <span class="value"><?= $transaksi['merk'] ?> / <?= $transaksi['warna'] ?></span>
                </div>
                <div class="row">
                    <span class="label">Area Parkir:</span>
                    <span class="value"><?= $transaksi['nama_area'] ?></span>
                </div>
            </div>
            
            <div class="highlight-box">
                <div class="row">
                    <span class="label">⏰ Waktu Masuk:</span>
                    <span class="value"><?= date('d/m/Y H:i', strtotime($transaksi['waktu_masuk'])) ?></span>
                </div>
                <div class="row">
                    <span class="label">⏰ Waktu Keluar:</span>
                    <span class="value"><?= date('d/m/Y H:i', strtotime($transaksi['waktu_keluar'])) ?></span>
                </div>
                <div class="row">
                    <span class="label">⏱️ Durasi Parkir:</span>
                    <span class="value"><?= number_format($transaksi['durasi_jam'], 2) ?> Jam</span>
                </div>
            </div>
        </div>
        
        <div class="total-section">
            <div class="label">TOTAL PEMBAYARAN</div>
            <div class="amount">Rp <?= number_format($transaksi['total_bayar'], 0, ',', '.') ?></div>
        </div>
        
        <div class="receipt">
            <div class="footer">
                <p><strong>Terima kasih atas kunjungan Anda</strong></p>
                <p>Dicetak: <?= date('d/m/Y H:i:s') ?></p>
                <p style="margin-top: 10px; font-size: 10px;">Simpan struk ini sebagai bukti pembayaran</p>
            </div>
        </div>
        
        <div class="actions">
            <button onclick="window.print()" class="btn btn-print">
                🖨️ Cetak Struk
            </button>
            <a href="<?= BASE_URL ?>petugas/dashboard" class="btn btn-back">
                ← Kembali ke Dashboard
            </a>
        </div>
    </div>
    
    <script>
        // Auto focus on print button
        document.addEventListener('DOMContentLoaded', function() {
            // Optional: Auto print dialog
            // setTimeout(() => window.print(), 500);
        });
    </script>
</body>
</html>
