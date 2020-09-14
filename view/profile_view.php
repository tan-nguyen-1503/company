<?php
include 'LayOut/header.php';

include 'model/User.php';
$user = User::getById($_SESSION['userId']);
?>

<!--2 form, 1 form to update information, 1 form to change password-->

<?php
include 'LayOut/footer.php';
?>
