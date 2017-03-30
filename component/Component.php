<?php
/**
 *
 */
namespace Thomas\Component;
use Thomas\Base\IComponent;

class Component implements IComponent {
    /**
     * 组件所属的页面
     */
    public $page;

    public function getStyles() {
    }

    public function getHtml() {
    }

    public function getScripts() {
    }

    public function setCfg($cfg) {
        foreach($cfg as $prop => $val) {
            $this->$prop = $val;
        }
    }
}
