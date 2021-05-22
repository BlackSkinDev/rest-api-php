<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//include database and object file
include_once "../config/database.php";
include_once "../objects/products.php";

//instantiate database and product object
$database= new Database();
$db=$database->getConnection();

//initialize the object product
$product= new Product($db);

//get product id
$product->id= isset($_GET['id']) ? $_GET['id'] : die();
$product->readSingle();

$product_array=array(
        'id' => $id,
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'category_id' => $category_id,
        'category_name' => $category_name,
        'created' => $created
);


?>