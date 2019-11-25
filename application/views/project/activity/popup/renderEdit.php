<input type="hidden" name="activity_id" value="<?php print $activityInfo->activity_id;?>">
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label><strong>ปีงบประมาณ</strong></label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-tags"></i>
                </span>
                <select name="activity_year" class="form-control input-activity-year" id="input-activity-year">
                    <option value="">--กรุณาเลือกปีงบประมาณ--</option>
                    <?php for($i=date("Y")+543; $i<=date("Y")+543+5; $i++) {?>
                    <option <?php if($i == $activityInfo->activity_year){ echo 'selected="selected"'; } ?>
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
            <label><strong>ชื่อผลผลิต</strong></label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-tags"></i>
                </span>
                <select name="product_id" class="form-control chosen-select input-activity-product-id"
                    id="activity-product-id">
                    <option value="">--กรุณาเลือกผลผลิต--</option>
                    <?php 
            			foreach($productInfo as $rs){ ?>
                    <option <?php if($rs->product_id == $activityInfo->product_id){ echo 'selected="selected"'; } ?>
                        value="<?php echo $rs->product_id ?>"><?php echo $rs->product_name ?> </option>
                    <?php }?>
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
                    id="input-activity-name"
                    placeholder="การจัดการอนามัยสิ่งแวดล้อมในพื้นที่พัฒนาเขตเศรษฐกิจพิเศษให้เกิดเมืองน่าอยู่อย่างยั่งยืน"
                    value="<?php print $activityInfo->activity_name;?>">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label><strong>งบประมาณ</strong></label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-tags"></i>
                </span>
                <input type="number" name="activity_money" class="form-control input-activity-money" id="input-activity-money" value="<?php print $activityInfo->activity_money;?>">
            </div>
        </div>
    </div>
</div>