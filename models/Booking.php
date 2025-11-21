<?php
class Booking {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // 1. Buat Booking Baru (DENGAN DEBUGGING AKTIF)
    public function create($user_id, $guest_name, $hotel_id, $room_id, $in, $out, $total_room, $total_addons, $grand_total, $method, $addons = []) {
        // Mulai Transaksi Database (Atomic)
        $this->conn->beginTransaction();
        
        try {
            // A. Insert Data Booking Utama
            $sql = "INSERT INTO bookings (
                        user_id, guest_name, hotel_id, room_type_id, 
                        check_in, check_out, 
                        total_price, total_addons, payment_method, 
                        status
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'PENDING')";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                $user_id, $guest_name, $hotel_id, $room_id, 
                $in, $out, 
                $grand_total, $total_addons, $method
            ]);
            
            $booking_id = $this->conn->lastInsertId();

            // B. Insert Add-ons yang dipilih (jika ada)
            if (!empty($addons)) {
                $sqlAddon = "INSERT INTO booking_addons (booking_id, name, price) VALUES (?, ?, ?)";
                $stmtAddon = $this->conn->prepare($sqlAddon);
                
                foreach ($addons as $ad) {
                    $stmtAddon->execute([$booking_id, $ad['name'], $ad['price']]);
                }
            }

            // Jika semua sukses, simpan permanen
            $this->conn->commit();
            return $booking_id;

        } catch (Exception $e) {
            // Jika ada error, batalkan semua perubahan
            $this->conn->rollBack();
            
            // --- DEBUG MODE: ON ---
            // Ini akan menampilkan error merah di layar browser
            echo "<div style='background-color: #ef4444; color: white; padding: 20px; font-family: sans-serif; border-radius: 8px; margin: 20px;'>";
            echo "<h2 style='margin-top:0;'>❌ DATABASE ERROR</h2>";
            echo "<p style='font-size: 18px; font-weight: bold;'>" . $e->getMessage() . "</p>";
            echo "<p>Silakan screenshot pesan ini dan perbaiki database Anda.</p>";
            echo "</div>";
            die(); // Matikan script agar error terlihat
            // ----------------------
        }
    }

    // 2. Ambil Detail Booking per ID (Termasuk Addons)
    public function getById($id) {
        $sql = "SELECT b.*, h.name as hotel_name, r.name as room_name 
                FROM bookings b 
                JOIN hotels h ON b.hotel_id = h.id 
                JOIN room_types r ON b.room_type_id = r.id 
                WHERE b.id = ?";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        $booking = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($booking) {
            $stmtA = $this->conn->prepare("SELECT * FROM booking_addons WHERE booking_id = ?");
            $stmtA->execute([$id]);
            $booking['addons'] = $stmtA->fetchAll(PDO::FETCH_ASSOC);
        }
        return $booking;
    }

    // 3. Ambil List Booking Milik User
    public function getUserBookings($user_id) {
        $sql = "SELECT b.*, h.name as hotel_name, h.thumbnail, r.name as room_name 
                FROM bookings b 
                JOIN hotels h ON b.hotel_id = h.id 
                JOIN room_types r ON b.room_type_id = r.id 
                WHERE b.user_id = ? 
                ORDER BY b.id DESC";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 4. Upload Bukti Bayar
    public function uploadProof($booking_id, $filename) {
        $stmt = $this->conn->prepare("UPDATE bookings SET payment_proof = ?, status = 'PAID' WHERE id = ?");
        return $stmt->execute([$filename, $booking_id]);
    }

    // 5. Ambil Semua Transaksi (Admin)
    public function getAllForAdmin() {
        $sql = "SELECT b.*, u.name as user_name, h.name as hotel_name 
                FROM bookings b 
                JOIN users u ON b.user_id = u.id 
                JOIN hotels h ON b.hotel_id = h.id 
                ORDER BY b.created_at DESC";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // 6. Konfirmasi Pembayaran (Admin)
    public function confirmBooking($booking_id) {
        $this->conn->beginTransaction();
        try {
            $stmt = $this->conn->prepare("UPDATE bookings SET status = 'CONFIRMED' WHERE id = ?");
            $stmt->execute([$booking_id]);

            $stmtB = $this->conn->prepare("SELECT * FROM bookings WHERE id = ?");
            $stmtB->execute([$booking_id]);
            $booking = $stmtB->fetch(PDO::FETCH_ASSOC);

            $stmtH = $this->conn->prepare("SELECT owner_id FROM hotels WHERE id = ?");
            $stmtH->execute([$booking['hotel_id']]);
            $hotel = $stmtH->fetch(PDO::FETCH_ASSOC);
            
            // Total yang masuk ke escrow (Harga kamar + Addons)
            // Asumsi total_price di DB adalah Grand Total
            $amount = $booking['total_price']; 
            
            $stmtE = $this->conn->prepare("INSERT INTO escrow_ledger (booking_id, owner_id, amount, status) VALUES (?, ?, ?, 'HELD')");
            $stmtE->execute([$booking_id, $hotel['owner_id'], $amount]);

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    // 7. Hapus Booking (Hanya PENDING)
    public function delete($id) {
        try {
            // Hapus addons dulu (relasi)
            $stmtAddon = $this->conn->prepare("DELETE FROM booking_addons WHERE booking_id = ?");
            $stmtAddon->execute([$id]);

            // Hapus booking utama
            $stmt = $this->conn->prepare("DELETE FROM bookings WHERE id = ? AND status = 'PENDING'");
            return $stmt->execute([$id]);
        } catch (Exception $e) {
            return false;
        }
    }

    public function updateStatus($id, $status) {
        $stmt = $this->conn->prepare("UPDATE bookings SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }
}
?>