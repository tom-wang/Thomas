<?php
/**
 *
 */
namespace Thomas\Page;
use Thomas\Base\IPage;

class HtmlPage implements IPage  {
    public $skin;
    public $chunked = true;
    public $components = array();

    public function render() {
        var_dump('hello world');
    }

    public function addComponent() {
    }
}
