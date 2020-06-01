<div class="modal fade rotate" id="delete-meeting" style="display:none;">
    <div class="modal-dialog modal-sm">
        <form id="delete-meeting-form" method="post">
            <div class="modal-content panel panel-warning">
                <div class="modal-header panel-heading">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title -remove-title"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete Confirmation</h4>
                </div>
                <div class="modal-body panel-body">
                    <div class="row">
                        <div class="col-sm-12" style="min-height:50px;">
                            <span>คุณแน่ใจหรือไม่ว่าต้องการยกเลิกข้อมูลนี้ ?</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer panel-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-sm btn-success btn-round" data-deleteid=""
                                id="delete-meeting-id"><i class="ace-icon fa fa-check-square-o bigger-125"></i>ตกลง</button>
                            <button type="button" class="btn btn-sm btn-danger btn-round" data-dismiss="modal"><i
                                    class="ace-icon fa fa-times bigger-125"></i>ยกเลิก</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>