<?php
//edit user, can only edit password & isActive
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $post = User::getById($id);
}
include $_SERVER['DOCUMENT_ROOT'] . '/LayOut/header.php';
?>

</div>
</div>
</div>
</div>

</div>
</div>
</div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/LayOut/footer.php';
?>

