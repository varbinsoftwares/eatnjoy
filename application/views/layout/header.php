
<!doctype html>
<html class="no-js" lang="en">

    <!-- Mirrored from demos.webicode.com/html/BizTo/html/shop-sidebar.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 28 Feb 2018 16:18:20 GMT -->
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="author" content="" />
        <!-- Document Title -->
        <?php
        meta_tags();
        ?>
        <!-- Favicon -->
        <link rel="shortcut icon" href="<?php echo base_url() . 'assets/images/logo731.jpg'; ?>" type="image/x-icon">
        <link rel="icon" href="<?php echo base_url() . 'assets/images/logo731.jpg'; ?>" type="image/x-icon">

        <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/theme/rs-plugin/css/settings.css" media="screen" />

        <!-- StyleSheets -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme/css/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme/css/main.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme/css/responsive.css">


        <!-- Fonts Online -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800,900|Raleway:200,300,400,500,600,700,800,900" rel="stylesheet">


        <!-- JavaScripts -->
        <script src="<?php echo base_url(); ?>assets/theme/js/vendors/modernizr.js"></script>

        <!--sweet alert-->
        <script src="<?php echo base_url(); ?>assets/theme/sweetalert2/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme/sweetalert2/sweetalert2.min.css">


        <!--angular js-->
        <script src="<?php echo base_url(); ?>assets/theme/angular/angular.min.js"></script>
        <script src='<?php echo base_url(); ?>assets/theme/angular/angular-route.js'></script>




        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
    </head>
    <body ng-app="ClassApartStore">

        <!--LOADER--> 
        <!--        <div id="loader">
                    <div class="position-center-center">
                        <div class="loader"></div>
                    </div>
                </div>-->



        <script>
            var ClassApartStore = angular.module('ClassApartStore', []).config(function ($interpolateProvider, $httpProvider) {
                //$interpolateProvider.startSymbol('{$');
                //$interpolateProvider.endSymbol('$}');
                $httpProvider.defaults.headers.common = {};
                $httpProvider.defaults.headers.post = {};

            });
            var baseurl = "<?php echo base_url(); ?>index.php/";
            var avaiblecredits = 0;
        </script>

        <style>
            .ownmenu .dropdown.megamenu .dropdown-menu li:last-child{
                margin-bottom: 20px;
            }

            .ownmenu .dropdown.megamenu .dropdown-menu li a{
                line-height: 25px;
            }

        </style>


        <!-- Page Wrapper -->
        <div id="wrap" class="shop-page" ng-controller="ShopController"> 

            <!-- Header -->
            <header class="header">
                <div class="sticky">
                    <div class="container">
                        <div class="logo">
                            <a href="<?php echo site_url(); ?>"><img class="img-responsive" src="<?php echo base_url() . 'assets/images/logo73.png'; ?>" alt="logo" style="    
                                                                     height: 70px;
                                                                     max-width: 100%;"></a> 
                        </div>

                        <!-- Nav -->
                        <nav class="navbar ownmenu">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-open-btn" aria-expanded="false"> <span><i class="fa fa-navicon"></i></span> </button>
                            </div>

                            <!-- NAV -->
                            <div class="collapse navbar-collapse" id="nav-open-btn">
                                <ul class="nav">
                                    <li class="active"> 
                                        <a href="<?php echo site_url("/"); ?>">Home </a>
                                    </li>


                                    <!-- Mega Menu Nav -->
                                    <li class="dropdown megamenu"> <a href="#." class="dropdown-toggle" data-toggle="dropdown">Shop Now </a>
                                        <div class="dropdown-menu">
                                            <div class="mega-inside">
                                                <div class="row">
                                                    <div class="col-sm-3" ng-repeat="catv in categoriesMenu" >
                                                        <h6 style="margin-bottom: 0px">
                                                            <a href="<?php echo site_url("Product/ProductList/"); ?>{{catv.id}}" >{{catv.category_name}}</a>
                                                        </h6>
                                                        <ul>
                                                            <li ng-repeat="subv in catv.sub_category">
                                                                <a href="<?php echo site_url("Product/ProductList/"); ?>{{subv.id}}" >{{subv.category_name}}</a>
                                                            </li>
                                                            <li></li>
                                                        </ul>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </li>




                                    <?php
                                    $session_data = $this->session->userdata('logged_in');
                                    if ($session_data) {
                                        ?>
                                        <li class="dropdown"> <a href="contact_us_1.html" class="dropdown-toggle" data-toggle="dropdown">Hi, <?php echo $session_data['first_name'] ? $session_data['first_name'] : 'User'; ?>! </a>
                                            <ul class="dropdown-menu">
                                                <li><a href="<?php echo site_url("Account/profile"); ?>">Profile</a></li>
                                                <li><a href="<?php echo site_url("Account/orderList"); ?>">My Order</a></li>
                                                <li><a href="<?php echo site_url("Account/logout"); ?>">Logout</a></li>
                                            </ul>
                                        </li>
                                        <?php
                                    } else {
                                        ?>
                                        <li> <a href="<?php echo site_url("Account/login"); ?>" >Sign In / Sign Up </a>
                                        </li>

                                        <?php
                                    }
                                    ?>

                                </ul>
                            </div>

                            <!-- NAV RIGHT -->
                            <div class="nav-right">
                                <ul >
                                    <li class="dropdown user-basket"> <span class="cart-num">{{globleCartData.total_quantity}}</span> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="fa fa-shopping-cart"></i> </a>
                                        <ul class="dropdown-menu" ng-if="globleCartData.total_quantity">

                                            <!--prodcut cart list-->
                                            <li ng-repeat="product in globleCartData.products" class="animated flipInX">
                                                <div class="media-left">
                                                    <div class="cart-img"> 
                                                        <a href="#"> 
                                                            <img class="media-object img-responsive" src="{{product.file_name}}" alt="..."> 
                                                        </a> 
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="media-heading" style="font-size: 12px;">{{product.title}}</h6>
                                                    <span class="price">{{product.quantity}}    X    {{product.price|currency:" "}}</span> 
                                                </div>
                                                <a href="#." class="remov" ng-click="removeCart(product.product_id)">
                                                    <i class="fa fa-times"></i>
                                                </a> 
                                            </li>
                                            <!--end of product cart list-->
                                            <li class="margin-0 padding-0 price-cart-drop">
                                                <h5>Subtotal: <span>{{globleCartData.total_price|currency:" "}}</span></h5>
                                            </li>
                                            <li class="margin-0 padding-0"> 
                                                <a href="<?php echo site_url("Cart/details"); ?>" class="btn margin-bottom-20">VIEW CART</a> 
                                                <a href="<?php echo site_url("Product/customizationShirt"); ?>" class="btn">CUSTOMIZE</a>
                                            </li>
                                        </ul>

                                        <ul class="dropdown-menu" ng-if="globleCartData.products.length == 0">
                                            <li class="margin-0 padding-0 price-cart-drop">
                                                <h5>No Item Found</h5>
                                            </li>
                                            <li class="margin-0 padding-0"> 
                                                <a href="<?php echo site_url(); ?>" class="btn margin-bottom-20">HOME</a> 
                                            </li>
                                        </ul>
                                    </li>
                                    <li> <a href="javascript:void(0);" class="search-open"><i class="fa fa-search"></i></a>
                                        <div class="search-inside animated-4s fadeIn"> <i class="lnr lnr-cross search-close"></i>
                                            <div class="search-overlay"></div>
                                            <div class="position-center-center">
                                                <div class="container">
                                                    <div class="search">
                                                        <form>
                                                            <input type="search" placeholder="Type Your Search...">
                                                            <button type="submit"><i class="lnr lnr-magnifier"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>



                        </nav>
                    </div>
                </div>
            </header>
            <!-- End Header --> 