<?php

namespace lib\app\plan;

class planChoose
{


    public static function choose(array $_args)
    {
        $data = self::cleanArgs($_args);

        $planActivateOnJibres = \lib\api\jibres\api::plan_activate($data);


        if(isset($planActivateOnJibres['result']['payLink']))
        {
            \dash\redirect::to($planActivateOnJibres['result']['payLink']);
        }
        elseif(isset($planActivateOnJibres['result']['planActivate']) && $planActivateOnJibres['result']['planActivate'])
        {
            \dash\redirect::pwd();
        }

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

    public static function allowChoosePlan(array $currentPlan, plan $newPlan)
    {
        return true;
//        var_dump($currentPlan);
//        var_dump($newPlan->getArrayDetail());
    }
}