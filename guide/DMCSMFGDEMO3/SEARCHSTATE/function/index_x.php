<?php
include_once('index_class.php');
require_once($_SESSION['APPPATH'] . '/include/guideconfig.php');

$routeUrl = $_SESSION['APPURL'].'/app/'.$_SESSION['COMCD'].'/'.$_SESSION['PACKCODE'].'/'.$_SESSION['APPCODE'].'/index.php';
// print_r($routeUrl);
if (isset($_SESSION['LANG'])) {
    // require_once(dirname(__FILE__, 2). '/lang/jp.php');
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}

$tdata = array();
$javaFunc = new State;
$minrow = 0;
$maxrow = 10;

$P1 = '';
$COUNTRYCD_S = '';
$STATECD_S = '';
$STATECD = '';
$STATENAME ='';


if(!empty($_POST)) {
    $COUNTRYCD_S = isset($_POST['COUNTRYCD_S']) ? $_POST['COUNTRYCD_S']:'';
    $STATECD_S = isset($_POST['STATECD_S']) ? $_POST['STATECD_S']:'';
    $excute = $javaFunc->getResult($COUNTRYCD_S,$STATECD_S);
    if(!empty($excute)){
        $tdata = $excute;
    }
} 

if(!empty($_GET)) {
    $COUNTRYCD_S = isset($_GET['COUNTRYCD']) ? $_GET['COUNTRYCD']:'';
}
?>