<?php
session_start();
include('../db/connect.php'); 

if(!isset($_SESSION['dangnhap'])){
    header('Location: index.php');
}
if(isset($_GET['login'])){
    $dangxuat= $_GET['login'];
}else{
    $dangxuat='';
}

if($dangxuat=='dangxuat'){
    session_destroy();
    header('Location: index.php');
}

?>
<?php
	if(isset($_POST['themsanpham'])){
		$tensanpham = $_POST['tensanpham'];
		$hinhanh = $_FILES['hinhanh']['name'];
		$mau =$_POST['mau'];
        $tratruoc =$_POST['tratruoc'];
		$soluong = $_POST['soluong'];
		$gia = $_POST['giasanpham'];
		$giakhuyenmai = $_POST['giakhuyenmai'];
		$danhmuc = $_POST['danhmuc'];
		$chitiet = $_POST['chitiet'];
		$mota = $_POST['mota'];
		$path = '../img/';
		
		$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
		$sql_insert_product = mysqli_query($mysqli,"INSERT INTO sanpham(sanpham_name,sanpham_chitiet,sanpham_mota,sanpham_price,sanpham_sales,sanpham_soluong,mau_sp,sanpham_tratruoc,sanpham_img,category_id) values ('$tensanpham','$chitiet','$mota','$gia','$giakhuyenmai','$soluong','$mau','$tratruoc','$hinhanh','$danhmuc')");
		move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
	}elseif(isset($_POST['capnhatsanpham'])) {
		$id_update = $_POST['id_update'];
		$tensanpham = $_POST['tensanpham'];
		$hinhanh = $_FILES['hinhanh']['name'];
		$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
		$soluong = $_POST['soluong'];
        $mau =$_POST['mau'];
        $tratruoc =$_POST['tratruoc'];
		$gia = $_POST['giasanpham'];
		$giakhuyenmai = $_POST['giakhuyenmai'];
		$danhmuc = $_POST['danhmuc'];
		$chitiet = $_POST['chitiet'];
		$mota = $_POST['mota'];
		$path = '../img/';
		if($hinhanh==''){
			$sql_update_image = "UPDATE sanpham SET sanpham_name='$tensanpham',sanpham_chitiet='$chitiet',sanpham_mota='$mota',sanpham_price='$gia',sanpham_sales='$giakhuyenmai',sanpham_soluong='$soluong',mau_sp='$mau',sanpham_tratruoc='$tratruoc',category_id='$danhmuc' WHERE sanpham_id='$id_update'";
		}else{
			move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
			$sql_update_image = "UPDATE sanpham SET sanpham_name='$tensanpham',sanpham_chitiet='$chitiet',sanpham_mota='$mota',sanpham_price='$gia',sanpham_sales='$giakhuyenmai',sanpham_soluong='$soluong',mau_sp='$mau',sanpham_tratruoc='$tratruoc',sanpham_img='$hinhanh',category_id='$danhmuc' WHERE sanpham_id='$id_update'";
		}
		mysqli_query($mysqli,$sql_update_image);
	}
	
?>
<?php
	if(isset($_GET['xoa'])){
		$id= $_GET['xoa'];
		$sql_xoa = mysqli_query($mysqli,"DELETE FROM sanpham WHERE sanpham_id='$id'");
	} 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Sản Phẩm</title>
    <link rel="stylesheet" type="text/css" href="lib\material-design-icons\css\material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="lib\datetimepicker\css\bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="css\app.css" type="text/css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    a {
        text-decoration: none;
    }

    ul,
    li {
        list-style: none;
    }

    input {
        border: none;
        outline: none;
    }
    </style>
</head>

<body>
    <div class="be-wrapper be-fixed-sidebar">
        <nav class="navbar navbar-expand fixed-top be-top-header">
            <div class="container-fluid">
                <div class="be-navbar-header">
                    <a class="navbar-brand" href="index.html"></a>
                </div>
                <div class="page-title"> <?php echo $_SESSION['dangnhap']?> <a href="?login=dangxuat"> Đăng xuất</a>
                </div>
                <div class="be-right-navbar">
                    <ul class="nav navbar-nav float-right be-user-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button"
                                aria-expanded="false"><img src="images/avatar.png" alt="Avatar"><span
                                    class="user-name"></span></a>

                        </li>
                    </ul>
                    <ul class="nav navbar-nav float-right be-icons-nav">
                        <li class="nav-item dropdown"><a class="nav-link be-toggle-right-sidebar" href="#" role="button"
                                aria-expanded="false"><span class="icon mdi mdi-settings"></span></a></li>
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#"
                                data-toggle="dropdown" role="button" aria-expanded="false"><span
                                    class="icon mdi mdi-notifications"></span><span class="indicator"></span></a>

                        </li>
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#"
                                data-toggle="dropdown" role="button" aria-expanded="false"><span
                                    class="icon mdi mdi-apps"></span></a>

                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="be-left-sidebar">
            <div class="left-sidebar-wrapper"><a class="left-sidebar-toggle" href="#"></a>
                <div class="left-sidebar-spacer">
                    <div class="left-sidebar-scroll">
                        <div class="left-sidebar-content">

                            <ul class="sidebar-elements ">
                                <li class="divider" style="    font-size: 19px;">Menu</li>
                                <li class="active"><a href="xulydonhang.php"><i class=""></i><span
                                            style="margin-left: 15px;   font-size: 15px;">Đơn
                                            hàng</span></a>
                                </li>
                                <li class="active"><a href="xulydanhmuc.php"><i class=""></i><span
                                            style=" margin-left: 15px;   font-size: 15px;">Danh
                                            Mục
                                        </span></a>
                                </li>
                                <li class="active"><a href="xulysanpham.php"><i class=""></i><span
                                            style="   margin-left: 15px; font-size: 15px;">Sản
                                            Phẩm
                                        </span></a>
                                </li>
                                <li class="active"><a href="xulykhachhang.php"><i class=""></i><span
                                            style="   margin-left: 15px; font-size: 15px;">Khách Hàng
                                        </span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="container">
                <div class="row" style="margin:30px 0px;">
                    <?php
			if(isset($_GET['quanly'])=='capnhat'){
				$id_capnhat = $_GET['capnhat_id'];
				$sql_capnhat = mysqli_query($mysqli,"SELECT * FROM sanpham WHERE sanpham_id='$id_capnhat'");
				$row_capnhat = mysqli_fetch_array($sql_capnhat);
				$id_category_1 = $row_capnhat['category_id'];
				?>
                    <div class="col-md-4">
                        <h4>Cập nhật sản phẩm</h4>

                        <form action="" method="POST" enctype="multipart/form-data">
                            <label>Tên sản phẩm</label>
                            <input type="text" class="form-control" name="tensanpham"
                                value="<?php echo $row_capnhat['sanpham_name'] ?>"><br>
                            <input type="hidden" class="form-control" name="id_update"
                                value="<?php echo $row_capnhat['sanpham_id'] ?>">
                            <label>Hình ảnh</label>
                            <input type="file" class="form-control" name="hinhanh"><br>
                            <img src="../img/<?php echo $row_capnhat['sanpham_img'] ?>" height="80" width="80"><br>
                            <label>Giá</label>
                            <input type="text" class="form-control" name="giasanpham"
                                value="<?php echo $row_capnhat['sanpham_price'] ?>"><br>
                            <label>Giá khuyến mãi</label>
                            <input type="text" class="form-control" name="giakhuyenmai"
                                value="<?php echo $row_capnhat['sanpham_sales'] ?>"><br>
                            <label>Số lượng</label>
                            <input type="text" class="form-control" name="soluong"
                                value="<?php echo $row_capnhat['sanpham_soluong'] ?>"><br>
                            <label>Màu</label>
                            <input type="text" class="form-control" name="mau"
                                value="<?php echo $row_capnhat['mau_sp'] ?>"><br>
                            <label>Trả trước</label>
                            <input type="text" class="form-control" name="tratruoc"
                                value="<?php echo $row_capnhat['sanpham_tratruoc'] ?>"><br>
                            <label>Bảo Hành</label>
                            <textarea class="form-control" rows="10"
                                name="mota"><?php echo $row_capnhat['sanpham_mota'] ?></textarea><br>
                            <label>Chi tiết</label>
                            <textarea class="form-control" rows="10"
                                name="chitiet"><?php echo $row_capnhat['sanpham_chitiet'] ?></textarea><br>
                            <label>Danh mục</label>
                            <?php
					$sql_danhmuc = mysqli_query($mysqli,"SELECT * FROM tbl_category ORDER BY category_id DESC"); 
					?>
                            <select name="danhmuc" class="form-control">
                                <option value="0">-----Chọn danh mục-----</option>
                                <?php
						while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
							if($id_category_1==$row_danhmuc['category_id']){
						?>
                                <option selected value="<?php echo $row_danhmuc['category_id'] ?>">
                                    <?php echo $row_danhmuc['category_name'] ?></option>
                                <?php 
							}else{
						?>
                                <option value="<?php echo $row_danhmuc['category_id'] ?>">
                                    <?php echo $row_danhmuc['category_name'] ?></option>
                                <?php
							}
						}
						?>
                            </select><br>
                            <input type="submit" name="capnhatsanpham" style="background:red;color:white"
                                value="Cập nhật sản phẩm" class="btn btn-default">
                        </form>
                    </div>
                    <?php
			}else{
				?>
                    <div class="col-md-4">
                        <h4>Thêm sản phẩm</h4>

                        <form action="" method="POST" enctype="multipart/form-data">
                            <label>Tên sản phẩm</label>
                            <input type="text" class="form-control" name="tensanpham" placeholder="Tên sản phẩm"><br>
                            <label>Hình ảnh</label>
                            <input type="file" class="form-control" name="hinhanh"><br>
                            <label>Giá</label>
                            <input type="text" class="form-control" name="giasanpham" placeholder="Giá sản phẩm"><br>
                            <label>Giá khuyến mãi</label>
                            <input type="text" class="form-control" name="giakhuyenmai"
                                placeholder="Giá khuyến mãi"><br>
                            <label>Số lượng</label>
                            <input type="text" class="form-control" name="soluong" placeholder="Số lượng"><br>
                            <label>Màu</label>
                            <input type="text" class="form-control" name="mau" placeholder="Màu"><br>
                            <label>Trả trước</label>
                            <input type="text" class="form-control" name="tratruoc" placeholder="Trả trước"><br>
                            <label>Bảo hành</label>
                            <textarea class="form-control" name="mota"></textarea><br>
                            <label>Chi tiết</label>
                            <textarea class="form-control" name="chitiet"></textarea><br>
                            <label>Danh mục</label>
                            <?php
					$sql_danhmuc = mysqli_query($mysqli,"SELECT * FROM tbl_category ORDER BY category_id DESC"); 
					?>
                            <select name="danhmuc" class="form-control">
                                <option value="0">-----Chọn danh mục-----</option>
                                <?php
						while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
						?>
                                <option value="<?php echo $row_danhmuc['category_id'] ?>">
                                    <?php echo $row_danhmuc['category_name'] ?></option>
                                <?php 
						}
						?>
                            </select><br>
                            <input type="submit" name="themsanpham" style="background:red;color:white"
                                value="Thêm sản phẩm" class="btn btn-default">
                        </form>
                    </div>
                    <?php
			} 
			
				?>
                    <div class="col-md-8">
                        <h4>Liệt kê sản phẩm</h4>
                        <?php
				$sql_select_sp = mysqli_query($mysqli,"SELECT * FROM sanpham,tbl_category WHERE sanpham.category_id=tbl_category.category_id ORDER BY sanpham.sanpham_id DESC"); 
				?>
                        <table class="table table-bordered ">
                            <tr>
                                <th>Thứ tự</th>
                                <th>Tên sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Số lượng</th>
                                <th>Màu sản phẩm</th>
                                <th>Trả trước</th>
                                <th>Danh mục</th>
                                <th>Giá sản phẩm</th>
                                <th>Giá khuyến mãi</th>
                                <th>Quản lý</th>
                            </tr>
                            <?php
					$i = 0;
					while($row_sp = mysqli_fetch_array($sql_select_sp)){ 
						$i++;
					?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $row_sp['sanpham_name'] ?></td>
                                <td><img src="../img/<?php echo $row_sp['sanpham_img'] ?>" height="100" width="80"></td>
                                <td><?php echo $row_sp['sanpham_soluong'] ?></td>
                                <td><?php echo $row_sp['mau_sp'] ?></td>
                                <td><?php echo $row_sp['sanpham_tratruoc'] ?></td>
                                <td><?php echo $row_sp['category_name'] ?></td>
                                <td><?php echo number_format($row_sp['sanpham_price']) ?></td>
                                <td><?php echo number_format($row_sp['sanpham_sales']) ?></td>
                                <td><a href="?xoa=<?php echo $row_sp['sanpham_id'] ?>">Xóa</a> || <a
                                        href="xulysanpham.php?quanly=capnhat&capnhat_id=<?php echo $row_sp['sanpham_id'] ?>">Cập
                                        nhật</a></td>
                            </tr>
                            <?php
					} 
					?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>