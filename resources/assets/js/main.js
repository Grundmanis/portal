var showAdvertSelect = document.getElementById('showAdverts');
if (showAdvertSelect) {
    showAdvertSelect.onchange = function (e) {
        var urlSplit = window.location.href.split('show/'),
            currentUrl = urlSplit[0],
            getParams = '',
            url = 'show/';

        if (urlSplit[1]) {
            getParams = urlSplit[1].split('?');
        }

        window.location.href = currentUrl + url + this.value + (getParams[1] ? '?' + getParams : '');
    };
}