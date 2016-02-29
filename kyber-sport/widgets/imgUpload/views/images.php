<?php

use yii\widgets\ListView;
use yii\widgets\Pjax;

$dataProvider = new \yii\data\ArrayDataProvider([
    'allModels' => $images,
    'pagination' => [
        'pageSize' => 10,
    ],
]);
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'layout' => "{summary}\n<div class='items'>{items}</div>\n<div class='pagin'>{pager}</div>",
    'itemOptions' => [
        'tag' => 'span',
        'class' => 'image-item'
    ],
    'itemView' => "_image",
     
]);

?>