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
    require_once(dirname(__FILE__, 2).'/lang/'.strtolower($_SESSION['LANG']).'.php');
} else {  
    require_once(dirname(__FILE__, 2). '/lang/en.php');
}  // if (isset($_SESSION['LANG'])) { else
//--------------------------------------------------------------------------------
// <!-- ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ -->
$data = array();
$syslogic = new Syslogic;
$javaFunc = new AccProfitAndLossRD;
$systemName = strtolower($appcode);
// Table Row
$minrow = 0;
$maxrow = 25;
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    //
}
//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
if(!empty($_POST)) {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'unsetsession') { unsetSessionData(); }
        if ($_POST['action'] == 'keepdata') { setOldValue(); }  
        if ($_POST['action'] == 'Print_PL') { Print_PL(); }
    }
    if (isset($_POST['SEARCH'])) { searchCheck(); }
}
//--------------------------------------------------------------------------------

// ------------------------- CALL Langauge AND Privilege -------------------//
$load = getSystemData($_SESSION['APPCODE'].'LOAD');
if(empty($load)) {
    $load = $javaFunc->load();
    setSystemData($_SESSION['APPCODE'].'LOAD', $load);
}
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
$lang = $data['DRPLANG']['LANG'];
$rptform = $data['DRPLANG']['RPTFORM'];
$yearvalue = $data['DRPLANG']['YEARVALUE'];
$monthvalue = $data['DRPLANG']['MONTHVALUE'];
$accyearvalue = $data['DRPLANG']['ACCYEARVALUE'];
$data['RPTFORMTYP'] = 'FORM2';
if(empty($data['ACCY'])) { $data['ACCY'] = isset($load['ACCY']) ? $load['ACCY']: date('Y'); }
if(empty($data['YEAR'])) { $data['YEAR'] = isset($load['YEAR']) ? $load['YEAR']: date('Y'); }
setSessionData('ACCYEARVALUE', $accyearvalue);
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
function searchCheck() {
    global $data;
    $data = getSessionData();
    $searchfunc = new AccProfitAndLossRD;
    $data['YEAR'] = isset($_POST['YEAR']) ? $_POST['YEAR']: '';
    $data['MONTH'] = isset($_POST['MONTH']) ? $_POST['MONTH']: '';
    $data['YEAR2'] = isset($_POST['YEAR2']) ? $_POST['YEAR2']: '';
    $data['MONTH2'] = isset($_POST['MONTH2']) ? $_POST['MONTH2']: '';
    $data['ACCY'] = isset($_POST['ACCY']) ? $_POST['ACCY']: '';
    $param = array( 'ACCY' => isset($_POST['ACCY']) ? $_POST['ACCY']: '',
                    'YEAR' =>isset($_POST['YEAR']) ? $_POST['YEAR']: '',
                    'MONTH' => isset($_POST['MONTH']) ? $_POST['MONTH']: '',
                    'YEAR2' => isset($_POST['YEAR2']) ? $_POST['YEAR2']: '',
                    'MONTH2' => isset($_POST['MONTH2']) ? $_POST['MONTH2']: '',
                    'RPTFORMTYP' => isset($_POST['RPTFORMTYP']) ? $_POST['RPTFORMTYP']: 'FORM1',
                    'ACCNAMETO' => isset($_POST['ACCNAMETO']) ? $_POST['ACCNAMETO']: '',
                    'ACCNAMEFR' => isset($_POST['ACCNAMEFR']) ? $_POST['ACCNAMEFR']: '');
    $searchCheck = $searchfunc->searchCheck($param);
    // print_r($searchCheck);
    if(!empty($searchCheck)) {
        $index = array_key_first($searchCheck);
        $data['YEAR2'] = $searchCheck[$index]['YEAR2'];
        $data['MONTH2'] = $searchCheck[$index]['MONTH2'];
        $param['YEAR2'] = $searchCheck[$index]['YEAR2']; 
        $param['MONTH2'] = $searchCheck[$index]['MONTH2'];
    }
    // print_r($param);
    $printStatic = $searchfunc->printStatic($param);
    $printDynamic = $searchfunc->printDynamic($param);
    // $data = $printStatic;
    if(!empty($printDynamic)) {
        $data['ITEM'] = $printDynamic; 
    }
    setSessionArray($data);
    // echo '<pre>';
    // print_r($printStatic);
    // echo '</pre>';
    // echo '<pre>';
    // print_r($printDynamic);
    // echo '</pre>';
}

function Print_PL() {
    global $data; $data = getSessionData();
    $printfunc = new AccProfitAndLossRD;
    $param = array( 'ACCY' => isset($_POST['ACCY']) ? $_POST['ACCY']: '',
                    'YEAR' => isset($_POST['YEAR']) ? $_POST['YEAR']: '',
                    'MONTH' => isset($_POST['MONTH']) ? $_POST['MONTH']: '',
                    'YEAR2' => isset($_POST['YEAR2']) ? $_POST['YEAR2']: '',
                    'MONTH2' => isset($_POST['MONTH2']) ? $_POST['MONTH2']: '');
    // print_r($param);
    $upTmpRpt = $printfunc->UpTmpRpt($data['ITEM']);
    $printStatic = $printfunc->printStatic($param);
    $printDynamic = $printfunc->Print_PL($param);
    // print_r($upTmpRpt);
    // print_r($printStatic);
    // print_r($printDynamic);
    if(!empty($printDynamic)) {
        printPDF($printStatic, $printDynamic, $param);
    }
}

function printPDF($printStatic, $printDynamic, $param) {

    try {
        // ----------------------------------------------------------------------------------------------------
        // sudo chmod -R 777 /var/www/html/DMCSMFG_WEBAPP_V2
        // --------------------------------------------------
        // Generate EXCEL Report File
        $outputPath = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/output/'.$_SESSION['USERCODE'];
        // --------------------------------------------------
        // delete all file
        $files = glob($outputPath.'/*'); // get all file names
        foreach($files as $file) { // iterate files
          if(is_file($file)) {
            unlink($file); // delete file
          }
        }
        // Save the Path
        if (!file_exists($outputPath)) {
            $old = umask(0);
            $mk = mkdir($outputPath, 0755, true);
            umask($old);
            if (!$mk) {
                // echo 'directory created';
                chmod($outputPath, 0755);
            }
        }
        // --------------------------------------------------
        // Excel Sheet Index 0 for Report Layout
        // Excel Sheet Index 1 for keep Report Data
        // --------------------------------------------------
        $sheetRpt = 0; // Layout
        $sheetData = 1; // Data
        // --------------------------------------------------
        $response = array();
        global $data; $data = getSessionData();
        $ACCYEARVALUE = isset($data['ACCYEARVALUE']) ? $data['ACCYEARVALUE']: '';
        // Load an existing spreadsheet
        $file_path = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/template/ACC_PLINQ_RD.xlsx';
        $item = 25; // per page
        foreach ($printDynamic as $key => $value) {
            $page = ceil($key/$item); // if($key%$item == 0) {}
            $printDynamic[$key]['PAGE'] = $page;
        }
        // print_r($printStatic);
        // print_r($printDynamic);
        $seq = 2; // row excel new 1 start row 2 
        for ($x = 1; $x <= $page; $x++) {
            $sheetExcel[$x] = PHPExcel_IOFactory::load($file_path);
            // --------------------------------------------------
            // Set Active Sheet
            $sheetExcel[$x]->setActiveSheetIndex($sheetData);
            // --------------------------------------------------
            // Set Sheet Name [DATA]
            $sheetExcel[$x]->getActiveSheet()->setTitle('DATA');
            // --------------------------------------------------
                // Write Report Data to Sheet [DATA]
            $sheetExcel[$x]->getActiveSheet()->setCellValue('A1', $printStatic['COMPANYNAME'])
                                        ->setCellValue('B1', $printStatic['REPDATE'])
                                        ->setCellValue('C1', $printStatic['YEARMONTH'])
                                        ->setCellValue('D1', $printStatic['YEARMONTHTEXT'])
                                        ->setCellValue('E1', isset($param['ACCY']) ? $ACCYEARVALUE[$param['ACCY']] : '');
            //------------- Item List ----------- //                            
            foreach ($printDynamic as $key => $value) {
                if($value['PAGE'] == $x) { // separate page
                if ($seq > 25) { $seq = 2; }                               
                    $sheetExcel[$x]->getActiveSheet()->setCellValue('A'.$seq,  $value['ROWCOUNTER'])
                                                ->setCellValue('B'.$seq, $value['DATAFLG'])
                                                ->setCellValue('C'.$seq, $value['LISTFLG'])
                                                ->setCellValue('D'.$seq, $value['PROWS'])
                                                ->setCellValue('E'.$seq, $value['BRKEY1']) 
                                                ->setCellValue('F'.$seq, $value['BRKEY2'])
                                                ->setCellValue('G'.$seq, $value['LANG'])
                                                ->setCellValue('H'.$seq, $value['COMPNM'])
                                                ->setCellValue('I'.$seq, $value['RPTTITLE'])
                                                ->setCellValue('J'.$seq, $value['RPTPERIOD1'])
                                                ->setCellValue('K'.$seq, $value['RPTPERIOD2'])
                                                ->setCellValue('L'.$seq, $value['DISCRIPTION'])
                                                ->setCellValue('M'.$seq, $value['AMOUNT']);
                }
                ++$seq;
            }
            // --------------------------------------------------
            // Set Active Sheet to [REPORT]
            $sheetExcel[$x]->setActiveSheetIndex($sheetRpt);
            // --------------------------------------------------
            $writer = PHPExcel_IOFactory::createWriter($sheetExcel[$x], 'Excel2007');
            // Save Excel Report File on Server
            $report_file = 'PROFIT_AND_LOSS_INQUIRY_'.$x.'_'.date('Ymd_Hi').'.xlsx';
            $download_path = '/report/'.$_SESSION['COMCD'].'/output/'.$_SESSION['USERCODE'].'/'.$report_file;
            $report_path = $outputPath.'/'.$report_file;
            $writer->save($report_path);
            // print_r($download_path);
            // Response Excel Report File URL
            array_push($response, array('url' => $download_path,
                                        'filename' => $report_file));
            echo json_encode($response);
            exit();
            // --------------------------------------------------
            // ----------------------------------------------------------------------------------------------------
            // --------------------------------------------------
            // Generate PDF Report File
            // --------------------------------------------------
            // --------------------------------------------------
            $pdf_name = 'PROFIT_AND_LOSS_INQUIRY_'.$x.'_'.date('Ymd_Hi').'.pdf';
            $pdf_download_path = '/report/'.$_SESSION['COMCD'].'/output/'.$_SESSION['USERCODE'].'/'.$pdf_name;
            $pdf_path = $outputPath.'/'.$pdf_name;
            $rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
            $rendererLibraryPath = dirname(__FILE__, 6).'/common/PHPExcel/tcpdf';
            if(!PHPExcel_Settings::setPdfRenderer($rendererName, $rendererLibraryPath)) {
                die('NOTICE: Please set the $rendererName and $rendererLibraryPath values' .'<br />' .'at the top of s script as appropriate for your directory structure');
            }
            $sheetPDF[$x] = PHPExcel_IOFactory::load($report_path);
            $sheetPDF[$x]->setActiveSheetIndex($sheetRpt);
            // --------------------------------------------------
            $sheetPDF[$x]->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
            $sheetPDF[$x]->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
            $sheetPDF[$x]->getActiveSheet()->getPageSetup()->setFitToWidth(true);
            $sheetPDF[$x]->getActiveSheet()->getPageSetup()->setFitToHeight(true);
            $sheetPDF[$x]->getActiveSheet()->setShowGridLines(false);

            $pdf_writer = PHPExcel_IOFactory::createWriter($sheetPDF[$x], 'PDF');
            $pdf_writer->save($pdf_path);
            // --------------------------------------------------
            // --------------------------------------------------
            // Response PDF Report File URL
            array_push($response, array('url' => $pdf_download_path,
                                        'filename' => $pdf_name));
            // --------------------------------------------------
        }
        // --------------------------------------------------       
        echo json_encode($response);
        // --------------------------------------------------
        // ----------------------------------------------------------------------------------------------------
        exit;
        // ----------------------------------------------------------------------------------------------------
    } 
    catch(Exception $ex) {
        // print_r($ex);
    }
    // ----------------------------------------------------------------------------------------------------
}

// function Print_PL() {
//     global $data;
//     $data = getSessionData();
//     $printfunc = new AccProfitAndLossRD;
//     $param = array( 'YEAR' => isset($data['YEAR']) ? $data['YEAR']: '',
//                     'MONTH' => isset($data['MONTH']) ? $data['MONTH']: '',
//                     'YEAR2' => isset($data['YEAR2']) ? $data['YEAR2']: '',
//                     'MONTH2' => isset($data['MONTH2']) ? $data['MONTH2']: '');
//     // print_r($param);
//     $upTmpRpt = $printfunc->UpTmpRpt($data['ITEM']);
//     $printDynamic = $printfunc->Print_PL($param);
//     if(!empty($printDynamic)) {
//         for ($i = 1 ; $i < count($printDynamic) +1; $i++) {
//             $data['PRINTDYNAMIC'][$i] = $printDynamic[$i]; 
//         }
//         setSessionArray($data);
//     }
//     // echo '<pre>';
//     // print_r($data['PRINTDYNAMIC']);
//     // echo '</pre>';
//     // echo '<pre>';
//     // print_r($data);
//     // echo '</pre>';
// }

function setOldValue() {
    setSessionArray($_POST); 
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
}

function keepItemData() {
    global $data;
    for ($i = 0 ; $i < count($_POST['ROWNOA']); $i++) { 
        $data['ITEM'][$i+1] = array('ROWNO' => $_POST['ROWNOA'][$i],
                                    'ACC_CD' => $_POST['ACC_CDA'][$i],
                                    'ACC_NM' => $_POST['ACC_NMA'][$i],
                                    'ACCTRANREMARK' => $_POST['ACCTRANREMARKA'][$i],
                                    'ACCAMT1' => $_POST['ACCAMT1A'][$i],
                                    'ACCAMT2' => $_POST['ACCAMT2A'][$i],
                                    'SECTION1' => $_POST['SECTION1A'][$i],
                                    'PROJECTNO' => $_POST['PROJECTNOA'][$i],
                                    'ADJFLAG' => $_POST['ADJFLAGA'][$i],
                                    'DC_TYPE' => $_POST['DC_TYPEA'][$i],
                                    'CURRENCY1' => $_POST['CURRENCY1A'][$i],
                                    'I_CURRENCY' => $_POST['I_CURRENCYA'][$i],
                                    'EXRATE' => $_POST['EXRATEA'][$i],
                                    'AMT' => $_POST['AMTA'][$i],
                                    'WHTAXTYP' => $_POST['WHTAXTYPA'][$i],
                                    'TAXINVOICENO' => $_POST['TAXINVOICENOA'][$i],
                                );
    }
    setSessionArray($data);
    // print_r($data['ITEM']);
}

/// add session data of item 
function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'ITEM', 'ACCY', 'YEAR', 'YEAR2', 'MONTH', 'MONTH2', 'RPTFORMTYP', 'ACCYEARVALUE');

    foreach($arr as $k => $v) {
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

function unsetItemData($lineIndex = "") {
    global $data;
    global $systemName;
    $key = empty($key) ? $systemName : $key;
    unset_sys_array($key, 'ITEM', $lineIndex);
    $data = getSessionData();
    // print_r(count($data['ITEM']));
    $data['ITEM'] = array_combine(range(1, count($data['ITEM'])), array_values($data['ITEM']));
    setSessionArray($data);
    // keepAccItemData();
    // print_r($data['ITEM']);
}

function getSystemData($key = "") {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}
?>