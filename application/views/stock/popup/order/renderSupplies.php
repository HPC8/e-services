<?php
      if(isset($orderInfo) && is_array($orderInfo) && count($orderInfo)): $i=1;
      foreach ($orderInfo as $data) { 
?>
<div class="row">
    <div class="col-sm-12">
        <div class="widget-box widget-color-blue">
            <div class="widget-header">
                <h5 class="widget-title lighter smaller">รายละเอียดการขอเบิกวัสดุ</h5>
            </div>
            <div class="row">
                <div class="profile-user-info profile-user-info-striped">
                    <div class="profile-info-row">
                        <div class="profile-info-name"> เลขที่เอกสาร </div>
                        <div class="profile-info-value">
                            <span class="editable" id="hospcode"><?php echo $data->order_doc;?></span>
                            <input type="hidden" id="orderId" class="form-control"
                                name="orderId" value="<?php echo $data->id;?>">
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
                        <div class="profile-info-name"> เรื่อง/เหตุผล </div>

                        <div class="profile-info-value">
                            <span><?php echo $data->description;?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> วันที่ขอใช้บริการ </div>
                        <div class="profile-info-value">
                            <span class="editable"><?= $thaidate->thai_date_and_time($data->created);?></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> สถานะ </div>
                        <div class="profile-info-value">
                            <span><?php echo get_instance()->stock_model->checkStatus($data->status);?></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> อัพเดท </div>
                        <div class="profile-info-value">
                            <span>
                                <?php 
                                    if ( !empty($data->hospcode)) {
                                        echo '<span class="badge">1</span> '.$thaidate->thai_date_and_time($data->modified);
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
                    <div class="profile-info-row">
                        <div class="profile-info-name"> จัดการใบงาน </div>
                        <div class="profile-info-value">
                            <div class="radio radio-success radio-inline">
                                <input type="radio" id="inlineRadio1" value="3" name="inputstatus" checked
                                    <?php if($data->status == '3' ) { echo 'checked'; } ?>>
                                <label for="inlineRadio1"> อนุมัติ </label>
                            </div>
                            <div class="radio radio-danger radio-inline">
                                <input type="radio" id="inlineRadio2" value="7" name="inputstatus" 
                                    <?php if($data->status == '7' ) { echo 'checked'; } ?>>
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
                    รายละเอียดพัสดุ
                </h5>
            </div>
            <td>
                <table id="tbl-layout-10" class="table table-striped table-bordered table-hover display nowrap"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th width="5%" class="detail-col">No.</th>
                            <th width="70%" class="center">ชื่อครุภัณฑ์</th>
                            <th width="10%" class="center">จำนวน</th>
                            <th width="15%" class="center">หน่วย</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach ($orderItems as $item) { ?>
                        <tr>
                            <td class="center">
                                <?php echo $no;?>
                            </td>
                            <td><?php echo $item->name; ?></td>
                            <td class="center"><?php echo $item->quantity; ?></td>
                            <td class="center"><?php echo $item->unit; ?></td>
                            
                        </tr>
                        <?php $no++;} ?>
                    </tbody>
                </table>
            </td>
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