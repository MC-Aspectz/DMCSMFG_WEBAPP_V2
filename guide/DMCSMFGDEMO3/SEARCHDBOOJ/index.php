<?php
    require_once('./function/index_x.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?=$_SESSION['APPURL'] . '/css/menu.css'; ?>">
    <link rel="stylesheet" href="<?=$_SESSION['APPURL'] . '/css/bootstrap_523_min.css'; ?>">
    <link rel="stylesheet" href="./css/style.css">

    <script src="<?=$_SESSION['APPURL'] . '/js/jquery_363_min.js'; ?>"></script>
    <script src="<?=$_SESSION['APPURL'] . '/js/bootstrap_bundle_523_min.js'; ?>"></script>
    
    <title><?=$_SESSION['APPNAME'].' - '.$lang['searchdbooj']; ?></title>
</head>
<body>
<!-- ---------------------------------------------------------------------------------->
<!--  Menu  -->
<?php doMenu(); ?>
<!-- ---------------------------------------------------------------------------------->
<input type="hidden" id="routeUrl" name="routeUrl" value="<?=$routeUrl?>">
<form class="form" style="width: 80%;" method="POST" id="tableindex" name="tableindex" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">
    <div class="col-md-12">
    
        <div class="flex">
            <div class="flex col-first">
                <label class="label-width20"><?php echo $lang['DB_OBJECT']; ?></label>
                <input class="width70 form-control" type="text" id="P1" name="P1" value="<?php echo $P1 ?>"/>
            </div>
            <div class="flex col-second" style="justify-content: right; margin-right: 1%;">
                 <button type="submit" id="search" name="search" class="btn btn-outline-secondary btn-action"><?php echo $lang['search']; ?></button>
            </div>
        </div>
        <br>
        <div class="flex">
            <div class="table height400"> 
                <table class="table-head" rules="cols" id="table_result" cellpadding="3" cellspacing="1" >
                    <thead>
                        <tr class="th-class table-secondary">
                            <th style="text-align: center;"><?php echo $lang['DB_NAME']; ?></th>
                            <th style="text-align: center;"><?php echo $lang['REMARK']; ?></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($tdata)) {
                        foreach ($tdata as $item) { 
                            if(is_array($item)) {
                              $minrow = count($tdata) + 1;
                             ?>

                        <tr class="table-warning">
                            <td class="td-class"><?php echo $item["GUIDEPREOBJ"] ?></td>
                            <td class="td-class"><?php echo $item["GUIDEPREDEF"] ?></td>
                            
                        </tr>
                        </tr>
                    <?php }
                        }
                            for ($i = count($tdata)+1; $i <= 10; $i++) { ?>
                                <tr class="table-warning">
                                    <td class="td-class"></td>
                                    <td class="td-class"></td>
                                   
                                </tr><?php 
                            }
                        } else {
                            for ($i = 0; $i < 10; $i++) { ?>
                        <tr class="table-warning">
                            <td class="td-class"></td>
                            <td class="td-class"></td>
                            
                        </tr><?php }
                    } ?> 
                  </tbody>
                </table>
            </div>
        </div>
        <div class="font-size14"><?php echo $lang['rowcount']; ?>  <?php echo !empty($tdata) ? count($tdata) : 0 ?></div>
        <div class="flex footer">
            <div class="flex col-first">
                <button type="button" id="select_item" name="search" class="btn btn-outline-secondary btn-action"><?php echo $lang['select']; ?></button>&emsp;&emsp;
                <button type="button" id="view_item" class="btn btn-outline-secondary btn-action"><?php echo $lang['view']; ?></button>
            </div>
            <div class="flex col-second" style="justify-content: right;">
                <button type="reset" onclick="return clearForm(this.form);" class="btn btn-outline-secondary btn-action"><?php echo $lang['clear']; ?></button>&emsp;&emsp;
                <button type="button" id="back" class="btn btn-outline-secondary btn-action"><?php echo $lang['back']; ?></button>
            </div>
        </div>
    </div>
</form>

<div class="modal fade" id="item_view" tabindex="-1" role="dialog" aria-labelledby="item_viewModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <label class="font-size16"><?php echo $lang['detail']; ?></label>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           <table class="table-head" id="tabel_modal" rules="cols" cellpadding="3" cellspacing="1" >
                <thead>
                    <tr class="th-class">
                        <th style="text-align: left; padding-left: 2%;"><?php echo $lang['title']; ?></th>
                        <th style="text-align: center;"><?php echo $lang['value']; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>

                    
                        <td class="td-class" style="background-color:#ffe6cc;"><?php echo $lang["DB_NAME"] ?></td>
                        <td class="td-class" id="GUIDEPREOBJ" style="background-color:#ffe6cc;"></td>
                    </tr>
                    <tr>
                        <td class="td-class"><?php echo $lang["REMARK"] ?></td>
                        <td class="td-class" id="GUIDEPREDEF"></td>
                    </tr>
                    
                </tbody>
            </table>
            <br>
            <div class="font-size14"><?php echo $lang['rowcount']; ?> 2</div>
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-action" data-bs-dismiss="modal"><?php echo $lang['end']; ?></button>
        </div>
    </div>
  </div>
</div>
</body>
<script src="./js/script.js"></script>
</html>