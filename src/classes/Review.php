<?php
class Review
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllReviews()
    {
        $stmt = $this->db->prepare("SELECT * FROM reviews");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
