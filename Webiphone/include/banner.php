<div class=" row justify-content-md-center" style="width: 1369px;">

    <div class="card-main">
        <?php
                         $sql_banner = mysqli_query($mysqli,"SELECT * FROM tbl_banner ORDER BY banner_id ASC");
                         while($row_banner = mysqli_fetch_array($sql_banner)){
                             $loai_banner = $row_banner["banner_loai"]
                                ?>
        <div class="card-first" style="display: flex; cursor: pointer;">
            <div class="card ">
                <img src="src/img/<?php echo $row_banner['banner_img']?>" class="card-img-top" alt="...">

                <div class="card-body">
                    <h5 class="card-title"><?php echo $row_banner['banner_name']?>
                    </h5>
                    <p class="card-text" style="color: red;">Chỉ từ
                        <?php echo number_format($row_banner['banner_price'])?></p>
                    <a href="#" class="btn btn-primary" style="float: right; background: red;">Đã giảm
                        <?php echo number_format($row_banner['banner_sales'])?></a>
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
            </div>
            <div class="row row-cols-2 " style="width: 252px; flex-wrap: nowrap !important;">
                <?php
                         $sql_sphot =mysqli_query($mysqli,'SELECT * FROM tbl_sphot  ORDER BY spHot_id ASC');
                        while($row_sphot = mysqli_fetch_array($sql_sphot)){
                            if($row_sphot["banner_loai"]== $loai_banner){
                            ?>
                <div class="col-md-auto sp" style="height: 431px ;">
                    <p class="installment">Trả góp 0%</p>
                    <div>
                        <img src="src/img/<?php echo $row_sphot['spHot_img']?>" class="img-thumbnail" alt="...">

                        <p class="card-title-product"><?php echo $row_sphot['spHot_name']?></p>
                    </div>
                    <div class="flex inf">
                        <div>

                            <p class="price-product"><?php echo  number_format($row_sphot['spHot_sales'])?> <sup>đ</sup>
                            </p>
                            <p class="real-price">
                                <del><?php echo number_format($row_sphot['spHot_price'])?></del><sup>đ</sup>
                            </p>
                        </div>
                        <div class="prepay">
                            <p class="title-prepay">Hoặc Trả trước</p>
                            <p class="price-prepay"><?php echo number_format($row_sphot['spHot_tratruoc'])?></p>
                        </div>
                    </div>
                    <div class="buy">
                        <p>MUA NGAY</p>
                    </div>
                </div>
                <?php
                            }
                        }
                    ?>

            </div>
        </div>
        <?php
                            }
                    ?>


    </div>
</div>