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
$javaFunc = new SaleEntryTHA;
$systemName = strtolower($appcode);
$minrow = 0;
$maxrow = 8;
// https://web-develop.dmcs.biz/boom
// http://acc01.dmcs.biz/
// 127.0.0.1:8080
if(!empty($_GET)) {
    if(!empty($_GET['SALETRANNO'])) {
        unsetSessionData();
        $query = $javaFunc->getST($_GET['SALETRANNO']);
        // echo '<pre>';
        // print_r($query);
        // echo '</pre>';
        if(!empty($query['SALETRANNO'])) { 
            $query2 = $javaFunc->getST2($query['SALETRANNO']);
            $data = $query;
            if(!empty($query2)) {
                $data['CUSCURCD'] = $query2['CUSCURCD'];
                $data['CUSCURDISP'] = $query2['CUSCURDISP'];
                $data['S_TTL'] = $query2['S_TTL'];
                $data['DISCRATE'] = $query2['DISCRATE'];
                $data['DISCOUNTAMOUNT'] = $query2['DISCOUNTAMOUNT'];
                $data['QUOTEAMOUNT'] = $query2['QUOTEAMOUNT'];
                $data['VATRATE'] = $query2['VATRATE'];
                $data['VATAMOUNT'] = $query2['VATAMOUNT'];
                $data['VATAMOUNT1'] = $query2['VATAMOUNT1'];
                $data['T_AMOUNT'] = $query2['T_AMOUNT'];
                $data['T_AMOUNT1'] = $query2['T_AMOUNT'];           
            }
            // print_r($query);
            $itemlist = $javaFunc->getSTLn($query['SALETRANNO']);
            // echo '<pre>';
            // print_r($itemlist);
            // echo '</pre>';
            if(!empty($itemlist)) {
                $data['ITEM'] = $itemlist;
            }
        }
    } else if(!empty($_GET['SALEORDERNO'])) {
        unsetSessionData();
        $query = $javaFunc->getSO($_GET['SALEORDERNO']);
        $data = $query;
        if(!empty($query['SALEORDERNO'])) {
            $query2 = $javaFunc->getSO2($query['SALEORDERNO'], $query['SALETRANNO']);
            // print_r($query);
            // print_r($query2);
            if(!empty($query2)) {
                $data['CUSCURCD'] = $query2['CUSCURCD'];
                $data['CUSCURDISP'] = $query2['CUSCURDISP'];
                $data['S_TTL'] = $query2['S_TTL'];
                $data['DISCRATE'] = $query2['DISCRATE'];
                $data['DISCOUNTAMOUNT'] = $query2['DISCOUNTAMOUNT'];
                $data['QUOTEAMOUNT'] = $query2['QUOTEAMOUNT'];
                $data['VATRATE'] = $query2['VATRATE'];
                $data['VATAMOUNT'] = $query2['VATAMOUNT'];
                $data['T_AMOUNT'] = $query2['T_AMOUNT'];
                $data['T_AMOUNT1'] = $query2['T_AMOUNT'];           
            }
            $itemlist = $javaFunc->getSOLn($query['SALEORDERNO'], $query['SALETRANNO']);
            // echo '<pre>';
            // print_r($itemlist);
            // echo '</pre>';
            if(!empty($itemlist)) {
                $data['ITEM'] = $itemlist;
            }
        }
    }

    if(!empty($query)) {
        setSessionArray($data); 
    }
    if(checkSessionData()) { $data = getSessionData(); }

    if(!empty($_GET['ITEMCD'])) {
        // print_r($data);
        $Param = array( 'CUSCURCD' => isset($data['CUSCURCD']) ? $data['CUSCURCD']: '',
                        'ITEMCD' => isset($_GET['ITEMCD']) ? $_GET['ITEMCD']: '',
                        'CUSTOMERCD' => isset($data['CUSTOMERCD']) ? $data['CUSTOMERCD']: '',
                        'SALEQTY' => '',
                        'DISCRATE' => '',
                        'UNITPRICE' => '',
                        'VATRATE' => isset($data['VATRATE']) ?  $data['VATRATE']: '');
        // print_r($Param);
        $item_data = $javaFunc->getItem($Param);
        // echo '<pre>';
        // print_r($item_data);
        // echo '</pre>';
        // $data['ITEM'][$_GET['index']] = $item_data;
        $data['ITEM'][$_GET['index']] = array(  'ROWNO' => $_GET['index'],
                                                'ITEMCD' => $item_data['ITEMCD'],
                                                'ITEMNAME' => $item_data['ITEMNAME'],
                                                'SALEQTY' => isset($item_data['SALEQTY']) ? $item_data['SALEQTY']: '0.00',
                                                'ITEMUNITTYP' => $item_data['ITEMUNITTYP'],
                                                'SALEUNITPRC' => isset($item_data['SALEUNITPRC']) ? $item_data['SALEUNITPRC']: '0.00',
                                                'SALEDISCOUNT' => isset($item_data['SALEDISCOUNT']) ? $item_data['SALEDISCOUNT']: '0.00',
                                                'SALEAMT' => isset($item_data['SALEAMT']) ? $item_data['SALEAMT']: '0.00',
                                                'SALEDISCOUNT2' => $item_data['SALEDISCOUNT2'],
                                                'SALETAXAMT' => isset($item_data['SALETAXAMT']) ? $item_data['SALETAXAMT']: '0.00',
                                                'SALELN' => isset($item_data['SALELN']) ? $item_data['SALELN']: '0.00',
                                                'SALEORDERQTY' => isset($item_data['SALEORDERQTY']) ? $item_data['SALEORDERQTY']: '0.00');
        // echo '<pre>';
        // print_r($data['ITEM']);
        // echo '</pre>';
        // $data['ITEM'] = array_combine(range(1, count($data['ITEM'])), array_values($data['ITEM']));
        // print_r($data['ITEM']);
        if(!empty($item_data)) {
            setSessionArray($data);
        }
    }
    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';
}

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'unsetsession') { unsetSessionData(); }
    if ($_POST['action'] == 'unsetsessionItem') {  unsetSesstionItem($_POST['lineIndex']); }
    if ($_POST['action'] == 'keepdata') { setOldValue(); }
    if ($_POST['action'] == 'keepItemData') { setItemValue(); }
    if ($_POST['action'] == 'DIVISIONCD') { getDivision(); }
    if ($_POST['action'] == 'CUSTOMERCD') { getCustomer(); }
    if ($_POST['action'] == 'CUSCURCD') { getCurrency(); }
    if ($_POST['action'] == 'STAFFCD') { getStaff(); }
    if ($_POST['action'] == 'getAmt') { getAmt(); }
    if ($_POST['action'] == 'commit') { commit(); }
    if ($_POST['action'] == 'ivprintcheck') { iVprintCheck();}
    if ($_POST['action'] == 'svprintcheck') { sVprintCheck();}
    if ($_POST['action'] == 'SVPrint') { saleVoucher(); }
    if ($_POST['action'] == 'IVprint') { invoice(); }
    if ($_POST['action'] == 'TIVprint') { taxInvoice(); }

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
$loadevent = getSystemData($_SESSION['APPCODE'].'_EVENT');
if(empty($loadevent)) {
    $loadevent = $syslogic->loadEvent($_SESSION['APPCODE']);
    setSystemData($_SESSION['APPCODE'].'_EVENT', $loadevent);
}
$data['TXTLANG'] = get_sys_lang($loadApp);
$data['DRPLANG'] = get_sys_dropdown($loadApp);
$data['GROUPRT'] = $loadevent['GROUPRT'];
$branchkbn = $data['DRPLANG']['BRANCH_KBN'];
setSessionArray($data);
// print_r($data['SYSPVL']);
// echo '<pre>';
// print_r($data['TXTLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($data['DRPLANG']);
// echo '</pre>';
// echo '<pre>';
// print_r($loadevent);
// echo '</pre>';
// echo '<pre>';
// print_r($data);
// echo '</pre>';
// --------------------------------------------------------------------------//
function getDivision() {
    $javafunc = new SaleEntryTHA;
    $DIVISIONCD = isset($_POST['DIVISIONCD']) ? $_POST['DIVISIONCD']: '';
    $query = $javafunc->getDivision($DIVISIONCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getCustomer() {
    $javafunc = new SaleEntryTHA;
    $CUSTOMERCD = isset($_POST['CUSTOMERCD']) ? $_POST['CUSTOMERCD']: '';
    $query = $javafunc->getCustomer($CUSTOMERCD);
    if(!empty($query)) { $data = $query; }
    $data['QUOTEAMOUNT'] = '0.00';
    $data['VATAMOUNT'] = '0.00';
    $data['VATAMOUNT1'] = '0.00';
    $data['T_AMOUNT'] = '0.00';
    $data['T_AMOUNT1'] = '0.00';
    if(!empty($query)) { setSessionArray($data); }
    echo json_encode($query);
}  

function getStaff() {
    $javafunc = new SaleEntryTHA;
    $STAFFCD = isset($_POST['STAFFCD']) ? $_POST['STAFFCD']: '';
    $query = $javafunc->getStaff($STAFFCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function getCurrency() {
    $javafunc = new SaleEntryTHA;
    $CUSCURCD = isset($_POST['CUSCURCD']) ? $_POST['CUSCURCD']: '';
    $query = $javafunc->getCurrency($CUSCURCD);
    if(!empty($query)) { setSessionArray($query); }
    echo json_encode($query);
}  

function commit() {
    $cmtfunc = new SaleEntryTHA;
    for ($i = 0 ; $i < count($_POST['ITEMCD']); $i++) { 
        $RowParam[] = array('ROWNO' => $i+1,
                            'ITEMCD' => $_POST['ITEMCD'][$i],
                            'ITEMNAME' => $_POST['ITEMNAME'][$i],
                            'SALEQTY' => isset($_POST['SALEQTY'][$i]) ? implode(explode(',', $_POST['SALEQTY'][$i])): '0.00',
                            'ITEMUNITTYP' => $_POST['ITEMUNITTYP'][$i],
                            'SALEUNITPRC' => isset($_POST['SALEUNITPRC'][$i]) ? implode(explode(',', $_POST['SALEUNITPRC'][$i])): '0.00',
                            'SALEDISCOUNT' => isset($_POST['SALEDISCOUNT'][$i]) ? implode(explode(',', $_POST['SALEDISCOUNT'][$i])): '0.00',
                            'SALEAMT' => isset($_POST['SALEAMT'][$i]) ? implode(explode(',', $_POST['SALEAMT'][$i])): '0.00',
                            'SALEDISCOUNT2' => $_POST['SALEDISCOUNT2'][$i],
                            'SALETAXAMT' => isset($_POST['SALETAXAMT'][$i]) ? implode(explode(',', $_POST['SALETAXAMT'][$i])): '0.00',
                            'SALELN' => isset($_POST['SALELN'][$i]) ? implode(explode(',', $_POST['SALELN'][$i])): '0.00',
                            'SALEORDERQTY' => isset($_POST['SALEORDERQTY'][$i]) ? implode(explode(',', $_POST['SALEORDERQTY'][$i])): '0.00');
    }
    // print_r($RowParam);
    $param = array( 'SALETRANNO' => isset($_POST['SALETRANNO']) ? $_POST['SALETRANNO']: '',
                    'SVNO' => isset($_POST['SVNO']) ? $_POST['SVNO']: '',
                    'SALETRANSALEDT' => str_replace('-', '', $_POST['SALETRANSALEDT']),
                    'SALETRANINSPDT' => str_replace('-', '', $_POST['SALETRANINSPDT']),
                    'SALEORDERNO' => $_POST['SALEORDERNO'],
                    'DIVISIONCD' => $_POST['DIVISIONCD'],
                    'DIVISIONNAME' => $_POST['DIVISIONNAME'],
                    'STAFFCD' => $_POST['STAFFCD'],
                    'CUSTOMERCD' => $_POST['CUSTOMERCD'],
                    'ESTCUSTEL' => $_POST['ESTCUSTEL'],
                    'ESTCUSFAX' => $_POST['ESTCUSFAX'],
                    'ESTCUSSTAFF' => $_POST['ESTCUSSTAFF'],
                    'SALEDIVCON1' => $_POST['SALEDIVCON1'],
                    'SALEDIVCON2' => $_POST['SALEDIVCON2'],
                    'SALEDIVCON3' => $_POST['SALEDIVCON3'],
                    'SALEDIVCON4' => isset($_POST['SALEDIVCON4']) ? $_POST['SALEDIVCON4']: '',
                    'DESCRIPTION' => $_POST['DESCRIPTION'],
                    'SALETERM' => $_POST['SALETERM'],
                    'SALECUSMEMO' => $_POST['SALECUSMEMO'],
                    'CUSCURCD' => $_POST['CUSCURCD'],
                    'SALELNDUEDT' => isset($_POST['SALELNDUEDT']) ? str_replace('-', '', $_POST['SALELNDUEDT']) :'',
                    'S_TTL' => isset($_POST['S_TTL']) ? implode(explode(',', $_POST['S_TTL'])): '0.00',
                    'DISCRATE' => isset($_POST['DISCRATE']) ? $_POST['DISCRATE']: '0',
                    'DISCOUNTAMOUNT' => isset($_POST['DISCOUNTAMOUNT']) ? implode(explode(',', $_POST['DISCOUNTAMOUNT'])): '0.00',
                    'QUOTEAMOUNT' => isset($_POST['QUOTEAMOUNT']) ? implode(explode(',', $_POST['QUOTEAMOUNT'])): '0.00',
                    'VATRATE' => $_POST['VATRATE'],
                    'VATAMOUNT' => isset($_POST['VATAMOUNT']) ? implode(explode(',', $_POST['VATAMOUNT'])): '0.00',
                    'VATAMOUNT1' => isset($_POST['VATAMOUNT1']) ? implode(explode(',', $_POST['VATAMOUNT1'])): '0.00',
                    'T_AMOUNT' => isset($_POST['T_AMOUNT']) ? implode(explode(',', $_POST['T_AMOUNT'])): '0.00',
                    'DATA' => $RowParam);
    // print_r($param);
    $commit = $cmtfunc->commit($param);
    // unsetSessionData();
    echo json_encode($commit);
}

function invoice() {

    try {
        $printfunc = new SaleEntryTHA;
        $SALETRANNO = isset($_POST['SALETRANNO']) ? $_POST['SALETRANNO']: '';
        $param = array( 'SALETRANNO' => $SALETRANNO,
                        'REPRINTREASON' => isset($_POST['REPRINTREASON']) ? $_POST['REPRINTREASON']: '');
        $printStatic = $printfunc->IVprintStatic($param);
        $printDynamic = $printfunc->IVprintDynamic($param);        
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
            $PAGES = 2; // Pages
            // --------------------------------------------------
            $response = array();
            // Load an existing spreadsheet
            $file_path = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/template/ACC_SALEENTRY_THA2_INVOICE.xlsx';

            for ($page = 1; $page <= $PAGES ; $page++) { 
                
                $invoiceType; // invoice Type
                $seq = 2; // row excel new 1 start row 2

                $sheetExcel[$page] = PHPExcel_IOFactory::load($file_path);
                // --------------------------------------------------
                // Set Active Sheet
                $sheetExcel[$page]->setActiveSheetIndex($sheetData);
                // --------------------------------------------------
                // Set Sheet Name [DATA]
                $sheetExcel[$page]->getActiveSheet()->setTitle('DATA');
                // --------------------------------------------------

                // Write Report Data to Sheet [DATA]
                $sheetExcel[$page]->getActiveSheet()->setCellValue('A1', $printStatic['COMPNEN'])
                                                    ->setCellValue('B1', $printStatic['COMPNTH'])
                                                    ->setCellValue('C1', $printStatic['ADDREN'])
                                                    ->setCellValue('D1', $printStatic['ADDRTH'])
                                                    ->setCellValue('E1', $printStatic['TELO'])
                                                    ->setCellValue('F1', $printStatic['FAXO'])
                                                    ->setCellValue('G1', $printStatic['TAXNO'])
                                                    ->setCellValue('H1', $printStatic['DEPT'])
                                                    ->setCellValue('I1', $printStatic['REPRINTREASON'])
                                                    ->setCellValue('J1', $printStatic['SYSVIS_REPRINTREASONLBL']);

                //------------- Item List ----------- //    
                foreach ($printDynamic as $key => $value) {
                    if($value['IDXNO'] == $page) { // separate page
                        $seq = $value['NUM'] + 1;
                        $invoiceType = $value['INVTITLE'];

                        $sheetExcel[$page]->getActiveSheet()->setCellValue('A'.$seq, $value['IDXNO'])
                                                            ->setCellValue('B'.$seq, $value['RPTTITLE'])
                                                            ->setCellValue('C'.$seq, $value['RPTTITLETH'])
                                                            ->setCellValue('D'.$seq, $value['INVTITLE'])
                                                            ->setCellValue('E'.$seq, $value['INVTITLETH'])
                                                            ->setCellValue('F'.$seq, $value['CUSTOMERCD'])
                                                            ->setCellValue('G'.$seq, $value['CUSNM'])
                                                            ->setCellValue('H'.$seq, $value['ADDRCUS1'])
                                                            ->setCellValue('I'.$seq, $value['ADDRCUS2'])
                                                            ->setCellValue('J'.$seq, $value['ADDRCUS3'])
                                                            ->setCellValue('K'.$seq, $value['CTEL'])
                                                            ->setCellValue('L'.$seq, $value['CFAX'])
                                                            ->setCellValue('M'.$seq, $value['SONUM'])
                                                            ->setCellValue('N'.$seq, $value['TAXID'])
                                                            ->setCellValue('O'.$seq, $value['OFFICE'])
                                                            ->setCellValue('P'.$seq, $value['SAVONUM'])
                                                            ->setCellValue('Q'.$seq, $value['INDATE'])
                                                            ->setCellValue('R'.$seq, $value['PTERM'])
                                                            ->setCellValue('S'.$seq, $value['DDATE'])
                                                            ->setCellValue('T'.$seq, $value['PONUM'])
                                                            ->setCellValue('U'.$seq, $value['NUM'])
                                                            ->setCellValue('V'.$seq, $value['CODE'])
                                                            ->setCellValue('W'.$seq, $value['ITEMDESC'])
                                                            ->setCellValue('X'.$seq, $value['QTY'])
                                                            ->setCellValue('Y'.$seq, $value['DIS'])
                                                            ->setCellValue('Z'.$seq, $value['UPR'])
                                                            ->setCellValue('AA'.$seq, $value['AMT'])
                                                            ->setCellValue('AB'.$seq, $value['TOTALAMT'])
                                                            ->setCellValue('AC'.$seq, $value['LDIS'])
                                                            ->setCellValue('AD'.$seq, $value['AFDIS'])
                                                            ->setCellValue('AE'.$seq, $value['TVAT'])
                                                            ->setCellValue('AF'.$seq, $value['GTOT'])
                                                            ->setCellValue('AG'.$seq, $value['PVAT'])
                                                            ->setCellValue('AH'.$seq, $value['GTOTEN'])
                                                            ->setCellValue('AI'.$seq, $value['GTOTEN'])
                                                            ->setCellValue('AJ'.$seq, $value['GTOTTH'])
                                                            ->setCellValue('AK'.$seq, $value['CUR'])
                                                            ->setCellValue('AL'.$seq, $value['SALEDIVCON1'])
                                                            ->setCellValue('AM'.$seq, $value['SALEDIVCON2'])
                                                            ->setCellValue('AN'.$seq, $value['SALEDIVCON3'])
                                                            ->setCellValue('AO'.$seq, $value['CUSPONO']);
                    }
                }

                // --------------------------------------------------
                // Set Active Sheet to [REPORT]
                $sheetExcel[$page]->setActiveSheetIndex($sheetRpt);
                // --------------------------------------------------
                $writer = PHPExcel_IOFactory::createWriter($sheetExcel[$page], 'Excel2007');
                // Save Excel Report File on Server
                $report_file = $SALETRANNO.'_'.$invoiceType.'_'.date('Ymd_Hi').'.xlsx';
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
                $pdf_name = $SALETRANNO.'_'.$invoiceType.'_'.date('Ymd_Hi').'.pdf';
                $pdf_download_path = '/report/'.$_SESSION['COMCD'].'/output/'.$_SESSION['USERCODE'].'/'.$pdf_name;
                $pdf_path = $outputPath.'/'.$pdf_name;
                $rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
                $rendererLibraryPath = dirname(__FILE__, 6).'/common/PHPExcel/tcpdf';
                if(!PHPExcel_Settings::setPdfRenderer($rendererName, $rendererLibraryPath)) {
                    die('NOTICE: Please set the $rendererName and $rendererLibraryPath values' .'<br />' .'at the top of s script as appropriate for your directory structure');
                }
                // $sheetPDF[$page] = PHPExcel_IOFactory::load($report_path);
                // $sheetPDF[$page]->setActiveSheetIndex($sheetRpt);
                $sheetExcel[$page]->getActiveSheet()->getStyle('H23:H37')->getNumberFormat()->setFormatCode('#,##.00');
                $sheetExcel[$page]->getActiveSheet()->getStyle('L41:M41')->getNumberFormat()->setFormatCode('#,##.00');
                // $sheetExcel[$page]->getActiveSheet()->getStyle('D9:J9')->getFont()->setSize(12);
            
                // --------------------------------------------------
                $sheetExcel[$page]->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
                $sheetExcel[$page]->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
                $sheetExcel[$page]->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
                // $sheetExcel[$page]->getActiveSheet()->getPageSetup()->setVerticalCentered(false);
                $sheetExcel[$page]->getActiveSheet()->getPageSetup()->setFitToHeight(true);
                $sheetExcel[$page]->getActiveSheet()->getPageSetup()->setFitToWidth(true);
                $sheetExcel[$page]->getActiveSheet()->setShowGridLines(false);

                $sheetExcel[$page]->getActiveSheet()->getPageMargins()->setTop(0.5);
                $sheetExcel[$page]->getActiveSheet()->getPageMargins()->setLeft(0.4);
                $sheetExcel[$page]->getActiveSheet()->getPageMargins()->setRight(0.5);           
                $sheetExcel[$page]->getActiveSheet()->getPageMargins()->setBottom(0.5);

                $pdf_writer = PHPExcel_IOFactory::createWriter($sheetExcel[$page], 'PDF');
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
        }
        // ----------------------------------------------------------------------------------------------------
        // ----------------------------------------------------------------------------------------------------
        exit;
        // ----------------------------------------------------------------------------------------------------

    } catch(Exception $ex) {
        // print_r($ex);
    }
    // ----------------------------------------------------------------------------------------------------
}

function taxInvoice() {

    try {
        $printfunc = new SaleEntryTHA;
        $SALETRANNO = isset($_POST['SALETRANNO']) ? $_POST['SALETRANNO']: '';
        $param = array( 'SALETRANNO' => isset($_POST['SALETRANNO']) ? $_POST['SALETRANNO']: '',
                        'REPRINTREASON' => isset($_POST['REPRINTREASON']) ? $_POST['REPRINTREASON']: '');
        $printStatic = $printfunc->TIVprintStatic($param);
        $printDynamic = $printfunc->TIVprintDynamic($param);
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
            $file_path = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/template/ACC_SALEENTRY_THA2_TAXINVOICE.xlsx';

            $sheetExcel = PHPExcel_IOFactory::load($file_path);
            // --------------------------------------------------
            // Set Active Sheet
            $sheetExcel->setActiveSheetIndex($sheetData);
            // --------------------------------------------------
            // Set Sheet Name [DATA]
            $sheetExcel->getActiveSheet()->setTitle('DATA');
            // --------------------------------------------------

            // Write Report Data to Sheet [DATA]
            $sheetExcel->getActiveSheet()->setCellValue('A1', $printStatic['COMPNEN'])
                                                ->setCellValue('B1', $printStatic['COMPNTH'])
                                                ->setCellValue('C1', $printStatic['ADDREN'])
                                                ->setCellValue('D1', $printStatic['ADDRTH'])
                                                ->setCellValue('E1', $printStatic['TELO'])
                                                ->setCellValue('F1', $printStatic['FAXO'])
                                                ->setCellValue('G1', $printStatic['TAXNO'])
                                                ->setCellValue('H1', $printStatic['DEPT'])
                                                ->setCellValue('I1', $printStatic['REPRINTREASON'])
                                                ->setCellValue('J1', $printStatic['SYSVIS_REPRINTREASONLBL']);

            //------------- Item List ----------- //    
            foreach ($printDynamic as $key => $value) {

                $sheetExcel->getActiveSheet()->setCellValue('A'.$key+1, $value['IDXNO'])
                                                    ->setCellValue('B'.$key+1, $value['RPTTITLE'])
                                                    ->setCellValue('C'.$key+1, $value['RPTTITLETH'])
                                                    ->setCellValue('D'.$key+1, $value['INVTITLE'])
                                                    ->setCellValue('E'.$key+1, $value['INVTITLETH'])
                                                    ->setCellValue('F'.$key+1, $value['CUSTOMERCD'])
                                                    ->setCellValue('G'.$key+1, $value['CUSNM'])
                                                    ->setCellValue('H'.$key+1, $value['ADDRCUS1'])
                                                    ->setCellValue('I'.$key+1, $value['ADDRCUS2'])
                                                    ->setCellValue('J'.$key+1, $value['ADDRCUS3'])
                                                    ->setCellValue('K'.$key+1, $value['CTEL'])
                                                    ->setCellValue('L'.$key+1, $value['CFAX'])
                                                    ->setCellValue('M'.$key+1, $value['SONUM'])
                                                    ->setCellValue('N'.$key+1, $value['TAXID'])
                                                    ->setCellValue('O'.$key+1, $value['OFFICE'])
                                                    ->setCellValue('P'.$key+1, $value['SAVONUM'])
                                                    ->setCellValue('Q'.$key+1, $value['INDATE'])
                                                    ->setCellValue('R'.$key+1, $value['PTERM'])
                                                    ->setCellValue('S'.$key+1, $value['DDATE'])
                                                    ->setCellValue('T'.$key+1, $value['PONUM'])
                                                    ->setCellValue('U'.$key+1, $value['NUM'])
                                                    ->setCellValue('V'.$key+1, $value['CODE'])
                                                    ->setCellValue('W'.$key+1, $value['ITEMDESC'])
                                                    ->setCellValue('X'.$key+1, $value['QTY'])
                                                    ->setCellValue('Y'.$key+1, $value['DIS'])
                                                    ->setCellValue('Z'.$key+1, $value['UPR'])
                                                    ->setCellValue('AA'.$key+1, $value['AMT'])
                                                    ->setCellValue('AB'.$key+1, $value['TOTALAMT'])
                                                    ->setCellValue('AC'.$key+1, $value['LDIS'])
                                                    ->setCellValue('AD'.$key+1, $value['AFDIS'])
                                                    ->setCellValue('AE'.$key+1, $value['TVAT'])
                                                    ->setCellValue('AF'.$key+1, $value['GTOT'])
                                                    ->setCellValue('AG'.$key+1, $value['PVAT'])
                                                    ->setCellValue('AH'.$key+1, $value['GTOTEN'])
                                                    ->setCellValue('AI'.$key+1, $value['GTOTEN'])
                                                    ->setCellValue('AJ'.$key+1, $value['GTOTTH'])
                                                    ->setCellValue('AK'.$key+1, $value['CUR'])
                                                    ->setCellValue('AL'.$key+1, $value['SALEDIVCON1'])
                                                    ->setCellValue('AM'.$key+1, $value['SALEDIVCON2'])
                                                    ->setCellValue('AN'.$key+1, $value['SALEDIVCON3'])
                                                    ->setCellValue('AO'.$key+1, $value['CUSPONO']);
            }
            // --------------------------------------------------
            // Set Active Sheet to [REPORT]
            $sheetExcel->setActiveSheetIndex($sheetRpt);
            // --------------------------------------------------
            $writer = PHPExcel_IOFactory::createWriter($sheetExcel, 'Excel2007');
            // Save Excel Report File on Server
            $report_file = $SALETRANNO.'_TAX INVOICE_'.date('Ymd_Hi').'.xlsx';
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
            $pdf_name = $SALETRANNO.'_TAX INVOICE_'.date('Ymd_Hi').'.pdf';
            $pdf_download_path = '/report/'.$_SESSION['COMCD'].'/output/'.$_SESSION['USERCODE'].'/'.$pdf_name;
            $pdf_path = $outputPath.'/'.$pdf_name;
            $rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
            $rendererLibraryPath = dirname(__FILE__, 6).'/common/PHPExcel/tcpdf';
            if(!PHPExcel_Settings::setPdfRenderer($rendererName, $rendererLibraryPath)) {
                die('NOTICE: Please set the $rendererName and $rendererLibraryPath values' .'<br />' .'at the top of s script as appropriate for your directory structure');
            }
            // $sheetPDF = PHPExcel_IOFactory::load($report_path);
            // $sheetPDF->setActiveSheetIndex($sheetRpt);
            $sheetExcel->getActiveSheet()->getStyle('H23:H37')->getNumberFormat()->setFormatCode('#,##.00');
            $sheetExcel->getActiveSheet()->getStyle('L41:M41')->getNumberFormat()->setFormatCode('#,##.00');
            // $sheetExcel->getActiveSheet()->getStyle('D9:J9')->getFont()->setSize(12);
        
            // --------------------------------------------------
            $sheetExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
            $sheetExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
            $sheetExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
            // $sheetExcel->getActiveSheet()->getPageSetup()->setVerticalCentered(false);
            $sheetExcel->getActiveSheet()->getPageSetup()->setFitToHeight(true);
            $sheetExcel->getActiveSheet()->getPageSetup()->setFitToWidth(true);
            $sheetExcel->getActiveSheet()->setShowGridLines(false);

            $sheetExcel->getActiveSheet()->getPageMargins()->setTop(0.5);
            $sheetExcel->getActiveSheet()->getPageMargins()->setLeft(0.4);
            $sheetExcel->getActiveSheet()->getPageMargins()->setRight(0.5);           
            $sheetExcel->getActiveSheet()->getPageMargins()->setBottom(0.5);

            $pdf_writer = PHPExcel_IOFactory::createWriter($sheetExcel, 'PDF');
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
        // ----------------------------------------------------------------------------------------------------
        exit;
        // ----------------------------------------------------------------------------------------------------

    } catch(Exception $ex) {
        // print_r($ex);
    }
    // ----------------------------------------------------------------------------------------------------
}

function saleVoucher() {

    try {
        $printfunc = new SaleEntryTHA;
        $SVNO = isset($_POST['SVNO']) ? $_POST['SVNO']: '';
        $SALETRANNO = isset($_POST['SALETRANNO']) ? $_POST['SALETRANNO']: '';
        $param = array( 'SALETRANNO' => $SALETRANNO,
                        'SVNO' => $SVNO,
                        'SALETRANINSPDT' =>  isset($_POST['SALETRANINSPDT']) ? str_replace('-', '', $_POST['SALETRANINSPDT']) :'',
                        'CUSTOMERNAME' => isset($_POST['CUSTOMERNAME']) ? $_POST['CUSTOMERNAME']: '',
                        'SALEDIVCON1' => isset($_POST['SALEDIVCON1']) ? $_POST['SALEDIVCON1']: '',
                        'SALEDIVCON2' => isset($_POST['SALEDIVCON2']) ? $_POST['SALEDIVCON2']: '',
                        'SALEDIVCON3' => isset($_POST['SALEDIVCON3']) ? $_POST['SALEDIVCON3']: '',
                        'T_AMOUNT' => isset($_POST['T_AMOUNT']) ? $_POST['T_AMOUNT']: '',
                        // 'T_AMOUNT' => isset($_POST['T_AMOUNT']) ? str_replace(',', ', $_POST['T_AMOUNT']) :'',
                        'DESCRIPTION' => isset($_POST['REPRINTREASON']) ? $_POST['REPRINTREASON']: '',
                        'REPRINTREASON' => isset($_POST['REPRINTREASON']) ? $_POST['REPRINTREASON']: '');
        // print_r($param);
        $printStatic = $printfunc->SVprintStatic($param);
        $printDynamic = $printfunc->SVprintDynamic($param);
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
            $file_path = dirname(__FILE__, 6).'/report/'.$_SESSION['COMCD'].'/template/ACC_SALEENTRY_THA2_SALE_VOUCHER.xlsx';

            $sheetExcel = PHPExcel_IOFactory::load($file_path);
            // --------------------------------------------------
            // Set Active Sheet
            $sheetExcel->setActiveSheetIndex($sheetData);
            // --------------------------------------------------
            // Set Sheet Name [DATA]
            $sheetExcel->getActiveSheet()->setTitle('DATA');
            // --------------------------------------------------
            // Write Report Data to Sheet [DATA]
            $sheetExcel->getActiveSheet()->setCellValue('A1',  $printStatic['COMPN'])
                                        ->setCellValue('B1', $printStatic['PONUM'])
                                        ->setCellValue('C1', $printStatic['SATO'])
                                        ->setCellValue('D1', $printStatic['TDATE'])
                                        ->setCellValue('E1', $printStatic['RPTTITLE1'])
                                        ->setCellValue('F1', $printStatic['RPTTITLE2'])
                                        ->setCellValue('G1', $printStatic['INVNO'])
                                        ->setCellValue('H1', $printStatic['AMMON'])
                                        ->setCellValue('I1', $printStatic['TDEB'])
                                        ->setCellValue('J1', $printStatic['TCRE'])
                                        ->setCellValue('K1', $printStatic['DESCRIPT'])
                                        ->setCellValue('L1', $printStatic['REPRINTREASON']);

            foreach ($printDynamic as $key => $value) {
                 $sheetExcel->getActiveSheet()->setCellValue('A'.$key+1, $value['SEQ'])
                                            ->setCellValue('B'.$key+1, $value['ACCNO'])
                                            ->setCellValue('C'.$key+1, $value['PATI'])
                                            ->setCellValue('D'.$key+1, $value['ACCTRANREM'])
                                            ->setCellValue('E'.$key+1, $value['REM'])
                                            ->setCellValue('F'.$key+1, $value['DEB'])
                                            ->setCellValue('G'.$key+1, $value['CRE'])
                                            ->setCellValue('H'.$key+1, $value['SEC'])
                                            ->setCellValue('I'.$key+1, $value['DCTYP']);
            }
            // --------------------------------------------------
            // Set Active Sheet to [REPORT]
            $sheetExcel->setActiveSheetIndex($sheetRpt);
            // --------------------------------------------------
            $writer = PHPExcel_IOFactory::createWriter($sheetExcel, 'Excel2007');
            // Save Excel Report File on Server
            $report_file = $SVNO.'_SALE_VOUCHER_'.date('Ymd_Hi').'.xlsx';
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
            $pdf_name = $SVNO.'_SALE_VOUCHER_'.date('Ymd_Hi').'.pdf';
            $pdf_download_path = '/report/'.$_SESSION['COMCD'].'/output/'.$_SESSION['USERCODE'].'/'.$pdf_name;
            $pdf_path = $outputPath.'/'.$pdf_name;
            $rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
            $rendererLibraryPath = dirname(__FILE__, 6).'/common/PHPExcel/tcpdf';
            if(!PHPExcel_Settings::setPdfRenderer($rendererName, $rendererLibraryPath)) {
                die('NOTICE: Please set the $rendererName and $rendererLibraryPath values' .'<br />' .'at the top of s script as appropriate for your directory structure');
            }
            $sheetPDF = PHPExcel_IOFactory::load($report_path);
            $sheetPDF->setActiveSheetIndex($sheetRpt);
            // --------------------------------------------------
            $sheetPDF->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
            $sheetPDF->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
            $sheetPDF->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
            // $sheetPDF->getActiveSheet()->getPageSetup()->setVerticalCentered(false);
            $sheetPDF->getActiveSheet()->getPageSetup()->setFitToHeight(true);
            $sheetPDF->getActiveSheet()->getPageSetup()->setFitToWidth(true);
            $sheetPDF->getActiveSheet()->setShowGridLines(false);

            $sheetPDF->getActiveSheet()->getPageMargins()->setTop(0.5);
            $sheetPDF->getActiveSheet()->getPageMargins()->setLeft(0.6);
            $sheetPDF->getActiveSheet()->getPageMargins()->setRight(0.5);           
            $sheetPDF->getActiveSheet()->getPageMargins()->setBottom(0.5);

            $pdf_writer = PHPExcel_IOFactory::createWriter($sheetPDF, 'PDF');
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

    } catch(Exception $ex) {
        // print_r($ex);
    }
    // ----------------------------------------------------------------------------------------------------
}

function iVprintCheck() {
    global $data;
    $ivfunc = new SaleEntryTHA;
    $param = array( "SALETRANNO" => $_POST['SALETRANNO'],
                    "REPRINTREASON" => $_POST['REPRINTREASON']);
    // print_r($param);
    $ivprint = $ivfunc->IVprintCheck($param);
    echo json_encode($ivprint);
}

function sVprintCheck() {
    global $data;
    $svfunc = new SaleEntryTHA;
    $param = array( "SALETRANNO" => $_POST['SALETRANNO'],
                    "REPRINTREASON" => $_POST['REPRINTREASON']);
    $svprint = $svfunc->SVprintCheck($param);
    // print_r($svprint);
    echo json_encode($svprint);
}

function getAmt() {
    global $data;
    $amtfunc = new SaleEntryTHA;
    $data = getSessionData();
    $Param = array( "ESTLNQTY" => $_POST['ESTLNQTY'],
                    "ESTLNUNITPRC" =>  $_POST['ESTLNUNITPRC'],
                    "ESTDISCOUNT" =>  $_POST['ESTDISCOUNT'],
                    "CUSCURCD" => $_POST['CUSCURCD'],
                    "DISCRATE" => $_POST['DISCRATE'],
                    "VATRATE" => $_POST['VATRATE'],
                    "CUSTOMERCD" => $_POST['CUSTOMERCD']);
    $amt = $amtfunc->getAmt($Param);
    // print_r($amt);
    // print_r($amt['SALEAMT']);
    // print_r($amt['SALEDISCOUNT2']);
    // print_r($amt['SALETAXAMT']);
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
                                    'SALEQTY' => $_POST['SALEQTY'][$i],
                                    'ITEMUNITTYP' => $_POST['ITEMUNITTYP'][$i],
                                    'SALEUNITPRC' => $_POST['SALEUNITPRC'][$i],
                                    'SALEDISCOUNT' => $_POST['SALEDISCOUNT'][$i],
                                    'SALEAMT' => $_POST['SALEAMT'][$i],
                                    'SALEDISCOUNT2' => $_POST['SALEDISCOUNT2'][$i],
                                    'SALETAXAMT' => $_POST['SALETAXAMT'][$i]);
    }
    setSessionArray($data);
    // print_r($data['ITEM']);
}

/// add session data of item 
function setSessionArray($arr){
    $keepField = array( 'SALETRANNO', 'DIVISIONCD', 'DIVISIONNAME', 'SALEISSUEDT', 'CUSTOMERCD', 'BRANCHKBN', 'TAXID', 'CUSCURCD', 'CUSTOMERNAME', 'SALEORDERNO', 'DESCRIPTION',
                        'SALECUSMEMO', 'SALEDIVCON4', 'SALELNDUEDT', 'CUSTADDR1', 'CUSTADDR2', 'ESTCUSSTAFF', 'ESTCUSTEL', 'ESTCUSFAX', 'STAFFCD', 'STAFFNAME', 'SALETERM', 'SVNO',
                        'ITEM', 'CUSCURDISP', 'S_TTL', 'DISCRATE', 'DISCOUNTAMOUNT', 'REPRINTREASON', 'SYSVIS_LOADAPPREPLACE', 'SYSVIS_DUMMYPRT1', 'T_AMOUNT1',
                        'QUOTEAMOUNT', 'VATRATE', 'VATAMOUNT', 'VATAMOUNT1', 'T_AMOUNT', 'SYSMSG', 'SYSVIS_CANCELLBL', 'SUB', 'LDIS', 'AFDIS', 'TOT', 'TVAT', 'SYSVIS_PRINTINV',
                        'ROWCOUNTER', 'COMPNTH', 'COMPNEN', 'ADDR1', 'ADDR2', 'ADDREN1', 'ADDREN2', 'TELO', 'FAXO', 'ATNAME', 'PONUM', 'SHDATE', 'SLMAN', 'GROUPRT', 'DIVISIONNAME',
                        'CUSN', 'ADDR10', 'ADDR20', 'CTEL', 'CFAX', 'QONUM', 'TDATE', 'PAYTERM', 'PRVALID', 'QOBY', 'REM1', 'REM2', 'REM3', 'CUR', 'ITEMINV', 'CADDR1', 'CADDR2', 'SONUM',
                        'SYSPVL', 'TXTLANG', 'DRPLANG', 'SALEDIVCON1', 'SALEDIVCON2', 'SALEDIVCON3', 'DEPT', 'DES', 'CDEPT', 'ANUM', 'CTAXID', 'REF', 'SHV', 'SALETRANINSPDT',
                        'SYSVIS_REPRINTREASON',  'SYSEN_COMMIT', 'SYSEN_SALEORDERNO' , 'SYSEN_CUSCURCD', 'SYSEN_STAFFCD', 'SYSEN_ESTCUSSTAFF', 'SYSEN_SALEDIVCON1', 'SYSEN_SALEDIVCON2', 'SYSEN_SALEDIVCON3',
                        'SYSEN_SALETERM', 'SYSEN_SALECUSMEMO', 'SYSEN_SALEDIVCON4', 'SYSEN_DVW', 'SYSEN_SALETRANPLANRECMONEYDT', 'SYSVIS_REPRINTLBL', 'SYSEN_DESCRIPTION', 'SYSEN_REPRINTREASON',
                        'SYSVIS_DUMMYPRT2', 'SYSEN_DIVISIONCD', 'SYSEN_CUSTOMERCD', 'ADDRTH', 'ADDREN', 'TELO', 'FAXO', 'TAXNO', 'ITEMPAGE', 'ITEMTAXINV', 'LOADPRINT', 'TAXINV', 'SVSTATIC', 'SVDYNAMIC');

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

function unsetSessionkey($key) {
    global $systemName;
    $sysnm = empty($sysnm) ? $systemName : $sysnm;
    return unset_sys_key($sysnm, $key);
}

function unsetSesstionItem($lineIndex = '') {
    global $data;
    global $systemName;
    unset_sys_array($systemName, 'ITEM', $lineIndex);
    $data = getSessionData();
    // print_r(count($data['ITEM']));
    $data['ITEM'] = array_combine(range(1, count($data['ITEM'])), array_values($data['ITEM']));
    setSessionArray($data);
}

function getSystemData($key = '') {
  return get_sys_data(SESSION_NAME_SYSTEM, $key);
}

function setSystemData($key, $val) {
  return set_sys_data(SESSION_NAME_SYSTEM, $key, $val);
}

// function invoice() {
//     global $data;
//     unsetSessionkey('ITEMINV'); unsetSessionkey('ITEMPAGE'); 
//     $data = getSessionData();
//     $invfunc = new SaleEntryTHA;
//     if(!empty($data['SALETRANNO'])) {
//         $param = array( "SALETRANNO" => $data['SALETRANNO'],
//                         "REPRINTREASON" => $data['REPRINTREASON']);
//         $inv = $invfunc->IVprintStatic($param);
//         $invoice = $invfunc->IVprintDynamic($param);
//         $data = $inv;
//         // echo "<pre>";
//         // print_r($inv);
//         // echo "</pre>";
//         // echo "<pre>";
//         // print_r($invoice);
//         // echo "</pre>";
//         if(!empty($invoice)) {
//             for ($i = 1 ; $i <= count($invoice); $i++) {
//                 $data['ITEMINV'][$i] = $invoice[$i];
//                 $data['ITEMPAGE'][$invoice[$i]['IDXNO']] = $invoice[$i];
//             }
//         }
//         setSessionArray($data);
//         $data = getSessionData();
//     }
//     // echo "<pre>";
//     // print_r($data);
//     // echo "</pre>";
// }

// function invoiceTax() {
//     global $data;
//     unsetSessionkey('ITEMPAGE'); unsetSessionkey('ITEMTAXINV');
//     $data = getSessionData();
//     $printfunc = new SaleEntryTHA;
//     if(!empty($data['SALETRANNO'])) {
//         $param = array( "SALETRANNO" => $data['SALETRANNO'],
//                         "REPRINTREASON" => $data['REPRINTREASON']);
//         // print_r($param);
//         $invtax = $printfunc->TIVprintStatic($param);
//         $invoicetax = $printfunc->TIVprintDynamic($param);
//         $data = $invtax;
//         // echo "<pre>";
//         // print_r($invtax);
//         // echo "</pre>";
//         // echo "<pre>";
//         // print_r($invoicetax);
//         // echo "</pre>";
//         if(!empty($invoicetax)) {
//             for ($i = 1 ; $i <= count($invoicetax); $i++) {
//                 $data['ITEMTAXINV'][$i] = $invoicetax[$i];
//                 if ($invoicetax[$i]['NUM'] == 1) {
//                     $data['ITEMPAGE'][$invoicetax[$i]['IDXNO']] = $invoicetax[$i];
//                 }
//             }
//         }
//         setSessionArray($data);
//         $data = getSessionData();
//     }
//     // echo "<pre>";
//     // print_r($data);
//     // echo "</pre>";
// }

// function saleVoucher() {
//     global $data;
//     unsetSessionkey('SVSTATIC'); unsetSessionkey('SVDYNAMIC');
//     $data = getSessionData();
//     $svpfunc = new SaleEntryTHA;
//     $param = array( "SALETRANNO" => $data['SALETRANNO'],
//                     "SVNO" => $data['SVNO'],
//                     "SALETRANINSPDT" =>  isset($data['SALETRANINSPDT']) ? str_replace("-", "", $data['SALETRANINSPDT']) :'',
//                     "CUSTOMERNAME" => $data['CUSTOMERNAME'],
//                     "SALEDIVCON1" => $data['SALEDIVCON1'],
//                     "SALEDIVCON2" => $data['SALEDIVCON2'],
//                     "SALEDIVCON3" => $data['SALEDIVCON3'],
//                     "T_AMOUNT" => $data['T_AMOUNT'],
//                     // "T_AMOUNT" => isset($data['T_AMOUNT']) ? str_replace(",", "", $data['T_AMOUNT']) :'',
//                     "DESCRIPTION" => $data['DESCRIPTION'],
//                     "REPRINTREASON" => $data['REPRINTREASON']);
//     // print_r($param);
//     $svsprint = $svpfunc->SVprintStatic($param);
//     $svdprint = $svpfunc->SVprintDynamic($param);

//     if(!empty($svdprint)) {
//         $data['SVSTATIC'] = $svsprint;
//         $data['SVDYNAMIC'] = $svdprint;
//     }
//     setSessionArray($data);
//     // $data = getSessionData();
//     // echo "<pre>";
//     // print_r($svsprint);
//     // echo "</pre>";
//     // echo "<pre>";
//     // print_r($svdprint);
//     // echo "</pre>";
// }
?>