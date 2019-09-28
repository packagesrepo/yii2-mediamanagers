# Yii2 Media Manager Module

This module provides a [Media Manager](https://packagesrepo@bitbucket.org/packagesrepo/mediamanagers) integration to your Yii2 application. It is still in its early stages, but feel free to use it, report bugs, and contribute.

## Installation

The preferred way to install this module is through [composer](http://getcomposer.org/download/).

Either run

```
composer require "packagesrepo/yii2-mediamanagers" "*"
```

or add

```json
"packagesrepo/yii2-mediamanagers" : "*"
```

to the require section of your application's `composer.json` file.

## Configuration

Add the following lines in your application configuration :

```php
'components' => [
    // ...
    'urlManager' => [
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'rules' => [    
            'thumbs/<path:.*>' => 'mediamanagers/thumb/thumb',
            // ...
        ],
    ],
    // ...
    'fs' => [
        'class' => 'creocoder\flysystem\LocalFilesystem',
        'path' => '@webroot/upload',
    ],
],
'modules' => [
    // ...
    'mediamanagers' => [
        'class' => 'packagesrepo\yii2\mediamanagers\Module',
    ],
],
```

### About Flysystem

This module use [Flysystem](https://github.com/thephpleague/flysystem) (via [creocoder/yii2-flysystem](https://github.com/creocoder/yii2-flysystem)), a *filesystem abstraction which allows you to easily swap out a local filesystem for a remote one*.

You can use a local filesystem as described previously, you should then create an `upload` folder in the web folder of your Yii2 application. You can also use any *adapter* provided by Flysystem, take a look at [Flysystem](http://flysystem.thephpleague.com) and [creocoder/yii2-flysystem](https://github.com/creocoder/yii2-flysystem).

WARNING : Actually, this module has only been tested with *local*, *ftp* and *sftp* adapters.

### About image thumbnails

This module use [Imagine](https://github.com/avalanche123/Imagine) (via [yii2-imagine](https://github.com/yiisoft/yii2-imagine)) to generate image thumbnails *on demand*, you should create a `thumbs` folder in the web folder of your application.

## Usage

### MediaManagerInput

```php
use packagesrepo\yii2\mediamanagers\widgets\MediaManagerInput;

echo MediaManagerInput::widget([
    'name' => 'test', // input name
    'multiple' => false,
    'clientOptions' => [
        'api' => [
            'listUrl' => Url::to(['/mediamanagers/api/list']),
            // 'uploadUrl' => Url::to(['/mediamanagers/api/upload']),
            // 'downloadUrl' => Url::to(['/mediamanagers/api/download']),
        ],
    ],
]);
```

### MediaManagerModal

```php
use packagesrepo\yii2\mediamanagers\widgets\MediaManagerInputModal;

echo MediaManagerInputModal::widget([
    'name' => 'test', // input name
    'clientOptions' => [
        'api' => [
            'listUrl' => Url::to(['/mediamanagers/api/list']),
            // 'uploadUrl' => Url::to(['/mediamanagers/api/upload']),
            // 'downloadUrl' => Url::to(['/mediamanagers/api/download']),
        ],
    ],
]);
```
