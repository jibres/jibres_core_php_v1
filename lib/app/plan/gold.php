<?php

namespace lib\app\plan;

class gold extends planTools
{

    public function name(): string
    {
        return 'gold';
    }

    public function title(): string
    {
        return T_("Gold");
    }

    public function priceRial(): int
    {
        return 200000; // IRT
    }

    public function priceDollar(): int
    {
        return 9; // USD
    }

    public function featureList() : array
    {
        return
        [
            T_("Up to 50000 product"),
            T_("Discount"),
        ];
    }
}