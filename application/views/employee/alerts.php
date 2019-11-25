<div class="modal fade rotate" id="view-alerts" style="display:none;">
    <div class="modal-dialog">
        <form id="view-alerts-form" method="post">
            <div class="modal-content panel panel-default">
                <div class="modal-header panel-heading">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title -remove-title red"><i class="ace-icon fa fa-bullhorn">
                        </i> Alerts
                        <small>

                        </small>
                        </i></h4>
                </div>
                <div class="modal-body panel-body" id="renderalerts">
                    <div class="alert alert-danger">
                        <strong>Warning!</strong>
                        <?php echo $this->session->userdata('detail');$this->session->unset_userdata('msg');?>
                    </div>
                </div>
                <div class="modal-footer panel-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-sm btn-success btn-round" data-dismiss="modal">
                                <i class="ace-icon fa fa-check-square-o bigger-125"></i>ตกลง</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade rotate" id="view-success" style="display:none;">
    <div class="modal-dialog">
        <form id="view-success-form" method="post">
            <div class="modal-content panel panel-default">
                <div class="modal-header panel-heading">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title -remove-title"><i class="ace-icon fa fa-bullhorn">
                        </i> Success
                        <small>

                        </small>
                        </i></h4>
                </div>
                <div class="modal-body panel-body" id="rendersuccess">
                    <div class="alert alert-success">
                        <strong>Success!</strong>
                        <?php echo $this->session->userdata('detail');$this->session->unset_userdata('msg');?>
                    </div>
                </div>
                <div class="modal-footer panel-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-sm btn-success btn-round" data-dismiss="modal">
                                <i class="ace-icon fa fa-check-square-o bigger-125"></i>ตกลง</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade rotate" id="alerts-tabel" style="display:none;">
    <div class="modal-dialog">
        <form id="alerts-tabel-form" method="post">
            <div class="modal-content panel panel-default">
                <div class="modal-header panel-heading">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title -remove-title red"><i class="ace-icon fa fa-bullhorn">
                        </i> Alerts
                        <small>

                        </small>
                        </i></h4>
                </div>
                <div class="modal-body panel-body" id="rendertabel">
                    <div class="alert alert-danger">
                        <strong>Warning!</strong>
                        ไม่พบข้อมูลในตาราง
                    </div>
                </div>
                <div class="modal-footer panel-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-sm btn-success btn-round" data-dismiss="modal">
                                <i class="ace-icon fa fa-check-square-o bigger-125"></i>ตกลง</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>