<?php namespace Destiny;

class ViewHelper {

    public static function format_price($price)
    {
        echo "£" . number_format($price, 2);
    }

    public static function format_boolean_yes_no($value)
    {
        echo $value ? 'Yes' : 'No';
    }

    public static function required_icon()
    {
        echo '<span class="glyphicon glyphicon-asterisk control-label"></span> ';
    }
}