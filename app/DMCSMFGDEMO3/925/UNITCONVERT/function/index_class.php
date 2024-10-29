<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class UnitConversionMaster {

    public function __construct() {
        $this->APPCODE = 'UNITCONVERT';
    }

    public function getRate($UNITFROM, $UNITTO) {
        $Param = array('UNITFROM'  => $UNITFROM , 'UNITTO'  => $UNITTO);
        $cmd = GetRequestData($Param, 'mas.UnitConvert.getRate', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function insRate($Param) {
        $cmd = GetRequestData($Param, 'mas.UnitConvert.insRate', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function updRate($Param) {
        $cmd = GetRequestData($Param, 'mas.UnitConvert.updRate', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function delRate($Param) {
        $cmd = GetRequestData($Param, 'mas.UnitConvert.delRate', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function load() {
        $Param = array();
        $cmd = GetRequestData($Param, 'mas.ItemMaster.load', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?> 