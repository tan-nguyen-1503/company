<?php
include '../util.php';
if (!isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']){
    http_response_code(403);
}
else {
    include '../view/admin_view.php';
}
?>
