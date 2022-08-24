<?php

namespace content_a\plan\home;

class model
{
    public static function post()
    {
        $args =
        [
            'plan'       => \dash\request::post('plan'),
            'period'     => \dash\request::get('period'),
            'turn_back'  => \dash\url::pwd(),
            'use_budget' => \dash\request::post('use_budget'),
        ];

        $choose = \lib\app\plan\planChoose::choose($args);
    }

}