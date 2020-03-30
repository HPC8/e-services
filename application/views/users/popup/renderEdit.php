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
    <div class="col-sm-3">
        <div class="form-group">
            <label><strong><U>เพศ</U></strong></label>
            <div>
                <div class="radio radio-primary radio-inline">
                    <input type="radio" id="sexEdit1" value="1" name="edit_sex"
                        <?php if($codeInfo->sex==1){ echo 'checked'; }?> disabled>
                    <label for="sexEdit1"> ชาย </label>
                </div>
                <div class="radio radio-primary radio-inline">
                    <input type="radio" id="sexEdit2" value="2" name="edit_sex"
                        <?php if($codeInfo->sex==2){ echo 'checked'; }?> disabled>
                    <label for="sexEdit2"> หญิง </label>
                </div>
                <div class="radio radio-primary radio-inline">
                    <input type="radio" id="sexEdit3" value="3" name="edit_sex"
                        <?php if($codeInfo->sex==3){ echo 'checked'; }?> disabled>
                    <label for="sexEdit3"> อื่นๆ </label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-7">
        <div class="form-group">
            <label><strong><U>สถานภาพ</U></strong></label>
            <div>
                <div class="radio radio-primary radio-inline">
                    <input type="radio" id="maritalEdit1" value="1" name="edit_marital"
                        <?php if($codeInfo->marital==1){ echo 'checked'; }?> disabled>
                    <label for="maritalEdit1"> โสด </label>
                </div>
                <div class="radio radio-primary radio-inline">
                    <input type="radio" id="maritalEdit2" value="2" name="edit_marital"
                        <?php if($codeInfo->marital==2){ echo 'checked'; }?> disabled>
                    <label for="maritalEdit2"> คู่ </label>
                </div>
                <div class="radio radio-primary radio-inline">
                    <input type="radio" id="maritalEdit3" value="3" name="edit_marital"
                        <?php if($codeInfo->marital==3){ echo 'checked'; }?> disabled>
                    <label for="maritalEdit3"> หม้าย </label>
                </div>
                <div class="radio radio-primary radio-inline">
                    <input type="radio" id="maritalEdit4" value="4" name="edit_marital"
                        <?php if($codeInfo->marital==4){ echo 'checked'; }?> disabled>
                    <label for="maritalEdit4"> หย่า </label>
                </div>
                <div class="radio radio-primary radio-inline">
                    <input type="radio" id="maritalEdit5" value="5" name="edit_marital"
                        <?php if($codeInfo->marital==5){ echo 'checked'; }?> disabled>
                    <label for="maritalEdit5"> แยก </label>
                </div>
                <div class="radio radio-primary radio-inline">
                    <input type="radio" id="maritalEdit6" value="6" name="edit_marital"
                        <?php if($codeInfo->marital==6){ echo 'checked'; }?> disabled>
                    <label for="maritalEdit6"> ไม่เปิดเผย </label>
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
                <select name="edit_titlename" class="form-control chosen-select input-edit-titlename"
                    id="edit-titlename" disabled>
                    <option value="">--กรุณาเลือก--</option>
                    <?php 
                        foreach($Titlename as $row){ ?>
                    <option <?php if($codeInfo->titlename == $row->titlename_name){ echo 'selected="selected"'; } ?>
                        value="<?php echo $row->titlename_name ?>"><?php echo $row->titlename_name; ?></option>
                    <?php }
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
                <input type="text" name="edit_firstname" class="form-control input-edit-firstname" id="edit-firstname"
                    value="<?php echo $codeInfo->firstname;?>" disabled>
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
                <input type="text" name="edit_lastname" class="form-control input-edit-lastname" id="edit-lastname"
                    value="<?php echo $codeInfo->lastname;?>" disabled>
            </div>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            <label><strong><U>กรุ๊ปเลือด</U></strong></label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-shield"></i>
                </span>
                <select class="form-control chosen-select input-edit-blood" name="edit_blood" id="edit-blood" disabled>
                    <option value="">--กรุณาเลือก--</option>
                    <?php 
                        foreach($Blood as $row){ ?>
                    <option <?php if($codeInfo->blood == $row->blood_name){ echo 'selected="selected"'; } ?>
                        value="<?php echo $row->blood_name ?>"><?php echo $row->blood_name; ?></option>
                    <?php }
                    ?>
                </select>
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
                <input type="text" name="edit_positionno" class="form-control input-edit-positionno"
                    id="edit-positionno" value="<?php echo $codeInfo->position_number;?>" disabled>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-2">
        <div class="form-group">
            <label><strong><U>วันเกิด</U></strong></label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                </span>
                <input type="text" name="edit_birthday" id="edit-birthday" value="<?php echo $codeInfo->birthday;?>"
                    class="form-control input-edit-birthday" disabled>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label><strong><U>เลขบัตรประชาชน</U></strong></label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-shield bigger-110"></i>
                </span>
                <input type="text" id="edit-cid" name="edit_cid" value="<?php echo $codeInfo->cid;?>"
                    class="form-control input-edit-cid" disabled>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label><strong><U>อีเมล์</U></strong></label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-envelope"></i>
                </span>
                <input type="email" name="edit_email" class="form-control input-edit-email" id="edit-email"
                    value="<?php echo $codeInfo->email;?>">
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label><strong><U>เบอร์โทรศัพท์</U></strong></label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-phone"></i>
                </span>
                <input type="text" name="edit_mobile" class="form-control input-edit-mobile" id="edit-mobile"
                    value="<?php echo $codeInfo->mobile;?>">
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
                <input type="text" name="edit_address" class="form-control input-edit-address" id="edit-address"
                    value="<?php echo $codeInfo->address;?>">
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
                <select class="form-control chosen-select input-edit-province" name="edit_province" id="edit-province">
                    <option value="">--กรุณาเลือก--</option>
                    <?php 
                        foreach($Provinces as $key => $row){ ?>
                    <option <?php if($codeInfo->province_id == $row->province_id){ echo 'selected="selected"'; } ?>
                        value="<?php echo $row->province_id ?>"><?php echo $row->province_name; ?></option>
                    <?php }
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
                <select name="edit_amphur" class="form-control input-edit-amphur" id="edit-amphur">
                    <option value="<?php echo $codeInfo->amphur_id;?>">
                        <?php echo get_instance()->location_model->nameAmphur($codeInfo->amphur_id);?></option>
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
                <select name="edit_district" class="form-control input-edit-district" id="edit-district">
                    <option value="<?php echo $codeInfo->district_id;?>">
                        <?php echo get_instance()->location_model->nameDistrict($codeInfo->district_id);?></option>
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
                <input type="text" name="edit_accountno" class="form-control input-edit-accountno" id="edit-accountno"
                    value="<?php echo $codeInfo->account_number;?>" disabled>
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
                <input type="number" name="edit_salary" class="form-control input-edit-salary" id="edit-salary"
                    value="<?php echo $codeInfo->salary;?>" disabled>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label><strong><U>วันเริ่มสัญญา</U></strong></label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                </span>
                <input class="form-control input-edit-startdate" id="edit-startdate" name="edit_startdate" type="text"
                    value="<?php echo $codeInfo->start_date;?>" disabled>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label><strong><U>วันสิ้นสุดสัญญา</U></strong></label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                </span>
                <input class="form-control input-edit-stopdate" id="edit-stopdate" name="edit_stopdate" type="text"
                    value="<?php if($codeInfo->stop_date!='0000-00-00'){echo $codeInfo->stop_date;}?>" disabled>
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
                <select class="form-control chosen-select input-edit-education" name="edit_education"
                    id="edit-education" disabled>
                    <option value="">--กรุณาเลือก--</option>
                    <?php 
                        foreach($Education as $row){ ?>
                    <option <?php if($codeInfo->education_id == $row->education_id){ echo 'selected="selected"'; } ?>
                        value="<?php echo $row->education_id ?>"><?php echo $row->education_name; ?></option>
                    <?php }
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
                <select class="form-control chosen-select input-edit-degree" name="edit_degree" id="edit-degree"
                    disabled>
                    <option value="">--กรุณาเลือก--</option>
                    <?php 
                        foreach($Degree as $row){ ?>
                    <option <?php if($codeInfo->degree_id == $row->degree_id){ echo 'selected="selected"'; } ?>
                        value="<?php echo $row->degree_id ?>"><?php echo $row->degree_name; ?></option>
                    <?php }
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
                <input type="text" name="edit_branch" class="form-control input-edit-branch" id="edit-branch"
                    value="<?php echo $codeInfo->branch;?>" disabled>
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
                <input type="number" name="edit_gpa" class="form-control input-edit-gpa" id="edit-gpa"
                    value="<?php echo $codeInfo->gpa;?>" disabled>
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
                <select class="form-control chosen-select input-edit-category" name="edit_category" id="edit-category"
                    disabled>
                    <option value="">--กรุณาเลือก--</option>
                    <?php 
                        foreach($Category as $row){ ?>
                    <option <?php if($codeInfo->category_id == $row->category_id){ echo 'selected="selected"'; } ?>
                        value="<?php echo $row->category_id ?>"><?php echo $row->category_name; ?></option>
                    <?php }
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
                <select class="form-control chosen-select input-edit-position" name="edit_position" id="edit-position"
                    disabled>
                    <option value="">--กรุณาเลือก--</option>
                    <?php 
                        foreach($Position as $row){ ?>
                    <option <?php if($codeInfo->position_id == $row->position_id){ echo 'selected="selected"'; } ?>
                        value="<?php echo $row->position_id ?>"><?php echo $row->position_name; ?></option>
                    <?php }
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
                <select class="chosen-select form-control input-edit-level" name="edit_level" id="edit-level" disabled>
                    <option value="">--กรุณาเลือก--</option>
                    <?php 
                        foreach($Level as $row){ ?>
                    <option <?php if($codeInfo->level_id == $row->id){ echo 'selected="selected"'; } ?>
                        value="<?php echo $row->id ?>"><?php echo $row->level_name; ?></option>
                    <?php }
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
                <select class="chosen-select form-control input-edit-department" name="edit_department"
                    id="edit-department" disabled>
                    <option value="">--กรุณาเลือก--</option>
                    <?php 
                        foreach($Department as $row){ ?>
                    <option <?php if($codeInfo->department_id == $row->department_id){ echo 'selected="selected"'; } ?>
                        value="<?php echo $row->department_id ?>"><?php echo $row->department_name; ?></option>
                    <?php }
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
                <select class="chosen-select form-control input-edit-section" name="edit_section" id="edit-section"
                    disabled>
                    <option value="">--กรุณาเลือก--</option>
                    <?php 
                        foreach($Section as $row){ ?>
                    <option <?php if($codeInfo->section_id == $row->section_id){ echo 'selected="selected"'; } ?>
                        value="<?php echo $row->section_id ?>"><?php echo $row->section_name; ?></option>
                    <?php }
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
            <input type="file" name="emp_uplfile" class="form-control input-edit-uplfile" id="input-edit-uplfile">
            <input type="hidden" name="emp_err" class="form-control input-emp-err" id="emp-err">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <img class="editable img-responsive" id="input-edit-uplfiletag" style="max-width:180px;width:100%" />
        </div>
    </div>
</div>