<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

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
        redirect('Cart/details');
    }

    function details() {
        $this->load->view('Cart/details');
    }

    function checkout() {
        $session_data = $this->session->userdata('logged_in');
        if ($session_data) {
            $user_details = $this->User_model->user_details($this->user_id);
            $data['user_details'] = $user_details;

            $user_address_details = $this->User_model->user_address_details($this->user_id);
            $data['user_address_details'] = $user_address_details;

            $user_credits = $this->User_model->user_credits($this->user_id);
            $data['user_credits'] = $user_credits;

            //Get Address
            if (isset($_GET['setAddress'])) {
                $this->db->set('status', "");
                $this->db->where('user_id', $this->user_id);
                $this->db->update('shipping_address');

                $adid = $_GET['setAddress'];
                $this->db->set('status', "default");
                $this->db->where('id', $adid);
                $this->db->update('shipping_address');
                redirect('Cart/checkout');
            }

            //add New address
            if (isset($_POST['add_address'])) {
                $this->db->set('status', "");
                $this->db->where('user_id', $this->user_id);
                $this->db->update('shipping_address');

                $category_array = array(
                    'address' => $this->input->post('address'),
                    'city' => $this->input->post('city'),
                    'state' => $this->input->post('state'),
                    'pincode' => $this->input->post('pincode'),
                    'user_id' => $this->user_id,
                    'status' => 'default',
                );
                $this->db->insert('shipping_address', $category_array);
                redirect('Cart/checkout');
            }

            //place order
            if (isset($_POST['place_order'])) {
                $address = $user_address_details[0];

                $order_array = array(
                    'name' => $user_details->first_name . " " . $user_details->last_name,
                    'email' => $user_details->email,
                    'user_id' => $user_details->id,
                    'contact_no' => $user_details->contact_no?$user_details->contact_no:'---',
                    'pincode' => $address['pincode'],
                    'address' => $address['address'],
                    'city' => $address['city'],
                    'state' => $address['state'],
                    'order_date' => date('Y-m-d'),
                    'order_time' => date('H:i:s'),
                    'sub_total_price' => $this->input->post('sub_total_price'),
                    'total_price' => $this->input->post('total_price'),
                    'total_quantity' => $this->input->post('total_quantity'),
                    'status' => 'Pending',
                    'credit_price' => $this->input->post('credit_price'),
                );

                $this->db->insert('user_order', $order_array);
                $last_id = $this->db->insert_id();
                $orderno = "CPS" . date('Y/m/d') . "/" . $last_id;
                $orderkey = md5($orderno);
                $this->db->set('order_no', $orderno);
                $this->db->set('order_key', $orderkey);
                $this->db->where('id', $last_id);
                $this->db->update('user_order');

                $this->db->set('order_id', $last_id);
                $this->db->where('order_id', '0');
                $this->db->where('user_id', $this->user_id);
                $this->db->update('cart');


                $credit_data = array(
                    'c_date' => date('Y-m-d'),
                    'c_time' => date('H:i:s'),
                    'order_id'=>$last_id,
                    'credit' => $this->input->post('credit_price'),
                    'user_id' => $this->user_id,
                    'remark' => "Credits used in Order No.: ".$orderno,
                );
                $this->db->insert('user_debit', $credit_data);


                
                $order_status_data = array(
                    'c_date' => date('Y-m-d'),
                    'c_time' => date('H:i:s'),
                    'order_id'=>$last_id,
                    'status' => "Client Confirmation",
                    'user_id' => $this->user_id,
                    'remark' => "Order Confirmed From Client Side",
                );
                $this->db->insert('user_order_status', $order_status_data);
                
                $this->Product_model->order_to_vendor($last_id);


                redirect('Order/orderdetails/' . $orderkey);
            }


            $this->load->view('Cart/checkout', $data);
        } else {
            redirect('Account/login?page=checkout');
        }
    }

}

?>
