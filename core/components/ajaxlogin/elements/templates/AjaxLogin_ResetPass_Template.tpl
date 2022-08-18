<!doctype html>
<html lang="en">

<head>
    <title>{$_modx->resource.pagetitle~' / '~$_modx->config.site_name}</title>
    <base href="{$_modx->config.site_url}" />
    <meta charset="{$_modx->config.modx_charset}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
</head>

<body>
    {include 'ajaxlogin.modal.error'}
    <section class="mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col">
                    <h2 class="text-center mb-4">{$_modx->resource.pagetitle}</h2>
                </div>
            </div>
        </div>
    </section>
    <section class="mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-4">
                    {'!AjaxLogin' | snippet : [
                    'service' => 'ressetpass',
                    'expiredTpl' => 'ajaxlogin.ressetpass.expired',
                    'tpl' => 'ajaxlogin.ressetpass.change',
                    'loginResourceId' => 14,
                    'autoLogin' => 0,
                    ]}
                </div>
            </div>
        </div>
    </section>

    {include 'ajaxlogin.stylesheet'}
    {include 'ajaxlogin.script'}
</body>

</html>