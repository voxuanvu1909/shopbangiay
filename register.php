<?php
    if(isset($_SESSION['user'])!="")
    {
        header("Location: login.php");
    }

    require_once("./entities/user.class.php");

    if(isset($_POST['btn-signup']))
    {
        $u_name = $_POST['txtname'];
        $u_email = $_POST['txtemail'];
        $u_pass = $_POST['txtpass'];

        if (!$u_name || !$u_email || !$u_pass) {
            echo "Vui lòng nhập đầy đủ thông tin đăng ký!";
            exit;
        }

        $account = User::makeNewWithParameter("$u_name", "$u_email", "$u_pass");
        $result = $account->save();

        if(!$result)
        {
            ?>
            <script>alert('Có lỗi xảy ra, vui lòng kiểm tra lại dữ liệu!');</script>
            <?php
        } else{
            $_SESSION['user'] = $u_name;
            header("Location: login.php");
        }
    }
?>

<?php include_once("header.php"); ?>
<center>
    <form action='register.php?do=register' method="post" style="width:50%">
        <div class="lbltitle">
            <h3 style="text-align:center; font-weight:bold; padding-bottom:20px; padding-top:10px">ĐĂNG KÝ TÀI KHOẢN</h3>
        </div>
        <div class="form-group row">
            <label style="text-align: left; padding-top: 5px" for="txtname" class="col-sm-3 form-control-label">Tên đăng nhập: </label>
            <div class="col-sm-9">
                <input style="width:500px" type="text" class="form-control" name="txtname" placeholder="User name">
            </div>
        </div>
        <div class="form-group row">
            <label style="text-align: left; padding-top: 5px" for="txtemail" class="col-sm-3 form-control-label">Email: </label>
            <div class="col-sm-9">
                <input style="width:500px" type="email" class="form-control" name="txtemail" placeholder="Email">
            </div>
        </div>
        <div class="form-group row">
            <label style="text-align: left; padding-top: 5px" for="txtpass" class="col-sm-3 form-control-label">Mật khẩu: </label>
            <div class="col-sm-9">
                <input style="width:500px" type="password" class="form-control" name="txtpass" placeholder="Password">
            </div>
        </div>
        <div class="form-group row">
            <div style="padding-left:60px" class="col-sm-7">
                <input class="btn btn-primary" type="submit" name="btn-signup" value="Đăng ký" />
            </div>
        </div>
    </form>
</center>

<?php include_once("footer.php"); ?>