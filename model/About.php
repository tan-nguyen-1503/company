<?php


class About
{
    public $about;

    public function __construct($object)
    {
        $this->about = $object->about;
    }

    public static function getAbout(){
        $query = "SELECT about FROM about WHERE id = 1";
        $result = runQuery($query);
        return new About($result->fetch_object());
    }

    public function update(){
        $query = "UPDATE about SET about = $this->about WHERE id = 1";
        runQuery($query);
    }
}
