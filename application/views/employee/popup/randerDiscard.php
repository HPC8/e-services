<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label><strong><U>รหัสประจำตัว</U></strong></label>
            <div class="input-group">
                <label for="edit-hospcode">
                    <?php echo "<B>".$codeInfo->hospcode."</B>";?>
                </label>
                <input type="hidden" id="edit-hospcode" class="form-control input-edit-hospcode" name="edit_hospcode"
                    value="<?php echo $codeInfo->hospcode;?>">
            </div>
        </div>
    </div>
    <div class="col-sm-10">
        <div class="form-group">
            <label><strong><U>ชื่อ-สกุล</U></strong></label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-user-md"></i>
                </span>
                <input type="text" class="form-control"
                    value="<?php echo $codeInfo->titlename.$codeInfo->firstname.' '.$codeInfo->lastname;?>" disabled>

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label><strong><U>ประเภทบุคลากร</U></strong></label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-tags"></i>
                </span>
                <input type="text" value="<?php echo $codeInfo->category_name; ?>" class="form-control" disabled />
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label><strong><U>ตำแหน่ง</U></strong></label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-sitemap"></i>
                </span>
                <input type="text" value="<?php echo $codeInfo->position_name.' '.$codeInfo->level_name; ?>"
                    class="form-control" disabled />
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label><strong><U>กลุ่ม</U></strong></label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-sitemap"></i>
                </span>
                <input type="text" value="<?php echo $codeInfo->department_name; ?>" class="form-control" disabled />
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label><strong><U>งาน</U></strong></label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-sitemap"></i>
                </span>
                <input type="text" value="<?php echo $codeInfo->section_name; ?>" class="form-control" disabled />
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label><strong><U>ประเภทการจำหน่าย</U></strong></label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-tags"></i>
                </span>
                <select class="form-control chosen-select input-edit-retire" name="edit_retire" id="edit-retire">
                    <option value="">--กรุณาเลือก--</option>
                    <?php 
            			foreach($retire as $row){ 
              				echo '<option value="'.$row->retire_id.'">'.$row->retire_name.'</option>';
            				}
            			?>
                </select>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label><strong><U>วันที่จำหน่าย</U></strong></label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                </span>
                <input type="text" name="edit_date" id="edit-date" value=""
                    class="form-control input-edit-date" />
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label><strong><U>สาเหตุ</U></strong></label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-tags"></i>
                </span>
                <textarea name="edit_detail" id="edit-detail" maxlength="200" rows="3"
                class="form-control input-edit-detail"></textarea>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label><strong><U>เอกสารแนบ</U></strong></label>
            <input type="file" name="edit_files"  id="edit-files" class="form-control input-edit-files" multiple>
        </div>
    </div>
</div>
