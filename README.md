# chaser-recorder
日志

### 需求
php >= 7.1、json扩展

### 安装
```
composer require 7csn/chaser-recorder
```

### 使用
```php
<?php

use chaser\server\Recorder;

// 可选参数：string $dir
$recorder = new Recorder(); # 默认 Recorder::STORAGE_DIR

// 外部修改存储目录
// $storageDir = './storage';
// $recorder->setDir($storageDir);

// 记录日志
// 参数1：mixed $message
// 参数2：mixed $level
    // Recorder::LEVEL_DEBUG   （默认）
    // Recorder::LEVEL_INFO
    // Recorder::LEVEL_WARN
    // Recorder::LEVEL_ERROR
    // Recorder::LEVEL_CRAZY
$recorder->write('this is message');
```
