<!DOCTYPE html>
<html>

<head>
    <title>ใบเบิกพัสดุเลขที่ <?php echo $orderInfo[0]->order_doc;?></title>
    <link rel="stylesheet" href="<?php echo base_url()?>assets/thsarabunit/style.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/custom/paper.css">
    <style>
        body {
            font-family: 'THSarabunIT';
            font-size: 21px;
            text-align: justify;
        }

        @page {
            size: A4
        }

        .indent {
            text-indent: 70px;
        }

        table {
            width: 100%;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #ffffff;
            /* word-wrap: break-word; */
            /* text-align: justify; */
            /* text-align: left; */
            padding: 1px;
        }

        table#tb2 td,
        th {
            border: 1px solid #000000;
            /* text-align: left; */
            padding: 1px;
        }

        @media print {

            html,
            body {
                width: 210mm;
                height: 296mm;
                background: #fff;

            }

            .page-layout {
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }

            table.report {
                page-break-after: auto
            }

            table.report tr {
                page-break-inside: avoid;
                page-break-after: auto
            }

            table.report td {
                page-break-inside: avoid;
                page-break-after: auto
            }

            table.report thead {
                display: table-header-group;
                margin-top: 50px;
            }

            table.report tfoot {
                display: table-footer-group
            }
        }

        @media print {
            #printButton {
                display: none;
            }

            #closeButton {
                display: none;
            }
        }

        .break-before {
            page-break-before: always;
        }

        .no-break {
            page-break-inside: avoid;

        }
    </style>
    <script>
        function Exit() {
            var x = confirm('คุณต้องการที่จะปิดหน้านี้หรือไม่?');
            if (x) window.close();
        }
    </script>
</head>

<body class="A4">
    <section class="sheet padding-A4">
        <div style="font-size:21px; position:absolute;  left:5px; top:5px;">
            <input title="Print" type="image" id="printButton" onClick="window.print();"
                src="https://apps.anamai.moph.go.th/e-services/assets/uploads/icon/printer.png">
            <input title="Close" type="image" id="closeButton" onClick="Exit()"
                src="https://apps.anamai.moph.go.th/e-services/assets/uploads/icon/close.png">
        </div>
        <div style="font-size:21px; position:absolute;  left:470px; top:140px;">
            ........................................................................................
        </div>
        <div style="font-size:21px; position:absolute;  left:117px; top:167px;">
            ..........................................................................................
        </div>
        <div style="font-size:21px; position:absolute;  left:470px; top:167px;">
        ........................................................................................
        </div>
        <div style="font-size:21px; position:absolute;  left:96px; top:194px;">
        ................................................................................................
        </div>
        <div style="font-size:21px; position:absolute;  left:469px; top:194px;">
            ........................................................................................
        </div>
        <div class="page-layout">
            <table>
                <tr>
                    <td width="10%"></td>
                    <td width="10%"></td>
                    <td width="10%"></td>
                    <td width="10%"></td>
                    <td width="10%"></td>
                    <td width="10%"></td>
                    <td width="10%"></td>
                    <td width="30%" colspan="3" align="right">ใบเบิกเลขที่ <?php echo $orderInfo[0]->order_doc;?></td>
                </tr>
                <tr height="90">
                    <td width="10%"></td>
                    <td width="10%"></td>
                    <td width="10%"></td>
                    <td width="40%" colspan="4" align="center">
                        <h3>ใบเบิกพัสดุ<br>ศูนย์อนามัยที่ 8 อุดรธานี</h3>
                    </td>
                    <td width="10%"></td>
                    <td width="20%" colspan="2" align="right" valign="top"><img
                            src="<?php echo site_url('stock/QRcode/').$orderInfo[0]->id;?>"
                            style="width:56px;height:56px;" /></td>
                </tr>
                <tr>
            </table>
            <table>
                <tr>
                    <td width="50%"></td>
                    <td width="50%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>วันที่</B>
                        <?= $thaidate->thai_date_fullmonth($orderInfo[0]->created);?></td>
                </tr>
                <tr>
                    <td align="left" width="50%"><B>ข้าพเจ้า</B>
                        <?php echo $userOrder->titlename.$userOrder->firstname.' '.$userOrder->lastname;?>
                    </td>
                    <td align="left" width="50%"><B>ตำแหน่ง</B>
                        <?php echo $userOrder->position_name; ?>
                    </td>
                </tr>
                <tr>
                    <td align="left" width="50%"><B>งาน</B>
                        <?php echo $userOrder->section_name; ?>
                    </td>
                    <td align="left" width="50%"><B>กลุ่มงาน</B>
                        <?php echo $userOrder->department_name; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="justify"><B>มีความประสงค์จะขอเบิกสิ่งของต่าง ๆ เพื่อ</B>
                        <?php
                    echo $orderInfo[0]->description.' ดังมีรายการต่อไปนี้';
                    // $segment=$this->thsplitlib->load();
                    // $result = $segment->get_segment_array($orderInfo[0]->description);
                    // echo implode(' ', $result).' ดังมีรายการต่อไปนี้';
                ?>
                    </td>
                </tr>
            </table>
            <br>
            <table id="tb2">
                <thead>
                    <tr>
                        <th width="9%" align="center">ลำดับ</th>
                        <th width="61%" align="center">รายการ</th>
                        <th width="15%" align="center">จำนวน</th>
                        <th width="15%" align="center">หน่วย</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach ($orderItems as $item) { ?>
                    <tr>
                        <td width="9%" align="center">
                            <?php echo $no;?>
                        </td>
                        <td width="61%">&nbsp;<?php echo $item->name; ?></td>
                        <td width="15%" align="center"><?php echo $item->quantity; ?></td>
                        <td width="15%" align="center"><?php echo $item->unit; ?></td>

                    </tr>
                    <?php $no++;} ?>
                    <?php
             for ($col = $no; $col <= 12; $col ++) { ?>
                    <tr>
                        <td width="9%" align="center">
                            <?php echo $col;?>
                        </td>
                        <td width="61%"></td>
                        <td width="15%"></td>
                        <td width="15%"></td>
                    </tr>
                    <?php } 
            ?>
                    <tr>
                        <td width="100%" colspan="4" align="center">รวมทั้งสิ้น <?php echo $no-1;?> รายการ </td>
                    </tr>
                </tbody>
            </table>
            <br>
            <table class="no-break">
                <tr>
                    <td width="5%"></td>
                    <td width="15%"></td>
                    <td width="10%"></td>
                    <td width="10%"></td>
                    <td width="10%"></td>
                    <td width="15%"></td>
                    <td width="10%"></td>
                    <td width="10%"></td>
                    <td width="10%"></td>
                    <td width="5%"></td>
                </tr>
                <tr>
                    <td width="5%"></td>
                    <td width="25%" colspan="2"></td>
                    <td width="10%"></td>
                    <td width="10%"></td>
                    <td width="45%" height="52" colspan="4" valign="bottom">
                        <img src="<?php echo site_url('stock/mergeImag/'.$orderInfo[0]->hospcode.'/1')?>"
                            style="max-height:50px;height:100%" alt="not signature" />
                    </td>
                    <td width="5%"></td>
                </tr>
                <tr>
                    <td width="5%"></td>
                    <td width="45%" colspan="4">ได้รับของจากแผนกพัสดุแล้ว</td>
                    <td width="35%" align="center" colspan="3">(
                        <?php echo $userOrder->titlename.$userOrder->firstname.' '.$userOrder->lastname;?> )</td>
                    <td width="10%"></td>
                    <td width="5%"></td>
                </tr>
                <tr>
                    <td width="5%"></td>
                    <td width="45%" height="52" colspan="4" valign="bottom">
                        <?php
                    if(!empty(trim($orderInfo[0]->receive_id))) { ?>
                        <img src="<?php echo site_url('stock/mergeImag/'.$orderInfo[0]->receive_id.'/4')?>"
                            style="max-height:50px;height:100%" alt="not signature" />
                        <?php   }
                else{ ?>
                        <img src="<?php echo site_url('/assets/uploads/stock/paper/text-4.jpg')?>"
                            style="max-height:50px;height:100%" alt="not signature" />
                        <?php 
                    }
                 ?>
                    </td>
                    <td width="45%" height="52" colspan="4" valign="bottom">
                        <?php
                    if(!empty(trim($orderInfo[0]->approve_id))) { ?>
                        <img src="<?php echo site_url('stock/mergeImag/'.$orderInfo[0]->approve_id.'/2')?>"
                            style="max-height:50px;height:100%" alt="not signature" />
                        <?php   }
                else{ ?>
                        <img src="<?php echo site_url('/assets/uploads/stock/paper/text-2.jpg')?>"
                            style="max-height:50px;height:100%" alt="not signature" />
                        <?php 
                    }
                 ?>
                    <td width="5%"></td>
                </tr>
                <tr>
                    <td width="5%"></td>
                    <td width="35%" align="center" colspan="3">(
                        <?php echo get_instance()->user_model->getUsername($orderInfo[0]->receive_id); ?> )</td>
                    <td width="10%"></td>
                    <td width="35%" align="center" colspan="3">(
                        <?php echo get_instance()->user_model->getUsername($orderInfo[0]->approve_id); ?> )</td>
                    <td width="10%"></td>
                    <td width="5%"></td>
                </tr>
                <tr>
                    <td width="5%"></td>
                    <td width="45%" height="52" colspan="4" valign="bottom">
                        <?php
                    if(!empty(trim($orderInfo[0]->send_id))) { ?>
                        <img src="<?php echo site_url('stock/mergeImag/'.$orderInfo[0]->send_id.'/5')?>"
                            style="max-height:50px;height:100%" />
                        <?php   }
                else{ ?>
                        <img src="<?php echo site_url('/assets/uploads/stock/paper/text-5.jpg')?>"
                            style="max-height:50px;height:100%" />
                        <?php 
                    }
                 ?>
                    </td>
                    <td width="5%" height="52" colspan="5" valign="bottom">
                        <?php
                    if(!empty(trim($orderInfo[0]->supplies_id))) { ?>
                        <img src="<?php echo site_url('stock/mergeImag/'.$orderInfo[0]->supplies_id.'/3')?>"
                            style="max-height:50px;height:100%" />
                        <?php   }
                else{ ?>
                        <img src="<?php echo site_url('/assets/uploads/stock/paper/text-3.jpg')?>"
                            style="max-height:50px;height:100%" />
                        <?php 
                    }
                 ?>
                    </td>
                </tr>
                <tr>
                    <td width="5%"></td>
                    <td width="35%" align="center" colspan="3">(
                        <?php echo get_instance()->user_model->getUsername($orderInfo[0]->send_id);?> )</td>
                    <td width="10%"></td>
                    <td width="35%" align="center" colspan="3">(
                        <?php echo get_instance()->user_model->getUsername($orderInfo[0]->supplies_id); ?> )</td>
                    <td width="10%"></td>
                    <td width="5%"></td>
                </tr>

                <tr>
                    <td width="5%"></td>
                    <td width="45%" colspan="4">ลงหักในบัญชีวัสดุเมื่อ วันที่
                        <?= $thaidate->thai_date_fullmonth($orderInfo[0]->send_date);?></td>
                    <td width="45%" colspan="4">วันที่
                        <?= $thaidate->thai_date_fullmonth($orderInfo[0]->supplies_date);?></td>
                    <td width="5%"></td>
                </tr>
            </table>

        </div>

    </section>
</body>

</html>