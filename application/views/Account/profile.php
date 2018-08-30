<?php
$this->load->view('layout/header');
?>
<style>
    .changepassword{
        margin-right: 60px;
        float: right;
        margin-top: 14px;
        text-decoration: underline;
        font-size: 17px;
    }
</style>

<section class="sub-bnr" data-stellar-background-ratio="0.5">
    <div class="position-center-center">
        <div class="container">
            <h4>My Profile</h4>

            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">My Profile</li>
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


                    <div class="col-md-9 checkout-form">
                        <?php
                        if ($msg) {
                            ?>
                            <div class="col-md-12">
                                <div class="alert alert-warning alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ion-android-close"></i> </span></button>
                                    <i class="fa fa-exclamation-triangle fa-2x"></i><?php echo $msg; ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                        <div class="row" style="margin-top: 50px;">  
                            <h6><?php echo $user_details->email; ?> <small>Email (For Login)</small> </h6>

                            <div class="checkout-form1">

                                <div class="row"> 

                                    <div class="col-sm-8 ">
                                        <div class="noti-check1">
                                            <h3 >Change Profile </h3> 

                                            <form class="create_account_form" method="post" action="#">
                                                <input type="hidden" name="user_id" value="45">
                                                <ul class="row">
                                                    <li class="col-sm-6">
                                                        <label>
                                                            First Name
                                                            <input type="text" name="first_name"  value="<?php echo $user_details->first_name; ?>">
                                                        </label>
                                                    </li>
                                                    <li class="col-sm-6">

                                                        <label>
                                                            Last Name
                                                            <input type="text" name="last_name" value="<?php echo $user_details->last_name; ?>">
                                                        </label>
                                                    </li>


                                                    <li class="col-sm-6">

                                                        <label>
                                                            Contact No.
                                                            <input type="text" name="contact_no"  value="<?php echo $user_details->contact_no; ?>">
                                                        </label>
                                                    </li>



                                                    <li class="col-sm-6">

                                                        <label>
                                                            Gender
                                                            <select name="gender" class="form-control" style="    background: #f5f5f5;
                                                                    height: 45px;
                                                                    font-size: 12px;
                                                                    line-height: 50px;
                                                                    border: none;
                                                                    color: #000;
                                                                    width: 100%;
                                                                    padding: 0 25px;border-radius: 0;">
                                                                <option  value="Male" <?php echo $user_details->gender == 'Male' ? "selected" : ""; ?>>Male</option>
                                                                <option  value="Female" <?php echo $user_details->gender == 'Female' ? "selected" : ""; ?>>Female</option>
                                                            </select>
                                                        </label> 
                                                    </li>

                                                    <li class="col-sm-6">

                                                        <label>
                                                            Date of Birth
                                                            <input type="date" name="birth_date"  value="<?php echo $user_details->birth_date; ?>">
                                                        </label>
                                                    </li>


                                                    <li class="col-sm-12">

                                                        <button name="update_profile" type="submit" class="registration btn e">Update Profile</button>

                                                        <a href="#." class="changepassword"  data-toggle="modal" data-target="#changePassword"><i class="fa fa-refresh"></i> Change Password</a>

                                                    </li>

                                                </ul>
                                            </form>
                                        </div>
                                    </div>

<!--                                    <div class="col-sm-4">  
                                        <div class="noti-check1">
                                            <h3 style="    color: #fff;"></h3>
                                            <center><img class="media-object img-responsive" src="post_image/user-default.jpg" alt="..." style="height:200px;"></center>
                                            <form method="post" action="#" enctype="multipart/form-data">
                                                <ul class="row">
                                                    <li class="col-sm-12">
                                                        <label>
                                                            <input type="file" class="" name="image" style="padding-top: 12px;">
                                                        </label>
                                                    </li>
                                                    <li class="col-sm-12">
                                                        <label>
                                                            <input type="submit" name="submit1" class="btn btn-inverse" value="Change Profile Image" >
                                                        </label>
                                                    </li>
                                                </ul>
                                            </form>
                                        </div>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
                </section>
            </div>
            <!-- End Content --> 


            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal  fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="    z-index: 20000000;">
                <div class="modal-dialog modal-sm" role="document">
                    <form action="#" method="post">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel" style="font-size: 15px">Change Password</h4>
                            </div>
                            <div class="modal-body checkout-form">

                                <label>
                                    Old Password
                                    <input type="text" name="old_password"  value="" class="form-control">
                                </label>

                                <label>
                                    New Password
                                    <input type="text" name="new_password"  value="" class="form-control">
                                </label>
                                <br/>
                                <label>
                                    Confirm Password
                                    <input type="text" name="re_password"  value="" class="form-control">
                                </label>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="change_password" class="btn btn-primary">Change Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <?php
            $this->load->view('layout/footer');
            ?>