<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class SalesOrderEntry extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ACC_SALEORDERENTRY_THA';
    }

    public function getEst($ESTNO) {
        $Param = array("ESTNO" => $ESTNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleOrderEntry.getEst', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getDivision($DIVISIONCD) {
        $Param = array("DIVISIONCD" => $DIVISIONCD);
        $cmd = GetRequestData($Param, 'acc.AccSaleOrderEntry.getDiv', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getSO($SALEORDERNO) {
        $Param = array("SALEORDERNO" => $SALEORDERNO);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleOrderEntry.getSO', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getSOLn($SALEORDERNO) {
        $Param = array("SALEORDERNO" => $SALEORDERNO);
        $cmd = GetRequestData($Param, 'acc.AccSaleOrderEntry.getSOLn', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getEstLn($ESTNO, $SALEORDERNO) {
        $Param = array("ESTNO" => $ESTNO, "SALEORDERNO" => $SALEORDERNO);
        $cmd = GetRequestData($Param, 'acc.AccSaleOrderEntry.getEstLn', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getCustomer($CUSTOMERCD) {
        $Param = array("CUSTOMERCD" => $CUSTOMERCD);
        $cmd = GetRequestData($Param, 'acc.THA.AccSaleOrderEntry.getCustomer', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getStaff($STAFFCD) {
        $Param = array("STAFFCD" => $STAFFCD);
        $cmd = GetRequestData($Param, 'acc.AccSaleOrderEntry.getStaff', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getCurrency($CUSCURCD) {
        $Param = array("CUSCURCD" => $CUSCURCD);
        $cmd = GetRequestData($Param, 'acc.AccSaleOrderEntry.getCurrency', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getItem($Param) {
        $cmd = GetRequestData($Param, 'acc.AccSaleOrderEntry.getItem', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function commit($Param) {
        $cmd = GetRequestData($Param, 'acc.AccSaleOrderEntry.commit', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function cancel($SALEORDERNO) {
        $Param = array("SALEORDERNO" => $SALEORDERNO);
        $cmd = GetRequestData($Param, 'acc.AccSaleOrderEntry.cancel', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function printStatic($Param) {
        return $this->GetReques($Param, 'ACC_SALEORDERENTRY', 'printStatic');
    }

    public function printDynamic($SALEORDERNO) {
        $Param = array( "SALEORDERNO" => $SALEORDERNO);
        return $this->GetReques($Param, 'ACC_SALEORDERENTRY', 'printDynamic');
    }
}
