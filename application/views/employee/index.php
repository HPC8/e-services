<?php
    if(!empty($admin_level)){
        ?>
<div class="row">
    <div class="col-lg-12">
        <a href="javascript:void(0);" data-toggle="modal" data-target="#add-emp" class="btn btn-success btn-xs"
            style="margin-bottom: 5px;"><i class="fa fa-plus"></i>
            เพิ่มข้อมูล</a>
        <a href="<?php echo site_url('employee/export/');?>" class="btn btn-primary btn-xs"
            style="margin-bottom: 5px;"><i class="fa fa-file-excel-o"></i>
            Export</a>
    </div>
</div>
<?php
    }
    else { ?>
<a href="<?php echo site_url('employee/export2/');?>" class="btn btn-primary btn-xs" style="margin-bottom: 5px;"><i
        class="fa fa-file-excel-o"></i>
    Export</a>
<?php   }
?>

<div class="row">
    <div class="col-sm-6">
        <div class="widget-box transparent">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title lighter">
                    <i class="ace-icon fa fa-star orange"></i>
                    จำนวนบุคลากร
                </h4>

                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main no-padding">
                    <table class="table table-bordered table-striped">
                        <th class="thin-border-bottom">
                            <tr>
                                <th>
                                    ประเภทบุคลากร
                                </th>
                                <th class="center">
                                    จำนวน
                                </th>
                            </tr>
                        </th>
                        <tbody>
                            <?php foreach ($Category as $rs) { ?>
                            <tr>
                                <td><i class="fa fa-chevron-right blue" aria-hidden="true"> </i>
                                    <a
                                        href="<?php echo site_url('employee/category/').$rs->category_id;?>"><?php echo $rs->category_name; ?></a>
                                </td>
                                <td class="center">
                                    <b
                                        class="blue"><?php echo get_instance()->employee_model->countEmp($rs->category_id); ?></b>
                                </td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td><i class="fa fa-chevron-right blue" aria-hidden="true"> </i>
                                    <a href="<?php echo site_url('employee/amount/');?>">บุคลากรทั้งหมด</a>
                                </td>
                                <td class="center">
                                    <b
                                        class="green"><?php echo get_instance()->employee_model->countEmp($All=''); ?></b>
                                </td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-chevron-right blue" aria-hidden="true"> </i>
                                    <a href="<?php echo site_url('employee/discard/');?>">บุคลากรที่จำหน่าย</a></td>
                                <td class="center">
                                    <b class="red"><?php echo get_instance()->employee_model->countEmp($All=0); ?></b>
                                </td>
                            </tr>
                        </tbody>
                        <footer>
                            <tr>
                            </tr>
                        </footer>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="widget-box transparent">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title lighter">
                    <i class="ace-icon fa fa-star orange"></i>
                    สรุปข้อมูลบุคลากร
                </h4>

                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main no-padding">
                    <div id="pie_emp" class="chart"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php  
    if($this->session->userdata('msg')=='1'){ {?>
<a title="View" href="javascript:void(0);" id="view-alerts-auto" data-geteid="" data-toggle="modal"
    data-target="#view-alerts"></a>
<?php }
    }elseif($this->session->userdata('msg')=='0'){?>
<a title="View" href="javascript:void(0);" id="view-success-auto" data-geteid="" data-toggle="modal"
    data-target="#view-success"></a>
<?php }
?>

<?php
    $this->load->view('employee/alerts');
    $this->load->view('employee/popup/create');
?>