<div class="col-xs-12 col-sm-3 center">
    <span class="profile-picture">
        <img class="editable img-responsive" alt="photo" id="photo"
            src="<?php echo base_url(); echo $stockInfo->path.$stockInfo->image;?>"
            style="max-width:180px;width:100%" />
    </span>
    <div class="space space-4"></div>
</div>
<div class="col-xs-12 col-sm-9">
    <div class="row">
        <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
                <div class="profile-info-name"> <strong>ชื่อพัสดุ </strong> </div>
                <div class="profile-info-value">
                    <span class="editable"><?php print $stockInfo->name;?></span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> <strong>จำนวนคงเหลือ </strong> </div>
                <div class="profile-info-value">
                    <span class="editable"><?php print $stockInfo->quantity." ".$stockInfo->unit;?></span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> <strong>หมวด </strong> </div>
                <div class="profile-info-value">
                    <span class="editable">
                        <?php 
            			foreach($group as $rs){
                            if($rs->id == $stockInfo->group){ 
                                echo $rs->name; 
                            } 
                        }?>
                    </span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> <strong>ประเภท </strong> </div>
                <div class="profile-info-value">
                    <span class="editable">
                        <?php 
            			foreach($category as $rs){
                            if($rs->id == $stockInfo->category){ 
                                echo $rs->name; 
                            } 
                        }?>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> <strong>ผู้บันทึก </strong> </div>
                <div class="profile-info-value">
                    <span
                        class="editable"><?php echo get_instance()->user_model->getUsername($stockInfo->add_by);?></span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> <strong>วันที่บันทึก </strong> </div>
                <div class="profile-info-value">
                    <span class="editable"><?= $thaidate->thai_date_and_time($stockInfo->created);?></span>
                </div>
            </div>
            <?php
            if($stockInfo->edit_by!=''){ ?>
            <div class="profile-info-row">
                <div class="profile-info-name"> <strong>ผู้แก้ไข </strong> </div>
                <div class="profile-info-value">
                    <span
                        class="editable"><?php echo get_instance()->user_model->getUsername($stockInfo->edit_by);?></span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> <strong>วันที่แก้ไข </strong> </div>
                <div class="profile-info-value">
                    <span class="editable"><?php print $stockInfo->modified;?></span>
                </div>
            </div>
            <?php
            }
        ?>
        </div>

    </div>
</div>