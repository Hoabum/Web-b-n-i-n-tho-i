<?php
	
	if(isset($_POST['dangnhap_home'])) {
		$taikhoan = $_POST['email_login'];
		$matkhau = md5($_POST['password_login']);
		if($taikhoan=='' || $matkhau ==''){
			echo '<script>alert("Làm ơn không để trống")</script>';
		}else{
			$sql_select_admin = mysqli_query($mysqli,"SELECT * FROM tbl_khachhang WHERE email='$taikhoan' AND password='$matkhau' LIMIT 1");
			$count = mysqli_num_rows($sql_select_admin);
			$row_dangnhap = mysqli_fetch_array($sql_select_admin);
			if($count>0){
				$_SESSION['dangnhap_home'] = $row_dangnhap['name'];
				$_SESSION['khachang_id'] = $row_dangnhap['khachang_id'];
				
				header('Location: index.php?quanly=giohang');
			}else{
				echo '<script>alert("Tài khoản mật khẩu sai")</script>';
			}
		}
	}elseif(isset($_POST['dangky'])){
		$name = $_POST['name'];
	 	$sdt = $_POST['sdt'];
	 	$email = $_POST['email'];
	 	$password = md5($_POST['password']);
	 	$diachi = $_POST['diachi']; 
 		$sql_khachhang = mysqli_query($mysqli,"INSERT INTO tbl_khachhang(name,sdt,email,diachi,password) values ('$name','$sdt','$email','$diachi','$password')");
 		$sql_select_khachhang = mysqli_query($mysqli,"SELECT * FROM tbl_khachhang ORDER BY khachang_id DESC LIMIT 1");
 		$row_khachhang = mysqli_fetch_array($sql_select_khachhang);
 		$_SESSION['dangnhap_home'] = $name;
		$_SESSION['khachang_id'] = $row_khachhang['khachang_id'];
		
 		header('Location:index.php?quanly=giohang');
	}
    elseif(isset($_GET['dangxuat'])){
        $id = $_GET['dangxuat'];
        if($id==1){
            unset($_SESSION['dangnhap_home']);
        }
    }
?>

<header>
    <div class="logo">
        <a href="index.php">
            <img src="src/img/logo.png">
        </a>
    </div>
    <?php 

            $sql_category =mysqli_query($mysqli,'SELECT * FROM tbl_category ORDER BY category_id ASC');
        ?>

    <div class="menu">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php"
                    style="background: red; cursor: pointer;">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                    aria-expanded="false">Điện thoại</a>
                <ul class="dropdown-menu">
                    <?php
                            while($row_category= mysqli_fetch_array($sql_category)){
                                ?>
                    <li><a class="dropdown-item"
                            href="?quanly=danhmuc&id=<?php echo $row_category["category_id"]?>"><?php echo $row_category['category_name']?></a>
                    </li>
                    <?php
                            }
                        ?>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">All </a></li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link disabled" href="#" style=" cursor: pointer;">More</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" style=" cursor: pointer;">Contact</a>
            </li>
        </ul>
    </div>

    <div class="others" style="align-items: center;">

        <li>
            <form action="../webiphone/search.php" method="POST" style="    display: flex; height: 30px;">
                <input type="text" placeholder="Tìm kiếm " name="search_product"
                    style="border-bottom: 1px solid #333 ;">
                <button type="submit" name="search_button" style="border: none;"> <i class="fa fa-search"></i></button>

            </form>
        </li>
        <li>
            <a class="fas fa-sign-out-alt mr-2" href="" data-bs-toggle="modal" data-bs-target="#dangky"></a>
        </li>
        <li>
            <a class="fa fa-user" data-bs-toggle="modal" data-bs-target="#dangnhap" href=""></a>
        </li>
        <li>
            <a class="fa fa=shopping-bag" href=""></a>
        </li>
        <li style="display: flex;">
            <?php 
                if(isset($_SESSION['dangnhap_home'])){
                    echo '<p style="color:#000; width: 135px;">'.'<br><a href="index.php?dangxuat=1">Đăng xuất</a></p>';
                }else{
                    echo '<p style=" width: 135px;"></p>';
                }
                ?>
        </li>
    </div>
    <div class="modal fade" id="dangnhap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="padding-left: 177px; color: red;">
                    <h5 class="modal-title" id="exampleModalLabel">Đăng Nhập</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="post">
                        <div class="form-group">
                            <label class="col-form-label">Email</label>
                            <input type="text" class="form-control" placeholder=" " name="email_login" required="">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Mật khẩu</label>
                            <input type="password" class="form-control" placeholder=" " name="password_login"
                                required="">
                        </div>
                        <div class="right-w3l">
                            <input type="submit" class="form-control" name="dangnhap_home" value="Đăng nhập"
                                style="    margin-top: 30px; background: red; color: azure;">
                        </div>

                        <p class="text-center dont-do mt-3">Chưa có tài khoản?
                            <a href="" data-toggle="modal" data-target="#dangky">
                                Đăng ký</a>
                        </p>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="dangky" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="padding-left: 187px; color: red;">
                    <h5 class="modal-title">Đăng ký</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label class="col-form-label">Tên khách hàng</label>
                            <input type="text" class="form-control" placeholder=" " name="name" required="">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Email</label>
                            <input type="email" class="form-control" placeholder=" " name="email" required="">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Số Điện Thoại</label>
                            <input type="text" class="form-control" placeholder=" " name="sdt" required="">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Địa Chỉ</label>
                            <input type="text" class="form-control" placeholder=" " name="diachi" required="">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Password</label>
                            <input type="password" class="form-control" placeholder=" " name="password" required="">
                            <input type="hidden" class="form-control" placeholder="" name="HT_giaohang" value="0">
                        </div>

                        <div class="right-w3l" style="margin-top: 20px;">
                            <input type="submit" class="form-control" name="dangky" value="Đăng ký"
                                style="color: white;background: red;">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</header>