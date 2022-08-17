<?php

return [
    'web' => [
        'ajaxlogin-example' => [
            'pagetitle' => 'AjaxLogin Example',
            'template' => 'AjaxLogin_Template',
            'hidemenu' => true,
            'published' => true,
            'resources' => [
                'ajaxlogin-regconfirm' => [
                    'pagetitle' => 'AjaxLogin Registration Confirm',
                    'template' => 'AjaxLogin_RegConfirm_Template',
                    'hidemenu' => true,
                    'published' => true,
                ],
                'ajaxlogin-resetpassword' => [
                    'pagetitle' => 'AjaxLogin Reset Password',
                    'template' => 'AjaxLogin_ResetPass_Template',
                    'hidemenu' => true,
                    'published' => true,
                ],
            ]
        ],
    ],
];
