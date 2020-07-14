<!-- hidden -->
<input type="hidden" id="edit-hospcode" class="form-control input-edit-hospcode" name="edit_hospcode"
    value="<?php echo $codeInfo->hospcode;?>">
<input type="hidden" id="edit-passwd-query" class="form-control input-edit-passwd-query" name="passwd_query"
    value="<?php echo $codeInfo->passwd;?>">
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label><strong><U>รหัสผ่านปัจจุบัน</U></strong></label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-unlock-alt"></i>
                </span>
                <input type="password" name="passwd_old" class="form-control input-edit-passwd-old" id="edit-passwd-old"
                    value="">
            </div>
        </div>
    </div>
</div>
<div class="row" id="pwd-container">
    <div class="col-md-12">
        <div class="form-group">
            <label><strong><U>รหัสผ่านใหม่</U></strong></label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-lock"></i>
                </span>
                <input type="password" name="passwd" class="form-control input-edit-passwd" id="edit-passwd" value=""
                    placeholder="กรุณใส่ 6-32 ตัวอักษรที่มีทั้งตัวพิมพ์เล็กพิมพ์ใหญ่และตัวเลข">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-lock"></i>
                </span>
                <input type="password" name="passwdconfirm" class="form-control input-edit-passwdconfirm"
                    id="edit-passwdconfirm" value="" placeholder="กรุณยืนยันรหัสผ่านของคุณอีกครั้ง">
            </div>
        </div>
    </div>
</div>
