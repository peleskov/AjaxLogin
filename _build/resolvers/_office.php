<?php
/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
    $modx =& $transport->xpdo;
    /** @var Office $office */
    if ($Office = $modx->getService('Office', 'Office', MODX_CORE_PATH . 'components/office/model/office/')) {
        if (!($Office instanceof Office)) {
            $modx->log(xPDO::LOG_LEVEL_ERROR, '[AjaxLogin] Could not register paths for Office component!');

            return true;
        } elseif (!method_exists($Office, 'addExtension')) {
            $modx->log(xPDO::LOG_LEVEL_ERROR,
                '[AjaxLogin] You need to update Office for support of 3rd party packages!');

            return true;
        }

        /** @var array $options */
        switch ($options[xPDOTransport::PACKAGE_ACTION]) {
            case xPDOTransport::ACTION_INSTALL:
            case xPDOTransport::ACTION_UPGRADE:
                $Office->addExtension('AjaxLogin', '[[++core_path]]components/ajaxlogin/controllers/office/');
                $modx->log(xPDO::LOG_LEVEL_INFO, '[AjaxLogin] Successfully registered AjaxLogin as Office extension!');
                break;

            case xPDOTransport::ACTION_UNINSTALL:
                $Office->removeExtension('AjaxLogin');
                $modx->log(xPDO::LOG_LEVEL_INFO, '[AjaxLogin] Successfully unregistered AjaxLogin as Office extension.');
                break;
        }
    }
}

return true;