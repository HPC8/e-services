<div class="row">
    <div class="profile-user-info profile-user-info-striped">
        <div class="profile-info-row">
            <div class="profile-info-name"> <strong>ปีงบประมาณ </strong> </div>
            <div class="profile-info-value">
                <span class="editable"><?php print $productInfo->product_year;?></span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> <strong>ชื่อแผนงาน </strong> </div>
            <div class="profile-info-value">
                <span
                    class="editable"><?php echo get_instance()->project_model->plan_name_full($productInfo->plan_id);?></span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> <strong>ผลผลิต </strong> </div>
            <div class="profile-info-value">
                <span class="editable"><?php print $productInfo->product_name;?></span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> <strong>เงินงบประมาณ </strong> </div>
            <div class="profile-info-value">
                <span class="editable"><?php print number_format($moneyInfo,2);?> บาท</span>
                <span class="editable">ใช้ไป <?php print number_format($chargeInfo,2);?> บาท</span>
                <span class="editable">คงเหลือ <?php print number_format($moneyInfo-$chargeInfo,2);?> บาท</span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> <strong>ผู้บันทึก </strong> </div>
            <div class="profile-info-value">
                <span
                    class="editable"><?php echo get_instance()->user_model->getUsername($productInfo->created_code);?></span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> <strong>วันที่บันทึก </strong> </div>
            <div class="profile-info-value">
                <span class="editable"><?php print $productInfo->created;?></span>
            </div>
        </div>
        <?php
            if($productInfo->modified!=''){ ?>
        <div class="profile-info-row">
            <div class="profile-info-name"> <strong>ผู้แก้ไข </strong> </div>
            <div class="profile-info-value">
                <span
                    class="editable"><?php echo get_instance()->user_model->getUsername($productInfo->modified_code);?></span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> <strong>วันที่แก้ไข </strong> </div>
            <div class="profile-info-value">
                <span class="editable"><?php print $productInfo->modified;?></span>
            </div>
        </div>
        <?php
            }
        ?>
    </div>

</div>