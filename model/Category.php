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
        if (isset($object->category))
            $this->category = $object->category;
    }

    public function create()
    {
        $query = "INSERT INTO category (`category`) VALUE ?";
        if (runQuery($query, ["s", &$this->category], false) == 0) {
            badRequestResponse("Fail to create category");
        }
    }

    public function update()
    {
        $query = "UPDATE category SET category = ? WHERE id = ?";
        if (runQuery($query, ["si", &$this->category, &$this->id], false) == 0) {
            badRequestResponse("Fail to update category");
        }
    }

    public static function getById($id)
    {
        $query = "SELECT * FROM category WHERE id = ?";
        $result = runQuery($query, ["i", &$id]);
        if (mysqli_num_rows($result) == 0) {
            badRequestResponse("Invalid category");
        }
        return new Category($result->fetch_object());
    }

    public static function getAll()
    {
        $query = "SELECT * FROM category";
        $result = runQuery($query);
        $response = [];
        while ($row = $result->fetch_object()) {
            array_push($response, new Category($row));
        }
        return $response;
    }

    public static function getByPage($pageNum, $pageSize){
        $offset = $pageNum * $pageSize;
        $query = "SELECT * FROM category LIMIT ? OFFSET ?";
        $param = ["ii", &$pageSize, &$offset];
        $result = runQuery($query, $param);
        $response = [];
        while ($row = $result->fetch_object()) {
            array_push($response, new Category($row));
        }
        return $response;
    }
}
