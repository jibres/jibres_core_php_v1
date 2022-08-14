<?php

namespace lib\app\plan;

class diamond implements planInterface
{
    public function name(): string
    {
        return 'diamond';
    }

    public function title(): string
    {
        return T_("Diamond");
    }

    public function price(): int
    {
        return 20000000;
    }
}