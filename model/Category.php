<?php


class Category
{
    public $id;
    public $category;

    #constructor from db response
    public function __construct($object)
    {
        if (isset($object->id)) //create -> no id
            $this->id = $object->id;
        $this->category = $object->category;
    }

    public function create()
    {
        $query = "INSERT INTO category (`category`) VALUE ($this->category)";
        runQuery($query);
    }

    public function update()
    {
        $query = "UPDATE category SET category = $this->category WHERE id = $this->id";
        runQuery($query);
    }

    public static function getById($id)
    {
        $query = "SELECT * FROM category WHERE id = $id";
        $result = runQuery($query);
        if (mysqli_num_rows($result) == 0) {
            http_response_code(404);
            die();
        }
        return new User($result->fetch_object());
    }

    public static function getAll()
    {
        $query = "SELECT * FROM category";
        $result = runQuery($query);
        $response = [];
        while ($row = $result->fetch_object()) {
            array_push($response, new User($row));
        }
        return $response;
    }

    public static function getByPage($pageNum, $pageSize){
        $offset = $pageNum * $pageSize;
        $query = "SELECT * FROM category LIMIT $pageSize OFFSET $offset";
        $result = runQuery($query);
        $response = [];
        while ($row = $result->fetch_object()) {
            array_push($response, new Category($row));
        }
        return $response;
    }
}
