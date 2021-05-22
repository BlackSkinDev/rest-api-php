<?php
class Product{
    //database connection and table name
    private $conn;
    private $table_name="products";

    //create object properties
    public $id;
    public $name;
    public $description;
    public $price;
    public $category_id;
    public $category_name;
    public $created;

    //constructor with $db as connection
    public function __construct($db){
        $this->conn=$db;
    }

    //read products
    function readAll(){
        //select all query
        $query= "select c.name as category_name,p.id,p.name,
        p.description,p.price,p.category_id,p.created
        from ".$this->table_name." p
        left join
        categories c 
        on p.category_id=c.id ";

        
         //prepare query
         $stmt= $this->conn->prepare($query);

         

         //execute query  
         $stmt->execute();
         return $stmt;
    }
    
    //read single product
    public function readSingle(){
        $query= "select c.name as category_name,p.id,p.name,
        p.description,p.price,p.category_id,p.created
        from ".$this->table_name." p
        left join
        categories c 
        on p.category_id=c.id
        where p.id= ? 
        limit 0,1";

         //prepare query
         $stmt= $this->conn->prepare($query);

         //bind id to query
         $stmt->bindParam(1,$this->id);

         //execute query  
         $stmt->execute();
         $row= $stmt->fetch(PDO::FETCH_ASSOC);
         //set properties
         $this->name= $row['name'];
         $this->description= $row['description'];
         $this->price= $row['price'];
         $this->category_id= $row['category_id'];
         $this->category_name= $row['category_name'];
         $this->created= $row['created'];
    }
}
    
?>