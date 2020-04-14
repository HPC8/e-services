<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-sm-6">
                <div class="widget-box widget-color-blue">
                    <div class="widget-header">
                        <h5 class="widget-title lighter smaller">รายละเอียดการขอเบิกพัสดุ</h5>
                    </div>
                    <div class="widget-body">
                        <div class="widget-main padding-8">
                            <div class="widget-main">
                                <form action="<?php echo site_url('stock/post_validate/') ?>" method="post"
                                    accept-charset="utf-8">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label><strong><U>ชื่อ-นามสกุล</U></strong></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-user"></i>
                                                    </span>
                                                    <input type="text" name="firstlast_name" class="form-control"
                                                        id="firstlast_name"
                                                        value="<?php echo $user['titlename'].$user['firstname'].' '.$user['lastname']; ?>"
                                                        disabled>
                                                    <input type="hidden" id="inputhospcode" name="inputhospcode"
                                                        value="<?php echo $user['hospcode']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label><strong><U>ตำแหน่ง</U></strong></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-shield"></i>
                                                    </span>
                                                    <input type="text" name="position_name" class="form-control"
                                                        id="position_name"
                                                        value="<?php echo $user['position_name'].$user['level_name']; ?>"
                                                        disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label><strong><U>งาน</U></strong></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-tags"></i>
                                                    </span>
                                                    <input type="text" name="section_name" class="form-control"
                                                        id="section_name" value="<?php echo $user['section_name']; ?>"
                                                        disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label><strong><U>กลุ่มงาน</U></strong></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-sitemap"></i>
                                                    </span>
                                                    <input type="text" name="department_name" class="form-control"
                                                        id="department_name"
                                                        value="<?php echo $user['department_name']; ?>" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label><strong><U>มีความประสงค์จะขอเบิกสิ่งของต่าง ๆ เพื่อ</U></strong>
                                                    <font color="red">*</font>
                                                </label>
                                                <div>
                                                    <textarea class="form-control" name="description" id="description"
                                                        placeholder="อธิบายวัตถุประสงค์ในการขอเบิกพัสดุครั้งนี้"
                                                        rows="4" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $no=0; if($this->cart_stock->total_items() > 0){ foreach($cartItems as $item){
                                            $no++; } }else{ 
                                     } ?>
                                    <input type="hidden" name="item_count" class="form-control" id="item-count"
                                        value="<?php echo $no; ?>">

                                    <div class="form-group">
                                        <div class="btn-group pull-left">
                                            <button class="btn btn-sm btn-danger btn-round" type="reset" value="Reset">
                                                <i class="ace-icon fa fa-times bigger-125"></i>
                                                ยกเลิก
                                            </button>
                                        </div>
                                        <div class="form-group btn-group pull-right">
                                            <button class="btn btn-sm btn-primary btn-round" data-toggle="modal"
                                                data-target="#load-processing" type="submit" name="placeStock"
                                                id="send_form">
                                                <i class="ace-icon fa fa-floppy-o bigger-125"></i>
                                                บันทึก
                                            </button>
                                        </div>
                                        <div class="form-group btn-group pull-right">&nbsp;
                                            <a class="btn btn-sm btn btn-round pull-left"
                                                href="<?php echo base_url('stock/cart/'); ?>"><i
                                                    class="ace-icon fa fa-pencil-square-o bigger-125"></i> แก้ไข </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="widget-box widget-color-green2">
                    <div class="widget-header">
                        <h5 class="widget-title lighter smaller">
                            รายละเอียดพัสดุ
                        </h5>
                    </div>
                    <td>
                        <table id="tbl-layout-10" class="table table-striped table-bordered table-hover display nowrap"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th width="5%" class="detail-col">No.</th>
                                    <th width="10%" class="center ">รูปภาพ</th>
                                    <th width="65%" class="center">ชื่อครุภัณฑ์</th>
                                    <th width="15%" class="center">จำนวน</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; if($this->cart_stock->total_items() > 0){ foreach($cartItems as $item){ ?>
                                <tr>
                                    <td class="center">
                                        <?php echo $no;?>
                                    </td>
                                    <td class="center">
                                        <?php $imageURL = !empty($item["image"])?base_url('assets/uploads/source/stock/'.$item["image"]):base_url('assets/images/pro-demo-img.jpeg'); ?>
                                        <img src="<?php echo $imageURL; ?>" width="32" height="32" />
                                    </td>
                                    <td><?php echo $item["name"]; ?></td>

                                    <td class="center"><?php echo $item["qty"]; ?></td>
                                </tr>
                                <?php  $no++; } }else{ ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </td>
                </div>
            </div>
        </div>
    </div>
</div>
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
    $this->load->view('stock/popup/loading');
?>