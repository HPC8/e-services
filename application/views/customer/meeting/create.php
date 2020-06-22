<div class="row">
    <div class="col-lg-12"><span id="success-msg"></span></div>
    <div class="col-xs-12">
        <div class="row">
            <div class="col-sm-8">
                <div class="widget-box widget-color-blue">
                    <div class="widget-header">
                        <h5 class="widget-title lighter smaller">รายละเอียดการจองห้องประชุม</h5>
                    </div>
                    <div class="widget-body">
                        <div class="widget-main padding-8">
                            <div class="widget-main">
                                <form id="add-cusmeeting-form" enctype="multipart/form-data" method="post"
                                    accept-charset="utf-8">

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label><strong><U>ชื่อ-นามสกุล</U></strong></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-user"></i>
                                                    </span>
                                                    <input type="text" name="customer_name"
                                                        class="form-control input-customer-name" id="customer-name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label><strong><U>เลขบัตรประชาชน</U></strong></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-credit-card"></i>
                                                    </span>
                                                    <input type="text" id="customer-cid" name="customer_cid"
                                                        class="form-control input-customer-cid" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label><strong><U>เบอร์โทรศัพท์</U></strong></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-phone"></i>
                                                    </span>
                                                    <input type="text" name="customer_phone"
                                                        class="form-control input-customer-phone" id="customer-phone">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label><strong><U>อีเมล์</U></strong></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-envelope"></i>
                                                    </span>
                                                    <input type="text" name="customer_mail"
                                                        class="form-control input-customer-mail" id="customer-mail">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label><strong><U>ชื่อหน่วยงาน</U></strong></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-building"></i>
                                                    </span>
                                                    <input type="text" name="customer_company"
                                                        class="form-control input-customer-company"
                                                        id="customer-company">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label><strong><U>เลือกห้องประชุม</U></strong>
                                                    <font color="red">*</font>
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-tags"></i>
                                                    </span>
                                                    <select class="form-control input-customer-room"
                                                        name="customer_room" id="customer-room" required>
                                                        <?php 
            												foreach($meeting_room as $row){ 
              														echo '<option value="'.$row->id.'">'.$row->id.' - '.$row->name.'</option>';
            												}
            											?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label><strong><U>วันที่เริ่ม</U></strong>
                                                    <font color="red">*</font>
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar bigger-110"></i>
                                                    </span>
                                                    <input class="form-control input-customer-bookstart"
                                                        id="date-mtg-start" name="book_start" required type="text"
                                                        value="<?php echo date("Y-m-d"); ?>" autocomplete="off" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label><strong><U>เวลาเริ่ม</U></strong>
                                                    <font color="red">*</font>
                                                </label>
                                                <div class="input-group clockpicker">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-clock-o"></i>
                                                    </span>
                                                    <input type="text" name="time_start"
                                                        class="form-control input-customer-timestart" id="time_start"
                                                        autocomplete="off" required value="08:30">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label><strong><U>วันที่สิ้นสุด</U></strong>
                                                    <font color="red">*</font>
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-calendar"></i>
                                                    </span>
                                                    <input class="form-control input-customer-bookend" required
                                                        id="date-mtg-end" name="book_end" type="text"
                                                        value="<?php echo date("Y-m-d"); ?>" autocomplete="off" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label><strong><U>เวลาสิ้นสุด</U></strong>
                                                    <font color="red">*</font>
                                                </label>
                                                <div class="input-group clockpicker">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-clock-o"></i>
                                                    </span>
                                                    <input type="text" name="time_end"
                                                        class="form-control input-customer-timeend" id="time_end"
                                                        autocomplete="off" required value="16:30">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <input type="hidden" name="timeerror"
                                                class="form-control input-customer-timeerror">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label><strong><U>รูปแบบการจัดห้องประชุม</U></strong>
                                                    <font color="red">*</font>
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-tags"></i>
                                                    </span>
                                                    <select class="form-control input-customer-pattern"
                                                        name="customer_pattern" id="customer-pattern" required>
                                                        <?php 
            												foreach($pattern as $row){ 
              														echo '<option value="'.$row->id.'">'.$row->id.' - '.$row->name.'</option>';
            												}
            											?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label><strong><U>จำนวนผู้เข้าประชุม</U></strong>
                                                    <font color="red">*</font>
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-tags"></i>
                                                    </span>
                                                    <input type="number" name="people"
                                                        class="form-control input-customer-people" id="people"
                                                        autocomplete="off" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label><strong><U>เครื่องมือโสตทัศนูปกรณ์</U></strong></label>
                                                <div>
                                                    <div class="checkbox checkbox-primary checkbox-inline">
                                                        <input type="checkbox" id="notebook" value="1"
                                                            name="notebook" >
                                                        <label for="notebook"> เครื่องคอมพิวเตอร์โน้ตบุ้ค </label>
                                                    </div>
                                                    <div class="checkbox checkbox-primary checkbox-inline">
                                                        <input type="checkbox" id="projector" value="2"
                                                            name="projector">
                                                        <label for="projector"> เครื่องฉายโปรเจคเตอร์ </label>
                                                    </div>
                                                    <div class="checkbox checkbox-primary checkbox-inline">
                                                        <input type="checkbox" id="camera" value="3"
                                                            name="camera">
                                                        <label for="camera"> กล้องบันทึกภาพ (พร้อมเจ้าหน้าที่)
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label><strong><U>วัตถุประสงค์ในการจองห้องประชุม</U></strong>
                                                    <font color="red">*</font>
                                                </label>
                                                <div>
                                                    <textarea class="form-control input-customer-detail" name="detail"
                                                        id="detail"
                                                        placeholder="อธิบายวัตถุประสงค์ในการจองห้องประชุมในครั้งนี้"
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
                                            <button type="button" class="btn btn-sm btn-success btn-round"
                                                data-cusmeeting="" id="add-cusmeeting"><i
                                                    class="ace-icon fa fa-floppy-o bigger-125"></i>บันทึก</button>

                                            <!-- <button class="btn btn-sm btn-primary btn-round" type="submit"
                                                id="send_form" data-toggle="modal" data-target="#load-processing"
                                                disabled>
                                                <i class="ace-icon fa fa-floppy-o bigger-125"></i>
                                                บันทึก
                                            </button> -->
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="widget-box widget-color-green2">
                    <div class="widget-header">
                        <h5 class="widget-title lighter smaller">
                            รายละเอียดห้องประชุม
                            <span class="smaller-80">(อุปกรณ์ภายในห้อง)</span>
                        </h5>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main padding-8">
                            <?php 
                            foreach($meeting_room as $row){?>
                            <div class="alert alert-info">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <label><?php echo $row->id.'. '.$row->name;?></label>
                                        <br>&nbsp;&nbsp;<U>รายละเอียด</U>
                                        <br>&nbsp;&nbsp;&nbsp;- จำนวนคนต่อห้อง <?php echo $row->capacity;?> คน
                                        <br>&nbsp;&nbsp;&nbsp;- เครื่องฉายโปรเจคเตอร์ <?php echo $row->projector;?>
                                        เครื่อง
                                        <br>&nbsp;&nbsp;&nbsp;- โต๊ะ <?php echo $row->table;?> ตัว
                                        <br>&nbsp;&nbsp;&nbsp;- เก้าอี้ <?php echo $row->chair;?> ตัว
                                    </div>
                                    <div class="col-lg-4">
                                        <img data-toggle="modal" data-target="#room<?php echo $row->id;?>"
                                            src="<?php echo base_url()?>assets/img/meeting/<?php echo $row->img;?>"
                                            style="width:100%;height:100%;">
                                    </div>
                                    <div id="room<?php echo $row->id;?>" class="modal fade" tabindex="-1" role="dialog"
                                        aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <img id="room" class="editable img-responsive" alt="room"
                                                        src="<?php echo base_url()?>assets/img/meeting/<?php echo $row->img;?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                        ?>
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main padding-8">
                            <div class="alert alert-info">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <U>รูปแบบการจัดห้องประชุม</U>
                                        <img data-toggle="modal" data-target="#room-pattern"
                                            src="<?php echo base_url()?>assets/uploads/meeting/pattern.jpg"
                                            style="width:100%;height:100%;" />
                                    </div>
                                    <div id="room-pattern" class="modal fade" tabindex="-1" role="dialog"
                                        aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <img id="room" class="editable img-responsive" alt="room"
                                                        src="<?php echo base_url()?>assets/uploads/meeting/pattern.jpg" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    $this->load->view('customer/meeting/alerts');
    $this->load->view('customer/meeting/popup/loading');
?>