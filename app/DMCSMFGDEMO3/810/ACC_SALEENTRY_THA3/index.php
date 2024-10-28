<?php require_once('./function/index_x.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=$_SESSION['APPNAME']; ?></title>
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
        <main class="flex flex-1 overflow-y-auto paragraph">
            <!-- Content Page -->
            <input type="hidden" id="appcode" name="appcode" value="<?=$appcode?>">
            <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
            <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
            <form class="w-full" method="POST" id="saleentry3" name="saleentry3" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label>
                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1.5 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="p-1.5 w-full align-middle" open><!-- open -->
                                <summary class="text-color mx-auto py-2 text-lg font-semibold"></summary>
                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SALEORDERNO')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="SALEORDERNO" id="SALEORDERNO" value="<?=isset($data['SALEORDERNO']) ? $data['SALEORDERNO']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHSALEORDER">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="w-5/12"></div>
                                    </div>
                                    <div class="flex w-6/12 px-2 justify-end">
                                        <label class="w-7/12"></label>
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1"><?=checklang('INPUT_DATE')?></label>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                type="date" id="SALETRANSALEDT" name="SALETRANSALEDT" value="<?=!empty($data['SALETRANSALEDT']) ? date('Y-m-d', strtotime($data['SALETRANSALEDT'])) : date('Y-m-d'); ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('INVOICE_NO')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="SALETRANNO" id="SALETRANNO" value="<?=isset($data['SALETRANNO']) ? $data['SALETRANNO']: ''; ?>"/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 text-white bg-blue-500 rounded-e-xl border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                                                id="SEARCHSALETRAN_ACC">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="hidden" name="SVNO" id="SVNO" value="<?=isset($data['SVNO']) ? $data['SVNO']: ''; ?>"/>
                                        <label class="w-5/12"></label>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CUSTOMERCODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="CUSTOMERCD" id="CUSTOMERCD" value="<?=isset($data['CUSTOMERCD']) ? $data['CUSTOMERCD']: ''; ?>" onchange="unRequired();" required/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                id="SEARCHCUSTOMER">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="CUSTOMERNAME" id="CUSTOMERNAME" value="<?=isset($data['CUSTOMERNAME']) ? $data['CUSTOMERNAME']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('INVDATE')?></label>
                                        <input class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-center"
                                                type="date" id="SALETRANINSPDT" name="SALETRANINSPDT" value="<?=!empty($data['SALETRANINSPDT']) ? date('Y-m-d', strtotime($data['SALETRANINSPDT'])) : date('Y-m-d'); ?>"/>
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1 text-center"><?=checklang('CREDITTERM')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-1/12 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                                name="SALETERM" id="SALETERM" onchange="unRequired();" oninput="this.value = stringReplacez(this.value);"
                                                value="<?=isset($data['SALETERM']) ? $data['SALETERM'] : ''; ?>" required/>
                                        <label class="text-color block text-sm w-2/12 pr-2 pt-1 text-center"><?=checklang('DAYS')?></label>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="CUSTADDR1" id="CUSTADDR1" value="<?=isset($data['CUSTADDR1']) ? $data['CUSTADDR1']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DIVISIONCODE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="DIVISIONCD" id="DIVISIONCD" value="<?=!empty($data['DIVISIONCD']) ? $data['DIVISIONCD']: ''; ?>" onchange="unRequired();" required/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 text-white bg-blue-500 rounded-e-xl border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                                                id="SEARCHDIVISION">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="DIVISIONNAME" id="DIVISIONNAME" value="<?=isset($data['DIVISIONNAME']) ? $data['DIVISIONNAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="CUSTADDR2" id="CUSTADDR2" value="<?=isset($data['CUSTADDR2']) ? $data['CUSTADDR2']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PERSON_RESPONSE')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="STAFFCD" id="STAFFCD" value="<?=isset($data['STAFFCD']) ? $data['STAFFCD']: ''; ?>" onchange="unRequired();" required/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 text-white bg-blue-500 rounded-e-xl border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                                                id="SEARCHSTAFF">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="STAFFNAME" id="STAFFNAME" value="<?=isset($data['STAFFNAME']) ? $data['STAFFNAME']: ''; ?>" readonly/>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('TEL')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 mr-1 text-gray-700 border-gray-300 read"
                                                name="ESTCUSTEL" id="ESTCUSTEL" oninput="this.value = stringReplacez(this.value);"
                                                value="<?=isset($data['ESTCUSTEL']) ? $data['ESTCUSTEL']: ''; ?>" readonly/>
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1 text-center"><?=checklang('FAX')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                name="ESTCUSFAX" id="ESTCUSFAX" oninput="this.value = stringReplacez(this.value);"
                                                value="<?=isset($data['ESTCUSFAX']) ? $data['ESTCUSFAX']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CURRENCY')?></label>
                                        <div class="relative w-4/12 mr-1">
                                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                    name="CUSCURCD" id="CUSCURCD" value="<?=isset($data['CUSCURCD']) ? $data['CUSCURCD']: ''; ?>" 
                                                    <?php if(isset($data['SALETRANNO'])) { ?> style="background-color: whitesmoke; pointer-events: none;" readonly <?php } ?>/>
                                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 text-white bg-blue-500 rounded-e-xl border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300" id="SEARCHCURRENCY"/>
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="flex w-5/12">
                                            <select id="BRANCHKBN" name="BRANCHKBN" class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-6/12 text-left rounded-xl border-gray-300 read" readonly>
                                                <option value=""></option>
                                                <?php foreach ($branchkbn as $key => $item) { ?>
                                                    <option value="<?=$key ?>" <?=(isset($data['BRANCHKBN']) && $data['BRANCHKBN'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                                <?php } ?>
                                            </select>
                                            <input type="text" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                                    name="TAXID" id="TAXID" value="<?=isset($data['TAXID']) ? $data['TAXID']: ''; ?>" readonly/>
                                        </div>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ATTENTION')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                                name="ESTCUSSTAFF" id="ESTCUSSTAFF" value="<?=isset($data['ESTCUSSTAFF']) ? $data['ESTCUSSTAFF']: ''; ?>"/>
                                    </div>
                                </div>


                                <div class="flex mb-1">
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('REFERENCE')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                        name="SALECUSMEMO" id="SALECUSMEMO" value="<?=isset($data['SALECUSMEMO']) ? $data['SALECUSMEMO']: ''; ?>"/>
                                    </div>
                                    <div class="flex w-6/12 px-2">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DESCRIPTION')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                        name="DESCRIPTION" id="DESCRIPTION" value="<?=isset($data['DESCRIPTION']) ? $data['DESCRIPTION']: ''; ?>"/>
                                    </div>
                                </div>             
                            </details>
                        </div>
                        <!-- End Header -->
                    </div>
                    <!-- End Card -->
                </div>

                <div class="flex mx-2">
                    <div class="flex w-full border border-gray-300 p-1">
                        <button type="button" class="inline-flex items-center justify-center w-10 h-8 mr-2 text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800 rounded-lg" id="add-row">+</button>
                        <button type="button" class="inline-flex items-center justify-center w-10 h-8 mr-2 text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800 rounded-lg" id="delete-row">x</button>
                    </div>
                </div>

                <div id="table-area" class="overflow-scroll px-2 block h-[256px]">
                    <table id="table" class="sale_table w-full border-collapse border border-slate-500">
                        <thead class="sticky top-0 z-20 bg-gray-50">
                            <tr class="border border-gray-600">
                                <th class="px-6 w-8 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('LINE')?></span>
                                </th>
                                 <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CODE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DESCRIPTION')?></span>
                                </th>
                                 <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('QUANTITY')?></span>
                                </th>
                                 <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('UOM')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('UNIT_PRICE')?></span>
                                </th>

                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('DISCOUNT')?></span>
                                </th>

                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('AMOUNT')?></span>
                                </th>
                            </tr>
                        </thead>
              
                        <tbody id="dvwdetail" class="divide-y divide-gray-200">
                             <?php if(isset($data['ITEM'])) { $minrow = count($data['ITEM']);
                                foreach ($data['ITEM'] as $key => $value) { ?>
                                    <tr id="rowId<?=$key?>">
                                        <td class="row-id text-center max-w-4 text-sm border border-slate-700" id="ROWNO<?=$key?>" name="ROWNO[]"><?=$key?></td>
                                        <td class="max-w-24 text-sm border border-slate-700">
                                            <div class="relative z-10">
                                                <input type="text" class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 item-read"
                                                        id="ITEMCD<?=$key?>" name="ITEMCD[]" onchange="findItemCode(event, <?=$key?>);" onkeyup="findItemCode(event, <?=$key?>);"
                                                        value="<?=isset($value['ITEMCD']) ? $value['ITEMCD']: '';?>">
                                                <a class="search-tag absolute top-0 end-0 h-6 py-1.5 px-3 rounded-e-xl border focus:ring-4 focus:outline-none item-read"
                                                    id="searchitem<?=$key?>" onclick="searchItemIndex(<?=$key?>);">
                                                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                        <td class="max-w-32 text-sm border border-slate-700">
                                            <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 item-read"
                                                    id="ITEMNAME<?=$key?>" name="ITEMNAME[]" value="<?=isset($value['ITEMNAME']) ? $value['ITEMNAME']: ''; ?>"/>
                                        </td>
                                        <td class="max-w-8 text-sm border border-slate-700">
                                            <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right item-read" 
                                                    id="SALEQTY<?=$key?>" name="SALEQTY[]" value="<?=!empty($value['SALEQTY']) ? number_format(str_replace(',', '', $value['SALEQTY']), 2): '0.00' ?>"
                                                    onchange="calculateamt(<?=$key?>); this.value = num2digit(this.value);"
                                                    oninput="this.value = stringReplacez(this.value);"/>
                                        </td>
                                        <td class="max-w-8 text-sm border border-slate-700">
                                            <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-center read" 
                                                    id="ITEMUNITTYP<?=$key?>" name="ITEMUNITTYP[]" value="<?=isset($value['ITEMUNITTYP']) ? $value['ITEMUNITTYP']: '' ?>" readonly/>
                                        </td>
                                        <td class="max-w-8 text-sm border border-slate-700">
                                            <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right item-read" 
                                                    id="SALEUNITPRC<?=$key?>" name="SALEUNITPRC[]" onchange="calculateamt(<?=$key?>); this.value = num2digit(this.value);" 
                                                    value="<?=!empty($value['SALEUNITPRC']) ? number_format(str_replace(',', '', $value['SALEUNITPRC']), 2): '0.00' ?>"
                                                    oninput="this.value = stringReplacez(this.value);"/>
                                        </td>
                                        <td class="max-w-8 text-sm border border-slate-700">
                                            <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right item-read" 
                                                    id="SALEDISCOUNT<?=$key?>" name="SALEDISCOUNT[]" onchange="calculateamt(<?=$key?>); this.value = num2digit(this.value);" 
                                                    value="<?=!empty($value['SALEDISCOUNT']) ? number_format(str_replace(',', '', $value['SALEDISCOUNT']), 2): '0.00' ?>"
                                                    oninput="this.value = stringReplacez(this.value);"/>
                                        </td>
                                        <td class="max-w-8 text-sm border border-slate-700">
                                            <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                    id="SALEAMT<?=$key?>" name="SALEAMT[]" value="<?=isset($value['SALEAMT']) ? $value['SALEAMT'] : '' ?>" readonly/>
                                        </td>
                                        <td class="hidden"><input class="w-16 read" id="SALEDISCOUNT2<?=$key?>" name="SALEDISCOUNT2[]"
                                            value="<?=isset($value['SALEDISCOUNT2']) ? $value['SALEDISCOUNT2'] : '' ?>" readonly/></td>
                                        <td class="hidden"><input class="w-16 read" id="SALELN<?=$key?>" name="SALELN[]"
                                            value="<?=isset($value['SALELN']) ? $value['SALELN'] : '' ?>" readonly/></td>
                                        <td class="hidden"><input class="w-16 read" id="SALEORDERQTY<?=$key?>" name="SALEORDERQTY[]"
                                            value="<?=isset($value['SALEORDERQTY']) ? $value['SALEORDERQTY'] : '' ?>" readonly/></td>
                                    </tr><?php
                                }
                            } 
                            for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                                <tr class="row-empty" id="rowId<?=$i?>">
                                    <td class="h-6 border border-slate-700"></td>
                                    <td class="h-6 border border-slate-700"></td>
                                    <td class="h-6 border border-slate-700"></td>
                                    <td class="h-6 border border-slate-700"></td>
                                    <td class="h-6 border border-slate-700"></td>
                                    <td class="h-6 border border-slate-700"></td>
                                    <td class="h-6 border border-slate-700"></td>
                                    <td class="h-6 border border-slate-700"></td>
                                </tr><?php
                            } ?>
                        </tbody>
                        <tfoot class="sticky bottom-0 z-20 pointer-events-none">
                            <tr>
                                <td class="text-color h-6 text-[12px]" colspan="8"><?=str_repeat('&emsp;', 2).checklang('ROWCOUNT').str_repeat('&ensp;', 2);?><span id="rowcount" ><?=$minrow; ?></span></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>


                <div class="flex flex-col">
                    <!-- Card -->
                    <div class="p-1.5 inline-block align-middle">
                        <!-- Header -->
                        <div class="justify-between px-2 border border-gray-200 rounded-xl shadow-sm">
                            <details class="p-1.5 w-full align-middle" open><!-- open -->
                                <summary class="text-color mx-auto py-2 text-lg font-semibold"></summary>
                                <div class="flex mb-1 px-2">
                                    <div class="flex w-8/12">
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-8/12 py-2 px-3 text-gray-700 border-gray-300"
                                            name="SALEDIVCON1" id="SALEDIVCON1" value="<?=!empty($data['SALEDIVCON1']) ? $data['SALEDIVCON1']: ''; ?>"/>
                                    </div>
                                    <div class="flex w-4/12">
                                        <label class="text-color block text-sm w-6/12 pr-2 pt-1"><?=checklang('SUBTOTAL')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                name="S_TTL" id="S_TTL" value="<?=!empty($data['S_TTL']) ? number_format(str_replace(',', '', $data['S_TTL']), 2): '0.00'; ?>" readonly/>&nbsp;
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                name="CUSCURDISP" id="CUSCURDISP" value="<?=!empty($data['CUSCURDISP']) ? $data['CUSCURDISP']: ''; ?>" readonly/>
                                    </div>
                                </div>

                                <div class="flex mb-1 px-2">
                                    <div class="flex w-8/12">
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-8/12 py-2 px-3 text-gray-700 border-gray-300"
                                            name="SALEDIVCON2" id="SALEDIVCON2" value="<?=!empty($data['SALEDIVCON2']) ? $data['SALEDIVCON2']: ''; ?>"/>
                                        <?php if(!empty($data['SYSVIS_CANCELLBL']) && $data['SYSVIS_CANCELLBL'] == 'T') { ?><h5 class="w-4/12 pl-6 pt-1 text-red-500 font-semibold"><?=checklang('CANCELMSG')?></h5><?php } ?>
                                    </div>
                                    <div class="flex w-4/12">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DISCOUNT')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                                name="DISCRATE" id="DISCRATE" value="<?=!empty($data['DISCRATE']) ? $data['DISCRATE']: '0'; ?>"
                                               onchange="discount();" oninput="this.value = stringReplacez(this.value);"/>&nbsp;
                                        <label class="text-color block text-sm w-1/12 pt-1 text-center">%</label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                name="DISCOUNTAMOUNT" id="DISCOUNTAMOUNT" value="<?=!empty($data['DISCOUNTAMOUNT']) ? number_format(str_replace(',', '', $data['DISCOUNTAMOUNT']), 2): '0.00'; ?>" readonly/>&nbsp;
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                name="CUSCURDISP" <?php if(!empty($data['CUSCURDISP'])){ ?> value="<?=$data['CUSCURDISP']; ?>"<?php } else { ?> value="" <?php }?> disabled/>
                                    </div>
                                </div>

                                <div class="flex mb-1 px-2">
                                    <div class="flex w-8/12">
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-8/12 py-2 px-3 text-gray-700 border-gray-300"
                                            name="SALEDIVCON3" id="SALEDIVCON3" value="<?=!empty($data['SALEDIVCON3']) ? $data['SALEDIVCON3']: ''; ?>"/>
                                    </div>
                                    <div class="flex w-4/12">
                                        <label class="text-color block text-sm w-6/12 pr-2 pt-1"><?=checklang('AFTERDISCOUNT')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                name="QUOTEAMOUNT" id="QUOTEAMOUNT" value="<?=!empty($data['QUOTEAMOUNT']) ? number_format(str_replace(',', '', $data['QUOTEAMOUNT']), 2): '0.00'; ?>" readonly/>&nbsp;
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                name="CUSCURDISP" value="<?=!empty($data['CUSCURDISP']) ? $data['CUSCURDISP']: ''; ?>" disabled/>
                                    </div>
                                </div>

                                <div class="flex mb-1 px-2">
                                    <div class="flex w-8/12"></div>
                                    <div class="flex w-4/12">
                                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('VAT')?></label>
                                        <input type="text" class="text-control text-sm shadow-md border text-sm rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                                name="VATRATE" id="VATRATE" onchange="vat();" value="<?=!empty($data['VATRATE']) ? $data['VATRATE']: ''; ?>"
                                                oninput="this.value = stringReplacez(this.value);"/>&nbsp;
                                        <label class="text-color block text-sm w-1/12 pt-1 text-center">%</label>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                name="VATAMOUNT1" id="VATAMOUNT1" value="<?=!empty($data['VATAMOUNT1']) ? number_format(str_replace(',', '', $data['VATAMOUNT1']), 2): '0.00'; ?>" readonly/>
                                        <input class="hidden" name="VATAMOUNT" id="VATAMOUNT" value="<?=!empty($data['VATAMOUNT']) ? number_format(str_replace(',', '', $data['VATAMOUNT']), 2): '0.00'; ?>" readonly/>&nbsp;
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                name="CUSCURDISP" value="<?=!empty($data['CUSCURDISP']) ? $data['CUSCURDISP']: ''; ?>" disabled/>
                                    </div>
                                </div>


                                <div class="flex mb-1 px-2">
                                    <div class="flex w-8/12">
                                        <div class="flex w-full" id="reprints">
                                            <label class="text-color text-sm w-3/12 pr-2 pt-1"><?=checklang('REPRINT_CANCEL_REASON')?></label>
                                            <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-7/12 py-2 px-3 text-gray-700 border-gray-300"
                                                name="REPRINTREASON" id="REPRINTREASON" value="<?=isset($data['REPRINTREASON'])? $data['REPRINTREASON']: ''; ?>"/>
                                        </div>
                                    </div>
                                    <div class="flex w-4/12">
                                        <label class="text-color block text-sm w-6/12 pr-2 pt-1"><?=checklang('TOTALAMOUNT')?></label>
                                        <input type="hidden" class="hidden" name="T_AMOUNT" id="T_AMOUNT" 
                                                value="<?=!empty($data['T_AMOUNT']) ? number_format(str_replace(',', '', $data['T_AMOUNT']), 2): '0.00'; ?>"/>
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                name="T_AMOUNT1" id="T_AMOUNT1" 
                                                value="<?=!empty($data['T_AMOUNT1']) ? number_format(str_replace(',', '', $data['T_AMOUNT1']) + str_replace(',', '', $data['VATAMOUNT']) + str_replace(',', '', $data['VATAMOUNT']), 2): '0.00'; ?>" readonly/>&nbsp;
                                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                                name="CUSCURDISP" value="<?=!empty($data['CUSCURDISP']) ? $data['CUSCURDISP']: ''; ?>" disabled/>
                                        <input type="hidden" class="hidden" name="GROUPRT" type="text" value="<?=!empty($data['GROUPRT']) ? $data['GROUPRT']: ''; ?>"/>
                                    </div>
                                </div>
                           </details>
                        </div>
                        <!-- End Header -->
                    </div>
                    <!-- End Card -->
                </div>

                <div class="flex mt-2">
                    <div class="flex w-8/12 px-1">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-2/12 py-1 text-center me-2 mb-2"
                        id="COMMIT" name="COMMIT"
                        <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>
                        <?php if(!empty($data['SYSVIS_CANCELLBL']) && $data['SYSVIS_CANCELLBL'] == 'T') { ?> disabled <?php } ?>><?=checklang('COMMIT'); ?></button>
                        <?php if(empty($data['SALETRANNO'])) { ?><div class="w-2/12 ml-2" id="REPLACEZ"></div>
                        <?php } else { ?>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-2/12 py-1 text-center me-2 mb-2" 
                         id="REPLACEZ" name="REPLACEZ" <?php if(empty($data['SALETRANNO'])){ ?> disabled <?php } ?>><?=checklang('REPLACE'); ?></button><?php } ?>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-2/12 py-1 text-center me-2 mb-2" 
                         id="INV" name="INV" <?php if(empty($data['SALETRANNO'])){ ?> disabled <?php } ?>><?=checklang('INV'); ?></button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-2/12 py-1 text-center me-2 mb-2"
                         id="TAXINV" name="TAXINV" <?php if(empty($data['SALETRANNO'])){ ?> disabled <?php } ?>><?=checklang('TAXINV'); ?></button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm w-2/12 py-1 text-center me-2 mb-2"
                         id="SALEV" name="SALEV" <?php if(empty($data['SALETRANNO'])){ ?> disabled <?php } ?>><?=checklang('SALEV'); ?></button>
                    </div>
                    <div class="flex w-4/12 px-1 justify-end">
                        <button type="reset" id="clear" name="clear" onclick="unsetSession(this.form);" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"><?=checklang('CLEAR'); ?></button>
                        <button type="button" id="end" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
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
        document.getElementById('reprints').style.display = 'none';
        // document.getElementById('reprints').style.visibility = 'hidden';
        let cancelled = '<?php echo (isset($data['SYSVIS_CANCELLBL']) ? $data['SYSVIS_CANCELLBL']: 'null'); ?>';
        let replace = '<?php echo (isset($data['SYSVIS_LOADAPPREPLACE']) ? $data['SYSVIS_LOADAPPREPLACE']: 'null'); ?>';
        let taxinv = '<?php echo (isset($data['SYSVIS_DUMMYPRT1']) ? $data['SYSVIS_DUMMYPRT1']: 'null'); ?>';
        let salev = '<?php echo (isset($data['SYSVIS_DUMMYPRT2']) ? $data['SYSVIS_DUMMYPRT2']: 'null'); ?>';
        let inv = '<?php echo (isset($data['SYSVIS_PRINTINV']) ? $data['SYSVIS_PRINTINV']: 'null'); ?>';
        let reprint = '<?php echo (isset($data['SYSVIS_REPRINTREASON']) ? $data['SYSVIS_REPRINTREASON']: 'null'); ?>';
        let commits = '<?php echo (isset($data['SYSEN_COMMIT']) ? $data['SYSEN_COMMIT']: 'null'); ?>';
        // VIS FILL
        let table = '<?php echo (isset($data['SYSEN_DVW']) ? $data['SYSEN_DVW']: 'null'); ?>';
        let saleorder = '<?php echo (isset($data['SYSEN_SALEORDERNO']) ? $data['SYSEN_SALEORDERNO']: 'null'); ?>';
        let divicd = '<?php echo (isset($data['SYSEN_DIVISIONCD']) ? $data['SYSEN_DIVISIONCD']: 'null'); ?>';
        let cuscd = '<?php echo (isset($data['SYSEN_CUSTOMERCD']) ? $data['SYSEN_CUSTOMERCD']: 'null'); ?>';
        let curcd = '<?php echo (isset($data['SYSEN_CUSCURCD']) ? $data['SYSEN_CUSCURCD']: 'null'); ?>';
        let stafcd = '<?php echo (isset($data['SYSEN_STAFFCD']) ? $data['SYSEN_STAFFCD']: 'null'); ?>';
        let estcusstaf = '<?php echo (isset($data['SYSEN_ESTCUSSTAFF']) ? $data['SYSEN_ESTCUSSTAFF']: 'null'); ?>';
        let saledivc1 = '<?php echo (isset($data['SYSEN_SALEDIVCON1']) ? $data['SYSEN_SALEDIVCON1']: 'null'); ?>';
        let saledivc2 = '<?php echo (isset($data['SYSEN_SALEDIVCON2']) ? $data['SYSEN_SALEDIVCON2']: 'null'); ?>';
        let saledivc3 = '<?php echo (isset($data['SYSEN_SALEDIVCON3']) ? $data['SYSEN_SALEDIVCON3']: 'null'); ?>';
        let saleterm = '<?php echo (isset($data['SYSEN_SALETERM']) ? $data['SYSEN_SALETERM']: 'null'); ?>';
        let cusmemo = '<?php echo (isset($data['SYSEN_SALECUSMEMO']) ? $data['SYSEN_SALECUSMEMO']: 'null'); ?>';
        let desc = '<?php echo (isset($data['SYSEN_DESCRIPTION']) ? $data['SYSEN_DESCRIPTION']: 'null'); ?>';
        let reprintbl = '<?php echo (isset($data['SYSVIS_REPRINTLBL']) ? $data['SYSVIS_REPRINTLBL']: 'null'); ?>';
        let tranrecmdt = '<?php echo (isset($data['SYSEN_SALETRANPLANRECMONEYDT']) ? $data['SYSEN_SALETRANPLANRECMONEYDT']: 'null'); ?>';
        if(cancelled != 'null' && cancelled == 'T') { 
            $('.search-tag').css('pointer-events', 'none');
            $('.text-control').attr('disabled', 'disabled').css('background-color', 'whitesmoke');
            $('#SALETRANNO').removeAttr('disabled').css('background-color', 'white');
            $('#SEARCHSALEORDER').css('pointer-events', 'auto');
            document.getElementById('INV').style.visibility = 'hidden';
            document.getElementById('TAXINV').style.visibility = 'hidden';
        }
        if(replace != 'T') { document.getElementById('REPLACEZ').style.visibility = 'hidden'; }
        if(taxinv == 'F') { document.getElementById('TAXINV').style.visibility = 'hidden'; }
        if(inv == 'F') { document.getElementById('INV').style.visibility = 'hidden'; }
        if(salev == 'F') { document.getElementById('SALEV').style.visibility = 'hidden'; }
        if(reprint == 'T') { document.getElementById('reprints').style.display = 'block'; } // document.getElementById('reprints').style.visibility = 'visible';
        if(commits == 'F') { document.getElementById('COMMIT').disabled = true; }
        if(saleorder == 'F') { document.getElementById('SALEORDERNO').classList.add('read'); document.getElementById('SEARCHSALEORDER').classList.add('read'); }
        if(divicd == 'F') { document.getElementById('DIVISIONCD').classList.add('read'); document.getElementById('SEARCHDIVISION').classList.add('read'); }
        if(cuscd == 'F') {
            document.getElementById('CUSTOMERCD').classList.add('read');
            document.getElementById('ESTCUSTEL').classList.add('read');
            document.getElementById('ESTCUSFAX').classList.add('read');
            document.getElementById('SEARCHCUSTOMER').classList.add('read');
        }
        if(curcd == 'F') { document.getElementById('CUSCURCD').classList.add('read'); document.getElementById('SEARCHCURRENCY').classList.add('read'); }
        if(stafcd == 'F') { document.getElementById('STAFFCD').classList.add('read'); document.getElementById('SEARCHSTAFF').classList.add('read'); }
        if(estcusstaf == 'F') { document.getElementById('ESTCUSSTAFF').classList.add('read'); }
        if(saledivc1 == 'F') { document.getElementById('SALEDIVCON1').classList.add('read'); }
        if(saledivc2 == 'F') { document.getElementById('SALEDIVCON2').classList.add('read'); }
        if(saledivc3 == 'F') { document.getElementById('SALEDIVCON3').classList.add('read'); }
        if(saleterm == 'F') { document.getElementById('SALETERM').classList.add('read'); }
        if(cusmemo == 'F') { document.getElementById('SALECUSMEMO').classList.add('read'); }
        if(desc == 'F') { document.getElementById('DESCRIPTION').classList.add('read'); }
        if(tranrecmdt == 'F') { document.getElementById('SALETRANINSPDT').classList.add('read'); }
        if(reprintbl == 'F') { document.getElementById('REPRINTREASON').classList.add('read'); }
        if(table == 'F') { 
            document.getElementById('add-row').classList.add('read');
            document.getElementById('delete-row').classList.add('read');
            // $('.table .search-tag').css('pointer-events', 'none');
            // $('.table .text-control').attr('readonly', true).css('background-color', 'whitesmoke');
            var readItem = document.getElementsByClassName('item-read');
            for(var i = 0; i < readItem.length; i++) {
                readItem[i].classList.add('read');
            }
        }

        let maxrow = '<?php echo (isset($maxrow) ? $maxrow: 8); ?>';
        const details = document.querySelector('details');
        const tablearea = document.getElementById('table-area');
        details.addEventListener('toggle', function() {
            if (!details.open) {
                tablearea.classList.remove('h-[256px]');
                tablearea.classList.add('h-[420px]');
                maxrow = 15;
            } else {
                tablearea.classList.remove('h-[420px]');
                tablearea.classList.add('h-[256px]');
                maxrow = 8;
            }
            emptyRows(maxrow);
        })
        
        var index = 0; var id; 
        index = '<?php echo (isset($data['ITEM']) ? count($data['ITEM']) : 0); ?>';
        // console.log(index);
        $('#add-row').click(function() {
            // console.log('index before' + index);
            index ++;  // index += 1; 
            // console.log('index after' + index);
            var newRow = $('<tr id=rowId'+index+'>');
            var cols = '';
            cols += '<td class="row-id text-center text-sm max-w-4 border border-slate-700" id="ROWNO'+index+'" name="ROWNO[]">'+index+'</td>';
            cols += '<td class="max-w-24 text-sm border border-slate-700"><div class="relative z-10">' +
                        '<input type="text" class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300"' +
                        'id="ITEMCD'+index+'" name="ITEMCD[]" onchange="findItemCode(event, '+index+');" onkeyup="findItemCode(event, '+index+');"/>' +
                        '<a class="search-tag absolute top-0 end-0 h-6 py-1.5 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"' +
                            'id="searchitem'+index+'" onclick="searchItemIndex('+index+');">' +
                            '<svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">' +
                                '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>' +
                            '</svg>' +
                        '</a>' +
                    '</div></td>';
            cols += '<td class="max-w-32 text-sm border border-slate-700"><input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300"'+
                    'id="ITEMNAME'+index+'" name="ITEMNAME[]"/></td>';
            cols += '<td class="max-w-8 text-sm border border-slate-700"><input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right"'+
                    'id="SALEQTY'+index+'" name="SALEQTY[]" onchange="calculateamt('+index+'); this.value = num2digit(this.value);" '+
                    'oninput="this.value = stringReplacez(this.value);"/></td>';
            cols += '<td class="max-w-8 text-sm border border-slate-700"><input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-center read"'+
                    'id="ITEMUNITTYP'+index+'" name="ITEMUNITTYP[]" readonly/></td>';
            cols += '<td class="max-w-8 text-sm border border-slate-700"><input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right"'+
                    'id="SALEUNITPRC'+index+'" name="SALEUNITPRC[]" onchange="calculateamt('+index+'); this.value = num2digit(this.value);" '+
                    'oninput="this.value = stringReplacez(this.value);"/></td>';
            cols += '<td class="max-w-8 text-sm border border-slate-700"><input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right"'+
                    'id="SALEDISCOUNT'+index+'" name="SALEDISCOUNT[] onchange="calculateamt('+index+'); this.value = num2digit(this.value);" '+
                    'oninput="this.value = stringReplacez(this.value);"/></td>';
            cols += '<td class="max-w-8 text-sm border border-slate-700"><input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right read"'+
                    'id="SALEAMT'+index+'" name="SALEAMT[]" readonly/></td>';
            cols += '<td class="hidden"><input class="w-16 read" id="SALEDISCOUNT2'+index+'" name="SALEDISCOUNT2[]" readonly/></td>';
            cols += '<td class="hidden"><input class="w-16 read" id="SALEAMT'+index+'" name="SALEAMT[]" readonly/></td>';
               cols += '<td class="hidden"><input class="w-16 read" id="SALELN'+index+'" name="SALELN[]" readonly/></td>';
            cols += '<td class="hidden"><input class="w-16 read" id="SALEORDERQTY'+index+'" name="SALEORDERQTY[]" readonly/></td>'; 
           // console.log($(".row-id").length);
           // console.log($('#rowId'+index+'').closest('tr').attr('id'));
            if(index <= maxrow) {
                $('#rowId'+index+'').empty();
                $('#rowId'+index+'').removeAttr('class', 'row-empty');
                $('#rowId'+index+'').append(cols);
            } else {
                newRow.append(cols);
                $('table tbody').append(newRow);
            }

            document.getElementById('rowcount').innerHTML = index;

            // ----- call Class search-tag -------//
            searchIcon();
            // -----------------------------------//

            // $(".row-id").each(function (i){
            //    $(this).text(i+1);
            // });
        });
        // Find and remove selected table rows
        $('#delete-row').click(function() {
            // document.getElementById("table").deleteRow(index);
            // console.log(id);
            if(index > 0 && id != null) {
                // let rows = document.getElementsByTagName("tr");
                $('#rowId'+id).closest('tr').remove();
                if(index <= maxrow) {
                    emptyRow(index);
                }
                index --;   // index -= 1;
                $('.row-id').each(function (i) {
                    // console.log(i);
                    // rows[id].id = 'rowId' + index;
                    $(this).text(i+1);
                }); 
                changeRowIds();
                unsetSessionItem(id);
                id = null;
                // console.log(index);
                document.getElementById('rowcount').innerHTML = index;
            }
            keepItemData();
        });


        $(document).on('click', '.sale_table tr', function(event){
            // let rowId = $(this).closest('tr').attr('id');
            // console.log(rowId);
            let item = $(this).closest('tr').children('td');
            id = item.eq(0).text();
            // console.log($(this).closest('tr'));
            let rows = document.getElementsByTagName('tr');
            $('.row-id').each(function (i) {
                rows[i+1].classList.remove('selected-row');
            }); 
            if(id != '') {
                rows[id].classList.add('selected-row'); 
            }
        });

        function changeRowIds() {
            var elem = document.getElementsByTagName('tr');
                for (var i = 0; i < elem.length; i++) {
                // console.log(i);
                if (elem[i].id) {
                    index_x = Number(elem[i].rowIndex);
                    elem[i].id = 'rowId' + index_x;
                }
            }
        }

        function emptyRow(n) {
            $('table tbody').append('<tr class="row-empty" id="rowId'+n+'>' +
                                    '<td class="h-6 border border-slate-700"></td>' +
                                    '<td class="h-6 border border-slate-700"></td>' +
                                    '<td class="h-6 border border-slate-700"></td>' +
                                    '<td class="h-6 border border-slate-700"></td>' +
                                    '<td class="h-6 border border-slate-700"></td>' +
                                    '<td class="h-6 border border-slate-700"></td>' +
                                    '<td class="h-6 border border-slate-700"></td>' +
                                    '<td class="h-6 border border-slate-700"></td></tr>');
        }
    }); 

    function findItemCode(event, index) {
        if ((event.type === 'change') || (event.key === 'Enter' || event.keyCode === 13)) {
            if($('#CUSTOMERCD').val() == '' || $('#CUSTOMERCD').val() == 'undefined') {
                document.getElementById('ITEMCD' + index + '').value = '';
                return getMessage('ERRO_NO_CUTOMER');
            } else if($('#CUSCURCD').val() == '' || $('#CUSCURCD').val() == 'undefined') {
                document.getElementById('ITEMCD' + index + '').value = '';
                return getMessage('ERRO_NOCURCD');
            } else {
                keepData();
                return getElementIndex('ITEMCD', $('#ITEMCD'+index+'').val(), index);
            }
        }
    }

    function searchItemIndex(lineIndex) {
        // console.log(lineIndex);
        if($('#CUSTOMERCD').val() == '' || $('#CUSTOMERCD').val() == 'undefined') {
            document.getElementById('ITEMCD' + lineIndex + '').value = '';
            return getMessage('ERRO_NO_CUTOMER');
        } else if($('#CUSCURCD').val() == '' || $('#CUSCURCD').val() == 'undefined') {
            document.getElementById('ITEMCD' + lineIndex + '').value = '';
            return getMessage('ERRO_NOCURCD');
        } else {
            return window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=ACC_SALEENTRY_THA3&index=' + lineIndex, 'authWindow', 'width=1200,height=600');
        }
    }

    function HandlePopupResult(code, result) {
        // console.log('result of popup is: ' + code + ' : ' + result);
        if(code == 'SALEORDERNO' || code == 'SALETRANNO') {
            return getSearch(code, result);
        } else {
            return getElement(code, result);
        }
    }

    function HandlePopupItem(result, index) {
        // console.log('result of popup result: ' + result + ' : ' + index);
        return getElementIndex('ITEMCD', result, index);
        // return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/810/ACC_SALEENTRY_THA3/index.php?ITEMCD=' + result +'&index=' + index;
    }

    function commitDialog() {
       return questionDialog(3, '<?=lang('question3')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
    }

    function SVprint() {
       return questionDialog(4, '<?=lang('question4')?>', '<?=lang('yes'); ?>', '<?=lang('no'); ?>');
    }

    function reprintDialog() {
        return Swal.fire({ 
            title: '',
            // icon: 'success',
            text: '<?=lang('validation2'); ?>',
            showCancelButton: false,
            confirmButtonText: '<?=lang('yes'); ?>',
            cancelButtonText: '<?=lang('no'); ?>'
            }).then((result) => {
                if (result.isConfirmed) {
            }
        });
    }

    function alertValidation() {
        return Swal.fire({ 
            title: '',
            // icon: 'success',
            text: '<?=lang('validation1'); ?>',
            showCancelButton: false,
            confirmButtonText: '<?=lang('yes'); ?>',
            cancelButtonText: '<?=lang('no'); ?>'
            }).then((result) => {
                if (result.isConfirmed) {
            }
        });
    }

    function successValidation(SALETRANNO) {
        return Swal.fire({ 
            title: '',
            // icon: 'success',
            text: '<?=lang('success'); ?>',
            showCancelButton: false,
            confirmButtonText: '<?=lang('yes'); ?>',
            cancelButtonText: '<?=lang('no'); ?>'
            }).then((result) => {
                if (result.isConfirmed) {
                // window.location.href='index.php?SALETRANNO=' + SALETRANNO;
            }
        });
    }

    function alertError(msg) {
        return Swal.fire({ 
            title: '',
            text: msg,
            showCancelButton: false,
            confirmButtonText: '<?=lang('yes'); ?>',
            cancelButtonText: '<?=lang('no'); ?>'
            }).then((result) => {
                if (result.isConfirmed) {
            }
        });
    }
    
    function unRequired() {
    
        document.getElementById('STAFFCD').classList[document.getElementById('STAFFCD').value !== '' ? 'remove' : 'add']('req');
        document.getElementById('SALETERM').classList[document.getElementById('SALETERM').value !== '' ? 'remove' : 'add']('req');
        document.getElementById('DIVISIONCD').classList[document.getElementById('DIVISIONCD').value !== '' ? 'remove' : 'add']('req');
        document.getElementById('CUSTOMERCD').classList[document.getElementById('CUSTOMERCD').value !== '' ? 'remove' : 'add']('req');

    }
</script>
</html>
