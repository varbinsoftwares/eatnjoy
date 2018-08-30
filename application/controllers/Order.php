<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('User_model');
        $this->load->library('session');
        $session_user = $this->session->userdata('logged_in');
        if ($session_user) {
            $this->user_id = $session_user['login_id'];
        } else {
            $this->user_id = 0;
        }
    }

    public function index() {
        redirect('/');
    }

    public function orderdetails($order_key) {
        if ($this->user_id == 0) {
            redirect('/');
        }
        $order_details = $this->Product_model->getOrderDetails($order_key, 'key');
        if ($order_details) {
            try {
                $order_id = $order_details['order_data']->id;
               // $this->Product_model->order_mail($order_id);
                //redirect("Order/orderdetails/$order_key");
            } catch (customException $e) {
                //display custom message
               // redirect("Order/orderdetails/$order_key");
            }
        }
        else{
             redirect('/');
        }

        $this->load->view('Order/orderdetails', $order_details);
    }

}

?>
