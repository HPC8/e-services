<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>

<head>
	<?php
		$this->load->view('layout2/head');
	?>
</head>

<body class="no-skin"></body>
<div id="navbar" class="navbar navbar-default ace-save-state">
	<div class="navbar-container ace-save-state" id="navbar-container">
		<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
			<span class="sr-only">Toggle sidebar</span>

			<span class="icon-bar"></span>

			<span class="icon-bar"></span>

			<span class="icon-bar"></span>
		</button>

		<div class="navbar-header pull-left">
			<a href="<?php echo base_url()?>" class="navbar-brand">
				<small>
					<i class="fa fa-cubes"></i>
					e-Service Online
				</small>
			</a>
		</div>

		<div class="navbar-buttons navbar-header pull-right" role="navigation">
			<!-- <ul class="nav ace-nav">
				<li class="light-blue dropdown-modal">
					<a data-toggle="dropdown" href="#" class="dropdown-toggle">
						<?php 
                            if($user['photo']==""){ ?>
						<img id="avatar" class="nav-user-photo" alt="avatars"
							src="<?php echo base_url()?>assets/uploads/employee/photo/profile-pic.jpg" />
						<?php
                            }else{ ?>
						<img id="avatar" class="nav-user-photo" alt="avatars"
							src="<?php echo base_url()?><?php echo $user['reference'].$user['photo'];?>" />
						<?php
                            }
                        ?>
						<span class="user-info">
							<small><?php echo $user['titlename'].$user['firstname'].' '.$user['lastname']; ?></small>
							<small><?php echo $user['position_name'].$user['level_name']; ?></small>
						</span>

						<i class="ace-icon fa fa-caret-down"></i>
					</a>
					<ul
						class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
						<li>
							<a href="#">
								<i class="ace-icon fa fa-cog"></i>
								Settings
							</a>
						</li>

						<li>
							<a href="<?php echo site_url('users');?>">
								<i class="ace-icon fa fa-user"></i>
								Profile
							</a>
						</li>

						<li class="divider"></li>

						<li>
							<a href="<?php echo site_url('users/logout');?>">
								<i class="ace-icon fa fa-power-off"></i>
								Logout
							</a>
						</li>
					</ul>
				</li>
			</ul> -->
		</div>
	</div><!-- /.navbar-container -->
</div>

<div class="main-container ace-save-state" id="main-container">
	<script type="text/javascript">
		try {
			ace.settings.loadState('main-container')
		} catch (e) {}
	</script>
	<?php
			$this->load->view('layout2/sidebar');
		?>
	<div class="main-content">
		<?php
    if(isset($breadcrumb)&& is_array($breadcrumb) && count($breadcrumb) > 0){
    ?>
		<div class="main-content-inner">
			<div class="breadcrumbs ace-save-state" id="breadcrumbs">
				<ul class="breadcrumb">
				<i class="fa fa-home" aria-hidden="true"></i>
					<?php
                    	foreach ($breadcrumb as $key=>$value) {
                     	if($value!=''){
                    ?>
					<li><a href="<?php echo $value; ?>"><?php echo $key; ?></a> <span class="divider"></span></li>
					<?php }else{?>
					<li class="active"><?php echo $key; ?></li>
					<?php }
                    }
                    ?>
				</ul>
			</div>

			<div class="page-content">
				<?php echo $contents;
				?>
			</div>
		</div>
		<?php 
        }
	?>
	</div>
	<?php
		$this->load->view('layout2/footer');
		?>
	<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
		<i class="ace-icon fa fa-angle-double-up icon-only bigger-100"></i>
	</a>
</div>
<?php
		$this->load->view('layout2/script');
	?>
</body>

</html>