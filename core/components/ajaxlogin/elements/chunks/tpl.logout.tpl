<h4 class="text-center">Account</h4>
<p>Hello, {$_modx->user.fullname}</p>
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