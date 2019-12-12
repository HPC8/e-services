<div class="modal fade rotate" id="view-post" style="display:none;">
    <div class="modal-dialog modal-lg">
        <form id="view-post-form" method="post">
            <div class="modal-content panel panel-default">
                <div class="modal-header panel-heading">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title -remove-title"><i class="fa fa-bullhorn" aria-hidden="true"></i>
                        ข่าวประชาสัมพันธ์</h4>
                </div>
                <div class="modal-body panel-body" id="render-view-post">
                    <div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>
                </div>
                <div class="modal-footer panel-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-sm btn btn-round" data-previousid=""
                                id="previous-post-id"><i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                Previous</button>
                            <button type="button" class="btn btn-sm btn-success btn-round" data-nextid=""
                                id="next-post-id">Next <i class="fa fa-angle-double-right"
                                    aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-sm btn-danger btn-round" data-dismiss="modal">
                                <i class="ace-icon fa fa-times bigger-125"></i>Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>