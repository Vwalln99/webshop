<?php
class OrderItem
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllOrderItems()
    {
        $stmt = $this->db->prepare("SELECT * FROM order_items");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
