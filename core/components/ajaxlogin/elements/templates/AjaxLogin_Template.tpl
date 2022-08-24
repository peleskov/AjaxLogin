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
    {include 'ajaxlogin.signup.modal.success'}
    {include 'ajaxlogin.forgot.modal.success'}
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
                    {'!Login' | snippet : [
                    'tplType' => 'modChunk',
                    'logoutTpl' => 'ajaxlogin.logout',
                    'loginTpl' => 'ajaxlogin.login',
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
                    'service' => 'forgotpass',
                    'loginResourceId' => 14,
                    'resetResourceId' => 16,
                    'successModalID' => 'successForgotModal',
                    'successMsg' => 'Password recovery instructions have been sent to your email.',
                    'errorMsg' => 'Email was not found in the database.',
                    'errorModalID' => 'errorModal',
                    'form' => 'ajaxlogin.forgot.form',
                    'emailTpl' => 'ajaxlogin.forgot.email',
                    'emailSubject' => 'Password recovery instructions'
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
                    'form' => 'ajaxlogin.signup.form',
                    'usernameField' => 'email',
                    'passwordField' => 'password',
                    'usergroups' => 'Users',
                    'activation' => 1,
                    'activationResourceId' => 15,
                    'activationEmailSubject' => 'Confirmation of registration',
                    'activationEmailTpl' => 'ajaxlogin.signup.activation.email',
                    'successMsg' => 'You have successfully registered.',
                    'errorMsg' => 'The form contains errors, please try again.',
                    'successModalID' => 'successSignupModal',
                    'errorModalID' => 'errorModal',
                    'validate' => 'nospam:blank,
                    fullname:required:minLength=^5^,
                    email:required:email,
                    mobilephone:required,
                    password:required:minLength=^8^,
                    password_confirm:password_confirm=^password^',
                    ]}
                </div>
            </div>
        </div>
    </section>

    {include 'ajaxlogin.stylesheet'}
    {include 'ajaxlogin.script'}
</body>

</html>