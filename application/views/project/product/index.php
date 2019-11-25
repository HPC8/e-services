<?php
if(!empty($admin_level)){ ?>
<div class="row">
    <div class="col-lg-12">
        <a href="javascript:void(0);" data-toggle="modal" data-target="#add-product"
            class="pull-right btn btn-success btn-xs" style="margin-bottom: 5px;"><i class="fa fa-plus"></i>
            เพิ่มข้อมูล</a>
    </div>
</div>
<?php }
else { ?>
<div class="row">
    <div class="col-lg-12">
        <a href="javascript:void(0);" data-toggle="modal" data-target="#add-product"
            class="pull-right btn btn-success btn-xs disabled" style="margin-bottom: 5px;"><i class="fa fa-plus"></i>
            เพิ่มข้อมูล</a>
    </div>
</div>
<?php }
?>
<td class="row">
<td class="col-xs-12">
    <div class="col-lg-12"><span id="success-msg"></span></div>
    <div class="clearfix">
        <div class="pull-right tableTools-container"></div>
    </div>
    <div class="table-header">
        ตารางรายการผลผลิต
    </div>
<td>
    <table id="tbl-layout-25" class="table table-striped table-bordered table-hover display nowrap" style="width:100%">
        <thead>
            <tr>
                <th width="5%" class="detail-col">No.</th>
                <th width="65%" class="hidden-320">ผลผลิต</th>
                <th width="15%" class="hidden-1024 center">สถานะ</th>
                <th width="15%" class="center">Action</th>
            </tr>
        </thead>
        <tbody id="render-product-details">
            <?php $no=1; foreach ($productInfo as $rs) { ?>
            <tr class="productcls-<?php print $rs->product_id;?>">
                <td class="center">
                    <?php echo $no;?>
                </td>
                <td class="hidden-320"><?php echo $rs->product_name;?></td>
                <td class="hidden-1024 center">
                    <?php
                        if(get_instance()->project_model->moneyProduct($rs->product_id)==0){ ?>
                    <div class="progress"
                        title="<?php echo number_format(get_instance()->project_model->chargeProduct($rs->product_id),2);?>">
                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100" style="width:0%">
                            0%
                        </div>
                    </div>
                    <?php }else { ?>
                    <div class="progress"
                        title="<?php echo number_format(get_instance()->project_model->chargeProduct($rs->product_id),2);?>">
                        <div class="progress-bar progress-bar-striped active" role="progressbar"
                            aria-valuenow="<?php echo number_format((get_instance()->project_model->chargeProduct($rs->product_id)*100)/get_instance()->project_model->moneyProduct($rs->product_id),2);?>"
                            aria-valuemin="0" aria-valuemax="100"
                            style="width:<?php echo number_format((get_instance()->project_model->chargeProduct($rs->product_id)*100)/get_instance()->project_model->moneyProduct($rs->product_id),2);?>%">
                            <?php echo number_format((get_instance()->project_model->chargeProduct($rs->product_id)*100)/get_instance()->project_model->moneyProduct($rs->product_id),2);?>%
                        </div>
                    </div>
                    <?php   }
                    ?>
                </td>
                <td class="center">
                    <div class="hidden-xs btn-group">
                        <?php
                        if(!empty($admin_level)){ ?>
                        <a title="View" href="javascript:void(0);" data-getid="<?php echo $rs->product_id;?>"
                            data-toggle="modal" data-target="#view-product"
                            class="view-product btn btn-primary btn-xs"><i class="fa fa-eye"></i> </a>
                        <a title="Edit" href="javascript:void(0);" data-getid="<?php echo $rs->product_id;?>"
                            data-toggle="modal" data-target="#update-product"
                            class="update-product-details btn btn-success btn-xs"><i class="fa fa-edit"></i> </a>
                        <a title="Delete" href="javascript:void(0);" data-getid="<?php echo $rs->product_id;?>"
                            data-toggle="modal" data-target="#delete-product"
                            class="delete-product-details btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                        <?php
                            }
                        else { ?>
                        <a title="View" href="javascript:void(0);" data-getid="<?php echo $rs->product_id;?>"
                            data-toggle="modal" data-target="#view-product"
                            class="view-product btn btn-primary btn-xs"><i class="fa fa-eye"></i> </a>
                        <a title="Edit" href="javascript:void(0);" data-getid="<?php echo $rs->product_id;?>"
                            data-toggle="modal" data-target="#update-product"
                            class="update-product-details btn btn-success btn-xs disabled"><i class="fa fa-edit"></i>
                        </a>
                        <a title="Delete" href="javascript:void(0);" data-getid="<?php echo $rs->product_id;?>"
                            data-toggle="modal" data-target="#delete-product"
                            class="delete-product-details btn btn-danger btn-xs disabled"><i
                                class="fa fa-trash"></i></a>
                        <?php   }
                        ?>

                    </div>

                    <div class="hidden-sm hidden-md hidden-lg">
                        <div class="inline pos-rel">
                            <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown"
                                data-position="auto">
                                <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                            </button>
                            <ul
                                class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                <?php
                                if(!empty($admin_level)){ ?>
                                <li>
                                    <a title="View" href="javascript:void(0);"
                                        data-getid="<?php echo $rs->product_id;?>" data-toggle="modal"
                                        data-target="#view-product" class="view-product btn btn-primary btn-xs"><i
                                            class="fa fa-eye"></i> </a>
                                </li>
                                <li>
                                    <a title="Edit" href="javascript:void(0);"
                                        data-getid="<?php echo $rs->product_id;?>" data-toggle="modal"
                                        data-target="#update-product"
                                        class="update-product-details btn btn-success btn-xs"><i class="fa fa-edit"></i>
                                    </a>
                                </li>
                                <li>
                                    <a title="Delete" href="javascript:void(0);"
                                        data-getid="<?php echo $rs->product_id;?>" data-toggle="modal"
                                        data-target="#delete-product"
                                        class="delete-product-details btn btn-danger btn-xs"><i
                                            class="fa fa-trash"></i></a>
                                </li>
                                <?php }
                                else { ?>
                                <li>
                                    <a title="View" href="javascript:void(0);"
                                        data-getid="<?php echo $rs->product_id;?>" data-toggle="modal"
                                        data-target="#view-product" class="view-product btn btn-primary btn-xs"><i
                                            class="fa fa-eye"></i> </a>
                                </li>
                                <li>
                                    <a title="Edit" href="javascript:void(0);"
                                        data-getid="<?php echo $rs->product_id;?>" data-toggle="modal"
                                        data-target="#update-product"
                                        class="update-product-details btn btn-success btn-xs disabled"><i class="fa fa-edit"></i>
                                    </a>
                                </li>
                                <li>
                                    <a title="Delete" href="javascript:void(0);"
                                        data-getid="<?php echo $rs->product_id;?>" data-toggle="modal"
                                        data-target="#delete-product"
                                        class="delete-product-details btn btn-danger btn-xs disabled"><i
                                            class="fa fa-trash"></i></a>
                                </li>
                                <?php   }
                                ?>

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
$this->load->view('project/product/popup/create');
$this->load->view('project/product/popup/view');
$this->load->view('project/product/popup/edit');
$this->load->view('project/product/popup/delete');
?>