--------------------
AjaxLogin
--------------------
Authors:
    Sergei Peleskov <info@s1temaker.ru>
    Artem Ujakov <artem-uzhakov@mail.ru>
--------------------

Login + Ajax Extra for MODx Revolution.

1 После установки пакета нажно создать три страницы и назначить им шаблоны 
    - AjaxLogin_Template
    - AjaxLogin_ResetPass_Template
    - AjaxLogin_RegConfirm_Template
2 На странице с шаблоном AjaxLogin_Template в сниппетах указать верные id страниц
    - loginResourceId
    - resetResourceId
    - activationResourceId
3 В чанке tpl.login указать верный id страницы
    - redirectID

4 Закоментировать строку в ../core/components/login/controllers/web/Login.php
    //$this->modx->sendRedirect($this->modx->getOption('site_url'));

5 Создать группу пользователей Users