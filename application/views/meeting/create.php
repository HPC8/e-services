<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
            <div class="col-sm-8">
                <div class="widget-box widget-color-blue">
                    <div class="widget-header">
                        <h5 class="widget-title lighter smaller">รายละเอียดการจองห้องประชุม</h5>
                    </div>
                    <div class="widget-body">
                        <div class="widget-main padding-8">
                            <div class="widget-main">
                                <form action="<?php echo site_url('meeting/post_validate/') ?>" method="post"
                                    accept-charset="utf-8">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label><strong><U>ชื่อ-นามสกุล</U></strong></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-user"></i>
                                                    </span>
                                                    <input type="text" name="firstlast_name"
                                                        class="form-control" id="firstlast_name"
                                                        value="<?php echo $user['titlename'].$user['firstname'].' '.$user['lastname']; ?>" disabled>
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
                                                <label><strong><U>เลือกห้องประชุม</U></strong><font color="red">*</font></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-tags"></i>
                                                    </span>
                                                    <select class="form-control" name="meeting_room" id="meeting_room"
                                                        required>
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
                                                <label><strong><U>วันที่เริ่ม</U></strong><font color="red">*</font></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar bigger-110"></i>
                                                    </span>
                                                    <input class="form-control" id="date-mtg-start"
                                                        name="book_start" required type="text"
                                                        value="<?php echo date("Y-m-d"); ?>" autocomplete="off"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label><strong><U>เวลาเริ่ม</U></strong><font color="red">*</font></label>
                                                <div class="input-group clockpicker">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-clock-o"></i>
                                                    </span>
                                                    <input type="text" name="time_start" class="form-control"
                                                        id="time_start" autocomplete="off" required value="08:30">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label><strong><U>วันที่สิ้นสุด</U></strong><font color="red">*</font></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-calendar"></i>
                                                    </span>
                                                    <input class="form-control" required id="date-mtg-end"
                                                        name="book_end" type="text"
                                                        value="<?php echo date("Y-m-d"); ?>" autocomplete="off"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label><strong><U>เวลาสิ้นสุด</U></strong><font color="red">*</font></label>
                                                <div class="input-group clockpicker">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-clock-o"></i>
                                                    </span>
                                                    <input type="text" name="time_end" class="form-control"
                                                        id="time_end" autocomplete="off" required value="16:30">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label><strong><U>วัตถุประสงค์ในการจองห้องประชุม</U></strong><font color="red">*</font></label>
                                                <div>
                                                    <textarea class="form-control" name="detail" id="detail" onkeyup="manage(this)"
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
                                            <button class="btn btn-sm btn-primary btn-round" type="submit"
                                                id="send_form" data-toggle="modal"
                                                data-target="#load-processing" disabled>
                                                <i class="ace-icon fa fa-floppy-o bigger-125"></i>
                                                บันทึก
                                            </button>
                                        </div>
                                    </div>

                                    <!-- <div class="form-group">
                                        <button type="submit" id="send_form" class="btn btn-success">Submit</button>
                                    </div> -->
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