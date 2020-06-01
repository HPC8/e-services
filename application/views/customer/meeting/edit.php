<?php
      if(isset($edit) && is_array($edit) && count($edit)): $i=1;
      foreach ($edit as $data) { 
	?>
<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-sm-12">
                <div class="widget-box widget-color-blue">
                    <div class="widget-header">
                        <h5 class="widget-title lighter smaller">แก้ไขรายละเอียดการจองห้องประชุม</h5>
                    </div>
                    <div class="widget-body">
                        <div class="widget-main padding-8">
                            <div class="widget-main">
                                <form action="<?php echo site_url('meeting/update_data/').$data->id?>" method="post"
                                    accept-charset="utf-8">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="firstlast_name">
                                                    ชื่อ-นามสกุล
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-user"></i>
                                                    </span>
                                                    <input type="text" name="firstlast_name" required
                                                        class="form-control" id="firstlast_name"
                                                        value="<?php echo $user['titlename'].$user['firstname'].' '.$user['lastname']; ?>">
                                                    <input type="hidden" id="inputhospcode" name="inputhospcode"
                                                        value="<?php echo $user['hospcode']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="position_name">
                                                    ตำแหน่ง
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-shield"></i>
                                                    </span>
                                                    <input type="text" name="position_name" class="form-control"
                                                        id="position_name"
                                                        value="<?php echo $user['position_name'].$user['level_name']; ?>"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="section_name">
                                                    งาน
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-tags"></i>
                                                    </span>
                                                    <input type="text" name="section_name" class="form-control"
                                                        id="section_name" value="<?php echo $user['section_name']; ?>"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="department_name">
                                                    กลุ่มงาน
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-sitemap"></i>
                                                    </span>
                                                    <input type="text" name="department_name" class="form-control"
                                                        id="department_name"
                                                        value="<?php echo $user['department_name']; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="meeting_room">
                                                    เลือกห้องประชุม
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-tags"></i>
                                                    </span>
                                                    
                                                    <select class="form-control" name="meeting_room" id="meeting_room"
                                                        required>
                                                        <?php foreach ($meeting_room as $row) { ?>
                                                            <option <?php if($row->id == $data->meeting_room){ echo 'selected="selected"'; } ?> value="<?php echo $row->id ?>"><?php echo $row->id.' - '.$row->name ?> </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                       // echo $data['meeting_room'];
                                        $book_start=substr($data->book_start,0,10);  
                                        $book_end=substr($data->book_end,0,10);
                                        $time_start=substr($data->book_start,11,5);  
                                        $time_stop=substr($data->book_end,11,5);
                                    ?>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="book_start">
                                                    วันที่เริ่ม
                                                </label>

                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar bigger-110"></i>
                                                    </span>

                                                    <input class="form-control date-picker" id="book_start"
                                                        name="book_start" required type="text" value="<?php echo $book_start; ?>"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="time_start">
                                                    เวลาเริ่ม
                                                </label>
                                                <div class="input-group clockpicker">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-clock-o"></i>
                                                    </span>
                                                    <input type="text" name="time_start" class="form-control"
                                                        id="time_start" value="<?php echo $time_start; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="book_end">
                                                    วันที่สิ้นสุด
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-calendar"></i>
                                                    </span>
                                                    <input class="form-control date-picker" required id="book_end"
                                                        name="book_end" type="text"
                                                        value="<?php echo $book_end; ?>"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="time_end">
                                                    เวลาสิ้นสุด
                                                </label>
                                                <div class="input-group clockpicker">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-clock-o"></i>
                                                    </span>
                                                    <input type="text" name="time_end" class="form-control"
                                                        id="time_end" value="<?php echo $time_stop; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="detail">
                                                    วัตถุประสงค์ในการจองห้องประชุม 
                                                </label>
                                                <div>
                                                    <textarea class="form-control" name="detail" id="detail"
                                                        placeholder="อธิบายวัตถุประสงค์ในการจองห้องประชุมในครั้ง"
                                                        rows="6" required><?php echo $data->detail; ?></textarea>
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
                                                id="send_form">
                                                <i class="ace-icon fa fa-floppy-o bigger-125"></i>
                                                บันทึก
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php
    $i++;
      }
        else:
			?>
<a title="View" href="javascript:void(0);" id="alerts-tabel-auto" data-geteid="" data-toggle="modal"
    data-target="#alerts-tabel"></a>

<?php
    endif;
?>
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
?>