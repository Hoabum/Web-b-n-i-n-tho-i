<?php error_reporting (E_ALL ^ E_NOTICE); ?>
<?php 
  $user= trim($_POST['user']);
?>

<?php 
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    else{
        $id='';
    }
    $sql_chitiet= mysqli_query($mysqli, "SELECT * FROM sanpham WHERE sanpham_id ='$id'");
    
?>

<?php
    if(isset($_POST['themgiohang'])){
        
        $sanpham_id	= $_POST["sanpham_id"];
        $tensanpham = $_POST["tensanpham"];
        $giasanpham = $_POST["giasanpham"];
        $giaSales = $_POST["giaSales"];
        $soluong= $_POST["soluong"];
        $img = $_POST["img"];
        $mau = $_POST["mau"];
        
       
        $sql_select_giohang = mysqli_query($mysqli,"SELECT * FROM tbl_giohang WHERE sanpham_id = '$sanpham_id'");
        $count = mysqli_num_rows(($sql_select_giohang));
        if($count >0){
            $row_sanphamm= mysqli_fetch_array($sql_select_giohang);
            $soluong = $row_sanphamm['soluong']+1;
            $sql_giohang ="UPDATE tbl_giohang SET soluong ='$soluong' WHERE sanpham_id = '$sanpham_id'";
        }
        else{
            $soluong= $soluong;
            $sql_giohang ="INSERT INTO tbl_giohang(sanpham_id,tensanpham,giasanpham,giaSales,img,soluong,mau) value ('$sanpham_id',
            '$tensanpham','$giasanpham','$giaSales','$img','$soluong','$mau')";
        }
        $insert_row= mysqli_query($mysqli,$sql_giohang);
       
    }
    else if(isset($_POST['capnhatsoluong'])){
       
        for($i=0;$i<count($_POST['product_id']); $i++){
            $sanpham_id = $_POST['product_id'][$i];
            $soluong = $_POST['soluong'][$i];
            if($soluong <= 0){
                $sql_delete = mysqli_query($mysqli,"DELETE FROM tbl_giohang WHERE sanpham_id ='$sanpham_id'");
            }
            else{
                $sql_update = mysqli_query($mysqli,"UPDATE tbl_giohang SET soluong ='$soluong' WHERE sanpham_id ='$sanpham_id'");

            }
        }
        
    }
    
    else if(isset($_POST['thanhtoan'])){
        $sex =$_POST['sex'];
        $name =$_POST['ten'];
        $sdt= $_POST['sdt'];
        $password = md5($_POST['password']);
        $email = $_POST['email'];
        $giaohang =$_POST['giaohang'];
        $diachi = $_POST['diachi'];
        $sql_khachhang =mysqli_query($mysqli,"INSERT INTO tbl_khachhang(sex,name,sdt,email,HT_giaohang,diachi,password) value ('$sex',
        '$name','$sdt','$email','$giaohang','$diachi','$password')");
       
        if($sql_khachhang){
            $sql_select_khachhang = mysqli_query($mysqli,"SELECT * FROM tbl_khachhang ORDER BY khachang_id DESC LIMIT 1");
            $mahang = rand(0,9999);
            $row_khachhang= mysqli_fetch_array($sql_select_khachhang);
                $khachhang_id = $row_khachhang['khachang_id'];
                $_SESSION['dangnhap_home'] = $name;
                $_SESSION['khachang_id'] = $row_khachhang['khachang_id'];
            for($i=0;$i<count($_POST['thanhtoan_product_id']); $i++){
                
                $sanpham_id = $_POST['thanhtoan_product_id'][$i];
                $soluong = $_POST['thanhtoan_soluong'][$i];
                $sql_donhang =mysqli_query($mysqli,"INSERT INTO tbl_donhang(sanpham_id,khachang_id,soluong,mahang) value ('$sanpham_id',
                '$khachhang_id','$soluong','$mahang')");
                $sql_giaodich = mysqli_query($mysqli,"INSERT INTO tbl_giaodich(sanpham_id,soluong,magiaodich,khachang_id) values ('$sanpham_id','$soluong','$mahang','$khachhang_id')");
                 $sql_delete_thanhtoan = mysqli_query($mysqli,"DELETE FROM tbl_giohang WHERE sanpham_id ='$sanpham_id'");
            }
           
        }
    }
    elseif(isset($_POST['thanhtoandangnhap'])){
        $sdt= $_POST['sdt'];
        $giaohang =$_POST['giaohang'];
        $diachi = $_POST['diachi'];
        $sex =$_POST['sex'];
        $khachhang_id = $_SESSION['khachang_id'];
        $mahang = rand(0,9999); 
        for($i=0;$i<count($_POST['thanhtoan_product_id']);$i++){
                $sanpham_id = $_POST['thanhtoan_product_id'][$i];
                $soluong = $_POST['thanhtoan_soluong'][$i];
                $sql_update=mysqli_query($mysqli,"UPDATE tbl_khachhang SET sex='$sex', sdt='$sdt',HT_giaohang ='$giaohang',diachi='$diachi' WHERE khachang_id='$khachhang_id'");
                $sql_donhang = mysqli_query($mysqli,"INSERT INTO tbl_donhang(sanpham_id,khachang_id,soluong,mahang) values ('$sanpham_id','$khachhang_id','$soluong','$mahang')");
                $sql_giaodich = mysqli_query($mysqli,"INSERT INTO tbl_giaodich(sanpham_id,soluong,magiaodich,khachang_id) values ('$sanpham_id','$soluong','$mahang','$khachhang_id')");
                $sql_delete_thanhtoan = mysqli_query($mysqli,"DELETE FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
            }
    
        
     }
?>



<div class="container sproduct my-5 pt-5" style="    margin: 10px 10px !important;">
    <?php
                    while($row_chitiet = mysqli_fetch_array($sql_chitiet)){
                     
                ?>
    <div class="row mt-5">

        <div class="col-lg-5 col-md-12 col-12 ">
            <div class="product-content-left-img">
                <img class="img-fluid w-100 pb-1 img" src="img/<?php echo $row_chitiet['sanpham_img']?>"
                    data-imagezoom="true" class="img-fluid" alt="">
                <div class="clearfix"></div>
            </div>



        </div>
        <div class="col-lg-6 col-md-12 col-12 product-right">
            <h6 class="home">Home/<?php echo $row_chitiet['sanpham_name']?></h6>
            <h1 class="py-4"><?php echo $row_chitiet['sanpham_name']?></h1>
            <h2><?php echo number_format($row_chitiet['sanpham_sales'])?> <sup>đ</sup></h2>
            <span><s><?php echo number_format($row_chitiet['sanpham_price'])?></s> <sup>đ</sup></span>


            <div style="display: flex; align-items: center">
                <select class="my-3">
                    <option class="<?php echo $temp?>"><?php echo $row_chitiet['mau_sp']?></option>
                </select>
                <input type="number" value="1">
                <form action="" method="post">
                    <input type="hidden" name="tensanpham" value="<?php echo $row_chitiet['sanpham_name']?>">
                    <input type="hidden" name="sanpham_id" value="<?php echo $row_chitiet['sanpham_id']?>">
                    <input type="hidden" name="giasanpham" value="<?php echo $row_chitiet['sanpham_price']?>">
                    <input type="hidden" name="giaSales" value="<?php echo $row_chitiet['sanpham_sales']?>">
                    <input type="hidden" name="img" value="<?php echo $row_chitiet['sanpham_img']?>">
                    <input type="hidden" name="soluong" value="1">
                    <input type="hidden" name="mau" value="<?php echo $row_chitiet['mau_sp']?>">
                    <button type="submit" name="themgiohang" class="btn buy-btn">
                        <i class="fas fa-cart-arrow-down" style="margin-right: 5px;"></i>
                        Thêm giỏ hàng
                    </button>

                </form>
                <?php 
                            
                            $sql_laygiohang = mysqli_query($mysqli,"SELECT * FROM tbl_giohang ORDER BY giohang_id ASC");
                        ?>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true" style="margin-left: 0 !important;">
                    <div class="modal-dialog">
                        <div class="modal-content" style="width: 800px;">
                            <div class="modal-header">

                                <h5 class="modal-title" id="exampleModalLabel">Sản phẩm trong giỏ hàng</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                        class="fas fa-window-close"></i></button>
                            </div>
                            <form action="" method="POST">
                                <div class="modal-body">
                                    <?php 
                                           
                                            $sumtotal=0;
                                            $sumSL =0;
                                            while ($row_fetch_giohang = mysqli_fetch_array($sql_laygiohang)) {
                                                $sumtotal += $row_fetch_giohang['giaSales'];
                                                $sumSL +=  $row_fetch_giohang['soluong'];
                                        ?>
                                    <div class="modal-product">
                                        <div class="modal-body-top">
                                            <div class="modal-body-top-left">
                                                <div class="image">
                                                    <img src="img/<?php echo $row_fetch_giohang['img']?>" alt=""
                                                        style="width: 300px;">
                                                </div>
                                                <div class="title">
                                                    <p><?php echo $row_fetch_giohang['tensanpham']?></p>
                                                    <select class="my-3 ">
                                                        <option class="<?php echo $temp?>">
                                                            <?php echo $row_fetch_giohang['mau']?></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-body-top-right">
                                                <div class="quantity" style="margin: 44px 6px;">
                                                    <input type="number" min="0" style="width: 60px;" name="soluong[]"
                                                        value="<?php echo $row_fetch_giohang['soluong']?>">
                                                    <input type="hidden" name="product_id[]" min="0"
                                                        value="<?php echo $row_fetch_giohang['sanpham_id'] ?>">
                                                </div>
                                                <div class="price">

                                                    <p><?php echo number_format($row_fetch_giohang['giaSales'])?>
                                                        <sup>đ</sup>
                                                    </p>
                                                    <span><s><?php echo number_format($row_fetch_giohang['giasanpham'])?></s>
                                                        <sup>đ</sup></span>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-body-bottom">
                                            <ul class="product-cart__list">
                                                <li data-id="1267974" style="text-decoration: none;">Cơ hội trúng
                                                    Jackpot đến 2 tỷ</li>
                                                <li data-id="1267971" style="text-decoration: none;">Tặng gói iCloud
                                                    50GB miễn phí 3 tháng</li>
                                                <li data-id="1267959" style="text-decoration: none;">Thu cũ đổi mới trợ
                                                    giá 15%</li>
                                                <li data-id="1267962" style="text-decoration: none;">Tặng PMH 165.000đ
                                                    mua eSim Mobifone Big Data</li>
                                                <li data-id="1267963" style="text-decoration: none;">Bảo hành 2 năm
                                                    chính hãng</li>
                                            </ul>
                                        </div>

                                    </div>
                                    <?php
                                            }
                                            ?>
                                    <div class="c-cart__total" style="    margin: -28px 5px;">
                                        <input type="submit"
                                            style="width: 172px; height: 50px;position: relative;right: 368px;top: 57px;"
                                            class="btn btn-success" value="Cập nhật giỏ hàng" name="capnhatsoluong">
                                        <p class="text-normal"><span>Tổng tiền:</span><span>
                                                <?php echo number_format($sumtotal) ?><sup>đ</sup></span></p>
                                        <p class="text-normal"><span>Số
                                                Lượng:</span><span><?php echo number_format($sumSL) ?></span></p>
                                        <p class="text--lg"><span class="text-size--lg">Cần thanh
                                                toán:</span><span
                                                class="re-price re-red"><?php echo number_format($sumtotal *$sumSL ) ?><sup>đ</sup></span>
                                        </p>
                                    </div>
                                </div>
                            </form>
                            <?php
                                if(!isset($_SESSION['dangnhap_home'])){
                            ?>
                            <form action="" method="POST">
                                <div style="margin: 31px 41px;">


                                    <select class="option-w3ls" name="sex">
                                        <option> Chọn giớ tính</option>
                                        <option value="nam">Nam</option>
                                        <option value="nữ">Nữ</option>
                                        <option value="khác">Khác</option>
                                    </select>
                                    <div class="box-namecus">
                                        <input type="text" name="ten" placeholder="Nhập họ và tên" value=""
                                            style="margin-top: 12px; margin-left: 1px;width: 30%; margin-bottom: 10px;">
                                        <input type="text" name="sdt" placeholder="Nhập số điện thoại" value=""
                                            style="    width: 30%;">
                                    </div>
                                    <div class="box-namecus" style="display: flex;">
                                        <input type="email" name="email"
                                            style="margin-top: 3px;margin-left: 1px;   width: 30%; margin-bottom: 10px;"
                                            placeholder="Nhập email " value="">
                                        <input type="text" class="form-control"
                                            style=" border-radius: 0;width: 30%;margin-left: 24px;"
                                            placeholder="Password" name="password" required="">
                                    </div>
                                    <h5 style="color: #333;    margin: 16px 1px;">Hình thức giao hàng</h5>
                                    <select class="option-w3ls" name="giaohang">
                                        <option> Chọn hình thức giao hàng</option>
                                        <option value="0">Đến nơi lấy</option>
                                        <option value="1">Giao Hàng tận nơi</option>
                                    </select>
                                    <div class="box-diachi" style="position:relative ;">
                                        <input type="text" name="diachi" placeholder="Nhập địa chỉ" value=""
                                            style="    width: 30%;    margin: 13px 1px;">
                                        <?php 
                                                $sql_laygiohang = mysqli_query($mysqli,"SELECT * FROM tbl_giohang ORDER BY giohang_id ASC");
                                                while($row_thanhtoan = mysqli_fetch_array($sql_laygiohang)){
                                                    ?>
                                        <input type="hidden" min="0" style="width: 60px;" name="thanhtoan_soluong[]"
                                            value="<?php echo $row_thanhtoan['soluong']?>">
                                        <input type="hidden" name="thanhtoan_product_id[]" min="0"
                                            value="<?php echo $row_thanhtoan['sanpham_id'] ?>">
                                        <?php
                                                }
                                            ?>
                                        <input type="submit" name="thanhtoan" class="btn btn-primary"
                                            style="right: -30px;bottom: -20px;position: absolute;background: red;width: 16%;height: auto;"
                                            value="Thanh toán ">
                                    </div>

                                </div>
                            </form>
                            <?php
                                }
                                ?>

                            <form action="" method="POST">
                                <?php 
                                $sql_giohang_select = mysqli_query($mysqli,"SELECT * FROM tbl_giohang");
                                $count_giohang_select = mysqli_num_rows($sql_giohang_select);
                                if(isset($_SESSION['dangnhap_home']) && $count_giohang_select>0){
                                ?>
                                <div style="margin: 31px 41px;">
                                    <select class="option-w3ls" name="sex">
                                        <option> Chọn giớ tính</option>
                                        <option value="nam">Nam</option>
                                        <option value="nữ">Nữ</option>
                                        <option value="khác">Khác</option>
                                    </select>
                                    <div class="box-namecus">
                                        <input type="text" name="sdt" placeholder="Nhập số điện thoại" value=""
                                            style="   margin-top: 12px; margin-left: 1px;width: 30%; margin-bottom: 10px; width: 30%;">
                                    </div>
                                    <h5 style="color: #333;    margin: 16px 1px;">Hình thức giao hàng</h5>
                                    <select class="option-w3ls" name="giaohang">
                                        <option> Chọn hình thức giao hàng</option>
                                        <option value="0">Đến nơi lấy</option>
                                        <option value="1">Giao Hàng tận nơi</option>
                                    </select>
                                    <div class="box-diachi" style="position:relative ;">
                                        <input type="text" name="diachi" placeholder="Nhập địa chỉ" value=""
                                            style="    width: 30%;    margin: 13px 1px;">
                                        <?php 
                                            $sql_laygiohang = mysqli_query($mysqli,"SELECT * FROM tbl_giohang ORDER BY giohang_id ASC");
                                            while($row_thanhtoan = mysqli_fetch_array($sql_laygiohang)){
                                                ?>
                                        <input type="hidden" min="0" style="width: 60px;" name="thanhtoan_soluong[]"
                                            value="<?php echo $row_thanhtoan['soluong']?>">
                                        <input type="hidden" name="thanhtoan_product_id[]" min="0"
                                            value="<?php echo $row_thanhtoan['sanpham_id'] ?>">
                                        <?php
                                            }
                                        ?>
                                        <input type="submit" name="thanhtoandangnhap" class="btn btn-primary"
                                            style="right: -30px;bottom: -20px;position: absolute;background: red;width: 16%;height: auto;"
                                            value="Thanh toán ">
                                    </div>

                                </div>
                                <?php
                                    }
                                ?>
                            </form>

                            <div class="modal-footer">

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="product-content-right-bottom">
                <div class="product-content-right-bottom-top" style="cursor: pointer;">
                    &#8744;
                </div>
                <div class="product-content-right-bottom-content-big">
                    <div class="product-content-right-bottom-content-title">
                        <div class="product-content-right-bottom-content-title-item chitiet">
                            <p class="p-chitiet">Chi tiết</p>
                        </div>
                        <div class="product-content-right-bottom-content-title-item baohanh">
                            <p class="p-baohanh">Bảo hành</p>
                        </div>
                    </div>
                    <div class="product-content-right-bottom-content">
                        <div class="product-content-right-bottom-content-chitiet">
                            <div class="hrvproduct-tabs">
                                <p> <?php echo $row_chitiet['sanpham_chitiet']?></p>
                            </div>
                        </div>
                    </div>
                    <div class="product-content-right-bottom-content">
                        <div class="product-content-right-bottom-content-baohanh">
                            <div class="hrvproduct-tabs">
                                <p> <?php echo $row_chitiet['sanpham_mota']?></p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php
                }
             ?>
    <div style="background-color: white; position: relative;">
        <div class="product-relate-title" style="margin-top: 50px; padding-bottom:60px ;">
            SẢN PHẨM TƯƠNG TỰ

        </div>

        <div class="row row-cols-2"
            style="width: 1200px !important; margin-left: 10px; position:relative ; right:-63px;">
            <?php
                         $sql_product = mysqli_query($mysqli,"SELECT * FROM sanpham ORDER BY sanpham_id ASC");
                         while($row_sanpham = mysqli_fetch_array($sql_product)){
                      
                                $count ++;
                                if($count < 5   ){
                                   
                                ?>
            <div class="col-md-auto sp">
                <p class="installment">Trả góp 0%</p>
                <div>
                    <a href="?quanly=chitietsp&id=<?php echo $row_sanpham['sanpham_id'] ?>"> <img
                            src="img/<?php echo $row_sanpham['sanpham_img']?>" class="img-thumbnail" alt="..."></a>
                    <p class="card-title-product" style="cursor: pointer;"> <a
                            href="?quanly=chitietsp&id=<?php echo $row_sanpham['sanpham_id'] ?>"
                            style="font-weight: bold;color: #333;"><?php echo $row_sanpham['sanpham_name']?></a>
                    </p>
                </div>
                <div class="flex inf">
                    <div>

                        <p class="price-product"> <?php echo number_format($row_sanpham['sanpham_sales'])?><sup>đ</sup>
                        </p>
                        <p class="real-price"><del>
                                <?php echo number_format($row_sanpham['sanpham_price'])?></del><sup>đ</sup></p>
                    </div>
                    <div class="prepay">
                        <p class="title-prepay">Hoặc Trả trước</p>
                        <p class="price-prepay"> <?php echo number_format($row_sanpham['sanpham_tratruoc'])?>
                            <sup>đ</sup>
                        </p>
                    </div>
                </div>
                <div class="buy">
                    <p><a href="?quanly=chitietsp&id=<?php echo $row_sanpham['sanpham_id'] ?>">MUA NGAY</a></p>
                </div>
            </div>
            <?php
                                }
                            }
                    ?>


        </div>
    </div>
</div>