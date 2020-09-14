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
        $query = "UPDATE about SET about = ? WHERE id = 1";
        if (runQuery($query, ['s', &$this->about], false) == 0)
            badRequestResponse("Fail to update about page");
    }
}
