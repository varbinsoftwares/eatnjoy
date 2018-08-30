<?php
$this->load->view('layout/header');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-lazyload/8.7.1/lazyload.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Black+Ops+One|Bungee|Orbitron|Six+Caps|Wallpoet" rel="stylesheet">

<!-- get jQuery from the google apis or use your own -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- CSS STYLE-->
<link rel="stylesheet" type="text/css" href="https://unpkg.com/xzoom@1.0.14/dist/xzoom.css" media="all" />

<!-- XZOOM JQUERY PLUGIN  -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/js/jquery.zoom.js"></script>



<link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme/css/bootstrap.vertical-tabs.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme/css/style_custome.css">
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
        border: 1px solid rgba(0, 0, 0, 0.07);
        margin-bottom: 30px;
        box-shadow: 0px 0px 5px #00000017;
    }


    .shirtmodel1{
        margin-top: 7px;
        margin-left: 152px;
        width: 139px;
        height: auto;
    }


    .shirt11_model{
        z-index: 200;
        margin-top: 1px;
        margin-left: -0.5px;
    }

    .shirt_model{
        /*margin-top: 1.50px*/
    }

    .show_shirt_image{
        height: 50px;
    }



    .show_shirt_button{
        right: -30px;
    }

    .pant_model{
        height: 190px;
        width: 596px;
        position: absolute;
        margin-top: 251px;
        left: -160px;
    }



    .frame {

        font-family: sans-serif;
        overflow: hidden;
        width: 25vw;
        margin: 3vw;
        display: inline-block;

        .zoom {

            font-size: 1.3vw;
            transition: transform 0.2s linear;

        }


        img {

            max-width: 25vw;

        }


        .lorem {

            padding: 2% 2%;

        }


        form {

            margin : 2% auto;    
            text-align: center;

            button {

                font-size: inherit;
                margin: inherit;

            }

            input {

                border {
                    radius : 5px;
                    style: 1px solid;
                }    

                width :20vw;
                margin : 2% auto;
                padding: .5vw .8vw;
                font-size: 1.3vw;

            }
        }
    }

    .pantoverlay{
        top: 294px;
        width: 702px;
        left: -149px;
        height: auto;
    }


</style>
<!-- Slider -->


<div class="" ng-controller="customizationShirt">
    <!-- Slider -->
<!--    <section class="sub-bnr" data-stellar-background-ratio="0.5" style="font-weight: 300;
             font-size: 20px;">
        <div class="position-center-center">
            <div class="container">
                <div  class="row">

                </div>
            </div>
        </div>
    </section>-->

    <!-- Content -->
    <div id="content"> 

        <!--======= PAGES INNER =========-->
        <section class="item-detail-page padding-top-30 ">
            <div class="container" style="width: 100%">
                <div class="row"> 
                    <div class="col-md-12">
                        <div class="row">
                            <div class='custom_block_slide'> 
                                <div class="item"   ng-repeat="fab in cartFabrics">
                                    <div class=" fabricblockmobile ">
                                        <a href="#fabric_{{fab.folder}}" class="fabricblock_a" aria-controls="collars_area" role="tab" data-toggle="tab" ng-click="selectFabric(fab)">
                                            <div class="elementStyle customization_box_elements fabricblock {{  fab.folder == screencustom.fabric?'active' :'noselected' }}" style="background:url('<?php echo custome_image_server_suit; ?>/v2/output/{{fab.folder}}/fabric0001.png');" > </div>
                                            <p class="fabric_title">{{fab.folder}}</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--======= IMAGES SLIDER =========-->


                    <div class="col-sm-5 large-detail shirtcontainer  " >
                        <div class="col-sm-3 col-xs-12 fabricblockdesktop customization_items " style="padding: 0;    z-index: 10000;">
                            <ul class="nav nav-tabs tabs-left">
                                <li role="presentation" class="{{$index === 0?'active':''}} " ng-repeat="fab in cartFabrics" >
                                    <a href="#fabric_{{fab.folder}}" class="fabricblock_a" aria-controls="collars_area" role="tab" data-toggle="tab" ng-click="selectFabric(fab)">
                                        <div class="elementStyle customization_box_elements fabricblock {{  fab.folder == screencustom.fabric?'active' :'noselected' }}" style="background:url('<?php echo custome_image_server_suit; ?>/v2/output/{{fab.folder}}/fabricm0001.png');" > </div>
                                        <p class="fabric_title">{{fab.folder}}</p>
                                    </a>

                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-9 col-xs-12"  style="padding: 0">
                            <div class="tab-content">

                                <div class="tab-pane {{$index === 0?'active':''}} frame" ng-repeat="fab in cartFabrics" id="fabric_{{fab.folder}}" style="width: 380px;">
                                    <button class="btn btn-default btn-lg custom_rotate_button" ng-click="rotateModel()">
                                        <i class="icon ion-refresh"></i>
                                    </button>
                                    <button class="btn btn-default btn-lg custom_rotate_button show_shirt_button" ng-click="show_shirt('with_shirt')" style="margin-right: 65px;">
                                        <img src="<?php echo base_url(); ?>assets/images/customization_suit/jacket_with_shirt.png" class="show_shirt_image" >
                                    </button>
                                    <button class="btn btn-default btn-lg custom_rotate_button show_shirt_button" ng-click="show_shirt('without_shirt')">
                                        <img src="<?php echo base_url(); ?>assets/images/customization_suit/jacket_without_shirt.png" class="show_shirt_image" >
                                    </button>
                                    <div class="fontview_custom customization_block animated zoom "  ng-if="screencustom.view_type == 'front'" >

                                        <img src="<?php echo custome_image_server_suit; ?>/v2/output/{{fab.folder}}/back_no_vent0001.png" class="fixpos animated" >


                                        <img src="<?php echo custome_image_server_suit; ?>/v2/output/overlay/shirt2.png" class="fixpos animated">


                                        <!--pant overlaying-->
                                        <!--<img src="<?php echo custome_image_server_suit; ?>/pant/{{fab.folder}}/pant_f_front_1_pleat_v10001.png" class="fixpos animated pantoverlay" >-->



                                        <!--jacket sleeves-->  
                                        <img src="<?php echo custome_image_server_suit; ?>/v2/output/{{fab.folder}}/sleeve_new0001.png" class="fixpos animated" >

                                        <!--jacket pant-->  
                                        <!--<div class="pant_model " style="background:url(<?php // echo custome_image_server_suit;  ?>/pant/{{fab.folder}}/pant_f_front_1_pleat_v10001.png);    background-size: 723px;"></div>-->
                                        <img src="<?php echo custome_image_server_suit; ?>/pant/{{fab.folder}}/pant_suit_model0001.png" class="fixpos animated " >


<!--<img src="<?php echo custome_image_server_suit; ?>/v2/output/overlay/shirt2.png" class="fixpos animated">-->

                                        <!--button hole sleeve-->
                                        <img src="<?php echo custome_image_server_suit; ?>/v2/output/{{fab.folder}}/{{img}}" class="fixpos animated" ng-repeat="img in selecteElements[fab.folder]['Sleeve Buttons'].buttonhole" >



                                        <!--button sleeve-->
                                        <img src="<?php echo custome_image_server_suit; ?>/v2/buttons/{{selecteElements[fab.folder]['Buttons'].folder}}/{{img}}" class="fixpos animated" ng-repeat="img in selecteElements[fab.folder]['Sleeve Buttons'].elements" >


                                        <!--jacket body left-->
                                        <img src="<?php echo custome_image_server_suit; ?>/v2/output/{{fab.folder}}/{{img}}" class="fixpos animated" ng-repeat="img in [selecteElements[fab.folder]['Jacket Style'].left]" >

                                        <!--buttons-->
                                        <img src="<?php echo custome_image_server_suit; ?>/v2/buttons/{{selecteElements[fab.folder]['Buttons'].folder}}/{{img}}.png" class="fixpos animated" ng-repeat="img in selecteElements[fab.folder]['Jacket Style'].buttons2" >

                                        <!--jacket body right-->
                                        <img src="<?php echo custome_image_server_suit; ?>/v2/output/{{fab.folder}}/{{img}}" class="fixpos animated" ng-repeat="img in [selecteElements[fab.folder]['Jacket Style'].right]" >

                                        <!--button holes-->
                                        <img src="<?php echo custome_image_server_suit; ?>/v2/output/{{fab.folder}}/{{img}}" class="fixpos animated" ng-repeat="img in selecteElements[fab.folder]['Jacket Style'].button_hole" >


                                        <img src="<?php echo custome_image_server_suit; ?>/v2/output/{{fab.folder}}/dart0001.png" class="fixpos animated" >

                                        <!--breast pocket-->
                                        <img src="<?php echo custome_image_server_suit; ?>/v2/output/{{fab.folder}}/{{img}}" class="fixpos animated" ng-repeat="img in selecteElements[fab.folder]['Breast Pocket'].elements">

                                        <!--lower pocket-->
                                        <img src="<?php echo custome_image_server_suit; ?>/v2/output/{{fab.folder}}/{{img}}" class="fixpos animated" ng-repeat="img in selecteElements[fab.folder]['Lower Pocket'].elements">


                                        <img src="<?php echo custome_image_server_suit; ?>/v2/output/{{fab.folder}}/{{img}}" class="fixpos animated" ng-repeat="img in selecteElements[fab.folder]['Lapel Style & Width'].laple_style[selecteElements[fab.folder]['Jacket Style'].title].elements">

                                        <img src="<?php echo custome_image_server_suit; ?>/v2/output/overlay/{{img}}" class="fixpos animated" ng-repeat="img in selecteElements[fab.folder]['Lapel Style & Width'].laple_style[selecteElements[fab.folder]['Jacket Style'].title].overelay">



                                        <div class="" ng-if="selecteElements[fab.folder]['Handstitching'].title == 'Yes'">
                                            <img src="<?php echo custome_image_server_suit; ?>/v2/stitching/{{img}}" class="fixpos animated" ng-repeat="img in selecteElements[fab.folder]['Lapel Style & Width'].laple_style[selecteElements[fab.folder]['Jacket Style'].title].stitcing">
                                        </div>

                                        <div class="" ng-if="selecteElements[fab.folder]['Lapel Button Hole'].title == 'Yes'">
                                            <img src="<?php echo custome_image_server_suit; ?>/v2/thread/{{selecteElements[fab.folder]['Contrast Lapel Button Hole'].folder}}/{{img}}" class="fixpos animated" ng-repeat="img in selecteElements[fab.folder]['Lapel Style & Width'].laple_style[selecteElements[fab.folder]['Jacket Style'].title].hole" ng-if="selecteElements[fab.folder]['Contrast Lapel Button Hole'].title != 'Matching'">
                                            <img src="<?php echo custome_image_server_suit; ?>/v2/output/{{fab.folder}}/{{img}}" class="fixpos animated" ng-repeat="img in selecteElements[fab.folder]['Lapel Style & Width'].laple_style[selecteElements[fab.folder]['Jacket Style'].title].hole" ng-if="selecteElements[fab.folder]['Contrast Lapel Button Hole'].title == 'Matching'">
                                        </div>







                                        <!--buttons-->
                                        <img src="<?php echo custome_image_server_suit; ?>/v2/buttons/{{selecteElements[fab.folder]['Buttons'].folder}}/{{img}}.png" class="fixpos animated" ng-repeat="img in selecteElements[fab.folder]['Jacket Style'].buttons" >


                                        <img src="<?php echo custome_image_server_suit; ?>/v2/output/2_buttons_v20001.png" class="fixpos animated" >



                                        <img src="<?php echo custome_image_server_suit; ?>/v2/output/overlay/{{img}}" class="fixpos animated" ng-repeat="img in selecteElements[fab.folder]['Jacket Style'].overlay" >


                                        <!--<img src="<?php echo custome_image_server_suit; ?>/v2/output/single_over_lay.png" class="fixpos animated" >-->

                                        <!--<img src="<?php echo custome_image_server_suit; ?>/v2/output/shirtss.png" class="fixpos animated" >-->






                                    </div>   
                                    <div class="backview_custom customization_block zoom animated " ng-if="screencustom.view_type == 'pant'">

                                        <img src="<?php echo custome_image_server_suit; ?>/pant2/overlay/pantoverlay3.png" class="fixpos animated">
                                        <img src="<?php echo custome_image_server_suit; ?>/pant2/overlay/pantoverlay1.png" class="fixpos animated">

                                        <!--font-->
                                        <img src="<?php echo custome_image_server_suit; ?>/pant2/{{fab.folder}}/{{img}}" class="fixpos animated" ng-repeat="img in selecteElements[fab.folder]['Number of Pleat'].elements">
                                        <img src="<?php echo custome_image_server_suit; ?>/pant2/overlay/{{img}}" class="fixpos animated" ng-repeat="img in selecteElements[fab.folder]['Number of Pleat'].overlay">



                                        <img src="<?php echo custome_image_server_suit; ?>/pant2/{{fab.folder}}/{{img}}" class="fixpos animated" ng-repeat="img in selecteElements[fab.folder]['Front Pocket Style'].elements">      

                                        <img src="<?php echo custome_image_server_suit; ?>/pant2/{{fab.folder}}/{{img}}" class="fixpos animated" ng-repeat="img in selecteElements[fab.folder]['Waistband'].elements">

                                        <img src="<?php echo custome_image_server_suit; ?>/pant2/overlay/pantoverlay5.png" class="fixpos animated">
                                        <img src="<?php echo custome_image_server_suit; ?>/pant2/overlay/pantoverlay2.png" class="fixpos animated">


                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--======= ITEM DETAILS =========-->
                    <div class="col-sm-7 col-xs-12">
                        <!--shirt customization-->
                        <div class="row" style="margin-top: -10px;padding: 5px;">
                            <?php
                            $this->load->view('Product/custome_support_suit2');
                            ?> 
                        </div>
                    </div>
                </div>

                <div class="row customization_order_block">

                    <div class="col-md-8 col-xs-3">
                        <button class="btn btn-inverse pull-left" style="    padding: 20px 5px;" ng-click="pullUp()"><i class="fa fa-arrow-up"></i></button>
                    </div>
                    <div class="col-md-2 col-xs-5">
                        <div class="total_price_block">
                            <h5> {{fabricCartData['grand_total']|currency:"<?php echo globle_currency_type; ?>"}}</h5>
                        </div>
                    </div>
                    <div class="col-md-2 col-xs-4">
                        <button class="btn btn-inverse pull-right" style="    padding: 20px 5px;">
                            Order Now  <i class="fa fa-arrow-right"></i>
                        </button>
                    </div>





                </div>

            </div>
        </section>


    </div>
    <!-- End Content --> 

</div>



<!--angular controllers-->
<script src="<?php echo base_url(); ?>assets/theme/angular/ng-suitcustomization2.js"></script>


<?php
$this->load->view('layout/footer');
?>
