<?php

    function lang($msg) {

        $lang = [
            "clear" => "ล้าง",
            "close" => "ปิด", 
            "yes" => "ใช่",
            "no" => "ไม่",
            "ok" => "Ok",
            "nono" => "ไม่",
            "canceled" => "ยกเลิกแล้ว",
                    
            "question1" => "คุณต้องการสิ้นสุดกระบวนการนี้หรือไม่ ?",
            "question2" => "คุณต้องการบันทึกข้อมูลรูปแบบที่เกิดขึ้นประจำหรือไม่",
         
            "success" => "เพิ่มรายการเข้าระบบแล้ว, บัญชีแยกประเภททั่วไปเรียบร้อยแล้ว",

        ];

        return $lang[$msg];

    }

?>