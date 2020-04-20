<?php
      if(isset($detail) && is_array($detail) && count($detail)): $i=1;
      foreach ($detail as $data) { 
?>
<div class="row">
    <div class="col-sm-12">
        <div class="widget-box widget-color-blue">
            <div class="widget-header">
                <h5 class="widget-title lighter smaller">รายละเอียดการจองห้องประชุม</h5>
            </div>
            <div class="row">
                <div class="profile-user-info profile-user-info-striped">
                    <div class="profile-info-row">
                        <div class="profile-info-name"> เลขที่เอกสาร </div>
                        <div class="profile-info-value">
                            <span class="editable" id="hospcode"><?php echo $data->meeting_doc;?></span>
                            <input type="hidden" id="meetingId" class="form-control"
                                name="meetingId" value="<?php echo $data->id;?>">
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> ชื่อผู้ขอใช้บริการ </div>
                        <div class="profile-info-value">
                            <span class="editable"
                                id="username"><?php echo get_instance()->user_model->getUsername($data->hospcode);?></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> ชื่อห้องประชุม </div>
                        <div class="profile-info-value">
                            <span>
                                <?php 
                                    echo get_instance()->meeting_model->getRoom($data->meeting_room);
                                ?>
                            </span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> วันที่ใช้งาน </div>
                        <?php
                                $time_start=substr($data->book_start,11,5);  
                                $time_stop=substr($data->book_end,11,5);
                                if($thaidate->fullmonth($data->book_start)==$thaidate->fullmonth($data->book_end)){?>
                        <div class="profile-info-value">
                            <span><?= $thaidate->thai_date_fullmonth($data->book_start);?> เวลา
                                <?php echo $time_start?> ถึง <?php echo $time_stop?>
                            </span>
                        </div>
                        <?php
                                }
                                else{?>
                        <div class="profile-info-value">
                            <span><?= $thaidate->thai_date_fullmonth($data->book_start);?> เวลา
                                <?php echo $time_start?> ถึง
                                <?= $thaidate->thai_date_fullmonth($data->book_end);?> เวลา
                                <?php echo $time_stop?>
                            </span>
                        </div>
                        <?php    
                               }
                            ?>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> เรื่อง/เหตุผล </div>

                        <div class="profile-info-value">
                            <span><?php echo $data->detail;?></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> สถานะ </div>
                        <div class="profile-info-value">
                            <span><?php echo get_instance()->meeting_model->checkStatus($data->meeting_status);?></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> อัพเดท </div>
                        <div class="profile-info-value">
                            <!-- <span><?= $thaidate->thai_date_fullmonth($data->update);?></span> -->
                            <span>
                                <?php 
                                    if ( !empty($data->hospcode)) {
                                        echo '<span class="badge">1</span> '.$thaidate->thai_date_and_time($data->meeting_date);
                                        echo ' โดย'.get_instance()->user_model->getUsername($data->hospcode);
                                    }
                                    if ( !empty($data->allower_code)) {  
                                        echo '<br><span class="badge badge-success">2</span> '.$thaidate->thai_date_and_time($data->allower_date);
                                        echo ' โดย'.get_instance()->user_model->getUsername($data->allower_code);
                                    }
                                   
                                ?>
                            </span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> จัดการใบงาน </div>
                        <div class="profile-info-value">
                            <div class="radio radio-success radio-inline">
                                <input type="radio" id="inlineRadio1" value="2" name="inputstatus" checked >
                                <label for="inlineRadio1"> อนุมัติ </label>
                            </div>
                            <div class="radio radio-danger radio-inline">
                                <input type="radio" id="inlineRadio2" value="0" name="inputstatus" >
                                <label for="inlineRadio2"> ไม่อนุมัติ </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="widget-box widget-color-orange">
            <div class="widget-header">
                <h5 class="widget-title lighter smaller">
                    ภาพประกอบ
                </h5>
            </div>
            <img data-toggle="modal" data-target="#room"
                src="<?php echo base_url()?>assets/img/meeting/<?php echo get_instance()->meeting_model->getImages($data->meeting_room);?>"
                style="width:35%;height:35%;">
        </div>
    </div>
</div>
<?php
    $i++;
      }
        else:
            ?>
<?php
    endif;
?>