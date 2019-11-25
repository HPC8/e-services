<input type="hidden" name="plan_id" value="<?php print $planInfo->plan_id;?>">
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
                    <option <?php if($i == $planInfo->plan_year){ echo 'selected="selected"'; } ?>
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
                <input type="text" name="plan_name" class="form-control input-plan-name" id="plan-name"
                    placeholder="บูรณาการพัฒนาพื้นที่เขตเศรษฐกิจพิเศษ" value="<?php print $planInfo->plan_name;?>">
            </div>
        </div>
    </div>
</div>