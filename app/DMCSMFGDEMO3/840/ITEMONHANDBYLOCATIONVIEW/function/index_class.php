<?php
require_once(dirname(__FILE__, 6) . '/common/SessionStart.php');

class LocationInventoryInquiry {

    public function __construct() {
        $this->APPCODE = 'ITEMONHANDBYLOCATIONVIEW';
    }

    public function getLoc($LOCTYP, $LOCCD) {
        try {
            $Param = array('LOCTYP' => $LOCTYP, 'LOCCD' => $LOCCD);
            $cmd = GetRequestData($Param, 'inv.ItemOnHandByLoc.getLoc', $this->APPCODE, '');
            $data = Execute($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function search($Param) {
        try {
            $cmd = GetRequestData($Param, 'inv.ItemOnHandByLoc.search', $this->APPCODE, '');
            $data = ExecuteAll($cmd, $errorMessage);
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
?>