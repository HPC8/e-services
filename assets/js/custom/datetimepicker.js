$(function(){
     
    $.datetimepicker.setLocale('th'); // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.
    // กรณีใช้แบบ inline
    $("#dete_test").datetimepicker({
        timepicker:false,
        format:'d-m-Y',  // กำหนดรูปแบบวันที่ ที่ใช้ เป็น 00-00-0000            
        lang:'th',  // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.
        inline:true  
    });       
     
    // กรณีใช้แบบ input
    $("#emp-birthday").datetimepicker({
        timepicker:false,
        format:'Y-m-d',  // กำหนดรูปแบบวันที่ ที่ใช้ เป็น 00-00-0000            
        lang:'th',  // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.
        scrollMonth : false,
        onSelectDate:function(dp,$input){
            var yearT=new Date(dp).getFullYear()-0;  
            var yearTH=yearT+0;
            var fulldate=$input.val();
            var fulldateTH=fulldate.replace(yearT,yearTH);
            $input.val(fulldateTH);
        },
	}); 
	$("#emp-startdate").datetimepicker({
        timepicker:false,
        format:'Y-m-d',  // กำหนดรูปแบบวันที่ ที่ใช้ เป็น 00-00-0000            
        lang:'th',  // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.
        scrollMonth : false,
        onSelectDate:function(dp,$input){
            var yearT=new Date(dp).getFullYear()-0;  
            var yearTH=yearT+0;
            var fulldate=$input.val();
            var fulldateTH=fulldate.replace(yearT,yearTH);
            $input.val(fulldateTH);
        },
	}); 
	$("#emp-stopdate").datetimepicker({
        timepicker:false,
        format:'Y-m-d',  // กำหนดรูปแบบวันที่ ที่ใช้ เป็น 00-00-0000            
        lang:'th',  // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.
        scrollMonth : false,
        onSelectDate:function(dp,$input){
            var yearT=new Date(dp).getFullYear()-0;  
            var yearTH=yearT+0;
            var fulldate=$input.val();
            var fulldateTH=fulldate.replace(yearT,yearTH);
            $input.val(fulldateTH);
        },
	}); 
	
	$("#book_start").datetimepicker({
        timepicker:false,
        format:'Y-m-d',  // กำหนดรูปแบบวันที่ ที่ใช้ เป็น 00-00-0000            
        lang:'th',  // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.
        scrollMonth : false,
        onSelectDate:function(dp,$input){
            var yearT=new Date(dp).getFullYear()-0;  
            var yearTH=yearT+0;
            var fulldate=$input.val();
            var fulldateTH=fulldate.replace(yearT,yearTH);
            $input.val(fulldateTH);
        },
	});
	$("#book_end").datetimepicker({
        timepicker:false,
        format:'Y-m-d',  // กำหนดรูปแบบวันที่ ที่ใช้ เป็น 00-00-0000            
        lang:'th',  // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.
        scrollMonth : false,
        onSelectDate:function(dp,$input){
            var yearT=new Date(dp).getFullYear()-0;  
            var yearTH=yearT+0;
            var fulldate=$input.val();
            var fulldateTH=fulldate.replace(yearT,yearTH);
            $input.val(fulldateTH);
        },
    });

    $("#input-train-create-date").datetimepicker({
        timepicker:false,
        format:'Y-m-d',  // กำหนดรูปแบบวันที่ ที่ใช้ เป็น 00-00-0000            
        lang:'th',  // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.
        scrollMonth : false,
        onSelectDate:function(dp,$input){
            var yearT=new Date(dp).getFullYear()-0;  
            var yearTH=yearT+0;
            var fulldate=$input.val();
            var fulldateTH=fulldate.replace(yearT,yearTH);
            $input.val(fulldateTH);
        },
    });
    // // กรณีใช้กับ input ต้องกำหนดส่วนนี้ด้วยเสมอ เพื่อปรับปีให้เป็น ค.ศ. ก่อนแสดงปฏิทิน
    // $("#emp_birthday").on("mouseenter mouseleave",function(e){
    //     var dateValue=$(this).val();
    //     if(dateValue!=""){
    //             var arr_date=dateValue.split("-"); // ถ้าใช้ตัวแบ่งรูปแบบอื่น ให้เปลี่ยนเป็นตามรูปแบบนั้น
    //             // ในที่นี้อยู่ในรูปแบบ 00-00-0000 เป็น d-m-Y  แบ่งด่วย - ดังนั้น ตัวแปรที่เป็นปี จะอยู่ใน array
    //             //  ตัวที่สอง arr_date[2] โดยเริ่มนับจาก 0 
    //             if(e.type=="mouseenter"){
    //                 var yearT=arr_date[0]-0;
    //             }       
    //             if(e.type=="mouseleave"){
    //                 var yearT=parseInt(arr_date[0])+0;
    //             }   
    //             dateValue=dateValue.replace(arr_date[0],yearT);
    //             $(this).val(dateValue);                                                 
    //     }       
	// });
     
     
});