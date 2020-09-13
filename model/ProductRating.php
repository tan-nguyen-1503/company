<?php


class ProductRating
{
    public $id;
    public $product_id;
    public $rating;

    #constructor from db response
    public function __construct($object)
    {
        if (isset($object->id)) //create -> no id
            $this->id = $object->id;
        $this->product_id = $object->product_id;
        $this->rating = $object->rating;
    }

    public function create($userId)
    {
        $query = "INSERT INTO product_rating (`user_id`, `product_id`, `rating`) VALUES ('$userId', '$this->product_id', '$this->rating')";
        runQuery($query);
    }

    public function update()
    {
        $query = "UPDATE product_rating SET rating = $this->rating WHERE id = $this->id";
        runQuery($query);
    }
}
