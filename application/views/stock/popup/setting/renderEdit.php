<input type="hidden" name="id" value="<?php print $stockInfo->id;?>">
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label><strong>ชื่อพัสดุ</strong></label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-tags"></i>
                </span>
                <input type="text" name="stock_name" class="form-control input-stock-name" id="stock-name"
                    autocomplete="off" value="<?php print $stockInfo->name;?>">
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
                <input type="number" name="stock_qty" class="form-control input-stock-qty" id="stock-qty" min="1"
                    max="9999" value="<?php print $stockInfo->quantity;?>">
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
                <input type="text" name="stock_unit" class="form-control input-stock-unit" id="stock-unit"
                    autocomplete="off" value="<?php print $stockInfo->unit;?>">
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
                <select name="stock_group" class="form-control chosen-select input-stock-group" id="stock-group">
                    <option value="">--กรุณาเลือก--</option>
                    <?php 
            			foreach($group as $rs){ ?>
                    <option <?php if($rs->id == $stockInfo->group){ echo 'selected="selected"'; } ?>
                        value="<?php echo $rs->id ?>"><?php echo $rs->name ?> </option>
                    <?php }?>
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
                <select name="stock_category" class="form-control chosen-select input-stock-category"
                    id="stock-category">
                    <option value="">--กรุณาเลือก--</option>
                    <?php 
            			foreach($category as $rs){ ?>
                    <option <?php if($rs->id == $stockInfo->category){ echo 'selected="selected"'; } ?>
                        value="<?php echo $rs->id ?>"><?php echo $rs->name ?> </option>
                    <?php }?>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <img class="editable img-responsive" alt="ประเภทไฟล์ไม่ถูกต้อง" id="edit-stock-uplfile-tag"
                src="<?php echo base_url(); echo $stockInfo->path.$stockInfo->image;?>"
                style="max-width:180px;width:100%" />
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label><strong>รูปภาพ </strong>
                <font size="2" color="red">png, jpg, jpeg, ขนาดไม่เกิน 3MB</font>
            </label>
            <input type="file" name="stock_uplfile" class="form-control input-stock-uplfile"id="edit-stock-uplfile">
            <input type="hidden" name="stock_err" class="form-control input-stock-err" id="edit-stock-err">
        </div>
    </div>
</div>