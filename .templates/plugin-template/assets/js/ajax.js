/**
 * Objeto que maneja las solicitudes AJAX utilizando XMLHttpRequest.
 */
var ajax = {
    /**
     * Envía una solicitud AJAX.
     * @param {string} url - La URL a la que se enviará la solicitud.
     * @param {string} action - La acción específica para la solicitud AJAX.
     * @param {Object} data - Los datos que se enviarán en el cuerpo de la solicitud (opcional).
     * @param {string} method - El método HTTP de la solicitud ('GET', 'POST', etc.).
     * @param {function} successCallback - La función que se llamará cuando la solicitud tenga éxito.
     * @param {function} errorCallback - La función que se llamará si la solicitud falla.
     */
    sendRequest: function (url, action, data = null, method = 'GET', successCallback = () => { }, errorCallback = () => { }) {
        var xhr = new XMLHttpRequest();
        xhr.open(method, url, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    successCallback(response);
                } else {
                    console.error('Error:', xhr.statusText);
                }
            }
        };
        var encodedData = Object.keys(data).map(function (key) {
            return encodeURIComponent(key) + '=' + encodeURIComponent(data[key]);
        }).join('&');
        xhr.send('action=' + encodeURIComponent(action) + '&' + encodedData);
    },

    /**
     * Envía una solicitud GET.
     * @param {string} url - La URL a la que se enviará la solicitud GET.
     * @param {string} action - La acción específica para la solicitud AJAX.
     * @param {function} successCallback - La función que se llamará cuando la solicitud tenga éxito.
     * @param {function} errorCallback - La función que se llamará si la solicitud falla.
     */
    sendGet: function (url, action, successCallback = () => { }, errorCallback = () => { }) {
        this.sendRequest(url, action, null , 'GET', successCallback, errorCallback);
    },

    /**
     * Envía una solicitud POST.
     * @param {string} url - La URL a la que se enviará la solicitud POST.
     * @param {string} action - La acción específica para la solicitud AJAX.
     * @param {Object} data - Los datos que se enviarán en el cuerpo de la solicitud POST.
     * @param {function} successCallback - La función que se llamará cuando la solicitud tenga éxito.
     * @param {function} errorCallback - La función que se llamará si la solicitud falla.
     */
    sendPost: function (url, action, data, successCallback = () => { }, errorCallback = () => { }) {
        this.sendRequest(url, action, data, 'POST', successCallback, errorCallback);
    }
};
