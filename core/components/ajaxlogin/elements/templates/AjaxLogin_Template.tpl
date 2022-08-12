<!doctype html>
<html lang="en">

<head>
    <title>[[*pagetitle]] / [[++site_name]]</title>
    <base href="[[!++site_url]]" />
    <meta charset="[[++modx_charset]]" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" href="{$_modx->config.assets_url}theme/apps/bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{$_modx->config.assets_url}components/ajaxlogin/css/style.min.css">
</head>

<body>
    <section class="pt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col">
                    <h2 class="text-center mb-4">AjaxLogin example</h2>
                </div>
            </div>
        </div>
    </section>
    <section class="mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-4">
                    {'!AjaxForm'|snippet:[
                    'snippet' => 'AjaxLogin',
                    'service' => 'signin',
                    'errTpl' => 'tpl.signin.modal.error',
                    'form' => 'tpl.signin.form',
                    ]}
                </div>
            </div>
        </div>
    </section>
    <section class="mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-4">
                    {'!AjaxForm'|snippet:[
                    'snippet' => 'AjaxLogin',
                    'service' => 'signup',
                    'errTpl' => 'tpl.signup.modal.error',
                    'form' => 'tpl.signup.form',
                    ]}
                </div>
            </div>
        </div>
    </section>
    <section class="mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-4">
                    {'!AjaxForm'|snippet:[
                    'snippet' => 'AjaxLogin',
                    'service' => 'forgot',
                    'errTpl' => 'tpl.forgot.modal.error',
                    'form' => 'tpl.forgot.form',
                    ]}
                </div>
            </div>
        </div>
    </section>
    
    <link rel="stylesheet" href="{$_modx->config.assets_url}components/ajaxlogin/apps/bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{$_modx->config.assets_url}components/ajaxlogin/apps/scrollbar/jquery.scrollbar.css">
    <link rel="stylesheet" href="{$_modx->config.assets_url}components/ajaxlogin/apps/select2/select2.min.css">
    <link rel="stylesheet" href="{$_modx->config.assets_url}components/ajaxlogin/css/style.min.css">
    
    <script src="{$_modx->config.assets_url}components/ajaxlogin/apps/jquery/jquery-3.6.0.min.js"></script>
    <script src="{$_modx->config.assets_url}components/ajaxlogin/apps/bootstrap-4.5.3-dist/js/popper.min.js"></script>
    <script src="{$_modx->config.assets_url}components/ajaxlogin/apps/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
    <script src="{$_modx->config.assets_url}components/ajaxlogin/apps/inputmask/jquery.inputmask.min.js"></script>
    <script src="{$_modx->config.assets_url}components/ajaxlogin/apps/scrollbar/jquery.scrollbar.min.js"></script>
    <script src="{$_modx->config.assets_url}components/ajaxlogin/apps/select2/select2.full.min.js"></script>
    <script src="{$_modx->config.assets_url}components/ajaxlogin/js/script.min.js"></script>
</body>

</html>