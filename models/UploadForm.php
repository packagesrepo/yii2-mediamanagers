<?php

namespace packagesrepo\yii2\mediamanagers\models;

use Yii;
use yii\helpers\FileHelper;

class UploadForm extends \yii\base\Model
{

    /**
     * @var string
     */
    public $path;

    /**
     * @var \yii\web\UploadedFile
     */
    public $file;
    public static $allowedExtensions = ['png', 'jpg', 'jpeg', 'gif', 'bmp', "avi", "mpeg", "mp4"];
    public static $mimeTypes = ['image/*', 'video/*'];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['path', 'file'], 'required', 'strict' => true],
            ['path', 'string'],
            ['path', 'validatePath'],
            [
                ['file'], 'file',
                'skipOnEmpty' => false,
                'extensions' => self::$allowedExtensions,
                'mimeTypes' => self::$mimeTypes,
                'maxSize' => 100000000, //2097152,
                'maxFiles' => 1,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function formName()
    {
        return '';
    }

    /**
     * Validate path
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePath($attribute, $params)
    {
        $fs = Yii::$app->getModule('mediamanagers')->fs;
        $this->$attribute = $fs->normalizePath($this->$attribute);

        if (!empty($this->$attribute) && !$fs->has($this->$attribute)) {
            $this->addError($attribute, 'Invalid path.');
        }
    }

    /**
     * Upload files
     */
    public function upload()
    {
        if ($this->validate()) {
            $file = $this->file;
            $fs = Yii::$app->getModule('mediamanagers')->fs;
            $path = "{$this->path}/{$file->baseName}.{$file->extension}";

            $counter = 1;
            while ($fs->has($path)) {
                $path = "{$this->path}/{$file->baseName}_{$counter}.{$file->extension}";
                $counter++;
            }

            if ($stream = fopen($file->tempName, 'r+')) {
                $write = $fs->writeStream($path, $stream);
                fclose($stream);                
                if ($write) {
                    return true;
                } else {
                    $this->addError('path', 'Failed to write file.');
                }
            } else {
                $this->addError('file', 'Failed to get file.');
            }
        }
        return false;
    }

}
