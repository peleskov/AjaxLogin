<?php
if (file_exists(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php')) {
    /** @noinspection PhpIncludeInspection */
    require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
} else {
    require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.core.php';
}
/** @noinspection PhpIncludeInspection */
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CONNECTORS_PATH . 'index.php';
/** @var AjaxLogin $AjaxLogin */
$AjaxLogin = $modx->getService('AjaxLogin', 'AjaxLogin', MODX_CORE_PATH . 'components/ajaxlogin/model/');
$modx->lexicon->load('ajaxlogin:default');

// handle request
$corePath = $modx->getOption('ajaxlogin_core_path', null, $modx->getOption('core_path') . 'components/ajaxlogin/');
$path = $modx->getOption('processorsPath', $AjaxLogin->config, $corePath . 'processors/');
$modx->getRequest();

/** @var modConnectorRequest $request */
$request = $modx->request;
$request->handleRequest([
    'processors_path' => $path,
    'location' => '',
]);