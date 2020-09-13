<?php


class Branch
{
    public $id;
    public $branch_name;
    public $address;
    public $email1;
    public $email2;
    public $email3;
    public $phone1;
    public $phone2;
    public $phone3;
    public $is_active = true;

    #constructor from db response
    public function __construct($object)
    {
        if (isset($object->id)) //create -> no id
            $this->id = $object->id;
        $this->branch_name = $object->branch_name;
        if (isset($object->email1))
            $this->email1 = $object->email1;
        if (isset($object->email2))
            $this->email2 = $object->email2;
        if (isset($object->email3))
            $this->email3 = $object->email3;
        if (isset($object->phone1))
            $this->phone1 = $object->phone1;
        if (isset($object->phone1))
            $this->phone1 = $object->phone1;
        if (isset($object->phone2))
            $this->phone1 = $object->phone2;
        if (isset($object->phone3))
            $this->phone1 = $object->phone3;
        $this->is_active = $object->is_active;
    }

    public function create()
    {
        $query = "INSERT INTO branch (`branch_name`, `address`, `email1`, `email2`, `email3`, `phone1`, `phone2`, `phone3`) 
                VALUES ('$this->branch_name', '$this->address', '$this->email1', '$this->email2', '$this->email3', '$this->phone1', '$this->phone2', '$this->phone3')";
        runQuery($query);
    }

    public function update()
    {
        $query = "UPDATE branch SET branch_name = $this->branch_name, address = $this->address, 
                  email1 = $this->email1, email2 = $this->email2, email3 = $this->email3,
                  phone1 = $this->phone1, phone2 = $this->phone2, phone3 = $this->phone3                  
                  WHERE id = $this->id";
        runQuery($query);
    }

    public static function getById($id)
    {
        $query = "SELECT * FROM branch WHERE id = $id";
        $result = runQuery($query);
        if (mysqli_num_rows($result) == 0) {
            http_response_code(404);
            die();
        }
        return new Branch($result->fetch_object());
    }

    public static function getAll()
    {
        $query = "SELECT * FROM branch";
        $result = runQuery($query);
        $response = [];
        while ($row = $result->fetch_object()) {
            array_push($response, new Branch($row));
        }
        return $response;
    }

    public static function getAllByPage($pageNum, $pageSize){
        $offset = $pageNum * $pageSize;
        $query = "SELECT * FROM branch LIMIT $pageSize OFFSET $offset";
        $result = runQuery($query);
        $response = [];
        while ($row = $result->fetch_object()) {
            array_push($response, new Branch($row));
        }
        return $response;
    }

    public static function getActiveByPage($pageNum, $pageSize){
        $offset = $pageNum * $pageSize;
        $query = "SELECT * FROM branch WHERE is_active = true LIMIT $pageSize OFFSET $offset";
        $result = runQuery($query);
        $response = [];
        while ($row = $result->fetch_object()) {
            array_push($response, new Branch($row));
        }
        return $response;
    }

    public static function countAll(){
        $query = "SELECT COUNT(*) AS total FROM branch";
        $result = runQuery($query);
        return $result->fetch_object()->total;
    }

    public static function countAllActive(){
        $query = "SELECT COUNT(*) AS total FROM branch WHERE is_active=true";
        $result = runQuery($query);
        return $result->fetch_object()->total;
    }

    public static function delete($id)
    {
        $query = "UPDATE branch SET is_active = false WHERE id = $id";
        runQuery($query);
    }
}
