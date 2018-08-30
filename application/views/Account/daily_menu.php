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
                                <h6>Daily Menu <button class="btn btn-small" data-toggle="modal" data-target="#changeAddress" style="margin-left: 20px;padding: 5px 11px;color:white;"><i class="fa fa-plus"></i> Add Menu</button></h6>
                            </div>
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
                                                <h6><?php echo $value['menu_date']; ?> (<?php echo $value['menu_sift']; ?>)</h6>


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
                </section>
            </div>
            <!-- End Content --> 


            <!-- Modal -->
            <div class="modal  fade" id="changeAddress" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="    z-index: 20000000;">
                <div class="modal-dialog " role="document">
                    <form action="#" method="post">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel" style="font-size: 15px">Add Menu</h4>
                            </div>
                            <div class="modal-body checkout-form">

                                <label>
                                    Date
                                    <input type="date" name="menu_date"  value="<?php echo date('Y-m-d') ?>" class="form-control">
                                </label>
                                <label>
                                    Menu Sift
                                    <select name="menu_sift" class="form-control">
                                        <option value="Evening">Evening</option>
                                        <option value="Evening">Morning</option>
                                    </select>
                                </label>

                                <label>
                                    Menu 59
                                    <input type="text" name="menu_59"  value=" Sabji, Dal, Chawal, Roti, Salad, Raita" class="form-control">
                                </label>
                                <label>
                                    Menu 49
                                    <input type="text" name="menu_49"  value=" Sabji, Dal, Chawal, Roti, Salad" class="form-control">
                                </label>
                                <label>
                                    Menu 39
                                    <input type="text" name="menu_39"  value=" Sabji, Roti, Salad" class="form-control">
                                </label>
                                <label>
                                    Remark
                                    <input type="text" name="remark"  value="" class="form-control">
                                </label>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="add_menu" class="btn btn-primary btn-small" style="color: white">Add Address</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <?php
            $this->load->view('layout/footer');
            ?>