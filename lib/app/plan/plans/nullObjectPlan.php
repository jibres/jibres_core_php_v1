<?php

namespace lib\app\plan\plans;

use lib\app\plan\plan;

class nullObjectPlan implements plan
{

    public function name(): string
    {
        return 'free';
    }

    public function title(): string
    {
        return T_("Free");
    }
}