<?php
class Escrow {
    private $conn;
    public function __construct($db) { $this->conn = $db; }

    public function getBalances() {
        $sql = "SELECT e.*, u.name as owner_name, b.id as booking_ref FROM escrow_ledger e 
                JOIN users u ON e.owner_id = u.id 
                JOIN bookings b ON e.booking_id = b.id
                ORDER BY e.status ASC"; // HELD first
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function releaseFunds($escrow_id) {
        $stmt = $this->conn->prepare("UPDATE escrow_ledger SET status = 'RELEASED' WHERE id = ?");
        return $stmt->execute([$escrow_id]);
    }
    
    public function getOwnerStats($owner_id) {
        $stmt = $this->conn->prepare("SELECT 
            SUM(CASE WHEN status='RELEASED' THEN amount ELSE 0 END) as earnings,
            SUM(CASE WHEN status='HELD' THEN amount ELSE 0 END) as pending,
            COUNT(id) as total_tx
            FROM escrow_ledger WHERE owner_id = ?");
        $stmt->execute([$owner_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>