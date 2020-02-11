<?php


namespace app\assets;


use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class TaskPageAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/taskpage.css'
    ];

    public $js = [
    ];

    public $depends = [
        JqueryAsset::class
    ];
}