<?php
/**
 * Created by PhpStorm.
 * User: bgirac
 * Date: 19.04.2018
 * Time: 08:03
 */


class FileBuilder extends Builder
{
    public function __construct()
    {
        $this->addProperty('enctype');
        $this->addProperty('id');
        $this->addProperty('label');
        $this->addProperty('name');
        $this->addProperty('value', null);
    }

    public function build()
    {
        $result = '<div class="form-group">';
        $result .= "    <label class=\"col-md-2 control-label\" for=\"textinput\">{$this->label}</label>";
        $result .= '    <div class="col-md-4">';
        $result .= "        <input id=\"$this->id\" name=\"{$this->name}\" type=\"file\" value=\"{$this->value}\" class=\"form-control input-md\">";
        $result .= '    </div>';
        $result .= '</div>';

        return $result;
    }
}