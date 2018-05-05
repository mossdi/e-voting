<?php

/* @var $speechList \yii\data\ActiveDataProvider */
/* @var $this \yii\web\View */
/* @var $limit int */

use yii\grid\GridView;

try {
    echo GridView::widget([
        'dataProvider' => $speechList,
        'rowOptions' => function($model) {
            return [':class' => '{ completed: checkComplete( ' . $model->id . ' ) }'];
        },
        'layout' => '{items}',
        'columns' => [

            'sort_order',
            'name:html',
            'collective',

        ],
    ]);
} catch (Exception $e) {
    echo 'Выброшено исключение: ', $e->getMessage(), "\n";
}
