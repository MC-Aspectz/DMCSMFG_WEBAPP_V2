// button search
const searchitem = $("#searchitem");
const searchitem2 = $("#searchitem2");
const searchcategory = $("#searchcategory");
const searchsupplier = $("#searchsupplier");
const searchlocation = $("#searchlocation");

searchitem.attr(
  "href",
  $("#sessionUrl").val() + "/guide/SEARCHITEM/index.php?index=1"
);
searchitem2.attr(
  "href",
  $("#sessionUrl").val() + "/guide/SEARCHITEM/index.php?index=2"
);
searchcategory.attr(
  "href",
  $("#sessionUrl").val() + "/guide/SEARCHCATALOG/index.php"
);
searchsupplier.attr(
  "href",
  $("#sessionUrl").val() + "/guide/SEARCHSUPPLIER/index.php"
);
searchlocation.attr(
  "href",
  $("#sessionUrl").val() + "/guide/SEARCHSTORAGE/index.php"
);

const ITEMCD1 = $("#ITEMCD1");
const ITEMCD2 = $("#ITEMCD2");
const ITEMNAME = $("#ITEMNAME");
const ITEMSEARCH = $("#ITEMSEARCH");
const ITEMTYP = $("#ITEMTYP");
const SEARCHSTRING = $("#ITEMSEARCH");
const UNIT = $("#ITEMUNIT");
//input serach
const CATALOGCD = $("#CATALOGCD");
const SUPPLIERCD = $("#SUPPLIERCD");
const STORAGECD = $("#STORAGECD");

const input_serach = [CATALOGCD, SUPPLIERCD, STORAGECD];

// action button
const insrts = $("#insert");
//const updte = $("#update");
const deletes = $("#delete");
const closepage = $("#closepage");

// form
const form = document.getElementById("itemmasterinquiry");

$(document).ready(function () {
  //document.getElementById("update").disabled = true;
  document.getElementById("delete").disabled = true;
});

for (const input of input_serach) {
  input.change(function () {
    $("#loading").show();
  });

  input.keyup(function (e) {
    if (e.key === "Enter" || e.keyCode === 13) {
      $("#loading").show();
    }
  });
}

searchcategory.click(function () {
  keeyData();
});

searchsupplier.click(function () {
  keeyData();
});

searchlocation.click(function () {
  keeyData();
});

CATALOGCD.change(function () {
  window.location.href = "index.php?catalogcd=" + CATALOGCD.val();
});

CATALOGCD.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    window.location.href = "index.php?catalogcd=" + CATALOGCD.val();
  }
});
SUPPLIERCD.change(function () {
  window.location.href = "index.php?suppliercd=" + SUPPLIERCD.val();
});

SUPPLIERCD.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    window.location.href = "index.php?suppliercd=" + SUPPLIERCD.val();
  }
});
STORAGECD.change(function () {
  window.location.href = "index.php?locationcd=" + STORAGECD.val();
});

STORAGECD.keyup(function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    window.location.href = "index.php?locationcd=" + STORAGECD.val();
  }
});

// ACC_CD3.change(function() {
//     window.location.href="index.php?acccode=" + ACC_CD3.val()+"&index=3";
//     keeyData();
// });

// ACC_CD3.keyup(function(e) {
//     if (e.key === 'Enter' || e.keyCode === 13) {
//         window.location.href="index.php?acccode=" + ACC_CD3.val()+"&index=3";
//         keeyData();
//     }
// })

insrts.click(function () {
  // check validate form
  if (!form.reportValidity()) {
    validationDialog();
    return false;
  }
  return commit("insert");
});

// updte.click(function() {
//     return commit('update');
// });

deletes.click(function () {
  return commit("deletes");
});

closepage.click(function () {
  return programDelete();
});

$("table#search_table tr").click(function () {
  $("table#search_table tr").removeAttr("id");

  $(this).attr("id", "click-row");

  let item = $(this).closest("tr").children("td");

  if (item.eq(0).text() != "undefined" && item.eq(0).text() != "") {
    // console.log(item.eq(0).text());
    // $('#WHTAXTYPE').val(item.eq(0).text());
    $("#ITEMNAME").val(item.eq(1).text());
    $("#ITEMSEARCH").val(item.eq(2).text());
    //  $('#ACC_CD2').val(item.eq(3).text());
    $("#ITEMTYP").val(item.eq(4).text());
    $("#ITEMBOI").val(item.eq(6).text());

    //document.getElementById("insert").disabled = false;
    //document.getElementById("update").disabled = false;
    //document.getElementById("delete").disabled = true;
    // document.getElementById("CATALOGNAME").value = item.eq(1).text();
  }
});

async function searchs() {
  $("#loading").show();
  form.submit();
}

async function commit(method) {
  let data = new FormData(form);
  data.append("action", method);

  await axios
    .post("../ITEMMASTERINQUIRY/function/index_x.php", data)
    .then((response) => {
      console.log(response.data);
      window.location.href = "index.php?refresh=1";
      // clearForm(form);
    })
    .catch((e) => {
      console.log(e);
    });
}

async function exportCSV() {
  // Variable to store the final csv data
  var csv_data = [
    "Item," + ITEMCD1.val() + ",-," + ITEMCD2.val() + "Type of Item",
    +ITEMTYP.val() + "Catgory Code",
    +CATALOGCD.val(),
  ];

  // Get each row data
  var rows = document.getElementsByTagName("tr");
  for (var i = 0; i < rows.length; i++) {
    // Get each column data
    var cols = rows[i].querySelectorAll("td, th");
    // Stores each csv row data
    var csvrow = [];
    for (var j = 0; j < cols.length; j++) {
      // Get the text data of each cell
      // of a row and push it to csvrow
      csvrow.push(cols[j].innerHTML);
    }
    // Combine each column value with comma
    csv_data.push(csvrow.join(","));
  }
  // Combine each row data with new line character
  csv_data = csv_data.join("\n");
  // Call this function to download csv file
  await handleSaveAsFile(csv_data);
}

async function handleSaveAsFile(csv_data) {
  CSVFile = new Blob(["\uFEFF" + csv_data], {
    type: "text/csv;charset=utf-8;",
  });
  // console.log(CSVFile);
  const supportsFileSystemAccess =
    "showSaveFilePicker" in window &&
    (() => {
      try {
        return window.self === window.top;
      } catch {
        return false;
      }
    });
  // If the File System Access API is supported…
  if (supportsFileSystemAccess) {
    try {
      // Show the file save dialog.
      const handle = await showSaveFilePicker({
        types: [
          {
            description: "CSV file",
            accept: { "application/csv": [".csv"] },
          },
        ],
      });
      // Write the CSVFile to the file.
      const writable = await handle.createWritable();
      await writable.write(CSVFile);
      await writable.close();
      return;
    } catch (err) {
      // Fail silently if the user has simply canceled the dialog.
      if (err.name !== "AbortError") {
        console.error(err.name, err.message);
        return;
      }
    }
  }
  // Fallback if the File System Access API is not supported…
  // Create the CSVFile URL.
  const url = URL.createObjectURL(CSVFile);
  // Create the `<a download>` element and append it invisibly.
  const temp_link = document.createElement("a");
  temp_link.href = url;
  temp_link.download = suggestedName;
  temp_link.style.display = "none";
  document.body.append(temp_link);
  // Programmatically click the element.
  temp_link.click();
  // Revoke the CSVFile URL and remove the element.
  setTimeout(() => {
    URL.revokeObjectURL(url);
    temp_link.remove();
  }, 1000);
}

async function keeyData() {
  const data = new FormData(form);
  data.append("action", "keepdata");

  await axios
    .post("../ITEMMASTERINQUIRY/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
    })
    .catch((e) => {
      console.log(e);
    });
}

async function unsetSession() {
  let data = new FormData();
  data.append("action", "unsetsession");

  await axios
    .post("../ITEMMASTERINQUIRY/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
      clearForm(form);
    })
    .catch((e) => {
      console.log(e);
    });
}

async function programDelete() {
  let data = new FormData();
  data.append("action", "programDelete");

  await axios
    .post("../ITEMMASTERINQUIRY/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data)
      clearForm(form);
    })
    .catch((e) => {
      console.log(e);
    });
}

async function clearForm(form) {
    // clearing inputs
    var inputs = form.getElementsByTagName('input');
    for (var i = 0; i < inputs.length; i++) {
        // console.log(inputs[i].type);
        switch (inputs[i].type) {
            case 'date':
                break;
            case 'checkbox':
                inputs[i].checked = false;
                break;
            case 'radio':
                inputs[i].checked = false;
                break;                
            default:
                inputs[i].value = '';
        }
    }
    
    // clearing selects
    var selectoption = form.getElementsByTagName('select');
    for (var i = 0; i < selectoption.length; i++) { selectoption[i].selectedIndex = 0; }

    // clearing textarea
    var textarea = form.getElementsByTagName('textarea');
    for (var i = 0; i < textarea.length; i++) { textarea[i].value = ''; }

  // clearing table
  $("#search_table > tbody > tr").remove();
  emptyRow();
  // refresh
  window.location.href = "../ITEMMASTERINQUIRY/";
  return false;
}

function emptyRow() {
  for (var i = 0; i < 10; i++) {
    $("table tbody").append(
      '<tr class="tr_border table-secondary">' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td>' +
        '<td class="td-class"></td></tr>'
    );
  }
}

function questionDialog(type, txt, btnyes, btnno) {
  return Swal.fire({
    title: "",
    text: txt,
    background: "#8ca3a3",
    showCancelButton: true,
    confirmButtonColor: "silver",
    cancelButtonColor: "silver",
    confirmButtonText: btnyes,
    cancelButtonText: btnno,
  }).then((result) => {
    if (result.isConfirmed) {
      if (type == 1) {
        programDelete();
        window.location.href = "/DMCS_WEBAPP";
      }
    }
  });
}

// function getMachineId() {
//     let machineId = localStorage.getItem('MachineId');

//     if (!machineId) {
//         machineId = crypto.randomUUID();
//         localStorage.setItem('MachineId', machineId);
//     }
//     return machineId.toUpperCase();
// }
