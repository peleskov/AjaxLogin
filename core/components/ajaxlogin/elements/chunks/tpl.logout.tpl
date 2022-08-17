<h4 class="text-center">Account</h4>
<p>Hello, {$_modx->user.fullname}</p>
<div class="avatar-box d-flex align-items-center justify-content-center" style="max-width: 50px;max-height: 50px;">
    <img src="{$_modx->user.photo}" alt="">
</div>
<a href="{11 | url :[]:['service' => 'logout']}" title="Logout">Logout</a>
<hr>
{'!AjaxForm' | snippet : [
'snippet' => 'AjaxLogin',
'service' => 'changepass',
'form' => 'tpl.profile.pwd_update.form',
'submitVar' => 'changepwd-btn',
'validateOldPassword' => '1',
'successMsg' => 'Password changed successfully',
'successModalID' => 'successChangePassModal',
'errorModalID' => 'errorModal',
'errorMsg' => 'The form contains errors, please try again.'
]}
{include 'tpl.profile.pwd_update.modal.success'}
<hr>
{'!AjaxForm' | snippet : [
'snippet' => 'AjaxLogin',
'service' => 'updateprof',
'form' => 'tpl.profile.update.form',
'submitVar' => 'updateprofile-btn',
'thumbW' => '150',
'thumbH' => '150',
'thumbZC' => '1',
'thumbQ' => '80',
'avatarsDirPath' => $_modx->config.assets_path~'avatars/',
'imageBlock' => '.avatar-box',
'allowedFields' => 'fullname,email,mobilephone,address,website,photo,comment',
'validate' => 'fullname:required:minLength=^5^,email:required:email',
'successMsg' => 'Profile update successfully',
'successModalID' => 'successUpdateProfileModal',
'errorModalID' => 'errorModal',
'errorMsg' => 'The form contains errors, please try again.'
]}
{include 'tpl.profile.update.modal.success'}
