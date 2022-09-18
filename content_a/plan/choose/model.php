<?php

namespace content_a\plan\choose;

class model
{
    public static function post()
    {
        $args =
        [
            'plan'       => \dash\request::post('plan'),
            'period'     => \dash\request::get('p'),
            'turn_back'  => \dash\url::pwd(),
            'use_budget' => \dash\request::post('use_budget'),
        ];

        if(!$args['period'])
        {
            $args['period'] = \lib\app\plan\planGet::defultPeriod();
        }

        \lib\app\plan\planChoose::choose($args);

        if(\dash\engine\process::status())
        {
            \dash\redirect::pwd();
        }
    }

}