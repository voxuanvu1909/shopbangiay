<?php
    require_once("./entities/product.class.php");
    require_once("./entities/category.class.php");
    require_once("./config/db.class.php");

    if(!isset($_GET["id"])){
        header('Location: list_product.php');
    }
    else{
        $id = $_GET["id"];
        $prod = Product::get_product($id);
        $prod = $prod[0];
    }

    if(isset($_POST["btnsubmit"])){
        $productName = $_POST["txtName"];
        $cateID = $_POST["txtID"];
        $price = $_POST["txtprice"];
        $quantity = $_POST["txtquantity"];
        $description = $_POST["txtdesc"];
        $picture = $_FILES["txtpic"];

        $file_temp = $picture["tmp_name"];
        print_r($file_temp);
        $user_file = $picture["name"];
        $timestamp = date("Y").date("m").date("d").date("h").date("i").date("s");
        $filepath = "./images/".$timestamp.$user_file;
        if(move_uploaded_file($file_temp, $filepath) == false){
            return false;
        }
        
        $productID=intval($_GET['id']);
        $db = new Db();
        $connection = $db->connect();
        $sql="UPDATE product SET ProductName = ?, CateID = ?, Price = ?, Quantity = ?, Description = ?, Picture = ? WHERE ProductID = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param('sidissi', $productName, $cateID, $price, $quantity, $description, $filepath, $productID);
        $stmt->execute();
        header('Location: list_product.php');
    }

    $db = new Db();
    $sql = "SELECT * FROM category";
    $categories = $db->select_to_array($sql);
?>

<?php $url = $_SERVER['HTTP_HOST']?>
<?php include_once("header.php");?>

<div class="container">
    <div class="lbltitle">
        <h3 style="text-align:center; font-weight:bold; padding-bottom:20px; padding-top:10px">CẬP NHẬT SẢN PHẨM</h3>
    </div>

    <div class="col-sm-3">
        <div class="row">
            <div style="padding-right:50px" class="col-sm-4">
            <img src="<?php echo "/PHP_Lab3/".$prod["Picture"];?>" class="img-reponsive" style="width:250px; height:250px; padding-top:10px" alt="Image">
            </div>
        </div>
    </div>
    
    <div class="col-sm-9">
        <form action="" method="POST" enctype="multipart/form-data" style="width:800px">
            <?php
                if(isset($_GET["updated"])){
            ?>
                <div class="alert alert-success" style="margin-top:10px">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Cập nhật sản phẩm thành công!
                </div>
            <?php } ?>

            <?php
                if(isset($_GET["failture"])){
            ?>
                <div class="alert alert-danger" style="margin-top:10px">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Cập nhật sản phẩm thất bại!
                </div>
            <?php } ?>
          
            <div class="row">
                <div style="padding-top:5px; text-align:left; padding-left:40px" class="col-sm-3 lbltitle">
                    <label>Tên sản phẩm</label>
                </div>
                <div style="padding-bottom:10px" class="col-sm-9 lblinput">
                    <input class="form-control" type="text" name="txtName" value="<?php echo $prod["ProductName"]; ?>">
                </div>
            </div>

            <div class="row">
                <div style="padding-top:5px; text-align:left; padding-left:40px" class="col-sm-3 lbltitle">
                    <label>Danh mục sản phẩm</label>
                </div>
                <div style="padding-bottom:10px" class="col-sm-9 lblinput">
                    <select class="form-control"  name="txtID">
                        <option values = "" selected>----Chọn loại----</option>
                        <?php
                        foreach($categories as $category){
                        ?>
                            <option value="<?php echo $category["CateID"]?>"><?php echo $category['CategoryName']?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div style="padding-top:5px; text-align:left; padding-left:40px" class="col-sm-3 lbltitle">
                    <label>Mô tả sản phẩm</label>
                </div>
                <div style="padding-bottom:10px" class="col-sm-9 lblinput">
                    <textarea class="form-control"  name="txtdesc" rows="5" ><?php echo $prod['Description'];?></textarea>
                </div>
            </div>

            <div class="row">
                <div style="padding-top:5px; text-align:left; padding-left:40px" class="col-sm-3 lbltitle">
                    <label>Giá sản phẩm</label>
                </div>
                <div style="padding-bottom:10px" class="col-sm-9 lblinput">
                    <input class="form-control"  type="number" name="txtprice" value="<?php echo $prod['Price'];?>">
                </div>
            </div>

            <div class="row">
                <div style="padding-top:5px; text-align:left; padding-left:40px" class="col-sm-3 lbltitle">
                    <label>Số lượng sản phẩm</label>
                </div>
                <div style="padding-bottom:10px" class="col-sm-9 lblinput">
                    <input class="form-control"  type="number" name="txtquantity" value="<?php echo $prod['Quantity'];?>">
                </div>
            </div>

            <div class="row">
                <div style="padding-top:5px; text-align:left; padding-left:40px" class="col-sm-3 lbltitle">
                    <label>Hình ảnh sản phẩm</label>
                </div>
                <div style="padding-bottom:10px" class="col-sm-9 lblinput">
                    <input class="form-control" id="txtpic"  type="file" name="txtpic" accept=".PNG,.GIF,.JPG">
                </div>
            </div>
        
            <div class="submit" style="margin-top:10px; margin-bottom: 10px; align:center; padding-left:208px">
                <button class="btn btn-danger" type="submit" name="btnsubmit">Cập nhật</button>
            </div>
        </form>
    </div>
</div>

<?php include_once("footer.php");?>