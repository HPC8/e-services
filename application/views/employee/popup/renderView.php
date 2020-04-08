<div class="row">
    <div class="tab-content no-border padding-24">
        <div id="home" class="tab-pane in active">
            <div class="row">
                <div class="col-xs-12 col-sm-3 center">
                    <span class="profile-picture">
                        <?php 
                            if($codeInfo->photo==""){ ?>
                        <img class="editable img-responsive" alt="photo" id="photo"
                            src="<?php echo base_url()?>assets/uploads/employee/photo/profile-pic.jpg" />
                        <?php
                            }else{ ?>
                        <img class="editable img-responsive" alt="photo" id="photo"
                            src="<?php echo base_url()?><?php echo $codeInfo->reference.$codeInfo->photo;?>"
                            style="max-width:180px;width:100%" />
                        <?php
                            }
                        ?>
                    </span>
                    <div class="space space-4"></div>
                        <center>
                            <img class="editable img-responsive" alt="signature" id="signature"
                                src="<?php echo base_url()."assets/uploads/employee/signature/".$codeInfo->hospcode.".gif";?>"
                                style="max-height:50px;height:100%" />
                            ลายมือชื่อ
                        </center>
                    <div class="space space-4"></div>
                </div>

                <div class="col-xs-12 col-sm-9">
                    <div class="profile-user-info">
                        <div class="profile-info-row">
                            <div class="profile-info-name"> รหัสประจำตัว </div>

                            <div class="profile-info-value">
                                <span><?php echo $codeInfo->hospcode;?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> ชื่อ-สกุล </div>

                            <div class="profile-info-value">
                                <span><?php echo get_instance()->user_model->getUsername($codeInfo->hospcode);?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> เพศ </div>

                            <div class="profile-info-value">
                                <span><?php echo $codeInfo->sex_name;?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> สถานภาพ </div>

                            <div class="profile-info-value">
                                <span><?php echo $codeInfo->marital_name;?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> เกิดวันที่ </div>

                            <div class="profile-info-value">
                                <span><?= $thaidate->thai_date_fullmonth($codeInfo->birthday);?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> อายุ </div>

                            <div class="profile-info-value">
                                <span><?= $thaidate->birthda($codeInfo->birthday);?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> กรุ๊ปเลือด </div>

                            <div class="profile-info-value">
                                <span><?php echo $codeInfo->blood;?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> เลขบัตรประชาชน </div>

                            <div class="profile-info-value">
                                <span><?php echo $codeInfo->cid;?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> ที่อยู่ </div>

                            <div class="profile-info-value">
                                <span><?php echo $codeInfo->address." ต.".$codeInfo->district_name." อ.".$codeInfo->amphur_name." จ.".$codeInfo->province_name." ".$codeInfo->zipcode;?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> อีเมล์ </div>

                            <div class="profile-info-value">
                                <span><?php echo $codeInfo->email;?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> เบอร์โทรศัพท์ </div>

                            <div class="profile-info-value">
                                <span><?php echo $codeInfo->mobile;?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> การศึกษา </div>
                            <div class="profile-info-value">
                                <span><?php echo $codeInfo->education_name." ".$codeInfo->degree_name." สาขา ".$codeInfo->branch;?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> GPA. </div>
                            <div class="profile-info-value">
                                <span><?php echo $codeInfo->gpa;?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> ประเภทบุคลากร </div>

                            <div class="profile-info-value">
                                <span><?php echo $codeInfo->category_name;?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> ตำแหน่ง </div>

                            <div class="profile-info-value">
                                <span><?php echo $codeInfo->position_name." ".$codeInfo->level_name;?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> งาน </div>

                            <div class="profile-info-value">
                                <span><?php echo $codeInfo->section_name;?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> กลุ่ม </div>

                            <div class="profile-info-value">
                                <span><?php echo $codeInfo->department_name;?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> วันเริ่มสัญญา </div>

                            <div class="profile-info-value">
                                <span><?= $thaidate->thai_date_fullmonth($codeInfo->start_date);?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> วันสิ้นสุดสัญญา </div>
                            <div class="profile-info-value">
                                <span><?= $thaidate->thai_date_fullmonth($codeInfo->stop_date);?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> สถานะการปฏิบัติงาน </div>
                            <div class="profile-info-value">
                                <span><?php echo get_instance()->user_model->status($codeInfo->status);?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> หมายเหตุ </div>
                            <div class="profile-info-value">
                                <span><?php echo $codeInfo->note;?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> ผู้บันทึก </div>

                            <div class="profile-info-value">
                                <span><?php echo get_instance()->user_model->getUsername($codeInfo->add_by);?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> วันเวลาที่บันทึก </div>

                            <div class="profile-info-value">
                                <span><?= $thaidate->thai_date_and_time($codeInfo->add_date);?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> ผู้แก้ไข </div>
                            <div class="profile-info-value">
                                <span><?php echo get_instance()->user_model->getUsername($codeInfo->edit_by);?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> วันเวลาที่แก้ไข </div>
                            <div class="profile-info-value">
                                <span><?= $thaidate->thai_date_and_time($codeInfo->edit_date);?></span>
                            </div>
                        </div>
                        <?php
                            if($codeInfo->status==0){ ?>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> วันที่จำหน่าย </div>
                            <div class="profile-info-value">
                                <span><?= $thaidate->thai_date_fullmonth($codeInfo->discard_date);?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> สาเหตุที่จำหน่าย </div>
                            <div class="profile-info-value">
                                <span><?php echo get_instance()->employee_model->getRetirename($codeInfo->retire_id).' '.$codeInfo->discard_detail;?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> เอกสารแนบ </div>
                            <div class="profile-info-value">
                                <span>
                                    <?php 
                                        foreach($discardFile as $row){ ?>
                                        <a href="<?php echo base_url()?>assets/uploads/employee/discard/<?php echo $codeInfo->hospcode.'/'.$row->file_name?>" target="_blank"><img
                                                src="<?php echo base_url()?>assets/uploads/icon/pdf.png" style="max-width:20px;width:100%" /></a>
                                        <?php
                                        }
            			            ?>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> ผู้ทำการจำหน่าย </div>
                            <div class="profile-info-value">
                                <span><?php echo get_instance()->user_model->getUsername($codeInfo->discard_by);?></span>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>