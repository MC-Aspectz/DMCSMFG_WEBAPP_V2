<?php

    function lang($msg) {

        $lang = [
            "clear" => "ล้าง",
            "close" => "ปิด", 
            "yes" => "ใช่",
            "no" => "ไม่",
            "ok" => "Ok",
            "nono" => "ไม่",
  
            "question1" => "คุณต้องการสิ้นสุดกระบวนการนี้หรือไม่ ?",
            "question2" => "คุณต้องการบันทึกข้อมูลหรือไม่ ?",

            "validation1" => "ช่องบังคับทั้งหมดที่ล้อมรอบด้วยเส้นสีแดงจะต้องกรอกให้ครบถ้วน",
            "validation2" => "ไม่มีอะไรให้พิมพ์",

            'complete' => 'เรียบร้อย',
        ];

        return $lang[$msg];

    }

?>
