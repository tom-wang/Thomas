<?php
/**
 *
 */
namespace Thomas\Component;
use Thomas\Component\Component;

class HeadComponent extends Component {
    /**
     * 组件所属的页面
     */
    public $page;

    public function getStyles() {
        return array(
        );
    }

    public function getHtml() {
    }

    public function getScripts() {
    }
}
