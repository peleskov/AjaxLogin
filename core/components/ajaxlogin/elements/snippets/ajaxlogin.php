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
            return $AjaxForm->error('', array('result' => false, 'service' => $service, 'message' => $scriptProperties['errorMsg'], 'modalID' => $scriptProperties['errorModalID'], 'errors' => $errors));
        } else return $AjaxForm->success('', array('result' => true, 'service' => $service, 'message' => $scriptProperties['successMsg'], 'modalID' => $scriptProperties['successModalID']));
        break;
    case 'login':
        /*
            Важно!!!
            Закоментировать строку в ../core/components/login/controllers/web/Login.php
            //$this->modx->sendRedirect($this->modx->getOption('site_url'));
        */
        $modx->runSnippet('Login');
        foreach ($modx->placeholders as $key => $ph) {
            if (strpos($key, 'errors') === 0) $placeholders[$key] = $ph;
        }
        if ($placeholders['errors']){
            $errors = array(
                'username' => '',
                'password' => $scriptProperties['errorMsg']
            );
            return $AjaxForm->error('', array('result' => false, 'service' => $service, 'message' => $scriptProperties['errorMsg'], 'modalID' => $scriptProperties['errorModalID'], 'errors' => $errors));
        } 
        else return $AjaxForm->success('', array('result' => true, 'service' => $service, 'location' => $modx->makeUrl($scriptProperties['redirectID'])));
        break;
    case 'forgotpass':
        $scriptProperties['tpl'] = 'error';
        $scriptProperties['tplType'] = 'inline';
        $modx->setPlaceholder('email', $_POST['email']);
        if ($modx->runSnippet('ForgotPassword', $scriptProperties) == 'error') return $AjaxForm->error($errorMsg, array('service' => $service, 'errors' => array('email' => $errorMsg)));
        else return $AjaxForm->success('email send', array('service' => $service, 'message' => $modx->getChunk($sentTpl)));
        break;
    case 'ressetpass':
        if (!$modx->user->isAuthenticated()) {
            $scriptProperties['tpl'] = 'success';
            $scriptProperties['tplType'] = 'inline';
            $result = $modx->runSnippet('ResetPassword', $scriptProperties);
            if ($result == 'success') {
                $url = $modx->makeUrl(15);
                return $modx->sendRedirect($url, array('responseCode' => 'HTTP/1.1 301 Moved Permanently'));
            } else return $result;
        } else {
            $url = $modx->makeUrl(15);
            return $modx->sendRedirect($url, array('responseCode' => 'HTTP/1.1 301 Moved Permanently'));
        }
        break;
    case 'changepass':
        if (empty($scriptProperties['placeholderPrefix'])) $scriptProperties['placeholderPrefix'] = 'cp.';
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
            return $AjaxForm->error($modx->lexicon('login.password_err_change'), array('service' => $service, 'errors' => $errors));
        } else { //SUCCESS
            return $AjaxForm->success($modx->lexicon('login.password_changed'), array('service' => $service, 'submitVar' => $scriptProperties['submitVar']));
        }
        break;
    case 'updateprof':
        if (empty($scriptProperties['placeholderPrefix'])) $scriptProperties['placeholderPrefix'] = 'up.';
        $scriptProperties['reloadOnSuccess'] = '0';
        $scriptProperties['redirectToLogin'] = '0';
        if (isset($_FILES['photo']) && !empty($_FILES['photo'])) { //update photo
            if ($ms = $modx->getObject('modMediaSource', 4)) {
                $ms_prop = $ms->getProperties();
                $ms_path = $ms_prop['basePath']['value'];
            }
            if (!$ms_path) {
                $ms_path = MODX_ASSETS_PATH;
            }
            $dirPhoto = MODX_BASE_PATH . $ms_path . 'avatars/usr_'  . $modx->user->get('id');
            if (!file_exists($dirPhoto)) mkdir($dirPhoto, 0755, true);
            $extPhoto = mb_strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
            if (
                is_uploaded_file($_FILES['photo']['tmp_name'])
                && !$_FILES['photo']['error']
                && in_array($extPhoto, array('jpg', 'png', 'jpeg'))
            ) {
                array_map("unlink", glob($dirPhoto . '/user' . $modx->user->get('id') . '_*')); //delete old user photo
                $newPhotoName = 'user' . $modx->user->get('id') . '_' . rand() . '.' . $extPhoto;
                $newPhotoPath = $dirPhoto . '/' . $newPhotoName;
                if (move_uploaded_file($_FILES['photo']['tmp_name'], $newPhotoPath)) {
                    require_once MODX_CORE_PATH . 'model/phpthumb/phpthumb.class.php';
                    $phpThumb = new phpThumb();
                    $phpThumb->setSourceFilename($newPhotoPath);
                    $phpThumb->setParameter('w', $thumbW);
                    $phpThumb->setParameter('h', $thumbH);
                    $phpThumb->setParameter('zc', $thumbZC);
                    $phpThumb->setParameter('q', $thumbQ);
                    $newPhoto = $ms_path . 'avatars/usr_' . $modx->user->get('id') . '/' . $newPhotoName;
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
            return $AjaxForm->error($modx->lexicon('custLogin.errors_inform'), array('service' => $service, 'errors' => $errors));
        } else { //SUCCESS $AjaxForm->success not used because ajaxform default.js has form[0].reset()
            foreach ($placeholders as $key => $ph) {
                if (in_array(str_replace($scriptProperties['placeholderPrefix'], '', $key), $fields)) $values[str_replace($scriptProperties['placeholderPrefix'], '', $key)] = $ph;
            }
            $array = array('service' => $service, 'success' => 1, 'submitVar' => $scriptProperties['submitVar']);
            if ($newPhoto) $array['nPh'] = $newPhoto;
            return $AjaxForm->error($placeholders['error.message'], $array);
        }
        break;
    default:
        return 'Error';
        break;
}
