<?php

    function lang($msg) {

	    $lang = [
	        'close' => 'ปิด',
	        'yes' => 'ใช่',
	        'no' => 'ไม่',
	        
	        'question1' => 'คุณต้องการสิ้นสุดกระบวนการนี้หรือไม่ ?',
	        
	        'validation1' => 'ช่องบังคับทั้งหมดที่ล้อมรอบด้วยเส้นสีแดงจะต้องกรอกให้ครบถ้วน',

	        'warning1' => 'คำสั่งซื้อนี้เสร็จสมบูรณ์หรือปิดแล้ว ไม่สามารถแก้ไขหรือลบได้',
	    ];

        return $lang[$msg];

    }
?>