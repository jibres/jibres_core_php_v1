<?php

namespace content_a\plan\set;

class model
{
    public static function post()
    {
        $args =
        [
            'plan'       => \dash\data::planName(),
            'period'     => \dash\request::get('p'),
            'turn_back'  => \dash\url::this(),
            'use_budget' => \dash\request::post('usebudget'),
        ];


        if(!$args['period'])
        {
            $args['period'] = 'yearly';
        }

        \lib\app\plan\planChoose::choose($args);

        if(\dash\engine\process::status())
        {
            \dash\redirect::to(\dash\url::this());
        }
    }

}