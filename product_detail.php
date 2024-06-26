<?php
 require_once("./entities/product.class.php");
 require_once("./entities/category.class.php");
?>

<?php
    include_once("header.php");

    if(!isset($_GET["id"])){
        header('Location: not_found.php');
    }else{
        $id =  $_GET["id"];
        $prod = Product::get_product($id);
        $prod = $prod[0];
        $prods_relate = Product::list_product_relate($prod["CateID"], $id);
    }
    $cates = Category::list_category();
?>

<?php $url = $_SERVER['HTTP_HOST']?>

<div style="padding-top:20px" class="container">
    <div class="col-sm-3">
        <center>
            <h3 style="text-align:center; font-weight:bold; padding-bottom:20px; padding-top:10px">DANH MỤC</h3>
            <ul class="list-group">
                <?php
                    foreach($cates as $item){
                        ?>
                    <li style="width:70%" class="list-group-item">
                        <a href="<?php echo "list_product.php?category=".$item["CategoryName"]."&cateid=".$item["CateID"]?>"><?php echo $item["CategoryName"]?></a>
                    </li>
                <?php }?>
            </ul>
        </center>
    </div>

    <div class="col-sm-9 panel panel-info">
        <h3 style="text-align:center; font-weight:bold; padding-bottom:10px; padding-top:10px" class="panel-heading">CHI TIẾT SẢN PHẨM</h3>
        <div class="row">
            <div style="padding-left:30px" class="col-sm-4">
                <img src="<?php echo "/PHP_Lab3/".$prod["Picture"];?>" class="img-reponsive" style="width:250px; height:250px; padding-top:10px" alt="Image">
            </div>

            <div class="col-sm-8">
                <div style="padding-right:10px; text-align:center">
                    <h3 class="text-info"><?php echo $prod["ProductName"]; ?></h3>
                    <p>Mô tả: <?php echo $prod["Description"];?></p>
                    <p>Giá: <?php echo $prod["Price"];?> đồng</p>
                    <p>
                        <a class="btn btn-success" type="submit" name="btnsubmit" onclick="location.href='/PHP_Lab3/shopping_cart.php?id=<?php echo $prod["ProductID"]; ?>'"> Mua ngay </a>
                        <a class="btn btn-danger" type="button" name="btnsubmit" onclick="location.href='/PHP_Lab3/delete_product.php?id=<?php echo $prod["ProductID"]; ?>'"> Xóa </a>
                    </p>
                </div>
            </div>
        </div>

        <h3 style="text-align:center; font-weight:bold; padding-bottom:10px; padding-top:10px" class="panel-heading">SẢN PHẨM LIÊN QUAN</h3>
        <div class="row">
            <?php
            foreach ($prods_relate as $item) {
            ?>
                <center>
                    <div class="col-sm-4">
                        <a href="/PHP_Lab3/product_detail.php?id=<?php echo $item["ProductID"]; ?>">
                            <img src="<?php echo "/PHP_Lab3/".$item["Picture"];?>" class="img-reponsive" style="width:200px; height:200px" alt="Image">
                        </a>
                        <p style="padding-top:10px" class="text-danger"><?php echo $item["ProductName"]; ?></p>
                        <p class="text-info"><?php echo $item["Price"]; ?> đồng</p>
                        <p ><button type="button" class="btn btn-success" onclick="location.href='/PHP_Lab3/product_detail.php?id=<?php echo $item["ProductID"]; ?>'">Chi tiết</button></p>
                    </div>
                </center>
            <?php } ?>
        </div>
    </div>
</div>

<?php include_once("footer.php");?>
