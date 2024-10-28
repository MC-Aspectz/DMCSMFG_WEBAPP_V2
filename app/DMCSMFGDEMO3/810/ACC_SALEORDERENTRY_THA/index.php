<?php require_once('./function/index_x.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=$_SESSION['APPNAME']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
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
            <form class="w-full" method="POST" id="soentry" name="soentry" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label>
                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ESTIMATE_NO')?></label>
                        <div class="relative w-4/12 mr-1">
                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                    name="ESTNO" id="ESTNO" value="<?=isset($data['ESTNO']) ? $data['ESTNO']: ''; ?>"/>
                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                id="SEARCHQUOTE">
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
                                type="date" id="SALEISSUEDT" name="SALEISSUEDT" value="<?=!empty($data['SALEISSUEDT']) ? date('Y-m-d', strtotime($data['SALEISSUEDT'])) : date('Y-m-d'); ?>" readonly/>
                    </div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SALEORDERNO')?></label>
                        <div class="relative w-4/12 mr-1">
                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                    name="SALEORDERNO" id="SALEORDERNO" value="<?=isset($data['SALEORDERNO']) ? $data['SALEORDERNO']: ''; ?>"/>
                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 text-white bg-blue-500 rounded-e-xl border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                                id="SEARCHSALEORDER">
                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </a>
                        </div>
                        <label class="text-color block text-sm w-2/12 pr-2 pt-1 text-center"><?=checklang('DUE_DATE')?></label>
                        <input type="date" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                id="SALELNDUEDT" name="SALELNDUEDT" value="<?=!empty($data['SALELNDUEDT']) ? date('Y-m-d', strtotime($data['SALELNDUEDT'])): date('Y-m-d'); ?>"/>
                    </div>
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CUSTOMERCODE')?></label>
                        <div class="relative w-4/12 mr-1">
                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                    name="CUSTOMERCD" id="CUSTOMERCD" value="<?=!empty($data['CUSTOMERCD']) ? $data['CUSTOMERCD']: ''; ?>" required/>
                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                id="SEARCHCUSTOMER">
                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </a>
                        </div>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                name="CUSTOMERNAME" id="CUSTOMERNAME" value="<?=!empty($data['CUSTOMERNAME']) ? $data['CUSTOMERNAME']: ''; ?>" readonly/>
                    </div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('SHIP_VIA')?></label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                name="ESTCUSTEL" id="ESTCUSTEL" oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                value="<?=!empty($data['ESTCUSTEL']) ? $data['ESTCUSTEL']: ''; ?>"/>
                    </div>
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"></label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                name="CUSTADDR1" id="CUSTADDR1" value="<?=!empty($data['CUSTADDR1']) ? $data['CUSTADDR1']: ''; ?>" readonly/>
                    </div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DIVISIONCODE')?></label>
                        <div class="relative w-4/12 mr-1">
                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                    name="DIVISIONCD" id="DIVISIONCD" value="<?=!empty($data['DIVISIONCD']) ? $data['DIVISIONCD']: ''; ?>" required/>
                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 text-white bg-blue-500 rounded-e-xl border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                                id="SEARCHDIVISION">
                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </a>
                        </div>
                        <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                    name="DIVISIONNAME" id="DIVISIONNAME" value="<?=!empty($data['DIVISIONNAME']) ? $data['DIVISIONNAME']: ''; ?>" readonly/>
                    </div>
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"></label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                    name="CUSTADDR2" id="CUSTADDR2" value="<?=!empty($data['CUSTADDR2']) ? $data['CUSTADDR2']: ''; ?>" readonly/>
                    </div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('PERSON_RESPONSE')?></label>
                        <div class="relative w-4/12 mr-1">
                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 req"
                                    name="STAFFCD" id="STAFFCD" value="<?=!empty($data['STAFFCD']) ? $data['STAFFCD']: ''; ?>" required/>
                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 text-white bg-blue-500 rounded-e-xl border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                                id="SEARCHSTAFF">
                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </a>
                        </div>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                name="STAFFNAME" id="STAFFNAME" value="<?=!empty($data['STAFFNAME']) ? $data['STAFFNAME']: ''; ?>" readonly/>
                    </div>
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('TEL')?></label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 mr-1 text-gray-700 border-gray-300"
                                name="ESTCUSTEL" id="ESTCUSTEL" oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                value="<?=!empty($data['ESTCUSTEL']) ? $data['ESTCUSTEL']: ''; ?>"/>
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1 text-center"><?=checklang('FAX')?></label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-3/12 py-2 px-3 text-gray-700 border-gray-300"
                                name="ESTCUSFAX" id="ESTCUSFAX" oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                value="<?=!empty($data['ESTCUSFAX']) ? $data['ESTCUSFAX']: ''; ?>"/>
                    </div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('CURRENCY')?></label>
                        <div class="relative w-4/12 mr-1">
                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                    name="CUSCURCD" id="CUSCURCD" value="<?=!empty($data['CUSCURCD']) ? $data['CUSCURCD']: ''; ?>"
                                    <?php if(!empty($data['ESTNO'])) { ?> style="background-color: whitesmoke; pointer-events: none;" readonly <?php } ?>/>
                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 text-white bg-blue-500 rounded-e-xl border border-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                                <?php if(!empty($data['ESTNO'])) { ?> id="xxx" <?php } else { ?> id="SEARCHCURRENCY" <?php } ?>>
                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </a>
                        </div>
                        <div class="flex w-5/12">
                            <select id="BRANCHKBN" name="BRANCHKBN" class="text-control text-[12px] shadow-md border mr-1 px-3 h-7 w-6/12 text-left rounded-xl border-gray-300 read" readonly>
                                <option value=""></option>
                                <?php foreach ($branchkbn as $key => $item) { ?>
                                    <option value="<?=$key ?>" <?=(!empty($data['BRANCHKBN']) && $data['BRANCHKBN'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                <?php } ?>
                            </select>
                            <input type="text" class="text-control text-[13px] shadow-md border rounded-xl h-7 w-6/12 py-2 px-3 text-gray-700 border-gray-300 read"
                                    name="TAXID" id="TAXID" value="<?=!empty($data['TAXID']) ? $data['TAXID']: ''; ?>" readonly/>
                        </div>
                    </div>
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('ATTENTION')?></label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                                name="ESTCUSSTAFF" id="ESTCUSSTAFF" value="<?=!empty($data['ESTCUSSTAFF']) ? $data['ESTCUSSTAFF']: ''; ?>"/>
                    </div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('REFERENCE')?></label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-9/12 py-2 px-3 text-gray-700 border-gray-300"
                        name="SALECUSMEMO" id="SALECUSMEMO" value="<?=!empty($data['SALECUSMEMO']) ? $data['SALECUSMEMO']: ''; ?>"/>
                    </div>
                    <div class="flex w-6/12 px-2"></div>
                </div>

                <div class="flex">
                    <div class="table">
                        <div class="flex border border-gray-300">
                            <button type="button" class="inline-flex items-center justify-center w-10 h-8 mr-2 text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800 rounded-lg" id="add-row">+</button>
                            <button type="button" class="inline-flex items-center justify-center w-10 h-8 mr-2 text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800 rounded-lg" id="delete-row">x</button>
                        </div>
                        <table id="table" class="so_table w-full border-collapse border border-slate-500">
                            <thead class="bg-gray-50 dark:bg-slate-800">
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
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                 <?php if(!empty($data['ITEM']))  {   
                                    // $data['ITEM'] = array_combine(range(1, count($data['ITEM'])), array_values($data['ITEM']));
                                    // print_r($data['ITEM']);
                                    for ($i = 1; $i <= count($data['ITEM']); $i++) { $minrow = count($data['ITEM']); ?>
                                        <tr id="rowId<?=$i?>">
                                            <td class="row-id text-center max-w-4 text-sm border border-slate-700" id="ROWNO<?=$i?>" name="ROWNO[]"><?=$i?></td>
                                            <td class="max-w-24 text-sm border border-slate-700">
                                                <div class="relative">
                                                    <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                            id="ITEMCD<?=$i?>" name="ITEMCD[]" onchange="findItemCode(<?=$i?>);" onkeyup="onEnterItem(event, <?=$i?>);" value="<?=$data['ITEM'][$i]['ITEMCD'];?>">
                                                    <a class="search-tag absolute top-0 end-0 h-6 py-1.5 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                                        id="searchitem<?=$i?>" onclick="searchItemIndex(<?=$i?>);">
                                                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="max-w-32 text-sm border border-slate-700">
                                                <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300"
                                                        id="ITEMNAME<?=$i?>" name="ITEMNAME[]" value="<?=$data['ITEM'][$i]['ITEMNAME'] ?>"/>
                                            </td>
                                            <td class="max-w-8 text-sm border border-slate-700">
                                                <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right" 
                                                        id="SALELNQTY<?=$i?>" name="SALELNQTY[]" value="<?=!empty($data['ITEM'][$i]['SALELNQTY']) ? number_format($data['ITEM'][$i]['SALELNQTY'], 0): '' ?>"
                                                        onchange="calculateamt(<?=$i?>); this.value = numberWithCommas(this.value);"
                                                        oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                                            </td>
                                            <td class="max-w-8 text-sm border border-slate-700">
                                                <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-center read" 
                                                        id="ITEMUNITTYP<?=$i?>" name="ITEMUNITTYP[]" value="<?=$data['ITEM'][$i]['ITEMUNITTYP'] ?>" readonly/>
                                            </td>
                                            <td class="max-w-8 text-sm border border-slate-700">
                                                <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right" 
                                                        id="SALELNUNITPRC<?=$i?>" name="SALELNUNITPRC[]" onchange="calculateamt(<?=$i?>); this.value = numberWithCommas(this.value);" 
                                                        value="<?=!empty($data['ITEM'][$i]['SALELNUNITPRC']) ? number_format(str_replace(",", "", $data['ITEM'][$i]['SALELNUNITPRC']), 4): '0.0000' ?>"
                                                        oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                                            </td>
                                            <td class="max-w-8 text-sm border border-slate-700">
                                                <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right" 
                                                        id="SALELNDISCOUNT<?=$i?>" name="SALELNDISCOUNT[]" onchange="calculateamt(<?=$i?>); this.value = numberWithCommas(this.value);" 
                                                        value="<?=!empty($data['ITEM'][$i]['SALELNDISCOUNT']) ? number_format($data['ITEM'][$i]['SALELNDISCOUNT'], 4) : '0.0000' ?>"
                                                        oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                                            </td>
                                            <td class="max-w-8 text-sm border border-slate-700">
                                                <input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                                        id="SALELNAMT<?=$i?>" name="SALELNAMT[]" value="<?=isset($data['ITEM'][$i]['SALELNAMT']) ? $data['ITEM'][$i]['SALELNAMT'] : '' ?>" readonly/>
                                            </td>
                                            <td class="hidden"><input class="w-16 read" id="SALELNDISCOUNT2<?=$i?>" name="SALELNDISCOUNT2[]"
                                                value="<?=!empty($data['ITEM'][$i]['SALELNDISCOUNT2']) ? $data['ITEM'][$i]['SALELNDISCOUNT2'] : '' ?>" readonly/></td>
                                            <td class="hidden"><input class="w-16 read" id="SALELNTAXAMT<?=$i?>" name="SALELNTAXAMT[]"
                                                value="<?=!empty($data['ITEM'][$i]['SALELNTAXAMT']) ? $data['ITEM'][$i]['SALELNTAXAMT'] : '' ?>" readonly/></td>
                                        </tr><?php
                                    }
                                    for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                                        <tr id="rowId<?=$i?>">
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                        </tr><?php 
                                    }
                                } else {
                                    for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                                        <tr id="rowId<?=$i?>">
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                            <td class="h-6 border border-slate-700"></td>
                                        </tr><?php
                                    }
                                } ?>
                            </tbody>
                            <tfoot>
                                <tr class="pointer-events-none">
                                    <td class="text-color h-6 text-[12px]" colspan="8"><?=str_repeat('&emsp;', 2).checklang('ROWCOUNT').str_repeat('&ensp;', 2);?><span id="rowcount" ><?=$minrow; ?></span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-8/12">
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-8/12 py-2 px-3 text-gray-700 border-gray-300"
                            name="ESTREM1" id="ESTREM1" value="<?=!empty($data['ESTREM1']) ? $data['ESTREM1']: ''; ?>"/>
                    </div>
                    <div class="flex w-4/12">
                        <label class="text-color block text-sm w-6/12 pr-2 pt-1"><?=checklang('SUBTOTAL')?></label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                name="S_TTL" id="S_TTL" value="<?=!empty($data['S_TTL']) ? number_format(str_replace(',', '', $data['S_TTL']), 2): '0.00'; ?>" readonly/>&nbsp;
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                name="CUSCURDISP" id="CUSCURDISP" value="<?=!empty($data['CUSCURDISP']) ? $data['CUSCURDISP']: ''; ?>" readonly/>
                    </div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-8/12">
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-8/12 py-2 px-3 text-gray-700 border-gray-300"
                            name="ESTREM2" id="ESTREM2" value="<?=!empty($data['ESTREM2']) ? $data['ESTREM2']: ''; ?>"/>
                        <?php if(!empty($data['SYSVIS_CANCELLBL']) && $data['SYSVIS_CANCELLBL'] == 'T') { ?><h5 class="w-4/12 pl-6 pt-1 text-red-500 font-semibold"><?=checklang('CANCELMSG')?></h5><?php } ?>
                    </div>
                    <div class="flex w-4/12">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('DISCOUNT')?></label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                name="DISCRATE" id="DISCRATE" value="<?=!empty($data['DISCRATE']) ? $data['DISCRATE']: '0'; ?>"
                               onchange="discount();" oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>&nbsp;
                        <label class="text-color block text-sm w-1/12 pt-1 text-center">%</label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                name="DISCOUNTAMOUNT" id="DISCOUNTAMOUNT" value="<?=!empty($data['DISCOUNTAMOUNT']) ? number_format(str_replace(',', '', $data['DISCOUNTAMOUNT']), 2): '0.00'; ?>" readonly/>&nbsp;
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                name="CUSCURDISP" <?php if(!empty($data['CUSCURDISP'])){ ?> value="<?=$data['CUSCURDISP']; ?>"<?php } else { ?> value="" <?php }?> disabled/>
                    </div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-8/12">
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-8/12 py-2 px-3 text-gray-700 border-gray-300"
                            name="ESTREM3" id="ESTREM3" value="<?=!empty($data['ESTREM3']) ? $data['ESTREM3']: ''; ?>"/>
                    </div>
                    <div class="flex w-4/12">
                        <label class="text-color block text-sm w-6/12 pr-2 pt-1"><?=checklang('AFTERDISCOUNT')?></label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                name="QUOTEAMOUNT" id="QUOTEAMOUNT" value="<?=!empty($data['QUOTEAMOUNT']) ? number_format(str_replace(',', '', $data['QUOTEAMOUNT']), 2): '0.00'; ?>" readonly/>&nbsp;
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                name="CUSCURDISP" <?php if(!empty($data['CUSCURDISP'])){ ?> value="<?=$data['CUSCURDISP']; ?>"<?php } else { ?> value="" <?php }?> disabled/>
                    </div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-8/12"></div>
                    <div class="flex w-4/12">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1"><?=checklang('VAT')?></label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-right"
                                name="VATRATE" id="VATRATE" onchange="vat();" value="<?=!empty($data['VATRATE']) ? $data['VATRATE']: ''; ?>"
                                oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>&nbsp;
                        <label class="text-color block text-sm w-1/12 pt-1 text-center">%</label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                name="VATAMOUNT1" id="VATAMOUNT1" value="<?=!empty($data['VATAMOUNT1']) ? number_format(str_replace(',', '', $data['VATAMOUNT1']), 2): '0.00'; ?>" readonly/>
                        <input class="hidden" name="VATAMOUNT" id="VATAMOUNT" value="<?=!empty($data['VATAMOUNT']) ? number_format(str_replace(',', '', $data['VATAMOUNT']), 2): '0.00'; ?>" readonly/>&nbsp;
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                name="CUSCURDISP" value="<?=!empty($data['CUSCURDISP']) ? $data['CUSCURDISP']: ''; ?>" disabled/>
                    </div>
                </div>

                <div class="flex mb-1">
                    <div class="flex w-8/12"></div>
                    <div class="flex w-4/12">
                        <label class="text-color block text-sm w-6/12 pr-2 pt-1"><?=checklang('TOTALAMOUNT')?></label>
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 text-right read"
                                name="T_AMOUNT" id="T_AMOUNT" value="<?=!empty($data['T_AMOUNT']) ? number_format(str_replace(',', '', $data['T_AMOUNT']), 2): '0.00'; ?>" readonly/>&nbsp;
                        <input type="text" class="text-control text-sm shadow-md border rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 text-center read"
                                name="CUSCURDISP" <?php if(!empty($data['CUSCURDISP'])){ ?> value="<?=$data['CUSCURDISP']; ?>"<?php } else { ?> value="" <?php }?> disabled/>
                    </div>
                </div>

                <div class="flex mt-2">
                    <div class="flex w-6/12 px-1">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2" 
                                id="COMMIT" name="COMMIT" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_COMMIT'] != 'T') {?> hidden <?php }?>
                                <?php if(!empty($data['SYSVIS_CANCELLBL']) && $data['SYSVIS_CANCELLBL'] == 'T') { ?> disabled <?php } ?>><?=checklang('COMMIT'); ?></button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2" 
                                id="CANCEL" name="CANCEL" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_CANCEL'] != 'T') {?> hidden <?php }?>
                                <?php if(!empty($data['SYSVIS_CANCELLBL']) && $data['SYSVIS_CANCELLBL'] == 'T') { ?> disabled <?php } ?>
                                <?php if(!empty($data['isPrint']) && $data['isPrint'] == 'off') { ?> disabled <?php } ?>><?=checklang('CANCEL'); ?></button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2" 
                                id="PRINT" name="PRINT" <?php if(!empty($data['isPrint']) && $data['isPrint'] == 'off') { ?> disabled <?php } ?>><?=checklang('PRINT'); ?></button>
                    </div>
                    <div class="flex w-6/12 px-1 justify-end">
                        <button type="reset" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2"
                                id="clear" name="clear" onclick="unsetSession(this.form);"><?=checklang('CLEAR'); ?></button>
                        <button type="button" id="end" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-2" 
                                onclick="questionDialog(1, '<?=$lang['question1']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');"><?=checklang('END'); ?></button>
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
<!-- <script src="./js/script.js" integrity="sha384-IUGDXqlf+oGRETvGgfMzN+B1HGbm4CGrPLtrLjiC1AD2slApI84jHpKyfFnncjoE" crossorigin="anonymous"></script> -->
<script type="text/javascript">
    $(document).ready(function() {
        unRequired();
        let cancelled = '<?php echo (!empty($data['SYSVIS_CANCELLBL']) ? $data['SYSVIS_CANCELLBL']: 'null'); ?>';
        if(cancelled != 'null' && cancelled == 'T') { 
            $('.search-tag').css('pointer-events', 'none');
            $('.text-control').attr('disabled','disabled').css('background-color', 'whitesmoke');
            $('.table .search-tag').css('pointer-events', 'none');
            $('.table .text-control').attr('readonly', true).css('background-color', 'whitesmoke');
            $('#ESTNO').removeAttr('disabled').css('background-color', 'white');
        }
        var index = 0; var id; 
        index = '<?php echo (!empty($data['ITEM']) ? count($data['ITEM']) : 0); ?>';
        // console.log(index);
        $("#add-row").click(function() {
            // console.log('index before' + index);
            index ++;  // index += 1; 
            // console.log('index after' + index);
            var newRow = $('<tr id=rowId'+index+'>');
            var cols = "";
            cols += '<td class="row-id text-center text-sm max-w-4 border border-slate-700" id="ROWNO'+index+'" name="ROWNO[]">'+index+'</td>';
            cols += '<td class="max-w-24 text-sm border border-slate-700"><div class="relative">' +
                        '<input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300"' +
                        'id="ITEMCD'+index+'" name="ITEMCD[]" onchange="findItemCode('+index+');" onkeyup="onEnterItem(event, '+index+');"/>' +
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
                    'id="SALELNQTY'+index+'" name="SALELNQTY[]" onchange="calculateamt('+index+'); this.value = numberWithCommas(this.value);" '+
                    'oninput="this.value = stringReplace(this.value);"/></td>';
            cols += '<td class="max-w-8 text-sm border border-slate-700"><input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-center read"'+
                    'id="ITEMUNITTYP'+index+'" name="ITEMUNITTYP[]" readonly/></td>';
            cols += '<td class="max-w-8 text-sm border border-slate-700"><input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right"'+
                    'id="SALELNUNITPRC'+index+'" name="SALELNUNITPRC[]" onchange="calculateamt('+index+'); this.value = numberWithCommas(this.value);" '+
                    'oninput="this.value = stringReplace(this.value);"/></td>';
            cols += '<td class="max-w-8 text-sm border border-slate-700"><input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right"'+
                    'id="SALELNDISCOUNT'+index+'" name="SALELNDISCOUNT[] onchange="calculateamt('+index+'); this.value = numberWithCommas(this.value);" '+
                    'oninput="this.value = stringReplace(this.value);"/></td>';
            cols += '<td class="max-w-8 text-sm border border-slate-700"><input class="text-control text-sm shadow-md border rounded-xl h-6 w-full py-2 px-3 text-gray-700 border-gray-300 text-right read"'+
                    'id="SALELNAMT'+index+'" name="SALELNAMT[]" readonly/></td>';
            cols += '<td class="hidden"><input class="w-16 read" id="SALELNDISCOUNT2'+index+'" name="SALELNDISCOUNT2[]" readonly/></td>';
            cols += '<td class="hidden"><input class="w-16 read" id="SALELNTAXAMT'+index+'" name="SALELNTAXAMT[]" readonly/></td>';
           // console.log($(".row-id").length);
           // console.log($('#rowId'+index+'').closest('tr').attr('id'));
            if(index <= 4) {
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

            // $('.row-id').each(function (i){
            //    $(this).text(i+1);
            // });
        });
        // Find and remove selected table rows
        $('#delete-row').click(function(){
            // document.getElementById('table').deleteRow(index);
            // console.log(id);
            if(index > 0 && id != null) {
                // let rows = document.getElementsByTagName('tr');
                $('#rowId'+id).closest('tr').remove();
                if(index <= 4) {
                    emptyRow(index);
                }
                index --;   // index -= 1;
                $('.row-id').each(function (i) {
                    // console.log(i);
                    // rows[id].id = "rowId" + index;
                    $(this).text(i+1);
                }); 
                changeRowIds();
                unsetSessionItem(id);
                id = null;
                // console.log(index);
            }
        });

        $(document).on('click', '.so_table tr', function(event){
            // let rowId = $(this).closest('tr').attr('id');
            // console.log(rowId);
            let item = $(this).closest('tr').children('td');
            id = item.eq(0).text();
             // console.log(rowId);
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
            $('table tbody').append('<tr id="rowId'+n+'>' +
                                    '<td class="h-6 border border-slate-700"></td>' +
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

    function findItemCode(n) {
        if($("#CUSTOMERCD").val() == '' || $("#CUSTOMERCD").val() == 'undefined') {
            return itemValidation('<?=$lang['ERRO_NO_CUTOMER']; ?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');
        } else if($("#CUSCURCD").val() == '' || $("#CUSCURCD").val() == 'undefined') {
            return itemValidation('<?=$lang['ERRO_NOCURCD']; ?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');
        } else {
            $("#loading").show();
            window.location.href="index.php?ITEMCD=" + $('#ITEMCD'+n+'').val() +'&index=' + n;
        }
    }

    function searchItemIndex(lineIndex) {
        // console.log(lineIndex);
        if($("#CUSTOMERCD").val() == '' || $("#CUSTOMERCD").val() == 'undefined') {
            return itemValidation('<?=$lang['ERRO_NO_CUTOMER']; ?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');
        } else if($("#CUSCURCD").val() == '' || $("#CUSCURCD").val() == 'undefined') {
            return itemValidation('<?=$lang['ERRO_NOCURCD']; ?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');
        } else {
            return window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHITEM/index.php?page=ACC_SALEORDERENTRY_THA&index=' + lineIndex, 'authWindow', 'width=1200,height=600');
        }
    }

    function HandlePopupResult(code, result) {
        // console.log("result of popup is: " + code + ' : ' + result);
        return getSearch(code, result);
    }

    function HandlePopupItem(result, index) {
        // console.log("result of popup result: " + result + ' : ' + index);
        $('#loading').show();
        return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/810/ACC_SALEORDERENTRY_THA/index.php?ITEMCD=' + result +'&index=' + index;
    }


    function commitDialog() {
       return questionDialog(3, '<?=$lang['question3']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');
    }

    function cancelDialog() {    
        if($("#SALEORDERNO").val() == '' || $("#SALEORDERNO").val() == 'undefined') {
            return itemValidation('<?=$lang['ERRO_SALEORDERNO']; ?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');
        } else {
            return questionDialog(2, '<?=$lang['question2']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>')
        }
    }

    function printDialog() {
       return questionDialog(4, '<?=$lang['question4']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');
    }

    function alertValidation() {
        return Swal.fire({ 
            title: '',
            // icon: 'success',
            text: '<?=$lang['validation1']; ?>',
            // background: '#8ca3a3',
            showCancelButton: false,
            // confirmButtonColor: 'silver',
            // cancelButtonColor: 'silver',
            confirmButtonText: '<?=$lang['yes']; ?>',
            cancelButtonText: '<?=$lang['nono']; ?>'
            }).then((result) => {
                if (result.isConfirmed) {
            }
        });
    }

    function unRequired() {
        if (DIVISIONCD.val() != "") {
            document.getElementById("DIVISIONCD").classList.remove("req");
        }
        if (CUSTOMERCD.val() != "") {
            document.getElementById("CUSTOMERCD").classList.remove("req");
        }
        if (STAFFCD.val() != "") {
            document.getElementById("STAFFCD").classList.remove("req");
        }
    }
</script>
</html>
