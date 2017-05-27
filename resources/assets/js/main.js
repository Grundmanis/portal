var showAdvertSelect = document.getElementById('showAdverts');
if (showAdvertSelect) {
    showAdvertSelect.onchange = function (e) {
        var currentUrl = window.location.href.split('?')[0];
        window.location.href = currentUrl + '?show=' + this.value;
    };
}