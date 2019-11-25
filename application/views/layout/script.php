<!-- basic scripts -->

<!--[if !IE]> -->
<!-- <script src="<?php echo base_url()?>assets/aceadmin/js/jquery-2.1.4.min.js"></script> -->
<script src="<?php echo base_url()?>assets/aceadmin/js/jquery-2.2.4.js"></script>

<!-- <![endif]-->

<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
<script type="text/javascript">
	if ('ontouchstart' in document.documentElement) document.write(
		"<script src='<?php echo base_url()?>assets/aceadmin/js/jquery.mobile.custom.min.js'>" +
		"<" + "/script>");
</script>
<script src="<?php echo base_url()?>assets/aceadmin/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->

<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->

<!-- <script src="<?php echo base_url()?>assets/js/jquery.min.js"></script> -->
<script src="<?php echo base_url()?>assets/js/jquery-ui.js"></script>

<script src="<?php echo base_url()?>assets/aceadmin/js/jquery-ui.custom.min.js"></script>
<script src="<?php echo base_url()?>assets/aceadmin/js/jquery.ui.touch-punch.min.js"></script>
<script src="<?php echo base_url()?>assets/aceadmin/js/chosen.jquery.min.js"></script>
<script src="<?php echo base_url()?>assets/aceadmin/js/spinbox.min.js"></script>
<script src="<?php echo base_url()?>assets/js/plugins/datetimepicker/jquery.datetimepicker.full.js"></script>
<!-- <script src="<?php echo base_url()?>assets/aceadmin/js/bootstrap-datepicker.min.js"></script> -->
<script src="<?php echo base_url()?>assets/aceadmin/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url()?>assets/aceadmin/js/moment.min.js"></script>
<script src="<?php echo base_url()?>assets/aceadmin/js/daterangepicker.min.js"></script>
<!-- <script src="<?php echo base_url()?>assets/aceadmin/js/bootstrap-datetimepicker.min.js"></script> -->
<!-- <script src="<?php echo base_url()?>assets/aceadmin/js/bootstrap-datepicker-thai.js"></script> -->
<script src="<?php echo base_url()?>assets/aceadmin/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo base_url()?>assets/aceadmin/js/jquery.knob.min.js"></script>
<script src="<?php echo base_url()?>assets/aceadmin/js/autosize.min.js"></script>
<script src="<?php echo base_url()?>assets/aceadmin/js/jquery.inputlimiter.min.js"></script>
<script src="<?php echo base_url()?>assets/aceadmin/js/jquery.maskedinput.min.js"></script>
<script src="<?php echo base_url()?>assets/aceadmin/js/bootstrap-tag.min.js"></script>
<script src="<?php echo base_url()?>assets/aceadmin/js/fullcalendar.min.js"></script>
<script src="<?php echo base_url()?>assets/aceadmin/js/bootbox.js"></script>
<script src="<?php echo base_url()?>assets/aceadmin/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/aceadmin/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/aceadmin/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url()?>assets/aceadmin/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url()?>assets/aceadmin/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url()?>assets/aceadmin/js/buttons.print.min.js"></script>
<script src="<?php echo base_url()?>assets/aceadmin/js/buttons.colVis.min.js"></script>
<script src="<?php echo base_url()?>assets/aceadmin/js/dataTables.select.min.js"></script>
<script src="<?php echo base_url()?>assets/aceadmin/js/fullcalendar-lang-th.js"></script>
<script src="<?php echo base_url()?>assets/aceadmin/js/clockpicker.js"></script>
<script src="<?php echo base_url()?>assets/aceadmin/js/toucheffects.js"></script>

<!-- FooTable -->
<script src="<?php echo base_url()?>assets/js/plugins/footable/footable.all.min.js"></script>

<!-- <script src="<?php echo base_url()?>assets/js/plugins/validator/jquery.min.js"></script> -->
<script src="<?php echo base_url()?>assets/js/plugins/validator/jquery.form.validator.min.js"></script>
<script src="<?php echo base_url()?>assets/js/plugins/validator/security.js"></script>
<script src="<?php echo base_url()?>assets/js/plugins/validator/file.js"></script>

<script src="<?php echo base_url()?>assets/aceadmin/js/ace-elements.min.js"></script>
<script src="<?php echo base_url()?>assets/aceadmin/js/ace.min.js"></script>

<!--custom-->
<script>
	var baseurl = "<?php echo site_url(); ?>";
</script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/custom/datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/custom/config.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/custom/project/plan.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/custom/project/product.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/custom/project/activity.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/custom/project/program.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/custom/posts.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/custom/location.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/custom/emp.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/custom/user.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/custom/products.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/custom/plan/train.js"></script>
<!-- google chart -->
<script type="text/javascript" src="<?php echo base_url()?>assets/js/custom/charts/loader.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/custom/charts/chartEmp.js"></script>


<script type="text/javascript">
	$($('#view-welcome-auto').click());
	$($('#view-alerts-auto').click());
	$($('#view-success-auto').click());
	$($('#alerts-tabel-auto').click());
</script>
<script>
	function manage(txt) {
		var bt = document.getElementById('send_form');
		if (txt.value != '') {
			bt.disabled = false;
		} else {
			bt.disabled = true;
		}
	}

	function accept_box(termsCheckBox) {
		if (termsCheckBox.checked) {
			document.getElementById("send_form").disabled = false;
		} else {
			document.getElementById("send_form").disabled = true;
		}
	}
</script>

<!-- <script>
	$(document).ready(function () {
		var i = 1;
		$('#add').click(function () {
			i++;
			var field_user = '<tr id="row' + i +'"><td><select name="userList[]" class="form-control chosen-select input-train-userList input-sm"id="input-train-userList-'+i+'"><option value="">--กรุณาเลือก--</option><?php foreach($amount as $row){ echo '<option value = "'.$row->hospcode.'"> '.$row->titlename.$row->firstname.' '.$row->lastname.'</option>';}?></select></td><td><select class="form-control input-sm chosen-select" name="userStatus[]"><option value="1">เจ้าหน้าที่</option><option value = "2" > พนักงานขับรถยนต์ </option><option value="3">ขออนุมัติแทน</option></select></td><td class="hidden-768"><input type = "text" name = "userDoc[]" class = "form-control input-sm"/></td></td><td><div class="btn-group"><button type = "button" name ="remove"id ="' + i + '"class = "btn btn-sm btn-danger btn-round btn_remove"><i class="fa fa-minus-circle" aria-hidden="true"></i> ลบข้อมูล</button></div></td ></tr>';
			$('#add_user_field').append(field_user);
			//$('.chosen').chosen();
			if (!ace.vars['touch']) {
				$('.chosen-select').chosen({
					allow_single_deselect: true
				});
				$(window)
					.off('resize.chosen')
					.on('resize.chosen', function () {
						$('.chosen-select').each(function () {
							var $this = $(this);
							$this.next().css({
								'width': '100%'
							});
						})
					}).trigger('resize.chosen');
				$(document).on('settings.ace.chosen', function (e, event_name, event_val) {
					if (event_name != 'sidebar_collapsed') return;
					$('.chosen-select').each(function () {
						var $this = $(this);
						$this.next().css({
							'width': '100%'
						});
					})
				});
			}
			$(document).ready(function () {
				$('[name="userList[]"').change(function () {
					var curr_sel = $(this).attr("id");
					var curr_val = $(this).val();
					var dup = '';
					$('[name="userList[]"').each(function () {
						var name_now = $(this).attr("id");
						if (name_now != curr_sel && $(this).val() == curr_val) {
							if (dup != '') dup += ',';
							dup += name_now;
						}
					});
					if(dup != ''){
						alert('มีในรายชื่อผู้ไปราชการแล้ว ไม่สามารถใส่ซ้ำได้!');
						$('#row' + i + '').remove();
					}			
				});
			});
		});

		$(document).on('click', '.btn_remove', function () {
			var button_id = $(this).attr("id");
			$('#row' + button_id + '').remove();
		});
	});
</script> -->