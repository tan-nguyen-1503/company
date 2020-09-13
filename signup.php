<?php
require 'util.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    include_once './model/User.php';
    $data = json_decode(file_get_contents("php://input", "r"));
    $user = new User($data);
    $user->validatePassword($data->password, $data->confirmPassword);
    $user->create();
    $_SESSION['userId'] = $conn->insert_id;
    setSuccessResponse("Created user successfully");
} else {
    require './LayOut/header.php';
    require "./view/singup_view.php";
    require './LayOut/footer.php';
}
?>
