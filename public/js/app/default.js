async function submitPostForm(form) {
    const isNotValid = requiredInput(form);
    if (isNotValid) {
        Swal.fire({
            title: 'Error!',
            text: 'Please input required field',
            icon: 'error',
            confirmButtonText: 'OK'
        })
        return false;
    }

    const payload = $(form).serializeArray();
    const url = $(form).attr('action');

    const response = await httpPostWithoutToken(url, payload) || null;
    if (response?.error != null) {
        if (response?.error == true) {
            Swal.fire({
                title: 'Error!',
                text: response?.message,
                icon: 'error',
                confirmButtonText: 'OK'
            })
            return false;
        }

        if (response?.error == false) {
            return response?.data;
        }
    }
}

async function submitPostFormToken(form, additionalPayload = [], validation = true) {
    if (validation == true) {
        const isNotValid = requiredInput(form);
        if (isNotValid) {
            Swal.fire({
                title: 'Error!',
                text: 'Please input required field',
                icon: 'error',
                confirmButtonText: 'OK'
            })
            return false;
        }
    }

    let payload = $(form).serializeArray();
    const url = $(form).attr('action');

    payload.push(...additionalPayload);

    const response = await httpPost(url, payload) || null;
    if (response?.error != null) {
        if (response?.error == true) {
            Swal.fire({
                title: 'Error!',
                text: response?.message,
                icon: 'error',
                confirmButtonText: 'OK'
            })
            return false;
        }

        if (response?.error == false) {
            return response?.data;
        }
    }
}

async function submitPutFormToken(form, additionalPayload = []) {
    const isNotValid = requiredInput(form);
    if (isNotValid) {
        Swal.fire({
            title: 'Error!',
            text: 'Please input required field',
            icon: 'error',
            confirmButtonText: 'OK'
        })
        return false;
    }

    const payload = $(form).serializeArray();
    const url = $(form).attr('action');

    payload.push(...additionalPayload);

    const response = await httpPut(url, payload) || null;
    if (response?.error != null) {
        if (response?.error == true) {
            Swal.fire({
                title: 'Error!',
                text: response?.message,
                icon: 'error',
                confirmButtonText: 'OK'
            })
            return false;
        }

        if (response?.error == false) {
            return response?.data;
        }
    }
}

async function submitPostFormGuestToken(form, additionalPayload = [], validation = true) {
    if (validation == true) {
        const isNotValid = requiredInput(form);
        if (isNotValid) {
            Swal.fire({
                title: 'Error!',
                text: 'Please input required field',
                icon: 'error',
                confirmButtonText: 'OK'
            })
            return false;
        }
    }

    let payload = $(form).serializeArray();
    const url = $(form).attr('action');

    payload.push(...additionalPayload);

    const response = await httpPostGuest(url, payload) || null;
    if (response?.error != null) {
        if (response?.error == true) {
            Swal.fire({
                title: 'Error!',
                text: response?.message,
                icon: 'error',
                confirmButtonText: 'OK'
            })
            return false;
        }

        if (response?.error == false) {
            return response?.data;
        }
    }
}

async function submitPutFormGuestToken(form, additionalPayload = [], validation = true) {
    if (validation == true) {
        const isNotValid = requiredInput(form);
        if (isNotValid) {
            Swal.fire({
                title: 'Error!',
                text: 'Please input required field',
                icon: 'error',
                confirmButtonText: 'OK'
            })
            return false;
        }
    }
    
    const payload = $(form).serializeArray();
    const url = $(form).attr('action');

    payload.push(...additionalPayload);

    const response = await httpPutGuest(url, payload) || null;
    if (response?.error != null) {
        if (response?.error == true) {
            Swal.fire({
                title: 'Error!',
                text: response?.message,
                icon: 'error',
                confirmButtonText: 'OK'
            })
            return false;
        }

        if (response?.error == false) {
            return response?.data;
        }
    }
}

async function submitDownloadFileToken(form, additionalPayload = [], token = "_token") {
    const payload = $(form).serializeArray();
    const url = $(form).attr('action');

    payload.push(...additionalPayload);

    const response = await httpDownloadFile(url, payload, token) || null;
    if (response != null) {
        const blobData = response;
        const filename = 'download.pdf';

        const blob = new Blob([blobData], { type: 'application/pdf' });
        const link = document.createElement('a');
        link.href = window.URL.createObjectURL(blob);
        link.download = filename;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
}

async function logout(url, tokenName = '_token') {
    const response = await httpGet(url, {}, tokenName) || null;
    if (response?.error != null) {
        if (response?.error == true) {
            Swal.fire({
                title: 'Error!',
                text: response?.message,
                icon: 'error',
                confirmButtonText: 'OK'
            })
            return false;
        }

        if (response?.error == false) {
            return response?.data;
        }
    }
}

function requiredInput(form) {
    let valid = [];
    $(`${form} [required]`).each(function () {
        if (!$(this).val()) {
            valid.push(false);
            console.log($(this).attr('id'));
            $(this).addClass('required-invalid');
        } else {
            $(this).removeClass('required-invalid');
        }
    });

    return valid.includes(false);
}