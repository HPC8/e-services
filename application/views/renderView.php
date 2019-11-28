<div class="row">
    <div class="profile-user-info profile-user-info-striped">
        <div class="profile-info-row">
            <div class="profile-info-name"> <strong>เรื่อง </strong> </div>
            <div class="profile-info-value">
                <span class="editable"><?php echo $infoPost->title_name;?></span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> <strong>รายละเอียด </strong> </div>
            <div class="profile-info-value">
                <span class="editable"><?php echo $infoPost->content;?></span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> <strong>เอกสารแนบ </strong> </div>
            <div class="profile-info-value">
                <span class="editable">
                    <?php 
                        if($infoPost->attached !=''){ ?>
                    <a href="<?php echo $infoPost->path.$infoPost->attached;?>" target="_blank"><i
                            class="fa fa-file-archive-o"> <?php echo $infoPost->attached; ?></i></a>
                    <?php }
                        else{
                            echo 'No File ...';
                        }
                    ?>
                </span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> <strong>ผู้บันทึก </strong> </div>
            <div class="profile-info-value">
                <span class="editable"><?php echo get_instance()->user_model->getUsername($infoPost->hospcode);?></span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> <strong>วันที่บันทึก </strong> </div>
            <div class="profile-info-value">
                <span class="editable"><?php echo $infoPost->created;?></span>
            </div>
        </div>
    </div>

</div>