<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news_category".
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $title
 *
 * @property News[] $news
 */
class NewsCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Родительский номер категории',
            'title' => 'Название',
        ];
    }

    /**
     * Gets query for [[News]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['news_category_id' => 'id']);
    }

    /**
     * Формирует двумерных массив на основе родительской категории
     * @param array $categories
     * @return array
     */
    public static function getRootCategories(array $categories):array
    {
        $result = [];
        foreach ($categories as $category){
            $result[$category->parent_id][] = $category;
        }
        return $result;
    }

    /**
     * Рекурсивно строит дерево категорий новостей
     * @param array $allCategories
     * @param int $parentId ID родительской категории с которойнужно начать ветку
     * @return array
     */
    public static function buildCategoriesTree(array $allCategories, int $parentId):array
    {
        $tree = [];
        if (is_array($allCategories) && isset($allCategories[$parentId])) {
            foreach ($allCategories[$parentId] as $cat) {
                $tree[$cat->parent_id][$cat->id] = [
                    'id'=>$cat->id,
                    'title'=>$cat->title,
                    'children'=> []
                ];
                $children = self::buildCategoriesTree($allCategories, $cat->id);
                if($children){
                    $children = array_shift($children);
                    $tree[$cat->parent_id][$cat->id] = [
                        'id'=>$cat->id,
                        'title'=>$cat->title,
                        'children'=> $children
                    ];
                }
            }
        }
        return $tree;
    }

    /**
     * Возвращает массив из id по ветке категорий
     * @param array $branch
     * @return array
     */
    public static function getBranchIds(array $branch):array
    {
        $result = [];
        foreach ($branch as $category){
            if(!empty($category['id'])){
                $result[] = $category['id'];
            }
            if(!empty($category['children'])){
                $result = array_merge($result, self::getBranchIds($category['children']));
            }
        }
        return $result;
    }
}
