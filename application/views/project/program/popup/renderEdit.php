<input type="hidden" name="program_id" value="<?php print $programInfo->program_id;?>">
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label><strong>ปีงบประมาณ</strong></label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-tags"></i>
                </span>
                <select name="program_year" class="form-control input-program-year" id="program-year">
                    <option value="">--กรุณาเลือกปีงบประมาณ--</option>
                    <?php for($i=date("Y")+543; $i<=date("Y")+543+5; $i++) {?>
                    <option <?php if($i == $programInfo->program_year){ echo 'selected="selected"'; } ?>
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
            <label><strong>ชื่อโครงการ</strong></label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-tags"></i>
                </span>
                <input type="text" name="program_name" class="form-control input-program-name" id="program-name"
                    placeholder="บูรณาการพัฒนาพื้นที่เขตเศรษฐกิจพิเศษ" value="<?php print $programInfo->program_name;?>">
            </div>
        </div>
    </div>
</div>