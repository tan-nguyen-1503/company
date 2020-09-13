<?php
require '../util.php';
if (!isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']){
    http_response_code(403);
} else {
    switch ($_SERVER['REQUEST_METHOD']){
        case 'POST':{
            include '../model/Post.php';
            $data = json_decode(file_get_contents("php://input", "r"));
            $post = new Post($data);
            $post->create($_SESSION['userId']);
            setSuccessResponse("Created post successfully");
            break;
        }
        case 'PUT': {
            include '../model/Post.php';
            $data = json_decode(file_get_contents("php://input", "r"));
            $post = new Post($data);
            $post->update();
            setSuccessResponse("Updated post successfully");
            break;
        }
        case 'DELETE':{
            include '../model/Post.php';
            $data = json_decode(file_get_contents("php://input", "r"));
            Post::delete($data->id);
            setSuccessResponse("Deleted product successfully");
            break;
        }
        case 'GET':{
            if (isset($_GET['id']) || isset($_GET['create']))
                include '../view/admin_post_detail_view.php';
            else
                include '../view/admin_post_list_view.php';
            break;
        }
        default:
            http_response_code(405);
            break;
    }
}
