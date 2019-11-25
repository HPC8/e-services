<div class="row">
    <div class="col-xs-12">
        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        <div class="table-header">
            ตารางรายชื่อบุคลากรที่จำหน่าย
        </div>
        <div>
            <table id="tbl-layout-25" class="table table-striped table-bordered table-hover display nowrap"
                style="width:100%">
                <thead>
                    <tr>
                        <th class="center">ลำดับ</th>
                        <th class="center">รหัสประจำตัว</th>
                        <th>ชื่อ-สกุล</th>
                        <th class="hidden-480">ตำแหน่ง</th>
                        <th class="hidden-480">กลุ่ม</th>
                        <th width="15%" class="center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach ($discard as $rs) { ?>
                    <tr>
                        <td class="center">
                            <?php echo  $no;?>
                        </td>
                        <td class="center">
                            <?php echo $rs->hospcode;?>
                        </td>
                        <td><?php echo $rs->titlename.$rs->firstname.' '.$rs->lastname;?></td>
                        <td class="hidden-480"><?php echo $rs->position_name.$rs->level_name;?></td>
                        <td class="hidden-480">
                            <?php echo $rs->department_name;?>
                        </td>
                        <td class="center">
                            <div class="hidden-xs btn-group">
                                <a title="View" href="javascript:void(0);" data-getcode="<?php echo $rs->hospcode;?>"
                                    data-toggle="modal" data-target="#view-emp"
                                    class="view-emp btn btn-primary btn-xs"><i class="fa fa-eye"></i> </a>
                                <a title="Edit" href="javascript:void(0);" data-getcode="<?php echo $rs->hospcode;?>"
                                    data-toggle="modal" data-target="#update-emp"
                                    class="update-emp-details btn btn-success btn-xs"><i class="fa fa-edit"></i> </a>
                                <a title="Delete" href="javascript:void(0);" data-getdeid="<?php echo $rs->hospcode;?>"
                                    data-toggle="modal" data-target="#delete-emp"
                                    class="delete-emp-details btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                            </div>

                            <div class="hidden-sm hidden-md hidden-lg">
                                <div class="inline pos-rel">
                                    <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown"
                                        data-position="auto">
                                        <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                    </button>
                                    <ul
                                        class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                        <li>
                                            <a title="View" href="javascript:void(0);"
                                                data-getcode="<?php echo $rs->hospcode;?>" data-toggle="modal"
                                                data-target="#view-emp" class="view-emp btn btn-primary btn-xs"><i
                                                    class="fa fa-eye"></i> </a>
                                        </li>
                                        <li>
                                            <a title="Edit" href="javascript:void(0);"
                                                data-getcode="<?php echo $rs->hospcode;?>" data-toggle="modal"
                                                data-target="#update-emp"
                                                class="update-emp-details btn btn-success btn-xs"><i
                                                    class="fa fa-edit"></i> </a>
                                        </li>
                                        <li>
                                            <a title="Delete" href="javascript:void(0);"
                                                data-getdeid="<?php echo $rs->hospcode;?>" data-toggle="modal"
                                                data-target="#delete-emp"
                                                class="delete-emp-details btn btn-danger btn-xs"><i
                                                    class="fa fa-trash"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php $no++;} ?>
                </tbody>
            </table>
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
    $this->load->view('employee/popup/view');
    $this->load->view('employee/popup/edit');
?>