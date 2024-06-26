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

    // session_start();
    error_reporting(E_ALL);
    ini_set('display_errors','1');
    if(isset($_GET["id"])){
        $pro_id = $_GET["id"];
        $was_found = false;
        $i = 0;
        if(!isset($_SESSION["cart_items"]) || count($_SESSION["cart_items"]) < 1){
            $_SESSION["cart_items"] = array(0=>array("pro_id"=>$pro_id,"quantity"=>1));
        }else{
            foreach($_SESSION["cart_items"] as $item){
                $i++;
                foreach($item as $key => $value){
                // while(list($key, $value) = each($item)){
                    if($key == "pro_id" && $value == $pro_id){
                        array_splice($_SESSION["cart_items"],$i-1,1,array(array("pro_id"=>$pro_id, "quantity"=>$item["quantity"]+1)));
                        $was_found = true;
                    }

                }
            }
            if($was_found == false){
                array_push($_SESSION["cart_items"],array("pro_id"=>$pro_id,"quantity"=>1));
            }
        }

        // header("location: shopping_cart.php");
    }
?>
<div class="container-fluid">
	<div class="row">
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

		<div style="padding-right:40px" class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
            <h3 style="text-align:center; font-weight:bold; padding-bottom:10px; padding-top:10px" class="panel-heading">CHI TIẾT GIỎ HÀNG</h3>
			<div class="row">
                <table class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $total_money = 0;
                            if(isset($_SESSION["cart_items"]) && count($_SESSION["cart_items"]) > 0){
                                foreach($_SESSION["cart_items"] as $item){
                                    $id = $item["pro_id"];
                                    $product = Product::get_product($id);
                                    $prod = reset($product);
                                    $total_money += $item["quantity"] * $prod["Price"];
                        ?>
                            <tr>
                                <td><a style="text-decoration: none;" href="product_detail.php?id=<?php echo $prod["ProductID"]?>"><?php echo $prod["ProductName"]?></a></td>
                                <td>
                                    <img style="width:100px; height:100px; margin: 10px;" src="<?php echo $prod["Picture"]?>" class="img-responsive" alt="Image">
                                </td>
                                <td><?php echo $item["quantity"]?></td>
                                <td><?php echo number_format($prod["Price"])?></td>
                                <td><?php echo number_format($item["quantity"]*$prod["Price"])?></td>
                                <td><a name="delete" onclick="return confirm('Bạn có chắc muốn xóa không?');" type="button" class="btn btn-danger mt-1 mb-1" href="delete_cart.php?id=<?php echo $item["pro_id"]?>">Xóa</a></td>
                            </tr>
                        <?php
                                }
                        ?>
                    <tr>
                        <td colspan=6>
                            <span style="width:100%" class="label label-danger"><b>Tổng tiền: <?php echo number_format($total_money)?> đồng</b></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=6>
                            <button onclick="location.href='list_product.php'" type="button" class="btn btn-primary">Tiếp tục mua hàng</button>
                            <button type="button" class="btn btn-success">Thanh toán</button>
                            <!-- <button onclick="location.href='delete_cart.php'" type="button" class="btn btn-danger">Xóa giỏ hàng</button> -->
                        </td>
                    </tr>
                    <?php
                        }else{
                            echo "<tr><td colspan='5'>Không có sản phẩm nào</td></tr>";
                        }
                    ?>
                    </tbody>
                </table>
			</div>
		</div>
	</div>
</div>

<?php include_once("footer.php");?>

<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        text-align: left;
        padding: 8px;
    }
</style>
