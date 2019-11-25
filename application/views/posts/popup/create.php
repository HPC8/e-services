<div class="modal fade rotate" id="add-post" style="display:none;">
    <div class="modal-dialog">
        <form id="add-post-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="modal-content panel panel-default">
                <div class="modal-header panel-heading">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title -remove-title"><i class="ace-icon fa fa-tags"> เพิ่มข้อมูล</i></h4>
                </div>
                <div class="modal-body panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>เรื่อง</strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-tags"></i>
                                    </span>
                                    <select name="post_title_id" class="form-control chosen-select input-post-title-id"
                                        id="post-title-id">
                                        <option value="">--กรุณาเลือก--</option>
                                        <?php 
            								foreach($postTitle as $rs){ 
              									echo '<option value="'.$rs->title_id.'">'.$rs->title_name.'</option>';
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
                                <label><strong>รายละเอียด</strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-tags"></i>
                                    </span>
                                    <textarea name="post_content" id="post-content"
                                        class="form-control input-post-content" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>เอกสารแนบ</strong></label>
                                <input type="file" name="post_uplfile" class="form-control input-post-uplfile" id="input-post-uplfile">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer panel-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-sm btn-success btn-round" data-addpostid=""
                                    id="add-post"><i class="ace-icon fa fa-floppy-o bigger-125"></i>บันทึก</button>
                                <button type="button" class="btn btn-sm btn-danger btn-round" data-dismiss="modal">
                                    <i class="ace-icon fa fa-times bigger-125"></i>ยกเลิก</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>