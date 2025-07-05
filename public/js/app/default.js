async function submitPostForm(form) {
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

async function submitPostFormToken(form) {
    const payload = $(form).serializeArray();
    const url = $(form).attr('action');

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

async function submitPutFormToken(form) {
    const payload = $(form).serializeArray();
    const url = $(form).attr('action');

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

async function logout(url) {
    const response = await httpGet(url) || null;
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