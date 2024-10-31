//form
const form = document.getElementById('suppliermaster');

// button
const insert = $("#INSERT");
const update = $("#UPDATE");
const del = $("#DELETE");
const CLOSEPAGE = $("#CLOSEPAGE");

// guide
const SEARCHSUPPLIER1 = $("#SEARCHSUPPLIER1");
const SEARCHSUPPLIER2 = $("#SEARCHSUPPLIER2");
const SEARCHCOUNTRY = $("#SEARCHCOUNTRY");
const SEARCHSTATE = $("#SEARCHSTATE");
const SEARCHCITY = $("#SEARCHCITY");
const SEARCHCURRENCY = $("#SEARCHCURRENCY");

SEARCHSUPPLIER1.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSUPPLIER/index.php?page=SUPPLIERMASTER_DMCS_THA&index=1', 'authWindow', 'width=1200,height=600');});
SEARCHSUPPLIER2.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSUPPLIER/index.php?page=SUPPLIERMASTER_DMCS_THA&index=2', 'authWindow', 'width=1200,height=600');});
SEARCHCOUNTRY.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCOUNTRY/index.php?page=SUPPLIERMASTER_DMCS_THA', 'authWindow', 'width=1200,height=600');});
SEARCHSTATE.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTATE/index.php?page=SUPPLIERMASTER_DMCS_THA&COUNTRYCD=' + $("#COUNTRYCD").val(), 'authWindow', 'width=1200,height=600');});
SEARCHCITY.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCITY/index.php?page=SUPPLIERMASTER_DMCS_THA&COUNTRYCD=' + $("#COUNTRYCD").val() + '&STATECD=' + $("#STATECD").val(), 'authWindow', 'width=1200,height=600');});
SEARCHCURRENCY.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCURRENCY/index.php?page=SUPPLIERMASTER_DMCS_THA', 'authWindow', 'width=1200,height=600');});

const search_icon = [ SEARCHSUPPLIER1, SEARCHSUPPLIER2, SEARCHCOUNTRY, SEARCHSTATE, SEARCHCITY, SEARCHCURRENCY ]

for (const icon of search_icon) {
    icon.click(function () {
      keepData();
    });
  }

// onchange + req
const SUPPLIERCD = $("#SUPPLIERCD");
const SUPPLIERSHORTNAME = $("#SUPPLIERSHORTNAME");
const SUPPLIERADD01 = $("#SUPPLIERADD01");
const COUNTRYCD = $("#COUNTRYCD");
const STATECD = $("#STATECD");
const CITYCD = $("#CITYCD");
const SUPPLIERZIPCODE = $("#SUPPLIERZIPCODE");
const SUPPLIERADDR1 = $("#SUPPLIERADDR1");
const SUPPLIERADDR2 = $("#SUPPLIERADDR2");
const SUPBILLCD = $("#SUPBILLCD");
const CURRENCYCD = $("#CURRENCYCD");
const CHECKCLEAR = $("#CHECKCLEAR");

//req SUPPLIERCD SUPPLIERNAME SUPPLIERSEARCH SUPPLIERSHORTNAME  FACTORYCODE SUPPLIERADD01
//COUNTRYCD STATECD CITYCD SUPPLIERADDR1 SUPPLIERTEL 
//SUPPLIERUNITROUNDTYP SUPPLIERAMTROUNDTYP  SUPPLIERTAXROUNDTYP CURRENCYCD
const SUPPLIERNAME = $("#SUPPLIERNAME");
const SUPPLIERSEARCH = $("#SUPPLIERSEARCH");
const FACTORYCODE = $("#FACTORYCODE");
const SUPPLIERTEL = $("#SUPPLIERTEL");
const SUPPLIERUNITROUNDTYP = $("#SUPPLIERUNITROUNDTYP");
const SUPPLIERAMTROUNDTYP = $("#SUPPLIERAMTROUNDTYP");
const SUPPLIERTAXROUNDTYP = $("#SUPPLIERTAXROUNDTYP");

const input_search = [SUPPLIERCD, SUPPLIERSHORTNAME, SUPPLIERADD01, COUNTRYCD, STATECD, CITYCD, SUPPLIERZIPCODE, SUPPLIERADDR1, SUPPLIERADDR2, SUPBILLCD, CURRENCYCD];

for(const input of input_search){
    input.change(function () {
    	$("#loading").show();
    });

    input.keyup(function (e) {
        if (e.key === 'Enter' || e.keyCode === 13) {
            $("#loading").show();
        }
    });
};

SUPPLIERCD.on('keyup change', function (e) {
    if (e.type === 'change' || e.key === 'Enter' || e.keyCode === 13) {
        if (SUPPLIERCD.val() == '') {
            unsetSession(form);
        }else{
            return getSearch('SUPPLIERCD', SUPPLIERCD.val());
        }
    } 
});

SUPPLIERSHORTNAME.on('keyup change', function (e) {
    if (e.type === 'change') {
      return getSearch('SUPPLIERSHORTNAME', SUPPLIERSHORTNAME.val());
    } else if (e.key === 'Enter' || e.keyCode === 13) {
      return getSearch('SUPPLIERSHORTNAME', SUPPLIERSHORTNAME.val());
    }
    // if (SUPPLIERSHORTNAME.val() == '') unsetSession(form);
});

SUPPLIERADD01.on('keyup change', function (e) {
    if (e.type === 'change') {
      return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/920/SUPPLIERMASTER_DMCS_THA/index.php?FACTORYCODE=' + FACTORYCODE.val()+'&SUPPLIERADD01='+SUPPLIERADD01.val();
    //   return getSearch('SUPPLIERADD01', SUPPLIERADD01.val());
    } else if (e.key === 'Enter' || e.keyCode === 13) {
      e.preventDefault();
      keepData();
      return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/920/SUPPLIERMASTER_DMCS_THA/index.php?FACTORYCODE=' + FACTORYCODE.val()+'&SUPPLIERADD01='+SUPPLIERADD01.val();
    //   return getSearch('SUPPLIERADD01', SUPPLIERADD01.val());
    }
    // if (SUPPLIERADD01.val() == '') unsetSession(form);
});

COUNTRYCD.on('keyup change', function (e) {
    if (e.type === 'change') {
      return getSearch('COUNTRYCD', COUNTRYCD.val());
    } else if (e.key === 'Enter' || e.keyCode === 13) {
      return getSearch('COUNTRYCD', COUNTRYCD.val());
    }
    // if (COUNTRYCD.val() == '') unsetSession(form);
});

STATECD.on('keyup change', function (e) {
    if (e.type === 'change') {
      return getSearch('STATECD', STATECD.val());
    } else if (e.key === 'Enter' || e.keyCode === 13) {
      return getSearch('STATECD', STATECD.val());
    }
    // if (STATECD.val() == '') unsetSession(form);
});

CITYCD.on('keyup change', function (e) {
    if (e.type === 'change') {
      return getSearch('CITYCD', CITYCD.val());
    } else if (e.key === 'Enter' || e.keyCode === 13) {
      return getSearch('CITYCD', CITYCD.val());
    }
    // if (CITYCD.val() == '') unsetSession(form);
});

SUPPLIERZIPCODE.on('keyup change', function (e) {
    if (e.type === 'change') {
      return getSearch('SUPPLIERZIPCODE', SUPPLIERZIPCODE.val());
    } else if (e.key === 'Enter' || e.keyCode === 13) {
      return getSearch('SUPPLIERZIPCODE', SUPPLIERZIPCODE.val());
    }
    // if (SUPPLIERZIPCODE.val() == '') unsetSession(form);
});

SUPPLIERADDR1.on('keyup change', function (e) {
    if (e.type === 'change') {
      return getSearch('SUPPLIERADDR1', SUPPLIERADDR1.val());
    } else if (e.key === 'Enter' || e.keyCode === 13) {
      return getSearch('SUPPLIERADDR1', SUPPLIERADDR1.val());
    }
    // if (SUPPLIERADDR1.val() == '') unsetSession(form);
});

SUPPLIERADDR2.on('keyup change', function (e) {
    if (e.type === 'change') {
      return getSearch('SUPPLIERADDR2', SUPPLIERADDR2.val());
    } else if (e.key === 'Enter' || e.keyCode === 13) {
      return getSearch('SUPPLIERADDR2', SUPPLIERADDR2.val());
    }
    // if (SUPPLIERADDR2.val() == '') unsetSession(form);
});

SUPBILLCD.on('keyup change', function (e) {
    if (e.type === 'change') {
      return getSearch('SUPBILLCD', SUPBILLCD.val());
    } else if (e.key === 'Enter' || e.keyCode === 13) {
      return getSearch('SUPBILLCD', SUPBILLCD.val());
    }
    // if (SUPBILLCD.val() == '') unsetSession(form);
});

CURRENCYCD.on('keyup change', function (e) {
    if (e.type === 'change') {
      return getSearch('CURRENCYCD', CURRENCYCD.val());
    } else if (e.key === 'Enter' || e.keyCode === 13) {
      return getSearch('CURRENCYCD', CURRENCYCD.val());
    }
    // if (CURRENCYCD.val() == '') unsetSession(form);
});

async function getSearch(code, value) {
    $('#loading').show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/920/SUPPLIERMASTER_DMCS_THA/index.php?'+code+'=' + value;
}

insert.click(function() {
    // check validate form
  	if (!form.reportValidity()) {
		alertValidation();
		return false;
	}
	inserted();
	// form.submit();
});

update.click(function() {
    // check validate form
  	if (!form.reportValidity()) {
		alertValidation();
		return false;
	}
	updated();
    // form.submit();
});

del.click(function() {
    // check validate item code
	if(SUPPLIERCD.val() == '') {
		return false;
	}
	deleted();
    // form.submit();
});

CLOSEPAGE.click(function () {
    return programDelete();
});

async function inserted() {

    const data = new FormData(form);
    data.append('action', 'insert');

    await axios.post('../SUPPLIERMASTER_DMCS_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        clearForm(form);
   		// window.location.href='index.php';
    })
    .catch(e => {
        console.log(e);
    });
}

async function updated() {
    const data = new FormData(form);
    data.append('action', 'update');

    await axios.post('../SUPPLIERMASTER_DMCS_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        clearForm(form);
    })
    .catch(e => {
        console.log(e);
    });
}

async function deleted() {
    const data = new FormData(form);
    data.append('action', 'delete');

    await axios.post('../SUPPLIERMASTER_DMCS_THA/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        clearForm(form);
    })
    .catch(e => {
        console.log(e);
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
        document.getElementById("loading").style.display = "none";
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
        document.getElementById("loading").style.display = "none";
    });
}

async function programDelete() {
  $('#loading').show();
  const appcode = $('#appcode').val();
  const appurl = $('#sessionUrl').val();
  let data = new FormData();
  data.append('FAPPCD', appcode);
  data.append('PROGRAMDELETE', 'programDelete');
  await axios.post(appurl + '/common/setsession.php', data)
  .then(response => {
      // console.log(response.data);
      let result = response.data;
      if(result['APPOPEN'] > 0) {
          return window.close();
      } else {
          return window.location.href = $('#sessionUrl').val() + '/home.php';
      }
      document.getElementById('loading').style.display = 'none';    
  }).catch(e => {
      // console.log(e);
      document.getElementById('loading').style.display = 'none';
  });
}

async function chacki() {
    const data = new FormData(form);
    data.append('action', 'chacki');

    await axios.post('../SUPPLIERMASTER_DMCS_THA/function/index_x.php', data)
    .then(response => {
        console.log(response.data['ROWCOUNTER'])
    })
    .catch(e => {
        console.log(e);
    });
}

async function getGMap() {
    const data = new FormData(form);
    data.append('action', 'getGMap');

    await axios.post('../SUPPLIERMASTER_DMCS_THA/function/index_x.php', data)
    .then(response => {
        console.log(response.data)
    })
    .catch(e => {
        console.log(e);
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

	// clearing table
    $('#table_result > tbody > tr').remove();

	// refresh
	if(form.id == 'suppliermaster') {
		// window.location.href = "index.php";
		window.location.href = '../SUPPLIERMASTER_DMCS_THA/';
	}
    return false;
}

function numberWithCommas(num) {
	return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function questionDialog(type, txt, btnyes, btnno) {
    return Swal.fire({ 
        title: '',
        text: txt,
        // background: '#8ca3a3',
        showCancelButton: true,
        // confirmButtonColor: 'silver',
        // cancelButtonColor: 'silver',
        confirmButtonText: btnyes,
        cancelButtonText: btnno
        }).then((result) => {
        if (result.isConfirmed) {
            if(type == 1) {
                programDelete();
            }
        }
    });
}

function digitFormat(num) {
    while (num.search(",") >= 0) {
    num = (num + "").replace(',', '');
    }
    return parseFloat(num).toFixed(2);
};