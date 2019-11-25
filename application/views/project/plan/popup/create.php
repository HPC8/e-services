<div class="modal fade rotate" id="add-plan" style="display:none;">
    <div class="modal-dialog">
        <form id="add-plan-form" method="post">
            <div class="modal-content panel panel-default">
                <div class="modal-header panel-heading">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title -remove-title"><i class="ace-icon fa fa-tags"> เพิ่มข้อมูล</i></h4>
                </div>
                <div class="modal-body panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>ปีงบประมาณ</strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-tags"></i>
                                    </span>
                                    <select name="plan_year" class="form-control input-plan-year" id="plan-year">
                                        <option value="">--กรุณาเลือกปีงบประมาณ--</option>
                                        <?php for($i=date("Y")+543; $i<=date("Y")+543+5; $i++) {?>
                                        <option value="<?=$i?>"><?=$i?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>ชื่อแผนงาน</strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-tags"></i>
                                    </span>
                                    <input type="text" name="plan_name" class="form-control input-plan-name"
                                        id="plan-name" placeholder="บูรณาการพัฒนาพื้นที่เขตเศรษฐกิจพิเศษ">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer panel-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-sm btn-success btn-round" data-addplanid=""
                                id="add-plan"><i class="ace-icon fa fa-floppy-o bigger-125"></i>บันทึก</button>
                            <button type="button" class="btn btn-sm btn-danger btn-round" data-dismiss="modal">
                                <i class="ace-icon fa fa-times bigger-125"></i>ยกเลิก</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>