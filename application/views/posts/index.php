<div class="row">
    <div class="col-lg-12">
        <a href="javascript:void(0);" data-toggle="modal" data-target="#add-post"
            class="pull-right btn btn-success btn-xs" style="margin-bottom: 5px;"><i class="fa fa-plus"></i>
            เพิ่มข้อมูล</a>
    </div>
</div><!-- /.row -->
<td class="row">
<td class="col-xs-12">
    <div class="col-lg-12"><span id="success-msg"></span></div>
    <div class="clearfix">
        <div class="pull-right tableTools-container"></div>
    </div>
    <div class="table-header">
        ตารางรายการข่าวประชาสัมพันธ์
    </div>
<td>
    <table id="tbl-layout-25" class="table table-striped table-bordered table-hover display nowrap" style="width:100%">
        <thead>
            <tr>
                <th width="5%" class="detail-col">No.</th>
                <th width="20%" class="hidden-320">Title</th>
                <th width="50%" class="hidden-320 ">Content</th>
                <th width="10%" class="center hidden-1024">Date</th>
                <th width="15%" class="center">Action</th>
            </tr>
        </thead>
        <tbody id="render-post-details">
            <?php $no=1; foreach ($postInfo as $rs) { ?>
            <tr class="postcls-<?php print $rs->id;?>">
                <td class="center">
                    <?php echo $no;?>
                </td>
                <td class="hidden-320"><?php echo $rs->title_name;?></td>
                <td class="hidden-320">
                    <?php echo $rs->content;?>
                </td>
                <td class="hidden-1024 center">
                    <?php echo $rs->created;?>
                </td>
                <td class="center">
                    <div class="hidden-xs btn-group">
                        <a title="View" href="javascript:void(0);" data-geteid="<?php echo $rs->id;?>"
                            data-toggle="modal" data-target="#view-post" class="view-post btn btn-primary btn-xs"><i
                                class="fa fa-eye"></i> </a>
                        <a title="Edit" href="javascript:void(0);" data-getueid="<?php echo $rs->id;?>"
                            data-toggle="modal" data-target="#update-post"
                            class="update-post-details btn btn-success btn-xs"><i class="fa fa-edit"></i> </a>
                        <a title="Delete" href="javascript:void(0);" data-getdeid="<?php echo $rs->id;?>"
                            data-toggle="modal" data-target="#delete-post"
                            class="delete-post-details btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
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
                                    <a title="View" href="javascript:void(0);" data-geteid="<?php echo $rs->id;?>"
                                        data-toggle="modal" data-target="#view-post"
                                        class="view-post btn btn-primary btn-xs"><i class="fa fa-eye"></i> </a>
                                </li>
                                <li>
                                    <a title="Edit" href="javascript:void(0);" data-getueid="<?php echo $rs->id;?>"
                                        data-toggle="modal" data-target="#update-post"
                                        class="update-post-details btn btn-success btn-xs"><i class="fa fa-edit"></i>
                                    </a>
                                </li>
                                <li>
                                    <a title="Delete" href="javascript:void(0);" data-getdeid="<?php echo $rs->id;?>"
                                        data-toggle="modal" data-target="#delete-post"
                                        class="delete-post-details btn btn-danger btn-xs"><i
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
$this->load->view('posts/popup/create');
?>