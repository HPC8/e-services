<!DOCTYPE html>
<html>

<head>
    <title>Stock Paper</title>
    <!-- <link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet"> -->
    <style>
        body {
            font-family: thsarabanit;
            font-size: 14pt;
            text-align: justify;
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
            text-align: left;
            padding: 1px;
        }

        table#t02 td,
        th {
            border: 1px solid #000000;
            text-align: left;
            padding: 1px;
        }

        /* tr:nth-child(even) {
            background-color: #dddddd;
        } */

        .dottedUnderline {
            border-bottom: 1px dotted;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <td align="right">ใบเบิกเลขที่ <?php echo $orderInfo[0]->order_doc;?></td>
        </tr>
    </table>
    <H3 align="center">ใบเบิกพัสดุ<br>ศูนย์อนามัยที่ 8 อุดรธานี </H3>
    <div style="font-size:14px; position:absolute;  left:473px; top:163px;">
        ..................................................................................................................
    </div>
    <div style="font-size:14px; position:absolute;  left:158px; top:188px;">
        ....................................................................................................................
    </div>
    <div style="font-size:14px; position:absolute;  left:473px; top:188px;">
        ..................................................................................................................
    </div>
    <div style="font-size:14px; position:absolute;  left:138px; top:214px;">
        .............................................................................................................................
    </div>
    <div style="font-size:14px; position:absolute;  left:473px; top:214px;">
        ..................................................................................................................
    </div>
    <div style="font-size:14px; position:absolute;  left:336px; top:239px;">
        ...............................................................................................................................................................................
    </div>
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
            <td colspan="2"><B>มีความประสงค์จะขอเบิกสิ่งของต่าง ๆ เพื่อ</B> <?php echo $orderInfo[0]->description;?> ดังมีรายการต่อไปนี้ </td>
        </tr>
    </table>
    <br>
    <table id="t02">
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
        </tbody>
    </table>
    <br>
    <table>
        <tr>
            <td align="center">รวมทั้งสิ้น <?php echo $no-1;?> รายการ </td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td width="15%"></td>
            <td width="10%"></td>
            <td width="10%"></td>
            <td width="10%"></td>
            <td width="5%"></td>
            <td width="15%"></td>
            <td width="10%"></td>
            <td width="10%"></td>
            <td width="10%"></td>
            <td width="5%"></td>
        </tr>
        <tr>
            <td width="25%" colspan="2"></td>
            <td width="10%"></td>
            <td width="10%"></td>
            <td width="5%"></td>
            <td width="45%" height="50" colspan="4" valign="bottom">
                <img src="<?php echo site_url('stock/mergeImag/'.$orderInfo[0]->hospcode.'/1')?>"
                    style="max-height:47px;height:100%" />
            </td>
            <td width="5%"></td>
        </tr>
        <tr>
            <td width="45%" colspan="4">ได้รับของจากแผนกพัสดุแล้ว</td>
            <td width="5%"></td>
            <td width="35%" align="center" colspan="3">(
                <?php echo $userOrder->titlename.$userOrder->firstname.' '.$userOrder->lastname;?> )</td>
            <td width="10%"></td>
            <td width="5%"></td>
        </tr>
        <tr>
            <td width="45%" height="50" colspan="4" valign="bottom">
                <?php
                    if(!empty(trim($orderInfo[0]->receive_id))) { ?>
                <img src="<?php echo site_url('stock/mergeImag/'.$orderInfo[0]->receive_id.'/4')?>"
                    style="max-height:47px;height:100%" />
                <?php   }
                else{ ?>
                <img src="<?php echo site_url('/assets/uploads/stock/paper/text-4.jpg')?>"
                    style="max-height:47px;height:100%" />
                <?php 
                    }
                 ?>
            </td>
            <td width="5%"></td>
            <td width="45%" height="50" colspan="4" valign="bottom">
                <?php
                    if(!empty(trim($orderInfo[0]->approve_id))) { ?>
                <img src="<?php echo site_url('stock/mergeImag/'.$orderInfo[0]->approve_id.'/2')?>"
                    style="max-height:47px;height:100%" />
                <?php   }
                else{ ?>
                <img src="<?php echo site_url('/assets/uploads/stock/paper/text-2.jpg')?>"
                    style="max-height:47px;height:100%" />
                <?php 
                    }
                 ?>
            <td width="5%"></td>
        </tr>
        <tr>
            <td width="35%" align="center" colspan="3">(
                <?php echo get_instance()->user_model->getUsername($orderInfo[0]->receive_id); ?> )</td>
            <td width="10%"></td>
            <td width="5%"></td>
            <td width="35%" align="center" colspan="3">(
                <?php echo get_instance()->user_model->getUsername($orderInfo[0]->approve_id); ?> )</td>
            <td width="10%"></td>
            <td width="5%"></td>
        </tr>
        <tr>
            <td width="45%" height="50" colspan="4" valign="bottom">
                <?php
                    if(!empty(trim($orderInfo[0]->send_id))) { ?>
                <img src="<?php echo site_url('stock/mergeImag/'.$orderInfo[0]->send_id.'/5')?>"
                    style="max-height:47px;height:100%" />
                <?php   }
                else{ ?>
                <img src="<?php echo site_url('/assets/uploads/stock/paper/text-5.jpg')?>"
                    style="max-height:47px;height:100%" />
                <?php 
                    }
                 ?>
            </td>
            <td width="5%"></td>
            <td width="5%" height="50" colspan="5" valign="bottom">
                <?php
                    if(!empty(trim($orderInfo[0]->supplies_id))) { ?>
                <img src="<?php echo site_url('stock/mergeImag/'.$orderInfo[0]->supplies_id.'/3')?>"
                    style="max-height:47px;height:100%" />
                <?php   }
                else{ ?>
                <img src="<?php echo site_url('/assets/uploads/stock/paper/text-3.jpg')?>"
                    style="max-height:47px;height:100%" />
                <?php 
                    }
                 ?>
            </td>
        </tr>
        <tr>
            <td width="35%" align="center" colspan="3">(
                <?php echo get_instance()->user_model->getUsername($orderInfo[0]->send_id);?> )</td>
            <td width="10%"></td>
            <td width="5%"></td>
            <td width="35%" align="center" colspan="3">(
                <?php echo get_instance()->user_model->getUsername($orderInfo[0]->supplies_id); ?> )</td>
            <td width="10%"></td>
            <td width="5%"></td>
        </tr>

        <tr>
            <td width="45%" colspan="4">ลงหักในบัญชีวัสดุเมื่อ วันที่
                <?= $thaidate->thai_date_fullmonth($orderInfo[0]->send_date);?></td>
            <td width="5%"></td>
            <td width="45%" colspan="4">วันที่
                <?= $thaidate->thai_date_fullmonth($orderInfo[0]->supplies_date);?></td>
            <td width="5%"></td>
        </tr>

    </table>
    <br>
    <div style="font-size:14px; position:absolute;  left:720px; top:1045px;">
        <img src="<?php echo site_url('stock/QRcode/').$orderInfo[0]->id;?>" style="width:48px;height:48px;" />
    </div>
</body>

</html>