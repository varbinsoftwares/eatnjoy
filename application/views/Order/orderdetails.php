<?php
$this->load->view('layout/header');
?>

<style>
    .order_box{
        padding: 10px;
        padding-bottom: 11px!important;
        height: 160px;
    }
    .order_box li{
        line-height: 19px!important;
        padding: 7px!important;
        border: none!important;
    }

    .order_box li i{
        float: left!important;
        line-height: 19px!important;
        margin-right: 13px!important;
    }
</style>

<!-- Slider -->
<section class="sub-bnr" data-stellar-background-ratio="0.5">
    <div class="position-center-center">
        <div class="container">
            <h4>Order No. #<?php echo $order_data->order_no; ?> </h4>
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="#">Order Details</a></li>

            </ol>
        </div>
    </div>
</section>

<!-- Content -->
<div id="content" ng-controller="OrderDetailsController"> 

    <!--======= PAGES INNER =========-->
    <section class="item-detail-page pad-t-b-60">
        <div class="container">
            <div class="row  "> 
                <div class="pricing">
                    <div class="col-md-4">
                        <article class="order_box">
                            <li><i class="fa fa-user"></i> <?php echo $order_data->name; ?> </li>
                            <li><i class="fa fa-phone"></i> <?php echo $order_data->contact_no; ?></li> 
                            <li><i class="fa fa-envelope"></i> <?php echo $order_data->email; ?> </li>
                        </article>
                    </div>

                    <div class="col-md-4">
                        <article class="order_box">
                            <li><i class="fa fa-map"></i> Shipping Adddress </li>
                            <li>  <?php echo $order_data->address; ?><br/>
                                <?php echo $order_data->state; ?>  <?php echo $order_data->city; ?> <?php echo $order_data->pincode; ?></li>
                        </article>
                    </div>

                    <div class="col-md-4">
                        <article class="order_box">
                            <li> <i class=" fa fa-chevron-circle-right"></i> <?php echo $order_data->order_no; ?></li>
                            <li> <i class="fa fa-calendar"></i> <?php echo $order_data->order_date; ?> </li>
                            <li> <i class="fa fa-clock-o"></i>  <?php echo $order_data->order_time; ?> </li>
                            <li> 
                                <button class="btn btn-inverse btn-small" ng-click="sendOrderMail('<?php echo $order_data->order_no; ?>')">
                                    Request Order Copy On Mail
                                </button>
                            </li>
                        </article>
                    </div>

                    <div class="col-md-12" style=" margin-top: 10px;">
                        <article class="" style="padding: 10px;">
                            <table class="table table-bordered"  border-color= "#9E9E9E" align="center" border="1" cellpadding="0" cellspacing="0" width="600" style="background: #fff;padding:20px">
                                <tr style="font-weight: bold">
                                    <td style="width: 20px;text-align: center">S.No.</td>
                                    <td colspan="2"  style="text-align: center">Product</td>

                                    <td style="text-align: center;width: 100px"">Price<br/><span style="font-size: 10px">(In INR)</span></td>
                                    <td style="text-align: center;width: 60px"">Qnty.</td>
                                    <td style="text-align: center;width: 100px">Total<br/><span style="font-size: 10px">(In INR)</span></td>
                                </tr>
                                <!--cart details-->
                                <?php
                                foreach ($cart_data as $key => $product) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $key + 1; ?>
                                        </td>

                                        <td style="width: 80px">
                                    <center>   <img src=" <?php echo $product->file_name; ?>" style="height: 70px;"></img>
                                        </td>

                                        <td style="width: 200px;">
                                            <?php echo $product->title; ?>
                                        </td>

                                        <td style="text-align: right">
                                            <?php echo $product->price; ?>
                                        </td>

                                        <td style="text-align: right">
                                            <?php echo $product->quantity; ?>
                                        </td>

                                        <td style="text-align: right;">
                                            <?php echo $product->total_price; ?>
                                        </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <!--end of cart details-->

                                    <tr>
                                        <td colspan="3"  rowspan="4" style="font-size: 12px">
                                            <b>Total Amount in Words:</b><br/>
                                            <span style="text-transform: capitalize"> <?php echo $amount_in_word; ?></span>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align: right">Total</td>
                                        <td style="text-align: right;width: 60px"><?php echo $order_data->sub_total_price; ?> </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align: right">Credit Used</td>
                                        <td style="text-align: right;width: 60px"><?php echo $order_data->credit_price; ?> </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align: right">Toal Amount</td>
                                        <td style="text-align: right;width: 60px"><?php echo $order_data->total_price; ?> </td>
                                    </tr>




                            </table>
                        </article>
                    </div>

                </div>

            </div>
        </div>
    </section>
</div>


<script>

    ClassApartStore.controller('OrderDetailsController', function ($scope, $http, $timeout, $interval) {
        var url = baseurl + "Api/order_mail/" + <?php echo $order_data->id; ?>+"/"+'<?php echo $order_data->order_no; ?>';
        console.log(url);
        $scope.sendOrderMail = function (order_no) {
            swal({
                title: 'Sending Mail...',
                onOpen: function () {
                    swal.showLoading()
                }
            })
            $http.get(url).then(function (rdata) {
                swal({
                    title: 'Mail Sent!',
                    type: 'success', })
            }, function () {
                  swal({
                    title: 'Unable To Send Mail!',
                    type: 'error', })
            })
        }

    })


</script>


<?php
$this->load->view('layout/footer');
?>