<?php

namespace lib\app\plan;

class planChoose
{


    public static function choose(array $_args)
    {
        $data = self::cleanArgs($_args);

        $planActivateOnJibres = \lib\api\jibres\api::plan_activate($data);

        $detectApiResult = self::detectApiResult($planActivateOnJibres);

        if($detectApiResult->payLink)
        {
            \dash\redirect::to($detectApiResult->payLink);
        }

    }


    private static function detectApiResult($_result) : object
    {
        $detectApiResult = (object)
        [
            'needPay' => false,
            'payLink' => null,
        ];

        if(isset($_result['result']['needPay']))
        {
            $detectApiResult->needPay = $_result['result']['needPay'];
        }

        if(isset($_result['result']['payLink']))
        {
            $detectApiResult->payLink = $_result['result']['payLink'];
        }

        return $detectApiResult;
    }


    private static function cleanArgs(array $_args)
    {
        $condition =
        [
            'plan'       => ['enum' => planList::list()],
            'period'     => ['enum' => ['monthly', 'yearly']],
            'use_budget' => 'bit',
            'turn_back'  => 'string_2000',
        ];

        $require = ['plan'];

        $meta    = [];

        $data = \dash\cleanse::input($_args, $condition, $require, $meta);

        return $data;
    }
}