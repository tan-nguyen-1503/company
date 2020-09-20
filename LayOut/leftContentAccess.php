<div class="container " style="height: 100% ; padding-bottom: 50px">
    <div class="row mt-2">
        <div class="col-12 col-md-4 col-lg-3" style="background-color: #F4F4F3; margin-bottom: 50px">
            <div class="shop_sidebar_area">
                <div class="catagory mt-2">
                    <!-- Title -->
                    <!-- <h5 class="title">DANH MỤC SẢN PHẨM</h5> -->
                    <!--  Catagories  -->
                    <div class="catagories-menu">
                        <ul id="menu-content2" class="menu-content collapse show">
                            <!-- Single Item -->
                            <li data-toggle="collapse" data-target="#users">
                                <a href="user.php" id="user-icon"><b style="margin-left: 10px;">User</b></a>
                                <ul class="sub-menu collapse show" id="users">
                                    <li><a href="user.php">Edit user</a></li>
                                </ul>
                            </li>

                            <!-- Single Item -->
                            <li data-toggle="collapse" data-target="#product">
                                <a href="product.php" id="product-icon"><b style="margin-left: 10px;">Product</b></a>
                                <ul class="sub-menu collapse show" id="product">
                                    <li><a href="product.php?create">Add new product</a></li>
                                    <li><a href="product.php">Edit product</a></li>
                                </ul>
                            </li>

                            <!-- Single Item -->
                            <li data-toggle="collapse" data-target="#news">
                                <a href="#" id="news-icon"><b style="margin-left: 10px;">Post</b></a>
                                <ul class="sub-menu collapse show" id="news">
                                    <li><a href="post.php?create">Add a post</a></li>
                                    <li><a href=post.php#">Edit post</a></li>
                                </ul>
                            </li>

                            <!-- Single Item -->
                            <li data-toggle="collapse" data-target="#category">
                                <a href="#" id="category-icon"><b style="margin-left: 10px;">Category</b></a>
                                <ul class="sub-menu collapse show" id="category">
                                    <li><a href="category.php?create">Add category</a></li>
                                    <li><a href="category.php">Edit category</a></li>
                                </ul>
                            </li>

                            <!-- Single Item -->
                            <li data-toggle="collapse" data-target="#about">
                                <a href="#" id="about-icon"><b style="margin-left: 10px;">About us</b></a>
                                <ul class="sub-menu collapse show" id="about">
                                    <li>
                                        <a href="about-us.php">Edit</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <hr />
                </div>
            </div>
        </div>

        <style type="text/css"> @import url("../Public/summernote-0.8.18-dist/summernote-bs4.min.css"); </style>
        <script src="../Public/summernote-0.8.18-dist/summernote-bs4.min.js"></script>

        <div class="col-12 col-md-8 col-lg-9" style="background-color: white;">
            <div class="shop_product_area mt-2">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="item owl-carousel owl-theme">
                            <div class="create-product">
