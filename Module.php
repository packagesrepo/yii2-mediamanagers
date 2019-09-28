<?php

namespace packagesrepo\yii2\mediamanagers;

use Yii;
use Imagine\Image\ManipulatorInterface;

use packagesrepo\yii2\mediamanagers\components\FileSystem;
use packagesrepo\yii2\mediamanagers\models\Thumb;

class Module extends \yii\base\Module
{

    public $controllerNamespace = 'packagesrepo\yii2\mediamanagers\controllers';

    /**
     * @var Custom filesystem
     */
    public $fs;

    /**
     * Filesystem component name
     * @var string
     */
    public $fsComponent = 'fs';

    /**
     * Directory separator
     * @var string
     */
    public $directorySeparator = '/';

    /**
     * api controller options
     * @var array
     */
    public $apiOptions = [
        'cors' => false,
    ];

    /**
     * @var components\ImageCache
     */
    public $thumbsPath = '@webroot/thumbs';
    public $thumbsUrl = '@web/thumbs';
    public $thumbsSize = Thumb::SIZE_THUMB;
    public $resizeMode = ManipulatorInterface::THUMBNAIL_INSET;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        Yii::setAlias('@mediamanagers', __DIR__);

        if (!isset(Yii::$app->{$this->fsComponent}))
            throw new \yii\base\InvalidConfigException();

        $this->fs = new FileSystem([
            'fs' => Yii::$app->{$this->fsComponent},
            'directorySeparator' => $this->directorySeparator,
        ]);

        Thumb::$fs = $this->fs;
        Thumb::$thumbsPath = $this->thumbsPath;
        Thumb::$thumbsUrl = $this->thumbsUrl;
        Thumb::$thumbsSize = $this->thumbsSize;
        Thumb::$resizeMode = $this->resizeMode;
    }

    /**
     * @return array
     */
    public function getCorsOptions()
    {
        if (isset($this->apiOptions['cors'])) {
            if (is_array($this->apiOptions['cors'])) {
                return [
                    'class' => 'yii\filters\Cors',
                    'cors' => $this->apiOptions['cors'],
                ];
            } else {
                return $this->apiOptions['cors'] ? true : false;
            }
        }
    }

}
