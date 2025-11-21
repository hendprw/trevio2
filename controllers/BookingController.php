<?php
require_once __DIR__ . '/../models/Booking.php';
require_once __DIR__ . '/../models/Hotel.php';
require_once __DIR__ . '/../helpers/whatsapp_sender.php'; // WA Sender Helper

class BookingController {
    private $bookingModel;
    private $hotelModel;

    public function __construct($db) {
        // Middleware: Pastikan User Login
        if (!isset($_SESSION['user'])) {
            header("Location: /login"); 
            exit;
        }
        
        $this->bookingModel = new Booking($db);
        $this->hotelModel = new Hotel($db);
    }

    // 1. Halaman Checkout (Review Pesanan)
    public function checkout() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hotel_id = $_POST['hotel_id'];
            $room_id = $_POST['room_type_id'];
            $checkIn = $_POST['check_in'];
            $checkOut = $_POST['check_out'];

            // Ambil data Hotel & Addons
            $hotel = $this->hotelModel->getById($hotel_id);
            $addons = $this->hotelModel->getAddons($hotel_id);
            
            // Cari data kamar yang dipilih
            $selectedRoom = null;
            if(isset($hotel['rooms'])) {
                foreach($hotel['rooms'] as $r) {
                    if($r['id'] == $room_id) {
                        $selectedRoom = $r;
                        break;
                    }
                }
            }

            if (!$hotel || !$selectedRoom) {
                echo "<script>alert('Data kamar tidak valid.'); window.location='/';</script>";
                return;
            }
            
            require __DIR__ . '/../views/booking/checkout.php';
        } else {
            header("Location: /");
        }
    }

    // 2. Proses Simpan Booking (Action dari Form Checkout)
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // A. Hitung Durasi & Total Harga Kamar
            $checkIn = strtotime($_POST['check_in']);
            $checkOut = strtotime($_POST['check_out']);
            $diff = $checkOut - $checkIn;
            $days = round($diff / (60 * 60 * 24));
            if ($days < 1) $days = 1;

            $roomPrice = $_POST['room_price'];
            $totalRoom = $days * $roomPrice;

            // B. Hitung Total Add-ons
            $addonTotal = 0;
            $selectedAddons = [];
            if (isset($_POST['addons'])) {
                foreach ($_POST['addons'] as $adStr) {
                    $parts = explode('|', $adStr);
                    if(count($parts) == 2) {
                        $name = $parts[0];
                        $price = (float)$parts[1];
                        
                        $addonTotal += $price;
                        $selectedAddons[] = [
                            'name' => $name,
                            'price' => $price
                        ];
                    }
                }
            }
            $grandTotal = $totalRoom + $addonTotal;

            // C. Simpan ke Database
            $booking_id = $this->bookingModel->create(
                $_SESSION['user']['id'],
                $_POST['guest_name'],
                $_POST['hotel_id'],
                $_POST['room_type_id'],
                $_POST['check_in'],
                $_POST['check_out'],
                $totalRoom,
                $addonTotal,
                $grandTotal,
                $_POST['payment_method'],
                $selectedAddons
            );

            if ($booking_id) {
                // D. Kirim Notifikasi WA ke Owner (Booking Baru - Menunggu Pembayaran)
                $booking = $this->bookingModel->getById($booking_id);
                $hotel = $this->hotelModel->getById($booking['hotel_id']);
                
                // ASUMSI: Nomor WA Owner disimpan di database atau disimulasikan
                $ownerPhoneNumber = "83139682650"; // <-- GANTI NOMOR INI
                
                $wa_message = "✅ PESANAN BARU MASUK (PENDING)!\n\n"
                            . "Hotel: " . htmlspecialchars($hotel['name']) . "\n"
                            . "Kamar: " . htmlspecialchars($booking['room_name']) . "\n"
                            . "Check In: " . date('d M Y', strtotime($booking['check_in'])) . "\n"
                            . "Total Bayar: Rp " . number_format($grandTotal) . "\n"
                            . "Status: MENUNGGU PEMBAYARAN USER\n";
                
                sendWhatsAppNotification($ownerPhoneNumber, $wa_message);

                // E. Redirect ke halaman instruksi pembayaran
                header("Location: /booking/payment?id=" . $booking_id);
            } else {
                echo "<script>alert('Gagal memproses pesanan. Silakan coba lagi.'); window.history.back();</script>";
            }
        }
    }

    // 3. Halaman Instruksi Pembayaran
    public function payment() {
        if (!isset($_GET['id'])) { header("Location: /my-bookings"); exit; }

        $bookingId = $_GET['id'];
        $booking = $this->bookingModel->getById($bookingId);

        if (!$booking || $booking['user_id'] != $_SESSION['user']['id']) {
            echo "Akses Ditolak.";
            exit;
        }

        require __DIR__ . '/../views/booking/payment.php';
    }

    // 4. List Booking User (My Bookings)
    public function index() {
        $bookings = $this->bookingModel->getUserBookings($_SESSION['user']['id']);
        require __DIR__ . '/../views/home/my_bookings.php';
    }

    // 5. Upload Bukti Pembayaran
// 5. Upload Bukti Pembayaran (Trigger WA ke Admin)
    public function uploadProof() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['proof'])) {
            $bookingId = $_POST['booking_id'];

            if ($_FILES['proof']['error'] === 0) {
                $extension = pathinfo($_FILES['proof']['name'], PATHINFO_EXTENSION);
                $filename = "proof_" . time() . "_" . $bookingId . "." . $extension;
                $target = __DIR__ . "/../public/uploads/" . $filename;
                $dbPath = "uploads/" . $filename;

                if (move_uploaded_file($_FILES['proof']['tmp_name'], $target)) {
                    if ($this->bookingModel->uploadProof($bookingId, $dbPath)) {
                        
                        // --- WA NOTIFICATION TO ADMIN ---
                        
                        // 1. Ambil Admin User (Asumsi Admin ID = 1)
                        $adminUser = (new User($this->conn))->getById(1); 
                        $adminPhoneNumber = $adminUser['phone_number'] ?? "81211122233"; 
                        
                        // 2. Build Link & Image URL (KRITIS: Host harus publik agar Fonnte bisa akses)
                        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
                        $host = $_SERVER['HTTP_HOST'] ?? 'localhost:8000'; 
                        $proofUrl = "{$protocol}://{$host}/" . $dbPath; 
                        
                        // 3. Buat Simple Security Token
                        $token = md5($bookingId . 'TREVIO_WA_SECRET'); 
                        
                        // 4. Construct Confirmation Links
                        $confirmLink = "{$protocol}://{$host}/booking/wa-confirm?id={$bookingId}&token={$token}&action=confirm";
                        $cancelLink = "{$protocol}://{$host}/booking/wa-confirm?id={$bookingId}&token={$token}&action=cancel";
                        
                        $wa_message = "🔔 VERIFIKASI PEMBAYARAN BARU 🔔\n\n"
                                    . "Booking ID: #TRV{$bookingId}\n"
                                    . "Status: BUKTI DIUNGGAH (PAID).\n\n"
                                    . "Aksi Cepat:\n"
                                    . "✅ Konfirmasi: " . $confirmLink . "\n"
                                    . "❌ Batalkan: " . $cancelLink . "\n"
                                    . "Cek bukti di gambar terlampir.";

                        sendWhatsAppNotification($adminPhoneNumber, $wa_message, $proofUrl, "Bukti_TRV{$bookingId}.jpg");

                        // -------------------------------------

                        echo "<script>alert('Bukti pembayaran berhasil diunggah! Menunggu konfirmasi admin via WhatsApp.'); window.location='/my-bookings';</script>";
                        return;
                    }
                }
            }
            
            echo "<script>alert('Gagal mengunggah bukti pembayaran.'); window.history.back();</script>";
        }
    }
    
    // 6. Batalkan Pesanan (Hanya PENDING)
    public function cancel() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bookingId = $_POST['booking_id'];
            $userId = $_SESSION['user']['id'];

            $booking = $this->bookingModel->getById($bookingId);

            if ($booking && $booking['user_id'] == $userId && $booking['status'] == 'PENDING') {
                if($this->bookingModel->delete($bookingId)) {
                    echo "<script>alert('Pesanan berhasil dibatalkan.'); window.location='/my-bookings';</script>";
                } else {
                    echo "<script>alert('Gagal membatalkan pesanan.'); window.location='/my-bookings';</script>";
                }
            } else {
                echo "<script>alert('Akses ditolak atau pesanan tidak dapat dibatalkan.'); window.location='/my-bookings';</script>";
            }
        }
    }
}
?>