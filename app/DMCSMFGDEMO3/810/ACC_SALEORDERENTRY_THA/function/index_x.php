<?php
//--------------------------------------------------------------------------------
//  SESSION
//--------------------------------------------------------------------------------
//  Load Including Files
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
require_once($_SESSION['APPPATH'] . '/include/menubar.php');
require_once($_SESSION['APPPATH'] . '/common/PHPExcel.php');
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
    // require_once(dirname(__FILE__, 2). '/lang/jp.php');
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}

$data = array();
$syslogic = new Syslogic;
$javaFunc = new SalesOrderEntry;
$systemName = strtolower($appcode);
$data['isPrint'] = 'off';
$minrow = 0;
$maxrow = 4;
// https://web-develop.dmcs.biz/boom
// http://acc01.dmcs.biz/
if(!empty($_GET)) {
    if(!empty($_GET['ESTNO'])) {
        unsetSessionData();
        $query = $javaFunc->getEst($_GET['ESTNO']);
        $data = $query;
        if(!empty($query['ESTNO'])) { 
            // print_r($query);
            setSessionData('isPrint', 'on'); 
            $itemlist = $javaFunc->getEstLn($query['ESTNO'], $query['SALEORDERNO']);
            // echo '<pre>';
            // print_r($itemlist);
            // echo '</pre>';
            if(!empty($itemlist)) {
                if(empty($itemlist['ROWNO'])) {
                    for ($i = 1 ; $i <= count($itemlist); $i++) {
                        $data['ITEM'][$i] = $itemlist[$i]; 
                    }
                } else {
                    $data['ITEM'][$itemlist['ROWNO']] = $itemlist; 
                }
            }
        } else { setSessionData('isPrint', 'off'); }
    } else if(!empty($_GET['SALEORDERNO'])) {
        unsetSessionData();
        $query = $javaFunc->getSO($_GET['SALEORDERNO']);
        $data = $query;
        if(!empty($query['SALEORDERNO'])) {
            // print_r($query);
            setSessionData('isPrint', 'on'); 
            $itemlist = $javaFunc->getSOLn($query['SALEORDERNO']);
            // echo '<pre>';
            // print_r($itemlist);
            // echo '</pre>';
            if(!empty($itemlist)) {
                if(empty($itemlist['ROWNO'])) {
                    for ($i = 1 ; $i <= count($itemlist); $i++) {
                        $data['ITEM'][$i] = $itemlist[$i]; 
                    }
                } else {
                    $data['ITEM'][$itemlist['ROWNO']] = $itemlist; 
                }
            }
        } else { setSessionData('isPrint', 'off'); }
    } else if(!empty($_GET['DIVISIONCD'])) {
        $query = $javaFunc->getDivision($_GET['DIVISIONCD']);
        $data['DIVISIONCD'] = $query['DIVISIONCD'];
        $data['DIVISIONNAME'] = $query['DIVISIONNAME'];
    } else if(!empty($_GET['CUSTOMERCD'])) {
        $query = $javaFunc->getCustomer($_GET['CUSTOMERCD']);
        $data = $query;
        $data['QUOTEAMOUNT'] = '0.00';
        $data['VATAMOUNT'] = '0.00';
        $data['VATAMOUNT1'] = '0.00';
        $data['T_AMOUNT'] = '0.00';
    } else if(!empty($_GET['STAFFCD'])) {
        $query = $javaFunc->getStaff($_GET['STAFFCD']);
        $data['STAFFCD'] = $query['STAFFCD'];
        $data['STAFFNAME'] = $query['STAFFNAME'];
    } else if(!empty($_GET['CUSCURCD'])) {
        $query = $javaFunc->getCurrency($_GET['CUSCURCD']);
        $data['CUSCURCD'] = $query['CUSCURCD'];
        $data['CUSCURDISP'] = $query['CUSCURCD'];
    }

    if(!empty($query)) {
        setSessionArray($data); 
    }
    if(checkSessionData()) { $data = getSessionData(); }

    if(!empty($_GET['ITEMCD'])) {
        // print_r($data);
        $Param = array( "CUSCURCD" => isset($data['CUSCURCD']) ? $data['CUSCURCD']: '',
                        "ITEMCD" => isset($_GET['ITEMCD']) ? $_GET['ITEMCD']: '',
                        "CUSTOMERCD" => isset($data['CUSTOMERCD']) ? $data['CUSTOMERCD']: '',
                        "SALELNQTY" => '',
                        "DISCRATE" => '',
                        "UNITPRICE" => '',
                        "VATRATE" => isset($data['VATRATE']) ?  $data['VATRATE']: '');
        // print_r($Param);
        $item_data = $javaFunc->getItem($Param);
        // echo '<pre>';
        // print_r($item_data);
        // echo '</pre>';
        // $data['ITEM'][$_GET['index']] = $item_data;
        $data['ITEM'][$_GET['index']] = array(  'ROWNO' => $_GET['index'],
                                                'ITEMCD' => $item_data['ITEMCD'],
                                                'ITEMNAME' => $item_data['ITEMNAME'],
                                                'SALELNQTY' => isset($item_data['SALELNQTY']) ? $item_data['SALELNQTY']: '0.00',
                                                'ITEMUNITTYP' => $item_data['ITEMUNITTYP'],
                                                'SALELNUNITPRC' => isset($item_data['SALELNUNITPRC']) ? $item_data['SALELNUNITPRC']: '0.00',
                                                'SALELNDISCOUNT' => isset($item_data['SALELNDISCOUNT']) ? $item_data['SALELNDISCOUNT']: '0.00',
                                                'SALELNAMT' => isset($item_data['SALELNAMT']) ? $item_data['SALELNAMT']: '0.00',
                                                'SALELNDISCOUNT2' => $item_data['SALELNDISCOUNT2'],
                                                'SALELNTAXAMT' => isset($item_data['SALELNTAXAMT']) ? $item_data['SALELNTAXAMT']: '0.00');
        // echo '<pre>';
        // print_r($data['ITEM']);
        // echo '</pre>';
        // $data['ITEM'] = array_combine(range(1, count($data['ITEM'])), array_values($data['ITEM']));
        // print_r($data['ITEM']);
        if(!empty($item_data)) {
            setSessionArray($data);
        }
    }
    // print_r($data);
}

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'unsetsession') { unsetSessionData(); }
    if ($_POST['action'] == 'unsetsessionItem') {  unsetSesstionItem($_POST['lineIndex']); }
    if ($_POST['action'] == 'keepdata') { setOldValue(); }
    if ($_POST['action'] == 'keepItemData') { setItemValue(); }
    if ($_POST['action'] == 'getAmt') { getAmt(); }
    if ($_POST['action'] == 'commit') { commit(); }
    if ($_POST['action'] == 'cancel') { cancel(); }
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
$branchkbn = $data['DRPLANG']['BRANCH_KBN'];
// setSessionArray($data);
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//
function commit() {
    $cmtfunc = new SalesOrderEntry;
    for ($i = 0 ; $i < count($_POST['ITEMCD']); $i++) { 
        $RowParam[] = array('ROWNO' => $i+1,
                            'ITEMCD' => $_POST['ITEMCD'][$i],
                            'ITEMNAME' => $_POST['ITEMNAME'][$i],
                            'SALELNQTY' => isset($_POST['SALELNQTY'][$i]) ? implode(explode(',', $_POST['SALELNQTY'][$i])): '0.00',
                            'ITEMUNITTYP' => $_POST['ITEMUNITTYP'][$i],
                            'SALELNUNITPRC' => isset($_POST['SALELNUNITPRC'][$i]) ? implode(explode(',', $_POST['SALELNUNITPRC'][$i])): '0.00',
                            'SALELNDISCOUNT' => isset($_POST['SALELNDISCOUNT'][$i]) ? implode(explode(',', $_POST['SALELNDISCOUNT'][$i])): '0.00',
                            'SALELNAMT' => isset($_POST['SALELNAMT'][$i]) ? implode(explode(',', $_POST['SALELNAMT'][$i])): '0.00',
                            'SALELNDISCOUNT2' => $_POST['SALELNDISCOUNT2'][$i],
                            'SALELNTAXAMT' => isset($_POST['SALELNTAXAMT'][$i]) ? implode(explode(',', $_POST['SALELNTAXAMT'][$i])): '0.00');
    }
    // print_r($RowParam);
    $param = array( "ESTNO" => $_POST['ESTNO'],
                    "SALEISSUEDT" => str_replace("-", "", $_POST['SALEISSUEDT']),
                    "SALEORDERNO" => $_POST['SALEORDERNO'],
                    "DIVISIONCD" => $_POST['DIVISIONCD'],
                    "CUSTOMERCD" => $_POST['CUSTOMERCD'],
                    "ESTCUSTEL" => $_POST['ESTCUSTEL'],
                    "ESTCUSFAX" => $_POST['ESTCUSFAX'],
                    "STAFFCD" => $_POST['STAFFCD'],
                    "ESTCUSSTAFF" => $_POST['ESTCUSSTAFF'],
                    "ESTDLVCON1" => $_POST['ESTDLVCON1'],
                    "ESTDLVCON2" => $_POST['ESTDLVCON2'],
                    "ESTREM1" => $_POST['ESTREM1'],
                    "ESTREM2" => $_POST['ESTREM2'],
                    "ESTREM3" => $_POST['ESTREM3'],
                    "CUSCURCD" => $_POST['CUSCURCD'],
                    "SALECUSMEMO" => $_POST['SALECUSMEMO'],
                    "SALEDIVCON1" => $_POST['SALEDIVCON1'],
                    "SALEDIVCON2" => $_POST['SALEDIVCON2'],
                    "SALEDIVCON3" => $_POST['SALEDIVCON3'],
                    "SALEDIVCON4" => $_POST['SALEDIVCON4'],
                    "SALELNDUEDT" => str_replace("-", "", $_POST['SALELNDUEDT']),
                    "S_TTL" => isset($_POST['S_TTL']) ? implode(explode(',', $_POST['S_TTL'])): '0.00',
                    "DISCRATE" => $_POST['DISCRATE'],
                    "DISCOUNTAMOUNT" => isset($_POST['DISCOUNTAMOUNT']) ? implode(explode(',', $_POST['DISCOUNTAMOUNT'])): '0.00',
                    "QUOTEAMOUNT" => isset($_POST['QUOTEAMOUNT']) ? implode(explode(',', $_POST['QUOTEAMOUNT'])): '0.00',
                    "VATRATE" => $_POST['VATRATE'],
                    "VATAMOUNT" => isset($_POST['VATAMOUNT']) ? implode(explode(',', $_POST['VATAMOUNT'])): '0.00',
                    "VATAMOUNT1" => isset($_POST['VATAMOUNT1']) ? implode(explode(',', $_POST['VATAMOUNT1'])): '0.00',
                    "T_AMOUNT" => isset($_POST['T_AMOUNT']) ? implode(explode(',', $_POST['T_AMOUNT'])): '0.00',
                    'DATA' => $RowParam);
    // print_r($param);
    $commit = $cmtfunc->commit($param);
    unsetSessionData();
    echo json_encode($commit);
}

function printed() {
    global $data;
    $data = getSessionData();
    $printfunc = new SalesOrderEntry;
    if(!empty($data['SALEORDERNO'])) {
        $param = array( "SALEORDERNO" => $data['SALEORDERNO'],
                        "SALEISSUEDT" => str_replace("-", "", $data['SALEISSUEDT']),
                        "SALELNDUEDT" => str_replace("-", "", $data['SALELNDUEDT']),
                        "STAFFNAME" => $data['STAFFNAME'],
                        "CUSTOMERCD" => $data['CUSTOMERCD'],
                        "SALECUSMEMO" => $data['SALECUSMEMO'],
                        "ESTCUSSTAFF" => $data['ESTCUSSTAFF'],
                        "SALEDIVCON4" => $data['SALEDIVCON4'],
                        "SALEDIVCON1" => $data['SALEDIVCON1'],
                        "SALEDIVCON2" => $data['SALEDIVCON2'],
                        "SALEDIVCON3" => $data['SALEDIVCON3'],
                        "ESTCUSTEL" => $data['ESTCUSTEL'],
                        "ESTCUSFAX" => $data['ESTCUSFAX'],
                        "CUSCURDISP" => $data['CUSCURDISP']);
        $print = $printfunc->printStatic($param);
        $prints = $printfunc->printDynamic($data['SALEORDERNO']);
        $data = $print;
        // print_r($print);
        // print_r($prints);
        if(!empty($prints)) {
            if(empty($prints['ROWCOUNTER'])) {
                for ($i = 1 ; $i < count($prints)+1; $i++) {
                    $data['ITEMPRINT'][$i] = $prints[$i]; 
                }
            } else {
                $data['ITEMPRINT'][$prints['ROWCOUNTER']] = $prints; 
            }
        }
        setSessionArray($data);
        $data = getSessionData();
    }
    // echo "<pre>";
    // print_r($data);
    // echo "</pre>";
}

function cancel() {
    $cancelfunc = new SalesOrderEntry;
    $cancel = $cancelfunc->cancel($_POST['SALEORDERNO']);
    unsetSessionData();
}

function getAmt() {
    global $data;
    $amtfunc = new SalesOrderEntry;
    $data = getSessionData();
    $Param = array( "SALELNQTY" => 2,
                    "SALELNUNITPRC" =>  2000,
                    "SALELNDISCOUNT" =>  0,
                    "CUSCURCD" => $data['CUSCURCD'],
                    "DISCRATE" => $data['DISCRATE'],
                    "VATRATE" => $data['VATRATE'],
                    "CUSTOMERCD" => $data['CUSTOMERCD']);
    $amt = $amtfunc->getAmt($Param);
    // print_r($amt['SALELNAMT']);
    // print_r($amt['SALELNDISCOUNT2']);
    // print_r($amt['SALELNTAXAMT']);
}

function setOldValue() {
    setSessionArray($_POST); 
    // print_r($_POST);
}

function setItemValue() {
    global $data;
    for ($i = 0 ; $i < count($_POST['ITEMCD']); $i++) { 
        $data['ITEM'][$i+1] = array('ITEMCD' => $_POST['ITEMCD'][$i],
                                    'ITEMNAME' => $_POST['ITEMNAME'][$i],
                                    'SALELNQTY' => $_POST['SALELNQTY'][$i],
                                    'ITEMUNITTYP' => $_POST['ITEMUNITTYP'][$i],
                                    'SALELNUNITPRC' => $_POST['SALELNUNITPRC'][$i],
                                    'SALELNDISCOUNT' => $_POST['SALELNDISCOUNT'][$i],
                                    'SALELNAMT' => $_POST['SALELNAMT'][$i],
                                    'SALELNDISCOUNT2' => $_POST['SALELNDISCOUNT2'][$i],
                                    'SALELNTAXAMT' => $_POST['SALELNTAXAMT'][$i]);
    }
    setSessionArray($data);
    // print_r($data['ITEM']);
}

/// add session data of item 
function setSessionArray($arr){
    $keepField = array( "ESTNO", "DIVISIONCD", "DIVISIONNAME", "SALEISSUEDT", "CUSTOMERCD", "BRANCHKBN", "TAXID", "CUSCURCD", "CUSTOMERNAME", "SALEORDERNO", 
                        "SALECUSMEMO", "SALEDIVCON4", "SALELNDUEDT", "CUSTADDR1", "CUSTADDR2", "ESTCUSSTAFF", "ESTCUSTEL", "ESTCUSFAX", "STAFFCD", "STAFFNAME", 
                        "ESTDLVCON1", "ESTDLVCON2", "ITEM", "isPrint", "CUSCURDISP", "ESTREM1", "ESTREM2", "ESTREM3", "S_TTL", "DISCRATE", "DISCOUNTAMOUNT", 
                        "QUOTEAMOUNT", "VATRATE", "VATAMOUNT", "VATAMOUNT1", "T_AMOUNT", "SYSMSG", "SYSVIS_CANCELLBL", "SUB", "LDIS", "AFDIS", "TOT", "TVAT",
                        "ROWCOUNTER", "COMPNTH", "COMPNEN", "ADDR1", "ADDR2", "TELTH", "FAXTH", "ADDREN1", "ADDREN2", "TELO", "FAXO", "ATNAME", "PONUM", "SHDATE", "SLMAN",
                        "CUSN", "ADDR10", "ADDR20", "CTEL", "CFAX", "QONUM", "TDATE", "PAYTERM", "PRVALID", "QOBY", "REM1", "REM2", "REM3", "CUR", "ITEMPRINT", "CADDR1", "CADDR2", "SONUM",
                        "SYSPVL", "TXTLANG", "DRPLANG", "SALEDIVCON1", "SALEDIVCON2", "SALEDIVCON3", "DEPT", "DES", "CDEPT", "ANUM", "ADDR", "CTAXID", "REF", "SHV",
                    );
                    
    foreach($arr as $k => $v){
        if(in_array($k, $keepField)) {
            setSessionData($k, $v);
        }
    }
}

function getSessionData($key = "") {
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

function unsetSessionData($key = "") {
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    return unset_sys_data($key);
}

function unsetSessionkey($key) {
    global $systemName;
    $sysnm = empty($sysnm) ? $systemName : $sysnm;
    return unset_sys_key($sysnm, $key);
}

function unsetSesstionItem($lineIndex = "") {
    // unset($_SESSION['SalesOrderEntry']['ITEM'][$lineIndex]);
    global $systemName;
    global $data;
    $key = empty($key) ? $systemName : $key;
    unset_sys_array($key, 'ITEM', $lineIndex);
    $data = getSessionData();
    // print_r(count($data['ITEM']));
    $data['ITEM'] = array_combine(range(1, count($data['ITEM'])), array_values($data['ITEM']));
    setSessionArray($data);
}

function getSystemData($key = "") {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}
?>