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

async function httpGet(url, data = {}) {
    try {
        const token = localStorage.getItem('_token') || '';
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

async function redirectWithToken(url) {
    const token = localStorage.getItem('_token');

    return window.location.replace( `${url}?token=${encodeURIComponent(token)}`);
}

async function redirect(url) {
    return window.location.replace(`${url}`);
}

