<?php
include 'database.php';

class Store
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getProducts()
    {
        $query = "SELECT * FROM products";
        $result = $this->db->query($query);
        return $result;
    }

    public function getProductById($id)
    {
        $id = $this->db->escapeString($id);
        $query = "SELECT * FROM products WHERE id = '$id'";
        $result = $this->db->query($query);
        return $result;
    }

    public function addProduct($name, $price, $description, $category, $image)
    {
        $name = $this->db->escapeString($name);
        $price = $this->db->escapeString($price);
        $description = $this->db->escapeString($description);
        $category = $this->db->escapeString($category);
        $image = $this->db->escapeString($image);

        $query = "INSERT INTO products (name, price, description, category, image) VALUES ('$name', '$price', '$description', '$category', '$image')";
        $result = $this->db->query($query);
        return $result;
    }

    public function deleteProduct($id)
    {
        $id = $this->db->escapeString($id);
        $query = "DELETE FROM products WHERE id = '$id'";
        $result = $this->db->query($query);
    }

    public function updateProduct($id, $name, $price, $description, $category, $image)
    {
        $id = $this->db->escapeString($id);
        $name = $this->db->escapeString($name);
        $price = $this->db->escapeString($price);
        $description = $this->db->escapeString($description);
        $category = $this->db->escapeString($category);
        $image = $this->db->escapeString($image);

        $query = "UPDATE products SET name = '$name', price = '$price', description = '$description', category = '$category', image = '$image' WHERE id = '$id'";
        $result = $this->db->query($query);
        return $result;
    }

    public function searchProduct($search)
    {
        $search = $this->db->escapeString($search);
        $query = "SELECT * FROM products WHERE name LIKE '%$search%'";
        $result = $this->db->query($query);
        return $result;
    }

    public function filterProduct($filter) {
        $filter = $this->db->escapeString($filter);
        $query = "SELECT * FROM products WHERE category LIKE '%$filter%'";
        $result = $this->db->query($query);
        return $result;
    }
}
