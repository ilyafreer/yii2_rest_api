<?php


namespace app\models;


use yii\web\Linkable,
    yii\web\Link,
    yii\helpers\Url;

class NewsApi extends News implements Linkable
{
    /**
     * Переопределяю список возвращаемых полей
     * @return array
     */
    public function fields()
    {
        $fields =  parent::fields();
        unset($fields['news_category_id']);
        return $fields;
    }

    public function getLinks()
    {
        return [
            Link::REL_SELF => Url::to(['api/news/view', 'id' => $this->id], true),
        ];
    }

}