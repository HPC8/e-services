<div class="modal fade rotate" id="add-activity" style="display:none;">
    <div class="modal-dialog">
        <form id="add-activity-form" method="post">
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
                                    <select name="activity_year" class="form-control input-activity-year"
                                        id="activity-year">
                                        <option value="">--กรุณาเลือกปีงบประมาณ--</option>
                                        <?php for($i="2562"; $i<=date("Y")+543+5; $i++) {?>
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
                                <label><strong>ชื่อผลผลิต</strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-tags"></i>
                                    </span>
                                    <select name="product_id"
                                        class="form-control chosen-select input-activity-product-id"
                                        id="activity-product-id">
                                        <option value="">--กรุณาเลือกผลผลิต--</option>
                                        <?php 
            								foreach($productInfo as $rs){ 
              									echo '<option value="'.$rs->product_id.'">'.$rs->product_name.'</option>';
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
                                <label><strong>ชื่อกิจกรรม</strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-tags"></i>
                                    </span>
                                    <input type="text" name="activity_name" class="form-control input-activity-name"
                                        id="activity-name"
                                        placeholder="การจัดการอนามัยสิ่งแวดล้อมในพื้นที่พัฒนาเขตเศรษฐกิจพิเศษให้เกิดเมืองน่าอยู่อย่างยั่งยืน">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>เงินงบประมาณ</strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-tags"></i>
                                    </span>
                                    <input type="number" name="activity_money" class="form-control input-activity-money"
                                        id="input-activity-money">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer panel-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-sm btn-success btn-round" data-addid=""
                                id="add-activity"><i class="ace-icon fa fa-floppy-o bigger-125"></i>บันทึก</button>
                            <button type="button" class="btn btn-sm btn-danger btn-round" data-dismiss="modal">
                                <i class="ace-icon fa fa-times bigger-125"></i>ยกเลิก</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>