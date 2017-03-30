<?php
/**
 *
 */
namespace Thomas\Base;
interface IComponent {
    public function getStyles();
    public function getHtml();
    public function getScripts();
    public function setCfg($cfg);
}
