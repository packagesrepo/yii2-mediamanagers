<?php

namespace packagesrepo\yii2\mediamanagers\controllers;

use Yii;

use packagesrepo\yii2\mediamanagers\models\Thumb;

/**
 */
class ThumbController extends \yii\web\Controller
{

    /**
     * @return mixed
     */
    public function actionThumb($path)
    {
        /* @var $thumb Thumb */
        $thumb = Yii::createObject([
            'class' => Thumb::className(),
            'path' => $path,
        ]);

        if ($thumb->validate() && $thumb->save()) {
            header('Content-type: image/' . $thumb->type);
            header('Content-Length: ' . filesize($thumb->realPath));
            readfile($thumb->realPath);
        } else {
            throw new \yii\web\NotFoundHttpException();
        }
    }

}
