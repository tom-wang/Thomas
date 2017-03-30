<?php
/**
 *
 */
namespace Thomas\Page;
use Thomas\Base\IPage;
use Thomas\Base\IComponent;

class Page implements IPage {
    /**
     *
     */
    public function render() {
    }

    /**
     * 添加组件
     */
    public function addComponent(IComponent $component) {
        $component->page = $this;
        $this->components[] = $component;
    }

    /**
     *
     */
    public function setCfg($cfg) {
        foreach($cfg as $prop => $val) {
            $this->$prop = $val;
        }
    }
}
