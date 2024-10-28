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
            <form class="w-full" method="POST" id="itemmaster" name="itemmaster" action="" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">

            <label class="text-color block text-lg font-bold"><?=$_SESSION['APPNAME']; ?></label>

            <div class="flex mb-1 py-1">
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?=checklang('ITEMCODE'); ?></label>
                    <div class="relative w-4/12 mr-1">
                        <input type="text" class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                            name="ITEMCD" id="ITEMCD" value="<?=isset($data['ITEMCD']) ? $data['ITEMCD']: ''?>" oninput="toUpperCase(this)" onchange="unRequired();" require/>
                        <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                            id="searchitem">
                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </a>
                    </div>
                    <label class="text-color block text-sm pr-2 pt-1 ml-2"><?=checklang('CLONE'); ?></label>
                    <div class="fix-icon">
                        <a href="#" id="searchboi"><img src="<?=$_SESSION['APPURL']?>/img/search.png"></a>
                    </div>
                </div>

                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?=checklang('BOI_TYPE'); ?></label>
                    <select class="text-control shadow-md border mr-1 px-3 h-7 w-4/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            id="ITEMBOI" name="ITEMBOI">
                        <option value=""></option>
                        <?php foreach ($typeboi as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (!empty($data['ITEMBOI']) && $data['ITEMBOI'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="flex mb-1 py-1">
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?=checklang('ITEMNAME'); ?></label>
                    <input class="text-control shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                           type="text" id="ITEMNAME" name="ITEMNAME" <?php if(!empty($data['ITEMNAME'])){ ?> value="<?php echo $data['ITEMNAME']; ?>" <?php } else { ?> value="" <?php }?>/>
                </div>

                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?=checklang('SEARCH_CHAR'); ?></label>
                    <input class="text-control shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                           type="text" id="ITEMSEARCH" name="ITEMSEARCH" required onchange="unRequired();" <?php if(!empty($data['ITEMSEARCH'])){ ?> value="<?php echo $data['ITEMSEARCH']; ?>" <?php } else { ?> value="" <?php }?> />
                </div>
            </div>

            <div class="flex mb-1 py-1">
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?=checklang('SPECIFICATE'); ?></label>
                    <input class="text-control shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                           type="text" id="ITEMSPEC" name="ITEMSPEC" <?php if(!empty($data['ITEMSPEC'])){ ?> value="<?php echo $data['ITEMSPEC']; ?>"<?php } else { ?> value="" <?php }?>/>&emsp;&nbsp;
                </div>

                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?=checklang('IM_TYPE'); ?></label>
                    <select class="text-control shadow-md border mr-1 px-3 h-7 w-4/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                            id="ITEMTYP" name="ITEMTYP" onchange="unRequired();" required>
                        <option value=""></option>
                            <?php foreach ($typeItem as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['ITEMTYP']) && $data['ITEMTYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                            <?php } ?>
                    </select>
                </div>
            </div>

            <div class="flex mb-1 py-1">
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?=checklang('CATEGORY_CODE'); ?></label>
                    <div class="relative w-4/12 mr-1">
                        <input class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req" 
                               type="text" id="CATALOGCD" name="CATALOGCD" onchange="unRequired();" required 
                               <?php if(!empty($data['CATALOGCD'])){ ?> value="<?php echo $data['CATALOGCD']; ?>"<?php } else { ?> value="<?php echo isset($_GET['categorycd']) ? $_GET['categorycd']: ''; ?>" <?php }?>/>
                        <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                            id="searchcategory">
                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </a>
                    </div>
                    <input class="text-control shadow-md border z-20 rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                           type="text" id="CATALOGNAME" name="CATALOGNAME" <?php if(!empty($data['CATALOGNAME'])){ ?> value="<?php echo $data['CATALOGNAME']; ?>"<?php } else { ?> value="" <?php }?> disabled/>
                </div>

                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?=checklang('WHTAXTYP'); ?></label>
                    <select class="text-control shadow-md border mr-1 px-3 h-7 w-4/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            id="ITEMWHTTYP" name="ITEMWHTTYP">
                        <option value=""></option>
                        <?php foreach ($whtaxtyp as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (!empty($data['ITEMWHTTYP']) && $data['ITEMWHTTYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="flex mb-1 py-1">
                <div class="flex w-6/12">
                    <!-- Supplier Code -->
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?=checklang('SUPPLIER_CODE'); ?></label>
                    <div class="relative w-4/12 mr-1">
                        <input class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                           type="text" id="SUPPLIERCD" name="SUPPLIERCD"
                           <?php if(!empty($data['SUPPLIERCD'])){ ?> value="<?php echo $data['SUPPLIERCD']; ?>"<?php } 
                           else { ?> value="<?php echo isset($_GET['suppliercd']) ? $_GET['suppliercd']: ''; ?>" <?php }?> />
                        <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                            id="searchsupplier">
                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </a>
                    </div>
                    <input class="text-control shadow-md border z-20 rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                           type="text" id="SUPPLIERNAME" name="SUPPLIERNAME" <?php if(!empty($data['SUPPLIERNAME'])){ ?> value="<?php echo $data['SUPPLIERNAME']; ?>"<?php } else { ?> value="" <?php }?> disabled/>
                    <!-- Supplier Code -->
                </div>

                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?=checklang('PRDER_RULE'); ?></label>
                    <select class="text-control shadow-md border mr-1 px-3 h-7 w-4/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                            id="ITEMORDRULETYP" name="ITEMORDRULETYP" onchange="unRequired();" required>
                        <option value=""></option>
                        <?php foreach ($itemOrder as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['ITEMORDRULETYP']) && $data['ITEMORDRULETYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="flex mb-1 py-1">
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?=checklang('STRAGE_CODE'); ?></label>
                    <div class="relative w-4/12 mr-1">
                        <input class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                               type="text" id="STORAGECD" name="STORAGECD" onchange="unRequired();" required 
                               <?php if(!empty($data['STORAGECD'])){ ?> value="<?php echo $data['STORAGECD']; ?>"<?php }
                               else { ?> value="<?php echo isset($_GET['locationcd']) ? $_GET['locationcd']: ''; ?>" <?php }?> />
                        <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                            id="searchlocation">
                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </a>
                    </div>
                    <input class="text-control shadow-md border z-20 rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read"
                           type="text" id="STORAGENAME" name="STORAGENAME" <?php if(!empty($data['STORAGENAME'])){ ?> value="<?php echo $data['STORAGENAME']; ?>"<?php } else { ?> value="" <?php }?> disabled/>
                </div>

                <div class="flex w-6/12">
                    <!-- Unit of Measure -->
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?=checklang('MEASURE_UNIT'); ?></label>
                    <select class="text-control shadow-md border mr-1 px-3 h-7 w-4/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                            id="ITEMUNITTYP" name="ITEMUNITTYP" onchange="unRequired();" required>
                        <option value=""></option>
                        <?php foreach ($unit as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (!empty($data['ITEMUNITTYP']) && $data['ITEMUNITTYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>
                    <!-- Unit of Measure -->
                </div>
            </div>

            <div class="flex mb-1 py-1">
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?=checklang('LEADTIME'); ?></label>
                    <input class="text-control shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                           type="text" id="ITEMLEADTIME" name="ITEMLEADTIME" onchange="unRequired();" required 
                           <?php if(!empty($data['ITEMLEADTIME'])){ ?> value="<?php echo number_format($data['ITEMLEADTIME'], 0); ?>"<?php }
                            else { ?> value="" <?php }?> oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                    <label class="text-color block text-sm w-1/12 pr-2 pt-1 ml-2"><?=checklang('DAYS'); ?></label>
                </div>

                <div class="flex w-6/12">
                    <!-- PO Unit -->
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?=checklang('po_unit'); ?></label>
                    <select class="text-control shadow-md border mr-1 px-3 h-7 w-4/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                            id="ITEMPOUNITTYP" name="ITEMPOUNITTYP" onchange="unRequired();" required>
                        <option value=""></option>
                        <?php foreach ($unit as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (!empty($data['ITEMPOUNITTYP']) && $data['ITEMPOUNITTYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>
                    <input class="hidden"
                           type="text" id="ITEMPOUNITRATE" name="ITEMPOUNITRATE" onchange="unRequired();"
                           <?php if(!empty($data['ITEMPOUNITRATE'])){ ?> value="<?php echo number_format($data['ITEMPOUNITRATE'], 0); ?>"<?php }
                           else { ?> value="" <?php }?> oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                    <!-- PO Unit -->
                </div>
            </div>

            <div class="flex mb-1 py-1">
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?=checklang('UNITPRICE_INV'); ?></label>
                    <input class="text-control shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                           type="text" id="ITEMINVPRICE" name="ITEMINVPRICE" 
                           <?php if(!empty($data['ITEMINVPRICE'])){ ?> value="<?php echo number_format($data['ITEMINVPRICE'], 2); ?>"<?php }
                            else { ?> value="" <?php }?> onchange="this.value = numberWithCommas(this.value);" oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');" />
                    <label class="text-color block text-sm pr-2 pt-1 ml-2"><?=$lang['thb']; ?></label>
                </div>

                <div class="flex w-6/12">
                    <!-- Order Multiple -->
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?=checklang('FIXED_ORDER'); ?></label>
                    <input class="text-control shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                           type="text" id="ITEMFIXORDER" name="ITEMFIXORDER" 
                           <?php if(!empty($data['ITEMFIXORDER'])){ ?> value="<?php echo number_format($data['ITEMFIXORDER'], 2); ?>"<?php } 
                           else { ?> value="" <?php }?> onchange="this.value = numberWithCommas(this.value);" oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');" />
                    <!-- Order Multiple -->
                </div>
            </div>

            <div class="flex mb-1 py-1">
                <div class="flex w-6/12">
                    <!-- Purchase Price -->
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?=checklang('PURCHASE_PRICE'); ?></label>
                    <input class="text-control shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                           type="text" id="ITEMSTDPURPRICE" name="ITEMSTDPURPRICE" 
                           <?php if(!empty($data['ITEMSTDPURPRICE'])){ ?> value="<?php echo number_format($data['ITEMSTDPURPRICE'], 2); ?>"<?php } 
                           else { ?> value="" <?php }?> onchange="this.value = numberWithCommas(this.value);" oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');" />
                    <label class="text-color block text-sm w-1/12 pr-2 pt-1 ml-2"><?php echo $lang['thb']; ?></label>
                    <!-- Purchase Price -->
                    <!-- Supply Price -->
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"> <?php echo $data['TXTLANG']['SUPPLY_PRICE']; ?></label>
                    <input class="text-control shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                           type="text" id="ITEMSTDSUPPLYPRICE" name="ITEMSTDSUPPLYPRICE" 
                           <?php if(!empty($data['ITEMSTDSUPPLYPRICE'])){ ?> value="<?php echo number_format($data['ITEMSTDSUPPLYPRICE'],2); ?>"<?php } 
                           else { ?> value="" <?php }?> onchange="this.value = numberWithCommas(this.value);" oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');" />
                    <label class="text-color block text-sm pr-2 pt-1 ml-2"><?php echo $lang['thb']; ?></label>
                    <!-- Supply Price -->
                </div>

                <div class="flex w-6/12">
                    <!-- Minium Order -->
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?php echo $lang['minimun_order']; ?></label>
                    <input class="text-control shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                           type="text" id="ITEMMINORDER" name="ITEMMINORDER" 
                           <?php if(!empty($data['ITEMMINORDER'])){ ?> value="<?php echo number_format($data['ITEMMINORDER'], 2); ?>"<?php } 
                           else { ?> value="" <?php }?> onchange="this.value = numberWithCommas(this.value);" oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');" />
                    <!-- Minium Order -->
                </div>
            </div>

            <div class="flex mb-1 py-1">
                <div class="flex w-6/12">
                    <!-- Selling Price -->
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?=checklang('SALES_PRICE'); ?></label>
                    <input class="text-control shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                           type="text" id="ITEMSHOPPRICE" name="ITEMSHOPPRICE" 
                           <?php if(!empty($data['ITEMSHOPPRICE'])){ ?> value="<?php echo number_format($data['ITEMSHOPPRICE'],2); ?>"<?php } 
                           else { ?> value="" <?php }?> onchange="this.value = numberWithCommas(this.value);" oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');" />
                    <label class="text-color block text-sm w-1/12 pr-2 pt-1 ml-2"><?php echo $lang['thb']; ?></label>
                    <!-- Selling Price -->
                    <!-- Retail Price -->
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?=checklang('SHOP_PRICE'); ?></label>
                    <input class="text-control shadow-md border z-20 rounded-xl h-7 w-2/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                           type="text" id="ITEMSTDSALEPRICE" name="ITEMSTDSALEPRICE" 
                           <?php if(!empty($data['ITEMSTDSALEPRICE'])){ ?> value="<?php echo number_format($data['ITEMSTDSALEPRICE'],2); ?>"<?php } 
                           else { ?> value="" <?php }?> onchange="this.value = numberWithCommas(this.value);" oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');" />
                    <label class="text-color block text-sm pr-2 pt-1 ml-2"><?php echo $lang['thb']; ?></label>
                    <!-- Retail Price -->
                </div>

                <div class="flex w-6/12">
                    <!-- Buffer Stock -->
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?=checklang('BUFFER_STOCK'); ?></label>
                    <input class="text-control shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                           type="text" id="ITEMMINSTOCK" name="ITEMMINSTOCK" 
                           <?php if(!empty($data['ITEMMINSTOCK'])){ ?> value="<?php echo number_format($data['ITEMMINSTOCK'], 2); ?>"<?php } 
                           else { ?> value="" <?php }?> onchange="this.value = numberWithCommas(this.value);" oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');" />
                    <!-- Buffer Stock -->
                </div>
            </div>

            <br>

            <div class="flex mb-1 py-1">
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?=checklang('INVCALCTYP'); ?></label>
                    <select class="text-control shadow-md border mr-1 px-3 h-7 w-4/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            id="ITEMINVCALCTYP" name="ITEMINVCALCTYP">
                        <option value=""></option>
                        <?php foreach ($invcalc as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (!empty($data['ITEMINVCALCTYP']) && $data['ITEMINVCALCTYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?php echo $data['TXTLANG']['TYPE_PACK']; ?></label>
                    <select class="text-control shadow-md border mr-1 px-3 h-7 w-4/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            id="ITEMPACKTYP" name="ITEMPACKTYP">
                        <option value=""></option>
                        <?php foreach ($package as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (!empty($data['ITEMPACKTYP']) && $data['ITEMPACKTYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <!-------------------------------------- Material Code -------------------------------------->
            <div class="flex mb-1 py-1">
                <div class="flex w-6/12">
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?php echo $data['TXTLANG']['MATERIALCODE']; ?></label>
                    <div class="relative w-4/12 mr-1 ml-1">
                        <input class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            type="text" id="MATERIALCD" name="MATERIALCD" 
                            <?php if(!empty($data['MATERIALCD'])){ ?> value="<?php echo $data['MATERIALCD']; ?>"<?php } 
                            else { ?> value="" <?php }?>/>
                        <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                            id="SEARCHMATERIAL">
                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </a>
                    </div>
                    <input class="text-control shadow-md border z-20 rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read" 
                           type="text" id="MATERIALNAME" name="MATERIALNAME" 
                           <?php if(!empty($data['MATERIALNAME'])){ ?> value="<?php echo $data['MATERIALNAME']; ?>"<?php } 
                           else { ?> value="" <?php }?> disabled/>
                </div>

                <div class="flex w-6/12">
                    <!-- Stocktake Freq. -->
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?php echo $data['TXTLANG']['CLEARANCE_ID']; ?></label>
                    <select class="text-control shadow-md border mr-1 px-3 h-7 w-4/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                            id="ITEMCLEARANCETYP" name="ITEMCLEARANCETYP" onchange="unRequired();">
                        <option value=""></option>
                        <?php foreach ($clearance as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (isset($data['ITEMCLEARANCETYP']) && $data['ITEMCLEARANCETYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>
                    <!-- Stocktake Freq. -->
                </div>
            </div>            
            <!-------------------------------------------------------------------------------------------------->

            <div class="flex mb-1 py-1">
                <div class="flex w-6/12">
                    <!-- Manufacturer -->
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?php echo $data['TXTLANG']['MAKER_CODE']; ?></label>
                    <select class="text-control shadow-md border mr-1 px-3 h-7 w-4/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            id="ITEMMAKERTYP" name="ITEMMAKERTYP">
                        <option value=""></option>
                        <?php foreach ($maker as $key => $item) { ?>
                            <option value="<?php echo $key ?>" <?php echo (!empty($data['ITEMMAKERTYP']) && $data['ITEMMAKERTYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php } ?>
                    </select>
                    <!-- Manufacturer -->
                </div>

                <div class="flex w-6/12">
                    <!-- Sale End Date -->
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?php echo $data['TXTLANG']['STOP_ORDER']; ?></label>
                    <input class="text-control shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                           type="date" id="ITEMSTOPDT" name="ITEMSTOPDT" value="<?=!empty($data['ITEMSTOPDT']) ? date('Y-m-d', strtotime($data['ITEMSTOPDT'])): ''; ?>"/>
                    <!-- Sale End Date -->
                </div>
            </div>

            <div class="flex mb-1 py-1">
                <div class="flex w-6/12">
                    <!-- Work Center -->
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?php echo $data['TXTLANG']['WC_CODE']; ?></label>
                    <div class="relative w-4/12 mr-1 ml-1">
                        <input class="text-control shadow-md border z-20 rounded-xl h-7 w-full py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            type="text" id="WCCD" name="WCCD" 
                            <?php if(!empty($data['WCCD'])){ ?> value="<?php echo $data['WCCD']; ?>"<?php } 
                            else { ?> value="" <?php }?>/>
                        <a class="search-tag absolute top-0 end-0 h-7 py-2 px-3 rounded-e-xl border focus:ring-4 focus:outline-none"
                            id="SEARCHWORKCENTER">
                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </a>
                    </div>
                    <input class="text-control shadow-md border z-20 rounded-xl h-7 w-5/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500 read" 
                           type="text" id="WCNAME" name="WCNAME" 
                           <?php if(!empty($data['WCNAME'])){ ?> value="<?php echo $data['WCNAME']; ?>"<?php } 
                           else { ?> value="" <?php }?> disabled/>
                    <!-- Work Center -->
                </div>

                <div class="flex w-6/12">
                    <!-- Capacity -->
                    <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?php echo $data['TXTLANG']['CAPACITY']; ?></label>
                    <input class="text-control shadow-md border z-20 rounded-xl h-7 w-4/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                           type="text" id="ITEMQTYINCASE" name="ITEMQTYINCASE" 
                           <?php if(!empty($data['ITEMQTYINCASE'])){ ?> value="<?php echo number_format($data['ITEMQTYINCASE'], 2); ?>"<?php } 
                           else { ?> value="" <?php }?> onchange="this.value = numberWithCommas(this.value);" oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');" />
                    <!-- Capacity -->
                </div>
            </div>

            <div class="flex flex-col mb-2 py-1">
                <div class="flex w-full">
                    <div class="flex flex-col w-4/12 px-2">
                        <div class="flex mb-1 py-1">
                            <!-- Cost Option -->
                            <label class="text-color block text-sm w-4/12 pr-2 pt-1"><?php echo $data['TXTLANG']['COST_TYPE']; ?></label>
                            <select class="text-control shadow-md border px-3 ml-8 h-7 w-6/12 text-left text-[12px] rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 req"
                                    id="ITEMCOSTTYP" name="ITEMCOSTTYP" onchange="unRequired();">
                                <option value=""></option>
                                <?php foreach ($costname as $key => $item) { ?>
                                    <option value="<?=$key ?>" <?=(!empty($data['ITEMCOSTTYP']) && $data['ITEMCOSTTYP'] == $key) ? 'selected' : '' ?>><?=$item ?></option>
                                <?php } ?>
                            </select>
                            <!-- Cost Option -->
                        </div>

                        <div class="flex mb-1 py-1">
                            <!-- Order Point -->
                            <label class="text-color block text-sm w-4/12 pr-2 pt-1"><?php echo $data['TXTLANG']['ORDER_POINT']; ?></label>
                            <input class="text-control shadow-md border rounded-xl h-7 ml-8 w-6/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                   type="text" id="ITEMORDERUNIT" name="ITEMORDERUNIT" value="<?=!empty($data['ITEMORDERUNIT']) ? number_format(str_replace(',', '', $data['ITEMORDERUNIT']), 2): '' ?>"
                                    onchange="this.value = numberWithComma(this.value);" oninput="this.value = stringReplacez(this.value);" />
                            <!-- Order Point -->
                        </div>

                        <div class="flex mb-1 py-1">
                            <!-- Unit Weight -->
                            <label class="text-color block text-sm w-4/12 pr-2 pt-1"><?php echo $data['TXTLANG']['UNIT_WEIGHT']; ?></label>
                            <input class="text-control shadow-md border z-20 rounded-xl h-7 ml-8 w-5/12 py-2 px-3 text-gray-700 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                   type="text" id="ITEMWEIGHT" name="ITEMWEIGHT" value="<?=!empty($data['ITEMWEIGHT']) ? number_format(str_replace(',', '', $data['ITEMWEIGHT']), 2): '' ?>"
                                   onchange="this.value = numberWithComma(this.value);" oninput="this.value = stringReplacez(this.value);" />
                            <label class="text-color block text-sm w-2/12 pr-2 pt-1 px-4"><?php echo $data['TXTLANG']['KG']; ?></label>
                            <!-- Unit Weight -->
                        </div>

                        <div class="flex mb-1 py-1">
                            <label class="text-color block text-sm w-5/12 pr-2 pt-1"><?=checklang('IMAGE')?></label>
                            <input type="file" class="block w-7/12 text-sm text-slate-500 file:py-2 file:px-3 file:rounded-full file:border-0 file:text-sm file:font-semibold 
                                file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100" id="ITEMIMGLOC" name="ITEMIMGLOC" value="<?=isset($data['ITEMIMGLOC']) ? $data['ITEMIMGLOC'] : '' ?>" accept=".jpg,.jpeg,.png"/>
                            <input type="hidden" id="OLDITEMIMGLOC" name="OLDITEMIMGLOC" value="<?=isset($data['ITEMIMGLOC']) ? $data['ITEMIMGLOC'] : '' ?>">
                        </div>
                    </div>

                    <div class="flex flex-col w-3/12 px-2 py-1">
                        <img class="rounded w-64 h-64" id="ITEMIMGPREVIEW" name="ITEMIMGPREVIEW" loading="lazy"
                            src="<?=!empty($data['ITEMIMGLOC']) ? $_SESSION['APPURL'].$data['ITEMIMGLOCVIEW']: $_SESSION['APPURL'].'/img/image_mfg.png'; ?>">
                    </div>

                    <div class="flex flex-col w-5/12 px-2">
                        <div class="flex mb-1 py-1">
                            <label class="text-color block text-sm w-1/12 pr-2 pt-1"></label>
                            <!-- FIFO List -->
                            <input type="checkbox" id="fifo_list" id="ITEMFIFOLISTFLG" name="ITEMFIFOLISTFLG" value="T" style="width: 15.0px"
                            <?php echo (!empty($data['ITEMFIFOLISTFLG']) && $data['ITEMFIFOLISTFLG'] == 'T') ? 'checked' : '' ?>/>&emsp;
                            <label class="text-color block text-sm w-9/12 pr-2 pt-1 ml-2"><?php echo $data['TXTLANG']['FIFO_LIST']; ?></label>
                            <!-- FIFO List -->
                        </div>

                        <div class="flex mb-1 py-1">
                            <label class="text-color block text-sm w-1/12 pr-2 pt-1"></label>
                            <!-- Phantom Item -->
                            <input type="checkbox" id="ITEMPHANTOMFLG" name="ITEMPHANTOMFLG" value="T" style="width: 15.0px"
                            <?php echo (!empty($data['ITEMPHANTOMFLG']) && $data['ITEMPHANTOMFLG'] == 'T') ? 'checked' : '' ?>/>&emsp;
                            <label class="text-color block text-sm w-9/12 pr-2 pt-1 ml-2"><?php echo $data['TXTLANG']['PHANTOM']; ?></label>
                            <!-- Phantom Item -->
                        </div>

                        <div class="flex mb-1 py-1">
                            <label class="text-color block text-sm w-1/12 pr-2 pt-1"></label>
                            <!-- No Inventory Control -->
                            <input type="checkbox" id="ITEMINVFLG" name="ITEMINVFLG" value="T" style="width: 15px"
                            <?php echo (!empty($data['ITEMINVFLG']) && $data['ITEMINVFLG'] == 'T') ? 'checked' : '' ?>/>&emsp;
                            <label class="text-color block text-sm w-9/12 pr-2 pt-1 ml-2"><?php echo $data['TXTLANG']['NO_INVENTRY']; ?></label>
                            <!-- No Inventory Control -->
                        </div>

                        <div class="flex mb-1 py-1">
                            <label class="text-color block text-sm w-1/12 pr-2 pt-1"></label>
                            <!-- Manufacturing Plan -->
                            <input type="checkbox" id="ITEMMASTERPLANFLG" name="ITEMMASTERPLANFLG" value="T" style="width: 15px"
                            <?php echo (!empty($data['ITEMMASTERPLANFLG']) && $data['ITEMMASTERPLANFLG'] == 'T') ? 'checked' : '' ?>/>&emsp;
                            <label class="text-color block text-sm w-9/12 pr-2 pt-1 ml-2"><?php echo $data['TXTLANG']['MASTER_PLAN_ITEM']; ?></label>
                            <!-- Manufacturing Plan -->
                        </div>

                        <div class="flex mb-1 py-1">
                            <label class="text-color block text-sm w-1/12 pr-2 pt-1"></label>
                            <!-- Serial No. Control -->
                            <input type="checkbox" id="ITEMSERIALLFLG" name="ITEMSERIALLFLG" value="T" style="width: 15px"
                            <?php echo (!empty($data['ITEMSERIALLFLG']) && $data['ITEMSERIALLFLG'] == 'T') ? 'checked' : '' ?>/>&emsp;
                            <label class="text-color block text-sm w-3/12 pr-2 pt-1 ml-2"><?php echo $data['TXTLANG']['SERIAL_CONTROL']; ?></label>
                            <!-- Serial No. Control -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex py-1">
                <div class="flex w-6/12">
                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                            id="insert" name="insert" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_INSERT'] != 'T') {?> hidden <?php }?>
                            <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'off') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['INSERT'];?>
                    </button>
                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                            id="update" name="update" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_UPDATE'] != 'T') {?> hidden <?php }?>
                            <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'on') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['UPDATE']; ?>
                    </button>
                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                            id="delete" name="delete" <?php if(!empty($data['SYSPVL']) && $data['SYSPVL']['SYSVIS_DELETE'] != 'T') {?> hidden <?php }?>
                            <?php if(!empty($data['isInsert']) && $data['isInsert'] == 'on') { ?> disabled <?php } ?>><?php echo $data['TXTLANG']['DELETE']; ?>
                    </button>
                </div>

                <div class="flex w-6/12 justify-end">
                    <button type="reset" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1" 
                            id="clear" name="clear" onclick="unsetSession(this.form);"><?php echo $data['TXTLANG']['CLEAR']; ?>
                    </button>
                    <button type="button" class="btn text-color border-2 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-1 text-center me-2 mb-1"
                            id="end" ><?php echo $data['TXTLANG']['END']; ?></button>
                </div>
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
<script type="text/javascript">
    $(document).ready(function() {
        unRequired();
        const ITEMIMGPREVIEW = document.getElementById('ITEMIMGPREVIEW');
        document.getElementById('ITEMIMGLOC').onchange = function() {
            var imgurl = URL.createObjectURL(this.files[0]);
            // ITEMIMGPREVIEW.style.background = 'url(' + imgurl + ')';
            ITEMIMGPREVIEW.src = imgurl;
            ITEMIMGPREVIEW.style.backgroundSize = 'cover';
        }
    });

    $("#end").on('click', function() {
        return Swal.fire({ 
            title: '',
            text: '<?=$lang['question1']; ?>',
            // background: '#8ca3a3',
            showCancelButton: true,
            // confirmButtonColor: 'silver',
            // cancelButtonColor: 'silver',
            confirmButtonText: '<?=$lang['yes']; ?>',
            cancelButtonText: '<?=$lang['nono']; ?>'
            }).then((result) => {
                if (result.isConfirmed) {
                    programDelete();
                    // window.location.href="/DMCS_WEBAPP";
            }
        });
    });

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
                if (result.isConfirmed) { //
            }
        });
    }
</script>
<script src="./js/script.js" ></script>
<!-- <script src="./js/script.js" integrity="sha384-A3vXOKIrkMcrKsobnbxRhUvBm4TBNCUoP7PyO022w/8qTRX5Bw2m65sn3gEGXTUw" crossorigin="anonymous"></script> -->
</html>
