<?php
    $totall=0;
    $charge=0;
    $sum=0;
?>
<div class="row">
    <div class="col-md-3">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6"><i class="fa fa-university fa-5x"></i></div>
                    <div class="col-xs-6 text-right">
                        <p class="announcement-heading"><label><strong>งบประมาณ</strong></label></p>
                        <p class="announcement-text"><strong><?php
                                foreach($activityInfo as $key=>$value) {
                                    $totall+=$value->activity_money;
                                }
                                echo number_format($totall,2);
                            ?></strong></p>
                    </div>
                </div>
            </div><a href="#">
                <div class="panel-footer announcement-bottom">
                    <div class="row">
                        <div class="col-xs-6">Details </div>
                        <div class="col-xs-6 text-right"><i class="fa fa-arrow-circle-right"></i></div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6"><i class="fa fa-bar-chart fa-5x"></i></div>
                    <div class="col-xs-6 text-right">
                        <p class="announcement-heading"><label><strong>ใช้ไปแล้ว</strong></label></p>
                        <p class="announcement-text"><strong><?php
                                foreach($activityInfo as $key=>$value) {
                                    $charge+=$value->activity_charge;
                                }
                                echo number_format($charge,2);
                            ?></strong></p>
                    </div>
                </div>
            </div><a href="#">
                <div class="panel-footer announcement-bottom">
                    <div class="row">
                        <div class="col-xs-6">Details </div>
                        <div class="col-xs-6 text-right"><i class="fa fa-arrow-circle-right"></i></div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6"><i class="fa fa-refresh fa-5x"></i></div>
                    <div class="col-xs-6 text-right">
                        <p class="announcement-heading"><label><strong>คงเหลือ</strong></label></p>
                        <p class="announcement-text">
                            <strong><?php echo number_format($sum = $totall-$charge,2);?></strong></p>
                    </div>
                </div>
            </div><a href="#">
                <div class="panel-footer announcement-bottom">
                    <div class="row">
                        <div class="col-xs-6">Details </div>
                        <div class="col-xs-6 text-right"><i class="fa fa-arrow-circle-right"></i></div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6"><i class="fa fa-percent fa-5x"></i></div>
                    <div class="col-xs-6 text-right">
                        <p class="announcement-heading"><label><strong>อัตราร้อยละ %</strong></label></p>
                        <p class="announcement-text">
                            <strong><?php echo number_format($percent=($charge*100)/$totall, 2);?></strong></p>
                    </div>
                </div>
            </div><a href="#">
                <div class="panel-footer announcement-bottom">
                    <div class="row">
                        <div class="col-xs-6">Details </div>
                        <div class="col-xs-6 text-right"><i class="fa fa-arrow-circle-right"></i></div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
</div><a title="View" href="javascript:void(0);" id="view-welcome-auto" data-geteid="" data-toggle="modal"
    data-target="#view-welcome"></a><?php $this->load->view('popup');
?>