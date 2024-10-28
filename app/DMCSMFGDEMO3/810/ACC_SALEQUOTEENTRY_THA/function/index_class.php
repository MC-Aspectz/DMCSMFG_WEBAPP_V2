<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class QuoteEntry extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_SALEQUOTEENTRY_THA';
    }

    public function getQuote($ESTNO) {
        $Param = array('ESTNO' => $ESTNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccEstimateEntry.getEst', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getCloneEst($ESTNOCLONE) {
        $Param = array('ESTNOCLONE' => $ESTNOCLONE);
        $cmd = GetRequestData($Param, 'acc.THA.AccEstimateEntry.getEst', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getDivision($DIVISIONCD) {
        $Param = array('DIVISIONCD' => $DIVISIONCD);
        $cmd = GetRequestData($Param, 'acc.AccEstimateEntry.getDiv', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getCustomer($CUSTOMERCD) {
        $Param = array('CUSTOMERCD' => $CUSTOMERCD);
        $cmd = GetRequestData($Param, 'acc.THA.AccEstimateEntry.getCustomer', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getStaff($STAFFCD) {
        $Param = array('STAFFCD' => $STAFFCD);
        $cmd = GetRequestData($Param, 'acc.AccEstimateEntry.getStaff', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getCurrency($CUSCURCD) {
        $Param = array('CUSCURCD' => $CUSCURCD);
        $cmd = GetRequestData($Param, 'acc.AccEstimateEntry.getCurrency', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getItem($Param) {
        $cmd = GetRequestData($Param, 'acc.AccEstimateEntry.getItem', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function searchItemEST($ESTNO) {
        $Param = array('ESTNO' => $ESTNO);
        $cmd = GetRequestData($Param, 'acc.AccEstimateEntry.search', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getAmt($Param) {
        $cmd = GetRequestData($Param, 'acc.AccEstimateEntry.getAmt', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function commit($Param) {
        $cmd = GetRequestData($Param, 'acc.AccEstimateEntry.commit', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function cancel($ESTNO) {
        $Param = array('ESTNO' => $ESTNO);
        $cmd = GetRequestData($Param, 'acc.AccEstimateEntry.cancel', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function makeRequest($ESTNO, $ESTENTRYDT, $T_AMOUNT) {
        $Param = array( 'ESTNO' => $ESTNO,
                        'ESTENTRYDT' => $ESTENTRYDT,
                        'T_AMOUNT' => $T_AMOUNT);
        return $this->GetReques($Param, $this->APPCODE, 'makeRequest');
    }

    public function printStatic($Param) {
        return $this->GetReques($Param, 'ACC_SALEQUOTEENTRY', 'printStatic2');
    }

    public function printDynamic($ESTNO) {
        $Param = array( 'ESTNO' => $ESTNO);
        return $this->GetRequesAll($Param, 'ACC_SALEQUOTEENTRY', 'printDynamic2');
    }
}
