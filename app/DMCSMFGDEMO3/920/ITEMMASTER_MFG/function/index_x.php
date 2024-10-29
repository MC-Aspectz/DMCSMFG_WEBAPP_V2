<?php
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
require_once($_SESSION['APPPATH'] . '/common/syslogic.php');
require_once($_SESSION['APPPATH'] . '/include/menubar.php');
//--------------------------------------------------------------------------------
//  Pack Code & Name, Application Code & Name
//--------------------------------------------------------------------------------
// $arydirname = explode("\\", dirname(__FILE__));  // for localhost
$arydirname = explode("/", dirname(__FILE__));  // for web
$appcode = $arydirname[array_key_last($arydirname) - 1];
$packcode = $arydirname[array_key_last($arydirname) - 2];
if ($_SESSION['MENU'] != "" and is_array($_SESSION['MENU'])) {
    // Get Pack Name
    $packname = "";
    foreach($_SESSION['MENU'] as $menuitem) {
        if ($menuitem['NODEDATA'] == $packcode) {
            $packname = $menuitem['NODETITLE'];
            break;  // foreach($_SESSION['MENU'] as $menuitem) {
        }  // if ($menuitem['NODEDATA'] == $packcode) {
    }  // foreach($_SESSION['MENU'] as $menuitem) {
    // Get Application Name
    $appname = "";
    foreach($_SESSION['MENU'] as $menuitem) {
        if ($menuitem['NODEDATA'] == $appcode) {
            $appname = $menuitem['NODETITLE'];
            break;  // foreach($_SESSION['MENU'] as $menuitem) {
        }  // if ($menuitem['NODEDATA'] == $appcode) {
    }  // foreach($_SESSION['MENU'] as $menuitem) {
}
$_SESSION['PACKCODE'] = $packcode;
$_SESSION['PACKNAME'] = $packname;
$_SESSION['APPCODE'] = $appcode;
$_SESSION['APPNAME'] = $appname; 
 // if ($_SESSION['MENU'] != "" and is_array($_SESSION['MENU'])) {
# print_r($_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php');
//--------------------------------------------------------------------------------
// No This Application in Menu (Unauthorized Application)
if ($appname == "") {
    // header("Location:home.php");
    // header("Location:".(isset($_SERVER['HTTPS']) ? 'https' : 'http') . "://" . $_SERVER['HTTP_HOST'] . "/" . "DMCS_WEBAPP"."/home.php");
    header("Location:".(isset($_SERVER['HTTPS']) ? 'https' : 'http') . "://" . $_SERVER['HTTP_HOST'] . "/" . $arydirname[array_key_last($arydirname) - 5]."/home.php");
}  // if ($appname == "") {
//--------------------------------------------------------------------------------
$syslogic = new Syslogic;
if(isset($_SESSION['APPCODE'])) {
    $_SESSION['PACKCODE'] = $packcode;
    $_SESSION['PACKNAME'] = $packname;
    $_SESSION['APPCODE'] = $appcode;
    $_SESSION['APPNAME'] = $appname;
}
// if(isset($_SESSION['APPCODE']) { else {
//--------------------------------------------------------------------------------
// LANGUAGE
//--------------------------------------------------------------------------------
// print_r($_SESSION['LANG']);
if (isset($_SESSION['LANG'])) {
    // require_once(dirname(__FILE__, 2). '/lang/jp.php');
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2).'/lang/en.php');
}
$filetype = 'image';
$itemtype = 'itemmaster';
$pathApp = dirname(__FILE__, 6);
$systemName = strtolower($appcode);
$data = array();

// ----  GET --------//
if(!empty($_GET)) {
    $javaFunc = new ItemMaster;
    if(!empty($_GET['ITEMCD'])) {
        $query = $javaFunc->getItem($_GET['ITEMCD']);
        $data = $query;
        // echo '<pre>';
        // print_r($query);
        // echo '</pre>';
        if(!empty($query)) { setSessionData('isInsert', 'off'); } else { setSessionData('isInsert', 'on'); }
        // if(!empty($data)) { setSessionArray($data); } // else { unsetSessionData(); }
    } else if(!empty($_GET['CATALOGCD'])) {
        $query = $javaFunc->getCategory($_GET['CATALOGCD']);
        $data['CATALOGCD'] = isset($query['CATALOGCD']) ? $query['CATALOGCD'] : '';
        $data['CATALOGNAME'] = isset($query['CATALOGNAME']) ? $query['CATALOGNAME'] : '';
    } else if(!empty($_GET['suppliercd'])) {
        $query = $javaFunc->getSupplier($_GET['suppliercd']);
        $data['SUPPLIERCD'] = isset($query['SUPPLIERCD']) ? $query['SUPPLIERCD'] : '';
        $data['SUPPLIERNAME'] = isset($query['SUPPLIERNAME']) ? $query['SUPPLIERNAME'] : '';
    } else if(!empty($_GET['STORAGECD'])) {
        $query = $javaFunc->getLocation($_GET['STORAGECD']);
        $data['STORAGECD'] = isset($query['STORAGECD']) ? $query['STORAGECD'] : '';
        $data['STORAGENAME'] = isset($query['STORAGENAME']) ? $query['STORAGENAME'] : '';
    } else if(!empty($_GET['divisioncd'])) {
        $query = $javaFunc->getWc($_GET['divisioncd']);
        $data['WCCD'] = isset($query['WCCD']) ? $query['WCCD'] : '';
        $data['WCNAME'] = isset($query['WCNAME']) ? $query['WCNAME'] : '';
    } else if(!empty($_GET['MATERIALCD'])) {
        $query = $javaFunc->getMat($_GET['MATERIALCD']);
        $data['MATERIALCD'] = isset($query['MATERIALCD']) ? $query['MATERIALCD'] : '';
        $data['MATERIALNAME'] = isset($query['MATERIALNAME']) ? $query['MATERIALNAME'] : '';
    }

    if(!empty($query)) {
        setSessionArray($data); 
        // if(checkSessionData()) { $data = getSessionData(); } 
    }

    if(checkSessionData()) { $data = getSessionData(); }
}
// -------------------------------------------------//
// ----  POST --------//
if (isset($_POST['action'])) {
    if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
    if ($_POST['action'] == "keepdata") { setOldValue(); }
    if ($_POST['action'] == "insert") { insert(); }
    if ($_POST['action'] == "update") { update(); }
    if ($_POST['action'] == "delete") { delete(); }
    if ($_POST['action'] == "programDelete") { programDelete(); }
}
// -------------------------------------------------//
// if (isset($_POST['insert'])) { insert(); }
// if (isset($_POST['update'])) { update(); }
// if (isset($_POST['delete'])) { delete(); }

// ------------------------- CALL Langauge AND Privilege -------------------//
$syspvl = getSystemData($_SESSION['APPCODE']."_PVL");
if(empty($syspvl)) {
    $syspvl = $syslogic->setPrivilege($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE']."_PVL", $syspvl);
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
$typeItem = $data['DRPLANG']['ITEM_TYPE'];
$typeboi = $data['DRPLANG']['BOI_TYPE'];
$whtaxtyp = $data['DRPLANG']['WHTAXTYP'];
$unit = $data['DRPLANG']['UNIT'];
$itemOrder = $data['DRPLANG']['ITEM_ORDER'];
$invcalc = $data['DRPLANG']['INVCALC_TYPE'];
$package = $data['DRPLANG']['PACKAGE_TYPE'];
$maker = $data['DRPLANG']['MAKER'];
$costname = $data['DRPLANG']['COST_NAME'];
$clearance = $data['DRPLANG']['CLEARANCE'];
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//
function insert() {
    $insfunc = new ItemMaster;
    // --------------------------------------------------
    global $pathApp, $filetype, $itemtype;
    if($_FILES['ITEMIMGLOC']['error'] != 4) {
        $target_dir = $pathApp.'/storage/'.$_SESSION['COMCD'].'/'.$filetype.'/'.$itemtype.'/';
        if(!file_exists($target_dir)) {
            $old = umask(0);
            $mk = mkdir($target_dir, 0755, true);
            umask($old);
            if (!$mk) { chmod($target_dir, 0755); }
        }
        $typefile = strtolower(pathinfo(basename($_FILES['ITEMIMGLOC']['name']), PATHINFO_EXTENSION));
        $filename = isset($_POST['ITEMCD']) ? $_POST['ITEMCD'].'.'.$typefile: basename($_FILES['ITEMIMGLOC']['name']);
        $target_file = $target_dir.$filename;
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES['ITEMIMGLOC']['tmp_name']);
        if($check !== false) { move_uploaded_file($_FILES['ITEMIMGLOC']['tmp_name'], $target_file); }
        $ITEMIMGLOC = '/storage/'.$_SESSION['COMCD'].'/'.$filetype.'/'.$itemtype.'/'.$filename;
    } else {
        $ITEMIMGLOC = isset($_POST['ITEMIMGLOC']) ? $_POST['ITEMIMGLOC']: '';
    }
    // --------------------------------------------------
    $param = array( "ITEMCD" => $_POST['ITEMCD'],
                    "ITEMSEARCH" => $_POST['ITEMSEARCH'],
                    "ITEMNAME" => $_POST['ITEMNAME'],
                    "ITEMSPEC" => $_POST['ITEMSPEC'],
                    "ITEMDRAWNO" => isset($_POST['ITEMDRAWNO']) ? $_POST['ITEMDRAWNO']: '',
                    "ITEMDOC" => '',
                    "MATERIALCD" => $_POST['MATERIALCD'],//
                    "ACCOUNTCD" => '',
                    "DIVISIONCD" => '',
                    "ITEMTAXTYP" => '',
                    "ITEMTAXRATE" => '',
                    "ITEMPACKTYP" => $_POST['ITEMPACKTYP'],//
                    "ITEMQTYINCASE" => $_POST['ITEMQTYINCASE'],//
                    "ITEMCOSTTYP" => $_POST['ITEMCOSTTYP'],//
                    "ITEMPSSTIME" => '',
                    "ITEMWEIGHT" => $_POST['ITEMWEIGHT'],//
                    "WCCD" => $_POST['WCCD'],//
                    "ITEMWHTTYP" => $_POST['ITEMWHTTYP'],
                    "ITEMTYP" => $_POST['ITEMTYP'],
                    "CATALOGCD" => $_POST['CATALOGCD'],
                    "ITEMUNITTYP" => $_POST['ITEMUNITTYP'],
                    "ITEMLEADTIME" => $_POST['ITEMLEADTIME'],
                    "ITEMORDRULETYP" => $_POST['ITEMORDRULETYP'],
                    "STORAGECD" => $_POST['STORAGECD'],
                    "SUPPLIERCD" => $_POST['SUPPLIERCD'],
                    "ITEMINVPRICE" => $_POST['ITEMINVPRICE'],//
                    "ITEMSHOPPRICE" => $_POST['ITEMSHOPPRICE'],//
                    "ITEMSTDPURPRICE" => $_POST['ITEMSTDPURPRICE'],//
                    "ITEMMINSTOCK" => $_POST['ITEMMINSTOCK'],//
                    "ITEMFIXORDER" => $_POST['ITEMFIXORDER'],//
                    "ITEMMINORDER" => $_POST['ITEMMINORDER'],//
                    "ITEMFIFOLISTFLG" => isset($_POST['ITEMFIFOLISTFLG']) ? $_POST['ITEMFIFOLISTFLG']:'F',
                    "ITEMBOI" => $_POST['ITEMBOI'],
                    "ITEMINVCALCTYP" => $_POST['ITEMINVCALCTYP'],
                    "ITEMPOUNITTYP" => $_POST['ITEMPOUNITTYP'],
                    // "ITEMPOUNITRATE" => isset($_POST['ITEMPOUNITRATE']) ? $_POST['ITEMPOUNITRATE']:'0',
                    "ITEMEDIFLG" => 'F',
                    "ITEMSERIALLFLG" => isset($_POST['ITEMSERIALLFLG']) ? $_POST['ITEMSERIALLFLG']:'F',//
                    "ITEMMASTERPLANFLG" => isset($_POST['ITEMMASTERPLANFLG']) ? $_POST['ITEMMASTERPLANFLG']:'F',//
                    "ITEMAGREEPRICEFLG" => 'F',
                    "ITEMINVFLG" => isset($_POST['ITEMINVFLG']) ? $_POST['ITEMINVFLG']:'F',//
                    "ITEMPHANTOMFLG" => isset($_POST['ITEMINVFLG']) ? $_POST['ITEMINVFLG']:'F',//
                    "ITEMBULKFLG" => 'F',
                    "ITEMSPECIALFLG" => 'F',
                    "ITEMPURADDDAY" => '0',
                    "ITEMINSPTYP" => '0',
                    "ITEMSTDSALEPRICE" => $_POST['ITEMSTDSALEPRICE'],//
                    "ITEMSTDSUPPLYPRICE" => $_POST['ITEMSTDSUPPLYPRICE'],//
                    "ITEMABC" => '',
                    "ITEMMARKETPRICE" => '',
                    "ITEMUNITPRICETYP" => '',
                    "ITEMCLEARANCETYP" => $_POST['ITEMCLEARANCETYP'],//
                    "ITEMPURGRPTYP" => '',
                    "ITEMSTOPDT" => isset($_POST['ITEMSTOPDT']) ? str_replace('-', '', $_POST['ITEMSTOPDT']) : '',//
                    "ITEMALTERFLG" => 'F',
                    "ITEMPAINTIN" => '',
                    "ITEMPAINTOUT" => '',
                    "ITEMMAXSTOCK" => '',
                    "ITEMORDERUNIT" => $_POST['ITEMORDERUNIT'],//
                    "ITEMBADRATE" => '',
                    "ITEMSALEDT" => '',
                    "ITEMINSPADDDAY" => '',
                    "AUTOINSPCD" => '',
                    "ITEMCOSTMETHODFLG" => 'F',
                    "ITEMADDNOTE1FLG" => '',
                    "ITEMADDNOTE2FLG" => '',
                    "ITEMADDNOTE3FLG" => '',
                    "ITEMADDNOTE4FLG" => '',
                    "ITEMADDTANABAN" => '',
                    "ITEMIMGLOC" => $ITEMIMGLOC,
                    "ITEMCATEGORY" => '',
                    "ITEMSUBCATEGORY" => '',
                    "ITEMMULTIPURCHASETYP" => '',
                    "ITEMRLTYP" => '',
                    "ITEMCOLORCD" => '',
                    "ITEMTAGCD1" => '',
                    "ITEMTAGCD2" => '',
                    "ITEMTAGCD3" => '',
                    "ITEMINSPECTMCCD" => '',
                    "ITEMLOCATEBODY" => '',
                    "ITEMCARTYP" => '',
                    "ITEMSPEC1" => '',
                    "ITEMSPEC2" => '',
                    "ITEMSPEC3" => '',
                    "ITEMSPEC4" => '',
                    "ITEMSPEC5" => '',
                    "ITEMSPEC6" => '',
                    "ITEMCASEFLG" => 'F',
                    "ITEMREM" => '',
                    "ITEMWITHDRAWTYP" => '',
                    "CUSTOMERCD" => '',
                    "ITEMTAXCLASSCD" => 'J01',
                    "ITEMMAKERTYP" => $_POST['ITEMMAKERTYP'],//
                );
    // print_r($param);
    $insert = $insfunc->insert($param);
    echo json_encode($insert);
    unsetSessionData();
}

function update() {
    $updfunc = new ItemMaster;
    // --------------------------------------------------
    global $pathApp, $filetype, $itemtype;
    if($_FILES['ITEMIMGLOC']['error'] != 4) {
        $target_dir = $pathApp.'/storage/'.$_SESSION['COMCD'].'/'.$filetype.'/'.$itemtype.'/';
        if(!file_exists($target_dir)) {
            $old = umask(0);
            $mk = mkdir($target_dir, 0755, true);
            umask($old);
            if (!$mk) { chmod($target_dir, 0755); }
        }
        $typefile = strtolower(pathinfo(basename($_FILES['ITEMIMGLOC']['name']), PATHINFO_EXTENSION));
        $filename = isset($_POST['ITEMCD']) ? $_POST['ITEMCD'].'.'.$typefile: basename($_FILES['ITEMIMGLOC']['name']);
        $target_file = $target_dir.$filename;
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES['ITEMIMGLOC']['tmp_name']);
        if($check !== false) { move_uploaded_file($_FILES['ITEMIMGLOC']['tmp_name'], $target_file); }
        $ITEMIMGLOC = '/storage/'.$_SESSION['COMCD'].'/'.$filetype.'/'.$itemtype.'/'.$filename;
    } else {
        $ITEMIMGLOC = isset($_POST['OLDITEMIMGLOC']) ? $_POST['OLDITEMIMGLOC']: '';
    }
    // --------------------------------------------------
    $param = array( "ITEMCD" => $_POST['ITEMCD'],
                    "ITEMSEARCH" => $_POST['ITEMSEARCH'],
                    "ITEMNAME" => $_POST['ITEMNAME'],
                    "ITEMSPEC" => $_POST['ITEMSPEC'],
                    "ITEMDRAWNO" => isset($_POST['ITEMDRAWNO']) ? $_POST['ITEMDRAWNO']: '',
                    "ITEMDOC" => '',
                    "MATERIALCD" => $_POST['MATERIALCD'],//
                    "ACCOUNTCD" => '',
                    "DIVISIONCD" => '',
                    "ITEMTAXTYP" => '',
                    "ITEMTAXRATE" => '',
                    "ITEMPACKTYP" => $_POST['ITEMPACKTYP'],//
                    "ITEMQTYINCASE" => $_POST['ITEMQTYINCASE'],//
                    "ITEMCOSTTYP" => $_POST['ITEMCOSTTYP'],//
                    "ITEMPSSTIME" => '',
                    "ITEMWEIGHT" => $_POST['ITEMWEIGHT'],//
                    "WCCD" => $_POST['WCCD'],//
                    "ITEMWHTTYP" => $_POST['ITEMWHTTYP'],
                    "ITEMTYP" => $_POST['ITEMTYP'],
                    "CATALOGCD" => $_POST['CATALOGCD'],
                    "ITEMUNITTYP" => $_POST['ITEMUNITTYP'],
                    "ITEMLEADTIME" => $_POST['ITEMLEADTIME'],
                    "ITEMORDRULETYP" => $_POST['ITEMORDRULETYP'],
                    "STORAGECD" => $_POST['STORAGECD'],
                    "SUPPLIERCD" => $_POST['SUPPLIERCD'],
                    "ITEMINVPRICE" => $_POST['ITEMINVPRICE'],//
                    "ITEMSHOPPRICE" => $_POST['ITEMSHOPPRICE'],//
                    "ITEMSTDPURPRICE" => $_POST['ITEMSTDPURPRICE'],//
                    "ITEMMINSTOCK" => $_POST['ITEMMINSTOCK'],//
                    "ITEMFIXORDER" => $_POST['ITEMFIXORDER'],//
                    "ITEMMINORDER" => $_POST['ITEMMINORDER'],//
                    "ITEMFIFOLISTFLG" => isset($_POST['ITEMFIFOLISTFLG']) ? $_POST['ITEMFIFOLISTFLG']:'F',
                    "ITEMBOI" => $_POST['ITEMBOI'],
                    "ITEMINVCALCTYP" => $_POST['ITEMINVCALCTYP'],
                    "ITEMPOUNITTYP" => $_POST['ITEMPOUNITTYP'],
                    "ITEMPOUNITRATE" => isset($_POST['ITEMPOUNITRATE']) ? $_POST['ITEMPOUNITRATE']:'0',
                    "ITEMEDIFLG" => 'F',
                    "ITEMSERIALLFLG" => isset($_POST['ITEMSERIALLFLG']) ? $_POST['ITEMSERIALLFLG']:'F',//
                    "ITEMMASTERPLANFLG" => isset($_POST['ITEMMASTERPLANFLG']) ? $_POST['ITEMMASTERPLANFLG']:'F',//
                    "ITEMAGREEPRICEFLG" => 'F',
                    "ITEMINVFLG" => isset($_POST['ITEMINVFLG']) ? $_POST['ITEMINVFLG']:'F',//
                    "ITEMPHANTOMFLG" => isset($_POST['ITEMINVFLG']) ? $_POST['ITEMINVFLG']:'F',//
                    "ITEMBULKFLG" => 'F',
                    "ITEMSPECIALFLG" => 'F',
                    "ITEMPURADDDAY" => '0',
                    "ITEMINSPTYP" => '0',
                    "ITEMSTDSALEPRICE" => $_POST['ITEMSTDSALEPRICE'],//
                    "ITEMSTDSUPPLYPRICE" => $_POST['ITEMSTDSUPPLYPRICE'],//
                    "ITEMABC" => '',
                    "ITEMMARKETPRICE" => '',
                    "ITEMUNITPRICETYP" => '',
                    "ITEMCLEARANCETYP" => $_POST['ITEMCLEARANCETYP'],//
                    "ITEMPURGRPTYP" => '',
                    "ITEMSTOPDT" => isset($_POST['ITEMSTOPDT']) ? str_replace('-', '', $_POST['ITEMSTOPDT']) : '',//
                    "ITEMALTERFLG" => 'F',
                    "ITEMPAINTIN" => '',
                    "ITEMPAINTOUT" => '',
                    "ITEMMAXSTOCK" => '',
                    "ITEMORDERUNIT" => $_POST['ITEMORDERUNIT'],//
                    "ITEMBADRATE" => '',
                    "ITEMSALEDT" => '',
                    "ITEMINSPADDDAY" => '',
                    "AUTOINSPCD" => '',
                    "ITEMCOSTMETHODFLG" => 'F',
                    "ITEMADDNOTE1FLG" => '',
                    "ITEMADDNOTE2FLG" => '',
                    "ITEMADDNOTE3FLG" => '',
                    "ITEMADDNOTE4FLG" => '',
                    "ITEMADDTANABAN" => '',
                    "ITEMIMGLOC" => $ITEMIMGLOC,
                    "ITEMCATEGORY" => '',
                    "ITEMSUBCATEGORY" => '',
                    "ITEMMULTIPURCHASETYP" => '',
                    "ITEMRLTYP" => '',
                    "ITEMCOLORCD" => '',
                    "ITEMTAGCD1" => '',
                    "ITEMTAGCD2" => '',
                    "ITEMTAGCD3" => '',
                    "ITEMINSPECTMCCD" => '',
                    "ITEMLOCATEBODY" => '',
                    "ITEMCARTYP" => '',
                    "ITEMSPEC1" => '',
                    "ITEMSPEC2" => '',
                    "ITEMSPEC3" => '',
                    "ITEMSPEC4" => '',
                    "ITEMSPEC5" => '',
                    "ITEMSPEC6" => '',
                    "ITEMCASEFLG" => 'F',
                    "ITEMREM" => '',
                    "ITEMWITHDRAWTYP" => '',
                    "CUSTOMERCD" => '',
                    "ITEMTAXCLASSCD" => 'J01',
                    "ITEMMAKERTYP" => $_POST['ITEMMAKERTYP'],//
                );

    $update = $updfunc->update($param);
    echo json_encode($update);
    unsetSessionData();
}

function delete() {
    $delfunc = new ItemMaster;
    $delete = $delfunc->delete($_POST['ITEMCD']);
    // echo json_encode($delete);
    unsetSessionData();
}

function programDelete() {
    $sys = new Syslogic;
    if(isset($_SESSION['APPCODE'])) {
        $sys->ProgramRundelete($_SESSION['APPCODE']);
        $_SESSION['APPCODE'] = '';
    }
}

function setOldValue() {
    setSessionArray($_POST); 
}

function setSessionArray($arr){
    $keepField = array( "ITEMCD", "ITEMNAME", "ITEMSPEC", 'ITEMDRAWNO', "ITEMTYP", "CATALOGCD", "CATALOGNAME", "ITEMSEARCH", "ITEMBOI", "ITEMBOITYP",
                        "ITEMLEADTIME", "ITEMPURADDDAY", "ITEMTYPE", "ITEMWHTTYP", "MATERIALCD", "MATERIALNAME", "ITEMPOUNITRATE", "ITEMMINSTOCK",
                        "SUPPLIERCD", "SUPPLIERNAME", "STORAGECD", "STORAGENAME", "ITEMADDTANABAN", "ITEMUNITTYP", "ITEMPOUNITTYP", "ITEMINVCALCTYP",
                        "ITEMORDRULETYP", "ITEMINVPRICE", "ITEMSTDPURPRICE", "ITEMSHOPPRICE", "ITEMFIXORDER", "ITEMMINORDER", "ITEMFIFOLISTFLG", 
                        "ITEMSTDSALEPRICE","ITEMSTDSUPPLYPRICE","ITEMPACKTYP","ITEMPHANTOMFLG","ITEMMAKERTYP","ITEMINVFLG","WCCD","WCNAME","ITEMMASTERPLANFLG",
                        "ITEMCOSTTYP","ITEMCLEARANCETYP","ITEMSERIALLFLG","ITEMORDERUNIT","ITEMSTOPDT","ITEMWEIGHT","ITEMQTYINCASE", 'ITEMIMGLOC', 'ITEMIMGLOCVIEW',
                        "SYSPVL", "TXTLANG"
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

function getDropdownData($key = "") {
  return get_sys_data(SESSION_NAME_DROPDOWN, $key);
}

function setDropdownData($key, $val) {
  return set_sys_data(SESSION_NAME_DROPDOWN, $key, $val);
}

function getSystemData($key = "") {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}
?>