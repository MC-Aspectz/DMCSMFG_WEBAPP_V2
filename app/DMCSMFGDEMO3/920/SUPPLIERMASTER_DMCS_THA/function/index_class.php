<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class SupplierMaster extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'SUPPLIERMASTER_DMCS_THA';
    }

    public function chack_l($SUPPLIERSHORTNAME) {
        $Param = array('SUPPLIERSHORTNAME' => $SUPPLIERSHORTNAME);
        return $this->GetReques ($Param, $this->APPCODE, 'chack_l');
    }

    public function SetBranch($FACTORYCODE) {
        $Param = array('FACTORYCODE' => $FACTORYCODE);
        return $this->GetReques($Param, $this->APPCODE, 'SetBranch');
    }

    public function ChkBranch($FACTORYCODE, $SUPPLIERADD01) {
        $Param = array('FACTORYCODE' => $FACTORYCODE,
                        'SUPPLIERADD01' => $SUPPLIERADD01);
        return $this->GetReques($Param, $this->APPCODE, 'ChkBranch');
    }

    public function getGMap($SUPPLIERADDR1,$SUPPLIERADDR2,$SUPPLIERZIPCODE) {
        $Param = array( 'SUPPLIERADDR1' => $SUPPLIERADDR1,
                        'SUPPLIERADDR2' => $SUPPLIERADDR2,
                        'SUPPLIERZIPCODE' => $SUPPLIERZIPCODE);
        $cmd = GetRequestData($Param, 'acc.THA.SupplierMaster.getGMap', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getSupplier($SUPPLIERCD) {
        $Param = array('SUPPLIERCD' => $SUPPLIERCD);
        $cmd = GetRequestData($Param, 'acc.THA.SupplierMaster.getSupplier', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getCity($COUNTRYCD, $STATECD, $CITYCD) {
        $Param = array('COUNTRYCD' => $COUNTRYCD, 'STATECD' => $STATECD, 'CITYCD' => $CITYCD);
        $cmd = GetRequestData($Param, 'gen.TaxDetailEntry.getCity', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getCurrency($CURRENCYCD) {
        $Param = array('CURRENCYCD' => $CURRENCYCD);
        $cmd = GetRequestData($Param, 'acc.THA.SupplierMaster.getSupplierCur', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getCur() {
        $Param = array();
        $cmd = GetRequestData($Param, 'acc.THA.SupplierMaster.getCur', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getBillSupplier($SUPBILLCD) {
        $Param = array('SUPBILLCD' => $SUPBILLCD);
        $cmd = GetRequestData($Param, 'acc.THA.SupplierMaster.getBillSupplier', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function changeTaxType($SUPPLIERTAXTYP) {
        $Param = array('SUPPLIERTAXTYP' => $SUPPLIERTAXTYP);
        $cmd = GetRequestData($Param, 'acc.THA.SupplierMaster.changeTaxType', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function insSup($Param) {
        $cmd = GetRequestData($Param, 'acc.THA.SupplierMaster.insSup', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function updSup($Param) {
        $cmd = GetRequestData($Param, 'acc.THA.SupplierMaster.updSup', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function delSup($SUPPLIERCD) {
        $Param = array('SUPPLIERCD' => $SUPPLIERCD);
        $cmd = GetRequestData($Param, 'acc.THA.SupplierMaster.delSup', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'acc.THA.AccessibleControl.setPrivilege', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?> 