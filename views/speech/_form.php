<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\entities\Speech;
use froala\froalaeditor\FroalaEditorWidget;

/* @var $this yii\web\View */
/* @var $model app\entities\Speech */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="speech-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')
        ->widget(FroalaEditorWidget::className(), [
                'name' => 'description',
                'options' => [
                    'id' => 'name'
                ],
                'clientOptions' => [
                    'height' => 200,
                    'toolbarInline' => false,
                    'theme' => 'royal',
                    'language' => 'en_gb'
                ]
            ]
        ) ?>

    <?= $form->field($model, 'collective')->textInput() ?>

    <?= $form->field($model, 'member')->textInput() ?>

    <?php if (!empty($model->logo) && file_exists(Yii::getAlias('@webroot/image/logo/' . $model->logo))):
        echo Html::img(Yii::getAlias('@web/image/logo/'. $model->logo), ['class'=>'img-responsive']);
        echo $form->field($model,'del_img')->checkBox(['class'=>'span-1']);
    endif; ?>

    <?= $form->field($model, 'file')->fileInput() ?>

    <?= $form->field($model, 'sort_order')->textInput()->label('Порядок сортировки') ?>

    <?= $form->field($model, 'status')->dropDownList(Speech::$statusList) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
