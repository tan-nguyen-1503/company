<?php
include 'LayOut/header.php';

$page = isset($page) ? $page = $_GET['page'] : 0;
$branch_list = Branch::getAllByPage($page, 10);
?>

<!--list all branches in contact page;-->
<img src="https://static.mservice.io/styles/desktop/images/linehe/house.svg" width="46" class="d-block mx-auto" alt="">
<div class="col-3 align-content-center">
    <?php
    foreach ($branch_list as $branch){
    ?>
        <h5 class="text-primary"><?php echo $branch->branch_name?></h5>
        <div><?php echo $branch->address ?></div>
        <div>Tel: <?php $branch->phone?></div>
        <div>Email: <?php $branch->email?></div>
        <hr>
    <?php } ?>
</div>

<?php
include 'LayOut/footer.php';
?>
