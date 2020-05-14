<div class="modal fade rotate" id="add-emp" style="display:none;">
    <div class="modal-dialog modal-xl">
        <form id="add-emp-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="modal-content panel panel-default">
                <div class="modal-header panel-heading">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title -remove-title"><i class="ace-icon fa fa-tags"> เพิ่มรายการ</i></h4>
                </div>
                <div class="modal-body panel-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label><strong><U>รหัสประจำตัว</U></strong></label>
                                <div class="input-group">
                                    <label for="emp-hospcode">
                                        <?php echo "<B>".get_instance()->employee_model->hospcodeLast()."</B>";?>
                                    </label>
                                    <input type="hidden" id="emp-hospcode" class="form-control input-emp-hospcode"
                                        name="emp_hospcode"
                                        value="<?php echo get_instance()->employee_model->hospcodeLast();?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label><strong><U>เพศ</U></strong></label>
                                <div>
                                    <div class="radio radio-primary radio-inline">
                                        <input type="radio" id="sexRadio1" value="1" name="emp_sex" checked>
                                        <label for="sexRadio1"> ชาย </label>
                                    </div>
                                    <div class="radio radio-primary radio-inline">
                                        <input type="radio" id="sexRadio2" value="2" name="emp_sex">
                                        <label for="sexRadio2"> หญิง </label>
                                    </div>
                                    <div class="radio radio-primary radio-inline">
                                        <input type="radio" id="sexRadio3" value="3" name="emp_sex">
                                        <label for="sexRadio3"> อื่นๆ </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <label><strong><U>สถานภาพ</U></strong></label>
                                <div>
                                    <div class="radio radio-primary radio-inline">
                                        <input type="radio" id="maritalRadio1" value="1" name="emp_marital" checked>
                                        <label for="maritalRadio1"> โสด </label>
                                    </div>
                                    <div class="radio radio-primary radio-inline">
                                        <input type="radio" id="maritalRadio2" value="2" name="emp_marital">
                                        <label for="maritalRadio2"> คู่ </label>
                                    </div>
                                    <div class="radio radio-primary radio-inline">
                                        <input type="radio" id="maritalRadio3" value="3" name="emp_marital">
                                        <label for="maritalRadio3"> หม้าย </label>
                                    </div>
                                    <div class="radio radio-primary radio-inline">
                                        <input type="radio" id="maritalRadio4" value="4" name="emp_marital">
                                        <label for="maritalRadio4"> หย่า </label>
                                    </div>
                                    <div class="radio radio-primary radio-inline">
                                        <input type="radio" id="maritalRadio5" value="5" name="emp_marital">
                                        <label for="maritalRadio5"> แยก </label>
                                    </div>
                                    <div class="radio radio-primary radio-inline">
                                        <input type="radio" id="maritalRadio6" value="6" name="emp_marital">
                                        <label for="maritalRadio6"> ไม่เปิดเผย </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label><strong><U>คำนำหน้าชื่อ</U></strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-user-md"></i>
                                    </span>
                                    <select name="emp_titlename" class="form-control chosen-select input-emp-titlename"
                                        id="emp-titlename">
                                        <option value="">--กรุณาเลือก--</option>
                                        <?php 
            								foreach($Titlename as $row){ 
              									echo '<option value="'.$row->titlename_name.'">'.$row->titlename_name.'</option>';
            								}
            							?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><strong><U>ชื่อ</U></strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-user"></i>
                                    </span>
                                    <input type="text" name="emp_firstname" class="form-control input-emp-firstname"
                                        id="emp-firstname">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><strong><U>นามสกุล</U></strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-user"></i>
                                    </span>
                                    <input type="text" name="emp_lastname" class="form-control input-emp-lastname"
                                        id="emp-lastname">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label><strong><U>ชื่อ-นามสกุล</U> (ภาษาอังกฤษ)</strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-user"></i>
                                    </span>
                                    <input type="text" name="emp_nameeng"
                                        class="form-control input-emp-nameeng" id="emp-nameeng">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label><strong><U>กรุ๊ปเลือด</U></strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-shield"></i>
                                    </span>
                                    <select class="form-control chosen-select input-emp-blood" name="emp_blood"
                                        id="emp-blood">
                                        <option value="">--กรุณาเลือก--</option>
                                        <?php 
            								foreach($Blood as $row){ 
              									echo '<option value="'.$row->blood_name.'">'.$row->blood_name.'</option>';
            								}
            							?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label><strong><U>วันเกิด</U></strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar bigger-110"></i>
                                    </span>
                                    <input type="text" name="emp_birthday" id="emp-birthday" value=""
                                        class="form-control input-emp-birthday">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label><strong><U>เลขบัตรประชาชน</U></strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-credit-card"></i>
                                    </span>
                                    <input type="text" id="emp-cid" name="emp_cid" class="form-control input-emp-cid" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label><strong><U>อีเมล์</U></strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-envelope"></i>
                                    </span>
                                    <input type="email" name="emp_email" class="form-control input-emp-email"
                                        id="emp-email">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label><strong><U>เบอร์โทรศัพท์</U></strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-phone"></i>
                                    </span>
                                    <input type="text" name="emp_mobile" class="form-control input-emp-mobile"
                                        id="emp-mobile">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label><strong><U>ที่อยู่</U></strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-tags"></i>
                                    </span>
                                    <input type="text" name="emp_address" class="form-control input-emp-address"
                                        id="emp-address">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label><strong><U>จังหวัด</U></strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-tags"></i>
                                    </span>
                                    <select class="form-control chosen-select input-emp-province" name="emp_province"
                                        id="emp-province">
                                        <option value="">--กรุณาเลือก--</option>
                                        <?php
                                            foreach ($Provinces as $key => $row) {
                                                echo '<option value="'.$row->province_id.'">'.$row->province_name.'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label><strong><U>อำเภอ</U></strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-tags"></i>
                                    </span>
                                    <select name="emp_amphur" class="form-control input-emp-amphur" id="emp-amphur">
                                        <option value="">--กรุณาเลือก--</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label><strong><U>ตำบล</U></strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-tags"></i>
                                    </span>
                                    <select name="emp_district" class="form-control input-emp-district"
                                        id="emp-district">
                                        <option value="">--กรุณาเลือก--</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label><strong><U>เลขที่บัญชี</U></strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-shield"></i>
                                    </span>
                                    <input type="text" name="emp_accountno" class="form-control input-emp-accountno"
                                        id="emp-accountno">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label><strong><U>เงินเดือน</U></strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-shield"></i>
                                    </span>
                                    <input type="number" name="emp_salary" class="form-control input-emp-salary"
                                        id="emp-salary">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label><strong><U>เลขที่ตำแหน่ง</U></strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-shield"></i>
                                    </span>
                                    <input type="text" name="emp_positionno" class="form-control input-emp-positionno"
                                        id="emp-positionno">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label><strong><U>วันเริ่มสัญญา</U></strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar bigger-110"></i>
                                    </span>
                                    <input class="form-control input-emp-startdate" id="emp-startdate"
                                        name="emp_startdate" type="text" value="<?php echo date("Y-m-d"); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label><strong><U>วันสิ้นสุดสัญญา</U></strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar bigger-110"></i>
                                    </span>
                                    <input class="form-control input-emp-stopdate" id="emp-stopdate" name="emp_stopdate"
                                        type="text" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label><strong><U>การศึกษา</U></strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-tags"></i>
                                    </span>
                                    <select class="form-control chosen-select input-emp-education" name="emp_education"
                                        id="emp-education">
                                        <option value="">--กรุณาเลือก--</option>
                                        <?php 
            								foreach($Education as $row){ 
              									echo '<option value="'.$row->education_id.'">'.$row->education_name.'</option>';
            								}
            							?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label><strong><U>วุฒิการศึกษา</U></strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-tags"></i>
                                    </span>
                                    <select class="form-control chosen-select input-emp-degree" name="emp_degree"
                                        id="emp-degree">
                                        <option value="">--กรุณาเลือก--</option>
                                        <?php 
            								foreach($Degree as $row){ 
              									echo '<option value="'.$row->degree_id.'">'.$row->degree_name.'</option>';
            								}
            							?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label><strong><U>สาขา</U></strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-tags"></i>
                                    </span>
                                    <input type="text" name="emp_branch" class="form-control input-emp-branch"
                                        id="emp-branch">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label><strong><U>GPA.</U></strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-tags"></i>
                                    </span>
                                    <input type="number" name="emp_gpa" class="form-control input-emp-gpa" id="emp-gpa">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label><strong><U>ประเภทบุคลากร</U></strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-tags"></i>
                                    </span>
                                    <select class="form-control chosen-select input-emp-category" name="emp_category"
                                        id="emp-category">
                                        <option value="">--กรุณาเลือก--</option>
                                        <?php 
            								foreach($Category as $row){ 
              									echo '<option value="'.$row->category_id.'">'.$row->category_name.'</option>';
            								}
            							?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label><strong><U>ตำแหน่ง</U></strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-tags"></i>
                                    </span>
                                    <select class="form-control chosen-select input-emp-position" name="emp_position"
                                        id="emp-position">
                                        <option value="">--กรุณาเลือก--</option>
                                        <?php 
            								foreach($Position as $row){ 
              									echo '<option value="'.$row->position_id.'">'.$row->position_name.'</option>';
            								}
            							?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label><strong><U>ระดับ</U></strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-tags"></i>
                                    </span>
                                    <select class="chosen-select form-control input-emp-level" name="emp_level"
                                        id="emp-level">
                                        <option value="">--กรุณาเลือก--</option>
                                        <?php 
            								foreach($Level as $row){ 
              									echo '<option value="'.$row->level_id.'">'.$row->level_name.'</option>';
            								}
            							?>
                                    </select>
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
                                    <select class="chosen-select form-control input-emp-department"
                                        name="emp_department" id="emp-department">
                                        <option value="">--กรุณาเลือก--</option>
                                        <?php 
            								foreach($Department as $row){ 
              									echo '<option value="'.$row->department_id.'">'.$row->department_name.'</option>';
            								}
            							?>
                                    </select>
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
                                    <select class="chosen-select form-control input-emp-section" name="emp_section"
                                        id="emp-section">
                                        <option value="">--กรุณาเลือก--</option>
                                        <?php 
            								foreach($Section as $row){ 
              									echo '<option value="'.$row->section_id.'">'.$row->section_name.'</option>';
            								}
            							?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label><strong><U>ภาพประจำตัว</U></strong>
                                    <font size="2" color="red"> png, jpg, jpeg, ขนาดไม่เกิน 3MB</font>
                                </label>
                                <input type="file" name="emp_uplfile" class="form-control input-emp-uplfile"
                                    id="input-emp-uplfile">
                                <input type="hidden" name="emp_err" class="form-control input-emp-err" id="emp-err">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label><strong><U>หมายเหตุ</U></strong></label>
                                <textarea name="emp_note" id="emp-note" class="form-control input-edit-note"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer panel-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-sm btn-success btn-round" data-addempid=""
                                    id="add-emp"><i class="ace-icon fa fa-floppy-o bigger-125"></i>บันทึก</button>
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