<?php

/* @var $this \yii\web\View */
/* @var $model \app\forms\CriterionForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\rating\StarRating;

?>

<div class="site-criterion">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <?php $form = ActiveForm::begin([
                    'id' => 'criterion-form',
                    'action' => ['/rating/add-rating'],
                    'validationUrl' => ['/rating/criterion-form-validate'],
                    'enableAjaxValidation' => true,
                    'fieldConfig' => [
                        'template' => "{label}\n{input}",
                    ],
                ]); ?>

                <?= $form->field($model, 'efficiency', [
                    'options' => [
                        'class' => 'col-xs-12 criterion-item',
                        'style' => 'background:#cc6600;',
                    ],
                    'template' => '<div class="row"><div class="col-xs-1"><div class="number">1</div></div><div class="col-xs-11"><div class="row"><div class="col-xs-12">{label}</div><div class="col-xs-12">{input}</div></div></div></div>'
                ])
                    ->widget(StarRating::classname(), [
                        'pluginOptions' => [
                            'size'=>'sm',
                            'stars' => 10,
                            'step' => 1,
                            'min' => 0,
                            'max' => 10,
                            'showClear' => false,
                            'starCaptions' => [
                                0  => 'Всё так плохо?',
                                1  => '1 звезда',
                                2  => '2 звезды',
                                3  => '3 звезды',
                                4  => '4 звезды',
                                5  => '5 звёзд',
                                6  => '6 звёзд',
                                7  => '7 звёзд',
                                8  => '8 звёзд',
                                9  => '9 звёзд',
                                10 => '10 звёзд',
                            ],
                        ]
                    ])->label($model->description['efficiency'])  ?>

                <?= $form->field($model, 'newness', [
                    'options' => [
                        'class' => 'col-xs-12 criterion-item',
                        'style' => 'background: #669933;',
                    ],
                    'template' => '<div class="row"><div class="col-xs-1"><div class="number">2</div></div><div class="col-xs-11"><div class="row"><div class="col-xs-12">{label}</div><div class="col-xs-12">{input}</div></div></div></div>'
                ])
                    ->widget(StarRating::classname(), [
                        'pluginOptions' => [
                            'size'=>'sm',
                            'stars' => 10,
                            'step' => 1,
                            'min' => 0,
                            'max' => 10,
                            'showClear' => false,
                            'starCaptions' => [
                                0  => 'Всё так плохо?',
                                1  => '1 звезда',
                                2  => '2 звезды',
                                3  => '3 звезды',
                                4  => '4 звезды',
                                5  => '5 звёзд',
                                6  => '6 звёзд',
                                7  => '7 звёзд',
                                8  => '8 звёзд',
                                9  => '9 звёзд',
                                10 => '10 звёзд',
                            ],
                        ]
                    ])->label($model->description['newness'])  ?>

                <?= $form->field($model, 'originality', [
                    'options' => [
                        'class' => 'col-xs-12 criterion-item',
                        'style' => 'background: #336699;',
                    ],
                    'template' => '<div class="row"><div class="col-xs-1"><div class="number">3</div></div><div class="col-xs-11"><div class="row"><div class="col-xs-12">{label}</div><div class="col-xs-12">{input}</div></div></div></div>'
                ])
                    ->widget(StarRating::classname(), [
                        'pluginOptions' => [
                            'size'=>'sm',
                            'stars' => 10,
                            'step' => 1,
                            'min' => 0,
                            'max' => 10,
                            'showClear' => false,
                            'starCaptions' => [
                                0  => 'Всё так плохо?',
                                1  => '1 звезда',
                                2  => '2 звезды',
                                3  => '3 звезды',
                                4  => '4 звезды',
                                5  => '5 звёзд',
                                6  => '6 звёзд',
                                7  => '7 звёзд',
                                8  => '8 звёзд',
                                9  => '9 звёзд',
                                10 => '10 звёзд',
                            ],
                        ]
                    ])->label($model->description['originality'])  ?>

                <?= $form->field($model, 'reliability', [
                    'options' => [
                        'class' => 'col-xs-12 criterion-item',
                        'style' => 'background: #993333;',
                    ],
                    'template' => '<div class="row"><div class="col-xs-1"><div class="number">4</div></div><div class="col-xs-11"><div class="row"><div class="col-xs-12">{label}</div><div class="col-xs-12">{input}</div></div></div></div>'
                ])
                    ->widget(StarRating::classname(), [
                        'pluginOptions' => [
                            'size'=>'sm',
                            'stars' => 10,
                            'step' => 1,
                            'min' => 0,
                            'max' => 10,
                            'showClear' => false,
                            'starCaptions' => [
                                0  => 'Всё так плохо?',
                                1  => '1 звезда',
                                2  => '2 звезды',
                                3  => '3 звезды',
                                4  => '4 звезды',
                                5  => '5 звёзд',
                                6  => '6 звёзд',
                                7  => '7 звёзд',
                                8  => '8 звёзд',
                                9  => '9 звёзд',
                                10 => '10 звёзд',
                            ],
                        ]
                    ])->label($model->description['reliability'])  ?>

                <?= $form->field($model, 'acceptance', [
                    'options' => [
                        'class' => 'col-xs-12 criterion-item',
                        'style' => 'background: #6699cc;',
                    ],
                    'template' => '<div class="row"><div class="col-xs-1"><div class="number">5</div></div><div class="col-xs-11"><div class="row"><div class="col-xs-12">{label}</div><div class="col-xs-12">{input}</div></div></div></div>'
                ])
                    ->widget(StarRating::classname(), [
                        'pluginOptions' => [
                            'size'=>'sm',
                            'stars' => 10,
                            'step' => 1,
                            'min' => 0,
                            'max' => 10,
                            'showClear' => false,
                            'starCaptions' => [
                                0  => 'Всё так плохо?',
                                1  => '1 звезда',
                                2  => '2 звезды',
                                3  => '3 звезды',
                                4  => '4 звезды',
                                5  => '5 звёзд',
                                6  => '6 звёзд',
                                7  => '7 звёзд',
                                8  => '8 звёзд',
                                9  => '9 звёзд',
                                10 => '10 звёзд',
                            ],
                        ]
                    ])->label($model->description['acceptance'])  ?>
            </div>

            <div class="form-group buttons text-center">
                <?= Html::submitButton('Оценить', [
                    'class' => 'btn btn-primary',
                    'name' => 'criterion',
                    'form' => 'criterion-form'
                ]); ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
