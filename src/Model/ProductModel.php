<?php

declare(strict_types=1);

namespace MyApp\Model;

use PDO;
use MyApp\Entity\Product;
use MyApp\Entity\Type;

class ProductModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllProducts(): array
    {
        try {
            $sql = "SELECT p.id as idProduit, name, description, price, stock, t.id as idType, label
                    FROM product p 
                    INNER JOIN type t ON p.idType = t.id 
                    ORDER BY name";
            $stmt = $this->db->query($sql);
            $products = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $type = new Type($row['idType'], $row['label']);
                $products[] = new Product(
                    $row['idProduit'],
                    $row['name'],
                    $row['description'],
                    $row['price'],
                    $row['stock'],
                    $type
                );
            }
            return $products;
        } catch (\PDOException $e) {
            // Handle exception (log, show error message, etc.)
            // For example:
            // echo "Error: " . $e->getMessage();
            return []; // Return empty array in case of error
        }
    }
}