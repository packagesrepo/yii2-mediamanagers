<?php

namespace packagesrepo\yii2\mediamanagers\widgets;

use yii\web\AssetBundle;

class MediaManagerAsset extends AssetBundle
{

    public $sourcePath = '@vendor/packagesrepo/yii2-mediamanagers/assets/mediamanagers';
    public $css = [
        'mediamanagers.min.css',
    ];
    public $js = [
        'mediamanagers.min.js',
    ];
    public $depends = [
    ];
    public $publishOptions = [
        'forceCopy' => YII_DEBUG,
    ];

}
