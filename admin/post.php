<?php
require '../util.php';
if (!isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']){
    http_response_code(403);
} else {
    include '../model/Post.php';
    switch ($_SERVER['REQUEST_METHOD']){
        case 'POST':{
            if (!empty($_FILES['file'])){
                $imgName = $_FILES['file']['name'];
                $id = $_POST['id'];
                echo $id, $imgName;
                $extension = explode('.', $imgName);
                $extension = $extension[count($extension) - 1];
                if ($extension == 'jpg' || $extension = 'png' || $extension = 'gif'){
                    $imgName = md5($imgName) . '.' . $extension;
                    if (move_uploaded_file($_FILES['file']['tmp_name'], "../Public/images/post/" . $imgName)){
                        Post::uploadImage($imgName, $id);
                    } else {
                        badRequestResponse("Fail to upload file");
                    }
                } else {
                    badRequestResponse('Invalid file type');
                }
            } else {
                $data = json_decode(file_get_contents("php://input", "r"));
                $post = new Post($data);
                $post->create($_SESSION['userId']);
                global $conn;
                setSuccessResponse($conn->insert_id);
            }
            break;
        }
        case 'PUT': {
            $data = json_decode(file_get_contents("php://input", "r"));
            $post = new Post($data);
            $post->update();
            setSuccessResponse("Updated post successfully");
            break;
        }
        case 'DELETE':{
            $data = json_decode(file_get_contents("php://input", "r"));
            Post::delete($data->id);
            setSuccessResponse("Deleted post successfully");
            break;
        }
        case 'GET':{
            if (isset($_GET['id']))
                include '../view/admin_post_detail_view.php';
            if (isset($_GET['create']))
                include '../view/admin_post_create_view.php';
            else
                include '../view/admin_post_list_view.php';
            break;
        }
        default:
            http_response_code(405);
            break;
    }
}
