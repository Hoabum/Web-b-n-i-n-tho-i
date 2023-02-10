<?php
    session_start();
    include_once('db/connect.php')
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
    <link rel="stylesheet" href="src/Scss/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="dist/assets/owl.theme.default.min.css">


</head>

<body>
    <?php
        include("include/header.php");
        include("include/slider.php");
    ?>
    <main>
        <div class="container">
            <?php
            
            if(isset($_GET['quanly'])){
                $temp = $_GET['quanly'];
            }
            else{
                $temp ='';
            }

                if($temp== 'danhmuc'){
                     include("include/danhmuc.php");
                }
                else if($temp== 'chitietsp'){
                    include("include/product.php");
                }
            ?>
            <div class="row" style="margin-top:66px ;">
                <div class="col-lg-3 col-md-6">
                    <div class="single_shipping">
                        <div class="shipping_icone">
                            <img src="https://htmldemo.net/safira/safira/assets/img/about/shipping1.jpg" alt="">
                        </div>
                        <div class="shipping_content">
                            <h3>Free Ship Toàn Quốc</h3>
                            <p>Free ship đơn trên 100k</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single_shipping col_2">
                        <div class="shipping_icone">
                            <img src="https://htmldemo.net/safira/safira/assets/img/about/shipping2.jpg" alt="">
                        </div>
                        <div class="shipping_content">
                            <h3>Support 24/7</h3>
                            <p>Hỗ trợ 24/7</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single_shipping col_3">
                        <div class="shipping_icone">
                            <img src="https://htmldemo.net/safira/safira/assets/img/about/shipping3.jpg" alt="">
                        </div>
                        <div class="shipping_content">
                            <h3>Trả hàng trong 30 days</h3>
                            <p>Đổi trả trong vòng 30 days</p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single_shipping col_4">
                        <div class="shipping_icone">
                            <img src="https://htmldemo.net/safira/safira/assets/img/about/shipping4.jpg" alt="">
                        </div>
                        <div class="shipping_content">
                            <h3> Thanh toán nhanh chóng </h3>
                            <p>Thanh toán Payment</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="all-Product" style="margin-left: 100px;">
                <div class="row row-cols-2 row-all" style="margin-left: -21px;">
                    <?php
                        if(isset($_POST['search_button'])){

                        $tukhoa = $_POST['search_product'];
                        
                            
                        $sql_product = mysqli_query($mysqli,"SELECT * FROM sanpham WHERE sanpham_name LIKE '%$tukhoa%' OR sanpham_sales LIKE '%$tukhoa%' ORDER BY sanpham_id DESC");     

                        $title = $tukhoa;
                        }         
                    ?>
                    <?php
                        while($row_sanpham = mysqli_fetch_array($sql_product)){
                        ?>
                    <div class="col-md-auto sp" style="height: 407px;">
                        <p class="installment">Trả góp 0%</p>
                        <div>
                            <img src="img/<?php echo $row_sanpham['sanpham_img']?>" class="img-thumbnail" alt="...">
                            <p class="card-title-product" style="cursor: pointer;"> <a
                                    href="?quanly=chitietsp&id=<?php echo $row_sanpham['sanpham_id'] ?>"><?php echo $row_sanpham['sanpham_name']?></a>
                            </p>
                        </div>
                        <div class="flex inf">
                            <div>

                                <p class="price-product"> <?php echo $row_sanpham['sanpham_sales']?><sup>đ</sup></p>
                                <p class="real-price"><del> <?php echo $row_sanpham['sanpham_price']?></del><sup>đ</sup>
                                </p>
                            </div>
                            <div class="prepay">
                                <p class="title-prepay">Hoặc Trả trước</p>
                                <p class="price-prepay"> <?php echo $row_sanpham['sanpham_tratruoc']?><sup>đ</sup></p>
                            </div>
                        </div>
                        <div class="buy">
                            <p><a href="?quanly=chitietsp&id=<?php echo $row_sanpham['sanpham_id'] ?>">MUA NGAY</a></p>
                        </div>
                    </div>
                    <?php
                                    }
                            ?>
                </div>

                <div class="totop">
                    <i class="fas fa-angle-up"></i>
                </div>
                <div class="block-right">
                    <div class="rectangle">
                        <nav>
                            <ul>
                                <li><a href="index.html"><i class="fas fa-chevron-right"></i><i
                                            class="fas fa-chevron-right"></i></a></li>
                                <li class="bar"></li>
                                <li><a href=""><i class="fas fa-arrow-left"></i><br> Back</a></li>
                                <li><a href="donhang.php?khachhang=<?php echo $_SESSION['khachang_id']?>"><i
                                            class="fas fa-luggage-cart"></i><br>Đơn hàng</a>
                                </li>
                                <li><a href=""><i class="fas fa-shopping-cart"></i><br>Cart</a></li>

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <?php
            include("include/footer.php")
        ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

</body>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="src/Js/main.js"></script>
<script src="src/Js/product.js"></script>
<script src="src/Js/imagezoom.js"></script>

</html>