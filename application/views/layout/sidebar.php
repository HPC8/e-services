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
        <?php $uriMethod=$this->router->fetch_method(); ?>
        <li <?php 
			if($page_title=='Welcome'){
			echo "class='active'";
			}else{
				echo "class=''" ; } 
		?>>
            <a href="<?php echo base_url()?>">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Dashboard </span>
            </a>

            <b class="arrow"></b>
        </li>

        <li <?php 
			if($page_title=='ข่าวประชาสัมพันธ์'|| $page_title=='รายการข่าว'){
			    echo "class='active open'";
			}else{
				echo "class=''" ; } 
		    ?>>
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-rss"></i>
                <span class="menu-text">
                    ข่าวประชาสัมพันธ์
                </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="<?php echo $page_title  == 'ข่าวประชาสัมพันธ์' ? 'active' : '' ?>">
                    <a href="<?php echo site_url('posts/');?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        NEW!
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="<?php echo $page_title  == 'รายการข่าว' ? 'active' : '' ?>">
                    <a href="<?php echo site_url('posts/');?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        รายการข่าว
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
        <li <?php 
			if($page_title=='ลิงค์ภายใน'||$page_title=='ลิงค์ภายนอก'){
			    echo "class='active open'";
			}else{
				echo "class=''" ; } 
		    ?>>
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-external-link"></i>
                <span class="menu-text">
                    Quick link
                </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="<?php echo $page_title  == 'ลิงค์ภายใน' ? 'active' : '' ?>">
                    <a href="<?php echo site_url('link/');?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        ลิงค์ภายใน
                    </a>
                    <b class="arrow"></b>
                </li>
                <li class="<?php echo $page_title  == 'ลิงค์ภายนอก' ? 'active' : '' ?>">
                    <a href="<?php echo site_url('link/external/');?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        ลิงค์ภายนอก
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
        <li <?php 
			if($page_title=='ระบบบุคลากร'|| $page_title=='บุคลากร'|| $page_title=='User &amp; Password'){
			    echo "class='active open'";
			}else{
				echo "class=''" ; } 
		    ?>>
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-book"></i>
                <span class="menu-text">
                    ระบบบุคลากร
                </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="<?php echo $page_title  == 'บุคลากร' ? 'active' : '' ?>">
                    <a href="<?php echo site_url('employee/');?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        ข้อมูลบุคลากร
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="<?php echo $page_title  == 'User &amp; Password' ? 'active' : '' ?>">
                    <a href="<?php echo site_url('employee/user_pass/');?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        User &amp; Password
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
        <li <?php 
			if($page_title=='ขออนุมัติไปราชการ'|| $page_title=='ขออนุมัติจัดอบรมฯ'|| $page_title=='ตรวจแผนไปราชการ'){
			    echo "class='active open'";
			}else{
				echo "class=''" ; } 
		    ?>>
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-briefcase"></i>
                <span class="menu-text">
                    ไปราชการ-จัดประชุม
                </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="<?php echo $page_title  == 'ขออนุมัติไปราชการ' ? 'active' : '' ?>">
                    <a href="<?php echo site_url('plan/trainList/');?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        ขออนุมัติไปราชการ
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="<?php echo $page_title  == 'ขออนุมัติจัดอบรมฯ' ? 'active' : '' ?>">
                    <a href="<?php echo site_url('plan/meetingList/');?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        ขออนุมัติจัดอบรมฯ
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="<?php echo $page_title  == 'ตรวจแผนไปราชการ' ? 'active' : '' ?>">
                    <a href="<?php echo site_url('plan/checkList/');?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        ตรวจแผนไปราชการ
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>


        <li <?php 
			if($page_title=='แผนงาน'|| $page_title=='ผลผลิต'|| $page_title=='กิจกรรม'|| $page_title=='โครงการ'){
			    echo "class='active open'";
			}else{
				echo "class=''" ; } 
		    ?>>
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-tag"></i>
                <span class="menu-text">
                    แผนงานโครงการ
                </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="<?php echo $page_title  == 'แผนงาน' ? 'active' : '' ?>">
                    <a href="<?php echo site_url('project/plan/');?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        แผนงาน
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="<?php echo $page_title  == 'ผลผลิต' ? 'active' : '' ?>">
                    <a href="<?php echo site_url('project/product/');?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        ผลผลิต
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="<?php echo $page_title  == 'กิจกรรม' ? 'active' : '' ?>">
                    <a href="<?php echo site_url('project/activity/');?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        กิจกรรม
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="<?php echo $page_title  == 'โครงการ' ? 'active' : '' ?>">
                    <a href="<?php echo site_url('project/program/');?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        โครงการ
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-list-alt"></i>
                <span class="menu-text"> ข้อมูลการเบิกจ่าย </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="">
                    <a href="profile.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        User Profile
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="inbox.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Inbox
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="pricing.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Pricing Tables
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>
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
                    <a href="<?php echo site_url('meeting/create/');?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        จองห้องประชุม
                    </a>
                    <b class="arrow"></b>
                </li>
                <li class="<?php echo $page_title  == 'ปฏิทินจองห้องประชุม' ? 'active' : '' ?>">
                    <a href="<?php echo site_url('meeting/calendar/');?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        ปฏิทินจองห้องประชุม
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="<?php echo $page_title  == 'รายการจองห้องประชุม' ? 'active' : '' ?>">
                    <a href="<?php echo site_url('meeting/view/');?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        รายการจองห้องประชุม
                    </a>

                    <b class="arrow"></b>
                </li>

            </ul>
        </li>
        <li <?php 
			if($page_title=='รายการของฉัน'|| $page_title=='ยืมครุภัณฑ์'|| $page_title=='รายการขอยืมครุภัณฑ์'){
			    echo "class='active open'";
			}else{
				echo "class=''" ; } 
		    ?>>
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-desktop"></i>
                <span class="menu-text">
                    ระบบยืม-คืนครุภัณฑ์
                </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="<?php echo $page_title  == 'รายการของฉัน' ? 'active' : '' ?>">
                    <a href="<?php echo site_url('products/my_view/');?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        รายการของฉัน
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="<?php echo $page_title  == 'ยืมครุภัณฑ์' ? 'active' : '' ?>">
                    <a href="<?php echo site_url('products/');?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        ยืมครุภัณฑ์
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="<?php echo $page_title  == 'รายการขอยืมครุภัณฑ์' ? 'active' : '' ?>">
                    <a href="<?php echo site_url('products/view/');?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        รายการขอยืมครุภัณฑ์ทั้งหมด
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="<?php echo $page_title  == 'คู่มือการใช้งานระบบครุภัณฑ์' ? 'active' : '' ?>">
                    <a href="<?php echo site_url('assets/uploads/source/file.pdf');?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        คู่มือการใช้งาน
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
        <li <?php 
			if($page_title=='รายการของฉัน'|| $page_title=='เบิกวัสดุ'|| $page_title=='รายการเบิกวัสดุ'){
			    echo "class='active open'";
			}else{
				echo "class=''" ; } 
		    ?>>
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-cube"></i>
                <span class="menu-text">
                    ระบบเบิกวัสดุ
                </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="<?php echo $page_title  == 'รายการของฉัน' ? 'active' : '' ?>">
                    <a href="<?php echo site_url('stock/my_view/');?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        รายการของฉัน
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="<?php echo $page_title  == 'เบิกวัสดุ' ? 'active' : '' ?>">
                    <a href="<?php echo site_url('stock/');?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        เบิกวัสดุ
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="<?php echo $page_title  == 'รายการเบิกวัสดุ' ? 'active' : '' ?>">
                    <a href="<?php echo site_url('stock/view/');?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        รายการเบิกวัสดุทั้งหมด
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="<?php echo $page_title  == 'คู่มือการใช้งาน' ? 'active' : '' ?>">
                    <a href="<?php echo site_url('assets/uploads/source/file.pdf');?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        คู่มือการใช้งาน
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
        <!-- <li <?php 
			if($uriMethod=="random"||$uriMethod=="randomProgress"){
			    echo "class='active open'";
			}else{
				echo "class=''" ; } 
		    ?>>
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-calendar"></i>
                <span class="menu-text">
                Tools
                </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li <?php 
			        if($uriMethod=="random"){
			            echo "class='active'";
			        }else{
				        echo "class=''" ; } 
		        ?>>
                    <a href="<?php echo site_url('tools/random');?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        random
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li> -->
    </ul>

    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state"
            data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
</div>