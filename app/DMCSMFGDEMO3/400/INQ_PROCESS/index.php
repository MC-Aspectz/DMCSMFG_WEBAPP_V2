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
        <main class="flex flex-1 overflow-y-auto paragraph">
            <!-- Content Page -->
            <input type="hidden" id="appcode" name="appcode" value="<?=$appcode?>">
            <input type="hidden" id="comcd" name="comcd" value="<?=$_SESSION['COMCD']?>">
            <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
            <form class="w-full" method="POST" id="inqProcess" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
                <label class="text-color block text-lg font-bold mx-2"><?=$_SESSION['APPNAME']; ?></label>
                <div class="flex mb-1">
                    <div class="flex w-6/12 px-2">
                        <label class="text-color block text-sm w-3/12 pr-2 pt-1" id="PRODUCTIONORDER_TXT"><?=checklang('PRODUCTIONORDER')?></label>
                        <div class="relative w-4/12 mr-1">
                            <input type="text" class="text-control text-sm shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300"
                                    id="P1" name="P1" value="<?=isset($data['P1']) ? $data['P1']: ''; ?>"/>
                            <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                                id="SEARCHPRODUCTIONORDER">
                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="flex w-6/12 px-2 justify-end">
                        <button type="submit" class="btn text-color inline-flex items-center border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2"
                                id="SEARCH" name="SEARCH" onclick="$('#loading').show();"><?=checklang('SEARCH')?>
                            <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-scroll px-2 block h-[600px]">
                    <table id="table" class="w-full sortable n-last border-collapse border border-slate-500 divide-gray-200" rules="cols" cellpadding="3" cellspacing="1">
                        <thead class="sticky top-0 bg-gray-50">
                            <tr class="border border-gray-600 csv">
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PRODUCTIONORDER')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMCODE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ITEMNAME')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('SPECIFICATE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PRODUCT_ORDER_QTY')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PROD_DUE_DATE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ROUT_NO')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PROCESSTYPE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('WC_CODE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('WORK_CENTER_NAME')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('STD_HOUR_RATE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CUR_HOUR_RATE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('STD_EXPENSE_RATE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CUR_EXPENSE_RATE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('CURRENCY')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('JOB_CODE')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('MEMO')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('PLANEDQTY')?></span>
                                </th>
                                <th class="px-6 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('JOB_TIME')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('UNIT_TIME')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('STARTDATE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('START_TIME')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('ENDDATE')?></span>
                                </th>
                                <th class="px-3 text-center border border-slate-700">
                                    <span class="text-color text-sm font-semibold tracking-wide whitespace-nowrap"><?=checklang('FINISH_TIME')?></span>
                                </th>
                            </tr>
                        </thead>

                        <tbody id="dvwdetail" class="divide-y divide-gray-200 flex-none overflow-y-auto"> <?php 
                        if(!empty($data['ITEM'])) { $minrow = count($data['ITEM']);
                            foreach($data['ITEM'] as $key => $value) { ?>
                                <tr class="divide-y divide-gray-200 csv" id="rowId<?=$key?>">
                                    <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['PROPSSORDERNO']) ? $value['PROPSSORDERNO']: '' ?></td>
                                    <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['PROITEMCD']) ? $value['PROITEMCD']: '' ?></td>
                                    <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['PROITEMNAME']) ? $value['PROITEMNAME']: '' ?></td>
                                    <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['PROITEMSPEC']) ? $value['PROITEMSPEC']: '' ?></td>
                                    <td class="h-6 pr-2 text-sm border border-slate-700 text-right whitespace-nowrap"><?=isset($value['PROQTY']) ? $value['PROQTY']: '' ?></td>
                                    <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['PROPLANENDDT']) ? $value['PROPLANENDDT']: '' ?></td>
                                    <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['PROPSSNO']) ? $value['PROPSSNO']: '' ?></td>
                                    <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['PROPSSTYP']) ? $value['PROPSSTYP']: '' ?></td>
                                    <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['PROPSSPLACE']) ? $value['PROPSSPLACE']: '' ?></td>
                                    <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['WCNAME']) ? $value['WCNAME']: '' ?></td>
                                    <td class="h-6 pr-2 text-sm border border-slate-700 text-right whitespace-nowrap"><?=isset($value['WCSTDHOURRATE']) ? $value['WCSTDHOURRATE']: '' ?></td>
                                    <td class="h-6 pr-2 text-sm border border-slate-700 text-right whitespace-nowrap"><?=isset($value['WCHOURRATE']) ? $value['WCHOURRATE']: '' ?></td>
                                    <td class="h-6 pr-2 text-sm border border-slate-700 text-right whitespace-nowrap"><?=isset($value['WCSTDCOST']) ? $value['WCSTDCOST']: '' ?></td>
                                    <td class="h-6 pr-2 text-sm border border-slate-700 text-right whitespace-nowrap"><?=isset($value['WCCOST']) ? $value['WCCOST']: '' ?></td>
                                    <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['COMCURRENCY']) ? $value['COMCURRENCY']: '' ?></td>
                                    <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['PROPSSJOBTYP']) ? $value['PROPSSJOBTYP']: '' ?></td>
                                    <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['PROPSSREM']) ? $value['PROPSSREM']: '' ?></td>
                                    <td class="h-6 pr-2 text-sm border border-slate-700 text-right whitespace-nowrap"><?=isset($value['PROPSSQTY']) ? $value['PROPSSQTY']: '' ?></td>
                                    <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['PROPSSDURATION']) ? $value['PROPSSDURATION']: '' ?></td>
                                    <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['PROPSSUNITTYP']) ? $value['PROPSSUNITTYP']: '' ?></td>
                                    <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['PROPSSSTARTDT']) ? $value['PROPSSSTARTDT']: '' ?></td>
                                    <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['PROPSSSTARTTM']) ? $value['PROPSSSTARTTM']: '' ?></td>
                                    <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['PROPSSENDDT']) ? $value['PROPSSENDDT']: '' ?></td>
                                    <td class="h-6 pl-2 text-sm border border-slate-700 text-left whitespace-nowrap"><?=isset($value['PROPSSENDTM']) ? $value['PROPSSENDTM']: '' ?></td>
                                </tr><?php
                            }
                        }
                        for ($i = $minrow+1; $i <= $maxrow; $i++) { ?>
                            <tr class="divide-y divide-gray-200" id="rowId<?=$i?>">
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                                <td class="h-6 border border-slate-700"></td>
                            </tr> <?php
                        } ?>
                        </tbody>
                    </table>
                </div>

                <div class="flex pt-2 px-2">
                    <div class="flex w-12/12">
                        <label class="text-color text-[12px]"><?=checklang('ROWCOUNT');?>  <span id="rowcount"><?=$minrow;?></span></label>
                    </div>
                </div>

                <div class="flex mt-2 px-2">
                    <div class="flex w-6/12">
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                id="CSV" name="CSV"><?=checklang('CSV'); ?></button>
                        <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1 mx-3"
                                id="DETAIL" name="DETAIL"><?=checklang('DETAIL'); ?></button>
                    </div>
                    <div class="flex w-6/12 justify-end">
                        <button type="reset" id="CLEAR" name="CLEAR" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                onclick="unsetSession(this.form);"><?=checklang('CLEAR')?></button>&emsp;&emsp;
                        <button type="button" id="END" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                                onclick="questionDialog(1, '<?=$lang['question1']?>', '<?=$lang['yes']; ?>', '<?=$lang['no']; ?>');"><?=checklang('END'); ?></button>
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

<!-- start::modal -->
<div class="modal fade" id="modal-view" tabindex="-1" role="dialog" aria-labelledby="item_viewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <label class="text-gray-700 text-base font-semibold"><?=checklang('DETAIL'); ?></label>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-centere"
                        data-bs-dismiss="modal" aria-label="Close">
                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <table class="w-full border-collapse border border-slate-500" id="tb-modal" rules="cols" cellpadding="3" cellspacing="1" >
                    <thead>
                        <tr>
                            <th class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('TITLE'); ?></th>
                            <th class="text-center border border-slate-700 text-sm"><?=checklang('VALUE'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('PRODUCTIONORDER'); ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="PROPSSORDERNOS"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('ITEMCODE'); ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="PROITEMCDS"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('ITEMNAME'); ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="PROITEMNAMES"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('SPECIFICATE'); ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="PROITEMSPECS"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('PRODUCT_ORDER_QTY'); ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="PROQTYS"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('PROD_DUE_DATE'); ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="PROPLANENDDTS"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('ROUT_NO'); ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="PROPSSNOS"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('PROCESSTYPE'); ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="PROPSSTYPS"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('WC_CODE'); ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="PROPSSPLACES"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('WORK_CENTER_NAME'); ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="WCNAMES"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('STD_HOUR_RATE'); ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="WCSTDHOURRATES"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('CUR_HOUR_RATE'); ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="WCHOURRATES"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('STD_EXPENSE_RATE'); ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="WCSTDCOSTS"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('CUR_EXPENSE_RATE'); ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="WCCOSTS"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('CURRENCY'); ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="COMCURRENCYS"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('JOB_CODE'); ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="PROPSSJOBTYPS"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('MEMO'); ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="PROPSSREMS"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('PLANEDQTY'); ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="PROPSSQTYS"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('JOB_TIME'); ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="PROPSSDURATIONS"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('UNIT_TIME'); ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="PROPSSUNITTYPS"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('STARTDATE'); ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="PROPSSSTARTDTS"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('START_TIME'); ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="PROPSSSTARTTMS"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('ENDDATE'); ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="PROPSSENDDTS"></td>
                        </tr>
                        <tr>
                            <td class="text-left pl-1 border border-slate-700 text-sm"><?=checklang('FINISH_TIME'); ?></td>
                            <td class="text-left pl-1 border border-slate-700 text-sm" id="PROPSSENDTMS"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="h-6 text-[12px] mt-2"><?=checklang('ROWCOUNT'); ?> 24</div>
            </div>
            <div class="modal-footer">
               <button type="button" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" data-bs-dismiss="modal"><?=checklang('END'); ?></button>
            </div>
        </div>
    </div>
</div>
<!-- end::modal -->
</body>
</html>
<script src="./js/script.js"></script>
<script type="text/javascript">
    function HandlePopupResult(code, result) {
        // console.log('result of popup is: ' + code + ' : ' + result);
        document.getElementById('P1').value = result;
    }
</script>