<?php
/**
 *
 */
namespace Thomas\Page;
use Thomas\Page\Page;

class HtmlPage extends Page {
    public $skin = 'bootstrap';
    public $chunked = true;
    public $components = array();

    public function render() {
        foreach($this->components as $component) {
            $html = $component->getHtml();
            echo $html;
        }
    }
}
