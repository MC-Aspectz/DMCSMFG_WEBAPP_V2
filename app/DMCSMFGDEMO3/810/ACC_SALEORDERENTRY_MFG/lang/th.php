<?php
    function lang($msg) {

        $lang = [
            'ERRO_NOCURCD' => 'กรุณากรอกรหัสสกุลเงิน',
            'ERRO_NO_CUTOMER' => 'กรุณากรอกรหัสลูกค้า',
            'ERRO_SALEORDERNO' => 'กรุณากรอกหมายเลขใบสั่งซื้อ',
            'WARN_CANCALEDQUOTE' => 'WARN_CANCALEDQUOTE',
            'yes' => 'ใช่',
            'ok' => 'Ok',
            'no' => 'ไม่',

            'canceled' => 'ยกเลิกแล้ว',

            'question1' => 'คุณต้องการสิ้นสุดกระบวนการนี้หรือไม่ ?',
            'question2' => 'คุณต้องการยกเลิกข้อมูลหรือไม่ ? (หลังจากดำเนินการยกเลิกแล้ว จะไม่สามารถนำข้อมูลกลับมาใช้ใหม่ได้)',
            'question3' => 'คุณต้องการบันทึกข้อมูลหรือไม่ ?',
            'question4' => 'คุณต้องการพิมพ์ข้อมูลนี้หรือไม่ ?',

            'validation1' => 'ช่องบังคับทั้งหมดที่ล้อมรอบด้วยเส้นสีแดงจะต้องกรอกให้ครบถ้วน',

            'quotation' => 'ใบเสนอราคา',
            'nno' => 'NO.',
            'codes' => 'CODE',
            'description' => 'DESCRIPTION',
            'qty'=> "Q'TY",
            'uom' => 'UOM',
            'unitprices' => 'UNITPRICE',
            'discounts' => 'DISCOUNT',
            'amounts' => 'AMOUNT',
            'attn' => 'เรียน',
            'customer' => 'ลูกค้า',
            'address' => 'ที่อยู่',
            'days' => 'วัน',
            'quotationno' => 'หมายเลขใบเสนอราคา',
            'pricevalidity' => 'ความถูกต้องของราคา',
            'quotedby' => 'อ้างโดย',
            'remark' => 'หมายเหตุ',
            'lessdiscount' => 'หักส่วนลด',
            'forcustomer' => 'สำหรับลูกค้า',
            'orderconfirmedby' => 'ยืนยันการสั่งซื้อโดย',
            'date' => 'วันที่',
            'preparedby' => 'จัดเตรียมโดย',

        ];

        return !empty($lang[$msg]) ? $lang[$msg] : $msg;

    }
?>