<?php

class Product
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllProducts()
    {
        $stmt = $this->db->prepare("SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addProduct($name, $description, $price, $category_id)
    {
        $sql = "INSERT INTO products(name, description, price, category_id) VALUES (:name, :description, :price, :category_id)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':name' => $name, ':description' => $description, ':price' => $price, ':category_id' => $category_id]);
    }

    public function updateProduct($id, $name, $description, $price, $category_id)
    {
        $sql = "UPDATE products SET name = :name, description=:description, price=:price, category_id=:category_id WHERE id=:id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':name' => $name, ':description' => $description, ':price' => $price, ':category_id' => $category_id, ':id' => $id]);
    }

    public function deleteProduct($id)
    {
        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function getAllCategories()
    {
        $stmt = $this->db->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductImages($product_id)
    {
        $stmt = $this->db->prepare("SELECT image_url FROM product_images WHERE product_id = :product_id");
        $stmt->execute([':product_id' => $product_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function uploadProductImage($product_id, $image_url)
    {
        $stmt = $this->db->prepare("INSERT INTO product_images (product_id, image_url) VALUES (:product_id, :image_url)");
        $stmt->execute([':product_id' => $product_id, ':image_url' => $image_url]);
    }

    public function getTopSellingProducts()
    {
        $sql = "SELECT products.*, AVG(reviews.rating) as average_rating, COUNT(reviews.product_id) as review_count
                FROM products
                LEFT JOIN reviews ON products.id = reviews.product_id
                GROUP BY products.id
                ORDER BY average_rating DESC
                LIMIT 6";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
