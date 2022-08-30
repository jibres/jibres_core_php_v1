<?php

namespace lib\app\plan;

class planReady
{

    public static function ready($_data)
    {
        $result = [];
        foreach ($_data as $key => $value)
        {
            switch ($key)
            {
                case 'plan':
                    $result[$key] = $value;
                    if($value)
                    {
                        $loadPlan = planLoader::load($value);
                        $result['planTitle'] = $loadPlan->title();
                        $result['planDescription'] = $loadPlan->description();
                        $result['planFeatureList'] = $loadPlan->featureList();
                    }
                    break;

                default:
                    $result[$key] = $value;
                    break;
            }
        }

        return $result;
    }
}