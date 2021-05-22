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

//query the product
$stmt= $product->readAll();
$num= $stmt->rowCount();

$products_array=array();
$products_array['data']=array();
// $products_array['company_details']=array();
// $company_details=array(
//     "status"=>"verified",
//     "name"=>"Amazon Incoporation",
//     "ranking"=>"1st"
// );
// array_push($products_array['company_details'],$company_details);


//check if more than 0 record is Found
if($num>0){
   while ($row= $stmt->fetch(PDO::FETCH_ASSOC)) {
       extract($row);
       $products_item=array(
        'id' => $id,
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'category_id' => $category_id,
        'category_name' => $category_name,
        'created' => $created
       );
       //push items to $products_array['data']
       array_push($products_array['data'],$products_item);
   }
   echo json_encode($products_array);
}
else{
   echo json_encode(
        array('message' => 'NO RECORDS FOUND!')
   );
}




?>