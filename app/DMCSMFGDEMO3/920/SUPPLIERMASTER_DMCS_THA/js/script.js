

// guide
const SEARCHCITY = $('#SEARCHCITY');
const SEARCHSTATE = $('#SEARCHSTATE');
const SEARCHCOUNTRY = $('#SEARCHCOUNTRY');
const SEARCHCURRENCY = $('#SEARCHCURRENCY');
const SEARCHSUPPLIER1 = $('#SEARCHSUPPLIER1');
const SEARCHSUPPLIER2 = $('#SEARCHSUPPLIER2');

SEARCHCURRENCY.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCURRENCY/index.php?page=SUPPLIERMASTER_DMCS_THA', 'authWindow', 'width=1200,height=600');});
SEARCHCOUNTRY.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCOUNTRY/index.php?page=SUPPLIERMASTER_DMCS_THA', 'authWindow', 'width=1200,height=600');});
SEARCHSUPPLIER1.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSUPPLIER/index.php?page=SUPPLIERMASTER_DMCS_THA&index=1', 'authWindow', 'width=1200,height=600');});
SEARCHSUPPLIER2.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSUPPLIER/index.php?page=SUPPLIERMASTER_DMCS_THA&index=2', 'authWindow', 'width=1200,height=600');});
SEARCHSTATE.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTATE/index.php?page=SUPPLIERMASTER_DMCS_THA&COUNTRYCD=' + $('#COUNTRYCD').val(), 'authWindow', 'width=1200,height=600');});
SEARCHCITY.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCITY/index.php?page=SUPPLIERMASTER_DMCS_THA&COUNTRYCD=' + $('#COUNTRYCD').val() + '&STATECD=' + $('#STATECD').val(), 'authWindow', 'width=1200,height=600');});

const serach_icon = [ SEARCHSUPPLIER1, SEARCHSUPPLIER2, SEARCHCOUNTRY, SEARCHSTATE, SEARCHCITY, SEARCHCURRENCY ];

//form
const form = document.getElementById('suppliermaster');

// button
const INS = $('#INSERT');
const UPD= $('#UPDATE');
const DEL = $('#DELETE');


// onchange + req
const CITYCD = $('#CITYCD');
const STATECD = $('#STATECD');
const SUPBILLCD = $('#SUPBILLCD');
const COUNTRYCD = $('#COUNTRYCD');
const CURRENCYCD = $('#CURRENCYCD');
const SUPPLIERCD = $('#SUPPLIERCD');
const FACTORYCODE = $('#FACTORYCODE');
const SUPPLIERTEL = $('#SUPPLIERTEL');
const SUPPLIERNAME = $('#SUPPLIERNAME');
const SUPPLIERADDR1 = $('#SUPPLIERADDR1');
const SUPPLIERADDR2 = $('#SUPPLIERADDR2');
const SUPPLIERADD01 = $('#SUPPLIERADD01');
const SUPPLIERSEARCH = $('#SUPPLIERSEARCH');
const SUPPLIERZIPCODE = $('#SUPPLIERZIPCODE');
const SUPPLIERSHORTNAME = $('#SUPPLIERSHORTNAME');
const SUPPLIERAMTROUNDTYP = $('#SUPPLIERAMTROUNDTYP');
const SUPPLIERTAXROUNDTYP = $('#SUPPLIERTAXROUNDTYP');
const SUPPLIERUNITROUNDTYP = $('#SUPPLIERUNITROUNDTYP');

for(const icon of serach_icon) {
    icon.click(function () {
        keepData();
    });
};

INS.click(function() {
    // check validate form
    if (!form.reportValidity()) {
        alertValidation();
        return false;
    }
    return action('INSERT');
});

UPD.click(function() {
    // check validate form
    if (!form.reportValidity()) {
        alertValidation();
        return false;
    }
    return action('UPDATE');
});

DEL.click(function() {
    // check validate SUPPLIERCD
    if(SUPPLIERCD.val() == '') {
        return false;
    }
    return action('DELETE');
});

SUPPLIERCD.on('keyup change', function(e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getSearch('SUPPLIERCD', SUPPLIERCD.val());
    }
    // if(SUPPLIERCD.val() == '') unsetSession(form);
});

SUPPLIERSHORTNAME.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('SUPPLIERSHORTNAME', SUPPLIERSHORTNAME.val());
    }
});

SUPPLIERADD01.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('SUPPLIERADD01', SUPPLIERADD01.val());
    }
});

FACTORYCODE.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('FACTORYCODE', FACTORYCODE.val());
    }
});

COUNTRYCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('COUNTRYCD', COUNTRYCD.val());
    }
});

STATECD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('STATECD', STATECD.val());
    }
});

CITYCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('CITYCD', CITYCD.val());
    }
});

SUPPLIERZIPCODE.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('SUPPLIERZIPCODE', SUPPLIERZIPCODE.val());
    }
});

SUPPLIERADDR1.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('SUPPLIERADDR1', SUPPLIERADDR1.val());
    }
});

SUPPLIERADDR2.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('SUPPLIERADDR2', SUPPLIERADDR2.val());
    }
});

SUPBILLCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('SUPBILLCD', SUPBILLCD.val());
    }
});

CURRENCYCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('CURRENCYCD', CURRENCYCD.val());
    }
});

async function getSearch(code, value) {
    $('#loading').show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/920/SUPPLIERMASTER_DMCS_THA/index.php?'+code+'=' + value;
}

async function getElement(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../SUPPLIERMASTER_DMCS_THA/function/index_x.php', data)
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
        unRequired();
        document.activeElement.blur();
        document.getElementById('loading').style.display = 'none';
    })
    .catch(e => {
        // console.log(e);
        document.getElementById('loading').style.display = 'none';
    });
}

async function action(method) {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', method);
    await axios.post('../SUPPLIERMASTER_DMCS_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        $('#loading').hide();
        if(response.status == 200) {
            return clearForm(form);
        }
    })
    .catch(e => {
        $('#loading').hide();
        // console.log(e);
    });
}

async function keepData() {
    const data = new FormData(form);
    data.append('action', 'keepdata');
    await axios.post('../SUPPLIERMASTER_DMCS_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
    })
    .catch(e => {
        document.getElementById('loading').style.display = 'none';
    });
}

async function unsetSession() {
    let data = new FormData();
    data.append('action', 'unsetsession');
    data.append('systemName', 'SUPPLIERMASTER_DMCS_THA');

    await axios.post('../SUPPLIERMASTER_DMCS_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        clearForm(form);
    })
    .catch(e => {
        document.getElementById('loading').style.display = 'none';
    });
}

async function clearForm(form) {
    // clearing inputs
    var inputs = form.getElementsByTagName('input');
    for (var i = 0; i < inputs.length; i++) {
        switch (inputs[i].type) {
            case 'hidden':
                inputs[i].value = '';
                break;
            case 'text':
                inputs[i].value = '';
                break;
            case 'radio':
            case 'checkbox':
                inputs[i].checked = false;
                break;
        }
    }
    // clearing selects
    var selects = form.getElementsByTagName('select');
    for (var i = 0; i < selects.length; i++) {
        selects[i].selectedIndex = 0;
    }

    // clearing textarea
    var text= form.getElementsByTagName('textarea');
    for (var i = 0; i < text.length; i++) {
        text[i].innerHTML= '';
    }

	// refresh
	window.location.href = '../SUPPLIERMASTER_DMCS_THA/';

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

function unRequired() {
    document.getElementById('CITYCD').classList[document.getElementById('CITYCD').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('STATECD').classList[document.getElementById('STATECD').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('COUNTRYCD').classList[document.getElementById('COUNTRYCD').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('SUPPLIERCD').classList[document.getElementById('SUPPLIERCD').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('CURRENCYCD').classList[document.getElementById('CURRENCYCD').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('FACTORYCODE').classList[document.getElementById('FACTORYCODE').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('SUPPLIERTEL').classList[document.getElementById('SUPPLIERTEL').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('SUPPLIERNAME').classList[document.getElementById('SUPPLIERNAME').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('SUPPLIERADD01').classList[document.getElementById('SUPPLIERADD01').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('SUPPLIERADDR1').classList[document.getElementById('SUPPLIERADDR1').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('SUPPLIERSEARCH').classList[document.getElementById('SUPPLIERSEARCH').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('SUPPLIERSHORTNAME').classList[document.getElementById('SUPPLIERSHORTNAME').value !== '' ? 'remove' : 'add']('req');
    document.getElementById('SUPPLIERUNITROUNDTYP').classList[document.getElementById('SUPPLIERUNITROUNDTYP').selectedIndex != 0 ? 'remove' : 'add']('req');
    document.getElementById('SUPPLIERAMTROUNDTYP').classList[document.getElementById('SUPPLIERAMTROUNDTYP').selectedIndex != 0 ? 'remove' : 'add']('req');
    document.getElementById('SUPPLIERTAXROUNDTYP').classList[document.getElementById('SUPPLIERTAXROUNDTYP').selectedIndex != 0 ? 'remove' : 'add']('req');
}