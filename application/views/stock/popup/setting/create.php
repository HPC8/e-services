<div class="modal fade rotate" id="add-stock" style="display:none;">
    <div class="modal-dialog">
        <form id="add-stock-form" method="post" accept-charset="utf-8">
            <div class="modal-content panel panel-default">
                <div class="modal-header panel-heading">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title -remove-title"><i class="ace-icon fa fa-tags"> เพิ่มข้อมูล</i></h4>
                </div>
                <div class="modal-body panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>ชื่อพัสดุ</strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-tags"></i>
                                    </span>
                                    <input type="text" name="stock_name" class="form-control input-stock-name"
                                        id="stock-name" autocomplete="off" placeholder="กระดาษถ่ายเอกสาร A4">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>จำนวน</strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-tags"></i>
                                    </span>
                                    <input type="number" name="stock_qty" class="form-control input-stock-qty"
                                        id="stock-qty" min="1" max="9999">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>หน่วยนับ</strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-tags"></i>
                                    </span>
                                    <input type="text" name="stock_unit" class="form-control input-stock-unit"
                                        id="stock-unit" autocomplete="off" placeholder="รีม, กล่อง, ชุด, กล้อง, ขวด">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>หมวด</strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-tags"></i>
                                    </span>
                                    <select name="stock_group" class="form-control chosen-select input-stock-group"
                                        id="stock-group">
                                        <option value="">--กรุณาเลือก--</option>
                                        <?php 
            								foreach($group as $rs){ 
              									echo '<option value="'.$rs->id.'">'.$rs->name.'</option>';
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
                                <label><strong>ประเภท</strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="ace-icon fa fa-tags"></i>
                                    </span>
                                    <select name="stock_category"
                                        class="form-control chosen-select input-stock-category" id="stock-category">
                                        <option value="">--กรุณาเลือก--</option>
                                        <?php 
            								foreach($category as $rs){ 
              									echo '<option value="'.$rs->id.'">'.$rs->name.'</option>';
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
                                <label><strong>รูปภาพ </strong>
                                    <font size="2" color="red">png, jpg, jpeg, ขนาดไม่เกิน 3MB</font>
                                </label>
                                <input type="file" name="stock_uplfile" class="form-control input-stock-uplfile"
                                    id="stock-uplfile">
                                <input type="hidden" name="stock_err" class="form-control input-stock-err"
                                    id="stock-err">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <img class="editable img-responsive" id="stock-uplfile-tag"
                                    style="max-width:180px;width:100%" />
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer panel-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-sm btn-success btn-round" data-addstockid=""
                                id="add-stock"><i class="ace-icon fa fa-floppy-o bigger-125"></i>บันทึก</button>
                            <button type="button" class="btn btn-sm btn-danger btn-round" data-dismiss="modal">
                                <i class="ace-icon fa fa-times bigger-125"></i>ยกเลิก</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>