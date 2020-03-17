<?php
if(!empty($adminLevel)){ ?>
<div class="row">
    <div class="col-lg-12">
        <a href="javascript:void(0);" data-toggle="modal" data-target="#add-stock"
            class="pull-right btn btn-success btn-xs" style="margin-bottom: 5px;"><i class="fa fa-plus"></i>
            เพิ่มข้อมูล</a>
    </div>
</div>
<?php }
else { ?>
<div class="row">
    <div class="col-lg-12">
        <a href="javascript:void(0);" data-toggle="modal" data-target="#add-stock"
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
        ตารางรายการวัสดุ
    </div>
<td>
    <table id="tbl-layout-25" class="table table-striped table-bordered table-hover display nowrap" style="width:100%">
        <thead>
            <tr>
                <th width="5%" class="detail-col">No.</th>
                <th width="10%" class="center ">รูปภาพ</th>
                <th width="45%" class="center hidden-1024">ชื่อรายการพัสดุ</th>
                <th width="10%" class="center hidden-1024">หมวด</th>
                <th width="10%" class="center hidden-1024">ประเภท</th>
                <th width="10%" class="center hidden-768">คงเหลือ</th>
                <th width="10%" class="center">Option</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; if(!empty($stock)){ foreach($stock as $row){ ?>
            <tr>
                <td class="center">
                    <?php echo $no;?>
                </td>
                <td class="center">
                    <img data-toggle="modal" data-target="#icon<?php echo $row->id;?>"
                        src="<?php echo base_url($row->path.$row->image); ?>" title="<?php echo $row->name;?>"
                        width="32" height="32" />
                </td>
                <td class="hidden-1024"><?php echo $row->name;?></td>
                <td class="hidden-768 center"><?php echo get_instance()->stock_model->returnGroup($row->group);?></td>
                <td class="hidden-768 center"><?php echo get_instance()->stock_model->returnCategory($row->category);?>
                </td>
                <td class="hidden-768 center"><?php echo $row->quantity;?></td>
                <td class="center">
                    <div class="hidden-xs btn-group">
                        <a title="View" href="javascript:void(0);" data-getid="<?php echo $row->id;?>"
                            data-toggle="modal" data-target="#view-stock" class="view-stock btn btn-primary btn-xs"><i
                                class="fa fa-eye"></i> </a>
                        <a title="Edit" href="javascript:void(0);" data-getid="<?php echo $row->id;?>"
                            data-toggle="modal" data-target="#update-stock"
                            class="update-stock-details btn btn-success btn-xs"><i class="fa fa-edit"></i> </a>
                        <a title="Cancel" href="javascript:void(0);" data-getid="<?php echo $row->id;?>"
                            data-toggle="modal" data-target="#delete-stock"
                            class="delete-stock-details btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
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
                                    <a title="View" href="javascript:void(0);" data-getid="<?php echo $row->id;?>"
                                        data-toggle="modal" data-target="#view-stock"
                                        class="view-stock btn btn-primary btn-xs"><i class="fa fa-eye"></i> </a>
                                </li>

                                <li>
                                    <a title="Edit" href="javascript:void(0);" data-getid="<?php echo $row->id;?>"
                                        data-toggle="modal" data-target="#update-stock"
                                        class="update-stock-details btn btn-success btn-xs"><i class="fa fa-edit"></i>
                                    </a>
                                </li>

                                <li>
                                    <a title="Cancel" href="javascript:void(0);" data-getid="<?php echo $row->id;?>"
                                        data-toggle="modal" data-target="#delete-stock"
                                        class="delete-stock-details btn btn-danger btn-xs"><i
                                            class="fa fa-trash"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </td>
                <div id="icon<?php echo $row->id;?>" class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <img id="icon" class="editable img-responsive" alt="icon"
                                    src="<?php echo base_url()?>assets/uploads/source/stock/<?php echo $row->image;?>" />
                            </div>
                        </div>
                    </div>
                </div>
            </tr>
            <?php  $no++; } }else{ ?>
            <p>Product(s) not found...</p>
            <?php } ?>
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
    $this->load->view('stock/alerts');
    $this->load->view('stock/popup/setting/create');
    $this->load->view('stock/popup/setting/view');
    $this->load->view('stock/popup/setting/edit');
    $this->load->view('stock/popup/setting/delete');
?>