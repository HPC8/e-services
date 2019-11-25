<?php
      if(isset($detail) && is_array($detail) && count($detail)): $i=1;
      foreach ($detail as $data) { 
	?>
<div class="table-detail">
    <div class="row">
        <div class="col-xs-12">
            <div>
                <div id="user-profile-1" class="user-profile row">
                    <div class="col-xs-12 col-sm-3 center">
                        <span class="profile-picture">
                            <img data-toggle="modal" data-target="#room"
                                src="<?php echo base_url()?>assets/img/meeting/<?php echo get_instance()->meeting_model->getImages($data->meeting_room);?>"
                                style="width:100%;height:100%;">
                        </span>
                    </div>
                    <div id="room" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <img id="room" class="editable img-responsive" alt="room"
                                        src="<?php echo base_url()?>assets/img/meeting/<?php echo get_instance()->meeting_model->getImages($data->meeting_room);?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="<?php echo site_url('meeting/update_document/').$data->id?>" method="post"
                        accept-charset="utf-8">
                        <div class="col-xs-12 col-sm-9">
                            <div class="profile-user-info profile-user-info-striped">
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> เลขที่เอกสาร </div>
                                    <div class="profile-info-value">
                                        <span class="editable" id="hospcode"><?php echo $data->meeting_doc;?></span>
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
                                if($mydate->ThaiMonth($data->book_start)==$mydate->ThaiMonth($data->book_end)){?>
                                    <div class="profile-info-value">
                                        <span><?= $mydate->ThaiFull($data->book_start);?> เวลา
                                            <?php echo $time_start?> ถึง <?php echo $time_stop?>
                                        </span>
                                    </div>
                                    <?php
                                }
                                else{?>
                                    <div class="profile-info-value">
                                        <span><?= $mydate->ThaiFull($data->book_start);?> เวลา
                                            <?php echo $time_start?> ถึง
                                            <?= $mydate->ThaiFull($data->book_end);?> เวลา
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
                                        <span><?= $mydate->ThaiFull($data->update);?></span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> จัดการใบงาน </div>
                                    <div class="profile-info-value">
                                        <div class="radio radio-success radio-inline">
                                            <input type="radio" id="inlineRadio1" value="2" name="inputstatus" required <?php if($data->meeting_status == '2' ) { echo 'checked'; } ?>>
                                            <label for="inlineRadio1"> อนุมัติ </label>
                                        </div>
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="inlineRadio2" value="3" name="inputstatus" required <?php if($data->meeting_status == '3' ) { echo 'checked'; } ?>>
                                            <label for="inlineRadio2"> ไม่อนุมัติ </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> </div>
                                    <div class="profile-info-value">
                                        <button class="btn btn-minier btn-primary btn-round" type="submit"
                                            id="send_form">
                                            <i class="ace-icon fa fa-floppy-o bigger-125"></i>
                                            บันทึก
                                        </button>
                                        <button class="btn btn-minier btn-danger btn-round" type="reset" value="Reset">
                                            <i class="ace-icon fa fa-times bigger-125"></i>
                                            ยกเลิก
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
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
    $this->load->view('meeting/alerts');
?>