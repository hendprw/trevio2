<?php
class Hotel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // ---------------------------------------------------------
    // BAGIAN CREATE / UPDATE / DELETE UTAMA
    // ---------------------------------------------------------

    // 1. Buat Hotel Baru (Return ID)
    public function create($owner_id, $name, $city, $address, $desc, $thumb) {
        $sql = "INSERT INTO hotels (owner_id, name, city, address, description, thumbnail) VALUES (?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        if($stmt->execute([$owner_id, $name, $city, $address, $desc, $thumb])) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    // 2. Update Data Hotel
    public function update($id, $name, $city, $address, $desc, $thumb = null) {
        if ($thumb) {
            $sql = "UPDATE hotels SET name=?, city=?, address=?, description=?, thumbnail=? WHERE id=?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$name, $city, $address, $desc, $thumb, $id]);
        } else {
            $sql = "UPDATE hotels SET name=?, city=?, address=?, description=? WHERE id=?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$name, $city, $address, $desc, $id]);
        }
    }

    // 3. Hapus Hotel (FIX: Mengatasi Foreign Key Constraint pada Bookings)
    public function delete($id) {
        $this->conn->beginTransaction();
        try {
            // A. Dapatkan semua ID Kamar milik hotel ini
            $stmtRooms = $this->conn->prepare("SELECT id FROM room_types WHERE hotel_id = ?");
            $stmtRooms->execute([$id]);
            $roomIds = $stmtRooms->fetchAll(PDO::FETCH_COLUMN);
            
            if (!empty($roomIds)) {
                $inClause = implode(',', array_fill(0, count($roomIds), '?'));

                // B. Hapus semua Bookings yang terkait dengan kamar-kamar hotel ini
                $stmtBookings = $this->conn->prepare("DELETE FROM bookings WHERE room_type_id IN ({$inClause})");
                $stmtBookings->execute($roomIds);
            }
            
            // C. Hapus hotel utama (CASCADE akan menghapus room_types, hotel_gallery, hotel_facilities)
            $stmt = $this->conn->prepare("DELETE FROM hotels WHERE id = ?");
            $stmt->execute([$id]);
            
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    // ---------------------------------------------------------
    // BAGIAN MANAJEMEN ROOM, GALLERY, FASILITAS & ADDONS
    // ---------------------------------------------------------

    // 4. Tambah Gambar Galeri
    public function addGalleryImage($hotel_id, $path) {
        $stmt = $this->conn->prepare("INSERT INTO hotel_gallery (hotel_id, image_path) VALUES (?, ?)");
        return $stmt->execute([$hotel_id, $path]);
    }

    // 5. Tambah Fasilitas (Gratis)
    public function addFacility($hotel_id, $facility_name) {
        $stmt = $this->conn->prepare("INSERT INTO hotel_facilities (hotel_id, facility_name) VALUES (?, ?)");
        return $stmt->execute([$hotel_id, $facility_name]);
    }

    // 6. Tambah Tipe Kamar
    public function addRoom($hotel_id, $name, $price, $capacity, $qty) {
        $sql = "INSERT INTO room_types (hotel_id, name, price, capacity, qty) VALUES (?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$hotel_id, $name, $price, $capacity, $qty]);
    }

    // 7. Hapus Tipe Kamar (FIX: Mengatasi Foreign Key Constraint pada Bookings)
    public function deleteRoom($room_id) {
        $this->conn->beginTransaction();
        try {
            // A. Hapus semua Bookings yang terkait dengan room_id ini
            $stmtBookings = $this->conn->prepare("DELETE FROM bookings WHERE room_type_id = ?");
            $stmtBookings->execute([$room_id]);

            // B. Hapus Room itu sendiri
            $stmt = $this->conn->prepare("DELETE FROM room_types WHERE id = ?");
            $stmt->execute([$room_id]);
            
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    // 8. Tambah Add-ons Berbayar
    public function addAddon($hotel_id, $name, $price) {
        $stmt = $this->conn->prepare("INSERT INTO hotel_addons (hotel_id, name, price) VALUES (?, ?, ?)");
        return $stmt->execute([$hotel_id, $name, $price]);
    }

    // 9. Hapus Add-on Berbayar
    public function deleteAddon($id) {
        $stmt = $this->conn->prepare("DELETE FROM hotel_addons WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // 10. Ambil Daftar Add-ons (FIXED: Method yang dibutuhkan BookingController)
    public function getAddons($hotel_id) {
        $stmt = $this->conn->prepare("SELECT * FROM hotel_addons WHERE hotel_id = ?");
        $stmt->execute([$hotel_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ---------------------------------------------------------
    // BAGIAN READ / GET DATA (Untuk User & Umum)
    // ---------------------------------------------------------

    // 11. Ambil Semua Hotel (Untuk Halaman Home + Search)
    public function getAll($searchQuery = "") {
        $sql = "SELECT h.*, min(r.price) as start_price 
                FROM hotels h 
                LEFT JOIN room_types r ON h.id = r.hotel_id ";
        
        if (!empty($searchQuery)) {
            $sql .= " WHERE h.name LIKE :q OR h.city LIKE :q ";
        }

        $sql .= " GROUP BY h.id ORDER BY h.id DESC";
        
        $stmt = $this->conn->prepare($sql);
        
        if (!empty($searchQuery)) {
            $term = "%$searchQuery%";
            $stmt->bindParam(':q', $term);
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 12. Ambil Detail Hotel Lengkap
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM hotels WHERE id = ?");
        $stmt->execute([$id]);
        $hotel = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($hotel) {
            $stmtRoom = $this->conn->prepare("SELECT * FROM room_types WHERE hotel_id = ?");
            $stmtRoom->execute([$id]);
            $hotel['rooms'] = $stmtRoom->fetchAll(PDO::FETCH_ASSOC);

            try {
                $stmtFac = $this->conn->prepare("SELECT * FROM hotel_facilities WHERE hotel_id = ?");
                $stmtFac->execute([$id]);
                $hotel['facilities'] = $stmtFac->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $e) { $hotel['facilities'] = []; }

            try {
                $stmtGal = $this->conn->prepare("SELECT * FROM hotel_gallery WHERE hotel_id = ?");
                $stmtGal->execute([$id]);
                $hotel['gallery'] = $stmtGal->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $e) { $hotel['gallery'] = []; }
        }
        return $hotel;
    }

    // 13. Ambil Hotel Milik Owner Tertentu (Dengan Kamar Nested)
    public function getByOwner($owner_id) {
        $stmt = $this->conn->prepare("SELECT * FROM hotels WHERE owner_id = ? ORDER BY id DESC");
        $stmt->execute([$owner_id]);
        $hotels = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($hotels as &$hotel) {
            $stmtRoom = $this->conn->prepare("SELECT * FROM room_types WHERE hotel_id = ?");
            $stmtRoom->execute([$hotel['id']]);
            $hotel['rooms'] = $stmtRoom->fetchAll(PDO::FETCH_ASSOC);
        }
        return $hotels;
    }
}
?>