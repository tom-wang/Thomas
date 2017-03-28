<?php
/**
 *
 */
namespace Thomas;

class Thomas {
    /**
     * 具体应用的库的根路径
     * 库一般不放到htdocs目录下
     */
    public static $appLibPath;

    /**
     * app访问入口的URL地址
     * skin的样式文件，js文件等加载的路径会用到它
     */
    public static $appWebPath;

    /**
     * 路由器的类型
     * query：根据查询字符串解析
     * path：根据path解析，搜索引擎更友好
     */
    public static $router = 'query';

    /**
     * 初始化
     */
    public static function init() {
        // 注册autoload
        spl_autoload_register(function($className) {
            // 仅处理Thomas命名空间下的类
            if(0 === strpos($className, 'Thomas\\')) {
                require_once(__DIR__ . DIRECTORY_SEPARATOR . str_replace(array('Thomas\\', '\\'), array('', DIRECTORY_SEPARATOR), $className) . '.php');
            }
        });
    }

    /**
     * 启动应用
     */
    public static function run($cfg) {
        self::setCfg($cfg);
    }

    /**
     *
     */
    public static function setCfg($cfg) {
        foreach($cfg as $prop => $val) {
            self::$prop = $val;
        }
    }
}
