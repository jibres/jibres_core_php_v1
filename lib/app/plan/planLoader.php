<?php

namespace lib\app\plan;

class planLoader
{

    public static function load(string $plan) : plan
    {
        $class        = sprintf('%s\%s\%s', __NAMESPACE__, 'plans', $plan);
        $myPlan       = new $class;
        return $myPlan;
    }
}