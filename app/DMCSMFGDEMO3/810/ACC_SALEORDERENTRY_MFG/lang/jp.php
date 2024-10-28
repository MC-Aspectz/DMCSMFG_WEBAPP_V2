<?php
    function lang($msg) {

        $lang = [
            'ERRO_NOCURCD' => '通貨コードを入力してください。',
            'ERRO_NO_CUTOMER' => '顧客コードを入力してください。',
            'ERRO_SALEORDERNO' => '販売注文番号を入力してください。',
            'WARN_CANCALEDQUOTE' => 'WARN_CANCALEDQUOTE',
            'yes' => 'はい',
            'ok' => 'Ok',
            'no' => 'いいえ',

            'canceled' => 'キャンセル。',

            'question1' => 'このプロセスを終了しますか ?',
            'question2' => 'データをキャンセルしますか ？ （解約処理後のデータの再利用はできません。）',
            'question3' => 'データを記録しますか ?',
            'question4' => 'このデータを印刷しますか ?',

            'validation1' => '赤い線で囲まれたすべての必須フィールドに入力する必要があります。',

            'quotation' => 'QUOTATION',
            'nno' => 'NO.',
            'codes' => 'CODE',
            'description' => 'DESCRIPTION',
            'qty'=> "Q'TY",
            'uom' => 'UOM',
            'unitprices' => 'UNITPRICE',
            'discounts' => 'DISCOUNT',
            'amounts' => 'AMOUNT',
            'attn' => '宛先',
            'customer' => 'お客様',
            'address' => '住所',
            'days' => '日々',
            'quotationno' => '見積番号',
            'pricevalidity' => '価格の妥当性',
            'quotedby' => '引用元',
            'remark' => 'リマーク',
            'lessdiscount' => '少ない割引',
            'forcustomer' => 'お客様向け',
            'orderconfirmedby' => 'によって確認された注文',
            'date' => '日にち',
            'preparedby' => '醸造元',
        
        ];

        return !empty($lang[$msg]) ? $lang[$msg] : $msg;

    }
?>