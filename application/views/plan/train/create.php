<div class="row">
    <div class="col-sm-12">
        <div class="widget-box widget-color-blue">
            <div class="widget-header">
                <h5 class="widget-title">แบบฟอร์มขออนุมัติไปราชการ</h5>
            </div>
            <div class="widget-body">
                <div class="widget-main no-padding">
                    <form class="form-horizontal" id="train-create-form" method="post">
                        <fieldset>
                            <h5 class="header smaller lighter red">
                                <i class="ace-icon fa fa-bullhorn"></i>
                                รายละเอียดใบขออนุมัติ
                            </h5>
                            <div class="form-group">
                                <label class="col-sm-2 control-label no-padding-right" for="input-train-letter">
                                    เลขที่บันทึกขออนุมัติ :
                                </label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="ace-icon fa fa-tags"></i>
                                        </span>
                                        <input type="text" name="train_letter"
                                            class="form-control input-sm input-train-letter" id="input-train-letter"
                                            value="<?php echo $user['department_letter']; ?>/" autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label no-padding-right" for="input-train-create-date">
                                    วันที่ขออนุมัติ :
                                </label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar bigger-110"></i>
                                        </span>
                                        <input class="form-control input-sm input-train-create-date"
                                            id="input-train-create-date" name="train_date_create" type="text"
                                            value="<?php echo date("Y-m-d"); ?>" autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label no-padding-right" for="input-train-hospcode">
                                    ผู้ขออนุมัติ :
                                </label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                        </span>
                                        <input type="text" name="train_hospcode"
                                            class="form-control input-sm input-train-hospcode" id="input-train-hospcode"
                                            value="<?php echo $user['titlename'].$user['firstname'].' '.$user['lastname']; ?>"
                                            disabled>
                                        <input type="hidden" id="hospcode" name="hospcode"
                                            value="<?php echo $user['hospcode']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label no-padding-right"
                                    for="input-train-report-hospcode">
                                    ผู้สรุปรายงาน :
                                </label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                        </span>
                                        <select name="report_hospcodet"
                                            class="form-control chosen-select input-train-report-hospcode input-sm"
                                            id="input-train-report-hospcode" disabled>
                                            <?php 
            			                        foreach($amount as $rs){ ?>
                                            <option
                                                <?php if($rs->hospcode == $user['hospcode']){ echo 'selected="selected"'; } ?>
                                                value="<?php echo $rs->hospcode ?>">
                                                <?php echo $rs->titlename.$rs->firstname.' '.$rs->lastname ?>
                                            </option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label no-padding-right" for="input-train-subject">
                                    มีราชการ :
                                </label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="ace-icon fa fa-file-text"></i>
                                        </span>
                                        <input type="text" name="train_subject"
                                            class="form-control input-sm input-train-subject" id="input-train-subject"
                                            autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label no-padding-right" for="input-train-location">
                                    ณ :
                                </label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="ace-icon fa fa-location-arrow"></i>
                                        </span>
                                        <input type="text" name="train_location"
                                            class="form-control input-sm input-train-location" id="input-train-location"
                                            autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label no-padding-right" for="input-train-form">
                                    จาก :
                                </label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="ace-icon fa fa-building"></i>
                                        </span>
                                        <input type="text" name="train_form"
                                            class="form-control input-sm input-train-form" id="input-train-form"
                                            autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label no-padding-right" for="input-train-start">
                                    วันที่มีราชการจริง :
                                </label>
                                <div class="col-md-6 col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar bigger-110"></i>
                                        </span>
                                        <input type="text" name="train_start" id="input-train-start"
                                            class="form-control input-train-start input-sm"
                                            value="<?php echo date("Y-m-d"); ?>" autocomplete="off">
                                        <span class="input-group-addon">
                                            <i class="fa fa-exchange"></i>
                                        </span>
                                        <input type="text" name="train_end" id="input-train-end"
                                            class="form-control input-sm input-train-end"
                                            value="<?php echo date("Y-m-d"); ?>" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label no-padding-right" for="input-train-travel-start">
                                    วันที่ขออนุมัติเดินทาง :
                                </label>
                                <div class="col-md-6 col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar bigger-110"></i>
                                        </span>
                                        <input type="text" name="train_travel_start" id="input-train-travel-start"
                                            class="form-control input-train-travel-start input-sm"
                                            value="<?php echo date("Y-m-d"); ?>" autocomplete="off">
                                        <span class="input-group-addon">
                                            <i class="fa fa-exchange"></i>
                                        </span>
                                        <input type="text" name="train_travel_end" id="input-train-travel-end"
                                            class="form-control input-sm input-train-travel-end"
                                            value="<?php echo date("Y-m-d"); ?>" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <h5 class="header smaller lighter red">
                                <i class="ace-icon fa fa-bullhorn"></i>
                                รายชื่อผู้ไปราชการ
                            </h5>
                            <div class="col-sm-12">
                                <table class="table table-striped table-bordered" style="width:100%"
                                    id="add_user_field">
                                    <thead>
                                        <tr>
                                            <th width="35%">ชื่อผู้ไปราชการ
                                            </th>
                                            <th width="20%">สถานะ</th>
                                            <th width="20%" class="hidden-768">หมายเหตุ</th>
                                            <th width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select name="userList[]"
                                                    class="form-control chosen-select input-train-userList input-sm"
                                                    id="input-train-userList-1">
                                                    <?php 
            			                                foreach($amount as $rs){ ?>
                                                    <option
                                                        <?php if($rs->hospcode == $user['hospcode']){ echo 'selected="selected"'; } ?>
                                                        value="<?php echo $rs->hospcode ?>">
                                                        <?php echo $rs->titlename.$rs->firstname.' '.$rs->lastname ?>
                                                    </option>
                                                    <?php }?>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control chosen-select input-sm" name="userStatus[]">
                                                        <option value="1">เจ้าหน้าที่</option>
                                                        <option value="2">พนักงานขับรถยนต์</option>
                                                        <option value="3">ขออนุมัติแทน</option>
                                                </select>
                                            </td>
                                            <td class="hidden-768"> <input type="text" name="[]"
                                                    class="form-control input-sm" /></td>
                                            <td>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <h5 class="header smaller lighter red">
                                <i class="ace-icon fa fa-bullhorn"></i>
                                รายละเอียดค่าใช้จ่าย
                            </h5>
                            <div class="form-group">
                                <label class="col-sm-2 control-label no-padding-right" for="allowance">
                                    ค่าเบี้ยเลี้ยง :
                                </label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-usd" aria-hidden="true"></i>
                                        </span>
                                        <input type="text" name="train_allowance"
                                            class="form-control input-sm"
                                            id="allowance" autocomplete="off" value="0" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label no-padding-right" for="hostel">
                                    ค่าที่พัก :
                                </label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-usd" aria-hidden="true"></i>
                                        </span>
                                        <input type="text" name="train_hostel"
                                            class="form-control input-sm" id="hostel"
                                            autocomplete="off" value="0" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label no-padding-right" for="traveling">
                                    ค่าพาหนะ :
                                </label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-usd" aria-hidden="true"></i>
                                        </span>
                                        <input type="text" name="train_traveling"
                                            class="form-control input-sm"
                                            id="traveling" autocomplete="off" value="0" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label no-padding-right" for="oilPrice">
                                    ค่าน้ำมัน :
                                </label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-usd" aria-hidden="true"></i>
                                        </span>
                                        <input type="text" name="train_oilPrice"
                                            class="form-control input-sm"
                                            id="oilPrice" autocomplete="off" value="0" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label no-padding-right" for="otherValues">
                                    ค่าอื่นๆ :
                                </label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-usd" aria-hidden="true"></i>
                                        </span>
                                        <input type="text" name="train_otherValues"
                                            class="form-control input-sm"
                                            id="otherValues" autocomplete="off" value="0" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label no-padding-right" for="sum">
                                    รวมทั้งหมด :
                                </label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-usd" aria-hidden="true"></i>
                                        </span>
                                        <input type="text" name="sum" class="form-control input-sm"
                                            id="sum" disabled/>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-actions center">
                            <div class="btn-group">
                                <button class="btn btn-sm btn-danger btn-round" type="reset" value="Reset">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                    ยกเลิก
                                </button>
                            </div>
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-success btn-round" data-createid=""
                                    id="train-create"><i
                                        class="ace-icon fa fa-floppy-o bigger-125"></i></i>บันทึก</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade rotate" id="load-processing" style="display:none;">
    <div class="modal-dialog">
        <form id="load-processing-form" method="post">
            <div class="modal-content panel panel-default">
                <div class="modal-header panel-heading">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title -remove-title"><i class="fa fa-circle-o-notch fa-spin"></i> กำลังประมวลผล
                    </h4>
                </div>
                <div class="modal-body panel-body" id="render-load-processing">
                    <div class="text-center"><img
                            src="https://apps.anamai.moph.go.th/e-services/assets/uploads/images/loading-crop.gif"
                            style="max-width:360px;width:100%"></div>
                </div>
            </div>
        </form>
    </div>
</div>