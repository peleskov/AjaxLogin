AjaxLogin.page.Home = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        components: [{
            xtype: 'ajaxlogin-panel-home',
            renderTo: 'ajaxlogin-panel-home-div'
        }]
    });
    AjaxLogin.page.Home.superclass.constructor.call(this, config);
};
Ext.extend(AjaxLogin.page.Home, MODx.Component);
Ext.reg('ajaxlogin-page-home', AjaxLogin.page.Home);