<div class="row">
    <div class="profile-user-info profile-user-info-striped">
        <div class="profile-info-row">
            <div class="profile-info-name"> <strong>ปีงบประมาณ </strong> </div>
            <div class="profile-info-value">
                <span class="editable"><?php print $programInfo->program_year;?></span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> <strong>ชื่อแผนงาน </strong> </div>
            <div class="profile-info-value">
                <span class="editable"><?php print $programInfo->program_name;?></span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> <strong>ผู้บันทึก </strong> </div>
            <div class="profile-info-value">
                <span
                    class="editable"><?php echo get_instance()->user_model->getUsername($programInfo->created_code);?></span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> <strong>วันที่บันทึก </strong> </div>
            <div class="profile-info-value">
                <span class="editable"><?php print $programInfo->created;?></span>
            </div>
        </div>
        <?php
            if($programInfo->modified!=''){ ?>
        <div class="profile-info-row">
            <div class="profile-info-name"> <strong>ผู้แก้ไข </strong> </div>
            <div class="profile-info-value">
                <span
                    class="editable"><?php echo get_instance()->user_model->getUsername($programInfo->modified_code);?></span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> <strong>วันที่แก้ไข </strong> </div>
            <div class="profile-info-value">
                <span class="editable"><?php print $programInfo->modified;?></span>
            </div>
        </div>
        <?php
            }
        ?>

    </div>

</div>