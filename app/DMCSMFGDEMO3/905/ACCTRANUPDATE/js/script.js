// form
const form = document.getElementById('yearendprocess');


async function updated() {
    $('#loading').show();
    const data = new FormData(form);
    data.append('action', 'update');
    await axios.post('../ACCTRANUPDATE/function/index_x.php', data)
    .then(response => {
        console.log(response.data);
        // clearForm(form);
        $('#loading').hide();
        alertSuccess();
    })
    .catch(e => {
        console.log(e);
    });
}

async function unsetSession() {
    let data = new FormData();
    data.append('action', 'unsetsession');

    await axios.post('../ACCTRANUPDATE/function/index_x.php', data)
    .then(response => {
        // console.log(response.data)
        clearForm(form);
    })
    .catch(e => {
        console.log(e);
    });
}

async function programDelete() {
    $('#loading').show();
    let data = new FormData();
    data.append("action", "programDelete");
    await axios
    .post("../INVENTORYBATCH/function/index_x.php", data)
    .then((response) => {
      // console.log(response.data);
      window.location.href = $('#sessionUrl').val() + '/home.php';
    })
    .catch((e) => {
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

	// clearing table
    $('#table_result > tbody > tr').remove();

	// refresh
	if(form.id == 'yearendprocess') {
		// window.location.href = "index.php";
		window.location.href = '../ACCTRANUPDATE/';
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
                return programDelete();         
            }
        }
    });
}