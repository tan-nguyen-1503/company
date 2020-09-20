<?php
include $_SERVER['DOCUMENT_ROOT'] . '/LayOut/header.php';
include_once "../LayOut/leftContentAccess.php";
$user_list = User::getByPage(0, 100);
?>

<div class="col-12 col-md-8 col-lg-9" style="background-color: #F4F4F3;">
    <div class="shop_post_area mt-2">
        <div class="row">
            <div class="col-12 d-none d-md-block">
                <div class="post-topbar d-flex align-items-center justify-content-between">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" style="width: 100%; text-align: center">
                <div class="item owl-carousel owl-theme">
                    <table style="width: 100%; margin-bottom: 60px;" border="1" >
                        <tr>
                            <td style="width: 10%; font-weight: 600;">Id</td>
                            <td style="width: 20%; font-weight: 600;">Name</td>
                            <td style="width: 20%; font-weight: 600;">Email</td>
                            <td style="width: 20%; font-weight: 600;">Is Admin</td>
                            <td style="width: 20%; font-weight: 600;">Is Active</td>
                        </tr>

                        <?php foreach ($user_list as $user){
                            ?>

                            <tr>
                                <td><?php echo $user->id?></td>
                                <td><a href="user.php?id=<?php echo $user->id?>"><?php echo $user->name?></td>
                                <td><?php echo $user->email ?></td>
                                <td><?php echo $user->is_admin ?></td>
                                <td><?php echo $user->is_active ?></td>
                            </tr>
                            <?php
                        }?>

                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
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
