<div class="modal-body panel-body" id="render-view-emp">
    <div class="row">
        <div class="tab-content no-border padding-24">
            <div id="home" class="tab-pane in active">
                <div class="row">
                    <div class="col-xs-12 col-sm-2 center">
                        <span class="profile-picture">
                            <?php 
                            if($userInfo->photo==""){ ?>
                            <img class="editable img-responsive" alt="photo" id="photo"
                                src="<?php echo base_url()?>assets/uploads/employee/photo/profile-pic.jpg" />
                            <?php
                            }else{ ?>
                            <img class="editable img-responsive" alt="photo" id="photo"
                                src="<?php echo base_url()?><?php echo $userInfo->reference.$userInfo->photo;?>"
                                style="max-width:180px;width:100%" />
                            <?php
                            }
                        ?>
                        </span>
                        <div class="space space-4"></div>
                        <a title="Edit" href="javascript:void(0);" data-getcode="<?php echo $userInfo->hospcode;?>"
                            data-toggle="modal" data-target="#update-user"
                            class="btn btn-sm btn-block btn-primary update-user-details"><i
                                class="ace-icon fa fa-edit bigger-110"></i>
                            <span class="bigger-110">แก้ไข</span> </a>

                            <a title="Password" href="javascript:void(0);" data-getcode="<?php echo $userInfo->hospcode;?>"
                            data-toggle="modal" data-target="#passwd-user"
                            class="btn btn-sm btn-block btn-success passwd-user-details"><i
                                class="ace-icon fa fa-lock bigger-110"></i>
                            <span class="bigger-110">เปลี่ยนรหัสผ่าน</span> </a>
                    </div>

                    <div class="col-xs-12 col-sm-10">
                        <div class="profile-user-info">
                            <div class="profile-info-row">
                                <div class="profile-info-name"> รหัสประจำตัว </div>

                                <div class="profile-info-value">
                                    <span><?php echo $userInfo->hospcode;?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> ชื่อ-สกุล </div>

                                <div class="profile-info-value">
                                    <span><?php echo get_instance()->user_model->getUsername($userInfo->hospcode);?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> เพศ </div>

                                <div class="profile-info-value">
                                    <span><?php echo $userInfo->sex_name;?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> สถานภาพ </div>

                                <div class="profile-info-value">
                                    <span><?php echo $userInfo->marital_name;?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> เกิดวันที่ </div>

                                <div class="profile-info-value">
                                    <span><?= $thaidate->thai_date_fullmonth($userInfo->birthday);?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> อายุ </div>

                                <div class="profile-info-value">
                                    <span><?= $thaidate->birthda($userInfo->birthday);?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> กรุ๊ปเลือด </div>

                                <div class="profile-info-value">
                                    <span><?php echo $userInfo->blood;?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> เลขบัตรประชาชน </div>

                                <div class="profile-info-value">
                                    <span><?php echo $userInfo->cid;?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> ที่อยู่ </div>

                                <div class="profile-info-value">
                                    <span><?php echo $userInfo->address." ต.".$userInfo->district_name." อ.".$userInfo->amphur_name." จ.".$userInfo->province_name." ".$userInfo->zipcode;?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> อีเมล์ </div>

                                <div class="profile-info-value">
                                    <span><?php echo $userInfo->email;?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> เบอร์โทรศัพท์ </div>

                                <div class="profile-info-value">
                                    <span><?php echo $userInfo->mobile;?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> การศึกษา </div>
                                <div class="profile-info-value">
                                    <span><?php echo $userInfo->education_name." ".$userInfo->degree_name." สาขา ".$userInfo->branch;?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> GPA. </div>
                                <div class="profile-info-value">
                                    <span><?php echo $userInfo->gpa;?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> ประเภทบุคลากร </div>

                                <div class="profile-info-value">
                                    <span><?php echo $userInfo->category_name;?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> ตำแหน่ง </div>

                                <div class="profile-info-value">
                                    <span><?php echo $userInfo->position_name." ".$userInfo->level_name;?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> งาน </div>

                                <div class="profile-info-value">
                                    <span><?php echo $userInfo->section_name;?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> กลุ่ม </div>

                                <div class="profile-info-value">
                                    <span><?php echo $userInfo->department_name;?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> วันเริ่มสัญญา </div>

                                <div class="profile-info-value">
                                    <span><?= $thaidate->thai_date_fullmonth($userInfo->start_date);?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> วันสิ้นสุดสัญญา </div>

                                <div class="profile-info-value">
                                    <span><?= $thaidate->thai_date_fullmonth($userInfo->stop_date);?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> สถานะ </div>

                                <div class="profile-info-value">
                                    <span><?php echo get_instance()->user_model->status($userInfo->status);?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> ผู้บันทึก </div>

                                <div class="profile-info-value">
                                    <span><?php if($userInfo->edit_by!=''){echo get_instance()->user_model->getUsername($userInfo->edit_by);}else{echo get_instance()->user_model->getUsername($userInfo->add_by);}?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> วันเวลาที่บันทึก </div>

                                <div class="profile-info-value">
                                    <span><?php if($userInfo->edit_date!=''){echo $thaidate->thai_date_and_time($userInfo->edit_date);}else{echo $thaidate->thai_date_and_time($userInfo->add_date);}?></span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php  
    if($this->session->userdata('msg')=='1'){ {?>
<a title="View" href="javascript:void(0);" id="view-alerts-auto" data-geteid="" data-toggle="modal"
    data-target="#view-alerts"></a>
<?php }
    }elseif($this->session->userdata('msg')=='0'){?>
<a title="View" href="javascript:void(0);" id="view-success-auto" data-geteid="" data-toggle="modal"
    data-target="#view-success"></a>
<?php }
?>
<?php
    $this->load->view('users/alerts');
    $this->load->view('users/popup/edit');
    $this->load->view('users/popup/passwd');
?>