<?php

namespace chaser\recorder;

use chaser\helper\Helper;

/**
 * 记录员
 *
 * @package chaser\recorder
 */
class Recorder
{
    /**
     * 日志：调试模式
     *
     * @var int
     */
    public const LEVEL_DEBUG = 1;

    /**
     * 日志：信息模式
     *
     * @var int
     */
    public const LEVEL_INFO = 2;

    /**
     * 日志：警告模式
     *
     * @var int
     */
    public const LEVEL_WARN = 3;

    /**
     * 日志：错误模式
     *
     * @var int
     */
    public const LEVEL_ERROR = 4;

    /**
     * 日志：疯狂模式
     *
     * @var int
     */
    public const LEVEL_CRAZY = 5;

    /**
     * 日志级别名称对照表
     */
    public const LEVEL_NAMES = [
        self::LEVEL_DEBUG => 'DEBUG',
        self::LEVEL_INFO => 'INFO',
        self::LEVEL_WARN => 'WARN',
        self::LEVEL_ERROR => 'ERROR',
        self::LEVEL_CRAZY => 'CRAZY',
    ];

    /**
     * 默认存储目录
     */
    public const STORAGE_DIR = __DIR__ . DIRECTORY_SEPARATOR;

    /**
     * 日志存储目录
     *
     * @var string
     */
    protected $dir = self::STORAGE_DIR;

    /**
     * 初始化存储目录
     *
     * @param string|null $dir
     */
    protected function __construct(?string $dir = null)
    {
        $dir === null || $this->setDir($dir);
    }

    /**
     * 设置目录
     *
     * @param string $dir
     */
    public function setDir(string $dir)
    {
        if (is_dir($dir) || mkdir($dir, 0777)) {
            $this->dir = $dir;
        }
    }

    /**
     * 记录日志
     *
     * @param string $data
     * @param int $level
     */
    public function write(string $data, int $level = self::LEVEL_DEBUG)
    {
        file_put_contents(
            $this->dir . DIRECTORY_SEPARATOR . self::getLevelName($level) . '-' . date('Ymd') . '.log',
            PHP_EOL . Helper::datetime() . PHP_EOL . self::format($data) . PHP_EOL,
            FILE_APPEND | LOCK_EX
        );
    }

    /**
     * 格式化数据
     *
     * @param mixed $data
     * @return bool|int|float|string
     */
    public static function format($data)
    {
        return (string)(is_scalar($data) ? $data : json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    /**
     * 获取日志级别名称
     *
     * @param int $level
     * @return string
     */
    protected static function getLevelName(int $level)
    {
        return self::LEVEL_NAMES[$level] ?? self::LEVEL_NAMES[self::LEVEL_DEBUG];
    }
}