<?php

namespace content_a\plan\set;

class model
{
    public static function post()
    {
        \lib\app\plan\businessPlanDetail::doCancel();

        if(\dash\engine\process::status())
        {
            \dash\redirect::to(\dash\url::this());
        }
    }

}