var AjaxLogin = function (config) {
    config = config || {};
    AjaxLogin.superclass.constructor.call(this, config);
};
Ext.extend(AjaxLogin, Ext.Component, {
    page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {}
});
Ext.reg('ajaxlogin', AjaxLogin);

AjaxLogin = new AjaxLogin();