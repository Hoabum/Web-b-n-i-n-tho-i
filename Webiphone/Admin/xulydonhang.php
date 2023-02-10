<?php
include('../db/connect.php'); 
session_start();

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
if(isset($_POST['capnhatdonhang'])){
	$xuly = $_POST['xuly'];
	$mahang = $_POST['mahang_xuly'];
	$sql_update_donhang = mysqli_query($mysqli,"UPDATE tbl_donhang SET tinhtrang='$xuly' WHERE mahang='$mahang'");
	$sql_update_giaodich = mysqli_query($mysqli,"UPDATE tbl_giaodich SET tinhtrang='$xuly' WHERE magiaodich='$mahang'");
}

?>
<?php
	if(isset($_GET['xoadonhang'])){
		$mahang = $_GET['xoadonhang'];
		$sql_delete = mysqli_query($mysqli,"DELETE FROM tbl_donhang WHERE mahang='$mahang'");
		header('Location:xulydonhang.php');
	} 
	if(isset($_GET['xacnhanhuy'])&& isset($_GET['mahang'])){
		$huyhang = $_GET['xacnhanhuy'];
		$magiaodich = $_GET['mahang'];
	}else{
		$huyhang = '';
		$magiaodich = '';
	}
	$sql_update_donhang = mysqli_query($mysqli,"UPDATE tbl_donhang SET huyhang='$huyhang' WHERE mahang='$magiaodich'");
	$sql_update_giaodich = mysqli_query($mysqli,"UPDATE tbl_giaodich SET huyhang='$huyhang' WHERE magiaodich='$magiaodich'");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Đơn Hàng</title>
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
            <div class="container-fluid">
                <div class="row">
                    <?php
			if(isset($_GET['quanly'])=='xemdonhang'){
				$mahang = $_GET['mahang'];
				$sql_chitiet = mysqli_query($mysqli,"SELECT * FROM tbl_donhang,sanpham WHERE tbl_donhang.sanpham_id=sanpham.sanpham_id AND tbl_donhang.mahang='$mahang'");
				?>
                    <div class="col-md-7">
                        <p>Xem chi tiết đơn hàng</p>
                        <form action="" method="POST">
                            <table class="table table-bordered ">
                                <tr>
                                    <th>Thứ tự</th>
                                    <th>Mã hàng</th>
                                    <th>Tên sản phẩm</th>

                                    <th>Số lượng</th>
                                    <th>Giá</th>
                                    <th>Tổng tiền</th>
                                    <th>Ngày đặt</th>


                                    <!-- <th>Quản lý</th> -->
                                </tr>
                                <?php
					$i = 0;
					while($row_donhang = mysqli_fetch_array($sql_chitiet)){ 
						$i++;
					?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row_donhang['mahang']; ?></td>

                                    <td><?php echo $row_donhang['sanpham_name']; ?></td>
                                    <td><?php echo $row_donhang['soluong']; ?></td>
                                    <td><?php echo $row_donhang['sanpham_sales']; ?></td>
                                    <td><?php echo number_format($row_donhang['soluong']*$row_donhang['sanpham_sales']).'vnđ'; ?>
                                    </td>

                                    <td><?php echo $row_donhang['datetime'] ?></td>
                                    <input type="hidden" name="mahang_xuly"
                                        value="<?php echo $row_donhang['mahang'] ?>">

                                    <!-- <td><a href="?xoa=<?php echo $row_donhang['donhang_id'] ?>">Xóa</a> || <a href="?quanly=xemdonhang&mahang=<?php echo $row_donhang['mahang'] ?>">Xem đơn hàng</a></td> -->
                                </tr>
                                <?php
					} 
					?>
                            </table>

                            <select class="form-control" name="xuly">
                                <option value="1">Đã xử lý | Giao hàng</option>
                                <option value="0">Chưa xử lý</option>
                            </select><br>

                            <input type="submit" value="Cập nhật đơn hàng" name="capnhatdonhang" class="btn btn-success"
                                style="background:red;color:white">
                        </form>
                    </div>
                    <?php
			}else{
				?>

                    <div class="col-md-7">
                        <p>Đơn hàng</p>
                    </div>
                    <?php
			} 
			
				?>
                    <div class="col-md-5">
                        <h4>Liệt kê đơn hàng</h4>
                        <?php
				$sql_select = mysqli_query($mysqli,"SELECT * FROM sanpham,tbl_khachhang,tbl_donhang WHERE tbl_donhang.sanpham_id=sanpham.sanpham_id AND tbl_donhang.khachang_id=tbl_khachhang.khachang_id GROUP BY mahang "); 
				?>
                        <table class="table table-bordered ">
                            <tr>
                                <th>Thứ tự</th>
                                <th>Mã hàng</th>
                                <th>Tình trạng đơn hàng</th>
                                <th>Tên khách hàng</th>
                                <th>Ngày đặt</th>
                                <th>Hủy đơn</th>
                                <th>Quản lý</th>
                            </tr>
                            <?php
					$i = 0;
					while($row_donhang = mysqli_fetch_array($sql_select)){ 
						$i++;
					?>
                            <tr>
                                <td><?php echo $i; ?></td>

                                <td><?php echo $row_donhang['mahang']; ?></td>
                                <td><?php
							if($row_donhang['tinhtrang']==0 ){
								echo 'Chưa xử lý';
							}
                            else{
								echo 'Đã xử lý';
							}
						?></td>
                                <td><?php echo $row_donhang['name']; ?></td>

                                <td><?php echo $row_donhang['datetime'] ?></td>
                                <td><?php if($row_donhang['huyhang']==0){ }elseif($row_donhang['huyhang']==1){
							echo '<a href="xulydonhang.php?quanly=xemdonhang&mahang='.$row_donhang['mahang'].'&xacnhanhuy=2">Xác nhận hủy đơn</a>';
						}else{
							echo 'Đã hủy';
						} 
						?></td>

                                <td><a href="?xoadonhang=<?php echo $row_donhang['mahang'] ?>">Xóa</a> || <a
                                        href="?quanly=xemdonhang&mahang=<?php echo $row_donhang['mahang'] ?>">Xem </a>
                                </td>
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