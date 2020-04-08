<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Thaidate {

	public function __construct() {
		date_default_timezone_set('Asia/Bangkok');
	}

	function thai_date_and_time($date='') {

		// 1 มกราคม 2562 เวลา 10:10:43
		if($date) {
			if($date=='0000-00-00'){
				return "ไม่ระบุ";
			}
			$strYear=date("Y", strtotime($date))+543;
			$strMonth=date("n", strtotime($date));
			$strDay=date("d", strtotime($date));
			$time=date("H:i", strtotime($date));
			$strMonthCut=Array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");

			switch($strDay) {
				case "01": $strDay="1";
				break;
				case "02": $strDay="2";
				break;
				case "03": $strDay="3";
				break;
				case "04": $strDay="4";
				break;
				case "05": $strDay="5";
				break;
				case "06": $strDay="6";
				break;
				case "07": $strDay="7";
				break;
				case "08": $strDay="8";
				break;
				case "09": $strDay="9";
				break;
			}

			$strMonthThai=$strMonthCut[$strMonth];
			return "$strDay $strMonthThai $strYear เวลา $time น.";
		}

		else {
			return "ไม่ระบุ";
		}
	}

	function thai_date_short($date='') {

		// 1 ม.ค. 2562
		if($date) {
			if($date=='0000-00-00'){
				return "ไม่ระบุ";
			}
			$strYear=date("Y", strtotime($date))+543;
			$strMonth=date("n", strtotime($date));
			$strDay=date("d", strtotime($date));
			$strMonthCut=Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");

			switch($strDay) {
				case "01": $strDay="1";
				break;
				case "02": $strDay="2";
				break;
				case "03": $strDay="3";
				break;
				case "04": $strDay="4";
				break;
				case "05": $strDay="5";
				break;
				case "06": $strDay="6";
				break;
				case "07": $strDay="7";
				break;
				case "08": $strDay="8";
				break;
				case "09": $strDay="9";
				break;
			}

			$strMonthThai=$strMonthCut[$strMonth];
			return "$strDay $strMonthThai $strYear";
		}

		else {
			return "ไม่ระบุ";
		}
	}

	function thai_date_fullmonth($date='') {

		// 19 ธันวาคม 2556
		if($date) {
			if($date=='0000-00-00'){
				return "ไม่ระบุ";
			}
			$strYear=date("Y", strtotime($date))+543;
			$strMonth=date("n", strtotime($date));
			$strDay=date("d", strtotime($date));
			$strMonthCut=Array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");

			switch($strDay) {
				case "01": $strDay="1";
				break;
				case "02": $strDay="2";
				break;
				case "03": $strDay="3";
				break;
				case "04": $strDay="4";
				break;
				case "05": $strDay="5";
				break;
				case "06": $strDay="6";
				break;
				case "07": $strDay="7";
				break;
				case "08": $strDay="8";
				break;
				case "09": $strDay="9";
				break;
			}

			$strMonthThai=$strMonthCut[$strMonth];
			return "$strDay $strMonthThai $strYear";
		}

		else {
			return "ไม่ระบุ";
		}

	}
	function fullmonth_year($date='') {

		// ธันวาคม 2556
		if($date) {
			if($date=='0000-00-00'){
				return "ไม่ระบุ";
			}
			$strYear=date("Y", strtotime($date))+543;
			$strMonth=date("n", strtotime($date));
			$strMonthCut=Array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");

			$strMonthThai=$strMonthCut[$strMonth];
			return "$strMonthThai $strYear";
		}

		else {
			return "ไม่ระบุ";
		}

	}

	function fullmonth($date='') {
		// ธันวาคม
		if($date) {
			if($date=='0000-00-00'){
				return "ไม่ระบุ";
			}
			$strMonth=date("n", strtotime($date));
			$strMonthCut=Array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");

			$strMonthThai=$strMonthCut[$strMonth];

			return "$strMonthThai";
		}

		else {
			return "ไม่ระบุ";
		}

	}

	function cutdate($date) {
		$strDay=date("d", strtotime($date));
		switch($strDay) {
			case "01": $strDay="1";
			break;
			case "02": $strDay="2";
			break;
			case "03": $strDay="3";
			break;
			case "04": $strDay="4";
			break;
			case "05": $strDay="5";
			break;
			case "06": $strDay="6";
			break;
			case "07": $strDay="7";
			break;
			case "08": $strDay="8";
			break;
			case "09": $strDay="9";
			break;
		}
		return "$strDay";
	}

	function birthda($date='') {
		if($date) {
			if($date=='0000-00-00'){
				return "ไม่ระบุ";
			}
			$birthday=$date;
			$today=date("Y-m-d");
			list($byear, $bmonth, $bday)=explode("-", $birthday);
			list($tyear, $tmonth, $tday)=explode("-", $today);
			$mbirthday=mktime(0, 0, 0, $bmonth, $bday, $byear);
			$mnow=mktime(0, 0, 0, $tmonth, $tday, $tyear);
			$mage=($mnow - $mbirthday);
			$u_y=date("Y", $mage)-1970;
			$u_m=date("m", $mage)-1;
			$u_d=date("d", $mage)-1;
			return "$u_y ปี $u_m เดือน $u_d วัน";
		}

		else {
			return "ไม่ระบุ";
		}

	}
	
	// 2563
	function thaiyear($date='') {
		if($date) {
			if($date=='0000-00-00'){
				return "ไม่ระบุ";
			}
			list($Y, $m)=explode('-', $date); // แยกวันเป็น ปี เดือน วัน

			//$Y = $Y+543; // เปลี่ยน ค.ศ. เป็น พ.ศ.
			switch($m) {
				case "01": $Y=$Y+543;
				break;
				case "02": $Y=$Y+543;
				break;
				case "03": $Y=$Y+543;
				break;
				case "04": $Y=$Y+543;
				break;
				case "05": $Y=$Y+543;
				break;
				case "06": $Y=$Y+543;
				break;
				case "07": $Y=$Y+543;
				break;
				case "08": $Y=$Y+543;
				break;
				case "09": $Y=$Y+543;
				break;
				case "10": $Y=$Y+544;
				break;
				case "11": $Y=$Y+544;
				break;
				case "12": $Y=$Y+544;
				break;
			}

			return $Y;
		}

		else {
			return "ไม่ระบุ";
		}

	}

	function duration($begin, $end) {
		$remain=intval(strtotime($end)-strtotime($begin));
		$wan=floor($remain/86400);
		$l_wan=$remain%86400;
		$hour=floor($l_wan/3600);
		$l_hour=$l_wan%3600;
		$minute=floor($l_hour/60);
		$second=$l_hour%60;

		if($minute>0) {
			$wan=$wan+1;
		}

		else {
			$wan=$wan+0;
		}

		//return "ผ่านมาแล้ว ".$wan." วัน ".$hour." ชั่วโมง ".$minute." นาที ".$second." วินาที";
		return $wan;
	}
	
	function fiscal_year($datetime) {
        list($Y,$m) = explode('-',$datetime); // แยกวันเป็น ปี เดือน วัน
        //$Y = $Y+543; // เปลี่ยน ค.ศ. เป็น พ.ศ.
        switch($m) {        
            case "01": $Y = $Y+543; break;	
            case "02": $Y = $Y+543; break;
            case "03": $Y = $Y+543; break;
            case "04": $Y = $Y+543; break;
            case "05": $Y = $Y+543; break;
            case "06": $Y = $Y+543; break;
            case "07": $Y = $Y+543; break;	
            case "08": $Y = $Y+543; break;
            case "09": $Y = $Y+543; break;
            case "10": $Y = $Y+544; break;
            case "11": $Y = $Y+544; break;
            case "12": $Y = $Y+544; break;
        }
        return $Y;
	}



}