<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link rel="stylesheet" href="site.css" /> -->
        
        <!-- Latest compiled and minified CSS & JS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        
        <title>Project training - website bán hàng</title>
    </head>

    <body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">Online Store</a>
                </div>

                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="./list_product.php">Danh sách sản phẩm</a></li>
                    <li><a href="./add_product.php">Thêm sản phẩm</a></li>
                </ul>

                <form class="navbar-form navbar-left" action="/action_page.php">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Nhập từ khóa" name="search">
                    </div>
                    <button type="submit" class="btn btn-default">Tìm kiếm</button>
                </form>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="./shopping_cart.php"> <img style="width: 22px" src="/PHP_Lab3/images/shopping_cart.png" alt="Image"> Giỏ hàng</a></li>
                    <!-- <li><a href="./register.php"><span class="glyphicon glyphicon-user"></span> Đăng ký</a></li> -->
                    <!-- <li><a href="./login.php"><span class="glyphicon glyphicon-log-in"></span> Đăng nhập</a></li> -->
                    <li>
                        <?php
                            session_start();
                            if(isset($_SESSION['user'])!="")
                            {
                                echo "<li style='padding-top:9px'><h5 style='color:white'>Xin chào ".$_SESSION['user']."<a style='padding-right:5px' href='/PHP_Lab3/logout.php'> Đăng xuất </a></h5></li>";
                            } else{
                                echo "<li><a href='/PHP_Lab3/register.php'><span class='glyphicon glyphicon-user'></span>Đăng ký</a></li><li><a href='/PHP_Lab3/login.php'><span class='glyphicon glyphicon-log-in'></span>Đăng nhập</a></li>";
                            }
                        ?>
                    </li>
                </ul>
            </div>
        </nav>

        <div style="width:100%" class="container">  
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="./images/bannera.jpg" style="width:100%; height:350px">
                    </div>
                    <div class="item">
                        <img src="./images/bannerb.jpg" style="width:100%; height:350px">
                    </div>               
                    <div class="item">
                        <img src="./images/bannerc.jpg" style="width:100%; height:350px">
                    </div>
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </body>
</html>
