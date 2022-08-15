<?php

namespace content_a\plan\home;

class model
{
    public static function post()
    {
        $args =
        [
            'plan'       => \dash\request::post('plan'),
            'period'     => \dash\request::post('period'),
            'turn_back'  => \dash\url::pwd(),
            'use_budget' => null,
        ];

        $choose = \lib\app\plan\planChoose::choose($args);
    }

}