?<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    else{
        $id='';
    }
    $sql_cate = mysqli_query($mysqli,"SELECT * FROM tbl_category,sanpham WHERE tbl_category.category_id = sanpham.category_id AND sanpham.category_id = '$id' ORDER BY sanpham.sanpham_id ASC" );
    
    

    
?>



<div class="container">



    <div class="all-Product">
        <div class="title-sales">
            <h2> <i>SĂN SALES MỖI NGÀY</i> </h2>

            <div class="countdown">
                <div class="time days">
                    <span class="time-days">368</span>
                    <span class="label">DAYS</span>
                </div>
                <div class="time hours">
                    <span class="time-hours">04</span>
                    <span class="label">HOURS</span>
                </div>
                <div class="time mins">
                    <span class="time-mins">21</span>
                    <span class="label">MINS</span>
                </div>
                <div class="time secs">
                    <span class="time-secs">12</span>
                    <span class="label">SECS</span>
                </div>
            </div>
        </div>
        <div class="sapxep">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Sắp xếp
                    </button>
                    <ul class="dropdown-menu" style="z-index:10000;" aria-labelledby="btnGroupDrop1">
                        <li><a class="dropdown-item" href="#">Tăng dần</a></li>
                        <li><a class="dropdown-item" href="#"> Giảm dần</a></li>
                    </ul>
                </div>
            </div>
            <div class="all-cart">
                <a>Xem tất cả sản phẩm</a>
                <i class="fas fa-angle-right"></i>
            </div>
        </div>

        <div class="row row-cols-2 row-all" style="margin-left: 80px;">
            <?php   
                while($row_sanpham= mysqli_fetch_array($sql_cate)){
                ?>
            <div class="col-md-auto sp">
                <p class="installment">Trả góp 0%</p>
                <div>
                    <img src="img/<?php echo $row_sanpham['sanpham_img']?>" class="img-thumbnail" alt="...">
                    <p class="card-title-product" style="cursor: pointer;"><a
                            href="?quanly=chitietsp&id=<?php  echo $row_sanpham['sanpham_id'] ?>"
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
                        <p class="price-prepay">
                            <?php echo number_format($row_sanpham['sanpham_tratruoc'])?><sup>đ</sup></p>
                    </div>
                </div>
                <div class="buy">
                    <p><a href="?quanly=chitietsp&id=<?php echo $row_sanpham['sanpham_id'] ?>">MUA NGAY</a> </p>
                </div>
            </div>
            <?php
                }
             ?>

        </div>
    </div>

</div>
</div>
<div class="totop">
    <i class="fas fa-angle-up"></i>
</div>