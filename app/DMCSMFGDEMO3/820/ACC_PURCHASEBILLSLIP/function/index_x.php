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
$javaFunc = new accPurchaseBilling;
$systemName = strtolower($appcode);
// Table Row
$minrow = 0;
$maxrow = 18;
//--------------------------------------------------------------------------------
//  GET
//--------------------------------------------------------------------------------
if(!empty($_GET)) {
    if(isset($_GET['BILLNO'])) {
        $data['BILLNO'] = isset($_GET['BILLNO']) ? $_GET['BILLNO']: '';
        $query = $javaFunc->get($data['BILLNO']);
        // echo '<pre>';
        // print_r($query);
        // echo '</pre>';
        if(!empty($query)) {
            $data = $query;
            $query1 = $javaFunc->getBSL($query['BILLNO']);
            $data['ITEM'] = $query1;
            // echo '<pre>';
            // print_r($query1);
            // echo '</pre>';
            // echo '<br>';
            $query2 = $javaFunc->NumberCheck($query['BILLNO']);
            $data['SYSEN_PRINT'] = $query2['SYSEN_PRINT'];
            // print_r($numberCheck);
        }
    }
    
    if(!empty($query)) {
        setSessionArray($data); 
    }

    if(checkSessionData()) { $data = getSessionData(); }
}
//--------------------------------------------------------------------------------
//  POST
//--------------------------------------------------------------------------------
if(!empty($_POST)) {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'unsetsession') { unsetSessionData(); }
        if ($_POST['action'] == 'keepdata') { setOldValue(); }
        if ($_POST['action'] == 'DIVISIONCD') { getDiv(); }
        if ($_POST['action'] == 'SUPCURCD') { getCurrency(); }
        if ($_POST['action'] == 'SUPPLIERCD') { getSupplier(); }
        if ($_POST['action'] == 'SEARCH') { searchAP(); } 
        if ($_POST['action'] == 'cancel') { cancel(); }
        if ($_POST['action'] == 'commit') { commit(); }
        if ($_POST['action'] == 'print') { printBilling(); }
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
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$currency = $data['DRPLANG']['CURRENCY'];
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// --------------------------------------------------------------------------//
function getDiv() {
    $javafunc = new accPurchaseBilling;
    $DIVISIONCD = isset($_POST['DIVISIONCD']) ? $_POST['DIVISIONCD']: '';
    $getDiv = $javafunc->getDiv($DIVISIONCD);
    echo json_encode($getDiv);
}

function getCurrency() {
    $javafunc = new accPurchaseBilling;
    $SUPPLIERCD = isset($_POST['SUPPLIERCD']) ? $_POST['SUPPLIERCD']: '';
    $SUPCURCD = isset($_POST['SUPCURCD']) ? $_POST['SUPCURCD']: '';
    $getCurrency = $javafunc->getCurrency($SUPPLIERCD, $SUPCURCD);
    echo json_encode($getCurrency);
}

function getSupplier() {
    $javafunc = new accPurchaseBilling;
    $SUPPLIERCD = isset($_POST['SUPPLIERCD']) ? $_POST['SUPPLIERCD']: '';
    $getSupplier = $javafunc->getSupplier($SUPPLIERCD);
    echo json_encode($getSupplier);
}

function commit() {
    global $data; $RowParam = array();
    $data = getSessionData();
    $javafunc = new accPurchaseBilling;
    if(isset($_POST['CHECKROW'])) {
        for ($i = 0 ; $i < count($_POST['CHECKROW']); $i++) { 
            $RowParam[] = array('ROWNO' => $i+1,
                                'CHECKROW' => $_POST['CHECKROW'][$i],
                                'PURRECORDERNO' => $data['ITEM'][$i+1]['PURRECORDERNO'],
                                'PURRECINSPDT' => $data['ITEM'][$i+1]['PURRECINSPDT'],
                                'PURDUEDT' => $data['ITEM'][$i+1]['PURDUEDT'],
                                'PURRECAMT' => $data['ITEM'][$i+1]['PURRECAMT'],
                                'SUPDISP' => $data['ITEM'][$i+1]['SUPDISP'],
                                'AMT' => $data['ITEM'][$i+1]['AMT'],
                                'VAT' => $data['ITEM'][$i+1]['VAT'],
                                'TOTAL' => $data['ITEM'][$i+1]['TOTAL'],
                                'WTAX' => $data['ITEM'][$i+1]['WTAX'],
                                'NETAMT' => $data['ITEM'][$i+1]['NETAMT'],
                                'COMDISP' => $data['ITEM'][$i+1]['COMDISP']);
        }
    }
    $param = array( 'BILLNO' => isset($_POST['BILLNO']) ? $_POST['BILLNO']: '',
                    'SUPPLIERCD' => isset($_POST['SUPPLIERCD']) ? $_POST['SUPPLIERCD']: '',
                    'SUPCURCD' => isset($_POST['SUPCURCD']) ? $_POST['SUPCURCD']: '',
                    'DIVISIONCD' => isset($_POST['DIVISIONCD']) ? $_POST['DIVISIONCD']: '',
                    'P1' => isset($_POST['P1']) ? str_replace('-', '', $_POST['P1']): '',
                    'P2' => isset($_POST['P2']) ? str_replace('-', '', $_POST['P2']): '',
                    'PBILLSLIPNOTE01' => isset($_POST['PBILLSLIPNOTE01']) ? $_POST['PBILLSLIPNOTE01']: '',
                    'PBILLSLIPNOTE02' => isset($_POST['PBILLSLIPNOTE02']) ? $_POST['PBILLSLIPNOTE02']: '',
                    'PBILLSLIPNOTE03' => isset($_POST['PBILLSLIPNOTE03']) ? str_replace('-', '', $_POST['PBILLSLIPNOTE03']): '',
                    'PBILLSLIPNOTE04' => isset($_POST['PBILLSLIPNOTE04']) ? str_replace('-', '', $_POST['PBILLSLIPNOTE04']): '',
                    'PBILLSLIPNOTE05' => isset($_POST['PBILLSLIPNOTE05']) ? $_POST['PBILLSLIPNOTE05']: '',
                    'INPUTDT' => isset($_POST['INPUTDT']) ? str_replace('-', '', $_POST['INPUTDT']): '',
                    'DATA' => $RowParam);
    // print_r($param);
    $commit = $javafunc->commit($param);
    echo json_encode($commit);
}

function cancel() {
    $BILLNO = isset($_POST['BILLNO']) ? $_POST['BILLNO']: '';
    $cancelfunc = new accPurchaseBilling;
    $cancel = $cancelfunc->cancel($BILLNO);
    echo json_encode($cancel);
}

function searchAP() {
    $searchfunc = new accPurchaseBilling;
    global $data; unsetSessionkey('ITEM'); setOldValue();
    $SUPPLIERCD = isset($_POST['SUPPLIERCD']) ? $_POST['SUPPLIERCD']: '';
    $SUPCURCD = isset($_POST['SUPCURCD']) ? $_POST['SUPCURCD']: '';
    $DIVISIONCD = isset($_POST['DIVISIONCD']) ? $_POST['DIVISIONCD']: '';
    $P1 = isset($_POST['P1']) ? str_replace('-', '', $_POST['P1']): '';
    $P2 = isset($_POST['P2']) ? str_replace('-', '', $_POST['P2']): '';
    $search = $searchfunc->search($SUPPLIERCD, $SUPCURCD, $DIVISIONCD, $P1, $P2);
    if(!empty($search)) {
        $data['ITEM'] = $search; 
    }
    setSessionArray($data);
    if(checkSessionData()) { $data = getSessionData(); }
    // echo '<pre>';
    // print_r($search);
    // echo '</pre>';
}

function printBilling() {

    try {
        $printfunc = new accPurchaseBilling;
        $BILLNO = isset($_POST['BILLNO']) ? $_POST['BILLNO'] : '';
        $Param = array( 'BILLNO' => $BILLNO,
                        'SUPPLIERCD' => isset($_POST['SUPPLIERCD']) ? $_POST['SUPPLIERCD']: '',
                        'PBILLSLIPNOTE03' => isset($_POST['PBILLSLIPNOTE03']) ? str_replace('-', '', $_POST['PBILLSLIPNOTE03']): '',
                        'PBILLSLIPNOTE04' => isset($_POST['PBILLSLIPNOTE04']) ? str_replace('-', '', $_POST['PBILLSLIPNOTE04']): '',
                        'TTL_NETAMT' => isset($_POST['TTL_NETAMT']) ?  str_replace(',', '', $_POST['TTL_NETAMT']): '');
        // print_r($Param);
        $printStatic = $printfunc->printStatic($Param);
        $printDynamic = $printfunc->printDynamic($Param);
        // print_r($printStatic);
        // print_r($printDynamic);
        // exit();
        if(is_array($printDynamic) && is_array($printStatic)) {
           
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
            // Load an existing spreadsheet
            $file_path = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/template/BILLINGSLIP.xlsx';
            $item = 14; // per page
            foreach ($printDynamic as $key => $value) {
                $page = ceil($key/$item); // if($key%$item == 0) {}
                $printDynamic[$key]['PAGE'] = $page;
            }

            for ($x = 1; $x <= $page; $x++) {
                $seq = 2; // row excel new 1 start row 2 
                $sheetExcel[$x] = PHPExcel_IOFactory::load($file_path);
                // --------------------------------------------------
                // Set Active Sheet
                $sheetExcel[$x]->setActiveSheetIndex($sheetData);
                // --------------------------------------------------
                // Set Sheet Name [DATA]
                $sheetExcel[$x]->getActiveSheet()->setTitle('DATA');
                // --------------------------------------------------
                // Write Report Data to Sheet [DATA]
                $sheetExcel[$x]->getActiveSheet()->setCellValue('A1',  $printStatic['COMPNTH'])
                                                ->setCellValue('B1', $printStatic['COMPNEN'])
                                                ->setCellValue('C1', $printStatic['ADDR1'])
                                                ->setCellValue('D1', $printStatic['ADDR2'])
                                                ->setCellValue('E1', $printStatic['TELTH'])
                                                ->setCellValue('F1', $printStatic['FAXTH'])
                                                ->setCellValue('G1', $printStatic['CUSFN'])
                                                ->setCellValue('H1', $printStatic['ADDRCUS1'])
                                                ->setCellValue('I1', $printStatic['ADDRCUS2'])
                                                ->setCellValue('J1', $printStatic['ADDRCUS3'])
                                                ->setCellValue('K1', $printStatic['TELCUS'])
                                                ->setCellValue('L1', $printStatic['FAXCUS'])
                                                ->setCellValue('M1', $printStatic['BSNO'])
                                                ->setCellValue('N1', $printStatic['TDATE'])
                                                ->setCellValue('O1', $printStatic['TTLAMT'])
                                                ->setCellValue('P1', $printStatic['GTOTEN'])
                                                ->setCellValue('Q1', $printStatic['ADATE']);

                //------------- Item List ----------- //                            
                foreach ($printDynamic as $key => $value) {
                    if($value['PAGE'] == $x) { // separate page
                        if ($seq > 14) { $seq = 2; }           
                        $sheetExcel[$x]->getActiveSheet()->setCellValue('A'.$seq,  $value['NUM'])
                                                        ->setCellValue('B'.$seq, $value['PBILLSLIPNO'])
                                                        ->setCellValue('C'.$seq, $value['PBILLSLIPLN'])
                                                        ->setCellValue('D'.$seq, $value['INVNO'])
                                                        ->setCellValue('E'.$seq, $value['DATE'])
                                                        ->setCellValue('F'.$seq, $value['DUDATE'])
                                                        ->setCellValue('G'.$seq, $value['AMT'])
                                                        ->setCellValue('H'.$seq, $value['VAT'])
                                                        ->setCellValue('I'.$seq, $value['TOT'])
                                                        ->setCellValue('J'.$seq, $value['WT'])
                                                        ->setCellValue('K'.$seq, $value['NETAMT'])
                                                        ->setCellValue('L'.$seq, $value['ROWCOUNTER']);
                    }
                    ++$seq; 
                }
                // --------------------------------------------------
                // Set Active Sheet to [REPORT]
                $sheetExcel[$x]->setActiveSheetIndex($sheetRpt);
                // --------------------------------------------------
                $writer = PHPExcel_IOFactory::createWriter($sheetExcel[$x], 'Excel2007');
                // Save Excel Report File on Server
                $report_file = $BILLNO.'_'.$x.'_'.date('Ymd_Hi').'.xlsx';
                $download_path = '/report/'.$_SESSION['COMCD'].'/output/'.$_SESSION['USERCODE'].'/'.$report_file;
                $report_path = $outputPath.'/'.$report_file;
                $writer->save($report_path);
                // print_r($download_path);
                // Response Excel Report File URL
                // array_push($response, array('url' => $download_path,
                //                             'filename' => $report_file));
                // echo json_encode($response);
                // exit();
                // --------------------------------------------------
                // ----------------------------------------------------------------------------------------------------
                // --------------------------------------------------
                // Generate PDF Report File
                // --------------------------------------------------
                // --------------------------------------------------
                $pdf_name = $BILLNO.'_'.$x.'_'.date('Ymd_Hi').'.pdf';
                $pdf_download_path = '/report/'.$_SESSION['COMCD'].'/output/'.$_SESSION['USERCODE'].'/'.$pdf_name;
                $pdf_path = $outputPath.'/'.$pdf_name;
                $rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
                $rendererLibraryPath = dirname(__FILE__, 6).'/common/PHPExcel/tcpdf';
                if(!PHPExcel_Settings::setPdfRenderer($rendererName, $rendererLibraryPath)) {
                    die('NOTICE: Please set the $rendererName and $rendererLibraryPath values' .'<br />' .'at the top of s script as appropriate for your directory structure');
                }
                // $sheetExcel[$x] = PHPExcel_IOFactory::load($report_path);
                // $sheetExcel[$x]->setActiveSheetIndex($sheetRpt);
                // --------------------------------------------------
                $sheetExcel[$x]->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
                $sheetExcel[$x]->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
                $sheetExcel[$x]->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
                // $sheetExcel[$x]->getActiveSheet()->getPageSetup()->setVerticalCentered(false);
                $sheetExcel[$x]->getActiveSheet()->getPageSetup()->setFitToHeight(true);
                $sheetExcel[$x]->getActiveSheet()->getPageSetup()->setFitToWidth(true);
                $sheetExcel[$x]->getActiveSheet()->setShowGridLines(false);

                $sheetExcel[$x]->getActiveSheet()->getPageMargins()->setTop(0.3);
                $sheetExcel[$x]->getActiveSheet()->getPageMargins()->setBottom(0.2);
                $sheetExcel[$x]->getActiveSheet()->getPageMargins()->setLeft(0.6);
                $sheetExcel[$x]->getActiveSheet()->getPageMargins()->setRight(0.6);    

                $pdf_writer = PHPExcel_IOFactory::createWriter($sheetExcel[$x], 'PDF');
                $pdf_writer->save($pdf_path);
                // --------------------------------------------------
                // --------------------------------------------------
                // Response PDF Report File URL
                array_push($response, array('url' => $pdf_download_path,
                                            'filename' => $pdf_name));
                // --------------------------------------------------
                // --------------------------------------------------       
                echo json_encode($response);
                // --------------------------------------------------
            }
            // ----------------------------------------------------------------------------------------------------
            exit;
            // ----------------------------------------------------------------------------------------------------
        }
    } catch(Exception $ex) {
        // print_r($ex);
    }
    // ----------------------------------------------------------------------------------------------------
}

function setOldValue() {
    setSessionArray($_POST); 
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
}

/// add session data of item 
function setSessionArray($arr) {
    $keepField = array( 'SYSPVL', 'TXTLANG', 'DRPLANG', 'ITEM', 'SYSVIS_COMMIT', 'SYSVIS_CANCEL', 'BILLNO', 'INPUTDT', 'SUPPLIERCD', 'SUPPLIERNAME', 'SUPPLIERADDR1', 'SUPPLIERADDR2', 'SUPCURCD', 'SUPCURDISP', 'DIVISIONCD', 'DIVISIONNAME', 'P1', 'P2', 'PPBILLSLIPNOTE01', 'PPBILLSLIPNOTE2', 'PPBILLSLIPNOTE3', 'PPBILLSLIPNOTE4', 'PPBILLSLIPNOTE5', 'TTL_NETAMT', 'CHKALL', 'SYSEN_SUPPLIERCD', 'SYSEN_SUPCURCD', 'SYSEN_DIVISIONCD', 'SYSEN_DIVISIONCD', 'SYSEN_P1', 'SYSEN_P2', 'SYSEN_SEARCH', 'SYSEN_DVW', 'SYSEN_COMMIT', 'SYSEN_CANCEL', 'SYSVIS_CANCELLBL', 'SYSEN_PRINT', 'SYSEN_PBILLSLIPNOTE01', 'SYSEN_PBILLSLIPNOTE02', 'SYSEN_PBILLSLIPNOTE03', 'SYSEN_PBILLSLIPNOTE04', 'SYSEN_PBILLSLIPNOTE05');
    foreach($arr as $k => $v) {
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

function unsetSessionkey($key) {
    global $systemName;
    $sysnm = empty($sysnm) ? $systemName : $sysnm;
    return unset_sys_key($sysnm, $key);
}

function getSystemData($key = '') {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}

// function printBilling() {
//     global $data;
//     $data = getSessionData();
//     $printfunc = new accPurchaseBilling;
//     $Param = array( 'BILLNO' => $data['BILLNO'],
//                     'SUPPLIERCD' => $data['SUPPLIERCD'],
//                     'PBILLSLIPNOTE03' => isset($_POST['PBILLSLIPNOTE03']) ? str_replace('-', '', $_POST['PBILLSLIPNOTE03']): '',
//                     'PBILLSLIPNOTE04' => isset($_POST['PBILLSLIPNOTE04']) ? str_replace('-', '', $_POST['PBILLSLIPNOTE04']): '',
//                     'TTL_NETAMT' => isset($data['TTL_NETAMT']) ? $data['TTL_NETAMT']: '');
//     // print_r($Param);
//     $printStatic = $printfunc->printStatic($Param);
//     $printDynamic = $printfunc->printDynamic($Param);
//     $data['PRINTSTATIC'] = $printStatic;
//     if(!empty($printDynamic)) {
//         $data['PRINTDYNAMIC'] = $printDynamic;
//         setSessionArray($data);
//     }
//     // echo '<pre>';
//     // print_r($data['PRINTSTATIC']);
//     // echo '</pre>';
//     // echo '<pre>';
//     // print_r($data['PRINTDYNAMIC']);
//     // echo '</pre>';
// }
?>