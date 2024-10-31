<?php require_once('./function/index_x.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=$appname; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <!-- -------------------------------------------------------------------------------- -->
</head>
<body>
<div class="flex flex-col h-screen">
    <!--  start::navbar Menu -->
    <header class="flex relative top-0 text-semibold">
        <!-------------------------------------------------------------------------------------->
        <?php navBar(); ?>
        <!-------------------------------------------------------------------------------------->
    </header>
    <!--  end::navbar Menu -->

    <div class="flex flex-1 overflow-hidden">
        <!--   start::Sidebar Menu -->
        <!-------------------------------------------------------------------------------------->
        <?php sideBar(); ?>
        <!-------------------------------------------------------------------------------------->
        <!--   end::Sideba Menu -->

        <!--   start::Main Content  -->
        <main class="flex flex-1 overflow-y-auto overflow-x-hidden paragraph px-2">
        <!-- Content Page -->
        <input type="hidden" id="appcode" name="appcode" value="<?=$appcode?>">
        <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
        <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
        <form class="w-full" method="POST" action="" id="suppliermaster" name="suppliermaster" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
            <label class="text-color block text-lg font-bold"><?=$_SESSION['APPNAME']; ?></label>

            <!-- supplier code -->
            <div class="flex mb-2 py-1">   
                <div class="flex w-6/12 mr-1">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SUPPLIER_CODE')?></label>
                    <div class="relative w-3/12">
                        <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                id="SUPPLIERCD" name="SUPPLIERCD" value="<?=isset($data['SUPPLIERCD']) ? $data['SUPPLIERCD']: ''; ?>" onchange="unRequired();" required/>
                        <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                            id="SEARCHSUPPLIER1">
                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="flex w-6/12 justify-end">
                    <label class="w-6/12"></label>
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('INSERT_DATE')?></label>
                    <input type="date" class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-center"
                            id="SUPPLIERREGDT" name="SUPPLIERREGDT" value="<?=!empty($data['SUPPLIERREGDT']) ? date('Y-m-d', strtotime($data['SUPPLIERREGDT'])) : date('Y-m-d'); ?>" />
                </div>
            </div>

            <!-- supplier name -->
            <div class="flex mb-2 py-1">   
                <div class="flex w-6/12 mr-1">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SUPPLIER_NAME')?></label>
                    <input type="text" class="text-control shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        id="SUPPLIERNAME" name="SUPPLIERNAME" value="<?=isset($data['SUPPLIERNAME']) ? $data['SUPPLIERNAME']: ''; ?>" onchange="unRequired();" required/>
                </div>
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pl-2 pt-1"><?=checklang('SEARCH_CHAR')?></label>
                    <input type="text" class="text-control shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        id="SUPPLIERSEARCH" name="SUPPLIERSEARCH" value="<?=isset($data['SUPPLIERSEARCH']) ? $data['SUPPLIERSEARCH']: ''; ?>" onchange="unRequired();" required/>
                </div>
            </div>

            <!-- address -->
            <div class="flex mb-2 py-1">   
                <div class="flex w-6/12 mr-1">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ADDR')?></label>
                    <input type="text" class="text-control shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="SUPPLIERADDR1" id="SUPPLIERADDR1" value="<?=isset($data['SUPPLIERADDR1']) ? $data['SUPPLIERADDR1']: ''; ?>" onchange="unRequired();" required/>
                </div>
                <div class="flex w-6/12">
                    <input type="text" class="text-control shadow-md border rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="SUPPLIERADDR2" id="SUPPLIERADDR2" value="<?=isset($data['SUPPLIERADDR2']) ? $data['SUPPLIERADDR2']: ''; ?>"/>
                </div>
            </div>

            <!-- postal code -->
            <div class="flex mb-2 py-1">   
                <div class="flex w-6/12 mr-1">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('POST_CODE')?></label>
                    <input type="text" class="text-control shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="SUPPLIERZIPCODE" id="SUPPLIERZIPCODE" value="<?=isset($data['SUPPLIERZIPCODE']) ? $data['SUPPLIERZIPCODE']: ''; ?>"/>
                </div>
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pl-2 pt-1"><?=checklang('TEL')?></label>
                    <input type="text" class="text-control shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        id="SUPPLIERTEL" name="SUPPLIERTEL" value="<?=isset($data['SUPPLIERTEL']) ? $data['SUPPLIERTEL']: ''; ?>"/>
                    <label class="text-color block text-sm w-3/12 text-center pt-1"><?=checklang('FAX')?></label>
                    <input type="text" class="text-control shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        id="SUPPLIERFAX" name="SUPPLIERFAX" value="<?=isset($data['SUPPLIERFAX']) ? $data['SUPPLIERFAX']: ''; ?>"/>
                </div>
            </div>


            <!-- email -->
            <div class="flex mb-2 py-1">   
                <div class="flex w-6/12 mr-1">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('EMAIL')?></label>
                    <input type="text" class="text-control shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        id="SUPPLIEREMAIL" name="SUPPLIEREMAIL" value="<?=isset($data['SUPPLIEREMAIL']) ? $data['SUPPLIEREMAIL']: ''; ?>"/>
                </div>
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pl-2 pt-1"><?=checklang('SUPPLIER_STAFF_NAME')?></label>
                    <input type="text" class="text-control shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        id="SUPPLIERCONTACT" name="SUPPLIERCONTACT" value="<?=isset($data['SUPPLIERCONTACT']) ? $data['SUPPLIERCONTACT']: ''; ?>"/>
                </div>
            </div>

            <!-- tax id -->
            <div class="flex mb-2 py-1">   
                <div class="flex w-6/12 mr-1">     
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('TAXID')?></label>
                    <input type="text" class="text-control shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        id="SUPPLIERSHORTNAME" name="SUPPLIERSHORTNAME"  maxlength="13" value="<?=isset($data['SUPPLIERSHORTNAME']) ? $data['SUPPLIERSHORTNAME']: ''; ?>" onchange="unRequired();" required/>
                    <input type="hidden" id="ROWCOUNTER" name="ROWCOUNTER" value="<?=isset($data['ROWCOUNTER']) ? $data['ROWCOUNTER']: ''?>">
                </div>
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pl-2 pt-1"><?=checklang('HEADOFFICEBRANCH')?></label>
                    <select class="text-control shadow-md border mr-2 px-3 h-7 w-3/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                        id="FACTORYCODE" name="FACTORYCODE" onchange="unRequired();" required>
                        <option value=""></option>
                        <?php foreach ($BRANCH_KBN as $key => $item) { ?>
                            <option value="<?=$key ?>" <?=(isset($data['FACTORYCODE']) && $data['FACTORYCODE'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                        <?php } ?>
                    </select>
                    <input type="text" class="text-control shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                           id="SUPPLIERADD01" name="SUPPLIERADD01" maxlength="5" value="<?=isset($data['SUPPLIERADD01']) ? $data['SUPPLIERADD01']: ''; ?>" onchange="unRequired();" required/>
                </div>
            </div>

            <!-- country code -->
            <div class="flex mb-2">   
                <div class="flex w-6/12 mr-1">     
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"></label>
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('COUNTRYCD')?></label>
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('STATECD')?></label>
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CITYCD')?></label>
                </div>
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pl-2 pt-1"><?=checklang('CITYNAME')?></label>
                </div>
            </div>

            <!-- own place -->
            <div class="flex mb-2">   
                <div class="flex w-6/12 mr-1">     
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('OWNPLACE')?></label>
                    <div class="relative w-3/12">
                        <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                id="COUNTRYCD" name="COUNTRYCD" value="<?=isset($data['COUNTRYCD']) ? $data['COUNTRYCD']: ''; ?>" onchange="unRequired();" required/>
                        <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                            id="SEARCHCOUNTRY">
                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </a>
                    </div>
                    <div class="relative w-3/12 ml-1 mr-1">
                        <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                id="STATECD" name="STATECD" value="<?=isset($data['STATECD']) ? $data['STATECD']: ''; ?>" onchange="unRequired();" required/>
                        <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                            id="SEARCHSTATE">
                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </a>
                    </div>
                    <div class="relative w-3/12">
                        <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                id="CITYCD" name="CITYCD" value="<?=isset($data['CITYCD']) ? $data['CITYCD']: ''; ?>" onchange="unRequired();" required/>
                        <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                            id="SEARCHCITY">
                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="flex w-6/12">
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                        name="CITYNAME" id="CITYNAME" value="<?=isset($data['CITYNAME']) ? $data['CITYNAME']: ''; ?>" readonly/>
                </div>
            </div>

            <!-- cutoff period -->
            <div class="flex mb-2 py-1">   
                <div class="flex w-6/12 mr-1">     
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CLOSE_DAY')?></label>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="SUPPLIERCLOSEDAY" id="SUPPLIERCLOSEDAY" value="<?=isset($data['SUPPLIERCLOSEDAY']) ? $data['SUPPLIERCLOSEDAY']: ''; ?>"
                        onchange="this.value = dec2digit(this.value);"
                        oninput="this.value = stringReplacez(this.value);"/>
                    <label class="text-color block text-sm w-1/12 pt-1 text-center"><?=checklang('DAY')?></label>
                    <label class="text-color block text-sm w-3/12 pl-2 pt-1"><?=checklang('PAY_DAY')?></label>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        name="SUPPLIERRECDAY" id="SUPPLIERRECDAY" value="<?=isset($data['SUPPLIERRECDAY']) ? $data['SUPPLIERRECDAY']: ''; ?>"
                        onchange="this.value = dec2digit(this.value);"
                        oninput="this.value = stringReplacez(this.value);"/>
                    <label class="text-color block text-sm w-1/12 pt-1 text-center"><?=checklang('DAY')?></label>
                </div>
                <div class="flex w-6/12">
                    
                    <input type="hidden" name="SUPPLIERTRANSFERFLG" value="<?=!empty($data['SUPPLIERTRANSFERFLG']) ? $data['SUPPLIERTRANSFERFLG']: 'F'?>"/>
                    <input type="hidden" name="SUPPLIEROFFFLG" value="F"/>
                    <input type="checkbox" id="SUPPLIEROFFFLG" name="SUPPLIEROFFFLG" value="T" <?php echo (isset($data['SUPPLIEROFFFLG']) && $data['SUPPLIEROFFFLG'] == 'T') ? 'checked' : '' ?>/>
                    <label class="text-color block text-sm pt-1 w-2/12 text-center"><?=checklang('STOP_PURCHASE')?></label>
                    <input type="hidden" name="SUPPLIERAFFILIATEFLG" value="F"/>
                    <input type="checkbox" id="SUPPLIERAFFILIATEFLG" name="SUPPLIERAFFILIATEFLG" value="T" <?php echo (isset($data['SUPPLIERAFFILIATEFLG']) && $data['SUPPLIERAFFILIATEFLG'] == 'T') ? 'checked' : '' ?>/>
                    <label class="text-color block text-sm pt-1 w-2/12 text-center"><?=checklang('AFFILIATE')?></label>
                </div>
            </div>

            <!-- currency code -->
            <div class="flex mb-2 py-1">   
                <div class="flex w-6/12 mr-1">     
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CU_CODE')?></label>
                    <div class="relative w-3/12">
                        <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                                id="CURRENCYCD" name="CURRENCYCD" value="<?=isset($data['CURRENCYCD']) ? $data['CURRENCYCD']: ''; ?>" onchange="unRequired();" required/>
                        <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                            id="SEARCHCURRENCY">
                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </a>
                    </div>
                    <label class="text-color block text-sm w-3/12 pl-2 pt-1"><?=checklang('UNITPRICE_ACCURACY')?></label>
                    <select class="text-control shadow-md border mr-2 px-3 h-7 w-3/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 req" 
                        id="SUPPLIERUNITROUNDTYP" name="SUPPLIERUNITROUNDTYP" onchange="unRequired();" required>
                        <option value=""></option>
                        <?php foreach ($ROUND as $key => $item) { ?>
                            <option value="<?=$key ?>" <?=(isset($data['SUPPLIERUNITROUNDTYP']) && $data['SUPPLIERUNITROUNDTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                        <?php } ?>
                    </select>  
                </div>
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pl-2 pt-1"><?=checklang('AMOUNT_ACCURACY')?></label>  
                    <select class="text-control shadow-md border mr-2 px-3 h-7 w-3/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 req" 
                        id="SUPPLIERAMTROUNDTYP" name="SUPPLIERAMTROUNDTYP" onchange="unRequired();" required>
                        <option value=""></option>
                        <?php foreach ($ROUND as $key => $item) { ?>
                            <option value="<?=$key ?>" <?=(isset($data['SUPPLIERAMTROUNDTYP']) && $data['SUPPLIERAMTROUNDTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                        <?php } ?>
                    </select>  
                    <label class="text-color block text-sm w-3/12 pt-1 text-center"><?=checklang('TAX_ROUND_TYPE')?></label>
                    <select class="text-control shadow-md border mr-2 px-3 h-7 w-3/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 req" 
                        id="SUPPLIERTAXROUNDTYP" name="SUPPLIERTAXROUNDTYP" onchange="unRequired();" required>
                        <option value=""></option>
                        <?php foreach ($ROUND as $key => $item) { ?>
                            <option value="<?=$key ?>" <?=(isset($data['SUPPLIERTAXROUNDTYP']) && $data['SUPPLIERTAXROUNDTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <!-- payeecode -->
            <div class="flex mb-2 py-1">   
                <div class="flex w-6/12 mr-1">     
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PAY_TSCODE')?></label>
                    <div class="relative w-3/12">
                        <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            id="SUPBILLCD" name="SUPBILLCD" value="<?=isset($data['SUPBILLCD']) ? $data['SUPBILLCD']: ''; ?>"/>
                        <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                            id="SEARCHSUPPLIER2">
                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </a>
                    </div>
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-6/12 py-2 px-3 ml-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                        id="SUPBILLNAME" name="SUPBILLNAME" value="<?=isset($data['SUPBILLNAME']) ? $data['SUPBILLNAME']: ''; ?>" readonly/>
                </div>                
            </div>                

            <!-- bank code -->
            <div class="flex mb-2 py-1">   
                <div class="flex w-6/12 mr-1">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('BANK_CODE')?></label>
                    <input type="text" class="text-control shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        id="BANKNAME" name="BANKNAME" value="<?=isset($data['BANKNAME']) ? $data['BANKNAME']: ''; ?>"/>
                </div>
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pl-2 pt-1"><?=checklang('BRANCH_NAME')?></label>
                    <input type="text" class="text-control shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        id="BRANCHNAME" name="BRANCHNAME" value="<?=isset($data['BRANCHNAME']) ? $data['BRANCHNAME']: ''; ?>"/>
                </div>
            </div>

            <!-- account type -->
            <div class="flex mb-2 py-1">   
                <div class="flex w-6/12 mr-1">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('BANK_ACC_TYPE')?></label>
                    <select class="text-control shadow-md border mr-2 px-3 h-7 w-3/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                        id="SUPPLIERBKACCTYP" name="SUPPLIERBKACCTYP">
                        <option value=""></option>
                        <?php foreach ($BRANCH_KBN as $key => $item) { ?>
                            <option value="<?=$key ?>" <?=(isset($data['SUPPLIERBKACCTYP']) && $data['SUPPLIERBKACCTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                        <?php } ?>
                    </select>
                    <label class="text-color block text-sm w-3/12 pl-2 pt-1"><?=checklang('BANK_ACC_NO')?></label>
                    <input type="text" class="text-control shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                           id="SUPPLIERBKACCNO" name="SUPPLIERBKACCNO" value="<?=isset($data['SUPPLIERBKACCNO']) ? $data['SUPPLIERBKACCNO']: ''; ?>"/>
                </div>
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pl-2 pt-1"><?=checklang('NOMINAL_PERSON')?></label>
                    <input type="text" class="text-control shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                           id="SUPPLIERBKACCNAME" name="SUPPLIERBKACCNAME" value="<?=isset($data['SUPPLIERBKACCNAME']) ? $data['SUPPLIERBKACCNAME']: ''; ?>"/>
                </div>
            </div>

            <!-- comment -->
            <div class="flex mb-2 py-1">   
                <div class="flex w-6/12 mr-1">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('REMARK')?></label>
                    <input type="text" class="text-control shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            id="SUPPLIERREMARK" name="SUPPLIERREMARK" value="<?=isset($data['SUPPLIERREMARK']) ? $data['SUPPLIERREMARK']: ''; ?>"/>
                </div>
                <div class="flex w-6/12">
                    <input type="hidden" id="USEFLG" name="USEFLG" value="<?=isset($data['USEFLG']) ? $data['USEFLG']: ''?>">
                    <input type="hidden" id="GMAPADR" name="GMAPADR" value="<?=isset($data['GMAPADR']) ? $data['GMAPADR']: ''?>">
                    <input type="hidden" id="CURRENCY" name="CURRENCY" value="<?=isset($data['CURRENCY']) ? $data['CURRENCY']: ''?>">
                    <input type="hidden" id="DIRECTCD" name="DIRECTCD" value="<?=isset($data['DIRECTCD']) ? $data['DIRECTCD']: ''?>">
                    <input type="hidden" id="BANKBRANCHCD" name="BANKBRANCHCD" value="<?=isset($data['BANKBRANCHCD']) ? $data['BANKBRANCHCD']: ''?>">
                    <input type="hidden" id="DIRECTNAME" name="DIRECTNAME" value="<?=isset($data['DIRECTNAME']) ? $data['DIRECTNAME']: ''?>">
                    <input type="hidden" id="SUPPLIERPWD" name="SUPPLIERPWD" value="<?=isset($data['SUPPLIERPWD']) ? $data['SUPPLIERPWD']: ''?>">
                    <input type="hidden" id="CURRENCYDISP" name="CURRENCYDISP" value="<?=isset($data['CURRENCYDISP']) ? $data['CURRENCYDISP']: ''?>">
                    <input type="hidden" id="SUPPLIERTAXTYP" name="SUPPLIERTAXTYP" value="<?=isset($data['SUPPLIERTAXTYP']) ? $data['SUPPLIERTAXTYP']: ''?>">
                    <input type="hidden" id="SUPPLIEREDITYP" name="SUPPLIEREDITYP" value="<?=isset($data['SUPPLIEREDITYP']) ? $data['SUPPLIEREDITYP']: ''?>">
                    <input type="hidden" id="SUPPLIERTAXRATE" name="SUPPLIERTAXRATE" value="<?=isset($data['SUPPLIERTAXRATE']) ? $data['SUPPLIERTAXRATE']: ''?>">
                    <input type="hidden" id="SUPPLIERCREDITLIMIT" name="SUPPLIERCREDITLIMIT" value="<?=isset($data['SUPPLIERCREDITLIMIT']) ? $data['SUPPLIERCREDITLIMIT']: ''?>">
                    <input type="hidden" id="SUPPLIERTRANSPORTTYP" name="SUPPLIERTRANSPORTTYP" value="<?=isset($data['SUPPLIERTRANSPORTTYP']) ? $data['SUPPLIERTRANSPORTTYP']: ''?>"> 
                </div>
            </div>
            <!-- button -->
            <div class="flex mb-2 py-1">   
                <div class="flex w-6/12 px-1">
                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                            id="INSERT" name="INSERT" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_INSERT'] != 'T') {?> hidden <?php }?>
                            <?php if(!$data['INS']) { ?> disabled <?php } ?>><?=checklang('INSERT'); ?></button>
                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                            id="UPDATE" name="UPDATE" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>
                            <?php if($data['INS']) { ?> disabled <?php } ?>><?=checklang('UPDATE'); ?></button>
                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                            id="DELETE" name="DELETE" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?>
                            <?php if($data['INS']) { ?> disabled <?php } ?>><?=checklang('DELETE'); ?></button>
                </div>
                <div class="flex w-6/12 px-1 justify-end">
                    <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                        onclick="unsetSession(this.form);"><?=checklang('CLEAR')?></button>
                    <button type="button" id="END" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                    onclick="questionDialog(1, '<?=lang('question1')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');"><?=checklang('END'); ?></button>
                </div>    
            </div>
        </form>
    </main>
        <!--   end::Main Content -->
    </div>

    <!-- start::footer -->
    <div class="flex bg-gray-200">
        <!-------------------------------------------------------------------------------------->
        <?php footerBar(); ?>
        <!-------------------------------------------------------------------------------------->
    </div>
    <!-- end::footer -->

    <!-- start::loading -->
    <div id="loading" class="on hidden">
        <div class="cv-spinner"><div class="spinner"></div></div>
    </div>
    <!-- end::loading -->
</div>
</body>
<script src="./js/script.js" ></script>
<!-- <script src="./js/script.js" integrity="sha384-eKyo9j1O+ZQqKRxLHlVMMHhoXUycVyohdyplCLdhKOGxrvZPhQQyN4Z7MZnvijHA" crossorigin="anonymous"></script> -->
<script type="text/javascript">
    $(document).ready(function() {
        unRequired();
        // document.getElementById('INSERT').disabled = false;
        // document.getElementById('UPDATE').disabled = true;
        // document.getElementById('DELETE').disabled = true;
    });

    function HandlePopupResultIndex(code, result, index) {
        // console.log('result of popup is: ' + code + ' result : ' + result + ' index : ' + index);
        if(index == '1') {
            return getSearch(code, result);
        } else {
            return getElement('SUPBILLCD', result);
        }
    }

    function HandlePopupResult(code, result) {
        // console.log('result of popup is: ' + code + ' : ' + result);
        return getElement(code, result);
    }

    function alertValidation() {
        return Swal.fire({ 
            title: '',
            text: '<?=lang('validation1'); ?>',
            showCancelButton: false,
            confirmButtonText: '<?=lang('yes'); ?>',
            cancelButtonText: '<?=lang('no'); ?>'
            }).then((result) => {
                if (result.isConfirmed) { //
            }
        });
    }
</script>
</html>
