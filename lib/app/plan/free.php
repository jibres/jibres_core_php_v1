<?php

namespace lib\app\plan;

class free extends planTools
{
    public function name(): string
    {
        return 'free';
    }

    public function title(): string
    {
        return T_("Free");
    }


    public function priceRial(): int
    {
        return 0; // IRT
    }

    public function priceDollar(): int
    {
        return 0; // USD
    }


    public function featureList() : array
    {
        return
        [
            T_("Up to 500 product"),
        ];
    }
}