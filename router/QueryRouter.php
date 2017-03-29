<?php
/**
 *
 */
namespace Thomas\Router;
use Thomas\Router\Router;

class QueryRouter extends Router {
    public function getModule() {
        return empty($_REQUEST['module']) ? '' : strtolower($_REQUEST['module']);
    }

    public function getAction() {
        return empty($_REQUEST['action']) ? '' : strtolower($_REQUEST['action']);
    }
}
