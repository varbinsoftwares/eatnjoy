<?php
$this->load->view('layout/header');
?>
<style>
    
    .price_tag{
        font-size: 30px;
    }
    .cartbutton{
        width: 100%;
        padding: 6px;
        color: #fff!important;
    }
    .noti-check1{
        background: #f5f5f5;
        padding: 25px 30px;
        color: red;
        font-weight: 600;
        margin-bottom: 30px;
    }

    .noti-check1 span{
        color: red;
        color: red;
        width: 111px;
        float: left;
        text-align: right;
        padding-right: 13px;
    }

    .noti-check1 h6{
        font-size: 15px;
        font-weight: 600;
    }

    .address_block{
        background: #fff;
        border: 3px solid #d30603;
        padding: 5px 10px;
        height: 150px;
    }
    .checkcart {
        border-radius: 50%;
        position: absolute;
        top: -28px;
        left: -8px;
        padding: 4px;
        background: #fff;
        border: 2px solid green;
    }


    .default{
        border: 2px solid green;
    }

    .default{
        border: 2px solid green;
    }

    .checkcart i{
        color: green;
    }

    .address_button{
        padding: 4px;
        bottom: 10px;
        position: absolute;
        color: white;
    }

    .cartdetail_small {
        float: left;
        width: 203px;
    }

</style>
<style>
    .product_image_back {
        background-size: contain!important;
        background-repeat: no-repeat!important;
        height: 300px!important;
        background-position-x: center!important;
        background-position-y: center!important;
    }

    .productblock{
        padding: 10px;
        border: 1px solid rgb(255, 214, 88);
        margin-bottom: 30px;
    }
</style>
<!-- Slider -->
<section class="home-slider">
    <div class="tp-banner-container">
        <div class="tp-banner">
            <ul>

                <!-- Slider 1 -->
                <li data-transition="random" data-slotamount="7"> <img src="<?php echo base_url(); ?>assets/theme/images/shop-slider-bg-1.jpg" data-bgposition="center top" alt="" /> 

                    <!-- Layer -->
                    <div class="tp-caption sft font-montserrat tp-resizeme rs-parallaxlevel-4" 
                         data-x="center" 
                         data-hoffset="0" 
                         data-y="center" 
                         data-voffset="-150" 
                         data-speed="700" 
                         data-start="1000" 
                         data-easing="easeOutBack"
                         data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" 
                         data-splitin="none" 
                         data-splitout="none" 
                         data-elementdelay="0.1" 
                         data-endelementdelay="0.1" 
                         data-endspeed="300" 
                         data-captionhidden="on"
                         style="color: #252839; font-size: 36px; font-weight:900; text-transform: uppercase;"> Winter Collection </div>

                    <!-- Layer -->
                    <div class="tp-caption customin font-playfair tp-resizeme rs-parallaxlevel-4" 
                         data-x="center" data-hoffset="0" 
                         data-y="center" data-voffset="-50" 
                         data-speed="720" 
                         data-start="1200" 
                         data-easing="easeOutBack"
                         data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" 
                         data-splitin="none" 
                         data-splitout="none" 
                         data-elementdelay="0.1" 
                         data-endelementdelay="0.1" 
                         data-endspeed="300" 
                         data-captionhidden="on" 
                         style="color: #252839; text-transform: uppercase; font-weight:900; font-size: 130px;"> UP to 70% </div>

                    <!-- Layer -->
                    <div class="tp-caption sfb  font-playfair text-center tp-resizeme rs-parallaxlevel-4" 
                         data-x="center" data-hoffset="0" 
                         data-y="center" data-voffset="50"
                         data-speed="1500" 
                         data-start="1400" 
                         data-easing="easeOutBack"
                         data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" 
                         data-splitin="none" 
                         data-splitout="none" 
                         data-elementdelay="0.1" 
                         data-endelementdelay="0.1" 
                         data-endspeed="300" 
                         data-captionhidden="on" 
                         style="color: #000; font-size: 16px; text-transform: uppercase; font-weight:600;"> BY DONIA R., DUTCH BLOGGER FROM LONDON, UNITED KINGDOM </div>

                    <!-- Layer -->
                    <div class="tp-caption sfb tp-resizeme rs-parallaxlevel-4" 
                         data-x="center" data-hoffset="0" 
                         data-y="center" data-voffset="150"
                         data-speed="700" 
                         data-start="2000" 
                         data-easing="easeOutBack"
                         data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" 
                         data-splitin="none" 
                         data-splitout="none" 
                         data-elementdelay="0.1" 
                         data-endelementdelay="0.1" 
                         data-endspeed="300" 
                         data-captionhidden="on"> <a href="#." class="btn">Shop Now</a> &nbsp; &nbsp; &nbsp; &nbsp; <a href="#" class="btn btn-1">Discover</a> </div>
                </li>

                <!-- Slider 2 -->
                <li data-transition="random" data-slotamount="7"> 
                    <img src="<?php echo base_url(); ?>assets/theme/images/shop-slider-bg-2.jpg" data-bgposition="center center" alt="" />
                    <div class="overlay"></div>

                    <!-- Layer -->
                    <div class="tp-caption sft font-montserrat  tp-resizeme rs-parallaxlevel-4" 
                         data-x="center" data-hoffset="0" 
                         data-y="center" data-voffset="-90" 
                         data-speed="700" 
                         data-start="1000" 
                         data-easing="easeOutBack"
                         data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" 
                         data-splitin="none" 
                         data-splitout="none" 
                         data-elementdelay="0.1" 
                         data-endelementdelay="0.1" 
                         data-endspeed="300" 
                         data-captionhidden="on"
                         style="color: #fff; font-size: 120px; text-transform: uppercase; font-weight: 900;"> HUGE SALE </div>

                    <!-- Layer -->
                    <div class="tp-caption sft tp-resizeme font-montserrat rs-parallaxlevel-4" 
                         data-x="center" data-hoffset="0" 
                         data-y="center" data-voffset="0" 
                         data-speed="700" 
                         data-start="1700" 
                         data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" 
                         data-easing="Back.easeOut" 
                         data-splitin="none" 
                         data-splitout="none" 
                         data-elementdelay="0.1" 
                         data-endelementdelay="0.1" 
                         data-endspeed="300" 
                         data-captionhidden="on"
                         style="color: #fff; font-size: 18px; text-transform: uppercase; font-weight: bold;  letter-spacing:3px;"> ASOS T-shirt With Stripe Sleeve </div>

                    <!-- Layer -->
                    <div class="tp-caption sft tp-resizeme rs-parallaxlevel-4" 
                         data-x="center" data-hoffset="0" 
                         data-y="center" data-voffset="100" 
                         data-speed="700" 
                         data-start="2400"
                         data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" 
                         data-easing="Back.easeOut" 
                         data-splitin="none" 
                         data-splitout="none" 
                         data-elementdelay="0.1" 
                         data-endelementdelay="0.1" 
                         data-endspeed="300" 
                         data-captionhidden="on"> <a href="#." class="btn btn-1">SHOPPING NOW</a> </div>
                </li>

                <!-- Slider 3 -->
                <li data-transition="random" data-slotamount="7"> 
                    <img src="<?php echo base_url(); ?>assets/theme/images/shop-slider-bg-3.jpg" data-bgposition="center center" alt="" /> 
                    <!-- Layer -->
                    <div class="tp-caption font-montserrat customin tp-resizeme rs-parallaxlevel-4" 
                         data-x="center" 
                         data-hoffset="0" 
                         data-y="center" 
                         data-voffset="-100"
                         data-speed="700" 
                         data-start="1000" 
                         data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" 
                         data-easing="Back.easeOut" 
                         data-splitin="none" 
                         data-splitout="none" 
                         data-elementdelay="0.1" 
                         data-endelementdelay="0.1" 
                         data-endspeed="300" 
                         data-captionhidden="on"
                         style="color: #fff; font-size: 60px; text-transform: uppercase; font-weight: 900; letter-spacing:3px;"> NEW ARRIVAL </div>

                    <!-- Layer -->
                    <div class="tp-caption sfb tp-resizeme  font-playfair text-center rs-parallaxlevel-4" 
                         data-x="center" 
                         data-hoffset="0" 
                         data-y="center" 
                         data-voffset="-20"
                         data-speed="700" 
                         data-start="1700" 
                         data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" 
                         data-easing="Back.easeOut" 
                         data-splitin="none" 
                         data-splitout="none" 
                         data-elementdelay="0.1" 
                         data-endelementdelay="0.1" 
                         data-endspeed="300" 
                         data-captionhidden="on"
                         style="color: #fff; font-size: 18px; line-height:36px; font-weight: 500; letter-spacing:0px;"> Gumbo beet greens corn soko endive gumbo gourd. Parsley shallot courgette tatsoi pea sprouts fava<br>
                        bean collard greens danadelion. </div>

                    <!-- Layer -->
                    <div class="tp-caption sfb tp-resizeme rs-parallaxlevel-4" 
                         data-x="center" 
                         data-hoffset="0" 
                         data-y="center"
                         data-voffset="100"
                         data-speed="700" 
                         data-start="2400"
                         data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" 
                         data-easing="Back.easeOut" 
                         data-splitin="none" 
                         data-splitout="none" 
                         data-elementdelay="0.1" 
                         data-endelementdelay="0.1" 
                         data-endspeed="300" 
                         data-captionhidden="on"
                         style="z-index: 10;"> <a href="#." class="btn">Shop Now</a> &nbsp; &nbsp; &nbsp; &nbsp; <a href="#" class="btn btn-1">Discover</a> </div>
                </li>
            </ul>
        </div>
    </div>
</section>

<!-- Content -->
<div id="content" class="home-shop"> 

    <!-- About Sec -->
    <section class="acces-ser pad-t-b-130 padding-bottom-100">
        <div class="container"> 

            <!-- Heading -->
            <div class="heading-block margin-bottom-30">
                <h3>Top Categories Items</h3>
                <hr>
            </div>
            <div class="intro-small col-md-8 center-auto">
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout..</p>
            </div>
            <div class="row"> 

                <div class="col-sm-4">
                    <article> 
                        <img class="img-responsive" src="<?php echo base_url(); ?>/assets/theme/images/backcat.jpg" alt="">
                        <div class="position-center-center">
                            <h6>Spacial</h6>
                            <span class="price_tag">{{59|currency:'Rs.'}}</span>
                        </div>
                    </article>
                </div>
                
                <div class="col-sm-4">
                    <article> 
                        <img class="img-responsive" src="<?php echo base_url(); ?>/assets/theme/images/backcat.jpg" alt="">
                        <div class="position-center-center">
                            <h6>Regular</h6>
                            <span class="price_tag">{{49|currency:'Rs.'}}</span>
                        </div>
                    </article>
                </div>
                
                <div class="col-sm-4">
                    <article> 
                        <img class="img-responsive" src="<?php echo base_url(); ?>/assets/theme/images/backcat.jpg" alt="">
                        <div class="position-center-center">
                            <h6>Basic</h6>
                            <span class="price_tag">{{39|currency:'Rs.'}}</span>
                        </div>
                    </article>
                </div>

            </div>
        </div>
    </section>

    <!-- About US -->
    <section class="light-gray-bg pad-t-b-130">
        <div class="container"> 

            <!-- Heading -->
            <div class="heading-block margin-bottom-30">
                <h3>Best Sellers</h3>
                <hr>
            </div>
            <div class="intro-small col-md-8 center-auto">
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout..</p>
            </div>

            <!-- Images Sec -->
            <div class="img-sec">
                <div class="shop-content">
                    <div id="new-arrival-slide"> 

                        <?php
                        foreach ($product_home_slider_bottom['home_slider'] as $key => $value) {
                            ?>

                            <!-- Item -->
                            <div class="item">
                                <article class="shop-artical"> 
                                    <div class="product_image_back" style="background: url(<?php echo imageserver . $value['file_name']; ?>)"></div>


                                    <div class="item-hover">
                                        <a href="#." class="btn" ng-click="addToCart(<?php echo $value['id']; ?>, 1)">add to cart</a> 
                                        <a href="#." class="btn by">BUY NOW</a> 
                                    </div>
                                </article>
                                <div class="info"> <a href="#."><?php echo $value['title']; ?> </a> <span class="price">{{<?php echo $value['price']; ?>|currency:" Rs. "}}</span> </div>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Shop Content -->
    <div class="shop-content pad-t-b-130">
        <div class="container"> 

            <!-- Heading -->
            <div class="heading-block">
                <h3>Daily Menu</h3>
                <hr>
            </div>
            <div class="row"> 

                <div class="col-md-12">

                    <div class="noti-check1" style="#f5f5f5">  
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Evening Shift</h4>

                                <?php
                                if (count($manu_details_evening)) {
                                    ?>
                                    <?php
                                    foreach ($manu_details_evening as $key => $value) {
                                        ?>
                                        <h6><?php echo $value['menu_date']; ?></h6>


                                        <div class="col-md-12">

                                            <?php if (trim($value['menu_59'])) { ?>
                                                <div class=" ">
                                                    Menu 59
                                                    <p>
                                                        <?php echo $value['menu_59']; ?>,<br/>
                                                    </p>
                                                </div>
                                            <?php } ?>

                                            <?php if (trim($value['menu_49'])) { ?>
                                                <div class=" ">
                                                    Menu 49
                                                    <p>
                                                        <?php echo $value['menu_49']; ?>,<br/>
                                                    </p>
                                                </div>
                                            <?php } ?>

                                            <?php if (trim($value['menu_39'])) { ?>
                                                <div class=" ">
                                                    Menu 39
                                                    <p>
                                                        <?php echo $value['menu_39']; ?>,<br/>
                                                    </p>
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <?php
                                    }
                                } else {
                                    ?>
                                    <h4><i class="fa fa-warning"></i> No Tiffin Available</h4>

                                    <?php
                                }
                                ?>
                            </div>
                            <div class="col-md-6">
                                <h4>Morning Shift</h4>
                                <?php
                                if (count($manu_details_morning)) {
                                    ?>
                                    <?php
                                    foreach ($manu_details_morning as $key => $value) {
                                        ?>
                                        <h6><?php echo $value['menu_date']; ?> </h6>


                                        <div class="col-md-12">

                                            <?php if (trim($value['menu_59'])) { ?>
                                                <div class=" ">
                                                    Menu 59
                                                    <p>
                                                        <?php echo $value['menu_59']; ?>,<br/>
                                                    </p>
                                                </div>
                                            <?php } ?>

                                            <?php if (trim($value['menu_49'])) { ?>
                                                <div class=" ">
                                                    Menu 49
                                                    <p>
                                                        <?php echo $value['menu_49']; ?>,<br/>
                                                    </p>
                                                </div>
                                            <?php } ?>

                                            <?php if (trim($value['menu_39'])) { ?>
                                                <div class=" ">
                                                    Menu 39
                                                    <p>
                                                        <?php echo $value['menu_39']; ?>,<br/>
                                                    </p>
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <?php
                                    }
                                } else {
                                    ?>
                                    <h4><i class="fa fa-warning"></i> No Tiffin Available</h4>

                                    <?php
                                }
                                ?>
                            </div>
                        </div>                            

                    </div>
                </div>


            </div>
        </div>

        <!-- Load More -->
        <div class="text-center margin-top-50"> <a href="#." class="btn">Check out more shop</a> </div>
    </div>

    <!-- OUR SERVICES -->
    <section class="client-sec">
        <div class="container"> 

            <!-- Heading -->
            <div class="heading-block margin-bottom-30">
                <h3>our Best Brands</h3>
                <hr>
            </div>
            <div class="intro-small col-md-8 center-auto">
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout..</p>
            </div>
            <ul class="nolist-style">
                <li><img src="images/client-img-1.png" alt="" ></li>
                <li><img src="images/client-img-2.png" alt="" ></li>
                <li><img src="images/client-img-3.png" alt="" ></li>
                <li><img src="images/client-img-4.png" alt="" ></li>
                <li><img src="images/client-img-5.png" alt="" ></li>
            </ul>
        </div>
    </section>
</div>
<!-- End Content --> 

<?php
$this->load->view('layout/footer');
?>