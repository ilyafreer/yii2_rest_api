<?php


namespace app\models;


class NewsCategoryApi extends NewsCategory
{
    /**
     * Переопределяю список возвращаемых полей
     * @return array
     */
    public function fields()
    {
        $fields =  parent::fields();
        unset($fields['parent_id']);
        return $fields;
    }
}