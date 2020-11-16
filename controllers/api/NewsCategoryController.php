<?php


namespace app\controllers\api;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;

class NewsCategoryController extends ActiveController
{
    public $modelClass = 'app\models\NewsCategoryApi';

    public function behaviors()
    {

        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
            'tokenParam'=>'access_token'
        ];
        return $behaviors;
    }
}