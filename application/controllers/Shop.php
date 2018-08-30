<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->library('session');
         $this->load->model('User_model');
        $this->user_id = $this->session->userdata('logged_in')['login_id'];
    }

    public function index() {
        $product_home_slider_bottom = $this->Product_model->product_home_slider_bottom();
        $categories = $this->Product_model->productListCategories(0);
        $data["categories"] = $categories;
        $data["product_home_slider_bottom"] = $product_home_slider_bottom;

        $manu_details_evening = $this->User_model->menu_details('Evening', date('Y-m-d'));
        $data['manu_details_evening'] = $manu_details_evening;

        $manu_details_morning = $this->User_model->menu_details('Morning', date('Y-m-d'));
        $data['manu_details_morning'] = $manu_details_morning;


        $this->load->view('home', $data);
    }

}
