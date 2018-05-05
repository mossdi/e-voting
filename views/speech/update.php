<?php

/* @var $this yii\web\View */
/* @var $model app\entities\Speech */

$this->title = 'Редкатирование: ' . $model->name;

?>

<div class="speech-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
