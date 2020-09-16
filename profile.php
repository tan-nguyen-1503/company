<?php
require 'util.php';
$userId = $_SESSION['userId'];
if (!isset($userId)){
    http_response_code(401);
    header("Location: login.php");
}
else{
    include 'model/User.php';
    switch ($_SERVER['REQUEST_METHOD']){
        case 'GET':
            include 'view/profile_view.php';
            break;
        case 'POST':{
            // change data;
            if (!empty($_FILES['file'])){
                $imgName = $_FILES['file']['name'];
                $extension = explode('.', $imgName);
                $extension = $extension[count($extension) - 1];
                if ($extension == 'jpg' || $extension = 'png' || $extension = 'gif'){
                    $imgName = md5($imgName) . $extension;
                    if (move_uploaded_file($_FILES['file']['tmp_name'], "Public/images/user-images/" . $imgName)){
                        User::updateAvatar($imgName, $userId);
                        echo $imgName;
                    } else {
                        badRequestResponse("Fail to upload file");
                    }
                } else {
                    badRequestResponse('Invalid file type');
                }
            } else {
                $data = json_decode(file_get_contents("php://input", "r"));
                $user = new User($data);
                $user->id = $userId;
                $user->update();
                setSuccessResponse("Update profile successfully");
            }
            break;
        }
        case 'PUT':{
            //change password
            $data = json_decode(file_get_contents("php://input", "r"));
            $user = User::getById($userId);
            if ($user->checkOldPassword($data->oldPassword)){
                $user->validatePassword($data->password, $data->confirmPassword);
                $user->changePassword($data->password);
                setSuccessResponse("Changed password successfully");
            } else {
                badRequestResponse("Wrong old password");
            }
            break;
        }
        default:
            http_response_code(405);
            break;
    }
}
?>
