<?php
require 'util.php';
include 'model/ProductComment.php';

switch ($_SERVER['REQUEST_METHOD']){
    case 'GET':{
        $productId = $_GET['productId'];
        $page = isset($_GET['page']) ? $_GET['page'] : 0;
        $comment_list = ProductComment::getByProductByPage($productId, $page, 10);
        setSuccessResponse($comment_list);
    }
    case 'POST':{
        $userId = $_SESSION['userId'];
        if (isset($userId)){
            $data = json_decode(file_get_contents("php://input", "r"));
            $productComment = new ProductComment($data);
            $productComment->create($userId);
            setSuccessResponse("Posted new comment successfully");
        } else{
            http_response_code(401);
        }
    }
    default:
        http_response_code(405);
}
?>
