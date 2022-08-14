<?php

namespace content_a\plan\home;

class model
{
    public static function post()
    {
        $choose = \lib\app\plan\planChoose::choose(\dash\request::post('plan'));
    }

}