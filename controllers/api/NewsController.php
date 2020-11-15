<?php


namespace app\controllers\api;

use app\models\News;
use app\models\NewsCategory;
use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;

/**
 * Предоставляет доспут к списку новостей
 * Class ApiController
 * @package app\controllers
 */
class NewsController extends ActiveController
{
    public $modelClass = 'app\models\NewsApi';

    public function behaviors()
    {

        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
            'tokenParam'=>'access_token'
        ];
        return $behaviors;
    }

    /**
     * Возвращает все новости по категории с учетом вложенных категорий
     * @param int $id
     * @return array|\yii\db\ActiveRecord[]
     */
    public function actionListByCategoryId(int $id)
    {
        $categories = NewsCategory::find()->all();
        $currentCategoryId = empty($id) ? 0 : NewsCategory::findOne($id)->id;
        $result = NewsCategory::getRootCategories($categories);
        $tree = NewsCategory::buildCategoriesTree($result, $currentCategoryId);
        $ids = [$currentCategoryId];
        if ($tree) {
            $tree = array_shift($tree);
            $ids = array_merge($ids, NewsCategory::getBranchIds($tree));
        }
        $newsList = News::find()->where(['in', 'news_category_id', $ids])->all();
        return $newsList;
    }
}