<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-sm-12">
                <div class="widget-box widget-color-blue">
                    <div class="widget-header">
                        <h5 class="widget-title lighter smaller">รายละเอียดการแจ้งปัญหา</h5>
                    </div>
                    <div class="widget-body">
                        <div class="widget-main padding-8">
                            <div class="widget-main">
                                <form id="add-repairing-form" method="post">
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
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label><strong>ประเภทของปัญหา</strong></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-tags"></i>
                                                    </span>
                                                    <select name="repairing_type"
                                                        class="form-control chosen-select input-repairing-type"
                                                        id="repairing-type">
                                                        <option value="">--กรุณาเลือก--</option>
                                                        <?php 
            								                foreach($getType as $rs){ 
              									                echo '<option value="'.$rs->id.'">'.$rs->name.'</option>';
            								                }
            							                ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label><strong><U>เลขครุภัณฑ์/เลขทะเบียน</U></strong></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-sitemap"></i>
                                                    </span>
                                                    <input type="text" name="repairing_serial"
                                                        class="form-control input-repairing-serial"
                                                        id="repairing-serial" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label><strong><U>รายละเอียดการส่งซ่อม</U></strong>
                                                    <font color="red">*</font>
                                                </label>
                                                <div>
                                                    <textarea class="form-control input-repairing-detail" name="repairing_detail" id="repairing-detail"
                                                     rows="6" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="btn-group pull-left">
                                            <button class="btn btn-sm btn-danger btn-round" type="reset" value="Reset">
                                                <i class="ace-icon fa fa-times bigger-125"></i>
                                                ยกเลิก
                                            </button>
                                        </div>
                                        <div class="form-group btn-group pull-right">
                                            <button type="button" class="btn btn-sm btn-primary btn-round" data-addid=""
                                                id="add-repairing"><i
                                                    class="ace-icon fa fa-floppy-o bigger-125"></i>บันทึก</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div><!-- /.row -->

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
    $this->load->view('meeting/alerts');
    $this->load->view('meeting/popup/loading');
?>