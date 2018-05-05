<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

app\assets\AppAsset::register($this);

//Yii::$app->authManager->invalidateCache(); //очистка кэша ролей

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrapper <?= !Yii::$app->user->can('admin') ? 'guest' : 'admin' ?>">
    <?= $this->render(
        '/element/timer.php'
    ) ?>

    <?= $this->render(
        '/element/modal.php'
    ) ?>

    <?= $this->render(
        'header.php'
    ) ?>

    <?= $this->render(
        'content.php', [
            'content' => $content
        ]
    ) ?>

    <?= $this->render(
        'footer.php'
    ) ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
