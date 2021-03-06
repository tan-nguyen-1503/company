<?php
include 'LayOut/header.php';

$page = isset($page) ? $page = $_GET['page'] : 0;
$branch_list = Branch::getAllByPage($page, 10);
?>

<!--list all branches in contact page;-->
<div class="col-8 align-content-center" style="margin-left: 100px">
<img src="https://static.mservice.io/styles/desktop/images/linehe/house.svg" width="46" class="d-block" alt="">
<div class="mt-5">
    <?php
    foreach ($branch_list as $branch){
    ?>
        <h5 class="text-primary"><?php echo $branch->branch_name?></h5>
        <div><?php echo $branch->address ?></div>
        <div>Tel: <?php echo $branch->phone?></div>
        <div>Email: <?php echo $branch->email?></div>
        <hr>
    <?php } ?>
</div>
</div>

<?php
include 'LayOut/footer.php';
?>
