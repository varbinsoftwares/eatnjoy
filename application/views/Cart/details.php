<?php
$this->load->view('layout/header');
?>

<style>
    .cartbutton{
        width: 100%;
        padding: 6px;
        color: #fff!important;
    }
    
    .custom_block_item{
        padding:10px;
        border:3px solid #000;
        margin:10px;
    }
</style>

<!-- Slider -->
<section class="sub-bnr" data-stellar-background-ratio="0.5">
    <div class="position-center-center">
        <div class="container">
            <h4>Cart</h4>

            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Cart</li>
            </ol>
        </div>
    </div>
</section>

<!-- Content -->
<div id="content" ng-if="globleCartData.total_quantity"> 

    <!-- Shop Content -->
    <div class="shop-content pad-t-b-60">
        <div class="container"> 
            <!-- Payments Steps -->
            <div class="shopping-cart text-center" >
                <div class="cart-head">
                    <ul class="row">
                        <!-- PRODUCTS -->
                        <li class="col-sm-2 text-left">
                            <h6>PRODUCTS</h6>
                        </li>
                        <!-- NAME -->
                        <li class="col-sm-4 text-left">
                            <h6>NAME</h6>
                        </li>
                        <!-- PRICE -->
                        <li class="col-sm-2">
                            <h6>PRICE</h6>
                        </li>
                        <!-- QTY -->
                        <li class="col-sm-1">
                            <h6>QTY</h6>
                        </li>

                        <!-- TOTAL PRICE -->
                        <li class="col-sm-2">
                            <h6>TOTAL</h6>
                        </li>
                        <li class="col-sm-1"> </li>
                    </ul>
                </div>

                <!-- Cart Details -->
                <div class="custom_block_item">
                    <ul class="row cart-details" ng-repeat="product in globleCartData.products" ng-if="product.item_type == 'Jacket'">
                        <li class="col-sm-6">
                            <div class="media"> 
                                <!-- Media Image -->
                                <div class="media-left media-middle"> 
                                    <a href="<?php echo site_url("Product/ProductDetails/"); ?>{{product.product_id}}" class="item-img"> 
                                        <img class="media-object" src="{{product.file_name}}" alt="" style="height: 100px;width: auto;"> 
                                    </a> 
                                </div>

                                <!-- Item Name -->
                                <div class="media-body">
                                    <div class="position-center-center">
                                        <h5>{{product.title}}</h5>
                                        <p>{{product.sku}}</p>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- PRICE -->
                        <li class="col-sm-2">
                            <div class="position-center-center"> <span class="price">{{product.price|currency:" "}}</span> </div>
                        </li>

                        <!-- QTY -->
                        <li class="col-sm-1">
                            <div class="position-center-center">
                                <div class="quinty"> 
                                    <!-- QTY -->
                                    <input type="number" value="{{product.quantity}}"  ng-model="product.quantity" min="1" max="5">
                                    <button class="btn btn-default btn-xs cartbutton" style="color: white" ng-click="updateCart(product.product_id, product.quantity)">Update</button>
                                </div>
                            </div>
                        </li>

                        <!-- TOTAL PRICE -->
                        <li class="col-sm-2">
                            <div class="position-center-center"> <span class="price">{{product.total_price|currency:"<?php echo globle_currency_type; ?>"}}</span> </div>
                        </li>

                        <!-- REMOVE -->
                        <li class="col-sm-1">
                            <div class="position-center-center"> <a href="#." ng-click="removeCart(product.product_id)"><i class="icon-close"></i></a> </div>
                        </li>

                    </ul>
                    <div class=" text-right margin-top-30">
                        <div class="coupn-btn"> 
                            <a href="<?php echo site_url("Product/customizationSuit"); ?>" class="btn btn-inverse">Customize Now</a> 
                            <a href="<?php echo site_url("Product/customizationSuitV2"); ?>" class="btn btn-inverse">Customization V2</a> 
                        </div>
                    </div>
                </div>


                <!-- Cart Details -->
                <div class="custom_block_item">
                    <ul class="row cart-details" ng-repeat="product in globleCartData.products" ng-if="product.item_type != 'Jacket'">
                        <li class="col-sm-6">
                            <div class="media"> 
                                <!-- Media Image -->
                                <div class="media-left media-middle"> 
                                    <a href="<?php echo site_url("Product/ProductDetails/"); ?>{{product.product_id}}" class="item-img"> 
                                        <img class="media-object" src="{{product.file_name}}" alt="" style="height: 100px;width: auto;"> 
                                    </a> 
                                </div>

                                <!-- Item Name -->
                                <div class="media-body">
                                    <div class="position-center-center">
                                        <h5>{{product.title}}</h5>
                                        <p>{{product.sku}}</p>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- PRICE -->
                        <li class="col-sm-2">
                            <div class="position-center-center"> <span class="price">{{product.price|currency:" "}}</span> </div>
                        </li>

                        <!-- QTY -->
                        <li class="col-sm-1">
                            <div class="position-center-center">
                                <div class="quinty"> 
                                    <!-- QTY -->
                                    <input type="number" value="{{product.quantity}}"  ng-model="product.quantity" min="1" max="5">
                                    <button class="btn btn-default btn-xs cartbutton" style="color: white" ng-click="updateCart(product.product_id, product.quantity)">Update</button>
                                </div>
                            </div>
                        </li>

                        <!-- TOTAL PRICE -->
                        <li class="col-sm-2">
                            <div class="position-center-center"> <span class="price">{{product.total_price|currency:"<?php echo globle_currency_type; ?>"}}</span> </div>
                        </li>

                        <!-- REMOVE -->
                        <li class="col-sm-1">
                            <div class="position-center-center"> <a href="#." ng-click="removeCart(product.product_id)"><i class="icon-close"></i></a> </div>
                        </li>

                    </ul>

                    <div class=" text-right margin-top-30">
                        <div class="coupn-btn"> <a href="<?php echo site_url("Product/customizationShirt"); ?>" class="btn btn-inverse">Customize Now</a> </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!--======= PAGES INNER =========-->
    <section class="pad-t-b-60 light-gray-bg shopping-cart small-cart"  >
        <div class="container"> 

            <!-- SHOPPING INFORMATION -->
            <div class="cart-ship-info margin-top-0"> 


                <div class="row">


                    <!-- SUB TOTAL -->
                    <div class="col-sm-12">
                        <h6>grand total</h6>
                        <div class="grand-total">
                            <div class="order-detail">
                                <p ng-repeat="product in globleCartData.products">{{product.title}} <span>{{product.total_price|currency:"<?php echo globle_currency_type; ?>"}}</span></p>


                                <!-- SUB TOTAL -->
                                <p class="all-total">TOTAL COST <span>{{globleCartData.total_price|currency:"<?php echo globle_currency_type; ?>"}}</span></p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
<!-- End Content --> 

<!-- Content -->
<div id="content"  ng-if="!globleCartData.total_quantity"> 
    <!-- Tesm Text -->
    <section class="error-page text-center pad-t-b-130">
        <div class="container "> 

            <!-- Heading -->
            <h1 style="font-size: 40px">No Product Found</h1>
            <p>Please add product to cart<br>
                You can go back to</p>
            <hr class="dotted">
            <a href="<?php echo site_url(); ?>" class="btn btn-inverse">BACK TO HOME</a>
        </div>
    </section>
</div>
<!-- End Content --> 


<!--angular controllers-->
<script src="<?php echo base_url(); ?>assets/theme/angular/productController.js"></script>


<?php
$this->load->view('layout/footer');
?>