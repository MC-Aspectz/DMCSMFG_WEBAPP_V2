<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class AccPurchseOrderEntryMFG extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_PURCHSEORDERENTRY_MFG';
    }

    public function getPR($PRNO) {
        $Param = array('PRNO' => $PRNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccPurOrderEntry_MFG.getPR', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getPR2($Param) {
        $cmd = GetRequestData($Param, 'acc.THA.AccPurOrderEntry_MFG.getPR2', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getPRLn($Param) {
        $cmd = GetRequestData($Param, 'acc.THA.AccPurOrderEntry_MFG.getPRLn', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getPO($PONO) {
        $Param = array('PONO' => $PONO);
        $cmd = GetRequestData($Param, 'acc.THA.AccPurOrderEntry_MFG.getPO', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getPO2($PONO) {
        $Param = array('PONO' => $PONO);
        $cmd = GetRequestData($Param, 'acc.THA.AccPurOrderEntry_MFG.getPO2', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getPOLn($PONO) {
        $Param = array('PONO' => $PONO);
        $cmd = GetRequestData($Param, 'acc.THA.AccPurOrderEntry_MFG.getPOLn', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getDiv($DIVISIONCD) {
        $Param = array('DIVISIONCD' => $DIVISIONCD);
        $cmd = GetRequestData($Param, 'acc.THA.AccPurOrderEntry_MFG.getDiv', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getSupplier($SUPPLIERCD) {
        $Param = array('SUPPLIERCD' => $SUPPLIERCD);
        $cmd = GetRequestData($Param, 'acc.THA.AccPurOrderEntry_MFG.getSupplier', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getCurrency($SUPPLIERCD, $SUPCURCD) {
        $Param = array('SUPPLIERCD' => $SUPPLIERCD, 'SUPCURCD' => $SUPCURCD);
        $cmd = GetRequestData($Param, 'acc.THA.AccPurOrderEntry_MFG.getCurrency', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getStaff($STAFFCD) {
        $Param = array('STAFFCD' => $STAFFCD);
        $cmd = GetRequestData($Param, 'acc.THA.AccPurOrderEntry_MFG.getStaff', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getItem($Param) {
        $cmd = GetRequestData($Param, 'acc.THA.AccPurOrderEntry_MFG.getItem', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getAmt($SUPPLIERCD, $SUPCURCD, $ITEMCD, $PURQTY, $PURUNITPRC, $DISCOUNT, $DISCRATE, $VATRATE) {
        $Param = array(	'SUPPLIERCD' => $SUPPLIERCD,
		            	'SUPCURCD' => $SUPCURCD,
		            	'ITEMCD' => $ITEMCD,
		            	'PURQTY' => $PURQTY,
		            	'PURUNITPRC' => $PURUNITPRC,
		            	'DISCOUNT' => $DISCOUNT,
		            	'DISCRATE' => $DISCRATE,
		            	'VATRATE' => $VATRATE);
        $cmd = GetRequestData($Param, 'acc.THA.AccPurOrderEntry_MFG.getAmt', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'acc.THA.AccPurOrderEntry_MFG.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    // PCAPPCD,PCITEMCD,TMPPURQTY,TMPPURUNITPRC,TMPPURAMT,PONO
    public function loadItem($Param) {
        $cmd = GetRequestData($Param, 'acc.THA.AccPurOrderEntry_MFG.loadItem', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getSum($Param) {
        $cmd = GetRequestData($Param, 'acc.THA.AccPurOrderEntry_MFG.getSum', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function calculate($Param) {
        $cmd = GetRequestData($Param, 'acc.THA.AccPurOrderEntry_MFG.calculate', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function commit($Param) {
        $cmd = GetRequestData($Param, 'acc.THA.AccPurOrderEntry_MFG.commit', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function cancel($PONO) {
        $Param = array('PONO' => $PONO);
        $cmd = GetRequestData($Param, 'acc.THA.AccPurOrderEntry_MFG.cancel', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function printStatic($Param) {
        return $this->GetReques($Param, 'ACC_PURCHSEORDERENTRY_MFG', 'printStatic');
    }

    public function printDynamic($Param) {
        return $this->GetRequesAll($Param, 'ACC_PURCHSEORDERENTRY_MFG', 'printDynamic');
    }

    public function Finished() {
        $Param = array();
        return $this->GetReques($Param, 'ACC_SALEQUOTEENTRY_MFG', 'Finished');
    }
}