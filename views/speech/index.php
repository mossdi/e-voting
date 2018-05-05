<?php

/* @var $this yii\web\View */
/* @var $searchModel app\entities\SpeechSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\grid\GridView;
use app\entities\Speech;

$this->title = 'Список выступлений';

?>

<div class="speech-index">
    <?php try {
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => '{items}',
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'name:html',
                'collective',
                'member',
                [
                    'format' => 'image',
                    'label' => 'Иконка',
                    'value' => function ($model) {
                        return $model->logo ? Yii::getAlias('@web/image/logo/' . $model->logo) : '';
                    },
                ],
                [
                    'attribute' => 'status',
                    'value' => function($model) {
                        return $model->status == Speech::STATUS_ACTIVE ? 'Включено' : 'Отключено';
                    },
                    'filter' =>  Html::activeDropDownList($searchModel, 'status', Speech::$statusList),
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {delete}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                'data-toggle' => 'modal',
                                'data-target' => '#modalForm',
                                'onclick' => 'formLoad(\'/speech/view\', \'Быстрый просмотр\',\'' . $model->id . '\')'
                            ]);
                        },
                        'update' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                'data-toggle' => 'modal',
                                'data-target' => '#modalForm',
                                'onclick' => 'formLoad(\'/speech/update\', \'Быстрое редактрование\',\'' . $model->id . '\')'
                            ]);
                        },
                    ]
                ],
            ],
        ]);
    } catch (Exception $e) {
    } ?>
</div>
