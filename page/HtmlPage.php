<?php
/**
 *
 */
namespace Thomas\Page;
use Thomas\Page\Page;
use Thomas\Base\IComponent;

class HtmlPage extends Page {
    public $skin = 'bootstrap';
    public $chunked = true;
    public $components = array();
    public $headComponent;
    public $footComponent;

    public function setHeadComponent(IComponent $component) {
        $component->page = $this;
        $this->headComponent = $component;
    }

    public function setFootComponent(IComponent $component) {
        $component->page = $this;
        $this->footComponent = $component;
    }

    public function render() {
        if($this->headComponent) {
            array_unshift($this->components, $this->headComponent);
        }
        if($this->footComponent) {
            array_push($this->components, $this->footComponent);
        }
        foreach($this->components as $component) {
            $html = $component->getHtml();
            echo $html;
        }
        echo '<script>';
        foreach($this->components as $component) {
            $script = $component->getScript();
            echo $script;
        }
        echo '</script>';
    }
}
