<?php
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="lib\material-design-icons\css\material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="lib\datetimepicker\css\bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="css\app.css" type="text/css">
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>