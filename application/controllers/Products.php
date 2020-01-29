<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        // Load library
        $this->load->library(array('form_validation', 'session', 'my_library', 'thaidate', 'cart', ));
        // Load helper
        $this->load->helper(array('url', 'html', 'form'));
        // Load model
        $this->load->model(array('user_model', 'employee_model', 'product_model'));
        //$this->controller = 'checkout';
    }

    function index() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['page_title']='ยืมครุภัณฑ์';
            $breadcrumb=array("Home"=> "/e-services/",
                "ระบบยืมคืนครุภัณฑ์"=> "/e-services/products/",
                "ยืมครุภัณฑ์"=> ""
            );
            $data['breadcrumb']=$breadcrumb;
            $data['mylibrary']=$this->my_library;
            $data['products']=$this->product_model->getRows();
            $data['getUpoint']=$this->product_model->getUpoint($data['user']['hospcode']);

            if($data['getUpoint'][0]->point>0) {
                $this->template->load('layout/template', 'products/index', $data);
            }

            else {
                $popup=array('msg'=> 1,
                    'detail'=> 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้เนื่องจากจำนวน Point คงเหลือไม่เพียงพอ  กรุณาติดต่อผู้ดูแลระบบครับ!',
                );
                $this->session->set_userdata($popup);
                redirect('products/my_view/');
            }

        }

        else {
            redirect('users/login');
        }
    }

    function my_view() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['mylibrary']=$this->my_library;
            $data['page_title']='รายการของฉัน';
            $breadcrumb=array("Home"=> "/e-services/",
                "ระบบยืมคืนครุภัณฑ์"=> "/e-services/products/",
                "รายการของฉัน"=> ""
            );
            $data['thaidate']=$this->thaidate;
            $data['breadcrumb']=$breadcrumb;
            $data['query']=$this->product_model->getMyOrders($data['user']['hospcode']);
            $data['getUpoint']=$this->product_model->getUpoint($data['user']['hospcode']);

            //load the view
            $this->template->load('layout/template', 'products/my_view', $data);


        }

        else {
            redirect('users/login');
        }
    }

    function addToCart($proID) {
        $data=array();
        // Fetch specific product by ID
        $product=$this->product_model->getRows($proID);


        // Add product to the cart
        $data=array('id'=> $product['id'],
            'qty'=> 1,
            'price'=> $product['price'],
            'name'=> $product['name'],
            'image'=> $product['image']);

        $this->cart->insert($data);
        // Redirect to the cart page
        redirect('products/cart/');
    }

    function cart() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['page_title']='ยืมครุภัณฑ์';
            $breadcrumb=array("Home"=> "/e-services/",
                "ระบบยืมคืนครุภัณฑ์"=> "/e-services/products/",
                "ยืมครุภัณฑ์"=> ""
            );
            $data['breadcrumb']=$breadcrumb;
            $data['mylibrary']=$this->my_library;
            $data['cartItems']=$this->cart->contents();

            $this->template->load('layout/template', 'products/cart', $data);


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
            $update=$this->cart->update($data);
        }

        // Return response
        echo $update?'ok':'err';
    }

    function removeItem($rowid) {
        $this->cart->remove($rowid);
        redirect('products/cart/');
    }

    function destroy() {
        $this->cart->destroy();
        redirect('products/cart/');
    }

    function checkout() {
        $data=array();

        // Redirect if the cart is empty
        if($this->cart->total_items() <=0) {
            redirect('products/');
        }

        $cartItems=$this->cart->contents();
        $i=0;
        $data['max_qty']=0;

        foreach($cartItems as $item) {
            $data['getProduct']=$this->product_model->getProduct($item['id']);

            if($data['getProduct'][0]->quantity>=$item['qty']) {
                $data['max_qty']+0;
            }

            else {
                $data['max_qty']++;
            }

            $i++;
        }

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['page_title']='ยืมครุภัณฑ์';
            $breadcrumb=array("Home"=> "/e-services/",
                "ระบบยืมคืนครุภัณฑ์"=> "/e-services/products/",
                "ยืมครุภัณฑ์"=> ""
            );
            $data['breadcrumb']=$breadcrumb;
            $data['mylibrary']=$this->my_library;
            $data['cartItems']=$this->cart->contents();

            if($data['max_qty']==0) {
                $this->template->load('layout/template', 'products/checkout', $data);
            }

            else {
                $popup=array('msg'=> 1,
                    'detail'=> 'ครุภัณฑ์ในสต๊อกมีจำนวนไม่เพียงพอ กรุณาเช็ครายการครุภัณฑ์ใหม่อีกครั้งครับ',
                );
                $this->session->set_userdata($popup);
                redirect('products/cart/');
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
            $submit=$this->input->post('placeOrder');

            if(isset($submit)) {

                // Insert order
                $order=$this->placeOrder($this->input->post('inputhospcode'));

                // If the order submission is successful
                if($order) {
                    redirect('email/product/'.$order.'/'.$sms=1);
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

    function placeOrder($hospcode) {
        // Insert order data
        $data=array();
        $datestart=$this->input->post('datestart');
        $dateend=$this->input->post('dateend');
        $year=$this->thaidate->thaiyear(date("Y-m-d"));
        $count=$this->product_model->count_all_year($year);
        $ordData=array('order_doc'=> $year."/".($count+1),
            'hospcode'=> $hospcode,
            'start_date'=> $datestart,
            'end_date'=> $dateend,
            'description'=> strip_tags($this->input->post('description')),
            'order_expire'=> date ("Y-m-d", strtotime("+3 day", strtotime($dateend)))." 23:59:00",
        );
        $daycount=$this->thaidate->duration($datestart, $dateend);

        if($daycount > 15) {
            $popup=array('msg'=> 1,
                'detail'=> 'จำนวนวันที่ขอใช้งานเกิน 15 วัน กรุณาเลือกช่วงวันที่ใช้งานใหม่หรือติดต่อผู้ดูแลระบบครับ!',
            );
            $this->session->set_userdata($popup);
            redirect('products/checkout/');
        }

        elseif ($daycount < 0) {
            $popup=array('msg'=> 1,
                'detail'=> 'ช่วงวันที่ใช้งานไม่ถูกต้อง กรุณาเลือกช่วงวันที่ใช้งานใหม่หรือติดต่อผู้ดูแลระบบครับ!',
            );
            $this->session->set_userdata($popup);
            redirect('products/checkout/');
        }

        else {
            $insertOrder=$this->product_model->insertOrder($ordData);

            if($insertOrder) {
                // Retrieve cart data from the session
                $cartItems=$this->cart->contents();
                // Cart items
                $ordItemData=array();
                $i=0;
                $temp=0;

                foreach($cartItems as $item) {
                    $ordItemData[$i]['order_id']=$insertOrder;
                    $ordItemData[$i]['product_id']=$item['id'];
                    $ordItemData[$i]['quantity']=$item['qty'];

                    // Update quantity to tbl_products
                    $data['getProduct']=$this->product_model->getProduct($item['id']);
                    $temp=$data['getProduct'][0]->quantity-$item['qty'];
                    $data=array('quantity'=> $temp,
                        'modified'=> date("Y-m-d H:i:s"));
                    $this->db->where('id', $item['id']);
                    $this->db->update('tbl_products', $data);
                    $i++;
                }

                if( !empty($ordItemData)) {
                    // Insert order items
                    $insertOrderItems=$this->product_model->insertOrderItems($ordItemData);

                    if($insertOrderItems) {
                        // Remove items from the cart
                        $this->cart->destroy();

                        // Return order ID
                        return $insertOrder;
                    }
                }
            }

            return false;
        }

    }

    function orderSuccess($ordID) {
        // Fetch order data from the database
        $data['order']=$this->product_model->getOrder($ordID);

        // Load order details view
        $this->load->view($this->controller.'/order-success', $data);
    }

    public function view() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['mylibrary']=$this->my_library;
            $data['page_title']='รายการขอยืมครุภัณฑ์';
            $breadcrumb=array("Home"=> "/e-services/",
                "ระบบยืมคืนครุภัณฑ์"=> "/e-services/products/",
                "รายการขอยืมครุภัณฑ์"=> ""
            );
            $data['breadcrumb']=$breadcrumb;
            $data['thaidate']=$this->thaidate;
            $data['query']=$this->product_model->getOrders();

            $this->template->load('layout/template', 'products/view', $data);
        }

        else {
            redirect('users/login');
        }
    }

    public function deleteProducts() {
        $data=array();
        $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
        $id=$this->input->post('id');
        $data['detail']=$this->product_model->getDetail($id);
        $data['items']=$this->product_model->getItems($id);
        $data['cancel']=array('id'=> $id,
            'status'=> '7',
            'modified'=> date("Y-m-d H:i:s"),
        );

        if($data['detail'][0]->hospcode==$data['user']['hospcode']) {
            if($data['detail'][0]->status=="1") {
                $product=$this->update_product($data['items']);

                if($product) {
                    $this->db->where('id', $id);
                    $this->db->update('tbl_product_orders', $data['cancel']);
                    $popup=array('msg'=> 0,
                        'detail'=> 'ระบบทำการอัพเดทข้อมูลเรียบร้อย...',
                    );
                    $this->session->set_userdata($popup);
                }

                else {
                    $popup=array('msg'=> 1,
                        'detail'=> 'คุณไม่สามารถยกเลิกใบงานได้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                    );
                    $this->session->set_userdata($popup);
                }
            }

            else {
                $popup=array('msg'=> 1,
                    'detail'=> 'คุณไม่สามารถยกเลิกใบงานได้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                );
                $this->session->set_userdata($popup);
            }
        }

        else {
            $popup=array('msg'=> 1,
                'detail'=> 'คุณไม่สามารถยกเลิกใบงานได้ กรุณาติดต่อผู้ดูแลระบบครับ!',
            );
            $this->session->set_userdata($popup);
        }
    }

    public function update_product($items) {
        $data=array();
        $i=0;
        $temp=0;

        foreach($items as $item) {
            $data['getProduct']=$this->product_model->getProduct($item->product_id);
            $temp=$data['getProduct'][0]->quantity+$item->quantity;
            $data=array('quantity'=> $temp,
                'modified'=> date("Y-m-d H:i:s"));
            $this->db->where('id', $item->product_id);
            $this->db->update('tbl_products', $data);
            $i++;
        }

        return true;
    }

    public function insert_serial($items, $id) {
        $data=array();
        $i=0;

        foreach($items as $item[$i]) {
            $arr=explode("-", $item[$i]);
            $product_id=$arr[0];
            $serial=$arr[1];

            $data['getOrdItem']=$this->product_model->getOrdItem($id, $product_id);
            $serial_text=$data['getOrdItem'][0]->serial_text.$serial.' ';

            $temp=array('serial_text'=> $serial_text,
            );
            $status=array('status'=> '0',
                'modified'=> date("Y-m-d H:i:s"),
            );
            $this->db->where('order_id', $id);
            $this->db->where('product_id', $product_id);
            $this->db->update('tbl_product_order_items', $temp);

            $this->db->where('product_id', $product_id);
            $this->db->where('serial_text', $serial);
            $this->db->update('tbl_serial_number', $status);
            $i++;
        }

        return true;
    }

    public function update_serial($items) {
        $i=0;

        foreach($items as $item[$i]) {
            $status=array('status'=> '1',
                'modified'=> date("Y-m-d H:i:s"),
            );
            $serial=explode(" ", $item[$i]->serial_text, -1);
            $product_id=$item[$i]->product_id;
            $n=0;

            foreach($serial as $serials[$n]) {
                $this->db->where('product_id', $product_id);
                $this->db->where('serial_text', $serials[$n]);
                $this->db->update('tbl_serial_number', $status);
                $n++;
            }

            $i++;
        }

        return true;
    }

    public function viewProduct() {
        $data=array();
        $id=$this->input->post('product_code');
        $data['thaidate']=$this->thaidate;
        $data['mylibrary']=$this->my_library;
        $data['detailInfo']=$this->product_model->getDetail($id);
        $data['itemsInfo']=$this->product_model->getItems($id);
        $this->output->set_header('Content-Type: application/json');
        $this->load->view('products/popup/renderView', $data);
    }

    public function editProduct() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $data['admin_level']=$this->user_model->getUser_prod($data['user']['hospcode']);
            $id=$this->input->post('product_code');
            $data['thaidate']=$this->thaidate;
            $data['mylibrary']=$this->my_library;
            $data['detailInfo']=$this->product_model->getDetail($id);
            $data['itemsInfo']=$this->product_model->getItems($id);
            $data['status']=$this->product_model->getStatus();
            $data['serial_no']=$this->product_model->getSerial();


            // if ( !empty($data['admin_level'])) {
            if($data['detailInfo'][0]->status=="1") {
                if($data['admin_level'][0]->level==2) {
                    $this->output->set_header('Content-Type: application/json');
                    $this->load->view('products/popup/renderApprovers', $data);
                }

                else {
                    $popup=array('msg'=> 1,
                        'detail'=> 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                    );
                    $this->session->set_userdata($popup);
                }
            }

            elseif($data['detailInfo'][0]->status=="2") {
                if($data['admin_level'][0]->level==1) {
                    $this->output->set_header('Content-Type: application/json');
                    $this->load->view('products/popup/renderSending', $data);
                }

                else {
                    $popup=array('msg'=> 1,
                        'detail'=> 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                    );
                    $this->session->set_userdata($popup);
                }
            }

            elseif($data['detailInfo'][0]->status=="4") {
                if($data['admin_level'][0]->level==1) {
                    $this->output->set_header('Content-Type: application/json');
                    $this->load->view('products/popup/renderReceiving', $data);
                }

                else {
                    $popup=array('msg'=> 1,
                        'detail'=> 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                    );
                    $this->session->set_userdata($popup);
                }
            }

            elseif($data['detailInfo'][0]->status=="3") {
                if($data['detailInfo'][0]->hospcode==$data['user']['hospcode']) {
                    $this->output->set_header('Content-Type: application/json');
                    $this->load->view('products/popup/renderReturning', $data);
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
                    'detail'=> 'ใบงานนี้อยู่ระหว่างดำเนินการ กรุณาติดต่อผู้ดูแลระบบครับ!',
                );
                $this->session->set_userdata($popup);
            }

            //}

            // else {
            //     $popup=array('msg'=> 1,
            //         'detail'=> 'คุณไม่ได้รับมีสิทธิ์ให้เข้าใช้งานฟังก์ชันนี้ กรุณาติดต่อผู้ดูแลระบบครับ!',
            //     );
            //     $this->session->set_userdata($popup);
            // }
        }

        else {
            redirect('users/login');
        }
    }

    public function updateProduct() {
        $data=array();

        if($this->session->userdata('isUserLoggedIn')) {
            $data['user']=$this->user_model->getRows(array('emp_id'=>$this->session->userdata('userId')));
            $inputstatus=$this->input->post('inputstatus');
            $id=$this->input->post('edit_id');
            $data['serial_no']=$this->input->post('serial_no');
            $data['detailInfo']=$this->product_model->getDetail($id);
            $data['items']=$this->product_model->getItems($id);

            $data['approvers']=array('status'=> $inputstatus,
                'modified'=> date("Y-m-d H:i:s"),
                'approvers_id'=> $data['user']['hospcode'],
                'approvers_date'=> date("Y-m-d H:i:s"),
            );
            $data['sending']=array('status'=> '3',
                'modified'=> date("Y-m-d H:i:s"),
                'send_id'=> $data['user']['hospcode'],
                'send_date'=> date("Y-m-d H:i:s"),
            );
            $data['returning']=array('status'=> '4',
                'modified'=> date("Y-m-d H:i:s"),
                'returning_id'=> $data['user']['hospcode'],
                'returning_date'=> date("Y-m-d H:i:s"),
            );
            $data['receiving']=array('status'=> '5',
                'modified'=> date("Y-m-d H:i:s"),
                'receive_id'=> $data['user']['hospcode'],
                'receive_date'=> date("Y-m-d H:i:s"),
                'order_note'=> $this->input->post('order_note'),
            );

            if($data['detailInfo'][0]->status=="1") {
                if($inputstatus=="6"|| $inputstatus=="7") {
                    $product=$this->update_product($data['items']);

                    if($product) {
                        $this->db->where('id', $id);
                        $this->db->update('tbl_product_orders', $data['approvers']);
                        redirect('email/product/'.$id.'/'.$sms=2);
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
                    $this->db->update('tbl_product_orders', $data['approvers']);
                    redirect('email/product/'.$id.'/'.$sms=2);
                }
            }

            elseif($data['detailInfo'][0]->status=="2") {
                $countSerial=count($data['serial_no']);
                $countQuantity=$this->product_model->countQuantity($id);

                if($countSerial !=$countQuantity) {
                    $popup=array('msg'=> 1,
                        'detail'=> 'ระบบไม่สามารถอัพเดทข้อมูลได้ กรุณากรอกเลขครุภัณฑ์ให้ครบตามจำนวน!',
                    );
                    $this->session->set_userdata($popup);
                }

                else {
                    $serial=$this->insert_serial($data['serial_no'], $id);

                    if($serial) {
                        $this->db->where('id', $id);
                        $this->db->update('tbl_product_orders', $data['sending']);
                        redirect('email/product/'.$id.'/'.$sms=3);
                    }

                    else {
                        $popup=array('msg'=> 1,
                            'detail'=> 'ระบบไม่สามารถอัพเดทข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                        );
                        $this->session->set_userdata($popup);
                    }
                }


            }

            elseif($data['detailInfo'][0]->status=="3") {
                $this->db->where('id', $id);
                $this->db->update('tbl_product_orders', $data['returning']);
                redirect('email/product/'.$id.'/'.$sms=4);
            }

            elseif($data['detailInfo'][0]->status=="4") {
                if(date("Y-m-d H:i:s") <=$data['detailInfo'][0]->order_expire) {

                    $serial=$this->update_serial($data['items']);
                    $product=$this->update_product($data['items']);

                    if($product) {
                        $this->db->where('id', $id);
                        $this->db->update('tbl_product_orders', $data['receiving']);
                        redirect('email/product/'.$id.'/'.$sms=5);
                    }

                    else {
                        $popup=array('msg'=> 1,
                            'detail'=> 'ระบบไม่สามารถอัพเดทข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                        );
                        $this->session->set_userdata($popup);
                    }
                }

                else {
                    $begin=$data['detailInfo'][0]->order_expire;
                    $end=date("Y-m-d H:i:s");
                    $day_over=$this->thaidate->duration($begin, $end);
                    $data['getUpoint']=$this->product_model->getUpoint($data['detailInfo'][0]->hospcode);
                    $temp_point=$data['getUpoint'][0]->point-$day_over;
                    $data['point']=array('point'=> $temp_point,
                        'modified'=> date("Y-m-d H:i:s"));
                    $this->db->where('hospcode', $data['detailInfo'][0]->hospcode);
                    $this->db->update('tbl_product_upoint', $data['point']);

                    $serial=$this->update_serial($data['items']);
                    $product=$this->update_product($data['items']);

                    if($product) {
                        $this->db->where('id', $id);
                        $this->db->update('tbl_product_orders', $data['receiving']);
                        redirect('email/product/'.$id.'/'.$sms=4);
                    }

                    else {
                        $popup=array('msg'=> 1,
                            'detail'=> 'ระบบไม่สามารถอัพเดทข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบครับ!',
                        );
                        $this->session->set_userdata($popup);
                    }
                }
            }

            else {
                $popup=array('msg'=> 1,
                    'detail'=> 'ใบงานนี้อยู่ระหว่างดำเนินการ กรุณาติดต่อผู้ดูแลระบบครับ!',
                );
                $this->session->set_userdata($popup);
            }

            echo json_encode($data);
        }

        else {
            redirect('users/login');
        }
    }

    public function test() {
        $start='2019-10-16';
        $end='2019-10-15';
        $data=$this->thaidate->duration($start, $end);
        echo $data;
    }
}

// echo '<pre>';
// print_r($data);
// echo '</pre>';
// exit;

// $cart = $this->cart->contents();
// echo '<pre>';
// echo print_r($cart);
// echo '</pre>';