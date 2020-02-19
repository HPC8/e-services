<td class="row">
<td class="col-xs-12">
    <div class="clearfix">
        <div class="pull-right tableTools-container"></div>
    </div>
    <div class="table-header">
        ตารางรายการวัสดุ
        <!-- Cart info -->
        <a class="pull-right" href="<?php echo base_url('stock/cart/'); ?>" class="cart-link" title="View Cart">
            <span class="label label-warning arrowed-in-right arrowed ">
                <i class="ace-icon fa fa-shopping-cart bigger-120"></i>
                รายการที่เลือก <span>(<?php echo $this->cart_stock->total_items(); ?>)</span>
            </span>&nbsp;
        </a>
    </div>
<td>
    <table id="tbl-layout-10" class="table table-striped table-bordered table-hover display nowrap" style="width:100%">
        <thead>
            <tr>
                <th width="5%" class="detail-col">No.</th>
                <th width="10%" class="center ">รูปภาพ</th>
                <th width="65%" class="center hidden-1024">ชื่อรายการพัสดุ</th>
                <th width="10%" class="center hidden-768">จำนวนคงเหลือ</th>
                <th width="10%" class="center">Option</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; if(!empty($stock)){ foreach($stock as $row){ ?>
            <tr>
                <td class="center">
                    <?php echo $no;?>
                </td>
                <td class="center">
                    <img data-toggle="modal" data-target="#icon<?php echo $row->id;?>" src="<?php echo base_url('assets/uploads/source/stock/'.$row->image); ?>"
                        title="<?php echo $row->name;?>" width="32" height="32" />
                </td>
                <td class="hidden-1024"><?php echo $row->name;?></td>
                <td class="hidden-768 center"><?php echo $row->quantity;?></td>
                <td class="center">
                    <div class="form-group btn-group">
                        <a class="btn btn-xs btn-success btn-round"
                            href="<?php echo base_url('stock/addToCart/'.$row->id);?>">
                            <i class="ace-icon fa fa-plus-circle bigger-125"></i>
                            เพิ่มรายการ
                        </a>
                    </div>
                </td>
                <div id="icon<?php echo $row->id;?>" class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <img id="icon" class="editable img-responsive" alt="icon"
                                    src="<?php echo base_url()?>assets/uploads/source/stock/<?php echo $row->image;?>" />
                            </div>
                        </div>
                    </div>
                </div>
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
    $this->load->view('stock/alerts');
?>