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
        $query = "SELECT AVG(rating) as avg_rating, COUNT(*) as total FROM product_rating WHERE product_id = ?";
        $result = runQuery($query, ["i", &$this->id])->fetch_object();
        if ($result != null){
            $this->rating = $result->avg_rating;
            $this->count_rating = $result->total;
        }
    }

    public function create()
    {
        $query = "INSERT INTO product (`product_name`, `description`, `category_id`, `price`, `status`) VALUES (?, ?, ?, ?, ?)";
        $param = ['ssids', &$this->product_name, &$this->description, &$this->category_id, &$this->price, &$this->status];
        if (!runQuery($query, $param, false))
            badRequestResponse("Fail to create product");
    }

    public function update()
    {
        $query = "UPDATE product SET product_name = ?, description = ? ,category_id = ?, price = ?, status = ? WHERE id = ?";
        $param = ["ssidsi", &$this->product_name, &$this->description, &$this->category_id, &$this->price, &$this->status, &$this->id];
        if (!runQuery($query, $param, false))
            badRequestResponse("Invalid product");
    }

    public static function getById($id)
    {
        $query = "SELECT * FROM product WHERE id = ?";
        $result = runQuery($query, ["i", &$id]);

        if (mysqli_num_rows($result) == 0) {
            badRequestResponse("Invalid product");
        }
        $product = new Product($result->fetch_object());
        $product->setRating();
        return $product;
    }

    public static function getAll()
    {
        $query = "SELECT * FROM product";
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
        $query = "SELECT * FROM product LIMIT ? OFFSET ?";
        $param = ["ii", $pageSize, $offset];
        $result = runQuery($query, $param);

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
        $query = "SELECT * FROM product WHERE is_active = true LIMIT ? OFFSET ?";
        $param = ["ii", $pageSize, $offset];
        $result = runQuery($query, $param);

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

    public static function getByCategoryByPage($categoryId, $pageNum, $pageSize){
        $offset = $pageNum * $pageSize;
        $query = "SELECT * FROM product WHERE category_id = ? AND is_active = true LIMIT ? OFFSET ?";
        $param = ["iii", &$categoryId, &$pageSize, &$offset];
        $result = runQuery($query, $param);

        $response = [];
        while ($row = $result->fetch_object()) {
            $product = new Product($row);
            $product->setRating();
            array_push($response, $product);
        }
        return $response;
    }

    public static function countByCategory($categoryId){
        $query = "SELECT COUNT(*) AS total FROM product WHERE category_id = ? AND is_active=true";
        $result = runQuery($query, ['i', &$categoryId]);
        return $result->fetch_object()->total;
    }

    public static function delete($id)
    {
        $query = "UPDATE product SET is_active = false WHERE id = ?";
        if (!runQuery($query, ["i", &$id], false)) {
            badRequestResponse("Invalid product");
        }
    }
}
