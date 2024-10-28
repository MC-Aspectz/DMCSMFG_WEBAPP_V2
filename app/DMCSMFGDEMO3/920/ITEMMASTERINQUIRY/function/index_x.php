<?php
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/include/menu.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
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
}  // if ($_SESSION['MENU'] != "" and is_array($_SESSION['MENU'])) {

# print_r($_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php');
//--------------------------------------------------------------------------------
// No This Application in Menu (Unauthorized Application)
if ($appname == "") {
    // header("Location:home.php");
    // header("Location:".(isset($_SERVER['HTTPS']) ? 'https' : 'http') . "://" . $_SERVER['HTTP_HOST'] . "/" . "DMCS_WEBAPP"."/home.php");
    header("Location:".(isset($_SERVER['HTTPS']) ? 'https' : 'http') . "://" . $_SERVER['HTTP_HOST'] . "/" . $arydirname[array_key_last($arydirname) - 5]."/home.php");
}
//--------------------------------------------------------------------------------
$syslogic = new Syslogic;
if(isset($_SESSION['APPCODE']) && $_SESSION['APPCODE'] != $appcode) {
    $_SESSION['PACKCODE'] = $packcode;
    $_SESSION['PACKNAME'] = $packname;
    $_SESSION['APPCODE'] = $appcode;
    $_SESSION['APPNAME'] = $appname;
    $syslogic->ProgramRundelete($_SESSION['APPCODE']);
    $syslogic->setLoadApp($appcode);
}
//--------------------------------------------------------------------------------
# print_r($_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php');
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

$systemName = strtolower($appcode);
$javaFunc = new ItemMasterInquiry;

$data = array();
// -- Table Max Row ----//
$minrow = 0;
$maxrow = 10;


//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
$ITEMCD1 = '';
$ITEMCD2 = '';
$ITEMNAME = '';
$ITEMSEARCH = '';
$ITEMTYP = '';
$ITEMBOI = '';
$CATALOGCD = '';
$ITEMUNIT = '';
$SUPPLIERCD = '';
$STORAGECD = '';

if(!empty($_POST)) {
   // if(isset($_POST['search'])) {
   
       // $SUPPLIERCD = $_POST['SUPPLIERCD'];
        
        $query = $javaFunc->search($_POST['ITEMCD1'],$_POST['ITEMCD2'],$_POST['ITEMNAME'],$_POST['ITEMSEARCH']
         ,$_POST['ITEMTYP'],$_POST['ITEMBOI'],$_POST['CATALOGCD'],$_POST['ITEMUNIT'],$_POST['SUPPLIERCD']
        ,$_POST['STORAGECD']);
        //print_r($query);
        $data['ITQ'] = $query;

        // $data['SUPPLIERCD'] = $_POST['SUPPLIERCD'];
        // $data['SUPPLIERNAME'] = $_POST['SUPPLIERNAME']; 
        // print_r($_POST['STORAGECD_S']);
         //print_r($data['ACCF']);
        if(!empty($query)) {
            setSessionArray($data); 
        }

        if(checkSessionData()) { $data = getSessionData(); }
    // }

    if (isset($_POST['action'])) {
        if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
        if ($_POST['action'] == "insert") { Commits(); }
        if ($_POST['action'] == "update") { update(); }
        if ($_POST['action'] == "deletes") { deletes(); }
        if ($_POST['action'] == "keepdata") { setOldValue(); }
        if ($_POST['action'] == "programDelete") { programDelete(); }
    }
}

//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
// ITEMCD1,ITEMCD2,ITEMNAME,ITEMSEARCH,ITEMTYP,ITEMBOI,CATALOGCD,ITEMUNIT,SUPPLIERCD,STORAGECD
if(!empty($_GET)) {
    if(isset($_GET['refresh'])) {
        $query = $javaFunc->search($ITEMCD1,$ITEMCD2,$ITEMNAME,$ITEMSEARCH,$ITEMTYP
                ,$ITEMBOI,$CATALOGCD,$ITEMUNIT,$SUPPLIERCD,$STORAGECD);
        $data['ITQ'] = $query;   
        $data['ITEMCD1'] = '';
        $data['ITEMCD2'] = '';
      // print_r($data['ACCF']);  
        setSessionArray($data); 
        
    }

    if(isset($_GET['itemcd'])) {

        if(isset($_GET['index']) && $_GET['index']==1)
        {
            $data['ITEMCD1'] = isset($_GET['itemcd']) ? $_GET['itemcd']: '';
            //print_r($data['ITEMCD1']);
        }
         if (isset($_GET['index']) && $_GET['index']==2)
        {
            $data['ITEMCD2'] = isset($_GET['itemcd']) ? $_GET['itemcd']: '';
        }
        setSessionArray($data); 
        }
    
    //     $query = $javaFunc->getCat($_GET['catalogcd']);
       
    //    $data['CATALOGCD'] = $query['CATALOGCD'];
    //    $data['CATALOGNAME'] = $query['CATALOGNAME'];
             
 


    //$SUPPLIERCD = isset($_GET['suppliercd']) ? $_GET['suppliercd']: '';
   // $data['SUPPLIERCD'] = isset($_GET['accname']) ? $_GET['accname']: '';
    



if(isset($_GET['categorycd'])) {

    
       $query = $javaFunc->getCat($_GET['categorycd']);
      
      $data['CATALOGCD'] = $query['CATALOGCD'];
      $data['CATALOGNAME'] = $query['CATALOGNAME'];
            
}

else if(isset($_GET['suppliercd'])) {
    $query = $javaFunc->getSup($_GET['suppliercd']);
    $data['SUPPLIERCD'] = $query['SUPPLIERCD'];
    $data['SUPPLIERNAME'] = $query['SUPPLIERNAME'];
} else if(isset($_GET['locationcd'])) {
    $query = $javaFunc->getStg($_GET['locationcd']);
    $data['STORAGECD'] = $query['STORAGECD'];
    $data['STORAGENAME'] = $query['STORAGENAME'];
} 




 


    // if(!empty($_GET['citycd'])) {


    if(!empty($query)) {
        setSessionArray($data); 
    }

    

    if(checkSessionData()) { $data = getSessionData(); }
    // print_r($data);
}

// ------------------------- CALL Langauge AND Privilege -------------------//
$syspvl = getSystemData($_SESSION['APPCODE']."_PVL");
if(empty($syspvl)) {
    $syspvl = $syslogic->setPrivilege($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE']."_PVL", $syspvl);
}

$data['SYSPVL'] = $syspvl;
// print_r($data['SYSPVL']);
$loadApp = getSystemData($_SESSION['APPCODE']);
if(empty($loadApp)) {
    $syslogic->ProgramRundelete($_SESSION['APPCODE']);
    $loadApp = $syslogic->getLoadApp($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE'], $loadApp);
}
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$itemtype = $data['DRPLANG']['ITEM_TYPE'];
$itemboitype = $data['DRPLANG']['ITEMBOITYP'];
$unit = $data['DRPLANG']['UNIT'];
//  $data = getSessionData(); 







// $data['DRPLANG'] = get_sys_dropdown($loadApp);print_r($data['SYSPVL']);
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// 
// --------------------------------------------------------------------------//






function programDelete() {
    $sys = new Syslogic;
    if(isset($_SESSION['APPCODE'])) {
        $sys->ProgramRundelete($_SESSION['APPCODE']);   
    }
}

function setOldValue() {
    setSessionArray($_POST); 
}

function setSessionArray($arr){
    $keepField = array('ITQ','ITEMCD1','ITEMCD2', 'ITEMTYP', 'ITEMBOI','ITEMNAME','CATALOGCD','CATALOGNAME','ITEMSEARCH','ITEMUNIT',
    'SUPPLIERCD','SUPPLIERNAME','STORAGECD','STORAGENAME', 'SYSPVL', 'TXTLANG', 'DRPLANG');
    foreach($arr as $k => $v){
        if(in_array($k, $keepField)) {
            setSessionData($k, $v);
        }
    }
}

function setSessionData($key, $val) {
    global $systemName;
    return set_sys_data($systemName, $key, $val);
}

function checkSessionData() {
    global $systemName;
    return check_sys_data($systemName);
}

function getSessionData($key = "") {
    global $systemName;
    return get_sys_data($systemName, $key);
}

function unsetSessionData($key = "") {
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    return unset_sys_data($key);
}

function getSystemData($key = "") {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}

function unsetSessionkey($key) {
    global $systemName;
    $sysnm = empty($sysnm) ? $systemName : $sysnm;
    return unset_sys_key($sysnm, $key);
}
?>