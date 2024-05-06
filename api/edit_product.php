<?php
session_start();
include '../api/database.php';
$conn = new Database();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {

        $id = $_POST['id'];
        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $details = $_POST['details'];
        $details = filter_var($details, FILTER_SANITIZE_STRING);
        $price = $_POST['price'];
        $price = filter_var($price, FILTER_SANITIZE_STRING);

        $img_01 = $_FILES['img_01']['name'];
        $img_01 = filter_var($img_01, FILTER_SANITIZE_STRING);
        $img_size_01 = $_FILES['img_01']['size'];
        $img_tmp_name_01 = $_FILES['img_01']['tmp_name'];
        $img_folder_01 = '../uploaded_img/' . $img_01;

        $img_02 = $_FILES['img_02']['name'];
        $img_02 = filter_var($img_02, FILTER_SANITIZE_STRING);
        $img_size_02 = $_FILES['img_02']['size'];
        $img_tmp_name_02 = $_FILES['img_02']['tmp_name'];
        $img_folder_02 = '../uploaded_img/' . $img_02;

        $img_03 = $_FILES['img_03']['name'];
        $img_03 = filter_var($img_03, FILTER_SANITIZE_STRING);
        $img_size_03 = $_FILES['img_03']['size'];
        $img_tmp_name_03 = $_FILES['img_03']['tmp_name'];
        $img_folder_03 = '../uploaded_img/' . $img_03;

        $category = $_POST['category'];
        $category = filter_var($category, FILTER_SANITIZE_STRING);
        
        $query = "UPDATE products SET name = '$name', details = '$details', price = '$price', image_01 = '$img_01', image_02 = '$img_02', image_03 = '$img_03', category = '$category' WHERE id = $id";
        $updated_product = $conn->query($query);
        if ($updated_product) {
            if ($img_size_01 > 4000000 or $img_size_02 > 4000000 or $img_size_03 > 4000000) {
                $message[] = 'image size is too large!';
            } else {
                move_uploaded_file($img_tmp_name_01, $img_folder_01);
                move_uploaded_file($img_tmp_name_02, $img_folder_02);
                move_uploaded_file($img_tmp_name_03, $img_folder_03);
                $message[] = 'product updated!';
            }
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
};
