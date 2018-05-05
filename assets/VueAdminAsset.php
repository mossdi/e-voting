<?php

namespace app\assets;

use yii\web\AssetBundle;

class VueAdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //null
    ];
    public $js = [
        'js/vue.min.js',
        'js/axios.js',
        'vueObjects/admin.js?v.1.0.12',
    ];
    public $depends = [
        'app\assets\AppAsset',
    ];
}
