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
$syslogic = new Syslogic;
$javaFunc = new UnitConversionMaster;
$systemName = strtolower($appcode);

if(!empty($_GET)) {
    // 
}

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'UNITFROM' || $_POST['action'] == 'UNITTO') { getRate(); }
    if ($_POST['action'] == 'INSERT') { insRate(); }
    if ($_POST['action'] == 'UPDATE') { updRate(); }
    if ($_POST['action'] == 'DELETE') { delRate(); }
}

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
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
// $load = $javaFunc->load();
$UNIT = $data['DRPLANG']['UNIT'];
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
function getRate() {
    $javafunc = new UnitConversionMaster;
    $UNITFROM = isset($_POST['UNITFROM']) ? $_POST['UNITFROM']: '';
    $UNITTO = isset($_POST['UNITTO']) ? $_POST['UNITTO']: '';
    $getRate = $javafunc->getRate($UNITFROM, $UNITTO);
    echo json_encode($getRate);
}

function insRate() {
    $javaRun = new UnitConversionMaster;
    $param = array( 'UNITFROM' => isset($_POST['UNITFROM']) ? $_POST['UNITFROM']: '',
                    'UNITTO' => isset($_POST['UNITTO']) ? $_POST['UNITTO']: '',
                    'RATE' => isset($_POST['RATE']) ? str_replace(',', '', $_POST['RATE']): '');
    $insRate = $javaRun->insRate($param);
    // print_r($param);
    echo json_encode($insRate);
}

function updRate() {
    $javaRun = new UnitConversionMaster;
    $param = array( 'UNITFROM' => isset($_POST['UNITFROM']) ? $_POST['UNITFROM']: '',
                    'UNITTO' => isset($_POST['UNITTO']) ? $_POST['UNITTO']: '',
                    'RATE' => isset($_POST['RATE']) ? str_replace(',', '', $_POST['RATE']): '');
    $updRate = $javaRun->updRate($param);
    // print_r($param);
    echo json_encode($updRate);
}

function delRate() {
    $javaRun = new UnitConversionMaster;
    $param = array( 'UNITFROM' => isset($_POST['UNITFROM']) ? $_POST['UNITFROM']: '',
                    'UNITTO' => isset($_POST['UNITTO']) ? $_POST['UNITTO']: '',
                    'RATE' => isset($_POST['RATE']) ? str_replace(',', '', $_POST['RATE']): '');
    $delRate = $javaRun->delRate($param);
    // print_r($param);
    echo json_encode($delRate);
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
?>
