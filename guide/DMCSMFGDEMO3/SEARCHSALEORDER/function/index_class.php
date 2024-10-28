<?php
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');

class SalesOrderIndex {

    public $P1 = '';
    public $P2 = '';
    public $P3 = '';
    public $P4 = '';
    public $P5 = '';
    public $P6 = '';
    public $P7 = '';
    public $P8 = '';
    public $P9 = '';
    public $P10 = '';

    public function __construct() {
        $this->APPCODE = 'SEARCHSALEORDER';
    }

    public function searchSaleOrder($Param) {
        $cmd = GetRequestData($Param, 'search.SearchGeneral.searchSaleOrder', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }
}
?> 
