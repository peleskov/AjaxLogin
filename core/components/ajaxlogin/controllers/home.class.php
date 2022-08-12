<?php

/**
 * The home manager controller for AjaxLogin.
 *
 */
class AjaxLoginHomeManagerController extends modExtraManagerController
{
    /** @var AjaxLogin $AjaxLogin */
    public $AjaxLogin;


    /**
     *
     */
    public function initialize()
    {
        $this->AjaxLogin = $this->modx->getService('AjaxLogin', 'AjaxLogin', MODX_CORE_PATH . 'components/ajaxlogin/model/');
        parent::initialize();
    }


    /**
     * @return array
     */
    public function getLanguageTopics()
    {
        return ['ajaxlogin:default'];
    }


    /**
     * @return bool
     */
    public function checkPermissions()
    {
        return true;
    }


    /**
     * @return null|string
     */
    public function getPageTitle()
    {
        return $this->modx->lexicon('ajaxlogin');
    }


    /**
     * @return void
     */
    public function loadCustomCssJs()
    {
        $this->addCss($this->AjaxLogin->config['cssUrl'] . 'mgr/main.css');
        $this->addJavascript($this->AjaxLogin->config['jsUrl'] . 'mgr/ajaxlogin.js');
        $this->addJavascript($this->AjaxLogin->config['jsUrl'] . 'mgr/misc/utils.js');
        $this->addJavascript($this->AjaxLogin->config['jsUrl'] . 'mgr/misc/combo.js');
        $this->addJavascript($this->AjaxLogin->config['jsUrl'] . 'mgr/widgets/items.grid.js');
        $this->addJavascript($this->AjaxLogin->config['jsUrl'] . 'mgr/widgets/items.windows.js');
        $this->addJavascript($this->AjaxLogin->config['jsUrl'] . 'mgr/widgets/home.panel.js');
        $this->addJavascript($this->AjaxLogin->config['jsUrl'] . 'mgr/sections/home.js');

        $this->addHtml('<script type="text/javascript">
        AjaxLogin.config = ' . json_encode($this->AjaxLogin->config) . ';
        AjaxLogin.config.connector_url = "' . $this->AjaxLogin->config['connectorUrl'] . '";
        Ext.onReady(function() {MODx.load({ xtype: "ajaxlogin-page-home"});});
        </script>');
    }


    /**
     * @return string
     */
    public function getTemplateFile()
    {
        $this->content .= '<div id="ajaxlogin-panel-home-div"></div>';

        return '';
    }
}