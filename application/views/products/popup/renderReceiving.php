<?php
      if(isset($detailInfo) && is_array($detailInfo) && count($detailInfo)): $i=1;
      foreach ($detailInfo as $data) { 
?>
<div class="row">
    <div class="col-sm-12">
        <div class="widget-box widget-color-blue">
            <div class="widget-header">
                <h5 class="widget-title lighter smaller">รายละเอียดการขอยืมครุภัณฑ์</h5>
                <span class="label label-warning arrowed arrowed-right">การรับคืน <i
                        class="ace-icon fa fa-repeat bigger-120"></i></span>
            </div>
            <div class="row">
                <div class="profile-user-info profile-user-info-striped">
                    <div class="profile-info-row">
                        <div class="profile-info-name"> เลขที่เอกสาร </div>
                        <div class="profile-info-value">
                            <span class="editable" id="hospcode"><?php echo $data->order_doc;?></span>
                            <input type="hidden" id="edit-id" class="form-control input-edit-id" name="edit_id"
                                value="<?php echo $data->id;?>">
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
                        <div class="profile-info-name"> วันที่ใช้งาน </div>
                        <?php
                            if($thaidate->fullmonth($data->start_date)==$thaidate->fullmonth($data->end_date)){?>
                        <div class="profile-info-value">
                            <?php
                                if($thaidate->cutdate($data->start_date)==$thaidate->cutdate($data->end_date)){?>
                            <span>
                                <?= $thaidate->thai_date_fullmonth($data->start_date);?>
                            </span>
                            <?php }
                                else{ ?>
                            <span>
                                <?= $thaidate->cutdate($data->start_date);?> -
                                <?= $thaidate->cutdate($data->end_date);?>
                                <?= $thaidate->fullmonth_year($data->start_date);?>
                            </span>
                            <?php    
                                }
                            ?>
                        </div>
                        <?php
                            }
                        else{?>
                        <div class="profile-info-value">
                            <span><?= $thaidate->thai_date_fullmonth($data->start_date);?> ถึง
                                <?= $thaidate->thai_date_fullmonth($data->end_date);?>
                            </span>
                        </div>
                        <?php    
                            }
                        ?>
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
                            <span class="editable"><?= $thaidate->thai_date_fullmonth($data->created);?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> สถานะ </div>
                        <div class="profile-info-value">
                            <span><?php echo get_instance()->product_model->checkStatus($data->status);?></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> อัพเดท </div>
                        <div class="profile-info-value">
                            <span><?= $thaidate->thai_date_and_time($data->modified);?>
                                <?php if($data->approvers_id!=''&& $data->send_id==''){
                                echo 'โดย'.get_instance()->user_model->getUsername($data->approvers_id);
                            }elseif($data->send_id!=''&& $data->receive_id==''){
                                echo 'โดย'.get_instance()->user_model->getUsername($data->send_id);
                            }elseif($data->receive_id!=''){
                                echo 'โดย'.get_instance()->user_model->getUsername($data->receive_id);
                            }
                            ?>
                            </span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> กำหนดส่งคืน </div>
                        <div class="profile-info-value">
                            <span class="text-danger"><?= $thaidate->thai_date_fullmonth($data->order_expire);?></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> หมายเหตุ </div>
                        <div class="profile-info-value">
                            <textarea class="form-control" name="order_note" id="order_note" placeholder="หมายเหตุ"
                                rows="2"></textarea>
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
                    รายละเอียดครุภัณฑ์
                </h5>
            </div>
            <td>
                <table id="tbl-layout-10" class="table table-striped table-bordered table-hover display nowrap"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th width="5%" class="detail-col">No.</th>
                            <th width="40%" class="center">ชื่อครุภัณฑ์</th>
                            <th width="10%" class="center">จำนวน</th>
                            <th width="10%" class="center">หน่วย</th>
                            <th width="35%" class="center">เลขครุภัณฑ์</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach ($itemsInfo as $item) { ?>
                        <tr>
                            <td class="center">
                                <?php echo $no;?>
                            </td>
                            <td><?php echo $item->name; ?></td>
                            <td class="center"><?php echo $item->quantity; ?></td>
                            <td class="center"><?php echo $item->unit; ?></td>
                            <td class="center"><?php echo $item->serial_text; ?>
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