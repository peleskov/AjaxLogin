<?php

class AjaxLoginOfficeItemRemoveProcessor extends modObjectProcessor
{
    public $objectType = 'AjaxLoginItem';
    public $classKey = 'AjaxLoginItem';
    public $languageTopics = ['ajaxlogin'];
    //public $permission = 'remove';


    /**
     * @return array|string
     */
    public function process()
    {
        if (!$this->checkPermissions()) {
            return $this->failure($this->modx->lexicon('access_denied'));
        }

        $ids = $this->modx->fromJSON($this->getProperty('ids'));
        if (empty($ids)) {
            return $this->failure($this->modx->lexicon('ajaxlogin_item_err_ns'));
        }

        foreach ($ids as $id) {
            /** @var AjaxLoginItem $object */
            if (!$object = $this->modx->getObject($this->classKey, $id)) {
                return $this->failure($this->modx->lexicon('ajaxlogin_item_err_nf'));
            }

            $object->remove();
        }

        return $this->success();
    }

}

return 'AjaxLoginOfficeItemRemoveProcessor';