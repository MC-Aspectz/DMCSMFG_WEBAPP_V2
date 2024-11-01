<?php
require_once(dirname(__FILE__, 6) . '/common/syslogic.php');
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class OrderBMEntryMFG extends Syslogic {

    public function __construct() {
        $this->APPCODE = 'ORDERBMENTRY_MFG';
    }

    public function get($ALLOCORDERNO, $ALLOCORDERTYP) {
        $Param = array( 'ALLOCORDERNO' => $ALLOCORDERNO,
                        'ALLOCORDERTYP' => $ALLOCORDERTYP);
        $cmd = GetRequestData($Param, 'pro.THA.AllocOrderEntry_MFG.get', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function orderSearch($ORDERNO, $ORDERLN, $ALLOCORDERTYP, $ODRQTY) {
        $Param = array( 'ORDERNO' => $ORDERNO,
                        'ORDERLN' => $ORDERLN,
                        'ALLOCORDERTYP' => $ALLOCORDERTYP,
                        'ODRQTY' => $ODRQTY);
        $cmd = GetRequestData($Param, 'pro.THA.AllocOrderEntry_MFG.search', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function getItem($ITEMCD) {
        $Param = array( 'ITEMCD' => $ITEMCD,);
        $cmd = GetRequestData($Param, 'pro.THA.AllocOrderEntry_MFG.getItem', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getMat($MATERIALCD) {
        $Param = array( 'MATERIALCD' => $MATERIALCD);
        $cmd = GetRequestData($Param, 'pro.THA.AllocOrderEntry_MFG.getMat', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function getPItem($PITEMCD) {
        $Param = array( 'PITEMCD' => $PITEMCD);
        $cmd = GetRequestData($Param, 'pro.THA.AllocOrderEntry_MFG.getPItem', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function remake($Param) {
        $cmd = GetRequestData($Param, 'pro.THA.AllocOrderEntry_MFG.remake', $this->APPCODE, '');
        $data = ExecuteAll($cmd, $errorMessage);
        return $data;
    }

    public function commitAll($Param) {
        $cmd = GetRequestData($Param, 'pro.THA.AllocOrderEntry_MFG.commitAll', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }

    public function proOrPur($ITEMCD, $ALLOCORDERFLG) {
        $Param = array('ITEMCD' => $ITEMCD, 'ALLOCORDERFLG' => $ALLOCORDERFLG);
        $cmd = GetRequestData($Param, 'pro.THA.AllocOrderEntry_MFG.proOrPur', $this->APPCODE, '');
        $data = Execute($cmd, $errorMessage);
        return $data;
    }
}
?>