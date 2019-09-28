<?php

namespace packagesrepo\yii2\mediamanagers\widgets;

use Yii;
use yii\helpers\Html;
use yii\helpers\Json;

use packagesrepo\yii2\mediamanagers\widgets\MediaManagerAsset;

class MediaManager extends \yii\base\Widget
{

    /**
     * MM options
     * @var array
     */
    public $clientOptions = [];

    /**
     * @inheritdoc
     */
    public function run()
    {
        echo Html::tag('div', '', ['id' => $this->getId()]);
        $this->registerClientScript();
    }

    /**
     * Register js
     */
    public function registerClientScript()
    {
        $view = $this->getView();
        MediaManagerAsset::register($view);

        $options = $this->clientOptions;
        $id = $this->getId();
        $options['el'] = "#$id";
        $options = Json::encode($options);
        $view->registerJs("new MM($options);", \yii\web\View::POS_END);
    }

}
