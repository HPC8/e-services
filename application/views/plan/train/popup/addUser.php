<div class="modal fade rotate" id="add-user" style="display:none;">
    <div class="modal-dialog">
        <form id="add-user-form" method="post">
            <div class="modal-content panel panel-default">
                <div class="modal-header panel-heading">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title -remove-title"><i class="ace-icon fa fa-tags"> เพิ่มรายชื่อผู้ไปราชการ</i></h4>
                </div>
                <div class="modal-body panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>ชื่อผู้ไปราชการ</label>
                                <input type="hidden" name="train_id" value="<?php echo $trainInfo->id;?>">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-tags"></i>
                                    </span>
                                    <select name="userList"
                                        class="form-control chosen-select input-train-userList input-sm"
                                        id="input-train-userList">
                                        <option value="">--กรุณาเลือก--</option>
                                        <?php 
            								foreach($amount as $rs){ 
              									echo '<option value="'.$rs->hospcode.'">'.$rs->titlename.$rs->firstname.' '.$rs->lastname.'</option>';
            								}
            							?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>สถานะ</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-tags"></i>
                                    </span>
                                    <select class="form-control chosen-select input-sm" name="userStatus">
                                        <?php 
            								foreach($statusInfo as $rs){ 
              									echo '<option value="'.$rs->id.'">'.$rs->name.'</option>';
            								}
            							?>     
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>หมายเหตุ</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-tags"></i>
                                    </span>
                                    <input type="text" name="userDoc" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer panel-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-sm btn-success btn-round" data-addid=""
                                id="add-user"><i class="ace-icon fa fa-floppy-o bigger-125"></i>บันทึก</button>
                            <button type="button" class="btn btn-sm btn-danger btn-round" data-dismiss="modal">
                                <i class="ace-icon fa fa-times bigger-125"></i>ยกเลิก</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>