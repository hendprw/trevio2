<?php
require_once __DIR__ . '/../models/Booking.php';
require_once __DIR__ . '/../models/Escrow.php';
require_once __DIR__ . '/../models/User.php'; // Digunakan untuk ambil nomor WA Owner
require_once __DIR__ . '/../helpers/whatsapp_sender.php'; // WA Helper

class AdminController {
    private $bookingModel;
    private $escrowModel;
    private $userModel;
    private $conn;

    public function __construct($db) {
        // Middleware Sederhana: Cek Login & Role
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header("Location: /login"); 
            exit;
        }
        
        $this->conn = $db;
        $this->bookingModel = new Booking($db);
        $this->escrowModel = new Escrow($db);
        $this->userModel = new User($db); // Inisialisasi Model User
    }

    // 1. Dashboard Utama
    public function dashboard() {
        $bookings = $this->bookingModel->getAllForAdmin();
        $escrows = $this->escrowModel->getBalances();
        require __DIR__ . '/../views/admin/dashboard.php';
    }

    // 2. Konfirmasi Pembayaran (dari PAID ke CONFIRMED & Escrow HELD)
    public function confirmPayment($id) {
        // Ambil data booking sebelum konfirmasi
        $booking = $this->bookingModel->getById($id);

        if($this->bookingModel->confirmBooking($id)) {
            
            // A. Ambil data Owner untuk notifikasi WA
            $stmtH = $this->conn->prepare("SELECT owner_id FROM hotels WHERE id = ?");
            $stmtH->execute([$booking['hotel_id']]);
            $hotelData = $stmtH->fetch(PDO::FETCH_ASSOC);
            $ownerId = $hotelData['owner_id'];
            
            $ownerUser = $this->userModel->getById($ownerId);
            
            // Nomor WA Owner (Ambil dari DB, Fallback ke simulasi)
            $ownerPhoneNumber = $ownerUser['phone_number'] ?? "81211122233"; 
            
            // B. Buat URL Publik untuk Bukti Pembayaran (KRITIS: Harus bisa diakses Fonnte)
            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
            $host = $_SERVER['HTTP_HOST'] ?? 'localhost:8000'; 
            $proofUrl = "{$protocol}://{$host}/" . $booking['payment_proof']; 

            // C. Kirim Notifikasi WA ke Owner
            $wa_message = "💰 PEMBAYARAN DIKONFIRMASI! 💰\n\n"
                        . "Booking ID: #TRV-" . $booking['id'] . "\n"
                        . "Hotel: " . htmlspecialchars($booking['hotel_name']) . "\n"
                        . "Total: Rp " . number_format($booking['total_price']) . "\n\n"
                        . "Status: LUNAS & DANA DITAHAN DI ESCROW. Booking telah dikonfirmasi.";
            
            sendWhatsAppNotification(
                $ownerPhoneNumber, 
                $wa_message, 
                $proofUrl, // URL Gambar
                "Bukti_TRV" . $booking['id'] . ".jpg"
            );

            header("Location: /admin/dashboard");
        } else {
            echo "Error confirming booking.";
        }
    }

    // 3. Pelepasan Dana Escrow (HELD ke RELEASED)
    public function releaseFund($id) {
        if($this->escrowModel->releaseFunds($id)) {
            // Opsional: Tambahkan logika notifikasi WA ke Owner (Dana Cair)
            header("Location: /admin/dashboard");
        } else {
            echo "Error releasing funds.";
        }
    }

    // 4. Handler Link WA (Verifikasi Cepat)
    public function waConfirm() {
        $bookingId = $_GET['id'] ?? null;
        $token = $_GET['token'] ?? null;
        $action = $_GET['action'] ?? null;
        
        if (!$bookingId || !$token || !$action) {
            die("<div style='padding:20px; text-align:center;'>Permintaan tidak valid atau link rusak.</div>");
        }

        $booking = $this->bookingModel->getById($bookingId);
        
        // Security Check: Cek Token
        $expectedToken = md5($bookingId . 'TREVIO_WA_SECRET');
        if ($token !== $expectedToken) {
            die("<div style='padding:20px; text-align:center;'>Token keamanan tidak valid.</div>");
        }

        if ($action == 'confirm') {
            // Re-use existing confirmation logic (handles status change and escrow entry)
            if ($this->confirmPayment($bookingId)) {
                 echo "<div style='padding:20px; text-align:center; background: #dcfce7;'>✅ Booking #TRV{$bookingId} BERHASIL DIKONFIRMASI! Dana masuk Escrow.</div>";
            } else {
                 echo "<div style='padding:20px; text-align:center; background: #fee2e2;'>❌ Gagal Konfirmasi. Booking mungkin sudah diproses.</div>";
            }
        } elseif ($action == 'cancel') {
            // Update status ke CANCELLED
            $this->bookingModel->updateStatus($bookingId, 'CANCELLED'); 
            echo "<div style='padding:20px; text-align:center; background: #fef3c7;'>🟡 Booking #TRV{$bookingId} BERHASIL DIBATALKAN.</div>";
        } else {
            die("Invalid Action.");
        }
        exit;
    }
}
?>