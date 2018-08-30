<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

class Api2 extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->library('session');
        $this->checklogin = $this->session->userdata('logged_in');
        $this->user_id = $this->session->userdata('logged_in')['login_id'];
    }

    public function index() {
        $this->load->view('welcome_message');
    }

//function for product list
    function cartOperation_post() {
        $product_id = $this->post('product_id');
        $quantity = $this->post('quantity');

        if ($this->checklogin) {
            $session_cart = $this->Product_model->cartOperation($product_id, $quantity, $this->user_id);
            $session_cart = $this->Product_model->cartData($this->user_id);
        } else {
            $session_cart = $this->Product_model->cartOperation($product_id, $quantity);
            $session_cart = $this->Product_model->cartData();
        }

        $this->response($session_cart['products'][$product_id]);
    }

    function cartOperation_get() {
        if ($this->checklogin) {
            $session_cart = $this->Product_model->cartData($this->user_id);
        } else {
            $session_cart = $this->Product_model->cartData();
        }

        $this->response($session_cart);
    }

    function cartOperationShirt_get() {
        if ($this->checklogin) {
            $session_cart = $this->Product_model->cartData($this->user_id);
        } else {
            $session_cart = $this->Product_model->cartData();
        }

        $tempss = array();
        foreach ($session_cart['products'] as $key => $value) {
            if ($value['item_type'] != 'Jacket') {
                $tempss[$key] = $value;
            };
        }
        $session_cart['products'] = $tempss;
        $this->response($session_cart);
    }

    function cartOperationSuit_get() {
        if ($this->checklogin) {
            $session_cart = $this->Product_model->cartData($this->user_id);
        } else {
            $session_cart = $this->Product_model->cartData();
        }
        $tempss = array();
        foreach ($session_cart['products'] as $key => $value) {
            if ($value['item_type'] == 'Jacket') {
                $tempss[$key] = $value;
            };
        }
        $session_cart['products'] = $tempss;
        $this->response($session_cart);
    }

    function cartOperation_delete($product_id) {
        if ($this->checklogin) {
            $cartdata = $this->Product_model->cartData($this->user_id);
            $cid = $cartdata['products'][$product_id]['id'];
            $this->db->where('id', $cid); //set column_name and value in which row need to update
            $this->db->delete('cart'); //
        } else {
            $session_cart = $this->session->userdata('session_cart');
            unset($session_cart['products'][$product_id]);
            $this->session->set_userdata('session_cart', $session_cart);
        }
    }

    function cartOperation_put($product_id, $quantity) {
        if ($this->checklogin) {
            $cartdata = $this->Product_model->cartData($this->user_id);
            $total_price = $cartdata['products'][$product_id]['price'] * $quantity;
            $total_quantity = $quantity;
            $cid = $cartdata['products'][$product_id]['id'];
            $this->db->set('quantity', $total_quantity);
            $this->db->set('total_price', $total_price);
            $this->db->where('id', $cid); //set column_name and value in which row need to update
            $this->db->update('cart'); //
        } else {
            $session_cart = $this->session->userdata('session_cart');
            $session_cart['products'][$product_id]['quantity'] = $quantity;
            $price = $session_cart['products'][$product_id]['price'];
            $session_cart['products'][$product_id]['total_price'] = $quantity * $price;
            $this->session->set_userdata('session_cart', $session_cart);
        }
    }

//Product 
//ProductList APi
    public function productListApi_get($category_id) {
        $attrdatak = $this->get();
        $products = [];
        $countpr = 0;


        if (isset($attrdatak["minprice"])) {
            $mnpricr = $attrdatak["minprice"] - 1;
            $mxpricr = $attrdatak["maxprice"] + 1;
            unset($attrdatak["minprice"]);
            unset($attrdatak["maxprice"]);
            $pricequery = " and (price between '$mnpricr' and '$mxpricr') ";
        }

        foreach ($attrdatak as $key => $atv) {
            if ($atv) {
                $countpr += 1;
                $key = str_replace("a", "", $key);
                $val = str_replace("-", ", ", $atv);
                $query_attr = "SELECT product_id FROM product_attribute
                           where attribute_id in ($key) and attribute_value_id in ($val)
                           group by product_id ";
                $queryat = $this->db->query($query_attr);
                $productslist = $queryat->result();
                foreach ($productslist as $key => $value) {
                    array_push($products, $value->product_id);
                }
            }
        }
//print_r($products);

        $productdict = [];

        $productcheck = array_count_values($products);


//print_r($productcheck);

        foreach ($productcheck as $key => $value) {
            if ($value == $countpr) {
                array_push($productdict, $key);
            }
        }

        $proquery = "";
        $pricequery = "";
        if (count($productdict)) {
            $proquerylist = implode(",", $productdict);
            $proquery = " and pt.id in ($proquerylist) ";
        }

        $categoriesString = $this->Product_model->stringCategories($category_id) . ", " . $category_id;
        $categoriesString = ltrim($categoriesString, ", ");

        $product_query = "select pt.id as product_id, pt.folder, pt.item_type, pt.sku, pt.title, pt.sale_price, pt.regular_price, pt.price, pt.file_name, pt.file_name1 
            from products as pt where pt.category_id in ($categoriesString) $pricequery $proquery 
                order by pt.id desc";
        try {
            $product_result = $this->Product_model->query_exe($product_query);
        } catch (Exception $e) {
            $product_result = [];
        }
        $product_list_st = [];

        $pricecount = [];

        foreach ($product_result as $key => $value) {
            array_push($product_list_st, $value['product_id']);
            array_push($pricecount, $value['price']);
        }

        $attr_filter = array();
        $pricelist = array();

        ob_clean();
        $productArray = array('attributes' => $attr_filter,
            'products' => $product_result,
            'product_count' => count($product_result),
            'price' => $pricelist);
        $this->response($productArray);
    }

//category list api
    function categoryMenu_get() {
        $categories = $this->Product_model->productListCategories(0);
        $this->response($categories);
    }

//order detail get
    function orderDetails_get($order_id) {
        $order_details = $this->Product_model->getOrderDetails($order_id);
        $this->response($order_details);
    }

    function order_mail_get($order_id, $order_no) {
        $subject = "Class Apart Store Order No. #" . $order_no . " Copy";
        $this->Product_model->order_mail($order_id, $subject);
    }

    function orderMailVender_get($order_id) {
        $this->Product_model->order_mail_to_vendor($order_id);
        $this->response("hell");
    }

    function customeElementsSuit_get() {
        $customeele = array(
            "keys" => [
                array(
                    "title" => "Jacket Style",
                    "viewtype" => "front",
                    "type" => "main",
                ),
                array(
                    "title" => "Lapel Style & Width",
                    "viewtype" => "front",
                    "type" => "main",
                ),
                array(
                    "title" => "Lapel Button Hole",
                    "viewtype" => "front",
                    "type" => "main",
                ),
                array(
                    "title" => "Handstitching",
                    "viewtype" => "front",
                    "type" => "main",
                ),
                array(
                    "title" => "Contrast Lapel Button Hole",
                    "viewtype" => "front",
                    "type" => "submain",
                ),
                array(
                    "title" => "Breast Pocket",
                    "viewtype" => "front",
                    "type" => "main",
                ),
                array(
                    "title" => "Lower Pocket",
                    "viewtype" => "front",
                    "type" => "main",
                ),
                array(
                    "title" => "Sleeve Buttons",
                    "viewtype" => "front",
                    "type" => "main",
                    "style_side" => "    background-size: 19%!important;",
                ),
                array(
                    "title" => "Contrast First Sleeve Button Hole",
                    "viewtype" => "front",
                    "type" => "submain",
                ),
//                array(
//                    "title" => "Back Vent",
//                    "viewtype" => "back",
//                    "type" => "main",
//                ),
                array(
                    "title" => "Buttons",
                    "viewtype" => "front",
                    "type" => "main",
                ),
//                array(
//                    "title" => "Lining Style",
//                    "viewtype" => "front",
//                    "type" => "main",
//                ),
                array(
                    "title" => "Button Thread",
                    "viewtype" => "front",
                    "type" => "main",
                ),
                array(
                    "title" => "Number of Pleat",
                    "viewtype" => "pant",
                    "type" => "main",
                ),
                array(
                    "title" => "Waistband",
                    "viewtype" => "pant",
                    "type" => "main",
                ),
            ],
            "collar_cuff_insert" => array(),
            "data" => array(
                "Number of Pleat" => [
                    array(
                        "status" => "1",
                        "title" => "No Pleat",
                        "customization_category_id" => "4",
                        "elements" => ["pant_no_pleat0001.png"],
                        "image" => "no_pleat.jpeg",
                        "show_buttons" => "true",
                    ),
                    array(
                        "status" => "0",
                        "title" => "1 Pleat Standard",
                        "elements" => ["pant_1_pleat0001.png"],
                        "customization_category_id" => "4",
                        "image" => "1_pleat_s.jpeg",
                        "show_buttons" => "true",
                    ),
                    
                    array(
                        "status" => "0",
                        "title" => "1 Pleat English (Reverse Pleat)",
                        "elements" => ["pant_r1_pleat0001.png"],
                        "overlay" => ["pant_r1_overlay.png"],
                        "customization_category_id" => "4",
                        "image" => "1_pleat_s.jpeg",
                        "show_buttons" => "true",
                    ),
                    
                    array(
                        "status" => "0",
                        "title" => "2 Pleats Standard",
                        "elements" => ["pant_2_pleat0001.png"],
                        "customization_category_id" => "4",
                        "image" => "2_pleat_s.jpeg",
                        "show_buttons" => "true",
                    )
                ],
                "Waistband" => [
                    array(
                        "status" => "1",
                        "title" => "No Belt Loop",
                        "customization_category_id" => "4",
                        "elements" => ["pant_waistband0001.png"],
                        "image" => "no_belt_loop.jpeg",
                        "show_buttons" => "true",
                    ), array(
                        "status" => "0",
                        "title" => "Belt Loop",
                        "elements" => ["pant_waistband0001.png", "pant_belt_loop0001.png"],
                        "customization_category_id" => "4",
                        "image" => "belt_loop.jpeg",
                        "show_buttons" => "true",
                    ),
                ],
                "Front Pocket Style" => [
                    array(
                        "status" => "1",
                        "title" => "Slenting Pocket",
                        "customization_category_id" => "4",
                        "elements" => ["pant_pocket_slanted0001.png"],
                        "image" => "slenting_pocket_pant.jpeg",
                        "show_buttons" => "true",
                    ), array(
                        "status" => "0",
                        "title" => "Piped",
                        "elements" => ["pant_pocket_pipe0001.png"],
                        "customization_category_id" => "4",
                        "image" => "pipe_pocket_pant.jpeg",
                        "show_buttons" => "true",
                    ),
                    array(
                        "status" => "0",
                        "title" => "Seam",
                        "elements" => ["pant_pocket_seam0001.png"],
                        "customization_category_id" => "4",
                        "image" => "seam_pocket_pant.jpeg",
                        "show_buttons" => "true",
                    )
                ],
                "Lining Style" => [
                    array(
                        "status" => "1",
                        "title" => "3276",
                        "image" => "lining/3276.jpg",
                        "folder" => "3276",
                    ),
                    array(
                        "status" => "1",
                        "title" => "K5",
                        "image" => "lining/K5.jpg",
                        "folder" => "K5",
                    ),
                    array(
                        "status" => "1",
                        "title" => "K1",
                        "image" => "lining/K1.jpg",
                        "folder" => "K1",
                    ),
                ],
                "Button Thread" => [
                    array(
                        "status" => "1",
                        "title" => "Matching",
                        "image" => "thread/Matching.jpg",
                        "folder" => "Matching",
                    ),
                    array(
                        "status" => "0",
                        "title" => "3223",
                        "image" => "thread/3223.jpg",
                        "folder" => "3223",
                    ),
                    array(
                        "status" => "0",
                        "title" => "3235",
                        "image" => "thread/3235.jpg",
                        "folder" => "3235",
                    ),
                    array(
                        "status" => "0",
                        "title" => "3235",
                        "image" => "thread/3235.jpg",
                        "folder" => "3235",
                    ),
                    array(
                        "status" => "0",
                        "title" => "3241",
                        "image" => "thread/3241.jpg",
                        "folder" => "3241",
                    ),
                    array(
                        "status" => "0",
                        "title" => "3242",
                        "image" => "thread/3242.jpg",
                        "folder" => "3242",
                    ),
                    array(
                        "status" => "0",
                        "title" => "3259",
                        "image" => "thread/3259.jpg",
                        "folder" => "3259",
                    ),
                    array(
                        "status" => "0",
                        "title" => "3276",
                        "image" => "thread/3276.jpg",
                        "folder" => "3276",
                    ),
                    array(
                        "status" => "0",
                        "title" => "3280",
                        "image" => "thread/3280.jpg",
                        "folder" => "3280",
                    ),
                    array(
                        "status" => "0",
                        "title" => "3297",
                        "image" => "thread/3297.jpg",
                        "folder" => "3297",
                    ),
                    array(
                        "status" => "0",
                        "title" => "3316",
                        "image" => "thread/3316.jpg",
                        "folder" => "3316",
                    ),
                ],
                "Contrast Lapel Button Hole" => [
                    array(
                        "status" => "1",
                        "title" => "Matching",
                        "image" => "thread/Matching.jpg",
                        "folder" => "Matching",
                    ),
                ],
                "Buttons" => [
                    array(
                        "status" => "1",
                        "title" => "Brown Lipshell",
                        "customization_category_id" => "4",
                        "image" => "buttonlipsell.png",
                        "folder" => "buttonlipsell",
                        "show_buttons" => "true",
                    ), array(
                        "status" => "0",
                        "title" => "Emerald Lipshell",
                        "folder" => "buttonemrald",
                        "customization_category_id" => "4",
                        "image" => "buttonemrald.png",
                        "show_buttons" => "true",
                    ),
                    array(
                        "status" => "0",
                        "title" => "Horn",
                        "folder" => "buttonhorn",
                        "customization_category_id" => "4",
                        "image" => "buttonhorn.png",
                        "show_buttons" => "true",
                    ),
                    array(
                        "status" => "0",
                        "title" => "Gold",
                        "folder" => "buttongold",
                        "customization_category_id" => "4",
                        "image" => "buttongold.png",
                        "show_buttons" => "true",
                    ),
                    array(
                        "status" => "0",
                        "title" => "Silver",
                        "folder" => "buttonsilver",
                        "customization_category_id" => "4",
                        "image" => "buttonsilver.png",
                        "show_buttons" => "true",
                    ),
                    array(
                        "status" => "0",
                        "title" => "Leather",
                        "folder" => "buttonleather",
                        "customization_category_id" => "4",
                        "image" => "buttonleather.png",
                        "show_buttons" => "true",
                    ),
                ],
                "Breast Pocket" => [
                    array(
                        "status" => "1",
                        "title" => "Slanted Pocket",
                        "customization_category_id" => "4",
                        "elements" => ["breast_pocket_v30001.png"],
                        "image" => "slented_pocket.jpeg",
                        "show_buttons" => "true",
                    ), array(
                        "status" => "0",
                        "title" => "No Pocket",
                        "elements" => [],
                        "customization_category_id" => "4",
                        "image" => "no_pocket.jpeg",
                        "show_buttons" => "true",
                    )],
                "Back Vent" => [
                    array(
                        "status" => "0",
                        "title" => "No Vent",
                        "customization_category_id" => "4",
                        "elements" => ["back_sleeve0001.png", "back_side__no_vent0001.png"],
                        "image" => "no_vent.jpeg",
                        "show_buttons" => "true",
                    ), array(
                        "status" => "0",
                        "title" => "Center Vent",
                        "elements" => ["back_sleeve0001.png", "back_side_center_vent0001.png"],
                        "customization_category_id" => "4",
                        "image" => "center_vent.jpeg",
                        "show_buttons" => "false",
                    ), array(
                        "status" => "1",
                        "title" => "Side Vent",
                        "elements" => ["back_sleeve0001.png", "back_side__side_vent0001.png"],
                        "customization_category_id" => "4",
                        "image" => "side_vent.jpeg",
                        "show_buttons" => "true",
                    )],
                "Lapel Button Hole" => [
                    array(
                        "status" => "1",
                        "title" => "Yes",
                        "customization_category_id" => "4",
                        "elements" => ["back_sleeve0001.png", "back_side__no_vent0001.png"],
                        "image" => "button_hole_yes.jpeg",
                        "show_buttons" => "true",
                        "insert" => "Matching",
                    ), array(
                        "status" => "0",
                        "title" => "No",
                        "elements" => ["back_sleeve0001.png", "back_side_center_vent0001.png"],
                        "customization_category_id" => "4",
                        "image" => "button_hole_no.jpeg",
                        "show_buttons" => "false",
                        "insert" => "Matching",
                    )],
                "Handstitching" => [
                    array(
                        "status" => "1",
                        "title" => "No",
                        "image" => "handstitchyes.jpeg",
                    ), array(
                        "status" => "0",
                        "title" => "Yes",
                        "image" => "handstitchno.jpeg"
                    )],
                "Sleeve Buttons" => [
                    array(
                        "status" => "1",
                        "title" => "4 Flat Buttons",
                        "customization_category_id" => "4",
                        "elements" => ["sleeve_buttons_10001.png", "sleeve_buttons_comman0001.png", "sleeve_buttons_40001.png",],
                        "image" => "4fbuttons.jpeg",
                        "buttons" => ["sleeve_buttons_flat_30001", "sleeve_buttons_flat_3_40001"],
                        "buttonhole" => ["sleeve_button_hole_40001.png", "sleeve_button_hole_comman0001.png", "sleeve_button_hole_10001.png"],
                        "show_buttons" => "true",
                    ),
//                    array(
//                        "status" => "0",
//                        "title" => "4 Kissing Buttons",
//                        "elements" => ["sleeve_buttons_kissing_3_hole0001.png", "sleeve_buttons_kissing_4_hole0001.png",],
//                        "customization_category_id" => "4",
//                        "image" => "4kbuttons.jpeg",
//                        "buttons" => ["sleeve_buttons_kissing_30001", "sleeve_buttons_kissing_40001"],
//                        "show_buttons" => "false",
//                    ), 
                    array(
                        "status" => "1",
                        "title" => "3 Flat Buttons",
                        "customization_category_id" => "4",
                        "elements" => ["sleeve_buttons_comman0001.png", "sleeve_buttons_40001.png"],
                        "image" => "4fbuttons.jpeg",
                        "buttons" => ["sleeve_buttons_flat_30001"],
                        "buttonhole" => ["sleeve_button_hole_40001.png", "sleeve_button_hole_comman0001.png",],
                        "show_buttons" => "true",
                    ),
//                    array(
//                        "status" => "0",
//                        "title" => "3 Kissing Buttons",
//                        "elements" => ["sleeve_buttons_kissing_3_hole0001.png",],
//                        "customization_category_id" => "4",
//                        "image" => "4kbuttons.jpeg",
//                        "buttons" => ["sleeve_buttons_kissing_30001"],
//                        "show_buttons" => "false",
//                    ),
//                    array(
//                        "status" => "0",
//                        "title" => "4 Flat Buttons First Contrast",
//                        "customization_category_id" => "4",
//                        "elements" => ["sleeve_buttons_flat_3_hole0001.png", "sleeve_buttons_flat_3_4_hole0001.png",],
//                        "image" => "4fbuttons.jpeg",
//                        "buttons" => ["sleeve_buttons_flat_30001",],
//                        "show_buttons" => "true",
//                    ),
                ],
                "Lower Pocket" => [
//                    array(
//                        "status" => "1",
//                        "title" => "Slanted Flap Pocket",
//                        "customization_category_id" => "4",
//                        "elements" => ["lower_pocket_slanting_flap0001.png"],
//                        "image" => "lower_flap_pocket.jpeg",
//                        "show_buttons" => "true",
//                    ), 
                    array(
                        "status" => "1",
                        "title" => "Straight Flap Pocket",
                        "customization_category_id" => "4",
                        "elements" => ["pocket_lower_flap_left0001.png", "pocket_lower_flap_right0001.png"],
                        "image" => "lower_flap_pocket.jpeg",
                        "show_buttons" => "true",
                    )
                    , array(
                        "status" => "0",
                        "title" => "Patch Pocket",
                        "elements" => ["pocket_lower_patch_left0001.png", "pocket_lower_patch_right0001.png"],
                        "customization_category_id" => "4",
                        "image" => "lower_patch_pocket.jpeg",
                        "show_buttons" => "false",
                    )
//                    , array(
//                        "status" => "0",
//                        "title" => "Pipe Pocket",
//                        "elements" => ["pocket_lower_pipe_left0001.png", "pocket_lower_pipe_right0001.png"],
//                        "customization_category_id" => "4",
//                        "image" => "lower_pipe_pocket.jpeg",
//                        "show_buttons" => "false",
//                    ), 
//                    array(
//                        "status" => "0",
//                        "title" => "Slanting Pipe Pocket",
//                        "elements" => ["lower_slanting_pocket0001.png"],
//                        "customization_category_id" => "4",
//                        "image" => "lower_slanting_pipe.jpeg",
//                        "show_buttons" => "true",
//                    )
                ],
                "Jacket Style" => [
                    array(
                        "status" => "1",
                        "title" => "1 Button",
                        "customization_category_id" => "4",
                        "elements" => ['body_single_left_v40001.png', 'body_single_right_v40001.png',],
                        "image" => "1_button.jpg",
                        "left" => "body_single_left_v40001.png",
                        "right" => "body_single_right_v40001.png",
                        "buttons" => ["buttons_10001"],
                        "button_hole" => ["button_1_hole10001.png"],
                        "show_buttons" => "true",
                        "overlay" => ["single_overlay.png"],
                    ), array(
                        "status" => "0",
                        "title" => "2 Buttons",
                        "customization_category_id" => "4",
                        "elements" => ['body_single_left_v40001.png', 'body_single_right_v40001.png',],
                        "image" => "1_button.jpg",
                        "left" => "body_single_left_v40001.png",
                        "right" => "body_single_right_v40001.png",
                        "buttons" => ["buttons_10001"],
                        "buttons2" => ["buttons_20001"],
                        "button_hole" => ["button_1_hole0001.png", "button_1_hole20001.png"],
                        "show_buttons" => "false",
                        "overlay" => [ "single_overlay.png"],
                    )
                    , array(
                        "status" => "0",
                        "title" => "4 Buttons 1 Button Fasten",
                        "elements" => ["body_double_left_v40001.png", "body_double_right_v40001.png",],
                        "customization_category_id" => "4",
                        "image" => "41_button.jpg",
                        "left" => "body_double_left_v40001.png",
                        "right" => "body_double_right_v40001.png",
                        "button_hole" => ["button_4_hole_10001.png", "button_4_hole_20001.png"],
                        "buttons" => ["button_4_10001", "button_4_30001", "button_4_40001"],
                        "buttons2" => ["button_4_20001"],
                        "show_buttons" => "true",
                        "overlay" => ["body_double_overlay.png"],
                    )
                    , array(
                        "status" => "0",
                        "title" => "6 Buttons 2 Buttons Fasten",
                        "elements" => ["body_double_left_v40001.png", "body_double_right_v40001.png",],
                        "customization_category_id" => "4",
                        "left" => "body_double_left_v40001.png",
                        "right" => "body_double_right_v40001.png",
                        "button_hole" => ["button_4_hole_10001.png", "button_4_hole_20001.png"],
                        "buttons" => ["button_4_10001", "button_4_30001", "button_4_40001", "button_6_10001", "button_6_20001"],
                        "buttons2" => ["button_4_20001"],
                        "image" => "62_button.jpg",
                        "show_buttons" => "true",
                        "overlay" => ["body_double_overlay.png"],
                    )
                ],
                "Lapel Style & Width" => [
                    array(
                        "status" => "1",
                        "title" => "Notch Laple Morden",
                        "elements" => ["body_round0001.png"],
                        "laple_style" => array(
                            "1 Button" => array("elements" => [
                                    "laple_notch_peak_upper_v40001.png",
                                    "laple_notch_v20001.png"
                                ],
                                "stitcing" => ['laple_notch_stitching.png'],
                                "hole" => ["laple_double_notch_button_hole0001.png"],
                                "overelay" => ["13notchpeaklapleoverlay.png", "laple_single_notch_modern_overlay.png"]),
                            "2 Buttons" => array("elements" => [
                                    "laple_notch_peak_upper_v40001.png",
                                    "laple_notch_v20001.png"
                                ],
                                "stitcing" => ['laple_notch_stitching.png'],
                                "hole" => ["laple_double_notch_button_hole0001.png"],
                                "overelay" => ["13notchpeaklapleoverlay.png", "laple_single_notch_modern_overlay.png"]),
                            "3 Buttons" => array("elements" => [
                                    "laple_single_3_notch_peak_upper0001.png",
                                    "laple_single_3_notch_modern0001.png"
                                ], "overelay" => ["13notchpeaklapleoverlay.png"]),
                            "4 Buttons" => array("elements" => [
                                    "laple_single_3_notch_peak_upper0001.png",
                                    "laple_single_3_notch_modern0001.png"
                                ], "overelay" => ["13notchpeaklapleoverlay.png"]),
                            "4 Buttons 1 Button Fasten" => array("elements" => [
                                    "laple_notch_peak_upper_v40001.png",
                                    "laple_double_notch_v20001.png"
                                ],
                                "stitcing" => ['laple_double_notch_stitch.png'],
                                "hole" => ["laple_double_notch_button_hole0001.png"],
                                "overelay" => []),
                            "4 Buttons 2 Buttons Fasten" => array("elements" => [
                                    "laple_notch_peak_upper_v40001.png",
                                    "laple_double_notch_v20001.png"
                                ],
                                "stitcing" => ['laple_double_notch_stitch.png'],
                                "hole" => ["laple_double_notch_button_hole0001.png"],
                                "overelay" => []),
                            "6 Buttons 1 Button Fasten" => array("elements" => [
                                    "laple_notch_upper0001.png",
                                    "laple_6_notch_modrn0001.png"
                                ], "overelay" => []),
                            "6 Buttons 2 Buttons Fasten" => array("elements" => [
                                    "laple_notch_peak_upper_v40001.png",
                                    "laple_double_notch_v20001.png"
                                ],
                                "stitcing" => ['laple_double_notch_stitch.png'],
                                "hole" => ["laple_double_notch_button_hole0001.png"],
                                "overelay" => []),
                        ),
                        "customization_category_id" => "6",
                        "image" => "notch_modern.jpeg"
                    ),
                    array(
                        "status" => "0",
                        "title" => "Peak Laple Morden",
                        "elements" => ["body_round0001.png"],
                        "laple_style" => array(
                            "1 Button" => array("elements" => [
                                    "laple_notch_peak_upper_v40001.png",
                                    "laple_peak_v20001.png"
                                ],
                                "stitcing" => ['laple_peak_stitch.png'],
                                "hole" => ["laple_double_peak_button_hole0001.png"],
                                "overelay" => ["laple_peak_overlay.png"]),
                            "2 Buttons" => array("elements" => [
                                    "laple_notch_peak_upper_v40001.png",
                                    "laple_peak_v20001.png"
                                ],
                                "stitcing" => ['laple_peak_stitch.png'],
                                "hole" => ["laple_double_peak_button_hole0001.png"],
                                "overelay" => ["laple_peak_overlay.png"]),
                            "3 Buttons" => array("elements" => [
                                    "laple_single_3_notch_peak_upper0001.png",
                                    "laple_single_3_peak_morden0001.png"
                                ], "overelay" => ["13notchpeaklapleoverlay.png"]),
                            "4 Buttons" => array("elements" => [
                                    "laple_single_3_notch_peak_upper0001.png",
                                    "laple_single_3_peak_morden0001.png"
                                ], "overelay" => ["13notchpeaklapleoverlay.png"]),
                            "4 Buttons 1 Button Fasten" => array("elements" => [
                                    "laple_notch_peak_upper_v40001.png",
                                    "laple_double_peak_v20001.png"
                                ],
                                "stitcing" => ['laple_double_peak_stitch.png'],
                                "hole" => ["laple_double_peak_button_hole0001.png"],
                                "overelay" => []),
                            "4 Buttons 2 Buttons Fasten" => array("elements" => [
                                    "laple_notch_peak_upper_v40001.png",
                                    "laple_double_peak_v20001.png"
                                ],
                                "stitcing" => ['laple_double_peak_stitch.png'],
                                "hole" => ["laple_double_peak_button_hole0001.png"],
                                "overelay" => []),
                            "6 Buttons 1 Button Fasten" => array("elements" => [
                                    "laple_peak_upper0001.png",
                                    "laple_6_peack_morden0001.png"
                                ], "overelay" => ["4_peak_m.png"]),
                            "6 Buttons 2 Buttons Fasten" => array("elements" => [
                                    "laple_notch_peak_upper_v40001.png",
                                    "laple_double_peak_v20001.png"
                                ],
                                "stitcing" => ['laple_double_peak_stitch.png'],
                                "hole" => ["laple_double_peak_button_hole0001.png"],
                                "overelay" => []),
                        ),
                        "customization_category_id" => "6",
                        "image" => "peak_modern.jpeg"
                    ),
                ],
                "Collar" => [
                    array(
                        "status" => "1",
                        "title" => "Regular",
                        "elements" => ["collar_regular0001.png"],
                        "customization_category_id" => "2",
                        "style" => "margin-left: -3px;",
                        "insert_style_css" => "margin-top: 1px;margin-left: -4px;",
                        "insert_style" => "collar_regular_insert0001.png",
                        "insert_overlay" => "collar_simple_insert_overlay.png",
                        "insert_overlay_css" => "margin-top: -4px;margin-left: -1px;",
                        "insert_full" => ["collar_regular0001.png"],
                        "image" => "collar_regular.jpeg",
                        "buttons" => "buttonsh1.png",
                    ), array(
                        "status" => "0",
                        "title" => "Medium Spread",
                        "customization_category_id" => "2",
                        "style" => "margin-top:-2px;margin-left: -2px;",
                        "insert_style_css" => "margin-top: 1px;margin-left: -4px;",
                        "insert_style" => "collar_regular_insert0001.png",
                        "insert_overlay" => "collar_simple_insert_overlay.png",
                        "insert_overlay_css" => "margin-top: -4px;margin-left: -2px;",
                        "elements" => ["collar_spread_medium0001.png"],
                        "insert_full" => ["collar_spread_medium0001.png"],
                        "image" => "collar_medium_spread.jpeg",
                        "buttons" => "buttonsh1.png",
                    ), array(
                        "status" => "0",
                        "title" => "Wide Spread",
                        "customization_category_id" => "2",
                        "elements" => ["collar_spread_wide0001.png"],
                        "image" => "collar_wide_spread.jpeg",
                        "insert_style_css" => "margin-top: 1px;margin-left: -4px;",
                        "insert_style" => "collar_regular_insert0001.png",
                        "insert_overlay" => "collar_simple_insert_overlay.png",
                        "insert_overlay_css" => "margin-top: -4px;margin-left: -1px;",
                        "insert_full" => ["collar_spread_wide0001.png"],
                        "buttons" => "buttonsh1.png",
                    ), array(
                        "status" => "0",
                        "title" => "Short Point",
                        "elements" => ["collar_short_point0001.png"],
                        "customization_category_id" => "2",
                        "style" => "    margin-top: -4px;margin-left: -2px;",
                        "insert_style_css" => "margin-top: 1px;margin-left: -4px;",
                        "insert_style" => "collar_regular_insert0001.png",
                        "insert_overlay" => "collar_simple_insert_overlay.png",
                        "insert_overlay_css" => "margin-top: -4px;margin-left: -2px;",
                        "insert_full" => ["collar_short_point0001.png"],
                        "image" => "collar_shirt_point.jpeg",
                        "buttons" => "buttonsh1.png",
                    ), array(
                        "status" => "0",
                        "title" => "Regular Button Down",
                        "customization_category_id" => "2",
                        "elements" => ["collar_regular0001.png"],
                        "style" => "margin-left: -3px;",
                        "insert_style_css" => "margin-top: 1px;margin-left: -4px;",
                        "insert_style" => "collar_regular_insert0001.png",
                        "insert_overlay" => "collar_simple_insert_overlay.png",
                        "insert_overlay_css" => "margin-top: -4px;margin-left: -1px;",
                        "insert_full" => ["collar_regular0001.png"],
                        "image" => "collar_regular_button_down.jpeg",
                        "button_down" => "buttons_collar_down.png",
                        "buttons" => "buttonsh1.png",
                    ), array(
                        "status" => "0",
                        "title" => "Full Cutaway",
                        "customization_category_id" => "2",
                        "style" => "margin-top:-6px;margin-left:-3px",
                        "insert_style_css" => "margin-top: 1px;margin-left: -2px;",
                        "insert_style" => "collar_regular_insert0001.png",
                        "insert_overlay" => "collar_simple_insert_overlay.png",
                        "insert_overlay_css" => "margin-top: -4px;margin-left: -0px;",
                        "insert_full" => ["collar_full_cutaway0001.png"],
                        "elements" => ["collar_full_cutaway0001.png"],
                        "image" => "collar_full_cutaway.jpeg",
                        "buttons" => "buttonsh1.png",
                    ), array(
                        "status" => "0",
                        "title" => "Wing Tip",
                        "customization_category_id" => "2",
                        "insert_style_css" => "margin-top: -3px;",
                        "insert_style" => "collar_wintip_insert0001.png",
                        "insert_overlay" => "collar_wintip_insert_overlay.png",
                        "insert_overlay_css" => "opacity:1;",
                        "elements" => ["collar_wintip0001.png"],
                        "insert_full" => ["collar_wintip0001.png"],
                        "image" => "collar_wingtip.jpeg",
                        "buttons" => "buttons_m_w_collar.png",
                        "monogram_style" => "top:11px;height: 8px;",
                    ), array(
                        "status" => "0",
                        "title" => "Mandarin",
                        "elements" => ["collar_manderian0001.png"],
                        "customization_category_id" => "2",
                        "insert_style_css" => "margin-top: 0px;",
                        "insert_style" => "collar_manderian_insert0001.png",
                        "insert_overlay" => "collar_manderian_insert_overlay.png",
                        "insert_overlay_css" => "",
                        "insert_full" => ["collar_manderian0001.png"],
                        "image" => "collar_mandarin.jpeg",
                        "monogram_style" => "top:11px;height: 8px;",
                        "buttons" => "buttons_m_w_collar.png",
                    )]
            ),
            "cuff_collar_insert" => ["p10", "p11", "p12", "p13", "p14", "p15", "p16", "p18", "p2",
                "p23", "p28", "p33", "s1", "s10", "s11", "s12", "s13", "s17",
                "s2", "s3", "s4", "s5", "s6", "s8"],
            "monogram_colors" => [
                array(
                    "color" => "white",
                    "backcolor" => "black",
                    "title" => "White-Black"
                ),
                array(
                    "color" => "red",
                    "backcolor" => "white",
                    "title" => "Red-White"
                ),
                array(
                    "color" => "white",
                    "backcolor" => "red",
                    "title" => "White-Red"
                ),
                array(
                    "color" => "#7d0a24",
                    "backcolor" => "#ff5600",
                    "title" => "Pink-Orange"
                ),
            ],
            "monogram_style" => [
                array(
                    "font_style" => "font-family: 'Orbitron';",
                    "title" => "Style 1"
                ),
                array(
                    "font_style" => "font-family: 'Black Ops One';",
                    "title" => "Style 2"
                ),
                array(
                    "font_style" => "font-family: 'Bungee';",
                    "title" => "Style 3"
                ),
                array(
                    "font_style" => "font-family: 'Wallpoet';",
                    "title" => "Style 4"
                ),
            ],
        );
        foreach ($customeele as $key => $value) {
            
        }
        $this->response($customeele);
    }

}

?>