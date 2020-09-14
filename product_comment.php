<?php
require 'util.php';
include 'model/ProductComment.php';

switch ($_SERVER['REQUEST_METHOD']){
    case 'GET':{
        if (!isset($_GET['productId'])){
            http_response_code(400);
        } else {
            $productId = $_GET['productId'];
            $page = isset($_GET['page']) ? $_GET['page'] : 0;
            $comment_list = ProductComment::getByProductByPage($productId, $page, 10);
            setSuccessResponse($comment_list);
        }
        break;
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
        break;
    }
    default:
        http_response_code(405);
        break;
}
?>
