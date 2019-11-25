<input type="hidden" name="product_id" value="<?php print $productInfo->product_id;?>">
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label><strong>ปีงบประมาณ</strong></label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-tags"></i>
                </span>
                <select name="product_year" class="form-control input-product-year" id="input-product-year">
                    <option value="">--กรุณาเลือกปีงบประมาณ--</option>
                    <?php for($i=date("Y")+543; $i<=date("Y")+543+5; $i++) {?>
                    <option <?php if($i == $productInfo->product_year){ echo 'selected="selected"'; } ?>
                        value="<?php echo $i ?>"><?php echo $i ?> </option>
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
                <select name="plan_id" class="form-control chosen-select input-product-plan-id"
                    id="product-plan-id">
                    <option value="">--กรุณาเลือกแผนงาน--</option>
                    <?php 
            			foreach($planInfo as $rs){ ?>
                    <option <?php if($rs->plan_id == $productInfo->plan_id){ echo 'selected="selected"'; } ?>
                        value="<?php echo $rs->plan_id ?>"><?php echo $rs->plan_name ?> </option>
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
                <input type="text" name="product_name" class="form-control input-product-name" id="input-product-name"
                    placeholder="โครงการพัฒนาการส่งเสริมสุขภาพและอนามัยสิ่งแวดล้อมรองรับพื้นที่เขตเศรษฐกิจพิเศษ"
                    value="<?php print $productInfo->product_name;?>">
            </div>
        </div>
    </div>
</div>