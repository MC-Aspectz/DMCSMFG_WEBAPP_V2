<?php
    function lang($msg) {

        $lang = [
            'ERRO_NOCURCD' => 'Please fill Currency code.',
            'ERRO_NO_CUTOMER' => 'Please fill Customer code.',
            'ERRO_SALEORDERNO' => 'Please fill Sale Order No.',
            'WARN_CANCALEDQUOTE' => 'WARN_CANCALEDQUOTE',
            'yes' => 'Yes',
            'ok' => 'Ok',
            'no' => 'No',

            'canceled' => 'Canceled.',

            'question1' => 'Do you want to end this process ?',
            'question2' => 'Do you want to cancel the data ? (After cancellation processing, data cannot be reused.)',
            'question3' => 'Do you want to record the data ?',
            'question4' => 'Do you want to print this data ?',

            'validation1' => 'All the mandatory fields surrounded in red line need to be completed.',

            'quotation' => 'QUOTATION',
            'nno' => 'NO.',
            'codes' => 'CODE',
            'description' => 'DESCRIPTION',
            'qty'=> "Q'TY",
            'uom' => 'UOM',
            'unitprices' => 'UNITPRICE',
            'discounts' => 'DISCOUNT',
            'amounts' => 'AMOUNT',
            'attn' => 'Attn',
            'customer' => 'Customer',
            'address' => 'Address',
            'days' => 'days',
            'quotationno' => 'Quotation No.',
            'pricevalidity' => 'Price Validity',
            'quotedby' => 'Quoted by',
            'remark' => 'Remark',
            'lessdiscount' => 'Less Discount',
            'forcustomer' => 'FOR CUSTOMER',
            'orderconfirmedby' => 'Order confirmed by',
            'date' => 'Date',
            'preparedby' => 'Prepared By',

        ];

        return !empty($lang[$msg]) ? $lang[$msg] : $msg;
        
    }
?>