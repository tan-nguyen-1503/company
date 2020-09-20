<?php


class Branch
{
    public $id;
    public $branch_name;
    public $address;
    public $email;
    public $phone;
    public $is_active = true;

    #constructor from db response
    public function __construct($object)
    {
        if (isset($object->id)) //create -> no id
            $this->id = $object->id;
        $this->branch_name = $object->branch_name;
        if (isset($object->email))
            $this->email = $object->email;
        if (isset($object->phone))
            $this->phone = $object->phone;
        if (isset($object->is_active))
            $this->is_active = $object->is_active;
        if (isset($object->address))
            $this->address = $object->address;
    }

    public function create()
    {
        $query = "INSERT INTO branch (`branch_name`, `address`, `email`, `phone`) VALUES (?, ?, ?, ?)";
        $param = ["ssss", &$this->branch_name, &$this->address, &$this->email, &$this->phone];
        if (runQuery($query, $param, false) == 0){
            badRequestResponse("Fail to create a branch");
        };
    }

    public function update()
    {
        $query = "UPDATE branch SET branch_name = ?, address = ?, email = ?, phone = ? WHERE id = ?";
        $param = ["ssssi", &$this->branch_name, &$this->address, &$this->email, &$this->phone, &$this->id];
        if (runQuery($query, $param, false) == 0)
            badRequestResponse("Fail to update branch");
    }

    public static function getById($id)
    {
        $query = "SELECT * FROM branch WHERE id = $id";
        $result = runQuery($query, ["i", &$id]);
        if (mysqli_num_rows($result) == 0) {
            badRequestResponse("Not found branch");
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
        $query = "SELECT * FROM branch LIMIT ? OFFSET ?";
        $result = runQuery($query, ["ii", &$pageSize, &$offset]);
        $response = [];
        while ($row = $result->fetch_object()) {
            array_push($response, new Branch($row));
        }
        return $response;
    }

    public static function getActiveByPage($pageNum, $pageSize){
        $offset = $pageNum * $pageSize;
        $query = "SELECT * FROM branch WHERE is_active = true LIMIT ? OFFSET ?";
        $result = runQuery($query, ["ii", &$pageSize, &$offset]);
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
        $query = "UPDATE branch SET is_active = false WHERE id = ?";
        if (runQuery($query, ["i", &$id], false) == 0)
            badRequestResponse("Invalid branch");
    }
}
