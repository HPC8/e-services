<div id="sidebar" class="sidebar responsive ace-save-state">
    <script type="text/javascript">
        try {
            ace.settings.loadState('sidebar')
        } catch (e) {}
    </script>

    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <button class="btn btn-success">
                <i class="ace-icon fa fa-signal"></i>
            </button>

            <button class="btn btn-info">
                <i class="ace-icon fa fa-pencil"></i>
            </button>

            <button class="btn btn-warning">
                <i class="ace-icon fa fa-users"></i>
            </button>

            <button class="btn btn-danger">
                <i class="ace-icon fa fa-cogs"></i>
            </button>
        </div>

        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
        </div>
    </div>

    <ul class="nav nav-list">
        <li  <?php 
			if($page_title=='Welcome'){
			    echo "class='active open'";
			}else{
				echo "class=''" ; } 
		    ?>>
            <a href="<?php echo site_url('customer/');?>">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Dashboard </span>
            </a>

            <b class="arrow"></b>
        </li>

        <li <?php 
			if($page_title=='จองห้องประชุม'|| $page_title=='รายการจองห้องประชุม'|| $page_title=='ปฏิทินจองห้องประชุม'){
			    echo "class='active open'";
			}else{
				echo "class=''" ; } 
		    ?>>
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-calendar"></i>
                <span class="menu-text">
                    ระบบจองห้องประชุม
                </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="<?php echo $page_title  == 'จองห้องประชุม' ? 'active' : '' ?>">
                    <a href="<?php echo site_url('customer/meeting/');?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        จองห้องประชุม
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="<?php echo $page_title  == 'รายการจองห้องประชุม' ? 'active' : '' ?>">
                    <a href="<?php echo site_url('customer/meeting_view/');?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        รายการจองห้องประชุม
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="<?php echo $page_title  == 'ปฏิทินจองห้องประชุม' ? 'active' : '' ?>">
                    <a href="<?php echo site_url('customer/calendar/');?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        ปฏิทินจองห้องประชุม
                    </a>

                    <b class="arrow"></b>
                </li>

            </ul>
        </li>

    </ul>

    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state"
            data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
</div>