// icon search
const SEARCHLOC = $('#SEARCHLOC');

SEARCHLOC.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHLOC/index.php?page=ITEMONHANDBYLOCATIONVIEW&LOCTYP=' + $('#LOCTYP').val(), 'authWindow', 'width=1200,height=600');});

//input serach
const LOCCD = $('#LOCCD'); 
const LOCTYP = $('#LOCTYP'); 

// action button
const SEARCH = $('#SEARCH');
const CSV = $('#CSV');

// form
const form = document.getElementById('locationInventoryInquiry');

const serach_icon = [SEARCHLOC];

for(const icon of serach_icon) {
    icon.click(async function () {
        await keepData();
    });
};

SEARCH.click(async function() {
    // check validate form
    if (!form.reportValidity()) {
        validationDialog();
        return false;
    }
    await keepData();
    $('#loading').show();
    const action = document.createElement('input');
    action.id = 'action'; action.name = 'action';
    action.type = 'hidden'; action.value = 'SEARCH';
    form.appendChild(action);
    form.submit();
});

CSV.click(function() {
    return exportCSV();
});

LOCCD.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('LOCCD', LOCCD.val());
    }
});

LOCTYP.change(function() {
    return getElement('LOCTYP', LOCTYP.val());
});

async function getElement(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../ITEMONHANDBYLOCATIONVIEW/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(objectArray(result)) {
            $.each(result, function(key, value) {
                // console.log(key, '=>', value);
                if(document.getElementById(''+key+'')) {
                    document.getElementById(''+key+'').value = value;
                } 
            });
        }
        document.activeElement.blur();
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function exportCSV() {
    // Variable to store the final csv data
    let IM_TYPE_TXT = (document.getElementById('IM_TYPE_TXT').innerText || document.getElementById('IM_TYPE_TXT').textContent);
    let STORAGETYPE_TXT = (document.getElementById('STORAGETYPE_TXT').innerText || document.getElementById('STORAGETYPE_TXT').textContent);
    let STORAGE_CODE_TXT = (document.getElementById('STORAGE_CODE_TXT').innerText || document.getElementById('STORAGE_CODE_TXT').textContent);
    let LOCTYP = document.getElementById('LOCTYP');
    let LOCTYPNAME = LOCTYP.options[LOCTYP.selectedIndex].text;
    let ITEMTYPE = document.getElementById('ITEMTYPE');
    let ITEMTYPENAME = ITEMTYPE.options[ITEMTYPE.selectedIndex].text;

    var csv_data = [IM_TYPE_TXT + ',' + ITEMTYPENAME];
    csv_data.push(STORAGETYPE_TXT + ',' + LOCTYPNAME);
    csv_data.push(STORAGE_CODE_TXT + ',' + $('#LOCCD').val() + ',' + $('#LOCNAME').val());
    // Get each row data
    var rows = document.getElementsByClassName('csv');
    for (var i = 0; i < rows.length; i++) {
        // Get each column data
        var cols = rows[i].querySelectorAll('td, th');
        // Stores each csv row datad
        var csvrow = [];
        for (var x = 1; x < cols.length; x++) {
            csvrow.push("\""+cols[x].innerText+"\"");
        }
        csv_data.push(csvrow.join(','));
    }
    // Combine each row data with new line character
    csv_data = csv_data.join('\n');
    // Call this function to download csv file
    // console.log(csv_data);
    await handleSaveAsCSV(csv_data);
}

async function keepData() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../ITEMONHANDBYLOCATIONVIEW/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        $('#loading').hide();        
    })
    .catch(e => {
        $('#loading').hide();
    });
}

async function unsetSession() {
    let data = new FormData();
    data.append('action', 'unsetsession');
    await axios.post('../ITEMONHANDBYLOCATIONVIEW/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        clearForm(form);
    })
    .catch(e => {
        // console.log(e);
    });
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

	window.location.href = '../ITEMONHANDBYLOCATIONVIEW/';

    return false;
}

function questionDialog(type, txt, btnyes, btnno) {
    return Swal.fire({ 
        title: '',
        text: txt,
        showCancelButton: true,
        confirmButtonText: btnyes,
        cancelButtonText: btnno
        }).then((result) => {
        if (result.isConfirmed) {
            if(type == 1) {
                return closeApp($('#appcode').val());    
            }
        }
    });
}

function emptyRows(maxrow) {
    let rowcount =  $('.row-id').length || 0;
    const dvwdetail = document.getElementById('dvwdetail');
    $('#table tbody tr.row-empty').remove(); // $('.row-empty').remove();
    for (var x = rowcount; x < maxrow; x++) {
        var row = document.createElement('tr'); let index = x+1;
        row.setAttribute('id', 'rowId'+index+'');
        row.setAttribute('class', 'divide-y divide-gray-200 row-empty');
        for (var z = 1; z <= 15; z++) {
            var col = document.createElement('td');
            col.setAttribute('class', 'h-6 border border-slate-700');
            row.appendChild(col);
        }
        dvwdetail.appendChild(row);
    }
}

function unRequired() {
    document.getElementById('LOCTYP').classList[document.getElementById('LOCTYP').selectedIndex != 0 ? 'remove' : 'add']('req');
}