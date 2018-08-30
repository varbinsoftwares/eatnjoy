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



<section class="sub-bnr" data-stellar-background-ratio="0.5">
    <div class="position-center-center">
        <div class="container">
            <h4>My Addresses</h4>

            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">My Address</li>
            </ol>
        </div>
    </div>
</section>

<!-- Content -->
<div id="content"> 

    <!-- Blog -->
    <section class="new-main blog-posts ">
        <div class="container"> 

            <!-- News Post -->
            <div class="news-post">
                <div class="row"> 

                    <?php
                    $this->load->view('Account/sidebar');
                    ?>


                    <div class="col-md-9" style="margin-top:20px">
                        <!-- Address Details -->
                        <div class="col-md-12">
                            <div class="">
                                <h6>Addresses <button class="btn btn-small" data-toggle="modal" data-target="#changeAddress" style="margin-left: 20px;padding: 5px 11px;color:white;"><i class="fa fa-plus"></i> Add New</button></h6>
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
                                                        <a href="<?php echo site_url("Account/address/?setAddress=" . $value['id']); ?>" class="btn btn-small address_button">Set As Default</a>
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


            <?php
            $this->load->view('layout/footer');
            ?>