<?php

class AjaxLoginOfficeItemCreateProcessor extends modObjectCreateProcessor
{
    public $objectType = 'AjaxLoginItem';
    public $classKey = 'AjaxLoginItem';
    public $languageTopics = ['ajaxlogin'];
    //public $permission = 'create';


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $name = trim($this->getProperty('name'));
        if (empty($name)) {
            $this->modx->error->addField('name', $this->modx->lexicon('ajaxlogin_item_err_name'));
        } elseif ($this->modx->getCount($this->classKey, ['name' => $name])) {
            $this->modx->error->addField('name', $this->modx->lexicon('ajaxlogin_item_err_ae'));
        }

        return parent::beforeSet();
    }

}

return 'AjaxLoginOfficeItemCreateProcessor';