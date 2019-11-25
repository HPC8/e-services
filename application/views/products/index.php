<td class="row">
<td class="col-xs-12">
    <div class="clearfix">
        <div class="pull-right tableTools-container"></div>
    </div>
    <div class="table-header">
        ตารางรายการครุภัณฑ์
        <!-- Cart info -->                    
        <a class="pull-right" href="<?php echo base_url('products/cart/'); ?>" class="cart-link" title="View Cart">
            <span class="label label-warning arrowed-in-right arrowed ">
                <i class="ace-icon fa fa-shopping-cart bigger-120"></i>
                รายการที่เลือก <span>(<?php echo $this->cart->total_items(); ?>)</span>
            </span>&nbsp;
        </a>
    </div>
<td>
    <table id="tbl-layout-10" class="table table-striped table-bordered table-hover display nowrap" style="width:100%">
        <thead>
            <tr>
                <th width="5%" class="detail-col">No.</th>
                <th width="10%" class="center ">รูปภาพ</th>
                <th width="65%" class="center hidden-1024">ชื่อครุภัณฑ์</th>
                <th width="10%" class="center hidden-768">จำนวนคงเหลือ</th>
                <th width="10%" class="center">Option</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; if(!empty($products)){ foreach($products as $row){ ?>
            <tr>
                <td class="center">
                    <?php echo $no;?>
                </td>
                <td class="center">
                    <img src="<?php echo base_url('assets/uploads/product/'.$row->image); ?>" title="<?php echo $row->name;?>" />
                </td>
                <td class="hidden-1024"><?php echo $row->name;?></td>
                <td class="hidden-768 center"><?php echo $row->quantity;?></td>
                <td class="center">
                    <div class="form-group btn-group">
                        <a class="btn btn-xs btn-success btn-round"
                            href="<?php echo base_url('products/addToCart/'.$row->id);?>">
                            <i class="ace-icon fa fa-plus-circle bigger-125"></i>
                            เพิ่มรายการ
                        </a>
                    </div>
                </td>
            </tr>
            <?php  $no++; } }else{ ?>
            <p>Product(s) not found...</p>
            <?php } ?>
        </tbody>

    </table>
</td>
</td>
</td>
<?php  
    if($this->session->userdata('msg')=='1'){ {?>
<a title="View" href="javascript:void(0);" id="view-alerts-auto" data-geteid="" data-toggle="modal"
    data-target="#view-alerts"></a>
<?php }
    }elseif($this->session->userdata('msg')=='0'){?>
<a title="View" href="javascript:void(0);" id="view-success-auto" data-geteid="" data-toggle="modal"
    data-target="#view-success"></a>
<?php }
?>

<?php
    $this->load->view('products/alerts');
?>