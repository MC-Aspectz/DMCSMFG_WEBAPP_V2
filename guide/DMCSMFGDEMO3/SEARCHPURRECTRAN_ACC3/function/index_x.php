<?php
include_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/include/guideconfig.php');
require_once($_SESSION['APPPATH'] . '/common/utils.php');

$routeUrl = $_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php';
// print_r($routeUrl);
if (isset($_SESSION['LANG'])) {
    // require_once(dirname(__FILE__, 2). '/lang/jp.php');
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}

$syslogic = new Syslogic;
$javaFunc = new SearchPurRecTran;
$minrow = 0;
$maxrow = 10;

$P1 = '';
$P2 = '';
$P3 = '';
$P4 = '';
$P5 = 'B';
$P6 = '';

if(!empty($_GET)) {
	$P1 = isset($_GET['P1CODE']) ? $_GET['P1CODE']: '';
}

if(isset($_POST['search'])) {
	$P1 = isset($_POST['P1']) ? $_POST['P1']: '';
	$P2 = isset($_POST['P2']) ? $_POST['P2']: '';
	$P3 = isset($_POST['P3']) ? str_replace("-", "", $_POST['P3']): '';
	$P4 = isset($_POST['P4']) ? str_replace("-", "", $_POST['P4']): '';
	$P5 = isset($_POST['P5']) ? $_POST['P5']: '';
	$P6 = isset($_POST['P6']) ? $_POST['P6']: '';
	$Param = array(	'P1' => $P1, 'P2' => $P2, 'P3' => $P3, 'P4' => $P4, 'P5' => $P5, 'P6' => $P6);
	// print_r($Param);
  	$tdata = $javaFunc->searchPurRecTran($Param);
	// echo '<pre>';
	// print_r($tdata);
	// echo '</pre>';
}

// ------------------------- CALL Langauge -------------------//
$loadApp = getSystemData('SEARCHPURRECTRAN_ACC3');
if(empty($loadApp)) {
    $loadApp = $syslogic->getLoadApp('SEARCHPURRECTRAN_ACC3');
    $syslogic->ProgramRundelete('SEARCHPURRECTRAN_ACC3');
    setSystemData('SEARCHPURRECTRAN_ACC3', $loadApp);
}
//  else {
//     $setLoadApp = $syslogic->setLoadApp('SEARCHPURRECTRAN_ACC3');
// }
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$accststatus = $data['DRPLANG']['ACCSTSTAUTS'];
// echo "<pre>";
// print_r($data['TXTLANG']);
// echo "</pre>";
// echo "<pre>";
// print_r($data['DRPLANG']);
// echo "</pre>";
// --------------------------------------------------------------------------//
function getSystemData($key = "") {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}
?>