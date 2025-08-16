async function httpPostWithoutToken(url, data) {
    try {
        const response = await new Promise((resolve, reject) => {
            $.ajax({
                url,
                type: 'POST',
                data,
                success: resolve,
                error: function(jqXHR, textStatus, errorThrown) {
                    reject({
                        error: true,
                        message: jqXHR?.responseJSON?.message
                    });
                }
            });
        });

        return response || null;

    } catch (err) {
        return err;
    }
}

async function httpPost(url, data) {
    try {
        const token = localStorage.getItem('_token') || '';
        const response = await new Promise((resolve, reject) => {
            $.ajax({
                url,
                type: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`
                },
                data,
                success: resolve,
                error: function(jqXHR, textStatus, errorThrown) {
                    reject({
                        error: true,
                        message: jqXHR?.responseJSON?.message
                    });
                }
            });
        });

        return response || null;

    } catch (err) {
        return err;
    }
}

async function httpPut(url, data) {
    try {
        const token = localStorage.getItem('_token') || '';
        const response = await new Promise((resolve, reject) => {
            $.ajax({
                url,
                type: 'PUT',
                headers: {
                    'Authorization': `Bearer ${token}`
                },
                data,
                success: resolve,
                error: function(jqXHR, textStatus, errorThrown) {
                    reject({
                        error: true,
                        message: jqXHR?.responseJSON?.message
                    });
                }
            });
        });

        return response || null;

    } catch (err) {
        return err;
    }
}

async function httpGet(url, data = {}, tokenName = '_token') {
    try {
        const token = localStorage.getItem(tokenName) || '';
        const response = await new Promise((resolve, reject) => {
            $.ajax({
                url,
                type: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`
                },
                data,
                success: resolve,
                error: function(jqXHR, textStatus, errorThrown) {
                    reject({
                        error: true,
                        message: jqXHR?.responseJSON?.message
                    });
                }
            });
        });

        return response || null;

    } catch (err) {
        return err;
    }
}

async function httpPostGuest(url, data) {
    try {
        const token = localStorage.getItem('_token_guest') || '';
        const response = await new Promise((resolve, reject) => {
            $.ajax({
                url,
                type: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`
                },
                data,
                success: resolve,
                error: function(jqXHR, textStatus, errorThrown) {
                    reject({
                        error: true,
                        message: jqXHR?.responseJSON?.message
                    });
                }
            });
        });

        return response || null;

    } catch (err) {
        return err;
    }
}

async function httpPutGuest(url, data) {
    try {
        const token = localStorage.getItem('_token_guest') || '';
        const response = await new Promise((resolve, reject) => {
            $.ajax({
                url,
                type: 'PUT',
                headers: {
                    'Authorization': `Bearer ${token}`
                },
                data,
                success: resolve,
                error: function(jqXHR, textStatus, errorThrown) {
                    reject({
                        error: true,
                        message: jqXHR?.responseJSON?.message
                    });
                }
            });
        });

        return response || null;

    } catch (err) {
        return err;
    }
}

async function httpGetGuest(url, data = {}) {
    try {
        const token = localStorage.getItem('_token_guest') || '';
        const response = await new Promise((resolve, reject) => {
            $.ajax({
                url,
                type: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`
                },
                data,
                success: resolve,
                error: function(jqXHR, textStatus, errorThrown) {
                    reject({
                        error: true,
                        message: jqXHR?.responseJSON?.message
                    });
                }
            });
        });

        return response || null;

    } catch (err) {
        return err;
    }
}

async function httpDownloadFile_1(url, data = {}, tokenString) {
    try {
        const token = localStorage.getItem(tokenString) || '';
        const response = await new Promise((resolve, reject) => {
            $.ajax({
                url,
                type: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`
                },
                data,
                xhrFields: { responseType: 'blob' },
                success: function (blobData, status, xhr) {
                    // ambil filename dari Content-Disposition
                    let filename = "download.pdf";
                    const disposition = xhr.getResponseHeader('Content-Disposition');
                    if (disposition && disposition.indexOf('filename=') !== -1) {
                        filename = disposition.split('filename=')[1].replace(/"/g, '');
                    }

                    resolve({ blobData, filename });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    reject({
                        error: true,
                        message: jqXHR?.responseJSON?.message
                    });
                }
            });
        });

        return response || null;

    } catch (err) {
        return err;
    }
}

async function httpDownloadFile(url, data = {}, tokenString) {
    try {
        const token = localStorage.getItem(tokenString) || '';
        const response = await new Promise((resolve, reject) => {
            $.ajax({
                url,
                type: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`
                },
                data,
                xhrFields: { responseType: 'blob' },
                success: resolve,
                error: function(jqXHR, textStatus, errorThrown) {
                    reject({
                        error: true,
                        message: jqXHR?.responseJSON?.message
                    });
                }
            });
        });

        return response || null;

    } catch (err) {
        return err;
    }
}

async function redirectWithToken(url, tokenName='_token') {
    const token = localStorage.getItem(tokenName);

    return window.location.replace( `${url}?token=${encodeURIComponent(token)}`);
}

async function redirect(url) {
    return window.location.replace(`${url}`);
}

