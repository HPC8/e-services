<div class="row">
    <div class="col-sm-12">
        <h3 class="header smaller lighter orange">
            <i class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i>
            สถานะการใช้งาน
            <?php $no=1; foreach ($getUpoint as $user) 
                if($user->point>0){
                    $status = '<span class="badge badge-success"><i class="fa fa-check"> มีสิทธิ์</i></span>';
                }
                else {
                    $status = '<span class="badge badge-danger"><i class="fa fa-times"> ไม่มีสิทธิ์</i></span>';
                }
            { ?>
            <?php echo $status; ?>
            <span class="badge badge-grey"> คะแนนคงเหลือ <?php echo $user->point; ?> Point </span>
            <span class="badge badge-grey"> อัพเดทล่าสุด
                <?= $thaidate->thai_date_and_time($user->modified);?> </span>
            <?php $no++;} ?>
        </h3>
    </div>
</div>
<td class="row">
<td class="col-xs-12">
    <div class="clearfix">
        <div class="pull-right tableTools-container"></div>
    </div>
    <div class="table-header">
        ตารางรายการขอยืมครุภัณฑ์ของฉัน
    </div>
<td>
    <table id="tbl-layout-25" class="table table-striped table-bordered table-hover display nowrap" style="width:100%">
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
                    <a title="View" href="javascript:void(0);" data-getcode="<?php echo $rs->id;?>" data-toggle="modal"
                        data-target="#view-product" class="view-product"><?php echo $rs->order_doc;?> </a>
                </td>
                <td class="hidden-1024"><?php echo get_instance()->user_model->getUsername($rs->hospcode);?></td>
                <td class="hidden-768"><?php echo mb_substr($rs->description,0,100, "UTF-8");?></td>
                <td class="hidden-480 center"><?= $thaidate->thai_date_short($rs->start_date);?></td>
                <td class="center"><?php echo get_instance()->product_model->checkStatus($rs->status);?></td>
                <td class="center">
                    <div class="hidden-xs btn-group">
                        <a title="Print" href="<?php echo site_url('products/paper/'.$rs->id);?>" target="_blank"
                            class="view-products-order btn btn-xs"><i class="fa fa-print"></i>
                        </a>
                        <a title="View" href="javascript:void(0);" data-getcode="<?php echo $rs->id;?>"
                            data-toggle="modal" data-target="#view-products"
                            class="view-products btn btn-primary btn-xs"><i class="fa fa-eye"></i> </a>
                        <a title="Edit" href="javascript:void(0);" data-getcode="<?php echo $rs->id;?>"
                            data-toggle="modal" data-target="#update-products"
                            class="update-products-details btn btn-success btn-xs"><i class="fa fa-cog"></i> </a>
                        <a title="Cancel" href="javascript:void(0);" data-getid="<?php echo $rs->id;?>"
                            data-toggle="modal" data-target="#delete-products"
                            class="delete-products-details btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                    </div>

                    <div class="hidden-sm hidden-md hidden-lg">
                        <div class="inline pos-rel">
                            <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown"
                                data-position="auto">
                                <i class="fa fa-folder-open" aria-hidden="true"></i>
                            </button>
                            <ul
                                class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                <li>
                                    <a title="Print" href="<?php echo site_url('products/paper/'.$rs->id);?>"
                                        target="_blank" class="view-products-order btn btn-xs"><i
                                            class="fa fa-print"></i>
                                    </a>
                                </li>
                                <li>
                                    <a title="View" href="javascript:void(0);" data-getcode="<?php echo $rs->id;?>"
                                        data-toggle="modal" data-target="#view-products"
                                        class="view-products btn btn-primary btn-xs"><i class="fa fa-eye"></i> </a>
                                </li>

                                <li>
                                    <a title="Edit" href="javascript:void(0);" data-getcode="<?php echo $rs->id;?>"
                                        data-toggle="modal" data-target="#update-products"
                                        class="update-products-details btn btn-success btn-xs"><i
                                            class="fa fa-cog"></i> </a>
                                </li>

                                <li>
                                    <a title="Cancel" href="javascript:void(0);" data-getid="<?php echo $rs->id;?>"
                                        data-toggle="modal" data-target="#delete-products"
                                        class="delete-products-details btn btn-danger btn-xs"><i
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
    $this->load->view('products/alerts');
    $this->load->view('products/popup/view');
    $this->load->view('products/popup/edit');
    $this->load->view('products/popup/delete');
?>