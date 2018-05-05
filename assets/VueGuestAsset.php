<?php

namespace app\assets;

use yii\web\AssetBundle;

class VueGuestAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //null
    ];
    public $js = [
        'js/vue.min.js',
        'js/axios.js',
        'vueObjects/guest.js?v.1.0.12',
    ];
    public $depends = [
        'app\assets\AppAsset',
    ];
}
