<?php error_reporting (E_ALL ^ E_NOTICE); ?>

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
    if(isset($_POST['themdanhmuc'])){
		$tendanhmuc = $_POST['danhmuc'];
		$sql_insert = mysqli_query($mysqli,"INSERT INTO tbl_category(category_name) values ('$tendanhmuc')");
	}elseif(isset($_POST['capnhatdanhmuc'])){
		$id_post = $_POST['id_danhmuc'];
		$tendanhmuc = $_POST['danhmuc'];
		$sql_update = mysqli_query($mysqli,"UPDATE tbl_category SET category_name='$tendanhmuc' WHERE category_id='$id_post'");
		header('Location:xulydanhmuc.php');
	}
	if(isset($_GET['xoa'])){
		$id= $_GET['xoa'];
		$sql_xoa = mysqli_query($mysqli,"DELETE FROM tbl_category WHERE category_id='$id'");
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
    <title>Danh mục</title>
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
            <div class="be-content">
                <div class="main-content container-fluid">
                    <div class="container">
                        <div class="row">
                            <?php 
                if(isset($_GET['quanly'])=='capnhat'){
                    $id_capnhat = $_GET['id'];
                    $sql_capnhat = mysqli_query($mysqli,"SELECT * FROM tbl_category WHERE category_id='$id_capnhat'");
                    $row_capnhat = mysqli_fetch_array($sql_capnhat);
                ?>
                            <div class="col-md-4">
                                <h4>Cập nhật danh mục</h4>
                                <label>Tên danh mục</label>
                                <form action="" method="POST">
                                    <input type="text" class="form-control" name="danhmuc"
                                        value="<?php echo $row_capnhat['category_name'] ?>"><br>
                                    <input type="hidden" class="form-control" name="id_danhmuc"
                                        value="<?php echo $row_capnhat['category_id'] ?>">

                                    <input type="submit" name="capnhatdanhmuc" value="Cập nhật danh mục"
                                        class="btn btn-default" style="background:red;color:white">
                                </form>
                            </div>
                            <?php
                }
                else{
                    ?>
                            <div class="col-md-4">
                                <h4>Thêm danh mục </h4>
                                <form action="" method="POST">
                                    <input type="text" class="form-control" name="danhmuc"
                                        placeholder="Tên danh mục"><br>
                                    <input type="submit" name="themdanhmuc" value="Thêm danh mục"
                                        class="btn btn-default" style="background:red;color:white">
                                </form>
                            </div>
                            <?php
                }
                ?>
                            <div class="col-md-8">
                                <h4>Liệt kê danh mục</h4>
                                <?php
				$sql_select = mysqli_query($mysqli,"SELECT * FROM tbl_category ORDER BY category_id DESC"); 
				?>
                                <table class="table table-bordered ">
                                    <tr>
                                        <th>Thứ tự</th>
                                        <th>Tên danh mục</th>
                                        <th>Quản lý</th>
                                    </tr>
                                    <?php
					
					while($row_category = mysqli_fetch_array($sql_select)){ 
						$i++;
					?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row_category['category_name'] ?></td>
                                        <td><a href="?xoa=<?php echo $row_category['category_id'] ?>">Xóa</a> || <a
                                                href="?quanly=capnhat&id=<?php echo $row_category['category_id'] ?>">Cập
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
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>