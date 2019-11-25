<div class="row">
    <div class="profile-user-info profile-user-info-striped">
        <div class="profile-info-row">
            <div class="profile-info-name"> <strong>ปีงบประมาณ </strong> </div>
            <div class="profile-info-value">
                <span class="editable"><?php print $activityInfo->activity_year;?></span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> <strong>ผลผลิต </strong> </div>
            <div class="profile-info-value">
                <span
                    class="editable"><?php echo get_instance()->project_model->product_name_full($activityInfo->product_id);?></span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> <strong>กิจกรรม </strong> </div>
            <div class="profile-info-value">
                <span class="editable"><?php print $activityInfo->activity_name;?></span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> <strong>เงินงบประมาณ </strong> </div>
            <div class="profile-info-value">
                <span class="editable"><?php print number_format($activityInfo->activity_money,2);?> บาท</span>
                <span class="editable">ใช้ไป <?php print number_format($activityInfo->activity_charge,2);?> บาท</span>
                <span class="editable">คงเหลือ <?php print number_format($activityInfo->activity_money-$activityInfo->activity_charge,2);?> บาท</span>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name"> <strong>ผู้บันทึก </strong> </div>
            <div class="profile-info-value">
                <span
                    class="editable"><?php echo get_instance()->user_model->getUsername($activityInfo->created_code);?></span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> <strong>วันที่บันทึก </strong> </div>
            <div class="profile-info-value">
                <span class="editable"><?php print $activityInfo->created;?></span>
            </div>
        </div>
        <?php
            if($activityInfo->modified!=''){ ?>
        <div class="profile-info-row">
            <div class="profile-info-name"> <strong>ผู้แก้ไข </strong> </div>
            <div class="profile-info-value">
                <span
                    class="editable"><?php echo get_instance()->user_model->getUsername($activityInfo->modified_code);?></span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> <strong>วันที่แก้ไข </strong> </div>
            <div class="profile-info-value">
                <span class="editable"><?php print $activityInfo->modified;?></span>
            </div>
        </div>
        <?php
            }
        ?>
    </div>

</div>