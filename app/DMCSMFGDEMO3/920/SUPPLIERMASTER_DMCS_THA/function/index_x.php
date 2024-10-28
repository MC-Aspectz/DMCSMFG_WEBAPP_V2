<?php
require_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/common/syslogic.php');
require_once($_SESSION['APPPATH'] . '/include/menu.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');
//--------------------------------------------------------------------------------
//  Pack Code & Name, Application Code & Name
//--------------------------------------------------------------------------------
// $arydirname = explode("\\", dirname(__FILE__));  // for localhost
$arydirname = explode("/", dirname(__FILE__));  // for web
$appcode = $arydirname[array_key_last($arydirname) - 1];
$packcode = $arydirname[array_key_last($arydirname) - 2];
$syslogic = new Syslogic;
if(isset($_SESSION['APPCODE']) && $_SESSION['APPCODE'] != $appcode) {
    $syslogic->ProgramRundelete($_SESSION['APPCODE']);
    $syslogic->setLoadApp($appcode);     
}
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
$_SESSION['PACKCODE'] = $packcode;
$_SESSION['PACKNAME'] = $packname;
$_SESSION['APPCODE'] = $appcode;
$_SESSION['APPNAME'] = $appname;
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


$systemName = 'SupplierMaster';
$data = array();
$COUNTRYCD = '';
$STATECD = '';
$CITYCD = '';

if(!empty($_GET)) { //รับ
    $javaFunc = new SupplierMaster;
   // if(checkSessionData()) { $data = getSessionData(); } 
    if(!empty($_GET['suppliercd'])) {
        if(isset($_GET['index']) && $_GET['index']==2){

       // print_r(2);
        $query = $javaFunc->getSupplier($_GET['suppliercd']);
        $data = $query;
       
        // if(!empty($query)) { setSessionData('isInsert', 'off'); } else { setSessionData('isInsert', 'on'); }
    }
    else{
        $query = $javaFunc->getBillSupplier($_GET['suppliercd']);
        $data['SUPBILLCD'] = $query['SUPBILLCD'];
        $data['SUPBILLNAME'] = $query['SUPBILLNAME'];
       // print_r($query);
    }
       // if(!empty($data)) { setSessionArray($data); } // else { unsetSessionData(); }
    } else if(!empty($_GET['countrycd'])) {
        $STATECD = isset($data['STATECD'])?$data['STATECD']:'';
        $CITYCD = isset($data['CITYCD'])? $data['CITYCD']:'';
        $query = $javaFunc->getCountrycd($_GET['countrycd'], $STATECD, $CITYCD);
        $data['COUNTRYCD'] = $query['COUNTRYCD'];
     
       
    } else if(!empty($_GET['statecd'])) {
        $COUNTRYCD = isset($data['COUNTRYCD'])?$data['COUNTRYCD']:'';
        $CITYCD = isset($data['CITYCD'])? $data['CITYCD']:'';
        $query = $javaFunc->getState($CITYCD,$_GET['statecd'],$CITYCD);
        $data['STATECD'] = $query['STATECD'];
       
    } else if(!empty($_GET['citycd'])) {
        $COUNTRYCD = isset($data['COUNTRYCD'])?$data['COUNTRYCD']:'';
        $STATECD = isset($data['STATECD'])? $data['STATECD']:'';
        $query = $javaFunc->getCity($COUNTRYCD,$STATECD,$_GET['citycd']);
        $data['CITYCD'] = $query['CITYCD'];
        $data['CITYNAME'] = $query['CITYNAME'];
      
    } else if(!empty($_GET['currencycd'])) {
        $query = $javaFunc->getCurrency($_GET['currencycd']);
        $data['CURRENCYCD'] = $query['CURRENCYCD'];
      
    } else if(!empty($_GET['suppliershortname'])) {

    $SUPPLIERSHORTNAME = isset($_GET['suppliershortname']) ? $_GET['suppliershortname']:'';     
    $excute = $javaFunc->chack_l($SUPPLIERSHORTNAME);
    if(!empty($excute)){
    $tdata[] = array('SUPPLIERSHORTNAME' => $excute['SUPPLIERSHORTNAME']); 
    }
} else if(!empty($_GET['supplierzipcode'])) {

    $SUPPLIERADDR1 = isset($_GET['SUPPLIERADDR1'])?$_GET['SUPPLIERADDR1']:'';
    $SUPPLIERADDR2 = isset($_GET['SUPPLIERADDR2'])? $_GET['SUPPLIERADDR2']:'';
    $query = $javaFunc->getGMap($SUPPLIERADDR1,$SUPPLIERADDR2,$_GET['supplierzipcode']);
   
    // $data['SUPPLIERADDR1'] = $query['SUPPLIERADDR1'];
    // $data['SUPPLIERADDR2'] = $query['SUPPLIERADDR2'];
    // $data['SUPPLIERZIPCODE'] = $query['SUPPLIERZIPCODE'];



    // $SUPPLIERADDR1 = isset($_GET['SUPPLIERADDR1']) ? $_GET['SUPPLIERADDR1']:'';
    // $SUPPLIERADDR2 = isset($_GET['SUPPLIERADDR2']) ? $_GET['SUPPLIERADDR2']:'';   
    // $excute = $javaFunc->getGMap($SUPPLIERADDR1,$SUPPLIERADDR2,$_GET['supplierzipcode']);
    // if(!empty($excute)){
    //  $tdata[] = array('SUPPLIERADDR1' => $excute['SUPPLIERADDR1'],
    //  'SUPPLIERADDR2' => $excute['SUPPLIERADDR2'],
    //  'SUPPLIERZIPCODE' => $excute['SUPPLIERZIPCODE'],); 
    // }
}

else if(!empty($_GET['supplieraddr1'])) {
    $SUPPLIERZIPCODE = isset($_GET['SUPPLIERZIPCODE'])?$_GET['SUPPLIERZIPCODE']:'';
    $SUPPLIERADDR2 = isset($_GET['SUPPLIERADDR2'])? $_GET['SUPPLIERADDR2']:'';
    $query = $javaFunc->getGMap($SUPPLIERZIPCODE,$SUPPLIERADDR2,$_GET['supplieraddr1']);
    print_r($query);
}

else if(!empty($_GET['supplieraddr2'])) {
    $SUPPLIERZIPCODE = isset($_GET['SUPPLIERZIPCODE'])?$_GET['SUPPLIERZIPCODE']:'';
    $SUPPLIERADDR1 = isset($_GET['SUPPLIERADDR1'])? $_GET['SUPPLIERADDR1']:'';
    $query = $javaFunc->getGMap($SUPPLIERZIPCODE,$SUPPLIERADDR1,$_GET['supplieraddr2']);
    print_r($query);
}


    if(!empty($query)) {
        setSessionArray($data); 
        // if(checkSessionData()) { $data = getSessionData(); } 
    }

    if(checkSessionData()) { $data = getSessionData(); } 
    //print_r($data);
}

if(!empty($_POST)){ //ส่ง
    // print_r($excute);
    //SUPPLIERSHORTNAME
     
       
 
        // $FACTORYCODE = isset($_POST['FACTORYCODE']) ? $_POST['FACTORYCODE']:'';     
        // $excute = $javaFunc->SetBranch($FACTORYCODE);
        // if(!empty($excute)){
        //  $tdata[] = array('FACTORYCODE' => $excute['FACTORYCODE']); 
        // }
 
        
        // $FACTORYCODE = isset($_POST['FACTORYCODE']) ? $_POST['FACTORYCODE']:'';
        // $SUPPLIERADD01 = isset($_POST['SUPPLIERADD01']) ? $_POST['SUPPLIERADD01']:'';
        // $excute = $javaFunc->ChkBranch($FACTORYCODE,$SUPPLIERADD01);
        // if(!empty($excute)){
        //  $tdata[] = array('FACTORYCODE' => $excute['FACTORYCODE'],
        //  'SUPPLIERADD01' => $excute['SUPPLIERADD01']); 
        // }       
        
     } 




if (isset($_POST['action'])) {
    if ($_POST['action'] == "unsetsession") { unsetSessionData(); }
    if ($_POST['action'] == "keepdata") { setOldValue(); }
    if ($_POST['action'] == "insert") { insert(); }
    if ($_POST['action'] == "update") { update(); }
    if ($_POST['action'] == "delete") { delete(); }
   // if ($_POST['action'] == "getGMap") { getGMaps(); }
   // if ($_POST['action'] == "chacki") { chacki(); }
    if ($_POST['action'] == "delete") { delete(); }
}
// if (isset($_POST['insert'])) { insert(); }
// if (isset($_POST['update'])) { update(); }
// if (isset($_POST['delete'])) { delete(); }



$syspvl = getSystemData($_SESSION['APPCODE']."_PVL");
if(empty($syspvl)) {
    $syspvl = $syslogic->setPrivilege($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE']."_PVL", $syspvl);
}
$data['SYSPVL'] = $syspvl;
if(empty($loadApp)) {
    $syslogic->ProgramRundelete($_SESSION['APPCODE']);
    $loadApp = $syslogic->getLoadApp($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE'], $loadApp);
}
$loadevent = getSystemData($_SESSION['APPCODE']."_EVENT");
if(empty($loadevent)) {
    $loadevent = $syslogic->loadEvent($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE']."_EVENT", $loadevent);
}

$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$kbnbranch = $data['DRPLANG']['BRANCH_KBN'];
$bkacctype= $data['DRPLANG']['BK_ACC_TYPE'];
$roun_d1 = $data['DRPLANG']['ROUND'];
$roun_d2 = $data['DRPLANG']['ROUND'];
$roun_d3 = $data['DRPLANG']['ROUND'];
// print_r($roun_d1);
// print_r($data['SYSPVL']);









function insert() {
    $javaInsrt = new SupplierMaster;
 
    $param = array("SUPPLIERCD" => $_POST['SUPPLIERCD'],
                    "SUPPLIERNAME" => $_POST['SUPPLIERNAME'],
                    "SUPPLIERSHORTNAME" => $_POST['SUPPLIERSHORTNAME'],
                    "SUPPLIERSEARCH" => $_POST['SUPPLIERSEARCH'],
                    "SUPPLIERZIPCODE" => $_POST['SUPPLIERZIPCODE'],
                    "SUPPLIERADDR1" => $_POST['SUPPLIERADDR1'],
                    "SUPPLIERADDR2" => $_POST['SUPPLIERADDR2'],
                    "SUPPLIERTEL" => $_POST['SUPPLIERTEL'],
                    "SUPPLIERFAX" => $_POST['SUPPLIERFAX'],
                    "SUPPLIEREMAIL" => $_POST['SUPPLIEREMAIL'],
                    "SUPPLIERCONTACT" => $_POST['SUPPLIERCONTACT'],
                    "BANKNAME" => $_POST['BANKNAME'],
                    "BRANCHNAME" => $_POST['BRANCHNAME'],
                    "DIRECTCD" => '',
                    "COUNTRYCD" => $_POST['COUNTRYCD'],
                    "STATECD" => $_POST['STATECD'],
                    "CITYCD" => $_POST['CITYCD'],
                    "SUPPLIERPWD" => '',
                    "SUPPLIERTRANSPORTTYP" => '',
                    "SUPPLIERAFFILIATEFLG" => $_POST['SUPPLIERAFFILIATEFLG'],
                    "SUPPLIERCREDITLIMIT" => '',
                    "SUPPLIERCLOSEDAY" => $_POST['SUPPLIERCLOSEDAY'],
                    "SUPPLIERTAXROUNDTYP" => $_POST['SUPPLIERTAXROUNDTYP'],
                    "SUPPLIERTAXTYP" => $_POST['SUPPLIERTAXTYP'],
                    "SUPPLIERTAXRATE" => $_POST['SUPPLIERTAXRATE'],
                    "CURRENCYCD" => $_POST['CURRENCYCD'],
                    "STAFFCD" => '',
                    "SUPBILLCD" => $_POST['SUPBILLCD'],
                    "SUPPLIEREDITYP" => '',
                    "SUPPLIERREGDT" => str_replace("-", "", $_POST['SUPPLIERREGDT']),                   
                    "SUPPLIERADD01" => $_POST['SUPPLIERADD01'],                    
                    "SUPPLIERRECDAY" => $_POST['SUPPLIERRECDAY'],
                    "SUPPLIEROFFFLG" => $_POST['SUPPLIEROFFFLG'],
                    "SUPPLIERTRANSFERFLG" => '',
                    "BANKCD" => '',
                    "BRANCHCD" => '',
                    "SUPPLIERBKACCTYP" => $_POST['SUPPLIERBKACCTYP'],
                    "SUPPLIERBKACCNO" => $_POST['SUPPLIERBKACCNO'],
                    "SUPPLIERBKACCNAME" => $_POST['SUPPLIERBKACCNAME'],
                    "SUPPLIERREMARK" => $_POST['SUPPLIERREMARK'],
                    "SUPPLIERUNITROUNDTYP" => $_POST['SUPPLIERUNITROUNDTYP'],
                    "SUPPLIERAMTROUNDTYP" => $_POST['SUPPLIERAMTROUNDTYP'],
                    "FACTORYCODE" => $_POST['FACTORYCODE']
                                 
                );
       
       //print_r($param);
      $insert = $javaInsrt->insSupplier($param);
      // echo json_encode($insert);
      unsetSessionData();
}

function update() {
    $javaUpd = new SupplierMaster;
    $param = array("SUPPLIERCD" => $_POST['SUPPLIERCD'],
    "SUPPLIERNAME" => $_POST['SUPPLIERNAME'],
    "SUPPLIERSHORTNAME" => $_POST['SUPPLIERSHORTNAME'],
    "SUPPLIERSEARCH" => $_POST['SUPPLIERSEARCH'],
    "SUPPLIERZIPCODE" => $_POST['SUPPLIERZIPCODE'],
    "SUPPLIERADDR1" => $_POST['SUPPLIERADDR1'],
    "SUPPLIERADDR2" => $_POST['SUPPLIERADDR2'],
    "SUPPLIERTEL" => $_POST['SUPPLIERTEL'],
    "SUPPLIERFAX" => $_POST['SUPPLIERFAX'],
    "SUPPLIEREMAIL" => $_POST['SUPPLIEREMAIL'],
    "SUPPLIERCONTACT" => $_POST['SUPPLIERCONTACT'],
    "BANKNAME" => $_POST['BANKNAME'],
    "BRANCHNAME" => $_POST['BRANCHNAME'],
    "DIRECTCD" => '',
    "COUNTRYCD" => $_POST['COUNTRYCD'],
    "STATECD" => $_POST['STATECD'],
    "CITYCD" => $_POST['CITYCD'],
    "SUPPLIERPWD" => '',
    "SUPPLIERTRANSPORTTYP" => '',
    "SUPPLIERAFFILIATEFLG" => $_POST['SUPPLIERAFFILIATEFLG'],
    "SUPPLIERCREDITLIMIT" => '',
    "SUPPLIERCLOSEDAY" => $_POST['SUPPLIERCLOSEDAY'],
    "SUPPLIERTAXROUNDTYP" => $_POST['SUPPLIERTAXROUNDTYP'],
    "SUPPLIERTAXTYP" => $_POST['SUPPLIERTAXTYP'],
    "SUPPLIERTAXRATE" => $_POST['SUPPLIERTAXRATE'],
    "CURRENCYCD" => $_POST['CURRENCYCD'],
    "STAFFCD" => '',
    "SUPBILLCD" => $_POST['SUPBILLCD'],
    "SUPPLIEREDITYP" => '',
    "SUPPLIERREGDT" => str_replace("-", "", $_POST['SUPPLIERREGDT']),
    "SUPPLIERADD01" => $_POST['SUPPLIERADD01'],                    
    "SUPPLIERRECDAY" => $_POST['SUPPLIERRECDAY'],
    "SUPPLIEROFFFLG" => $_POST['SUPPLIEROFFFLG'],
    "SUPPLIERTRANSFERFLG" => '',
    "BANKCD" => '',
    "BRANCHCD" => '',
    "SUPPLIERBKACCTYP" => $_POST['SUPPLIERBKACCTYP'],
    "SUPPLIERBKACCNO" => $_POST['SUPPLIERBKACCNO'],
    "SUPPLIERBKACCNAME" => $_POST['SUPPLIERBKACCNAME'],
    "SUPPLIERREMARK" => $_POST['SUPPLIERREMARK'],
    "SUPPLIERUNITROUNDTYP" => $_POST['SUPPLIERUNITROUNDTYP'],
    "SUPPLIERAMTROUNDTYP" => $_POST['SUPPLIERAMTROUNDTYP'],
    "FACTORYCODE" => $_POST['FACTORYCODE']);              
                
                
             //   print_r($_POST['SupplierREGDT']);
    $update = $javaUpd->updSupplier($param);
//    echo json_encode($update);
     unsetSessionData();
}

function delete() {
    $delfunc = new SupplierMaster;
    $delete = $delfunc->delSupplier($_POST['SUPPLIERCD']);
    // echo json_encode($delete);
    unsetSessionData();
}

// function chacki() {
    
//     $javaFunc = new SupplierMaster;
//     $SUPPLIERSHORTNAME = isset($_POST['SUPPLIERSHORTNAME']) ? $_POST['SUPPLIERSHORTNAME']:'';     
//     $excute = $javaFunc->chack_l($SUPPLIERSHORTNAME);
//     if(!empty($excute)){
//      $tdata[] = array('SUPPLIERSHORTNAME' => $excute['SUPPLIERSHORTNAME']); 
//     }
// print_r($excute);
  
// }

function getGMaps() {
    
    $javaFunc = new SupplierMaster;
    $SUPPLIERADDR1 = isset($_POST['SUPPLIERADDR1']) ? $_POST['SUPPLIERADDR1']:'';
    $SUPPLIERADDR2 = isset($_POST['SUPPLIERADDR2']) ? $_POST['SUPPLIERADDR2']:'';
    $SUPPLIERZIPCODE = isset($_POST['SUPPLIERZIPCODE']) ? $_POST['SUPPLIERZIPCODE']:'';     
    $excute = $javaFunc->getGMap($SUPPLIERADDR1,$SUPPLIERADDR2,$SUPPLIERZIPCODE);
    if(!empty($excute)){
     $tdata[] = array('SUPPLIERADDR1' => $excute['SUPPLIERADDR1'],
     'SUPPLIERADDR2' => $excute['SUPPLIERADDR2'],
     'SUPPLIERZIPCODE' => $excute['SUPPLIERZIPCODE'],); 
    }


  
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
    $keepField = array( "SUPPLIERCD", "SUPPLIERREGDT", "SUPPLIERNAME", "SUPPLIERSEARCH", "SUPPLIERSHORTNAME", "FACTORYCODE", "SUPPLIERADD01", "COUNTRYCD", "STATECD", "CITYCD", "CITYNAME",
                        "SUPPLIERZIPCODE", "SUPPLIERADDR1", "SUPPLIERADDR2", "SUPPLIERTEL", "SUPPLIERFAX", "SUPPLIEREMAIL", "SUPPLIERCONTACT", "BANKNAME","BRANCHNAME",
                        "CURRENCYCD", "SUPPLIERBKACCTYP","SUPPLIERBKACCNO", "SUPPLIERBKACCNAME", "SUPPLIERUNITROUNDTYP","SUPPLIERAMTROUNDTYP", "SUPPLIERTAXROUNDTYP", "SUPBILLCD",
                        "SUPBILLNAME","SUPPLIERRECDAY","SUPPLIERCLOSEDAY","SUPPLIERREMARK","SUPPLIEROFFFLG","SUPPLIERAFFILIATEFLG"
                        
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