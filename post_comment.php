<?php
require 'util.php';
include 'model/PostComment.php';

switch ($_SERVER['REQUEST_METHOD']){
    case 'GET':{
        if (!isset($_GET['postId'])){
            http_response_code(400);
        } else {
            $postId = $_GET['postId'];
            $page = isset($_GET['page']) ? $_GET['page'] : 0;
            $comment_list = PostComment::getByPostByPage($postId, $page, 10);
            setSuccessResponse($comment_list);
        }
        break;
    }
    case 'POST':{
        $userId = $_SESSION['userId'];
        if (isset($userId)){
            $data = json_decode(file_get_contents("php://input", "r"));
            $postComment = new PostComment($data);
            $postComment->create($userId);
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
