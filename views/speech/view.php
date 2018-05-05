<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\entities\Speech */

?>

<div class="speech-view">

    <?php if (Yii::$app->user->can('admin')): ?>
    <p>
        <?= Html::button('Редактировать', [
            'class' => 'btn btn-default',
            'onclick'=> 'formLoad(\'/speech/update\', \'Быстрое редактирование\', \'' . $model->id . '\')',
        ]) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php endif; ?>

    <?php try {
        echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                'name',
                'collective',
            ],
        ]);
    } catch (Exception $e) {
        $e->getMessage();
    } ?>

</div>
