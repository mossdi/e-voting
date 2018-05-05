<?php

/* @var $this \yii\web\View */

use app\widgets\Menu;

$items = [
    [
        'label' => 'Администрирование выступлений',
        'url' => ['/site/index'],
    ],
    [
        'label' => 'Новое выступление',
        'url' => '#',
        'template' => '<a href="#" data-toggle="modal" data-target="#modalForm" onclick="formLoad(\'/speech/create\', \'Новое выступление\')">{icon}{label}</a>',
        'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('moderator')
    ],
    [
        'label' => 'Новый пользователь',
        'url' => '#',
        'template' => '<a href="#" data-toggle="modal" data-target="#modalForm" onclick="formLoad(\'/user/signup-form\', \'Регистрационная карточка\')">{icon}{label}</a>',
        'visible' => Yii::$app->user->can('admin')
    ],
    [
        'label' => 'Список выступлений',
        'url' => ['/speech/index'],
        'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('moderator')
    ],
    [
        'label' => 'Награждение',
        'url' => ['/site/concluding'],
        'visible' => Yii::$app->user->can('admin')
    ],
    [
        'label' => 'Системные настройки',
        'url' => ['/site/setting'],
        'visible' => Yii::$app->user->can('admin')
    ],
];

$menu[] = [
    'label' => 'Меню',
    'items' => $items,
    'options' => [
        'class' => 'dropdown admin-menu'
    ],
    'template' => '<a href="{url}" class="dropdown-toggle" data-toggle="dropdown">{label}</a>',
];

try {
    echo Menu::widget([
        'items' => $menu,
        'options' => [
            'class' => 'navbar-nav nav'
        ],
        'submenuTemplate' => '<ul class="dropdown-menu">{items}</ul>'
    ]);
} catch (Exception $e) {
    echo 'Выброшено исключение', $e->getMessage(), "\n";
}
