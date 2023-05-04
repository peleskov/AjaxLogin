<?php
switch ($service) {
    case 'signup':
        if (empty($scriptProperties['placeholderPrefix'])) $scriptProperties['placeholderPrefix'] = 'su.';
        $modx->runSnippet('Register', $scriptProperties);
        foreach ($modx->placeholders as $key => $ph) {
            $placeholders[$key] = $ph;
        }
        if ($modx->getPlaceholder($scriptProperties['placeholderPrefix'] . 'validation_error')) {
            foreach ($placeholders as $key => $ph) {
                if (strpos($key, $scriptProperties['placeholderPrefix'] . 'error.') === 0) $errors[str_replace($scriptProperties['placeholderPrefix'] . 'error.', '', $key)] = trim(strip_tags($ph));
            }
            return $AjaxForm->error('', array('service' => 'ajaxlogin', 'result' => false, 'message' => $scriptProperties['errorMsg'], 'modalID' => $scriptProperties['errorModalID'], 'errors' => $errors));
        } else return $AjaxForm->success('', array('service' => 'ajaxlogin', 'result' => true, 'message' => $scriptProperties['successMsg'], 'modalID' => $scriptProperties['successModalID']));
        break;
    case 'login':
        /*
            Важно!!!
            Закоментировать строку в ../core/components/login/controllers/web/Login.php
            //$this->modx->sendRedirect($this->modx->getOption('site_url'));
        */
        $modx->runSnippet('Login', $scriptProperties);
        foreach ($modx->placeholders as $key => $ph) {
            if (strpos($key, 'errors') === 0) $placeholders[$key] = $ph;
        }
        if ($placeholders['errors']) {
            $errors = array(
                'username' => '',
                'password' => $scriptProperties['errorMsg']
            );
            return $AjaxForm->error('', array('service' => 'ajaxlogin', 'result' => false, 'message' => $scriptProperties['errorMsg'], 'modalID' => $scriptProperties['errorModalID'], 'errors' => $errors));
        } else return $AjaxForm->success('', array('service' => 'ajaxlogin', 'result' => true, 'location' => $modx->makeUrl($scriptProperties['redirectID'])));
        break;
    case 'forgotpass':
        $scriptProperties['tpl'] = 'error';
        $scriptProperties['tplType'] = 'inline';
        $modx->setPlaceholder('email', $_POST['email']);
        if ($modx->runSnippet('ForgotPassword', $scriptProperties) == 'error') {
            $errors = array(
                'email' => $scriptProperties['errorMsg'],
            );
            return $AjaxForm->error('', array('service' => 'ajaxlogin', 'result' => false, 'message' => $scriptProperties['errorMsg'], 'modalID' => $scriptProperties['errorModalID'], 'errors' => $errors));
        } else return $AjaxForm->success('', array('service' => 'ajaxlogin', 'result' => true, 'message' => $scriptProperties['successMsg'], 'modalID' => $scriptProperties['successModalID']));
        break;
    case 'ressetpass':
        $result = $modx->runSnippet('ResetPassword', $scriptProperties);
        $url = $modx->makeUrl($scriptProperties['loginResourceId']);
        if (!$modx->user->isAuthenticated()) {
            $scriptProperties['tpl'] = 'success';
            $scriptProperties['tplType'] = 'inline';
            if ($result == 'success') {
                return $modx->sendRedirect($url, array('responseCode' => 'HTTP/1.1 301 Moved Permanently'));
            } else
                return $result;
        } else {
            return $modx->sendRedirect($url, array('responseCode' => 'HTTP/1.1 301 Moved Permanently'));
        }
        break;
    case 'changepass':
        if (empty($scriptProperties['placeholderPrefix'])) $scriptProperties['placeholderPrefix'] = 'cp.';
        $redirectID = $modx->getOption('redirectID', $scriptProperties, 1);
        $scriptProperties['reloadOnSuccess'] = '0';
        $scriptProperties['successMessage'] = '1';
        $modx->runSnippet('ChangePassword', $scriptProperties);
        foreach ($modx->placeholders as $key => $ph) {
            $placeholders[$key] = $ph;
        }
        if ($placeholders[$scriptProperties['placeholderPrefix'] . 'successMessage'] != '1') { //ERROR
            foreach ($placeholders as $key => $ph) {
                if (strpos($key, $scriptProperties['placeholderPrefix'] . 'error.') === 0) $errors[str_replace($scriptProperties['placeholderPrefix'] . 'error.', '', $key)] = $ph;
            }
            return $AjaxForm->error('', array('service' => 'ajaxlogin', 'result' => false, 'message' => $scriptProperties['errorMsg'], 'modalID' => $scriptProperties['errorModalID'], 'errors' => $errors));
        } else { //SUCCESS
            return $AjaxForm->success('', array('service' => 'ajaxlogin', 'result' => true, 'message' => $scriptProperties['successMsg'], 'modalID' => $scriptProperties['successModalID'], 'submitVar' => $scriptProperties['submitVar'], 'location' => $modx->makeUrl($redirectID)));
        }
        break;
    case 'updateprof':
        if (empty($scriptProperties['placeholderPrefix'])) $scriptProperties['placeholderPrefix'] = 'up.';
        $scriptProperties['reloadOnSuccess'] = '0';
        $scriptProperties['redirectToLogin'] = '0';
        if (isset($_FILES['photo']) && !empty($_FILES['photo'])) { //update photo
            if ($scriptProperties['avatarsDirPath']) {
                $ms_path = $scriptProperties['avatarsDirPath'];
            }
            else{
                $ms_path = MODX_ASSETS_PATH . 'avatars/';
            }
            if (!file_exists($ms_path)) mkdir($ms_path, 0755, true);
            $extPhoto = mb_strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
            if (
                is_uploaded_file($_FILES['photo']['tmp_name'])
                && !$_FILES['photo']['error']
                && in_array($extPhoto, array('jpg', 'png', 'jpeg'))
            ) {
                array_map("unlink", glob($ms_path . 'user' . $modx->user->get('id') . '_*')); //delete old user photo
                $newPhotoName = 'user' . $modx->user->get('id') . '_' . rand() . '.' . $extPhoto;
                $newPhotoPath = $ms_path . $newPhotoName;
                if (move_uploaded_file($_FILES['photo']['tmp_name'], $newPhotoPath)) {
                    require_once MODX_CORE_PATH . 'model/phpthumb/phpthumb.class.php';
                    $phpThumb = new phpThumb();
                    $phpThumb->setSourceFilename($newPhotoPath);
                    $phpThumb->setParameter('w', $thumbW);
                    $phpThumb->setParameter('h', $thumbH);
                    $phpThumb->setParameter('zc', $thumbZC);
                    $phpThumb->setParameter('q', $thumbQ);
                    $newPhoto = str_replace(MODX_BASE_PATH, '', $newPhotoPath);
                    if ($phpThumb->GenerateThumbnail()) if ($phpThumb->RenderToFile($newPhotoPath)) $_FILES['photo'] = $newPhoto;
                }
            }
        } else $_FILES['photo'] = $modx->user->getOne('Profile')->get('photo');
        $modx->runSnippet('UpdateProfile', $scriptProperties);
        foreach ($modx->placeholders as $key => $ph) {
            $placeholders[$key] = $ph;
        }
        if (!$placeholders['login.update_success']) { //ERROR
            foreach ($placeholders as $key => $ph) {
                if (strpos($key, $scriptProperties['placeholderPrefix'] . 'error.') === 0) $errors[str_replace($scriptProperties['placeholderPrefix'] . 'error.', '', $key)] = trim(strip_tags($ph));
            }
            return $AjaxForm->error('', array('service' => 'ajaxlogin', 'result' => false,'message' => $scriptProperties['errorMsg'], 'modalID' => $scriptProperties['errorModalID'], 'errors' => $errors));
        } else { //SUCCESS $AjaxForm->success not used because ajaxform default.js has form[0].reset()
            foreach ($placeholders as $key => $ph) {
                if (in_array(str_replace($scriptProperties['placeholderPrefix'], '', $key), $fields)) $values[str_replace($scriptProperties['placeholderPrefix'], '', $key)] = $ph;
            }
            $array = array('service' => 'ajaxlogin', 'result' => true, 'imageBlock' => $scriptProperties['imageBlock'], 'message' => $scriptProperties['successMsg'], 'modalID' => $scriptProperties['successModalID'], 'submitVar' => $scriptProperties['submitVar']);
            if ($newPhotoPath) $array['avatar'] = $newPhoto;
            return $AjaxForm->error($placeholders['error.message'], $array);
        }
        break;
    default:
        return 'Error';
        break;
}
