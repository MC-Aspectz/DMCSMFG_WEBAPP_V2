// search
const SEARCHQUOTE = $('#SEARCHQUOTE');
const SEARCHDIVISION = $('#SEARCHDIVISION');
const SEARCHCUSTOMER = $('#SEARCHCUSTOMER');
const SEARCHCURRENCY = $('#SEARCHCURRENCY');
const SEARCHSTAFF = $('#SEARCHSTAFF');
const SEARCHSALEORDER = $('#SEARCHSALEORDER');

SEARCHQUOTE.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHQUOTE/index.php?page=ACC_SALEORDERENTRY_THA', 'authWindow', 'width=1200,height=600');});

SEARCHDIVISION.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHDIVISION/index.php?page=ACC_SALEORDERENTRY_THA', 'authWindow', 'width=1200,height=600');});

SEARCHCUSTOMER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCUSTOMER/index.php?page=ACC_SALEORDERENTRY_THA', 'authWindow', 'width=1200,height=600');});

SEARCHCURRENCY.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHCURRENCY/index.php?page=ACC_SALEORDERENTRY_THA', 'authWindow', 'width=1200,height=600');});

SEARCHSTAFF.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSTAFF/index.php?page=ACC_SALEORDERENTRY_THA', 'authWindow', 'width=1200,height=600');});

SEARCHSALEORDER.click(function(e) { e.preventDefault(); winopened = window.open($('#sessionUrl').val() + '/guide/'+ $('#comcd').val() +'/SEARCHSALEORDER/index.php?page=ACC_SALEORDERENTRY_THA', 'authWindow', 'width=1200,height=600');});

const serach_icon = [ SEARCHQUOTE, SEARCHCUSTOMER, SEARCHDIVISION, SEARCHCURRENCY, SEARCHSTAFF, SEARCHSALEORDER];

//input serach
const ESTNO = $('#ESTNO');
const SALEORDERNO = $('#SALEORDERNO');
const DIVISIONCD = $('#DIVISIONCD');
const CUSTOMERCD = $('#CUSTOMERCD');
const CUSCURCD = $('#CUSCURCD');
const STAFFCD = $('#STAFFCD');
const input_serach = [ ESTNO, SALEORDERNO, DIVISIONCD, CUSTOMERCD, CUSCURCD, STAFFCD];

// form
const form = document.getElementById('soentry');

// action button
const COMMIT = $('#COMMIT');
const CANCEL = $('#CANCEL');
const PRINT = $('#PRINT');

for (const input of input_serach) {
  input.change(function () {
    $('#loading').show();
  });

  input.keyup(function (e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
      $('#loading').show();
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
  // form.submit();
});

CANCEL.click(function () {
  return cancelDialog();
});

PRINT.click(function () {
  return printDialog();
});

ESTNO.on('keyup change', function (e) {
  if (e.type === 'change') {
    return getSearch('ESTNO', ESTNO.val());
  } else if (e.key === 'Enter' || e.keyCode === 13) {
    return getSearch('ESTNO', ESTNO.val());
  }
  if (ESTNO.val() == '') unsetSession(form);
});

SALEORDERNO.on('keyup change', function (e) {
  if (e.type === 'change') {
    return getSearch('SALEORDERNO', SALEORDERNO.val());
  } else if (e.key === 'Enter' || e.keyCode === 13) {
    return getSearch('SALEORDERNO', SALEORDERNO.val());
  }
  if (SALEORDERNO.val() == '') unsetSession(form);
});

DIVISIONCD.on('keyup change', function (e) {
  if (e.type === 'change') {
    keepData();
    return getSearch('DIVISIONCD', DIVISIONCD.val());
  } else if (e.key === 'Enter' || e.keyCode === 13) {
    keepData();
    return getSearch('DIVISIONCD', DIVISIONCD.val());
  }
});

CUSTOMERCD.on('keyup change', function (e) {
  if (e.type === 'change') {
    keepData();
    return getSearch('CUSTOMERCD', CUSTOMERCD.val());
  } else if (e.key === 'Enter' || e.keyCode === 13) {
    keepData();
    return getSearch('CUSTOMERCD', CUSTOMERCD.val());
  }
});

CUSCURCD.on('keyup change', function (e) {
  if (e.type === 'change') {
    keepData();
    return getSearch('CUSCURCD', CUSCURCD.val());
  } else if (e.key === 'Enter' || e.keyCode === 13) {
    keepData();
    return getSearch('CUSCURCD', CUSCURCD.val());
  }
});

STAFFCD.on('keyup change', function (e) {
  if (e.type === 'change') {
    keepData();
    return getSearch('STAFFCD', STAFFCD.val());
  } else if (e.key === 'Enter' || e.keyCode === 13) {
    keepData();
    return getSearch('STAFFCD', STAFFCD.val());
  }
});

async function getSearch(code, value) {
  $('#loading').show();
    return window.location.href = $('#sessionUrl').val() + '/app/'+ $('#comcd').val() +'/810/ACC_SALEORDERENTRY_THA/index.php?'+code+'=' + value;
}

async function commited() {
  const data = new FormData(form);
  data.append('action', 'commit');
  await axios
    .post('../ACC_SALEORDERENTRY_THA/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data);
      if (response.status == '200') {
        window.location.href = 'index.php?SALEORDERNO=' + response.data['SALEORDERNO'];
      }
      // let start = response.data.indexOf('{"SALEORDERNO":"') + 16;
      // let end = response.data.indexOf('"}');
      // // console.log(start); console.log(end);
      // let saleno = response.data.substring(start, end);
      // // console.log(saleno);
      // // clearForm(form);
      // if(saleno.substring(0, 2) == 'SD') {
      //     window.location.href='index.php?saleno=' + saleno;
      // }
    })
    .catch((e) => {
      // console.log(e);
    });
}

async function canceled() {
  const data = new FormData(form);
  data.append('action', 'cancel');
  await axios
    .post('../ACC_SALEORDERENTRY_THA/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data)
      clearForm(form);
      // window.location.href='index.php';
    })
    .catch((e) => {
      // console.log(e);
    });
}

async function printed() {
  const data = new FormData(form);
  data.append('action', 'print');
  await axios
    .post('../ACC_SALEORDERENTRY_THA/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data)
      // printReport();
    })
    .catch((e) => {
      // console.log(e);
    });
}

async function getAmt() {
  const data = new FormData(form);
  data.append('action', 'getAmt');
  await axios
    .post('../ACC_SALEORDERENTRY_THA/function/index_x.php', data)
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
  await axios
    .post('../ACC_SALEORDERENTRY_THA/function/index_x.php', data)
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
  await axios
    .post('../ACC_SALEORDERENTRY_THA/function/index_x.php', data)
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

  await axios
    .post('../ACC_SALEORDERENTRY_THA/function/index_x.php', data)
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

  await axios
    .post('../ACC_SALEORDERENTRY_THA/function/index_x.php', data)
    .then((response) => {
      // console.log(response.data)
      window.location.href = "../ACC_SALEORDERENTRY_THA/index.php?ITEMCD=";
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
  window.location.href = '../ACC_SALEORDERENTRY_THA/';

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
  let qty = $('#SALELNQTY' + x + '')
    .val()
    .replace(/,/g, '');
  let unitprice = $('#SALELNUNITPRC' + x + '')
    .val()
    .replace(/,/g, '');
  let discount = $('#SALELNDISCOUNT' + x + '')
    .val()
    .replace(/,/g, '');
  prices = parseFloat(qty) * parseFloat(unitprice);
  amount = prices - parseFloat(discount);
  // console.log(amount);
  // set amount per one feach
  $('#SALELNAMT' + x + '').val(numberWithCommas(amount.toFixed(2)));
  keepItemData();
  subtotal();
}

function subtotal() {
  let itemamount = document.getElementsByName('SALELNAMT[]');
  let sumtotal = 0;
  for (let i = 0; i < itemamount.length; i++) {
    sumtotal += parseFloat(itemamount[i].value.replace(/,/g, '')) || 0;
    // console.log(itemamount[i].value);
  }
  $('#S_TTL').val(numberWithCommas(sumtotal.toFixed(2)));
  $('#DISCRATE').val('0');
  $('#DISCOUNTAMOUNT').val('0.00');
  $('#QUOTEAMOUNT').val(numberWithCommas(sumtotal.toFixed(2)));
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
  $('#DISCOUNTAMOUNT').val(numberWithCommas(discount.toFixed(2)));
  $('#QUOTEAMOUNT').val(numberWithCommas(afeterdc.toFixed(2)));
  keepData();
  vat();
}

function vat() {
  // VATCALCTYP
  let quoteamt = $('#QUOTEAMOUNT').val().replace(/,/g, '');
  let vatamt = 0;
  let toal = 0;
  vatamt = parseFloat(quoteamt) * (parseFloat($('#VATRATE').val()) / 100);
  toal = parseFloat(quoteamt) + parseFloat(vatamt);
  $('#VATAMOUNT1').val(numberWithCommas(vatamt.toFixed(2)));
  $('#T_AMOUNT').val(numberWithCommas(toal.toFixed(2)));
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
                return printReport();
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

function printReport() {
  var popupWindow = window.open('../ACC_SALEORDERENTRY_THA/print.php', '_blank', 'width=800, height=800');
  setTimeout(function () {
    popupWindow.close();
  }, 10000);
  // var printReport = document.getElementById('printReport');
  // var popupWindow = window.open('', '_blank', 'width=800, height=800');
  // popupWindow.document.open();
  // popupWindow.document.write('<html><body onload="window.print()">' + printReport.innerHTML + '</body></html>');
  // // popupWindow.document.write('<html><body>' + printReport.innerHTML + '</body></html>');
  // popupWindow.document.close();
  // setTimeout(function() { popupWindow.close(); }, 1000);
}

function numberWithCommas(num) {
  return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function stringReplace(num) {
  return num.replace(/[^0-9.,]/g, "").replace(/(\..*?)\..*/g, "$1");
}
