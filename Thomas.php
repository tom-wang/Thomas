<?php
/**
 *
 */
namespace Thomas;

class Thomas {
    /**
     * 具体应用的库的根路径
     * 库一般不放到htdocs目录下
     * 不包括/后缀
     */
    public static $appLibPath;

    /**
     * 当前应用使用的协议
     */
    public static $protocol;

    /**
     * 当前应用的host
     */
    public static $host;

    /**
     * 当前应用的port
     */
    public static $port;

    /**
     * 
     */
    public static $baseUrl;

    /**
     * 皮肤路径
     */
    public static $appSkinPath = '/skin';

    /**
     * 应用的命名空间前缀
     */
    public static $appNSPrefix = 'App';
    public static $appControllerNSPrefix = 'App\\Controller';

    /**
     * 路由器的类型
     * query：根据查询字符串解析
     * path：根据path解析，搜索引擎更友好
     */
    public static $router = 'query';
    public static $routerObj;

    /**
     *
     */
    public static $module = 'index';
    public static $moduleObj;

    /**
     * 当前页面对象
     */
    public static $pageObj;

    /**
     *
     */
    public static $action = 'index';

    /**
     * 初始化
     */
    public static function init() {
        // 注册autoload
        spl_autoload_register(function($className) {
            $classParts = explode('\\', $className);
            if(count($classParts) > 1) {
                $prefix = array_shift($classParts);
            }
            // 仅处理Thomas命名空间下的类
            $filePath = __DIR__ . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $classParts) . '.php';
            if('Thomas' === $prefix && file_exists($filePath)) {
                require_once($filePath);
            }
        });
    }

    /**
     * 初始化应用自身的加载器
     */
    public static function initAppAutoLoader() {
        spl_autoload_register(function($className) {
            $classParts = explode('\\', $className);
            if(count($classParts) > 1) {
                array_shift($classParts);
            }
            $appFilePath = self::$appLibPath . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $classParts) . '.php';
            if(file_exists($appFilePath)) {
                require_once($appFilePath);
            }
        });
    }

    /**
     *
     */
    public static function initModuleAction() {
        $className = 'Thomas\\Router\\' . ucfirst(self::$router) . 'Router';
        self::$routerObj = $router = new $className();
        if(!empty($module = $router->getModule())) {
            self::$module = $module;
        }
        if(!empty($action = $router->getAction())) {
            self::$action = $action;
        }
    }

    /**
     *
     */
    public static function initEnv() {
        // HTTP_HOST是包括端口的
        $parts = explode(':', $_SERVER['HTTP_HOST']);
        self::$host = $parts[0];
        self::$port = empty($parts[1]) ? 80 : $parts[1];
        self::$protocol = $_SERVER['REQUEST_SCHEME'];
        self::$baseUrl = self::$protocol . '://' . self::$host . (80 == self::$port ? '' : (':' . self::$port));
    }

    /**
     * 启动应用
     */
    public static function run($cfg) {
        // 配置
        self::setCfg($cfg);
        // 初始化应用的Loader
        self::initAppAutoLoader();
        // 初始化module/action
        self::initModuleAction();
        // 初始化环境
        self::initEnv();

        $moduleClassName = self::$appControllerNSPrefix . '\\' . ucfirst(self::$module) . 'Module' ;
        self::$moduleObj = $module = new $moduleClassName();
        $action = self::$action;
        $module->$action();
    }

    /**
     *
     */
    public static function setCfg($cfg) {
        foreach($cfg as $prop => $val) {
            self::$$prop = $val;
        }
    }

    /**
     * 创建页面的快捷方法
     */
    public static function createPage($pageType, $cfg) {
        $pageClassName = 'Thomas\\Page\\' . ucfirst($pageType) . 'Page';
        self::$pageObj = $page = new $pageClassName();
        $page->setCfg($cfg);
        return $page;
    }

    /**
     * 创建组件的快捷方法
     */
    public static function createComponent($componentType, $cfg) {
        $componentClassName = 'Thomas\\Component\\' . ucfirst($componentType) . 'Component';
        $component = new $componentClassName();
        $component->setCfg($cfg);
        return $component;
    }
}
