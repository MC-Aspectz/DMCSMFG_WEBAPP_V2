// search
const SEARCHSALEORDER = $("#SEARCHSALEORDER");
const SEARCHSALETRAN_ACC = $("#SEARCHSALETRAN_ACC");
const SEARCHDIVISION = $("#SEARCHDIVISION");
const SEARCHCUSTOMER = $("#SEARCHCUSTOMER");
const SEARCHCURRENCY = $("#SEARCHCURRENCY");
const SEARCHSTAFF = $("#SEARCHSTAFF");

SEARCHSALEORDER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSALEORDER/index.php?page=ACC_SALEENTRY_THA2', 'authWindow', 'width=1200,height=600');});

SEARCHSALETRAN_ACC.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSALETRAN_ACC/index.php?page=ACC_SALEENTRY_THA2', 'authWindow', 'width=1200,height=600');});

SEARCHDIVISION.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHDIVISION/index.php?page=ACC_SALEENTRY_THA2', 'authWindow', 'width=1200,height=600');});

SEARCHCUSTOMER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCUSTOMER/index.php?page=ACC_SALEENTRY_THA2', 'authWindow', 'width=1200,height=600');});

SEARCHCURRENCY.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCURRENCY/index.php?page=ACC_SALEENTRY_THA2', 'authWindow', 'width=1200,height=600');});

SEARCHSTAFF.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTAFF/index.php?page=ACC_SALEENTRY_THA2', 'authWindow', 'width=1200,height=600');});

const serach_icon = [ SEARCHSALEORDER, SEARCHSALETRAN_ACC, SEARCHDIVISION, SEARCHCUSTOMER, SEARCHCURRENCY, SEARCHSTAFF];

//input serach
const SALETRANNO = $('#SALETRANNO');
const SALEORDERNO = $('#SALEORDERNO');
const DIVISIONCD = $('#DIVISIONCD');
const CUSTOMERCD = $('#CUSTOMERCD');
const CUSCURCD = $('#CUSCURCD');
const STAFFCD = $('#STAFFCD');
const SVNO = $('#SVNO');
const input_serach = [ SALETRANNO, SALEORDERNO, DIVISIONCD, CUSTOMERCD, CUSCURCD, STAFFCD];

//input require
const SALETERM = $('#SALETERM');

// form
const form = document.getElementById("saleentry2");

// action button
const COMMIT = $('#COMMIT');
const INV = $('#INV');
const SALEV = $('#SALEV');
const TAXINV = $('#TAXINV');
const REPLACEZ = $('#REPLACEZ');

for (const input of input_serach) {
    input.on('keyup change', function (e) {
        if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
            $('#loading').show();
            keepData();
        }
    });
}

for (const input of serach_icon) {
  input.click(function () {
    keepData();
  });
}

COMMIT.click(function () {
    // check validate form
    if (!form.reportValidity()) {
        alertValidation();
        return false;
    }
    return commitDialog();
});

REPLACEZ.click(function () {
    $('#loading').show();
    return window.location.href = $("#sessionUrl").val() + '/guide/'+ $('#comcd').val() +'/ACC_RESALEENTRY_THA/index.php?SALETRANNO=' + SALETRANNO.val() + "&SVNO=" + SVNO.val() + '&page=ACC_SALEENTRY_THA2';
});

INV.click(function () {
    return printed('IVprint');
});

TAXINV.click(function () {
    return IVprintchecked();
});

SALEV.click(function () {
    return SVprintCheck();
});

SALETRANNO.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getSearch('SALETRANNO', SALETRANNO.val());
    }
    if (SALETRANNO.val() == '') unsetSession(form);
});

SALEORDERNO.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getSearch('SALEORDERNO', SALEORDERNO.val());
    }
    if (SALEORDERNO.val() == '') unsetSession(form);
});

DIVISIONCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('DIVISIONCD', DIVISIONCD.val());
    }
});

CUSTOMERCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('CUSTOMERCD', CUSTOMERCD.val());
    }
});

CUSCURCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('CUSCURCD', CUSCURCD.val());
    }
});

STAFFCD.on('keyup change', function (e) {
    if ((e.type === 'change') || (e.key === 'Enter' || e.keyCode === 13)) {
        return getElement('STAFFCD', STAFFCD.val());
    }
});

async function getSearch(code, value) {
  $('#loading').show();
  return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/810/ACC_SALEENTRY_THA2/index.php?'+code+'=' + value;
}

async function getElement(code, value) {
    $('#loading').show();
    const cuscurdisp = document.getElementsByName('CUSCURDISP');
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../ACC_SALEENTRY_THA2/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(objectArray(result)) {
            $.each(result, function(key, value) {
                // console.log(key, '=>', value);
                if(document.getElementById(''+key+'')) {
                    document.getElementById(''+key+'').value = value;
                }
                if(key == 'CUSCURCD') {
                    for (var i = 0; i < cuscurdisp.length; i++) {
                        cuscurdisp[i].value = value;
                    }
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

async function commited() {
  const data = new FormData(form);
  data.append('action', 'commit');
  await axios.post('../ACC_SALEENTRY_THA2/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data);
      if (response.status == '200') {
        if (response.data['SALETRANNO'] != undefined) {
          successValidation(response.data['SALETRANNO']);
          window.location.href = 'index.php?SALETRANNO=' + response.data['SALETRANNO'];
        } else {
          let start = response.data.indexOf('ERRO:') + 5;
          let end = response.data.indexOf('_STOCK');
          let erro = response.data.substring(start, end);
          // console.log(erro);
          if (erro == 'ERRO_ITEM_OUT_OF') {
            alertError(1);
          } else if (erro == 'ERRO_PISITEM_OUT_OF') {
            alertError(2);
          } else {
            let ender = response.data.indexOf('_ITEM ');
            let error = response.data.substring(erstart, ender);
            if (error == 'ERROR_NODETAIL') {
              alertError(3);
            } else {
              alertError(1);
            }
          }
        }
      }
      document.getElementById('loading').style.display = 'none';
    })
    .catch((e) => {
      document.getElementById('loading').style.display = 'none';
      // console.log(e);
    });
}

async function IVprintchecked() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'ivprintcheck');
    await axios.post('../ACC_SALEENTRY_THA2/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        let res = response.data;
        if(res.length == 33) {
            $('#loading').hide();
            return taxInvoiceDialog();
        } else {
            if(res['SYSVIS_REPRINTREASON'] == 'T') {
                document.getElementById('reprints').style.display = 'block';
            }
            if(res['SYSVIS_REPRINTLBL'] == 'T') {
                $('#REPRINTREASON').attr('readonly', false).css('background-color', 'white');
            }
            document.getElementById('REPLACEZ').style.visibility = 'visible';
            return printed('TIVprint');
        }
    })
    .catch((e) => {
        $('#loading').hide();
        // console.log(e);
    });
}

async function SVprintCheck() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'svprintcheck');
    await axios.post('../ACC_SALEENTRY_THA2/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        let res = response.data;
        if(res.length == 33) {
            $('#loading').hide();
            return taxInvoiceDialog();
        } else {
            if(res['SYSVIS_REPRINTREASON'] == 'T') {
              document.getElementById('reprints').style.display = 'block';
            }
            if(res['SYSVIS_REPRINTLBL'] == 'T') {
              $('#REPRINTREASON').attr('readonly', false).css('background-color', 'white');
            }
            return printed('SVPrint');
        }
    })
    .catch((e) => {
        $('#loading').hide();
        // console.log(e);
    });
}

async function printed(printTYPE) {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', printTYPE);
    await axios.post('../ACC_SALEENTRY_THA2/function/index_x.php', data)
    .then((response) => {
        // console.log(response.data);
        if (response.status == '200') {
            let result = response.data;
            $.each(response.data, function(key, value) {
                // console.log(value.url);
                downloader($('#sessionUrl').val() + value.url, value.filename);
            });
        }
        $('#loading').hide();
    })
    .catch((e) => {
        // console.log(e);
        $('#loading').hide();
    });
}

async function getAmt() {
  const data = new FormData(form);
  data.append('action', 'getAmt');
  await axios.post('../ACC_SALEENTRY_THA2/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data)
    })
    .catch((e) => {
      // console.log(e);
    });
}

async function keepData() {
  const data = new FormData(form);
  data.append('action', 'keepdata');
  await axios.post('../ACC_SALEENTRY_THA2/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data)
    })
    .catch((e) => {
      // console.log(e);
    });
}

async function keepItemData() {
  const data = new FormData(form);
  data.append('action', 'keepItemData');
  // console.log(data);
  await axios.post('../ACC_SALEENTRY_THA2/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data)
    })
    .catch((e) => {
      // console.log(e);
    });
}

async function unsetSession(form) {
  let data = new FormData();
  data.append('action', 'unsetsession');
  data.append('systemName', 'SalesOrderEntry');
  await axios.post('../ACC_SALEENTRY_THA2/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data)
      clearForm(form);
    })
    .catch((e) => {
      // console.log(e);
    });
}

async function unsetSessionItem(lineIndex) {
  let data = new FormData();
  data.append('action', 'unsetsessionItem');
  data.append('systemName', 'SalesOrderEntry');
  data.append('lineIndex', lineIndex);
  await axios.post('../ACC_SALEENTRY_THA2/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data)
      window.location.href = '../ACC_SALEENTRY_THA2/index.php?ITEMCD=';
      // window.location.reload();
    })
    .catch((e) => {
      // console.log(e);
    });
}

async function clearForm(form) {
  // clearing inputs
    var inputs = form.getElementsByTagName('input');
    for (var i = 0; i < inputs.length; i++) {
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
    for (var i = 0; i < selects.length; i++) selects[i].selectedIndex = 0;

    // clearing textarea
    var text = form.getElementsByTagName('textarea');
    for (var i = 0; i < text.length; i++) text[i].innerHTML = '';

    // clearing table
    $('#table > tbody > tr').remove();

    // refresh
    location.replace
    window.location.href = '../ACC_SALEENTRY_THA2/';

    return false;
}

function onEnterItem(event, n) {
  if (event.key === "Enter" || event.keyCode === 13) {
    return findItemCode(n);
  }
}

function calculateamt(x) {
  // console.log(x);
    let amount = 0;
    let prices = 0;
    let qty = $('#SALEQTY' + x + '').val().replace(/,/g, '');
    let unitprice = $('#SALEUNITPRC' + x + '').val().replace(/,/g, '');
    let discount = $('#SALEDISCOUNT' + x + '').val().replace(/,/g, '');
    // getAmt(qty, unitprice, discount);
    prices = parseFloat(qty) * parseFloat(unitprice);
    amount = prices - parseFloat(discount);
    // console.log(amount);
    // set amount per one feach
    $('#SALEAMT' + x + '').val(num2digit(amount));
    keeyItemData();
    subtotal();
}

function subtotal() {
    let itemamount = document.getElementsByName('SALEAMT[]');
    let sumtotal = 0;
    for (let i = 0; i < itemamount.length; i++) {
        sumtotal += parseFloat(itemamount[i].value.replace(/,/g, '')) || 0;
        // console.log(itemamount[i].value);
    }
    $('#S_TTL').val(num2digit(sumtotal));
    $('#DISCRATE').val('0');
    $('#DISCOUNTAMOUNT').val('0.00');
    $('#QUOTEAMOUNT').val(num2digit(sumtotal));
    keepData();
    vat();
}

function discount() {
    let discount = 0;
    let afeterdc = 0;
    let subtotal = $('#S_TTL').val().replace(/,/g, '');
    let disrate = $('#DISCRATE').val().replace(/,/g, '');
    if (parseInt($('#DISCRATE').val()) > 100) {
        disrate = 100;
    } else {
        disrate = $('#DISCRATE').val();
    }
    discount = parseFloat(disrate) * (parseFloat(subtotal) / 100);
    afeterdc = subtotal - discount;
    $('#DISCOUNTAMOUNT').val(num2digit(discount));
    $('#QUOTEAMOUNT').val(num2digit(afeterdc));
    $('#T_AMOUNT').val(num2digit(afeterdc));
    keepData();
    vat();
}

function vat() {
    // VATCALCTYP
    let quoteamt = $('#QUOTEAMOUNT').val().replace(/,/g, '');
    let vatamt = 0;
    let toal = 0;
    vatamt = (parseFloat($('#VATRATE').val()) / 100) * parseFloat(quoteamt); //* $('#GROUPRT').val()
    toal = parseFloat(quoteamt) + parseFloat(vatamt);
    $('#VATAMOUNT1').val(num2digit(vatamt));
    $('#T_AMOUNT1').val(num2digit(toal));
    keepData();
}

function questionDialog(type, txt, btnyes, btnno) {
    return Swal.fire({
        title: '',
        text: txt,
        showCancelButton: true,
        confirmButtonText: btnyes,
        cancelButtonText: btnno,
    }).then((result) => {
        if (result.isConfirmed) {
            if (type == 1) {
                return closeApp($('#appcode').val());
            } else if (type == 2) {
                $('#loading').show();
                return canceled();
            } else if (type == 3) {
                $('#loading').show();
                return commited();
            } else {

            }
        }
    });
}

function itemValidation(error, btnyes, btnno) {
    return Swal.fire({
        title: '',
        text: error,
        showCancelButton: false,
        confirmButtonText: btnyes,
        cancelButtonText: btnno,
    }).then((result) => {
        if (result.isConfirmed) {
          //
        }
    });
}

// function invoiceReport() {
//   var popupWindow = window.open( '../ACC_SALEENTRY_THA2/invoice.php?REPRINTREASON=' +  $('#REPRINTREASON').val(),  '_blank', 'width=800, height=800' );
//   setTimeout(function () {
//     popupWindow.close();
//   }, 8000);

//   // var invoiceReport = document.getElementById('invoiceReport');
//   // var popupWindow = window.open('', '_blank', 'width=800, height=800');
//   // popupWindow.document.open();
//   // if($('#REPRINTREASON').val() != '') {
//   //     popupWindow.opener.document.getElementById('reprintreason1').innerHTML = 'Reprint reason';
//   //     popupWindow.opener.document.getElementById('reprintreason2').innerHTML = 'Reprint reason';
//   //     popupWindow.opener.document.getElementById('reprintinv1').innerHTML = $('#REPRINTREASON').val();
//   //     popupWindow.opener.document.getElementById('reprintinv2').innerHTML = $('#REPRINTREASON').val();
//   // } else {
//   //     popupWindow.opener.document.getElementById('reprintreason1').innerHTML = '';
//   //     popupWindow.opener.document.getElementById('reprintreason2').innerHTML = '';
//   //     popupWindow.opener.document.getElementById('reprintinv1').innerHTML = '';
//   //     popupWindow.opener.document.getElementById('reprintinv2').innerHTML = '';
//   // }
//   // popupWindow.document.write('<html><body onload='window.print()'>' + invoiceReport.innerHTML + '</body></html>');
//   // // popupWindow.document.write('<html><body>' + invoiceReport.innerHTML + '</body></html>');
//   // popupWindow.document.close();
//   // setTimeout(function() { popupWindow.close(); }, 1000);
// }

// function taxInvoiceReport() {
//   var popupWindow = window.open('../ACC_SALEENTRY_THA2/taxinvoice.php?REPRINTREASON=' + $('#REPRINTREASON').val(), '_blank', 'width=800, height=800');
//   setTimeout(function () {
//     popupWindow.close();
//   }, 8000);

//   // var taxinvoiceReport = document.getElementById('taxinvoiceReport');
//   // var popupWindow = window.open('', '_blank', 'width=800, height=800');
//   // popupWindow.document.open();
//   // popupWindow.opener.document.getElementById('reprint').innerHTML = $('#REPRINTREASON').val();
//   // popupWindow.document.write('<html><body onload='window.print()'>' + taxinvoiceReport.innerHTML + '</body></html>');
//   // // popupWindow.document.write('<html><body>' + taxinvoiceReport.innerHTML + '</body></html>');
//   // popupWindow.document.close();
//   // // document.getElementById('loading').style.display = 'none';
//   // setTimeout(function() { popupWindow.close(); }, 1000);
// }

// async function svReport() {
//   var popupWindow = window.open('../ACC_SALEENTRY_THA2/salevoucher.php?REPRINTREASON=' + $('#REPRINTREASON').val(), '_blank', 'width=800, height=800');
//   setTimeout(function () {
//     popupWindow.close();
//   }, 8000);

//   // var salevc = await document.getElementById('salevoucherReport');
//   // var popupWindow = window.open('', '_blank', 'width=800, height=800');
//   // popupWindow.document.open();
//   // popupWindow.opener.document.getElementById('svreprintreason').innerHTML = $('#REPRINTREASON').val();
//   // popupWindow.document.write('<html><body onload="window.print()">' + salevc.innerHTML + '</body></html>');
//   // // popupWindow.document.write('<html><body>' + salevc.innerHTML + '</body></html>');
//   // popupWindow.document.close();
//   // // document.getElementById('loading').style.display = 'none';
//   // setTimeout(function() { popupWindow.close(); }, 1000);
// }