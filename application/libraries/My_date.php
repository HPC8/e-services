<?php defined('BASEPATH') OR exit('No direct script access allowed');

class My_date {

	public function __construct() {
		date_default_timezone_set('Asia/Bangkok');
	}

	function ThaiLong($strDate, $style=0) {
		$strYear=date("Y", strtotime($strDate))+543;
		$strMonth=date("n", strtotime($strDate));
		$strDay=date("d", strtotime($strDate));
		$strMonthCut=Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
		switch($strDay) {
			case "01": $strDay = "1"; break;
			case "02": $strDay = "2"; break;
			case "03": $strDay = "3"; break;
			case "04": $strDay = "4"; break;
			case "05": $strDay = "5"; break;
			case "06": $strDay = "6"; break;
			case "07": $strDay = "7"; break;
			case "08": $strDay = "8"; break;
			case "09": $strDay = "9"; break;
		} 
		$strMonthThai=$strMonthCut[$strMonth];

		if ($style==0) {
			return "$strDay $strMonthThai $strYear";
		}

		else {
			return "$strMonthThai พ.ศ.$strYear";
		}
	}
	function ThaiFull($strDate, $style=0) {
		$strYear=date("Y", strtotime($strDate))+543;
		$strMonth=date("n", strtotime($strDate));
		$strDay=date("d", strtotime($strDate));
		$strMonthCut=Array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
		switch($strDay) {
			case "01": $strDay = "1"; break;
			case "02": $strDay = "2"; break;
			case "03": $strDay = "3"; break;
			case "04": $strDay = "4"; break;
			case "05": $strDay = "5"; break;
			case "06": $strDay = "6"; break;
			case "07": $strDay = "7"; break;
			case "08": $strDay = "8"; break;
			case "09": $strDay = "9"; break;
		} 
		$strMonthThai=$strMonthCut[$strMonth];

		if ($style==0) {
			return "$strDay $strMonthThai $strYear";
		}

		else {
			return "$strMonthThai พ.ศ.$strYear";
		}
	}
	function MonthYear($strDate, $style=0) {
		$strYear=date("Y", strtotime($strDate))+543;
		$strMonth=date("n", strtotime($strDate));
		$strDay=date("d", strtotime($strDate));
		$strMonthCut=Array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
		switch($strDay) {
			case "01": $strDay = "1"; break;
			case "02": $strDay = "2"; break;
			case "03": $strDay = "3"; break;
			case "04": $strDay = "4"; break;
			case "05": $strDay = "5"; break;
			case "06": $strDay = "6"; break;
			case "07": $strDay = "7"; break;
			case "08": $strDay = "8"; break;
			case "09": $strDay = "9"; break;
		} 
		$strMonthThai=$strMonthCut[$strMonth];

		if ($style==0) {
			return "$strMonthThai $strYear";
		}

		else {
			return "$strMonthThai พ.ศ.$strYear";
		}
	}
	function ThaiMonth($strDate, $style=0) {
		$strMonth=date("n", strtotime($strDate));
		$strMonthCut=Array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");

		$strMonthThai=$strMonthCut[$strMonth];

		if ($style==0) {
			return "$strMonthThai";
		}

		else {
			return "$strMonthThai";
		}
	}
	function NoDate($strDate, $style=0) {
		$strDay=date("d", strtotime($strDate));
		switch($strDay) {
			case "01": $strDay = "1"; break;
			case "02": $strDay = "2"; break;
			case "03": $strDay = "3"; break;
			case "04": $strDay = "4"; break;
			case "05": $strDay = "5"; break;
			case "06": $strDay = "6"; break;
			case "07": $strDay = "7"; break;
			case "08": $strDay = "8"; break;
			case "09": $strDay = "9"; break;
		} 

		if ($style==0) {
			return "$strDay";
		}

		else {
			return "$strDay";
		}
	}
	function getBirthda($u_birthday) {
		$birthday = $u_birthday;
		$today = date("Y-m-d");
		list($byear, $bmonth, $bday)= explode("-",$birthday);
		list($tyear, $tmonth, $tday)= explode("-",$today);
		$mbirthday = mktime(0, 0, 0, $bmonth, $bday, $byear);
		$mnow = mktime(0, 0, 0, $tmonth, $tday, $tyear );
		$mage = ( $mnow - $mbirthday);
		$u_y=date("Y",$mage)-1970;
		$u_m=date("m",$mage)-1;
		$u_d=date("d",$mage)-1;
		return "$u_y ปี $u_m เดือน $u_d วัน";
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
	function duration($begin,$end){
		$remain=intval(strtotime($end)-strtotime($begin));
		$wan=floor($remain/86400);
		$l_wan=$remain%86400;
		$hour=floor($l_wan/3600);
		$l_hour=$l_wan%3600;
		$minute=floor($l_hour/60);
		$second=$l_hour%60;
		if($minute>0){
			$wan=$wan+1;
		}
		else {
			$wan=$wan+0;
		}
		//return "ผ่านมาแล้ว ".$wan." วัน ".$hour." ชั่วโมง ".$minute." นาที ".$second." วินาที";
		return $wan;
	}

}
