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
        <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
        <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
        <form class="w-full" method="POST" action="" id="suppliermaster" name="suppliermaster" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
        <label class="text-color block text-lg font-bold"><?=$_SESSION['APPNAME']; ?></label>


        <!-- supplier code -->
        <div class="flex mb-2 py-1">   
            <div class="flex w-6/12 mr-1">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SUPPLIER_CODE')?></label>
                <div class="relative w-3/12">
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                            name="SUPPLIERCD" id="SUPPLIERCD" value="<?=isset($data['SUPPLIERCD']) ? $data['SUPPLIERCD']: ''; ?>" onchange="unRequired();"/>
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
                <input class="text-control shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-center"
                    type="date" id="SUPPLIERREGDT" name="SUPPLIERREGDT" value="<?=!empty($data['SUPPLIERREGDT']) ? date('Y-m-d', strtotime($data['SUPPLIERREGDT'])) : date('Y-m-d'); ?>" />

            </div>
        </div>

        <!-- supplier name -->
        <div class="flex mb-2 py-1">   
            <div class="flex w-6/12 mr-1">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SUPPLIER_NAME')?></label>
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                    name="SUPPLIERNAME" id="SUPPLIERNAME" value="<?=isset($data['SUPPLIERNAME']) ? $data['SUPPLIERNAME']: ''; ?>" onchange="unRequired();keepData();" />
            </div>
            <div class="flex w-6/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SEARCH_CHAR')?></label>
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    name="SUPPLIERSEARCH" id="SUPPLIERSEARCH" value="<?=isset($data['SUPPLIERSEARCH']) ? $data['SUPPLIERSEARCH']: ''; ?>" onchange="unRequired(); keepData();"/>
            </div>
        </div>

        <!-- address -->
        <div class="flex mb-2 py-1">   
            <div class="flex w-6/12 mr-1">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ADDR')?></label>
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                    name="SUPPLIERADDR1" id="SUPPLIERADDR1" value="<?=isset($data['SUPPLIERADDR1']) ? $data['SUPPLIERADDR1']: ''; ?>" onchange="unRequired();"/>
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
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('TEL')?></label>
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                    name="SUPPLIERTEL" id="SUPPLIERTEL" value="<?=isset($data['SUPPLIERTEL']) ? $data['SUPPLIERTEL']: ''; ?>" onchange="unRequired(); keepData();"/>
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('FAX')?></label>
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    name="SUPPLIERFAX" id="SUPPLIERFAX" value="<?=isset($data['SUPPLIERFAX']) ? $data['SUPPLIERFAX']: ''; ?>" onchange="keepData();"/>
            </div>
        </div>


        <!-- email -->
        <div class="flex mb-2 py-1">   
            <div class="flex w-6/12 mr-1">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('EMAIL')?></label>
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    name="SUPPLIEREMAIL" id="SUPPLIEREMAIL" value="<?=isset($data['SUPPLIEREMAIL']) ? $data['SUPPLIEREMAIL']: ''; ?>" onchange="keepData();"/>
            </div>
            <div class="flex w-6/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SUPPLIER_STAFF_NAME')?></label>
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    name="SUPPLIERCONTACT" id="SUPPLIERCONTACT" value="<?=isset($data['SUPPLIERCONTACT']) ? $data['SUPPLIERCONTACT']: ''; ?>" onchange="keepData();"/>
            </div>
        </div>

        <!-- tax id -->
        <div class="flex mb-2 py-1">   
            <div class="flex w-6/12 mr-1">     
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('TAXID')?></label>
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                    name="SUPPLIERSHORTNAME" id="SUPPLIERSHORTNAME" maxlength="13" value="<?=isset($data['SUPPLIERSHORTNAME']) ? $data['SUPPLIERSHORTNAME']: ''; ?>" onchange="unRequired();"/>
            </div>
            <div class="flex w-6/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('HEADOFFICEBRANCH')?></label>
                <select class="text-control shadow-md border mr-2 px-3 h-7 w-3/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 req" 
                    id="FACTORYCODE" name="FACTORYCODE" onchange="unRequired(); keepData();">
                    <option value=""></option>
                    <?php foreach ($kbnbranch as $key => $item) { ?>
                        <option value="<?=$key ?>" <?=(isset($data['FACTORYCODE']) && $data['FACTORYCODE'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                    <?php } ?>
                </select>
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                       name="SUPPLIERADD01" id="SUPPLIERADD01" maxlength="5" value="<?=isset($data['SUPPLIERADD01']) ? $data['SUPPLIERADD01']: ''; ?>" onchange="unRequired(); keepData();"/>
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
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CITYNAME')?></label>
            </div>
        </div>

        <!-- own place -->
        <div class="flex mb-2">   
            <div class="flex w-6/12 mr-1">     
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('OWNPLACE')?></label>
                <div class="relative w-3/12">
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                            name="COUNTRYCD" id="COUNTRYCD" value="<?=isset($data['COUNTRYCD']) ? $data['COUNTRYCD']: ''; ?>" onchange="unRequired();"/>
                    <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                        id="SEARCHCOUNTRY">
                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </a>
                </div>
                <div class="relative w-3/12 ml-1 mr-1">
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                            name="STATECD" id="STATECD" value="<?=isset($data['STATECD']) ? $data['STATECD']: ''; ?>" onchange="unRequired();"/>
                    <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                        id="SEARCHSTATE">
                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </a>
                </div>
                <div class="relative w-3/12">
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                            name="CITYCD" id="CITYCD" value="<?=isset($data['CITYCD']) ? $data['CITYCD']: ''; ?>" onchange="unRequired();"/>
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
                    onchange="this.value = digitFormat(this.value); keepData();"
                    oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                <label class="text-color block text-sm w-1/12 pr-2 pt-1 ml-1"><?=checklang('DAY')?></label>
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PAY_DAY')?></label>
                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    name="SUPPLIERRECDAY" id="SUPPLIERRECDAY" value="<?=isset($data['SUPPLIERRECDAY']) ? $data['SUPPLIERRECDAY']: ''; ?>"
                    onchange="this.value = digitFormat(this.value); keepData();"
                    oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                <label class="text-color block text-sm w-1/12 pr-2 pt-1 ml-1"><?=checklang('DAY')?></label>
            </div>
            <div class="flex w-6/12">
                <input type="checkbox" id="SUPPLIEROFFFLG" name="SUPPLIEROFFFLG" value="T" <?php echo (isset($data['SUPPLIEROFFFLG']) && $data['SUPPLIEROFFFLG'] == 'T') ? 'checked' : '' ?> onchange="keepData();"/>
                <label class="text-color block text-sm pt-1 w-2/12 text-center"><?=checklang('STOP_PURCHASE')?></label>
                <input type="checkbox" id="SUPPLIERAFFILIATEFLG" name="SUPPLIERAFFILIATEFLG" value="T" <?php echo (isset($data['SUPPLIERAFFILIATEFLG']) && $data['SUPPLIERAFFILIATEFLG'] == 'T') ? 'checked' : '' ?> onchange="keepData();"/>
                <label class="text-color block text-sm pt-1 w-2/12 text-center"><?=checklang('AFFILIATE')?></label>
            </div>
        </div>

        <!-- currency code -->
        <div class="flex mb-2 py-1">   
            <div class="flex w-6/12 mr-1">     
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CU_CODE')?></label>
                <div class="relative w-3/12">
                    <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                            name="CURRENCYCD" id="CURRENCYCD" value="<?=isset($data['CURRENCYCD']) ? $data['CURRENCYCD']: ''; ?>" onchange="unRequired();"/>
                    <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                        id="SEARCHCURRENCY">
                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </a>
                </div>
                <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-1"><?=checklang('UNITPRICE_ACCURACY')?></label>
                <select class="text-control shadow-md border mr-2 px-3 h-7 w-3/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 req" 
                    id="SUPPLIERUNITROUNDTYP" name="SUPPLIERUNITROUNDTYP" onchange="unRequired(); keepData();">
                    <option value=""></option>
                    <?php foreach ($roun_d1 as $key => $item) { ?>
                        <option value="<?=$key ?>" <?=(isset($data['SUPPLIERUNITROUNDTYP']) && $data['SUPPLIERUNITROUNDTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                    <?php } ?>
                </select>  
            </div>
            <div class="flex w-6/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('AMOUNT_ACCURACY')?></label>  
                <select class="text-control shadow-md border mr-2 px-3 h-7 w-3/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 req" 
                    id="SUPPLIERAMTROUNDTYP" name="SUPPLIERAMTROUNDTYP" onchange="unRequired(); keepData();">
                    <option value=""></option>
                    <?php foreach ($roun_d2 as $key => $item) { ?>
                        <option value="<?=$key ?>" <?=(isset($data['SUPPLIERAMTROUNDTYP']) && $data['SUPPLIERAMTROUNDTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                    <?php } ?>
                </select>  
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('TAX_ROUND_TYPE')?></label>
                <select class="text-control shadow-md border mr-2 px-3 h-7 w-3/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 req" 
                    id="SUPPLIERTAXROUNDTYP" name="SUPPLIERTAXROUNDTYP" onchange="unRequired(); keepData();">
                    <option value=""></option>
                    <?php foreach ($roun_d3 as $key => $item) { ?>
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
                        name="SUPBILLCD" id="SUPBILLCD" value="<?=isset($data['SUPBILLCD']) ? $data['SUPBILLCD']: ''; ?>"/>
                    <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                        id="SEARCHSUPPLIER2">
                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </a>
                </div>
                <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-6/12 py-2 px-3 ml-1 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                    name="SUPBILLNAME" id="SUPBILLNAME" value="<?=isset($data['SUPBILLNAME']) ? $data['SUPBILLNAME']: ''; ?>" readonly/>
            </div>                
        </div>                

        <!-- bank code -->
        <div class="flex mb-2 py-1">   
            <div class="flex w-6/12 mr-1">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('BANK_CODE')?></label>
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    name="BANKNAME" id="BANKNAME" value="<?=isset($data['BANKNAME']) ? $data['BANKNAME']: ''; ?>" onchange="keepData();"/>
            </div>
            <div class="flex w-6/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('BRANCH_NAME')?></label>
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    name="BRANCHNAME" id="BRANCHNAME" value="<?=isset($data['BRANCHNAME']) ? $data['BRANCHNAME']: ''; ?>" onchange="keepData();"/>
            </div>
        </div>

        <!-- account type -->
        <div class="flex mb-2 py-1">   
            <div class="flex w-6/12 mr-1">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('BANK_ACC_TYPE')?></label>
                <select class="text-control shadow-md border mr-2 px-3 h-7 w-3/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                    id="SUPPLIERBKACCTYP" name="SUPPLIERBKACCTYP" onchange="keepData();">
                    <option value=""></option>
                    <?php foreach ($bkacctype as $key => $item) { ?>
                        <option value="<?=$key ?>" <?=(isset($data['SUPPLIERBKACCTYP']) && $data['SUPPLIERBKACCTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                    <?php } ?>
                </select>
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('BANK_ACC_NO')?></label>
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                       name="SUPPLIERBKACCNO" id="SUPPLIERBKACCNO" value="<?=isset($data['SUPPLIERBKACCNO']) ? $data['SUPPLIERBKACCNO']: ''; ?>" onchange="keepData();"/>
            </div>
            <div class="flex w-6/12">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('NOMINAL_PERSON')?></label>
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                       name="SUPPLIERBKACCNAME" id="SUPPLIERBKACCNAME" value="<?=isset($data['SUPPLIERBKACCNAME']) ? $data['SUPPLIERBKACCNAME']: ''; ?>" onchange="keepData();"/>
            </div>
        </div>

        <!-- comment -->
        <div class="flex mb-2 py-1">   
            <div class="flex w-6/12 mr-1">
                <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('REMARK')?></label>
                <input type="text" class="text-control shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    name="SUPPLIERREMARK" id="SUPPLIERREMARK" value="<?=isset($data['SUPPLIERREMARK']) ? $data['SUPPLIERREMARK']: ''; ?>" onchange="keepData();"/>
            </div>
            <div class="flex w-6/12">
                <input type="hidden" class="text-control shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                name="CHECKCLEAR" id="CHECKCLEAR" value="<?=isset($data['CHECKCLEAR']) ? $data['CHECKCLEAR']: 'T'; ?>"/>
            </div>
        </div>
               
        <!-- button -->
        <div class="flex mb-2 py-1">   
            <div class="flex w-6/12 px-1">
                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                        id="INSERT" name="INSERT" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_INSERT'] != 'T') {?> hidden <?php }?>
                        <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'off') { ?> disabled <?php } ?>><?=checklang('INSERT'); ?></button>
                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                        id="UPDATE" name="UPDATE" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>
                        <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'on') { ?> disabled <?php } ?>><?=checklang('UPDATE'); ?></button>
                <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                        id="DELETE" name="DELETE" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?>
                        <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'on') { ?> disabled <?php } ?>><?=checklang('DELETE'); ?></button>
            </div>
            <div class="flex w-6/12 px-1 justify-end">
                <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                    onclick="unsetSession(this.form);"><?=checklang('CLEAR')?></button>
                <button type="button" id="END" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                onclick="questionDialog(1, '<?=lang('question1')?>', '<?=lang('yes'); ?>', '<?=lang('nono'); ?>');"><?=checklang('END'); ?></button>
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
    // if (CHECKCLEAR.val() != "F") {
    //    unsetSession(this.form);
        
    // } 
     if (CHECKCLEAR.val() == "T") {
    //     document.getElementById("SUPPLIERCD").value = $("#SUPPLIERCD").val();
    //     document.getElementById("SUPPLIERREGDT").value = '';
    //     document.getElementById("SUPPLIERNAME").value = '';
    //     document.getElementById("SUPPLIERSEARCH").value = '';
    //     document.getElementById("SUPPLIERSHORTNAME").value = '';
    //     document.getElementById("FACTORYCODE").value = '';
    //    // $('#STAFFDESIGNMODFLG').prop("checked", false)
    //  //   document.getElementById("STAFFDESIGNMODFLG").value = prop;
    //     document.getElementById("SUPPLIERADD01").value = '';
    //     document.getElementById("COUNTRYCD").value = '';
    //     document.getElementById("STATECD").value = '';
    //     document.getElementById("CITYCD").value = '';
    //     document.getElementById("CITYNAME").value = '';
    //     document.getElementById("SUPPLIERZIPCODE").value = '';
    //     document.getElementById("SUPPLIERADDR1").value = '';
    //     document.getElementById("SUPPLIERADDR2").value = '';
    //     document.getElementById("SUPPLIERTEL").value = '';
    //     document.getElementById("SUPPLIERFAX").value = '';
    //     document.getElementById("SUPPLIEREMAIL").value = '';
    //     document.getElementById("SUPPLIERCONTACT").value = '';
    //     document.getElementById("BANKNAME").value = '';
    //     document.getElementById("BRANCHNAME").value = '';
    //     document.getElementById("SUPPLIERBKACCTYP").value = '';
    //     document.getElementById("SUPPLIERBKACCNO").value = '';
    //     document.getElementById("SUPPLIERBKACCNAME").value = '';
    //     document.getElementById("SUPPLIERUNITROUNDTYP").value = '';
    //     document.getElementById("SUPPLIERAMTROUNDTYP").value = '';
    //     document.getElementById("SUPPLIERTAXROUNDTYP").value = '';
    //     document.getElementById("SUPBILLCD").value = '';
    //     document.getElementById("SUPBILLNAME").value = '';
    //     document.getElementById("CURRENCYCD").value = '';
    //     document.getElementById("SUPPLIERRECDAY").value = '';
    //     document.getElementById("SUPPLIERCLOSEDAY").value = '';
    //     document.getElementById("SUPPLIERREMARK").value = '';
    //     //document.getElementById("SUPPLIEROFFFLG").value = '';
    //     $('#SUPPLIEROFFFLG').prop("checked", false)
    //     $('#SUPPLIERAFFILIATEFLG').prop("checked", false)
    //     document.getElementById("SUPPLIERCLOSEDAY").value = '';
        document.getElementById("INSERT").disabled = false;
        document.getElementById("UPDATE").disabled = true;
        document.getElementById("DELETE").disabled = true;
     }
     else{
        document.getElementById("INSERT").disabled = true;
        document.getElementById("UPDATE").disabled = false;
        document.getElementById("DELETE").disabled = false;
     }
    });

    function alertValidation() {
        Swal.fire({ 
            title: '',
            // icon: 'success',
            text: '<?=lang('validation1'); ?>',
            // background: '#8ca3a3',
            showCancelButton: false,
            // confirmButtonColor: 'silver',
            // cancelButtonColor: 'silver',
            confirmButtonText: '<?=lang('yes'); ?>',
            cancelButtonText: '<?=lang('nono'); ?>'
            }).then((result) => {
                if (result.isConfirmed) { //
            }
        });
    }

    //req SUPPLIERCD SUPPLIERNAME SUPPLIERSEARCH SUPPLIERSHORTNAME  FACTORYCODE SUPPLIERADD01
    //COUNTRYCD STATECD 
    function unRequired() {
        if(SUPPLIERCD.val() != '') {
            document.getElementById('SUPPLIERCD').classList.remove('req');
        } else {
            document.getElementById('SUPPLIERCD').classList.add('req');
        }
        if(SUPPLIERNAME.val() != '') {
            document.getElementById('SUPPLIERNAME').classList.remove('req');
        } else {
            document.getElementById('SUPPLIERNAME').classList.add('req');
        }
        if(SUPPLIERSEARCH.val() != '') {
            document.getElementById('SUPPLIERSEARCH').classList.remove('req');
        } else {
            document.getElementById('SUPPLIERSEARCH').classList.add('req');
        }
        if(SUPPLIERSHORTNAME.val() != '') {
            document.getElementById('SUPPLIERSHORTNAME').classList.remove('req');
        } else {
            document.getElementById('SUPPLIERSHORTNAME').classList.add('req');
        }
        if(FACTORYCODE.val() != '') {
            document.getElementById('FACTORYCODE').classList.remove('req');
        } else {
            document.getElementById('FACTORYCODE').classList.add('req');
        }
        if(SUPPLIERADD01.val() != '') {
            document.getElementById('SUPPLIERADD01').classList.remove('req');
        } else {
            document.getElementById('SUPPLIERADD01').classList.add('req');
        }
        if(COUNTRYCD.val() != '') {
            document.getElementById('COUNTRYCD').classList.remove('req');
        } else {
            document.getElementById('COUNTRYCD').classList.add('req');
        }
        if(STATECD.val() != '') {
            document.getElementById('STATECD').classList.remove('req');
        } else {
            document.getElementById('STATECD').classList.add('req');
        }
        //CITYCD SUPPLIERADDR1 SUPPLIERTEL 
        //SUPPLIERUNITROUNDTYP SUPPLIERAMTROUNDTYP  SUPPLIERTAXROUNDTYP CURRENCYCD
        if(CITYCD.val() != '') {
            document.getElementById('CITYCD').classList.remove('req');
        } else {
            document.getElementById('CITYCD').classList.add('req');
        }
        if(SUPPLIERADDR1.val() != '') {
            document.getElementById('SUPPLIERADDR1').classList.remove('req');
        } else {
            document.getElementById('SUPPLIERADDR1').classList.add('req');
        }
        if(SUPPLIERTEL.val() != '') {
            document.getElementById('SUPPLIERTEL').classList.remove('req');
        } else {
            document.getElementById('SUPPLIERTEL').classList.add('req');
        }
        if(SUPPLIERUNITROUNDTYP.val() != '') {
            document.getElementById('SUPPLIERUNITROUNDTYP').classList.remove('req');
        } else {
            document.getElementById('SUPPLIERUNITROUNDTYP').classList.add('req');
        }
        if(SUPPLIERAMTROUNDTYP.val() != '') {
            document.getElementById('SUPPLIERAMTROUNDTYP').classList.remove('req');
        } else {
            document.getElementById('SUPPLIERAMTROUNDTYP').classList.add('req');
        }
        if(SUPPLIERTAXROUNDTYP.val() != '') {
            document.getElementById('SUPPLIERTAXROUNDTYP').classList.remove('req');
        } else {
            document.getElementById('SUPPLIERTAXROUNDTYP').classList.add('req');
        }
        if(CURRENCYCD.val() != '') {
            document.getElementById('CURRENCYCD').classList.remove('req');
        } else {
            document.getElementById('CURRENCYCD').classList.add('req');
        }
    }

    function HandlePopupResultIndex(code, result, index) {
        // console.log("result of popup is: " + code + ' : ' + result);
        $("#loading").show();
        return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/920/SUPPLIERMASTER_DMCS_THA/index.php?'+code+'=' + result + '&index=' + index;
    }

    function HandlePopupResult(code, result) {
        // console.log("result of popup is: " + code + ' : ' + result);
        $("#loading").show();
        return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/920/SUPPLIERMASTER_DMCS_THA/index.php?'+code+'=' + result;
    }

</script>
</html>
