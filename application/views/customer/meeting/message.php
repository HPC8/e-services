<script>
    setTimeout(function(){location.href="<?php echo site_url('meeting/view/');?>"} , 3000);
</script>
<?php  
    if($this->session->flashdata('alerts')=='1'){
        if($this->session->flashdata('message')){?>
            <a id="confirm_alerts" href="#Alerts" class="trigger-btn" data-toggle="modal"> &nbsp; </a>
        <?php }
    }  
?>

<div id="Alerts" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title smaller red">
                    <i class="ace-icon fa fa-bullhorn"></i>
                    Alerts
                </h3>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <strong>Warning!</strong>
                    <?php echo $this->session->flashdata('message')?>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-sm btn-primary btn-round" href="<?php echo site_url('meeting/view/');?>">
                    <i class="ace-icon fa fa-arrow-circle-left bigger-125"></i>
                    ตกลง
                </a>
            </div>
        </div>
    </div>
</div>