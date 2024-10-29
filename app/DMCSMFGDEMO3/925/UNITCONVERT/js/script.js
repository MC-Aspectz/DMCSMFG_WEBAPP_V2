// 
// form
const form = document.getElementById('unitConversionMaster');

// action button
const INSERT = $('#INSERT');
const UPDATE = $('#UPDATE');
const DELETE = $('#DELETE');

INSERT.click(async function() {
    if (!form.reportValidity()) {
        alertValidation();
        return false;
    }
    return action('INSERT');
});

UPDATE.click(async function() {
    if (!form.reportValidity()) {
        alertValidation();
        return false;
    }
    return action('UPDATE');
});

DELETE.click(async function() {
    if (!form.reportValidity()) {
        alertValidation();
        return false;
    }
    return action('DELETE');
});

async function getElement(code, value) {
    $('#loading').show();
    const data = new FormData(form);
    data.append(code, value);
    data.append('action', code);
    await axios.post('../UNITCONVERT/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        let result = response.data;
        if(objectArray(result)) {
            // console.log(result);
            $.each(result, function(key, value) {
                if(document.getElementById(''+key+'')) {
                    document.getElementById(''+key+'').value = num4digit(value);
                }
            });
            document.getElementById('INSERT').disabled = true;
            document.getElementById('UPDATE').disabled = false;
            document.getElementById('DELETE').disabled = false;
        } else {
            document.getElementById('RATE').value = '';
            document.getElementById('RATEID').value = '';
            document.getElementById('INSERT').disabled = false;
            document.getElementById('UPDATE').disabled = true;
            document.getElementById('DELETE').disabled = true;
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
    await axios.post('../UNITCONVERT/function/index_x.php', data)
    .then(response => {
        // console.log(response.data);
        $('#loading').hide();
        if(response.status == 200) {
            // let result = response.data;
            clearForm(form);
        }
    })
    .catch(e => {
        $('#loading').hide();
        // console.log(e);
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
        }
    }
    // clearing selects
    var selects = form.getElementsByTagName('select');
    for (var i = 0; i < selects.length; i++)
        selects[i].selectedIndex = 0;

    document.getElementById('RATE').classList.add('req');
    document.getElementById('UNITTO').classList.add('req');
    document.getElementById('UNITFROM').classList.add('req');

    document.getElementById('INSERT').disabled = false;
    document.getElementById('UPDATE').disabled = true;
    document.getElementById('DELETE').disabled = true;

    return false;
}

function unRequired() {
    document.getElementById('RATE').classList[document.getElementById('RATE').value != '' ? 'remove' : 'add']('req');
    document.getElementById('UNITTO').classList[document.getElementById('UNITTO').selectedIndex != 0 ? 'remove' : 'add']('req');
    document.getElementById('UNITFROM').classList[document.getElementById('UNITFROM').selectedIndex != 0 ? 'remove' : 'add']('req');
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

