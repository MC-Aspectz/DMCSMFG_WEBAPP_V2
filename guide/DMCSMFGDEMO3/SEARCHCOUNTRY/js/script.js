// Action Button CSV
const CSV = $('#CSV');

CSV.click(function() {
    return exportCSV();
});


const P2 = $('#P2');

var page = $('#page').val();
var pageUrl = $('#pageUrl').val();

var isItem = false;
var COUNTRYCD;
$('table#table_result tr').click(function () {
    $('table#table_result tr').removeAttr('id')

    $(this).attr('id', 'click-row');
   
    let item = $(this).closest('tr').children('td');

    if(item.eq(0).text() != 'undefined') {
        isItem = true;
        COUNTRYCD = item.eq(1).text();
        $('#countrycd').html(item.eq(1).text());
        $('#countryname').html(item.eq(2).text());
    }

    $('#select_item').on('click', function() {
        $('#loading').show();
        return HandleResult(COUNTRYCD);
    });
});

$('#view_item').on('click', function() {
    if(isItem) {
       $('#item_view').modal('show');
    }
});    

$('#back').on('click', function() {
    // window.history.back();
    return window.close();
});

function HandleResult(result) {
    try {
        window.opener.HandlePopupResult('COUNTRYCD', result);
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
                                            '<td class="h-6 border border-slate-700"></td>' +
                                            '<td class="h-6 border border-slate-700"></td></tr>'
        );
    }

    document.getElementById('rowcount').innerHTML = '0';

    return false;
}

async function exportCSV() {
    // Variable to store the final csv data P1
    // var csv_data = [  'Staff Code,' + P1.val() + ',\n' ];
    var csv_data = [  'Country Name,' + P2.val() ];

    // Get each row data
    // var rows = document.getElementsByTagName('tr');
    var rows = document.getElementsByClassName('csv-row');
    console.log(rows.length);
    for (var i = 0; i < rows.length; i++) {
        // Get each column data
        // var cols = rows[i].querySelectorAll('td:not(.export-exclude), th');
        // var cols = rows[i].querySelectorAll('td, th');
        var cols = rows[i].getElementsByClassName('csv-col');
        var csvrow = [];
        [...cols].forEach((el) => {
            // console.log(el.innerText);
            // csvrow.push("\""+el.innerText+"\"");
            csvrow.push(el.innerText);
        });
        // console.log(csvrow);
        // Combine each column value with comma
        // csv_data.push(csvrow.join(","));
        csv_data.push(arrayToCSV(csvrow));
    }
    // Combine each row data with new line character
    csv_data = csv_data.join('\n');
    // Call this function to download csv file 
    await handleSaveAsCSV(csv_data);
    // console.log(csv_data);
}

function arrayToCSV(row) {
    for (let i in row) {
        row[i] = row[i].replace(/"/g, '""');
    }
    return '"' + row.join('","') + '"';
}