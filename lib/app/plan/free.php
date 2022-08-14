<?php

namespace lib\app\plan;

class free implements planInterface
{
    public function name(): string
    {
        return 'free';
    }

    public function title(): string
    {
        return T_("Free");
    }

    public function price(): int
    {
        return 200000;
    }
}