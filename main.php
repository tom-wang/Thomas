<?php
/**
 *
 */
namespace Thomas;

Thomas::init();

class Thomas {
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
}
