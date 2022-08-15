<?php

namespace lib\app\plan;

class diamond extends planTools
{
    public function name(): string
    {
        return 'diamond';
    }

    public function title(): string
    {
        return T_("Diamond");
    }

    public function priceRial(): int
    {
        return 900000; // IRT
    }

    public function priceDollar(): int
    {
        return 29; // USD
    }
}