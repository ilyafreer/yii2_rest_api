<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property int $news_category_id
 * @property string|null $title
 * @property string|null $content
 *
 * @property NewsCategory $newsCategory
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['news_category_id'], 'required'],
            [['news_category_id'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['news_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => NewsCategory::className(), 'targetAttribute' => ['news_category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'news_category_id' => 'News Category ID',
            'title' => 'Название',
            'content' => 'Содержание',
        ];
    }

    /**
     * Gets query for [[NewsCategory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNewsCategory()
    {
        return $this->hasOne(NewsCategory::className(), ['id' => 'news_category_id']);
    }
}
