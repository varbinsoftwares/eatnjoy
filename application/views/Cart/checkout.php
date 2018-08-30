<?php
$this->load->view('layout/header');
?>

<style>
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






<!-- Slider -->
<section class="sub-bnr" data-stellar-background-ratio="0.5">
    <div class="position-center-center">
        <div class="container">
            <h4>Checkout</h4>

            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Checkout</li>
            </ol>
        </div>
    </div>
</section>

<!-- Content -->
<div id="content" ng-if="globleCartData.total_quantity"> 
    <!-- Shop Content -->
    <section class="shop-content pad-t-b-60">
        <div class="container"> 
            <!-- Checkout -->
            <div class="checkout-form">
                <div class="row"> 
                    <div class="col-md-7">
                        <!-- Login Details -->
                        <div class="col-md-12">
                            <div class="">
                                <h6>Contact Details</h6>
                            </div>
                            <div class="noti-check1" style="#f5f5f5">  
                                <div >
                                    <h6><span>Email</span> <?php echo $user_details->email; ?> </h6>
                                    <h6><span>Name</span> <?php echo $user_details->first_name; ?> <?php echo $user_details->last_name; ?></h6>
                                    <h6><span>Contact No.</span> <?php echo $user_details->contact_no; ?> </h6>

                                </div>
                            </div>
                        </div>

                        <hr/>
                        <!-- Address Details -->
                        <div class="col-md-12">
                            <div class="">
                                <h6>Shipping Details <button class="btn btn-small" data-toggle="modal" data-target="#changeAddress" style="margin-left: 20px;padding: 5px 11px;color:white;"><i class="fa fa-plus"></i> Add New</button></h6>
                            </div>
                            <div class="noti-check1" style="#f5f5f5">  
                                <div class="row">
                                    <?php
                                    if (count($user_address_details)) {
                                        ?>
                                        <?php
                                        foreach ($user_address_details as $key => $value) {
                                            ?>
                                            <div class="col-md-6">
                                                <?php if ($value['status'] == 'default') { ?> 
                                                    <div class="checkcart <?php echo $value['status']; ?> ">
                                                        <i class="fa fa-check fa-2x"></i>
                                                    </div>
                                                <?php } ?> 
                                                <div class=" address_block <?php echo $value['status']; ?> ">
                                                    <p>
                                                        <?php echo $value['address']; ?>,<br/>
                                                        <?php echo $value['city']; ?>, <?php echo $value['state']; ?> <?php echo $value['pincode']; ?>
                                                    </p>
                                                    <?php if ($value['status'] != 'default') { ?> 
                                                        <a href="<?php echo site_url("Cart/checkout/?setAddress=" . $value['id']); ?>" class="btn btn-small address_button">Select Address</a>
                                                    <?php } ?> 
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <h4><i class="fa fa-warning"></i> Please Add Shipping Address</h4>

                                        <?php
                                    }
                                    ?>
                                </div>                            

                            </div>
                        </div>

                    </div>
                    <div class="col-sm-5">
                        <form action="#" method="post">

                            <div class="col-sm-12">

                                <table class="table table-condensed">
                                    <thead>
                                        <tr class="active">
                                            <th>Product</th>
                                            <th>total</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr  ng-repeat="product in globleCartData.products">
                                            <td>
                                                <span class="cartdetail_small">{{product.title}}<br/>Credit Limit : {{product.credit_limit|currency:" "}}</span>  X  {{product.quantity}}
                                            </td>
                                            <td>
                                                {{product.total_price|currency:" "}}<br/>
                                               
                                            </td>
                                        </tr>
                                        <tr >
                                            <td>
                                                Applicable Credit Limit 
                                            </td>
                                            <td>
                                                {{globleCartData.total_credit_limit}}<br/>
                                               
                                            </td>
                                        </tr>

                                    </tbody>
                                    <thead class="totl">
                                        <tr style="    background: #07cd00;
                                            color: #fff;">


                                            <td style="line-height: 42px;">Available Credits:{{<?php echo $user_credits; ?>|currency:" "}}</td>
                                            <td>
                                                <input type="number" 
                                                       ng-change="checkOrderTotal()"
                                                       max="{{globleCartData.total_credit_limit}}" 
                                                       min="0" 
                                                       name="credit_price"
                                                       class="form-control" 
                                                       ng-model="globleCartData.used_credit" 
                                                       value="{{globleCartData.used_credit}}" 
                                                       style="width: 100px">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <th>{{globleCartData.grand_total|currency:" "}}</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <input type="hidden" value="{{globleCartData.total_price}}" name="sub_total_price">
                            <input type="hidden" value="{{globleCartData.total_quantity}}" name="total_quantity">
                            <input type="hidden" value="{{globleCartData.grand_total}}" name="total_price">
                            <div class="col-sm-12">


                                <div class="store-info">
                                    <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                </div>

                                <?php
                                if (count($user_address_details)) {
                                    ?>

                                    <button type="submit" name="place_order" class="btn btn-inverse"> Place Order</button> </div>
                            <?php } ?>
                        </form>
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



<!-- Modal -->
<div class="modal  fade" id="changeAddress" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="    z-index: 20000000;">
    <div class="modal-dialog modal-sm" role="document">
        <form action="#" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="font-size: 15px">Change Password</h4>
                </div>
                <div class="modal-body checkout-form">

                    <label>
                        Address
                        <input type="text" name="address"  value="" class="form-control">
                    </label>

                    <label>
                        City
                        <input type="text" name="city"  value="" class="form-control">
                    </label>
                    <br/>
                    <label>
                        State
                        <input type="text" name="state"  value="" class="form-control">
                    </label>
                    <label>
                        Pincode
                        <input type="text" name="pincode"  value="" class="form-control">
                    </label>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="add_address" class="btn btn-primary btn-small" style="color: white">Add Address</button>
                </div>
            </div>
        </form>
    </div>
</div>









<!--angular controllers-->
<script src="<?php echo base_url(); ?>assets/theme/angular/productController.js"></script>
<script>
    var avaiblecredits =<?php echo $user_credits; ?>;
</script>

<?php
$this->load->view('layout/footer');
?>