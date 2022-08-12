Ext.onReady(function () {
    AjaxLogin.config.connector_url = OfficeConfig.actionUrl;

    var grid = new AjaxLogin.panel.Home();
    grid.render('office-ajaxlogin-wrapper');

    var preloader = document.getElementById('office-preloader');
    if (preloader) {
        preloader.parentNode.removeChild(preloader);
    }
});