<?php

namespace content_a\plan\home;

class model
{
    public static function post()
    {
        $args =
        [
            'plan'  => \dash\request::post('plan'),
            'month' => \dash\request::post('month'),
        ];

        $choose = \lib\app\plan\planChoose::choose($args);
    }

}