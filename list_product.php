<?php
    require_once("./entities/product.class.php");
    require_once("./entities/category.class.php");
?>

<?php 
    include_once("header.php");

    if(!isset($_GET["cateid"])){
        $prods = Product::list_product();
    }else{
        $cateid = $_GET["cateid"];
        $prods = Product::list_product_by_cateid($cateid);
    }
    $cates = Category::list_category();
?>

<div class="container">
    <div class="col-lg-3 mb-3">
        <center>
            <h3 style="text-align:center; font-weight:bold; padding-bottom:20px; padding-top:10px">DANH MỤC</h3>
            <ul class="list-group">
                <?php
                    foreach($cates as $item){
                        ?>
                    <li style="width:70%" class="list-group-item">
                        <a href="<?php echo "?category=".$item["CategoryName"]."&cateid=".$item["CateID"]?>"><?php echo $item["CategoryName"]?></a>
                    </li>
                <?php }?>
            </ul>      
        </center>
    </div>

    <div class="col-lg-9 lbltitle">
        <h3 style="text-align:center; font-weight:bold; padding-bottom:20px; padding-top:10px">SẢN PHẨM MỚI</h3>
        <?php
            foreach($prods as $item){
        ?>
        <center>            
            <div style="height:450px" class="col-sm-6 md-6">
                <div class="card">
                    <img class="card-img-top" style="width:200px; height:200px" src="<?php echo $item["Picture"]?>" alt="<?php echo $item["ProductName"]?>">
                    <div class="card-body">
                        <h5 style="font-weight:bold;" class="card-title"><?php echo $item["ProductName"]?></h5>
                        <p class="card-text"><?php echo $item["Description"]?></p>
                        <p class="card-text">Giá: <?php echo $item["Price"]?> đồng</p>
                        <div class="submit" style="margin-top:10px; margin-bottom: 10px">
                            <a class="btn btn-success" type="submit" name="btnsubmit" onclick="location.href='/PHP_Lab3/shopping_cart.php?id=<?php echo $item["ProductID"]; ?>'"> Mua ngay </a>
                            <a class="btn btn-primary" type="submit" name="btnsubmit" href="./update_product.php?id=<?php echo $item["ProductID"]?>"> Chỉnh sửa </a>
                            <a class="btn btn-danger" type="submit" name="btnsubmit" href="./product_detail.php?id=<?php echo $item["ProductID"]?>"> Chi tiết </a>
                        </div>
                    </div>
                </div>                   
            </div>               
        </center>
        <?php }?>
    </div>
</div>
<?php include_once("footer.php");?>