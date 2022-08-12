AjaxLogin.panel.Home = function (config) {
    config = config || {};
    Ext.apply(config, {
        baseCls: 'modx-formpanel',
        layout: 'anchor',
        /*
         stateful: true,
         stateId: 'ajaxlogin-panel-home',
         stateEvents: ['tabchange'],
         getState:function() {return {activeTab:this.items.indexOf(this.getActiveTab())};},
         */
        hideMode: 'offsets',
        items: [{
            html: '<h2>' + _('ajaxlogin') + '</h2>',
            cls: '',
            style: {margin: '15px 0'}
        }, {
            xtype: 'modx-tabs',
            defaults: {border: false, autoHeight: true},
            border: true,
            hideMode: 'offsets',
            items: [{
                title: _('ajaxlogin_items'),
                layout: 'anchor',
                items: [{
                    html: _('ajaxlogin_intro_msg'),
                    cls: 'panel-desc',
                }, {
                    xtype: 'ajaxlogin-grid-items',
                    cls: 'main-wrapper',
                }]
            }]
        }]
    });
    AjaxLogin.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(AjaxLogin.panel.Home, MODx.Panel);
Ext.reg('ajaxlogin-panel-home', AjaxLogin.panel.Home);
