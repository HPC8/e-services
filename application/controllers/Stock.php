<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        // Load library
        $this->load->library(array('form_validation', 'session', 'my_library', 'thaidate', 'cart_stock'));
        // Load helper
        $this->load->helper(array('url', 'html', 'form'));
        // Load model
        $this->load->model(array('user_model', 'employee_model', 'stock_model'));
    }

    function index() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['page_title']='เบิกวัสดุ';
            $breadcrumb=array("Home"=> "/e-services/",
                "ระบบเบิกวัสดุ"=> "/e-services/stock/",
                "เบิกวัสดุ"=> ""
            );
            $data['breadcrumb']=$breadcrumb;
            $data['mylibrary']=$this->my_library;
            $data['stock']=$this->stock_model->getRows();


            $this->template->load('layout/template', 'stock/index', $data);

        }

        else {
            redirect('users/login');
        }
    }

    function addToCart($stoID) {
        $data=array();
        // Fetch specific product by ID
        $stock=$this->stock_model->getRows($stoID);

        // Add product to the cart
        $data=array('id'=> $stock['id'],
            'qty'=> 1,
            'price'=> $stock['price'],
            'name'=> $stock['name'],
            'image'=> $stock['image']);

        $this->cart_stock->insert($data);
        //$cart_stock = $this->cart_stock->contents();
        // Redirect to the cart page
        redirect('stock/cart/');
    }

    function cart() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['page_title']='เบิกวัสดุ';
            $breadcrumb=array("Home"=> "/e-services/",
                "ระบบเบิกวัสดุ"=> "/e-services/stock/",
                "เบิกวัสดุ"=> ""
            );
            $data['breadcrumb']=$breadcrumb;
            $data['mylibrary']=$this->my_library;
            $data['cartItems']=$this->cart_stock->contents();

            $this->template->load('layout/template', 'stock/cart', $data);

        }

        else {
            redirect('users/login/');
        }
    }

    function updateItemQty() {
        $update=0;
        // Get cart item info
        $rowid=$this->input->get('rowid');
        $qty=$this->input->get('qty');

        // Update item in the cart
        if( !empty($rowid) && !empty($qty)) {
            $data=array('rowid'=> $rowid,
                'qty'=> $qty);
            $update=$this->cart_stock->update($data);
        }

        // Return response
        echo $update?'ok':'err';
    }

    function removeItem($rowid) {
        $this->cart_stock->remove($rowid);
        redirect('stock/cart/');
    }

    function destroy() {
        $this->cart_stock->destroy();
        redirect('stock/cart/');
    }
    function checkout() {
        $data=array();

        // Redirect if the cart is empty
        if($this->cart_stock->total_items() <=0) {
            redirect('stock/');
        }

        $cartItems=$this->cart_stock->contents();
        $i=0;
        $data['max_qty']=0;

        foreach($cartItems as $item) {
            $data['getStock']=$this->stock_model->getStock($item['id']);

            if($data['getStock'][0]->quantity>=$item['qty']) {
                $data['max_qty']+0;
            }

            else {
                $data['max_qty']++;
            }

            $i++;
        }

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['page_title']='เบิกวัสดุ';
            $breadcrumb=array("Home"=> "/e-services/",
                "ระบบเบิกวัสดุ"=> "/e-services/stock/",
                "เบิกวัสดุ"=> ""
            );
            $data['breadcrumb']=$breadcrumb;
            $data['mylibrary']=$this->my_library;
            $data['cartItems']=$this->cart_stock->contents();

            if($data['max_qty']==0) {
                $this->template->load('layout/template', 'stock/checkout', $data);
            }

            else {
                $popup=array('msg'=> 1,
                    'detail'=> 'พัสดุในสต๊อกมีจำนวนไม่เพียงพอ กรุณาเช็ครายการพัสดุใหม่อีกครั้งครับ',
                );
                $this->session->set_userdata($popup);
                redirect('stock/cart/');
            }
        }

        else {
            redirect('users/login/');
        }
    }

    function post_validate() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            // Prepare customer data

            // If order request is submitted
            $submit=$this->input->post('placeStock');

            if(isset($submit)) {

                // Insert order
                $order=$this->placeStock($this->input->post('inputhospcode'));

                // If the order submission is successful
                if($order) {
                    echo "Ok";
                    //redirect('email/stock/'.$order.'/'.$sms=1);
                }

                else {
                    $data['error_msg']='Order submission failed, please try again.';
                }
            }

        }

        else {
            redirect('users/login/');
        }
    }

    function placeStock($hospcode) {
        // Insert order data
        $data=array();
        $year=$this->thaidate->thaiyear(date("Y-m-d"));
        $count=$this->stock_model->count_all_year($year);
        $ordData=array('order_doc'=> $year."/".($count+1),
            'hospcode'=> $hospcode,
            'description'=> strip_tags($this->input->post('description')),
        );


            $insertOrder=$this->stock_model->insertOrder($ordData);

            if($insertOrder) {
                // Retrieve cart data from the session
                $cartItems=$this->cart_stock->contents();
                // Cart items
                $ordItemData=array();
                $i=0;
                $temp=0;

                foreach($cartItems as $item) {
                    $ordItemData[$i]['order_id']=$insertOrder;
                    $ordItemData[$i]['stock_id']=$item['id'];
                    $ordItemData[$i]['quantity']=$item['qty'];

                    // Update quantity to tbl_products
                    $data['getStock']=$this->stock_model->getStock($item['id']);
                    $temp=$data['getStock'][0]->quantity-$item['qty'];
                    $data=array('quantity'=> $temp,
                        'modified'=> date("Y-m-d H:i:s"));
                    $this->db->where('id', $item['id']);
                    $this->db->update('tbl_stock', $data);
                    $i++;
                }

                if( !empty($ordItemData)) {
                    // Insert order items
                    $insertOrderItems=$this->stock_model->insertOrderItems($ordItemData);

                    if($insertOrderItems) {
                        // Remove items from the cart
                        $this->cart_stock->destroy();

                        // Return order ID
                        return $insertOrder;
                    }
                }
            }
            return false;
    }

    public function view() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['mylibrary']=$this->my_library;
            $data['page_title']='รายการเบิกวัสดุทั้งหมด';
            $breadcrumb=array("Home"=> "/e-services/",
                "ระบบเบิกวัสดุ"=> "/e-services/stock/",
                "รายการเบิกวัสดุทั้งหมด"=> ""
            );
            $data['breadcrumb']=$breadcrumb;
            $data['thaidate']=$this->thaidate;
            $data['query']=$this->stock_model->getOrders();

            $this->template->load('layout/template', 'stock/view', $data);
        }

        else {
            redirect('users/login');
        }
    }

    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';
    // exit;

}