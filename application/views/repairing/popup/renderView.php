<?php
      if(isset($dataInfo) && is_array($dataInfo) && count($dataInfo)): $i=1;
      foreach ($dataInfo as $data) { 
?>
<div class="row">
    <div class="col-sm-12">
        <div class="widget-box widget-color-blue">
            <div class="widget-header">
                <h5 class="widget-title lighter smaller">รายละเอียดการแจ้งซ่อม</h5>
            </div>
            <div class="row">
                <div class="profile-user-info profile-user-info-striped">
                    <div class="profile-info-row">
                        <div class="profile-info-name"> เลขที่เอกสาร </div>
                        <div class="profile-info-value">
                            <span class="editable" id="hospcode"><?php echo $data->order_doc;?></span>
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
                        <div class="profile-info-name"> วันที่ขอใช้บริการ </div>
                        <div class="profile-info-value">
                            <span class="editable"><?= $thaidate->thai_date_and_time($data->created);?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> ประเภท </div>

                        <div class="profile-info-value">
                            <span><?php echo get_instance()->repairing_model->returnType($data->type);?></span>
                            <?php 
                                if($data->type == 1 or $data->type == 2){ ?>
                                    <span><?php echo 'เลขครุภัณฑ์ '.$data->serial;?></span>
                               <?php }else{ ?>
                                   <span><?php echo 'เลขทะเบียน '.$data->serial;?></span>
                              <?php  }
                            ?>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> รายละเอียด </div>

                        <div class="profile-info-value">
                            <span><?php echo $data->description;?></span>
                        </div>
                    </div>


                    <div class="profile-info-row">
                        <div class="profile-info-name"> สถานะ </div>
                        <div class="profile-info-value">
                            <span><?php echo get_instance()->repairing_model->checkStatus($data->status);?></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> อัพเดท </div>
                        <div class="profile-info-value">
                            <span>
                                <?php 
                                    if ( !empty($data->hospcode)) {
                                        echo '<span class="badge">1</span> '.$thaidate->thai_date_and_time($data->created);
                                        echo ' โดย'.get_instance()->user_model->getUsername($data->hospcode);
                                    }
                                    if ( !empty($data->approve_id)) {  
                                        echo '<br><span class="badge badge-warning">2</span> '.$thaidate->thai_date_and_time($data->approve_date);
                                        echo ' โดย'.get_instance()->user_model->getUsername($data->approve_id);
                                    }
                                    if ( !empty($data->supplies_id)) {  
                                        echo '<br><span class="badge badge-primary">3</span> '.$thaidate->thai_date_and_time($data->supplies_date);
                                        echo ' โดย'.get_instance()->user_model->getUsername($data->supplies_id);
                                    }
                                    if ( !empty($data->send_id)) {  
                                        echo '<br><span class="badge badge-info">4</span> '.$thaidate->thai_date_and_time($data->send_date);
                                        echo ' โดย'.get_instance()->user_model->getUsername($data->send_id);
                                    }
                                    if ( !empty($data->receive_id)) {  
                                        echo '<br><span class="badge badge-success">5</span> '.$thaidate->thai_date_and_time($data->receive_date);
                                        echo ' โดย'.get_instance()->user_model->getUsername($data->receive_id);
                                    }
                                ?>
                            </span>
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
<?php
    endif;
?>