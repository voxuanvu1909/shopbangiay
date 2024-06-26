<?php
    session_start();
    if(isset($_SESSION['user'])!="")
    {
        header("Location: index.php");
    }

    require_once("./entities/user.class.php");

    if (isset($_POST['btn-login']) && !empty($_POST['btn-login'])) {
        include_once("./config/db.class.php");
        $u_name = $_POST['txtname'];
        $u_pass = $_POST['txtpass'];
        
        if (!$u_name || !$u_pass) {
            echo "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu.";
            exit;
        }
        $result = User::checkLogin($u_name, $u_pass);

        if($result){
            $_SESSION['user'] = $u_name;
            echo "<h2>Xin chào " . $u_name . ". Bạn đã đăng nhập thành công.";
            header('location: index.php');
        }

    }
?>

<?php include_once("header.php"); ?>
<center>
    <form  method="post" style="width:50%">
        <div class="lbltitle">
            <h3 style="text-align:center; font-weight:bold; padding-bottom:20px; padding-top:10px">ĐĂNG NHẬP TÀI KHOẢN</h3>
        </div>
        <div class="form-group row">
            <label style="text-align: left; padding-top: 5px" for="txtname" class="col-sm-3 form-control-label">Tên đăng nhập: </label>
            <div class="col-sm-9">
                <input style="width:500px" type="text" class="form-control" name="txtname" placeholder="User name">
            </div>
        </div>
        <div class="form-group row">
            <label style="text-align: left; padding-top: 5px" for="txtpass" class="col-sm-3 form-control-label">Mật khẩu: </label>
            <div class="col-sm-9">
                <input style="width:500px" type="password" class="form-control" name="txtpass" placeholder="Password">
            </div>
        </div>
        <div class="form-group row">
            <div style="padding-left:80px" class="col-sm-7">
                <input class="btn btn-primary" type="submit" name="btn-login" value="Đăng nhập" />
            </div>
        </div>
    </form>
</center>

<?php include_once("footer.php"); ?>