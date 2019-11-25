<div class="modal fade rotate" id="view-welcome" style="display:none;">
    <div class="modal-dialog">
        <form id="view-welcome-form" method="post">
            <div class="modal-content panel panel-default">
                <div class="modal-header panel-heading">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title -remove-title"><i class="ace-icon fa fa-rss">
                        </i> Welcome
                        <small>
                            <?php echo $user['titlename'].$user['firstname'].' '.$user['lastname'].' | '.$user['position_name'].$user['level_name'];
                            ?>
                        </small>
                        </i></h4>
                </div>
                <div class="modal-body panel-body" id="renderWelcome">
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
                                                <a href="<?php echo $infoPost->path.$infoPost->attached;?>" target="_blank" ><i class="fa fa-file-archive-o"> <?php echo $infoPost->attached; ?></i></a>
                                            <?php }else{
                                                echo 'No File ...';
                                            }
                                        ?>
                                    </span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> <strong>ผู้บันทึก </strong> </div>
                                <div class="profile-info-value">
                                    <span
                                        class="editable"><?php echo get_instance()->user_model->getUsername($infoPost->hospcode);?></span>
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
                </div>
                <div class="modal-footer panel-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-sm btn-success btn-round" data-dismiss="modal">
                                <i class="ace-icon fa fa-check-square-o bigger-125"></i>ตกลง</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>