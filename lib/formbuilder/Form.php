<?php

class Form
{
    public function __construct($action = '#', $method = 'POST', $enctype = null)
    {
        if (is_null($enctype)) {
            echo "<form class=\"form-horizontal\" action=\"$action\" method=\"$method\" >";
        }
        else {
            echo "<form class=\"form-horizontal\" action=\"$action\" method=\"$method\" enctype=\"$enctype\">";
        }
        echo '  <div class="component" data-html="true">';
    }

    public function end()
    {
        echo '  </div>';
        echo '</form>';
    }

    public function __call($name, $args)
    {
        $builderName = ucfirst($name).'Builder';

        return new $builderName();
    }
}
