<?php 
    require_once('./function/index_x.php');
?>
<!DOCTYPE html>
<html>
    
<head>
    <meta charset="UTF-8">
    <title><?=$appname; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--  CSS  -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="<?=$_SESSION['APPURL'] . '/css/menu.css'; ?>">
    <link rel="stylesheet" href="<?=$_SESSION['APPURL'] . '/css/loader.css'; ?>">
    <link rel="stylesheet" href="<?=$_SESSION['APPURL'] . '/css/bootstrap_523_min.css'; ?>">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="<?=$_SESSION['APPURL'] . '/css/sweetalert2.min.css'; ?>">
    <!-- -------------------------------------------------------------------------------- -->
    <!--  Script  -->
    <!-- -------------------------------------------------------------------------------- -->
    <script src="<?=$_SESSION['APPURL'] . '/js/loader.js'; ?>">  integrity="sha384-acDbhlvH9DufvmCPyS1tyL7yeN0gBK4eOA4kh7+XrtCoCSp9/1NtYoxVTq9MZRy0" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/axios.min.js'; ?>" integrity="sha384-gRiARcqivboba/DerDAENzwUEYP9HCDyPEqVzCulWl85IdmR6r0T1adY/Su0KTfi" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/jquery_363_min.js'; ?>" integrity="sha384-Ft/vb48LwsAEtgltj7o+6vtS2esTU9PCpDqcXs4OCVQFZu5BqprHtUCZ4kjK+bpE" crossorigin="anonymous"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/sweetalert2.min.js'; ?>" integrity="sha384-mngH0dsoMzHJ55nmFSRTjl5pdhgzHDeEoLOuZp2U28VrwCH0ieB9ntimtLbJm9KJ" crossorigin="anonymous"></script>
    <!--  Bootstrap  -->
    <script src="<?=$_SESSION['APPURL'] . '/js/bootstrap_bundle_523_min.js'; ?>" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>

<body>
      <!-- ---------------------------------------------------------------------------------->
    <!--  Menu -->
    <?php doMenu(); ?>
    <!-- ---------------------------------------------------------------------------------->
    <div class="container-fluid bg-primary" style="height: auto;">
        <div class="row justify-content-between">
            <div class="col-10">
                <p class="text-white" style="font-size: 1.2em; margin: 5px;"><?php echo $_SESSION['PACKNAME'] . ' > ' . $_SESSION['APPNAME']; ?></p>
            </div>
            <div class="col-2 text-end align-middle">
                <a href="<?php echo $_SESSION['APPURL'] . '/home.php'; ?>">
                    <!-- <button type="button" class="btn-close btn-close-white" aria-label="Close"></button> -->
                    <p class="text-white" style="font-size: 1.2em; margin: 5px;">[ <?php echo $lang['close']; ?> ]</p>
                </a>
            </div>
        </div>
    </div>



    <input type="hidden" id="sessionUrl" name="sessionUrl" value="<?=$_SESSION['APPURL']?>">
    <form class="form" method="POST" id="itemmasterinquiry" name="itemmasterinquiry" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
    <div class="col-md-12">
        
            <div class="flex">
            <div class="flex col-first">            
            <label class="label-width27"><?=$data['TXTLANG']['ITEMCD'];?></label>&emsp;
      <input class="form-control width17" type="text" id="ITEMCD1" name="ITEMCD1" value="<?=isset($data['ITEMCD1']) ? $data['ITEMCD1'] :''?>" />             
             <div class="fix-icon">
             <a href="#" id="searchitem"><img style="img-height20" src="../../../../img/search.png"></a>
             </div> &emsp;&emsp;
             <label class="label-width10">-</label>&emsp;
             <input class="form-control width17" type="text" id="ITEMCD2" name="ITEMCD2" value="<?=isset($data['ITEMCD2']) ? $data['ITEMCD2'] :''?>" />             
             <div class="fix-icon">
             <a href="#" id="searchitem2"><img style="img-height20" src="../../../../img/search.png"></a>
             </div>
            </div>
             
             
             <div class="flex col-second">
      <label class="label-width15"><?=$data['TXTLANG']['IM_TYPE'];?></label>&emsp;
      <select class="width20 option-text form-select form-select-sm" id="ITEMTYP" name="ITEMTYP" >
                        <option value=""></option>
                        <?php foreach ($itemtype as $key => $item) { ?>
                        <option value="<?php echo $key ?>" <?php echo (isset(
                         $data['ITEMTYP']) && $data['ITEMTYP'] == $key) ? 'selected' : '' ?>><?php echo $item ?></option>
                        <?php }                         
                        ?>
                    </select> &emsp;
             <label class="label-width10"><?=$data['TXTLANG']['BOI_TYPE'];?></label>
             <select class="width20 option-text form-select form-select-sm" id="ITEMBOI" name="ITEMBOI" >
                        <option value=""></option>
                        <?php foreach ($itemboitype as $key => $item) { ?>
                        <option value="<?php echo $key ?>" <?php echo (isset(
                         $data['ITEMBOI']) && $data['ITEMBOI'] == $key) ? 'ITEMBOI' : '' ?>><?php echo $item ?></option>
                        <?php }                         
                        ?>
                    </select>
      </div> 


              </div>
              
                    <!-- <div class="flex col-first">
                    <button type="button" class="btn btn-outline-secondary btn-action" id="search" name="search" onclick="searchs();" ><?=$lang['search']?></button>&emsp;&emsp;
                </div> -->
            </div>


       <div class="flex">
            <div class="flex col-first">            
            <label class="label-width27"><?=$data['TXTLANG']['ITEMNAME'];?></label>&emsp;
            <input class="form-control width43" type="text" id="ITEMNAME" name="ITEMNAME" value="<?=isset($data['ITEMNAME']) ? $data['ITEMNAME'] :''?>" /> 
            </div>
            <div class="flex col-second">
            <label class="label-width15"><?=$data['TXTLANG']['CATEGORY_CODE'];?></label>&emsp;
      <input class="form-control width15" type="text" id="CATALOGCD" name="CATALOGCD" value="<?=isset($data['CATALOGCD']) ? $data['CATALOGCD'] :''?>" />             
             <div class="fix-icon">
             <a href="#" id="searchcategory"><img style="img-height20" src="../../../../img/search.png"></a>
             </div> &emsp;
             <input class="form-control width30" type="text" id="CATALOGNAME" name="CATALOGNAME" value="<?=isset($data['CATALOGNAME']) ? $data['CATALOGNAME'] :''?>" readonly/> 

            </div>
      </div>

      <div class="flex">
            <div class="flex col-first">            
            <label class="label-width27"><?=$data['TXTLANG']['SEARCH_CHAR'];?></label>&emsp;
            <input class="form-control width43" type="text" id="ITEMSEARCH" name="ITEMSEARCH" value="<?=isset($data['ITEMSEARCH']) ? $data['ITEMSEARCH'] :''?>" /> 
            </div>
            <div class="flex col-second">
            <label class="label-width15"><?=$data['TXTLANG']['MEASURE_UNIT'];?></label>&emsp;
      <select class="width15 option-text form-select form-select-sm" id="ITEMUNIT" name="ITEMUNIT" >
                        <option value=""></option>
                        <?php foreach ($unit as $key => $item) { ?>
                        <option value="<?php echo $key ?>" <?php echo (isset(
                         $data['ITEMUNIT']) && $data['ITEMUNIT'] == $key) ? 'ITEMUNIT' : '' ?>><?php echo $item ?></option>
                        <?php }                         
                        ?>
                    </select> 

            </div>
      </div>


      <div class="flex">
            <div class="flex col-first">            
            <label class="label-width27"><?=$data['TXTLANG']['SUPPLIER_CODE'];?></label>&emsp;
            <input class="form-control width10" type="text" id="SUPPLIERCD" name="SUPPLIERCD" value="<?=isset($data['SUPPLIERCD']) ? $data['SUPPLIERCD'] :''?>" /> 
            <div class="fix-icon">
             <a href="#" id="searchsupplier"><img style="img-height20" src="../../../../img/search.png"></a>
             </div> &emsp;
             <input class="form-control width30" type="text" id="SUPPLIERNAME" name="SUPPLIERNAME" value="<?=isset($data['SUPPLIERNAME']) ? $data['SUPPLIERNAME'] :''?>" readonly /> 
            </div>
            <div class="flex col-second">
            </div>
      </div>

      <div class="flex">
            <div class="flex col-first">            
            <label class="label-width27"><?=$data['TXTLANG']['STRAGE_CODE'];?></label>&emsp;
            <input class="form-control width10" type="text" id="STORAGECD" name="STORAGECD" value="<?=isset($data['STORAGECD']) ? $data['STORAGECD'] :''?>" /> 
            <div class="fix-icon">
             <a href="#" id="searchlocation"><img style="img-height20" src="../../../../img/search.png"></a>
             </div> &emsp;
             <input class="form-control width30" type="text" id="STORAGENAME" name="STORAGENAME" value="<?=isset($data['STORAGENAME']) ? $data['STORAGENAME'] :''?>"readonly /> 
            </div>
            <div class="flex col-first"style="justify-content: right;"> 
                    <button type="button" class="btn btn-outline-secondary btn-action" id="search" name="search" onclick="searchs();" ><?=$lang['search']?></button>&emsp;&emsp;
                </div>
      </div>




            


        </div>

        <div class="flex space-between p-2">
            <div class="flex-column" style="width: 100%;">
                <div class="table" style="height: 600.0px;">
                    <table class="table-head table-striped" id="search_table">
                        <thead>
                            <tr class="table-secondary">
                           
                      
                            <th class="th-class" style="text-align: center; "><?=$data['TXTLANG']['ITEMCODE']; ?></th>
                            <th class="th-class" style="text-align: center; "><?=$data['TXTLANG']['ITEMNAME']?></th>
                            <th class="th-class" style="text-align: center; "><?=$data['TXTLANG']['SEARCH_CHAR']; ?></th>
                            <th class="th-class" style="text-align: center; "><?=$data['TXTLANG']['SPECIFICATE']?></th>
                            <th class="th-class" style="text-align: center; "><?=$data['TXTLANG']['IM_TYPE']; ?></th>
                            <th class="th-class" style="text-align: center; "><?=$data['TXTLANG']['IM_TYPE']?></th>
                            <th class="th-class" style="text-align: center; "><?=$data['TXTLANG']['BOI_TYPE']?></th>
                            <th class="th-class" style="text-align: center; "><?=$data['TXTLANG']['BOI_TYPE']; ?></th>
                            <th class="th-class" style="text-align: center; "><?=$data['TXTLANG']['CATEGORY_CODE']?></th>
                            <th class="th-class" style="text-align: center; "><?=$data['TXTLANG']['CATEGORY_NAME']; ?></th>
                            <th class="th-class" style="text-align: center; "><?=$data['TXTLANG']['WHTAXTYP']; ?></th>
                            <th class="th-class" style="text-align: center; "><?=$data['TXTLANG']['WHTAXTYP']; ?></th>
                            <th class="th-class" style="text-align: center; "><?=$data['TXTLANG']['MEASURE_UNIT']?></th>
                            <th class="th-class" style="text-align: center; "><?=$data['TXTLANG']['MEASURE_UNIT']; ?></th>
                            <th class="th-class" style="text-align: center; "><?=$data['TXTLANG']['POUNIT']?></th>
                            <th class="th-class" style="text-align: center; "><?=$data['TXTLANG']['POUNIT']?></th>
                            <th class="th-class" style="text-align: center; "><?=$data['TXTLANG']['PRDER_RULE']; ?></th>
                            <th class="th-class" style="text-align: center; "><?=$data['TXTLANG']['PRDER_RULE']?></th>
                            <th class="th-class" style="text-align: center; "><?=$data['TXTLANG']['SUPPLIER_CODE']; ?></th>
                            <th class="th-class" style="text-align: center; "><?=$data['TXTLANG']['SUPPLIER_NAME']?></th>
                            <th class="th-class" style="text-align: center; "><?=$data['TXTLANG']['STRAGE_CODE']; ?></th>
                            <th class="th-class" style="text-align: center; "><?=$data['TXTLANG']['STRAGE_NAME']?></th>
                            <th class="th-class" style="text-align: center; "><?=$data['TXTLANG']['LEADTIME']?></th>
                            <th class="th-class" style="text-align: center; "><?=$data['TXTLANG']['CURRENCY']; ?></th>
                            <th class="th-class" style="text-align: center; ">CURRENCYDISP</th>
                            <th class="th-class" style="text-align: center; "><?=$data['TXTLANG']['UNITPRICE_INV']; ?></th>
                            <th class="th-class" style="text-align: center; "><?=$data['TXTLANG']['SALES_PRICE']?></th>
                            <th class="th-class" style="text-align: center; "><?=$data['TXTLANG']['FIXED_ORDER']; ?></th>
                            <th class="th-class" style="text-align: center; "><?=$data['TXTLANG']['MIN_ORDER']?></th>
                            <th class="th-class" style="text-align: center; "><?=$data['TXTLANG']['BUFFER_STOCK']?></th>
                            <th class="th-class" style="text-align: center; "><?=$data['TXTLANG']['FIFO_LIST']; ?></th>
                            <th class="th-class" style="text-align: center; ">Inventory</th>
                            <th class="th-class" style="text-align: center; "><?=$data['TXTLANG']['INVCALCTYP']?></th>
                      </tr>
                  </thead>
                  <tbody>
                  <?php if(!empty($data['ITQ']))  {
                        foreach ($data['ITQ'] as $key => $value) {
                            if(is_array($value)) {
                              $minrow = count($data['ITQ']) ;
                             ?>
                           
                              <tr class="tr_border table-secondary">
                                  
                                  <td class="td-class"><?=isset($value['ITEMCD']) ? $value['ITEMCD']: '' ?></td>
                                  <td class="td-class"><?=isset($value['ITEMNAME']) ? $value['ITEMNAME']: '' ?></td>
                                  <td class="td-class"><?=isset($value['ITEMSEARCH']) ? $value['ITEMSEARCH']: '' ?></td>
                                  <td class="td-class"><?=isset($value['ITEMSPEC']) ? $value['ITEMSPEC']: '' ?></td>
                                  <td class="td-class"><?=isset($value['ITEMTYP']) ? $value['ITEMTYP']: '' ?></td>
                                  <td class="td-class"><?=isset($value['ITEMTYPENM']) ? $value['ITEMTYPENM']: '' ?></td>
                                  <td class="td-class"><?=isset($value['ITEMBOI']) ? $value['ITEMBOI']: '' ?></td>
                                  <td class="td-class"><?=isset($value['ITEMBOINM']) ? $value['ITEMBOINM']: '' ?></td>
                                  <td class="td-class"><?=isset($value['ITEMCATCD']) ? $value['ITEMCATCD']: '' ?></td>                               
                                  <td class="td-class"><?=isset($value['ITEMCATNM']) ? $value['ITEMCATNM']: '' ?></td>
                                  <td class="td-class"><?=isset($value['ITEMMAKERTYP']) ? $value['ITEMMAKERTYP']: '' ?></td>
                                  <td class="td-class"><?=isset($value['ITEMMAKERTYPNM']) ? $value['ITEMMAKERTYPNM']: '' ?></td>
                                  <td class="td-class"><?=isset($value['ITEMUNITTYPNM']) ? $value['ITEMUNITTYPNM']: '' ?></td>
                                  <td class="td-class"><?=isset($value['ITEMPOUNITTYP']) ? $value['ITEMPOUNITTYP']: '' ?></td>
                                  <td class="td-class"><?=isset($value['ITEMPOUNITTYPNM']) ? $value['ITEMPOUNITTYPNM']: '' ?></td>
                                  <td class="td-class"><?=isset($value['ITEMORDRULETYP']) ? $value['ITEMORDRULETYP']: '' ?></td>
                                  <td class="td-class"><?=isset($value['ITEMORDRULETYPNM']) ? $value['ITEMORDRULETYPNM']: '' ?></td>
                                  <td class="td-class"><?=isset($value['ITEMSUPCD']) ? $value['ITEMSUPCD']: '' ?></td>
                                  <td class="td-class"><?=isset($value['ITEMSUPNM']) ? $value['ITEMSUPNM']: '' ?></td>
                                  <td class="td-class"><?=isset($value['ITEMSTGCD']) ? $value['ITEMSTGCD']: '' ?></td>
                                  <td class="td-class"><?=isset($value['ITEMSTGNM']) ? $value['ITEMSTGNM']: '' ?></td>
                                  <td class="td-class"><?=isset($value['ITEMLEADTIME']) ? $value['ITEMLEADTIME']: '' ?></td>
                                  <td class="td-class"><?=isset($value['CURRENCYCD']) ? $value['CURRENCYCD']: '' ?></td>
                                  <td class="td-class"><?=isset($value['CURRENCYDISP']) ? $value['CURRENCYDISP']: '' ?></td>
                                  <td class="td-class"><?=isset($value['ITEMINVPRICE']) ? $value['ITEMINVPRICE']: '' ?></td>
                                  <td class="td-class"><?=isset($value['ITEMSTDPURPRICE']) ? $value['ITEMSTDPURPRICE']: '' ?></td>
                                  <td class="td-class"><?=isset($value['ITEMSHOPPRICE']) ? $value['ITEMSHOPPRICE']: '' ?></td>
                                  <td class="td-class"><?=isset($value['ITEMFIXORDER']) ? $value['ITEMFIXORDER']: '' ?></td>
                                  <td class="td-class"><?=isset($value['ITEMMINORDER']) ? $value['ITEMMINORDER']: '' ?></td>
                                  <td class="td-class"><?=isset($value['ITEMMINSTOCK']) ? $value['ITEMMINSTOCK']: '' ?></td>
                                  <td class="td-class"><?=isset($value['ITEMFIFOLISTFLG']) ? $value['ITEMFIFOLISTFLG']: '' ?></td>
                                  <td class="td-class"><?=isset($value['ITEMINVCALCTYP']) ? $value['ITEMINVCALCTYP']: '' ?></td>
                                  <td class="td-class"><?=isset($value['ITEMINVCALCTYPNM']) ? $value['ITEMINVCALCTYPNM']: '' ?></td>
                              </tr> <?php 
                             
                                 
                                  
                                }
                            }  
                            for ($i = $minrow; $i <= $maxrow; $i++) { ?>
                                  <tr class="tr_border table-secondary">
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                     
                                  </tr><?php 
                            }
                    } else {
                          for ($i = $minrow; $i <= $maxrow; $i++) { ?>
                                     <tr class="tr_border table-secondary">
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                                      <td class="td-class"></td>
                              </tr><?php
                          }
                    } ?>
                  </tbody>
                 
              </table>
              
            </div>
            <div>
            <tfoot>
                            <tr class="tr_border" style="background-color: white;">
                                <td class="td-class" colspan="3"><?=str_repeat('&emsp;', 2).$data['TXTLANG']['ROWCOUNT'].str_repeat('&ensp;', 2); ?><label id="record2"><?=$minrow; ?></label></td>  
                            </tr>
                        </tfoot>
                        </div>
            <div class="d-flex p-2">
            <div class="flex">                
                <div class="flex col-first">
              <button type="button" class="btn btn-outline-secondary btn-action" id="csv" name="csv"onclick="exportCSV();">CSV</button>&emsp;&emsp;
            </div>
                </div>
                <div class="flex .col45" style="justify-content: right;">
                   
                    <button type="button" class="btn btn-outline-secondary btn-action" id="clear" name="clear" onclick="unsetSession();"><?=$data['TXTLANG']['CLEAR']?></button>&emsp;&emsp;
                    <button type="button" class="btn btn-outline-secondary btn-action" id="end" name="end"
                      onclick="questionDialog(1, '<?=$lang['question1']?>', '<?=$lang['yes']; ?>', '<?=$lang['nono']; ?>');"
                    ><?=$data['TXTLANG']['END']?></button>
                </div>
            </div>
        </div>
        <!-- <div class="font-size14"><?=$data['TXTLANG']['ROWCOUNT']; ?>  <?=$minrow ?></div> -->
      

    
        
       



    
        

        <br>

                </div>
    </form>
    <!---------------------------------------------------------------------------------- -->
    <div id="loading" class="on" style="display: none;">
      <div class="cv-spinner"><div class="spinner"></div></div>
    </div>
</body>
<script src="./js/script.js" ></script>
<!-- <script src="./js/script.js" integrity="sha384-54fxMsmCN6QRpByKh/g3Dxazgtnlz5oCJOM41ha17HW5WLZT6hWG1xPWLE7S0YLb" crossorigin="anonymous"></script> -->
<script type="text/javascript">
  function validationDialog() {
      return Swal.fire({ 
          title: '',
          text: '<?=$lang['validation1']; ?>',
          background: '#8ca3a3',
          showCancelButton: false,
          confirmButtonColor: 'silver',
          cancelButtonColor: 'silver',
          confirmButtonText:  '<?=$lang['yes']; ?>',
          cancelButtonText: '<?=$lang['nono']; ?>'
          }).then((result) => {
          if (result.isConfirmed) {
              if(type == 1) {
                  window.location.href="/DMCS_WEBAPP";          
              }
          }
      });
  }
</script>
</html>
