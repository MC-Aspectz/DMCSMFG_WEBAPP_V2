<?php
//--------------------------------------------------------------------------------
//  SESSION
//--------------------------------------------------------------------------------
//  Load Including Files
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
require_once($_SESSION['APPPATH'] . '/include/menubar.php');
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
//  Pack Code & Name, Application Code & Name
//--------------------------------------------------------------------------------
$arydirname = explode('/', dirname(__FILE__));
$appcode = $arydirname[array_key_last($arydirname)- 1];
$packcode = $arydirname[array_key_last($arydirname) - 2];
if ($_SESSION['MENU'] != '' and is_array($_SESSION['MENU'])) {
    // Get Pack Name
    $packname = '';
    foreach($_SESSION['MENU'] as $menuitem) {
        if ($menuitem['NODEDATA'] == $packcode) {
            $packname = $menuitem['NODETITLE'];
            break;  // foreach($_SESSION['MENU'] as $menuitem) {
        }  // if ($menuitem['NODEDATA'] == $packcode) {
    }  // foreach($_SESSION['MENU'] as $menuitem) {
    // Get Application Name
    $appname = '';
    foreach($_SESSION['MENU'] as $menuitem) {
        if ($menuitem['NODEDATA'] == $appcode) {
            $appname = $menuitem['NODETITLE'];
            break;  // foreach($_SESSION['MENU'] as $menuitem) {
        }  // if ($menuitem['NODEDATA'] == $appcode) {
    }  // foreach($_SESSION['MENU'] as $menuitem) {
}  // if ($_SESSION['MENU'] != '' and is_array($_SESSION['MENU'])) {

//--------------------------------------------------------------------------------
// No This Application in Menu (Unauthorized Application)
if ($appname == '') {
    // header('Location:home.php');
    // header('Location:'.(isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . 'DMCS_WEBAPP'.'/home.php');
    header('Location:'.(isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . $arydirname[array_key_last($arydirname) - 5].'/home.php');
}
//--------------------------------------------------------------------------------
$_SESSION['APPCODE'] = $appcode;
$_SESSION['APPNAME'] = $appname;
$_SESSION['PACKCODE'] = $packcode;
$_SESSION['PACKNAME'] = $packname;
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
// LANGUAGE
//--------------------------------------------------------------------------------
// print_r($_SESSION['LANG']);
if (isset($_SESSION['LANG'])) {
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}  // if (isset($_SESSION['LANG'])) { else
//--------------------------------------------------------------------------------
// <!-- ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ -->
$data = array();
$data['INS'] = true;
$syslogic = new Syslogic;
$javaFunc = new SupplierMaster;
$systemName = strtolower($appcode);
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) { 
    if(isset($_GET['SUPPLIERCD'])) {
        unsetSessionData();
        $data['INS'] = true;
        $data['SUPPLIERCD'] = isset($_GET['SUPPLIERCD']) ? $_GET['SUPPLIERCD']: '';
        $query = $javaFunc->getSupplier($data['SUPPLIERCD']);
        // echo '<pre>';
        // print_r($query);
        // echo '</pre>';
        if(!empty($query)) {
            $data = $query;
            $data['INS'] = false;
        }

        setSessionArray($data);

        if(checkSessionData()) { $data = getSessionData(); } 
    }
}
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
if(!empty($_POST)) {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'unsetsession') { unsetSessionData(); }
        if ($_POST['action'] == 'keepdata') { setOldValue(); }
        if ($_POST['action'] == 'FACTORYCODE') { SetBranch(); }
        if ($_POST['action'] == 'SUPPLIERSHORTNAME') { chack_l(); }
        if ($_POST['action'] == 'SUPPLIERADD01') { ChkBranch(); }
        if ($_POST['action'] == 'COUNTRYCD') { getCity(); }
        if ($_POST['action'] == 'STATECD') { getCity(); }
        if ($_POST['action'] == 'CITYCD') { getCity(); }
        if ($_POST['action'] == 'SUPPLIERZIPCODE') { getGMap(); }
        if ($_POST['action'] == 'SUPPLIERADDR1') { getGMap(); }
        if ($_POST['action'] == 'SUPPLIERADDR2') { getGMap(); }
        if ($_POST['action'] == 'SUPBILLCD') { getBillSupplier(); }
        if ($_POST['action'] == 'CURRENCYCD') { getCurrency(); }
        if ($_POST['action'] == 'INSERT') { insert(); }
        if ($_POST['action'] == 'UPDATE') { update(); }
        if ($_POST['action'] == 'DELETE') { delete(); }
    }
}
//--------------------------------------------------------------------------------

// ------------------------- CALL Langauge AND Privilege -------------------//
$syspvl = getSystemData($_SESSION['APPCODE'].'_PVL');
if(empty($syspvl)) {
    $syspvl = $syslogic->setPrivilege($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE'].'_PVL', $syspvl);
}
$data['SYSPVL'] = $syspvl;
$loadApp = getSystemData($_SESSION['APPCODE']);
if(empty($loadApp)) {
    $syslogic->ProgramRundelete($_SESSION['APPCODE']);
    $loadApp = $syslogic->getLoadApp($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE'], $loadApp);
}
// $load = getSystemData($_SESSION['APPCODE'].'LOAD');
// if(empty($load)) {
//     $load = $javaFunc->load();
//     setSystemData($_SESSION['APPCODE'].'LOAD', $load);
// }
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$ROUND = $data['DRPLANG']['ROUND'];
$BRANCH_KBN = $data['DRPLANG']['BRANCH_KBN'];
$BK_ACC_TYPE= $data['DRPLANG']['BK_ACC_TYPE'];
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($load);
// echo '</pre>';
// --------------------------------------------------------------------------//

function getSupplier() {
    $javafunc = new SupplierMaster;
    $SUPPLIERCD = isset($_POST['SUPPLIERCD']) ? $_POST['SUPPLIERCD']: '';
    $query = $javafunc->getSupplier($SUPPLIERCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function chack_l() {
    $javafunc = new SupplierMaster;
    $SUPPLIERSHORTNAME = isset($_POST['SUPPLIERSHORTNAME']) ? $_POST['SUPPLIERSHORTNAME']: '';
    $query = $javafunc->chack_l($SUPPLIERSHORTNAME);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function ChkBranch() {
    $javafunc = new SupplierMaster;
    $FACTORYCODE = isset($_POST['FACTORYCODE']) ? $_POST['FACTORYCODE']: '';
    $SUPPLIERADD01 = isset($_POST['SUPPLIERADD01']) ? $_POST['SUPPLIERADD01']: '';
    $query = $javafunc->ChkBranch($FACTORYCODE, $SUPPLIERADD01);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function SetBranch() {
    $javafunc = new SupplierMaster;
    $FACTORYCODE = isset($_POST['FACTORYCODE']) ? $_POST['FACTORYCODE']: '';
    $query = $javafunc->SetBranch($FACTORYCODE);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getCity() {
    $javafunc = new SupplierMaster;
    $CITYCD = isset($_POST['CITYCD']) ? $_POST['CITYCD']: '';
    $STATECD = isset($_POST['STATECD']) ? $_POST['STATECD']: '';
    $COUNTRYCD = isset($_POST['COUNTRYCD']) ? $_POST['COUNTRYCD']: '';
    $query = $javafunc->getCity($COUNTRYCD, $STATECD, $CITYCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}

function getGMap() {
    $javafunc = new SupplierMaster;
    $SUPPLIERADDR1 = isset($_POST['SUPPLIERADDR1']) ? $_POST['SUPPLIERADDR1']: '';
    $SUPPLIERADDR2 = isset($_POST['SUPPLIERADDR2']) ? $_POST['SUPPLIERADDR2']: '';
    $SUPPLIERZIPCODE = isset($_POST['SUPPLIERZIPCODE']) ? $_POST['SUPPLIERZIPCODE']: '';
    $query = $javafunc->getGMap($SUPPLIERADDR1, $SUPPLIERADDR2, $SUPPLIERZIPCODE);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}

function getBillSupplier() {
    $javafunc = new SupplierMaster;
    $SUPBILLCD = isset($_POST['SUPBILLCD']) ? $_POST['SUPBILLCD']: '';
    $query = $javafunc->getBillSupplier($SUPBILLCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getCurrency() {
    $javafunc = new SupplierMaster;
    $CURRENCYCD = isset($_POST['CURRENCYCD']) ? $_POST['CURRENCYCD']: '';
    $query = $javafunc->getCurrency($CURRENCYCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function insert() {
    $javaInsrt = new SupplierMaster;
    $param = array( 'SUPPLIERCD' => $_POST['SUPPLIERCD'],
                    'SUPPLIERNAME' => isset($_POST['SUPPLIERNAME']) ? $_POST['SUPPLIERNAME']: '',
                    'SUPPLIERSHORTNAME' => isset($_POST['SUPPLIERSHORTNAME']) ? $_POST['SUPPLIERSHORTNAME']: '',
                    'SUPPLIERSEARCH' => isset($_POST['SUPPLIERSEARCH']) ? $_POST['SUPPLIERSEARCH']: '',
                    'SUPPLIERZIPCODE' => isset($_POST['SUPPLIERZIPCODE']) ? $_POST['SUPPLIERZIPCODE']: '',
                    'SUPPLIERADDR1' => isset($_POST['SUPPLIERADDR1']) ? $_POST['SUPPLIERADDR1']: '',
                    'SUPPLIERADDR2' => isset($_POST['SUPPLIERADDR2']) ? $_POST['SUPPLIERADDR2']: '',
                    'SUPPLIERTEL' => isset($_POST['SUPPLIERTEL']) ? $_POST['SUPPLIERTEL']: '',
                    'SUPPLIERFAX' => isset($_POST['SUPPLIERFAX']) ? $_POST['SUPPLIERFAX']: '',
                    'SUPPLIEREMAIL' => isset($_POST['SUPLIERPEMAIL']) ? $_POST['SUPLIERPEMAIL']: '',
                    'SUPPLIERCONTACT' => isset($_POST['SUPPLIERCONTACT']) ? $_POST['SUPPLIERCONTACT']: '',
                    'DIRECTCD' => isset($_POST['DIRECTCD']) ? $_POST['DIRECTCD']: '',
                    'SUPPLIERPWD' => isset($_POST['DIRECTCD']) ? $_POST['DIRECTCD']: '',
                    'SUPPLIERTRANSPORTTYP' => isset($_POST['SUPPLIERTRANSPORTTYP']) ? $_POST['SUPPLIERTRANSPORTTYP']: '',
                    'SUPPLIERAFFILIATEFLG' => isset($_POST['SUPPLIERAFFILIATEFLG']) ? $_POST['SUPPLIERAFFILIATEFLG']: 'F',
                    'SUPPLIERCREDITLIMIT' => isset($_POST['SUPPLIERCREDITLIMIT']) ? $_POST['SUPPLIERCREDITLIMIT']: '',
                    'SUPPLIERCLOSEDAY' => isset($_POST['SUPPLIERCLOSEDAY']) ? $_POST['SUPPLIERCLOSEDAY']: '',
                    'SUPPLIERAMTROUNDTYP' => isset($_POST['SUPPLIERAMTROUNDTYP']) ? $_POST['SUPPLIERAMTROUNDTYP']: '',
                    'SUPPLIERTAXTYP' => isset($_POST['SUPPLIERTAXTYP']) ? $_POST['SUPPLIERTAXTYP']: '',
                    'SUPPLIERTAXROUNDTYP' => isset($_POST['SUPPLIERTAXROUNDTYP']) ? $_POST['SUPPLIERTAXROUNDTYP']: '',
                    'SUPPLIERTAXRATE' => isset($_POST['SUPPLIERTAXRATE']) ? $_POST['SUPPLIERTAXRATE']: '',
                    'CURRENCYCD' => isset($_POST['CURRENCYCD']) ? $_POST['CURRENCYCD']: '',
                    'STAFFCD' => isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '',
                    'SUPBILLCD' => isset($_POST['SUPBILLCD']) ? $_POST['SUPBILLCD']: '',
                    'SUPPLIEREDITYP' => isset($_POST['SUPPLIEREDITYP']) ? $_POST['SUPPLIEREDITYP']: '',
                    'SUPPLIERREGDT' => !empty($_POST['SUPPLIERREGDT']) ? str_replace('-', '', $_POST['SUPPLIERREGDT']): '',                 
                    'SUPPLIERRECDAY' => isset($_POST['SUPPLIERRECDAY']) ? $_POST['SUPPLIERRECDAY']: '',
                    'SUPPLIEROFFFLG' => isset($_POST['SUPPLIEROFFFLG']) ? $_POST['SUPPLIEROFFFLG']: 'F',
                    'SUPPLIERTRANSFERFLG' => isset($_POST['SUPPLIERTRANSFERFLG']) ? $_POST['SUPPLIERTRANSFERFLG']: 'F',
                    'BANKBRANCHCD' => isset($_POST['BANKBRANCHCD']) ? $_POST['BANKBRANCHCD']: '',
                    'SUPPLIERBKACCTYP' => isset($_POST['SUPPLIERBKACCTYP']) ? $_POST['SUPPLIERBKACCTYP']: '',
                    'SUPPLIERBKACCNO' => isset($_POST['SUPPLIERBKACCNO']) ? $_POST['SUPPLIERBKACCNO']: '',
                    'SUPPLIERBKACCNAME' => isset($_POST['SUPPLIERBKACCNAME']) ? $_POST['SUPPLIERBKACCNAME']: '',
                    'SUPPLIERREMARK' => isset($_POST['SUPPLIERREMARK']) ? $_POST['SUPPLIERREMARK']: '',
                    'SUPPLIERUNITROUNDTYP' => isset($_POST['SUPPLIERUNITROUNDTYP']) ? $_POST['SUPPLIERUNITROUNDTYP']: '',
                    'FACTORYCODE' => isset($_POST['FACTORYCODE']) ? $_POST['FACTORYCODE']: '',
                    'COUNTRYCD' => isset($_POST['COUNTRYCD']) ? $_POST['COUNTRYCD']: '',
                    'STATECD' => isset($_POST['STATECD']) ? $_POST['STATECD']: '',
                    'CITYCD' => isset($_POST['CITYCD']) ? $_POST['CITYCD']: '',
                    'SUPPLIERADD01' => isset($_POST['SUPPLIERADD01']) ? $_POST['SUPPLIERADD01']: '', 
                    'BANKNAME' => isset($_POST['BANKNAME']) ? $_POST['BANKNAME']: '',
                    'BRANCHNAME' => isset($_POST['BRANCHNAME']) ? $_POST['BRANCHNAME']: '');
        // print_r($param);
        $insert = $javaInsrt->insSup($param);
        unsetSessionData();
        echo json_encode($delete);
}

function update() {
    $javaUpd = new SupplierMaster;
    $param = array( 'SUPPLIERCD' => $_POST['SUPPLIERCD'],
                    'SUPPLIERNAME' => isset($_POST['SUPPLIERNAME']) ? $_POST['SUPPLIERNAME']: '',
                    'SUPPLIERSHORTNAME' => isset($_POST['SUPPLIERSHORTNAME']) ? $_POST['SUPPLIERSHORTNAME']: '',
                    'SUPPLIERSEARCH' => isset($_POST['SUPPLIERSEARCH']) ? $_POST['SUPPLIERSEARCH']: '',
                    'SUPPLIERZIPCODE' => isset($_POST['SUPPLIERZIPCODE']) ? $_POST['SUPPLIERZIPCODE']: '',
                    'SUPPLIERADDR1' => isset($_POST['SUPPLIERADDR1']) ? $_POST['SUPPLIERADDR1']: '',
                    'SUPPLIERADDR2' => isset($_POST['SUPPLIERADDR2']) ? $_POST['SUPPLIERADDR2']: '',
                    'SUPPLIERTEL' => isset($_POST['SUPPLIERTEL']) ? $_POST['SUPPLIERTEL']: '',
                    'SUPPLIERFAX' => isset($_POST['SUPPLIERFAX']) ? $_POST['SUPPLIERFAX']: '',
                    'SUPPLIEREMAIL' => isset($_POST['SUPLIERPEMAIL']) ? $_POST['SUPLIERPEMAIL']: '',
                    'SUPPLIERCONTACT' => isset($_POST['SUPPLIERCONTACT']) ? $_POST['SUPPLIERCONTACT']: '',
                    'DIRECTCD' => isset($_POST['DIRECTCD']) ? $_POST['DIRECTCD']: '',
                    'SUPPLIERPWD' => isset($_POST['DIRECTCD']) ? $_POST['DIRECTCD']: '',
                    'SUPPLIERTRANSPORTTYP' => isset($_POST['SUPPLIERTRANSPORTTYP']) ? $_POST['SUPPLIERTRANSPORTTYP']: '',
                    'SUPPLIERAFFILIATEFLG' => isset($_POST['SUPPLIERAFFILIATEFLG']) ? $_POST['SUPPLIERAFFILIATEFLG']: 'F',
                    'SUPPLIERCREDITLIMIT' => isset($_POST['SUPPLIERCREDITLIMIT']) ? $_POST['SUPPLIERCREDITLIMIT']: '',
                    'SUPPLIERCLOSEDAY' => isset($_POST['SUPPLIERCLOSEDAY']) ? $_POST['SUPPLIERCLOSEDAY']: '',
                    'SUPPLIERAMTROUNDTYP' => isset($_POST['SUPPLIERAMTROUNDTYP']) ? $_POST['SUPPLIERAMTROUNDTYP']: '',
                    'SUPPLIERTAXTYP' => isset($_POST['SUPPLIERTAXTYP']) ? $_POST['SUPPLIERTAXTYP']: '',
                    'SUPPLIERTAXROUNDTYP' => isset($_POST['SUPPLIERTAXROUNDTYP']) ? $_POST['SUPPLIERTAXROUNDTYP']: '',
                    'SUPPLIERTAXRATE' => isset($_POST['SUPPLIERTAXRATE']) ? $_POST['SUPPLIERTAXRATE']: '',
                    'CURRENCYCD' => isset($_POST['CURRENCYCD']) ? $_POST['CURRENCYCD']: '',
                    'STAFFCD' => isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '',
                    'SUPBILLCD' => isset($_POST['SUPBILLCD']) ? $_POST['SUPBILLCD']: '',
                    'SUPPLIEREDITYP' => isset($_POST['SUPPLIEREDITYP']) ? $_POST['SUPPLIEREDITYP']: '',
                    'SUPPLIERREGDT' => !empty($_POST['SUPPLIERREGDT']) ? str_replace('-', '', $_POST['SUPPLIERREGDT']): '',                 
                    'SUPPLIERRECDAY' => isset($_POST['SUPPLIERRECDAY']) ? $_POST['SUPPLIERRECDAY']: '',
                    'SUPPLIEROFFFLG' => isset($_POST['SUPPLIEROFFFLG']) ? $_POST['SUPPLIEROFFFLG']: 'F',
                    'SUPPLIERTRANSFERFLG' => isset($_POST['SUPPLIERTRANSFERFLG']) ? $_POST['SUPPLIERTRANSFERFLG']: 'F',
                    'BANKBRANCHCD' => isset($_POST['BANKBRANCHCD']) ? $_POST['BANKBRANCHCD']: '',
                    'SUPPLIERBKACCTYP' => isset($_POST['SUPPLIERBKACCTYP']) ? $_POST['SUPPLIERBKACCTYP']: '',
                    'SUPPLIERBKACCNO' => isset($_POST['SUPPLIERBKACCNO']) ? $_POST['SUPPLIERBKACCNO']: '',
                    'SUPPLIERBKACCNAME' => isset($_POST['SUPPLIERBKACCNAME']) ? $_POST['SUPPLIERBKACCNAME']: '',
                    'SUPPLIERREMARK' => isset($_POST['SUPPLIERREMARK']) ? $_POST['SUPPLIERREMARK']: '',
                    'SUPPLIERUNITROUNDTYP' => isset($_POST['SUPPLIERUNITROUNDTYP']) ? $_POST['SUPPLIERUNITROUNDTYP']: '',
                    'FACTORYCODE' => isset($_POST['FACTORYCODE']) ? $_POST['FACTORYCODE']: '',
                    'COUNTRYCD' => isset($_POST['COUNTRYCD']) ? $_POST['COUNTRYCD']: '',
                    'STATECD' => isset($_POST['STATECD']) ? $_POST['STATECD']: '',
                    'CITYCD' => isset($_POST['CITYCD']) ? $_POST['CITYCD']: '',
                    'SUPPLIERADD01' => isset($_POST['SUPPLIERADD01']) ? $_POST['SUPPLIERADD01']: '', 
                    'BANKNAME' => isset($_POST['BANKNAME']) ? $_POST['BANKNAME']: '',
                    'BRANCHNAME' => isset($_POST['BRANCHNAME']) ? $_POST['BRANCHNAME']: '');      
    // print_r($param);
    $update = $javaUpd->updSup($param);
    unsetSessionData();
    echo json_encode($delete);
}

function delete() {
    $delfunc = new SupplierMaster;
    $SUPPLIERCD = isset($_POST['SUPPLIERCD']) ? $_POST['SUPPLIERCD']: '';
    $delete = $delfunc->delSup($SUPPLIERCD);
    unsetSessionData();
    echo json_encode($delete);
}

function setOldValue() {
    setSessionArray($_POST); 
   // print_r($_POST);
}

function programDelete() {
    $sys = new Syslogic;
    if(isset($_SESSION['APPCODE'])) {
        $sys->ProgramRundelete($_SESSION['APPCODE']);
        $_SESSION['APPCODE'] = '';
    }
}
    
function setSessionArray($arr){
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'SUPPLIERCD', 'SUPPLIERREGDT', 'SUPPLIERNAME', 'SUPPLIERSEARCH', 'SUPPLIERADDR1', 'SUPPLIERADDR2', 'SUPPLIERZIPCODE', 'SUPPLIERTEL', 'SUPPLIERFAX', 'SUPPLIEREMAIL', 'SUPPLIERCONTACT', 'SUPPLIERSHORTNAME', 'FACTORYCODE', 'SUPPLIERADD01', 'COUNTRYCD', 'STATECD', 'CITYCD', 'CITYNAME', 'SUPPLIERCLOSEDAY','SUPPLIERRECDAY', 'SUPPLIEROFFFLG', 'SUPPLIERAFFILIATEFLG', 'CURRENCYCD', 'SUPPLIERUNITROUNDTYP', 'SUPPLIERAMTROUNDTYP', 'SUPPLIERTAXROUNDTYP', 'SUPBILLCD', 'SUPBILLNAME', 'BANKNAME', 'BRANCHNAME', 'SUPPLIERBKACCTYP', 'SUPPLIERBKACCNO', 'SUPPLIERBKACCNAME' ,'SUPPLIERREMARK', 'CURRENCY', 'DIRECTCD', 'DIRECTNAME', 'SUPPLIERPWD', 'CURRENCYDISP', 'SUPPLIERTAXTYP', 'SUPPLIEREDITYP', 'SUPPLIERTAXRATE', 'SUPPLIERCREDITLIMIT', 'SUPPLIERTRANSPORTTYP', 'SUPPLIERTRANSFERFLG', 'GMAPADR', 'ROWCOUNTER', 'USEFLG', 'INS', 'BANKBRANCHCD');
    foreach($arr as $k => $v){
        if(in_array($k, $keepField)) {
            setSessionData($k, $v);
        }
    }
}

function getSessionData($key = '') {
    global $systemName;
    return get_sys_data($systemName, $key);
}

function setSessionData($key, $val) {
    global $systemName;
    return set_sys_data($systemName, $key, $val);
}

function checkSessionData() {
    global $systemName;
    return check_sys_data($systemName);
}

function unsetSessionData($key = '') {
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    return unset_sys_data($key);
}

function setSessionKey($key, $value) {
    global $systemName;
    $_SESSION[$sysnm][$key] = $value;
}

function getDropdownData($key = '') {
    return get_sys_data(SESSION_NAME_DROPDOWN, $key);
}

function setDropdownData($key, $val) {
    return set_sys_data(SESSION_NAME_DROPDOWN, $key, $val);
}

function getSystemData($key = '') {
    return get_sys_data(SESSION_NAME_SYSTEM, $key);
}
  
function setSystemData($key, $val) {
    return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}

function unsetSessionkey($key) {
    global $systemName;
    return unset_sys_key($systemName, $key);
}
?>