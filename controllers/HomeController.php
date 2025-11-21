<?php
require_once __DIR__ . '/../models/Hotel.php';

class HomeController {
    private $hotelModel;
    public function __construct($db) { $this->hotelModel = new Hotel($db); }

    public function index() {
        $hotels = $this->hotelModel->getAll();
        require __DIR__ . '/../views/home/index.php';
    }

    public function detail($id) {
        $hotel = $this->hotelModel->getById($id);
        require __DIR__ . '/../views/home/detail.php';
    }
}
?>

