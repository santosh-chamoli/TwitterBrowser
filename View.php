<?php
class View
{
    protected $data;

    public function render($template = 'simpleTemplate') {
        ob_start();
        require  $template . ".php";
        $str = ob_get_contents();
        ob_end_clean();
        return $str;
    }

    public function setData($data) {
        $this->data = $data;
    }
}
