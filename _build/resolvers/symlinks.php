<?php
/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
    $modx =& $transport->xpdo;

    $dev = MODX_BASE_PATH . 'Extras/AjaxLogin/';
    /** @var xPDOCacheManager $cache */
    $cache = $modx->getCacheManager();
    if (file_exists($dev) && $cache) {
        if (!is_link($dev . 'assets/components/ajaxlogin')) {
            $cache->deleteTree(
                $dev . 'assets/components/ajaxlogin/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_ASSETS_PATH . 'components/ajaxlogin/', $dev . 'assets/components/ajaxlogin');
        }
        if (!is_link($dev . 'core/components/ajaxlogin')) {
            $cache->deleteTree(
                $dev . 'core/components/ajaxlogin/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_CORE_PATH . 'components/ajaxlogin/', $dev . 'core/components/ajaxlogin');
        }
    }
}

return true;