<?php error_reporting (E_ALL ^ E_NOTICE); ?>


<?php
    session_start();
    include_once('db/connect.php');
?>
<?php 
    if(isset($_GET['huyhang'])&&isset($_GET['magiaodich'])){
        $huyhang=$_GET['huyhang'];
        $magiaodich=$_GET['magiaodich'];
    }else{
        $huyhang='';
        $magiaodich='';
    }
    $sql_update_donhang = mysqli_query($mysqli,"UPDATE tbl_donhang SET huyhang='$huyhang' WHERE mahang='$magiaodich'");
    $sql_update_giaodich = mysqli_query($mysqli,"UPDATE tbl_giaodich SET huyhang='$huyhang' WHERE magiaodich='$magiaodich'");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF=8">
    <meta http=equiv="X=UA=Compatible" content="IE=edge">
    <meta name="viewport" content="width=device=width, initial=scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="src/Scss/reset.css">
    <link rel="stylesheet" href="src/Scss/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="dist/assets/owl.theme.default.min.css">


</head>

<body>
    <?php
    include('include/header.php');
    ?>
    <div class="container" id="donhang">
        <div class="container-fluid" style="    background: white;
    margin-top: 68px;">
            <div class="row">
                <div class="cartegory-top row" style="margin-top: 30px;">
                    <p>TRANG CHỦ &#8594; LỊCH SỬ ĐƠN HÀNG</p>
                    <p></p>
                    <p> </p>

                </div>

                <div class="col-md-12">
                    <h4>Liệt kê lịch sử đơn hàng</h4>
                    <?php
                if(isset($_GET['khachhang'])){
                    $id_khachhang = $_GET['khachhang'];
                }else{
                    $id_khachhang = '';
                }
                $sql_select = mysqli_query($mysqli,"SELECT * FROM tbl_giaodich WHERE tbl_giaodich.khachang_id='$id_khachhang' GROUP BY tbl_giaodich.magiaodich DESC"); 
                ?>
                    <table class="table table-bordered ">
                        <tr>
                            <th>Thứ tự</th>
                            <th>Mã giao dịch</th>
                            <th>Ngày đặt</th>
                            <th>Tình trạng</th>
                            <th>Quản lý</th>
                            <th>Yêu cầu</th>

                        </tr>
                        <?php
                    $i = 0;
                    while($row_donhang = mysqli_fetch_array($sql_select)){ 
                        $i++;
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>

                            <td><?php echo $row_donhang['magiaodich']; ?></td>

                            <td><?php echo $row_donhang['datetime'] ?></td>

                            <td><?php 
                            if($row_donhang['tinhtrang']==0 && $row_donhang['huyhang']==0 ){
                                echo 'Đã đặt hàng | Chờ xử lý';
                            }
                            else if($row_donhang['huyhang']==1){
                                echo 'Đang chờ hủy';
                            }
                            else if($row_donhang['huyhang']==2){
                                echo 'Đã hủy';
                            }
                            else{
                                echo 'Đã xử lý | Đang giao hàng';
                            }
                         ?></td>

                            <td><a
                                    href="?khachhang=<?php echo $_SESSION['khachang_id'] ?>&magiaodich=<?php  echo $row_donhang['magiaodich']  ?>">Xem
                                    chi tiết</a></td>

                            <td>
                                <?php 
                            if($row_donhang['huyhang']==0){
                            ?>
                                <a
                                    href="?khachhang=<?php echo $_SESSION['khachang_id'] ?>&magiaodich=<?php  echo $row_donhang['magiaodich'] ?>&huyhang=1">Huỷ
                                    đơn</a>
                                <?php
                            }elseif ($row_donhang['huyhang']==1) {
                             ?>
                                <p>Đang chờ huỷ...</p>
                                <?php
                            }else{
                                echo 'Đã huỷ';
                            } ?>

                            </td>
                        </tr>
                        <?php
                    } 
                    ?>
                    </table>
                </div>

                <div class="col-md-12">
                    <h4>Liệt kê lịch sử đơn hàng</h4>
                    <?php
                if(isset($_GET['magiaodich'])){
                    $magiaodich = $_GET['magiaodich'];
                }else{
                    $magiaodich = '';
                }
                $sql_select = mysqli_query($mysqli,"SELECT * FROM tbl_giaodich,tbl_khachhang,sanpham WHERE tbl_giaodich.sanpham_id=sanpham.sanpham_id AND tbl_khachhang.khachang_id=tbl_giaodich.khachang_id AND tbl_giaodich.magiaodich='$magiaodich' ORDER BY tbl_giaodich.giaodich_id DESC"); 
                ?>
                    <table class="table table-bordered ">
                        <tr>
                            <th>Thứ tự</th>
                            <th>Mã giao dịch</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Ngày đặt</th>

                        </tr>
                        <?php
                    $i = 0;
                    while($row_donhang = mysqli_fetch_array($sql_select)){ 
                        $i++;
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>

                            <td><?php echo $row_donhang['magiaodich']; ?></td>

                            <td><?php echo $row_donhang['sanpham_name']; ?></td>

                            <td><?php echo $row_donhang['soluong']; ?></td>

                            <td><?php echo $row_donhang['datetime'] ?></td>


                        </tr>
                        <?php
                    } 
                    ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="src/Js/main.js"></script>
<script src="src/Js/product.js"></script>
<script src="src/Js/imagezoom.js"></script>

</html>