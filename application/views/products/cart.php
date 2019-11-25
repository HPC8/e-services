<td class="row">
<td class="col-xs-12">
    <div class="clearfix">
        <div class="pull-right tableTools-container"></div>
    </div>
    <div class="table-header">
        ตารางรายการครุภัณฑ์ที่เลือก
    </div>
<td>
    <table id="tbl-layout-10" class="table table-striped table-bordered table-hover display nowrap" style="width:100%">
        <thead>
            <tr>
                <th width="5%" class="detail-col">No.</th>
                <th width="10%" class="center ">รูปภาพ</th>
                <th width="65%" class="center">ชื่อครุภัณฑ์</th>
                <th width="10%" class="center hidden-1024">จำนวน</th>
                <th width="10%" class="center">Option</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; if($this->cart->total_items() > 0){ foreach($cartItems as $item){ ?>
            <tr>
                <td class="center">
                    <?php echo $no;?>
                </td>
                <td class="center">
                    <?php $imageURL = !empty($item["image"])?base_url('assets/uploads/product/'.$item["image"]):base_url('assets/images/pro-demo-img.jpeg'); ?>
                    <img src="<?php echo $imageURL; ?>" />
                </td>
                <td><?php echo $item["name"]; ?></td>

                <td class="hidden-1024 center"><input type="number" min="1" class="form-control input-sm text-center"
                        value="<?php echo $item["qty"]; ?>"
                        onchange="updateCartItem(this, '<?php echo $item["rowid"];?>')"></td>
                <td class="center">
                    <div class="form-group btn-group">
                        <a class="btn btn-xs btn-danger btn-round"
                            href="<?php echo base_url('products/removeItem/'.$item["rowid"]); ?>"
                            onclick="return confirm('ยืนยันการลบข้อมูล ?')"><i
                                class="ace-icon fa fa-trash-o bigger-125"></i>
                            ลบรายการ</a>
                    </div>
                </td>
            </tr>
            <?php  $no++; } }else{ ?>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">
                    <div class="form-group btn-group  pull-left">
                        <a class="btn btn-sm btn-success btn-round" href="<?php echo base_url('products/'); ?>"><i
                                class="ace-icon fa fa-cart-plus bigger-125"></i> เพิ่มรายการครุภัณฑ์ </a>&nbsp;&nbsp;
                    </div>
                </td>

                <?php if($this->cart->total_items() > 0){ ?>
                <!-- <td class="text-left">Grand Total: <b><?php echo '$'.$this->cart->total().' USD'; ?></b></td> -->
                <td class="hidden-1024 center">
                    <div class="form-group btn-group pull-right">
                        <a class="btn btn-sm btn-danger btn-round"
                            href="<?php echo base_url('products/destroy/'); ?>"><i
                                class="ace-icon fa fa-times bigger-125"></i> ยกเลิกรายการทั้งหมด </a>
                    </div>
                </td>
                <td>
                    <div class="form-group btn-group pull-right">
                        <a class="btn btn-sm btn-primary btn-round"
                            href="<?php echo base_url('products/checkout/'); ?>"><i
                                class="ace-icon fa fa-folder-open-o bigger-125"></i> ดำเนินการต่อ </a>
                    </div>
                </td>
                <?php } ?>
            </tr>
        </tfoot>

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