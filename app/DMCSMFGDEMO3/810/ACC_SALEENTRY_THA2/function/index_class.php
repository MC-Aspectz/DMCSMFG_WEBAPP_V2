<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class SaleEntryTHA extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_SALEENTRY_THA2';
    }

    public function getST($SALETRANNO) {
        $Param = array('SALETRANNO' => $SALETRANNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry.getST', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getST2($SALETRANNO) {
        $Param = array('SALETRANNO' => $SALETRANNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry.getST2', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getSO($SALEORDERNO) {
        $Param = array('SALEORDERNO' => $SALEORDERNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry.getSO', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getSO2($SALEORDERNO, $SALETRANNO) {
        $Param = array('SALEORDERNO' => $SALEORDERNO, 'SALETRANNO' => $SALETRANNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry.getSO2', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getDivision($DIVISIONCD) {
        $Param = array('DIVISIONCD' => $DIVISIONCD);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry.getDiv', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getAmt($Param) {
        $cmd = GetRequestData($Param, 'acc.AccEstimateEntry.getAmt', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getSTLn($SALETRANNO) {
        $Param = array('SALETRANNO' => $SALETRANNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry.getSTLn', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getSOLn($SALEORDERNO, $SALETRANNO) {
        $Param = array('SALEORDERNO' => $SALEORDERNO, 'SALETRANNO' => $SALETRANNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry.getSOLn', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getCustomer($CUSTOMERCD) {
        $Param = array('CUSTOMERCD' => $CUSTOMERCD);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry.getCustomer', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getStaff($STAFFCD) {
        $Param = array('STAFFCD' => $STAFFCD);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry.getStaff', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getCurrency($CUSCURCD) {
        $Param = array('CUSCURCD' => $CUSCURCD);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry.getCurrency', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getItem($Param) {
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry.getItem', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getSum() {
        $Param = array();
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry.getSum', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function commit($Param) {
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry.commit', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    // Syslogic(IVprintStatic),Syslogic(IVprintDynamic) SALETRANNO,REPRINTREASON
    public function IVprintStatic($Param) {
        return $this->GetReques($Param, $this->APPCODE, 'IVprintStatic');
        // $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry.IVprintStatic', $this->APPCODE, '');
        // $data = Execute($cmd, $errorMessage);
        // return $data;
    }

    public function IVprintDynamic($Param) {
        return $this->GetRequesAll($Param, $this->APPCODE, 'IVprintDynamic');
        // $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry.IVprintDynamic', $this->APPCODE, '');
        // $data = ExecuteAll($cmd, $errorMessage);
        // return $data;
    }
    // TAX INV
    public function IVprintCheck($Param) {
        // SALETRANNO, REPRINTREASON
        // return $this->GetReques($Param, $this->APPCODE, 'IVprintCheck');
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry.IVprintCheck', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
    // Syslogic(TIVprintStatic),Syslogic(TIVprintDynamic) SALETRANNO,REPRINTREASON
    public function TIVprintStatic($Param) {
        return $this->GetReques($Param, $this->APPCODE, 'TIVprintStatic');
        // $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry.TIVprintStatic', $this->APPCODE, '');
        // $data = Execute($cmd, $errorMessage);
        // return $data;
    }

    public function TIVprintDynamic($Param) {
        return $this->GetRequesAll($Param, $this->APPCODE, 'TIVprintDynamic');
        // $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry.TIVprintDynamic', $this->APPCODE, '');
        // $data = ExecuteAll($cmd, $errorMessage);
        // return $data;
    }
    // SALE VOUCHER
    public function SVprintCheck($Param) {
        // SALETRANNO,REPRINTREASON
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry.SVprintCheck', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function SVprintStatic($Param) {
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry.SVprintStatic', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function SVprintDynamic($Param) {
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleEntry.SVprintDynamic', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function setAlert($msg) {
        return "<script type='text/javascript'>alert('". $msg. "');</script>";
    }
}
