// Parameter
var WCCD;
var isItem = false;
var page = $('#page').val();
var index = $('#index').val();
$('table#table_result tr').click(function () {
    $('table#table_result tr').removeAttr('id')

    $(this).attr('id', 'click-row');
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined') {
        isItem = true;
        WCCD = item.eq(1).text();

        $('#WC_CODE').html(item.eq(1).text());
        $('#WORK_CENTER_NAME').html(item.eq(2).text());
    }
    
    $("#select_item").on('click', function() {
        $('#loading').show();
        if(page == 'cancelinv') {
            return window.location.href=$('#pageUrl').val() + '?divisioncd=' + item.eq(1).text();
        // } else if(page == 'SEARCHWORKCENTER') {
        //     window.location.href=$('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHWORKCENTER/index.php?DIVISIONCD='+ item.eq(1).text();
        } else {
            return HandleResult(WCCD);
        }
    });
});

$('#view_item').on('click', function() {
    if(isItem) {
       $('#item_view').modal('show');
    }
});    

$('#back').on('click', function() {
    if(page == 'cancelinv') {
        return window.location.href=$('#pageUrl').val();   
    // } else if(page == 'SEARCHWORKCENTER') {
    //     return window.location.href=$('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHPURCHASEORDER/index.php';
    } else {
        return window.close();
    }
});

function HandleResult(result) {
    try {
        if(page == 'PRODUCTIONORDERENTRY' || page == 'PRODUCTIONORDERENTRY_MFG') { 
            window.opener.HandlePopupResult('WCCD', result);
        } else if(page == 'JOBRESULTVW') {
            window.opener.HandlePopupResult('I_WCCD', result);
        } else if(page == 'ITEMMASTER_MFG') {
            window.opener.HandlePopupResult('divisioncd', result);
        } else {
            window.opener.HandlePopupResultIndex('DIVISIONCD', result, index);
        }
    } catch (err) {
        // console.log(err);
    }
    $('#loading').hide();
    window.close(); // CloseMySelf
    return false;
}

async function clearForm(form) {
    // clearing inputs
    var inputs = form.getElementsByTagName('input');
    for (var i = 0; i<inputs.length; i++) {
        switch (inputs[i].type) {
            // case 'hidden':
            case 'text':
                inputs[i].value = '';
                break;
            case 'radio':
            case 'checkbox':
                inputs[i].checked = false; 
        }
    }
    // clearing selects
    var selects = form.getElementsByTagName('select');
    for (var i = 0; i<selects.length; i++)
        selects[i].selectedIndex = 0;

    // clearing textarea
    var text= form.getElementsByTagName('textarea');
    for (var i = 0; i < text.length; i++)
        text[i].innerHTML= '';

    // clearing table empty Row
    $('#table_result > tbody > tr').remove();
    for (var i = 0; i < 10; i++) {
        $('#table_result tbody').append('<tr class="row-empty" id="rowId' + i +'">' +
                                            '<td class="h-6 border border-slate-700"></td>' +
                                            '<td class="h-6 border border-slate-700"></td></tr>'
        );
    }

    document.getElementById('rowcount').innerHTML = '0';
    return false;
}