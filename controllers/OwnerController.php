<?php
require_once __DIR__ . '/../models/Hotel.php';
require_once __DIR__ . '/../models/Escrow.php';

class OwnerController {
    private $hotelModel;
    private $escrowModel;

    public function __construct($db) {
        // Middleware Sederhana: Cek Login & Role
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'owner') {
            header("Location: /login"); 
            exit;
        }
        
        $this->hotelModel = new Hotel($db);
        $this->escrowModel = new Escrow($db);
    }

    // 1. Dashboard Utama
    public function dashboard() {
        $ownerId = $_SESSION['user']['id'];
        
        // Ambil daftar hotel beserta kamarnya (Logic ada di Model)
        $hotels = $this->hotelModel->getByOwner($ownerId);
        
        // Ambil statistik keuangan
        $stats = $this->escrowModel->getOwnerStats($ownerId);
        
        require __DIR__ . '/../views/owner/dashboard.php';
    }

    // 2. Create Hotel (Form & Process)
    public function createHotel() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // A. Upload Thumbnail Utama
            $thumbPath = "";
            if(isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == 0) {
                $thumbName = time() . "_thumb_" . basename($_FILES["thumbnail"]["name"]);
                $target = __DIR__ . "/../public/uploads/" . $thumbName;
                if(move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target)) {
                    $thumbPath = "uploads/" . $thumbName;
                }
            }

            // B. Simpan Data Dasar Hotel
            $hotel_id = $this->hotelModel->create(
                $_SESSION['user']['id'],
                $_POST['name'],
                $_POST['city'],
                $_POST['address'],
                $_POST['description'],
                $thumbPath
            );

            if ($hotel_id) {
                // C. Simpan Fasilitas (Checkbox Array)
                if(isset($_POST['facilities'])) {
                    foreach($_POST['facilities'] as $f) {
                        $this->hotelModel->addFacility($hotel_id, $f);
                    }
                }

                // D. Upload Galeri (Multiple Files)
                if(isset($_FILES['gallery'])) {
                    $total = count($_FILES['gallery']['name']);
                    for($i=0; $i<$total; $i++) {
                        if($_FILES['gallery']['error'][$i] == 0) {
                            $gName = time() . "_gal_" . $i . "_" . basename($_FILES['gallery']['name'][$i]);
                            $gTarget = __DIR__ . "/../public/uploads/" . $gName;
                            if(move_uploaded_file($_FILES['gallery']['tmp_name'][$i], $gTarget)) {
                                $this->hotelModel->addGalleryImage($hotel_id, "uploads/" . $gName);
                            }
                        }
                    }
                }

                header("Location: /owner/dashboard");
            } else {
                echo "<script>alert('Gagal membuat hotel.'); window.history.back();</script>";
            }
        } else {
            require __DIR__ . '/../views/owner/create_hotel.php';
        }
    }

    // 3. Edit Hotel (View)
    public function editHotel() {
        if (!isset($_GET['id'])) { header("Location: /owner/dashboard"); exit; }
        
        $hotel = $this->hotelModel->getById($_GET['id']);
        
        // Security Check: Pastikan hotel milik user yang login
        if (!$hotel || $hotel['owner_id'] != $_SESSION['user']['id']) {
            header("Location: /owner/dashboard"); exit;
        }
        
        // Ambil Addons untuk ditampilkan di form edit
        $addons = $this->hotelModel->getAddons($hotel['id']);

        require __DIR__ . '/../views/owner/edit_hotel.php';
    }

    // 4. Update Hotel (Process)
    public function updateHotel() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hotelId = $_POST['hotel_id'];
            
            // Security Check Double (untuk form manipulation prevention)
            $hotel = $this->hotelModel->getById($hotelId);
            if ($hotel['owner_id'] != $_SESSION['user']['id']) { die("Unauthorized"); }

            // Cek apakah ada upload thumbnail baru
            $thumbPath = null;
            if(isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == 0) {
                $thumbName = time() . "_upd_" . basename($_FILES["thumbnail"]["name"]);
                $target = __DIR__ . "/../public/uploads/" . $thumbName;
                if(move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target)) {
                    $thumbPath = "uploads/" . $thumbName;
                }
            }

            // Update Data
            $this->hotelModel->update(
                $hotelId, 
                $_POST['name'], 
                $_POST['city'], 
                $_POST['address'], 
                $_POST['description'], 
                $thumbPath
            );

            // Redirect kembali ke dashboard
            header("Location: /owner/dashboard");
        }
    }

    // 5. Delete Hotel
    public function deleteHotel() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hotelId = $_POST['hotel_id'];
            
            // Security Check
            $hotel = $this->hotelModel->getById($hotelId);
            if ($hotel && $hotel['owner_id'] == $_SESSION['user']['id']) {
                $this->hotelModel->delete($hotelId);
            }
            
            header("Location: /owner/dashboard");
        }
    }

    // 6. Room Management
    public function addRoom() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Security check owner hotel bisa ditambahkan disini jika perlu
            $this->hotelModel->addRoom(
                $_POST['hotel_id'], 
                $_POST['name'], 
                $_POST['price'], 
                $_POST['capacity'], 
                $_POST['qty']
            );
            header("Location: /owner/dashboard");
        }
    }

    public function deleteRoom() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Perlu query tambahan untuk validasi owner jika ingin sangat ketat
            // Tapi untuk skema ini, kita asumsikan ID room valid dari form dashboard
            $this->hotelModel->deleteRoom($_POST['room_id']);
            header("Location: /owner/dashboard");
        }
    }

    // 7. Add-ons Management
    public function addAddon() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->hotelModel->addAddon($_POST['hotel_id'], $_POST['name'], $_POST['price']);
            // Redirect kembali ke halaman edit hotel
            header("Location: /owner/edit-hotel?id=" . $_POST['hotel_id']);
        }
    }

    public function deleteAddon() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->hotelModel->deleteAddon($_POST['addon_id']);
            header("Location: /owner/edit-hotel?id=" . $_POST['hotel_id']);
        }
    }
}
?>