<?php


class Product
{
    public $id;
    public $product_name;
    public $description;
    private $category_id;
    public $price;
    public $status;
    public $is_active;
    public $rating;
    public $count_rating;

    #constructor from db response
    public function __construct($object)
    {
        if (isset($object->id)) //create -> no id
            $this->id = $object->id;
        $this->product_name = $object->product_name;
        if (isset($object->description))
            $this->description = $object->description;
        if (isset($object->category_id))
            $this->category_id = $object->category_id;
        $this->price = $object->price;
        if (isset($object->status))
            $this->status = $object->status;
        if (isset($object->is_active))
            $this->is_active = $object->is_active;
    }

    private function setRating(){
        $query = "SELECT AVG(rating) as avg_rating, COUNT(*) as total FROM product_rating WHERE product_id = $this->id";
        $result = runQuery($query)->fetch_object();
        $this->rating = $result->avg_rating;
        $this->count_rating = $result->total;
    }

    public function create()
    {
        $query = "INSERT INTO product (`product_name`, `description`, `category_id`, `price`, `status`)
            VALUES ('$this->product_name', '$this->description', '$this->category_id', '$this->price', '$this->status')";
        runQuery($query);
    }

    public function update()
    {
        $query = "UPDATE product 
                SET product_name = $this->product_name, description = $this->description ,category_id = $this->category_id, price = $this->price, status = $this->status 
                WHERE id = $this->id";
        runQuery($query);
    }

    public static function getById($id)
    {
        $query = "SELECT * FROM product WHERE id = $id";
        $result = runQuery($query);
        if (mysqli_num_rows($result) == 0) {
            http_response_code(404);
            die();
        }
        $product = new Product($result->fetch_object());
        $product->setRating();
        return $product;
    }

    public static function getAll()
    {
        $query = "SELECT * FROM user";
        $result = runQuery($query);
        $response = [];
        while ($row = $result->fetch_object()) {
            $product = new Product($row);
            $product->setRating();
            array_push($response, $product);
        }
        return $response;
    }

    public static function getAllByPage($pageNum, $pageSize){
        $offset = $pageNum * $pageSize;
        $query = "SELECT * FROM product LIMIT $pageSize OFFSET $offset";
        $result = runQuery($query);
        $response = [];
        while ($row = $result->fetch_object()) {
            $product = new Product($row);
            $product->setRating();
            array_push($response, $product);
        }
        return $response;
    }

    public static function getActiveByPage($pageNum, $pageSize){
        $offset = $pageNum * $pageSize;
        $query = "SELECT * FROM product WHERE is_active = true LIMIT $pageSize OFFSET $offset";
        $result = runQuery($query);
        $response = [];
        while ($row = $result->fetch_object()) {
            $product = new Product($row);
            $product->setRating();
            array_push($response, $product);
        }
        return $response;
    }

    public static function countAll(){
        $query = "SELECT COUNT(*) AS total FROM product";
        $result = runQuery($query);
        return $result->fetch_object()->total;
    }

    public static function countAllActive(){
        $query = "SELECT COUNT(*) AS total FROM product WHERE is_active=true";
        $result = runQuery($query);
        return $result->fetch_object()->total;
    }

    public static function delete($id)
    {
        $query = "UPDATE product SET is_active = false WHERE id = $id";
        runQuery($query);
    }
}
