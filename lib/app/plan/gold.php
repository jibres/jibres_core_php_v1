<?php

namespace lib\app\plan;

class gold implements planInterface
{

    public function name(): string
    {
        return 'gold';
    }

    public function title(): string
    {
        return T_("Gold");
    }

    public function price(): int
    {
        return 2000000;
    }
}