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
               
                else{
                    include("include/banner.php"); 
                    include("include/category.php");
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
                        <li>
                            <button type="button" name="themgiohang" class="btn buy-btn" data-bs-toggle="modal"
                                style="color: #718096; " data-bs-target="#exampleModal">
                                <div class="shopee-cart-number-badge"
                                    style="background: red; width: 20px; height: 20px ; border-radius: 50%; margin-left: 25px;position: relative;top:5px;">
                                    <p style="position: absolute;top: -3px;left: 5px;color: white;">0</p>
                                </div>
                                <i class="fas fa-shopping-cart" style="color: #718096; "></i><br>Cart
                            </button>
                        </li>


                    </ul>
                </nav>
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
<script>

</script>

</html>