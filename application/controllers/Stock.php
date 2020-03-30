<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        // Load library
        $this->load->library(array('form_validation', 'session', 'my_library', 'thaidate', 'cart_stock', 'upload'));
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
                    redirect('email/stock/'.$order.'/'.$sms=1);
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

    public function setting() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['mylibrary']=$this->my_library;
            $data['page_title']='ตั้งค่ารายการวัสดุ';
            $breadcrumb=array("Home"=> "/e-services/",
                "ระบบเบิกวัสดุ"=> "/e-services/stock/",
                "ตั้งค่ารายการวัสดุ"=> ""
            );
            $data['breadcrumb']=$breadcrumb;
            $data['thaidate']=$this->thaidate;
            $data['adminLevel']=$this->user_model->userStock($data['user']['hospcode']);
            $data['stock']=$this->stock_model->getStockList();
            $data['group']=$this->stock_model->getGroup();
            $data['category']=$this->stock_model->getCategory();

            if ( !empty($data['adminLevel'])) {
                if($data['adminLevel'][0]->level==1 or $data['adminLevel'][0]->level==2) {
                    $this->template->load('layout/template', 'stock/setting', $data);
                }

                else {
                    $popup=array('msg'=> 1,
                        'detail'=> 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                    );
                    $this->session->set_userdata($popup);
                    redirect('stock');
                }
            }

            else {
                $popup=array('msg'=> 1,
                    'detail'=> 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                );
                $this->session->set_userdata($popup);
                redirect('stock');
            }
        }

        else {
            redirect('users/login');
        }
    }

    function upload_photo() {
        $path='/assets/uploads/source/stock/';

        if( !empty($_FILES['stock_uplfile'])) {
            $config['upload_path']='./assets/uploads/source/stock/';
            $config['allowed_types']='jpg|jpeg|png';
            $config['max_size']=1024*3;
            $config['encrypt_name']=TRUE;

            $this->upload->initialize($config);

            if ( !$this->upload->do_upload('stock_uplfile')) {
                $error=$this->upload->display_errors();
                return $error;
            }

            else {
                $data=$this->upload->data();
                $this->stock_model->setPath($path);
                $this->stock_model->setUpload($data['file_name']);
            }
        }

        else {
            $this->stock_model->setPath($path);
        }

    }

    public function saveStock() {
        $data=array();
        $json=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $name=$this->input->post('stock_name');
            $qty=$this->input->post('stock_qty');
            $unit=$this->input->post('stock_unit');
            $group=$this->input->post('stock_group');
            $category=$this->input->post('stock_category');

            $this->stock_model->setHospcode($data['user']['hospcode']);

            if(empty(trim($name))) {
                $json['error']['name']='กรุณากรอกชื่อพัสดุ';
            }

            if(empty(trim($qty))) {
                $json['error']['qty']='กรุณากรอกจำนวน';
            }

            if(empty(trim($unit))) {
                $json['error']['unit']='กรุณากรอกหน่วยนับ';
            }

            if(empty(trim($group))) {
                $json['error']['group']='กรุณาเลือกหมวด';
            }

            if(empty(trim($category))) {
                $json['error']['category']='กรุณาเลือกประเภท';
            }

            if(empty($_FILES["stock_uplfile"]["type"])) {
                $json['error']['err']='กรุณาเลือกรูปภาพ';
            }

            $file=$this->upload_photo();

            if($file !=null) {
                $json['error']['err']=$file;
            }

            if(empty($json['error'])) {
                $this->stock_model->setNmae($name);
                $this->stock_model->setQty($qty);
                $this->stock_model->setUnit($unit);
                $this->stock_model->setGroup($group);
                $this->stock_model->setCategory($category);

                try {
                    $last_id=$this->stock_model->createStock();
                }

                catch (Exception $e) {
                    var_dump($e->getMessage());
                }
            }


            echo json_encode($json);

        }

        else {
            redirect('users/login');
        }
    }

    // edit srock
    public function editStock() {
        $data=array();
        $id=$this->input->post('id');
        $this->stock_model->setStockId($id);
        $data['stockInfo']=$this->stock_model->stockInfo();
        $data['group']=$this->stock_model->getGroup();
        $data['category']=$this->stock_model->getCategory();
        $this->output->set_header('Content-Type: application/json');
        $this->load->view('stock/popup/setting/renderEdit', $data);

    }

    // view srock
    public function viewStock() {
        $data=array();
        $id=$this->input->post('id');
        $this->stock_model->setStockId($id);
        $data['thaidate']=$this->thaidate;
        $data['stockInfo']=$this->stock_model->stockInfo();
        $data['group']=$this->stock_model->getGroup();
        $data['category']=$this->stock_model->getCategory();
        $this->output->set_header('Content-Type: application/json');
        $this->load->view('stock/popup/setting/renderView', $data);

    }

    // Product Delete method
    public function delStock() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $id=$this->input->post('id');
            $this->stock_model->setHospcode($data['user']['hospcode']);
            $this->stock_model->setStockId($id);
            $this->stock_model->delStock();
            $this->output->set_header('Content-Type: application/json');
            echo json_encode($data);
        }

        else {
            redirect('users/login');
        }
    }

    // view srock order
    public function viewStockOrder() {
        $data=array();
        $id=$this->input->post('id');
        $data['thaidate']=$this->thaidate;
        $data['orderInfo']=$this->stock_model->orderInfo($id);
        $data['orderItems']=$this->stock_model->orderItems($id);
        $this->output->set_header('Content-Type: application/json');
        $this->load->view('stock/popup/order/renderView', $data);

    }

    // view srock order
    public function editStockOrder() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['adminLevel']=$this->user_model->userStock($data['user']['hospcode']);
            $id=$this->input->post('id');
            $data['thaidate']=$this->thaidate;
            $data['orderInfo']=$this->stock_model->orderInfo($id);
            $data['orderItems']=$this->stock_model->orderItems($id);
            $data['userOrder']=$this->user_model->getRowsUser($data['orderInfo'][0]->hospcode);
            $this->output->set_header('Content-Type: application/json');



            if ( !empty($data['adminLevel'])) {
                if($data['orderInfo'][0]->status==1) {
                    if($data['adminLevel'][0]->hospcode==$data['user']['department_head'] and $data['adminLevel'][0]->hospcode==$data['userOrder']->department_head) {

                        $this->load->view('stock/popup/order/renderApprove', $data);
                    }

                    elseif($data['adminLevel'][0]->level==1) {

                        $this->load->view('stock/popup/order/renderApprove', $data);
                    }

                    else {
                        $popup=array('msg'=> 1,
                            'detail'=> 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                        );
                        $this->session->set_userdata($popup);
                    }
                }

                elseif($data['orderInfo'][0]->status==2 and $data['adminLevel'][0]->level==4) {
                    $this->load->view('stock/popup/order/renderSupplies', $data);
                }
                elseif($data['orderInfo'][0]->status==3 and $data['adminLevel'][0]->level==2) {
                    $this->load->view('stock/popup/order/renderSend', $data);
                }
                elseif($data['orderInfo'][0]->status==4 and $data['orderInfo'][0]->hospcode==$data['user']['hospcode']) {
                    $this->load->view('stock/popup/order/renderReceive', $data);
                }

                else {
                    $popup=array('msg'=> 1,
                        'detail'=> 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                    );
                    $this->session->set_userdata($popup);
                }

            }

            else {
                $popup=array('msg'=> 1,
                    'detail'=> 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!3',
                );
                $this->session->set_userdata($popup);
                redirect('stock/view/');
            }
        }

        else {
            redirect('users/login');
        }
    }

    // view srock order
    public function updateStockOrder() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $id=$this->input->post('orderId');
            $inputstatus=$this->input->post('inputstatus');
            $data['orderInfo']=$this->stock_model->orderInfo($id);
            $data['orderItems']=$this->stock_model->orderItems($id);

            $data['approve']=array('status'=> $inputstatus,
                'approve_id'=> $data['user']['hospcode'],
                'approve_date'=> date("Y-m-d H:i:s"),
            );
            $data['supplies']=array('status'=> $inputstatus,
                'supplies_id'=> $data['user']['hospcode'],
                'supplies_date'=> date("Y-m-d H:i:s"),
            );
            $data['send']=array('status'=> $inputstatus,
                'send_id'=> $data['user']['hospcode'],
                'send_date'=> date("Y-m-d H:i:s"),
            );
            $data['receive']=array('status'=> $inputstatus,
                'receive_id'=> $data['user']['hospcode'],
                'receive_date'=> date("Y-m-d H:i:s"),
            );

            if($data['orderInfo'][0]->status==1) {
                if($inputstatus==6 or $inputstatus==8) {
                    $stock=$this->update_stock($data['orderItems']);

                    if($stock) {
                        $this->db->where('id', $id);
                        $this->db->update('tbl_stock_orders', $data['approve']);
                        redirect('email/stock/'.$id.'/'.$sms=6);
                    }

                    else {
                        $popup=array('msg'=> 1,
                            'detail'=> 'ระบบไม่สามารถอัพเดทข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                        );
                        $this->session->set_userdata($popup);
                    }
                }

                else {
                    $this->db->where('id', $id);
                    $this->db->update('tbl_stock_orders', $data['approve']);
                    redirect('email/stock/'.$id.'/'.$sms=2);
                }
            }

            elseif ($data['orderInfo'][0]->status==2) {
                if($inputstatus==7) {
                    $stock=$this->update_stock($data['orderItems']);

                    if($stock) {
                        $this->db->where('id', $id);
                        $this->db->update('tbl_stock_orders', $data['supplies']);
                        redirect('email/stock/'.$id.'/'.$sms=7);
                    }

                    else {
                        $popup=array('msg'=> 1,
                            'detail'=> 'ระบบไม่สามารถอัพเดทข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                        );
                        $this->session->set_userdata($popup);
                    }
                }

                else {
                    $this->db->where('id', $id);
                    $this->db->update('tbl_stock_orders', $data['supplies']);
                    redirect('email/stock/'.$id.'/'.$sms=3);
                }
            }

            elseif ($data['orderInfo'][0]->status==3) {
                if($inputstatus==8) {
                    $stock=$this->update_stock($data['orderItems']);

                    if($stock) {
                        $this->db->where('id', $id);
                        $this->db->update('tbl_stock_orders', $data['send']);
                        redirect('email/stock/'.$id.'/'.$sms=8);
                    }

                    else {
                        $popup=array('msg'=> 1,
                            'detail'=> 'ระบบไม่สามารถอัพเดทข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                        );
                        $this->session->set_userdata($popup);
                    }
                }

                else {
                    $this->db->where('id', $id);
                    $this->db->update('tbl_stock_orders', $data['send']);
                    redirect('email/stock/'.$id.'/'.$sms=4);
                }
            }

            elseif ($data['orderInfo'][0]->status==4) {
                if($inputstatus==5) {
                    $this->db->where('id', $id);
                    $this->db->update('tbl_stock_orders', $data['receive']);
                    redirect('email/stock/'.$id.'/'.$sms=5);
                }

                else {
                    $popup=array('msg'=> 1,
                            'detail'=> 'ระบบไม่สามารถอัพเดทข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                        );
                        $this->session->set_userdata($popup);
                }
            }

            else {
                $popup=array('msg'=> 1,
                    'detail'=> 'ใบงานนี้อยู่ระหว่างดำเนินการ กรุณาติดต่อผู้ดูแลระบบครับ!',
                );
                $this->session->set_userdata($popup);
            }





        }

        else {
            redirect('users/login');
        }
    }

    public function update_stock($items) {
        $data=array();
        $i=0;
        $temp=0;

        foreach($items as $item) {
            $data['getStock']=$this->stock_model->getStock($item->stock_id);
            $temp=$data['getStock'][0]->quantity+$item->quantity;
            $data=array('quantity'=> $temp,
                'update'=> date("Y-m-d H:i:s"));
            $this->db->where('id', $item->stock_id);
            $this->db->update('tbl_stock', $data);
            $i++;
        }

        return true;
    }

    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';
    // exit;

}