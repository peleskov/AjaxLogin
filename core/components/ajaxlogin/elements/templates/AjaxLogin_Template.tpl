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
    {include 'tpl.signup.success.modal'}
    {include 'tpl.error.modal'}
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
    <section class="mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-4">
                    {'!Login' | snippet : [
                    'tplType' => 'modChunk',
                    'logoutTpl' => 'tpl.logout',
                    'loginTpl' => 'tpl.login',
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
                    'form' => 'tpl.signup.form',
                    'usernameField' => 'email',
                    'passwordField' => 'password',
                    'usergroups' => 'Users',
                    'activation' => 1,
                    'activationResourceId' => 12,
                    'activationEmailSubject' => 'Confirmation of registration',
                    'activationEmailTpl' => 'tpl.signup.activation.email',
                    'successMsg' => 'You have successfully registered.',
                    'errorMsg' => 'The form contains errors, please try again.',
                    'successModalID' => 'successSignupModal',
                    'errorModalID' => 'errorModal',
                    'validate' => 'nospam:blank,
                    fullname:required:minLength=^3^,
                    email:required:email,
                    mobilephone:required,
                    password:required:minLength=^8^,
                    password_confirm:password_confirm=^password^',
                    ]}
                </div>
            </div>
        </div>
    </section>


    <link rel="stylesheet" href="{$_modx->config.assets_url}theme/apps/bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{$_modx->config.assets_url}components/ajaxlogin/apps/scrollbar/jquery.scrollbar.css">
    <link rel="stylesheet" href="{$_modx->config.assets_url}components/ajaxlogin/apps/select2/select2.min.css">
    <link rel="stylesheet" href="{$_modx->config.assets_url}components/ajaxlogin/css/style.min.css">

    <script src="{$_modx->config.assets_url}theme/apps/jquery/jquery-3.6.0.min.js"></script>
    <script src="{$_modx->config.assets_url}theme/apps/bootstrap-4.5.3-dist/js/popper.min.js"></script>
    <script src="{$_modx->config.assets_url}theme/apps/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
    <script src="{$_modx->config.assets_url}components/ajaxlogin/apps/inputmask/jquery.inputmask.min.js"></script>
    <script src="{$_modx->config.assets_url}components/ajaxlogin/apps/scrollbar/jquery.scrollbar.min.js"></script>
    <script src="{$_modx->config.assets_url}components/ajaxlogin/apps/select2/select2.full.min.js"></script>
    <script src="{$_modx->config.assets_url}components/ajaxlogin/js/script.min.js"></script>
    <script src="{$_modx->config.assets_url}components/ajaxlogin/js/ajaxlogin_script.min.js"></script>
</body>

</html>