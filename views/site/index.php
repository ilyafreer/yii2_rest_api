<?php
use yii\helpers\Url;

function renderTree($tree)
{
    foreach ($tree as $branch){
        echo '<ul>';
        echo '<a href="'.Url::to(['news-category/view','id'=>$branch['id']]).'">'.$branch['title'].'</a>';
        if(!empty($branch['children'])){
            renderTree($branch['children']);
        }
        echo '</ul>';
    }
}

//echo '<pre>';var_dump($newsCategoriesTree);die;
    renderTree($newsCategoriesTree);
?>

