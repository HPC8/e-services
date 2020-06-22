<td class="row">
<td class="col-xs-12">
    <div class="clearfix">
        <div class="pull-right tableTools-container"></div>
    </div>
    <div class="table-header">
        ตารางรายการจองห้องประชุมทั้งหมด
    </div>
<td>
    <table id="tbl-layout-10" class="table table-striped table-bordered table-hover display nowrap" style="width:100%">
        <thead>
            <tr>
                <th width="5%" class="detail-col">No.</th>
                <th width="10%" class="center ">เลขที่เอกสาร</th>
                <th width="15%" class="hidden-1024">ชื่อ-นามสกุล</th>
                <th width="32%" class="hidden-768">เรื่อง/เหตุผล</th>
                <th width="13%" class="hidden-480 center">
                    <i class="ace-icon fa fa-clock-o bigger-110 hidden-768"></i>
                    วันที่ใช้งาน
                </th>
                <th width="13%" class="center">สถานะ</th>
                <th width="12%" class="center">Option</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach ($query as $rs) { ?>
            <tr>
                <td class="center">
                    <?php echo $no;?>
                </td>
                <td class="center">
                    <a title="View" href="javascript:void(0);" data-getid="<?php echo $rs->id;?>" data-toggle="modal"
                        data-target="#view-meeting" class="view-meeting"><?php echo $rs->meeting_doc;?> </a>
                </td>
               
                <td class="hidden-1024"> <?php
                    if($rs->hospcode !=""){
                        echo get_instance()->user_model->getUsername($rs->hospcode);
                    }else{
                        echo get_instance()->user_model->getCustomerName($rs->id);
                    }
                ?></td>
                <td class="hidden-768"><?php echo $rs->detail;?></td>
                <td class="hidden-480 center"><?= $mydate->ThaiLong($rs->book_start);?></td>
                <td class="center"><?php echo get_instance()->meeting_model->checkStatus($rs->meeting_status);?></td>
                <td class="center">
                    <div class="hidden-xs btn-group">

                        <a title="View" href="javascript:void(0);" data-getid="<?php echo $rs->id;?>"
                            data-toggle="modal" data-target="#view-meeting"
                            class="view-meeting btn btn-primary btn-xs"><i class="fa fa-eye"></i> </a>

                        <a title="Edit" href="javascript:void(0);" data-getid="<?php echo $rs->id;?>"
                            data-toggle="modal" data-target="#edit-meeting-book"
                            class="edit-meeting-book-details btn btn-success btn-xs"><i class="fa fa-edit"></i> </a>

                        <a title="Cancel" href="javascript:void(0);" data-getid="<?php echo $rs->id;?>"
                            data-toggle="modal" data-target="#delete-meeting"
                            class="delete-meeting-details btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
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
                                    <a title="View" href="javascript:void(0);" data-getid="<?php echo $rs->id;?>"
                                        data-toggle="modal" data-target="#view-meeting"
                                        class="view-meeting btn btn-primary btn-xs"><i class="fa fa-eye"></i> </a>
                                </li>
                                <li>
                                    <a title="Edit" href="javascript:void(0);" data-getid="<?php echo $rs->id;?>"
                                        data-toggle="modal" data-target="#edit-meeting-book"
                                        class="edit-meeting-book-details btn btn-success btn-xs"><i
                                            class="fa fa-edit"></i> </a>
                                </li>
                                <li>
                                    <a title="Cancel" href="javascript:void(0);" data-getid="<?php echo $rs->id;?>"
                                        data-toggle="modal" data-target="#delete-meeting"
                                        class="delete-meeting-details btn btn-danger btn-xs"><i
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
</td>
</td>
</td>
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
    $this->load->view('meeting/alerts');
    $this->load->view('meeting/popup/view');
    $this->load->view('meeting/popup/edit');
    $this->load->view('meeting/popup/delete');
?>