<?php
namespace lib\app\plan\plans;


use lib\app\plan\planPrepare;

class diamond extends planPrepare
{

    public function name(): string
    {
        return 'diamond';
    }


    public function title(): string
    {
        return T_("Diamond");
    }

    public function description(): string
    {
        return T_("Diamond description");
    }


    public function priceRial(): float
    {
        return 900000; // IRT
    }


    public function priceDollar(): int
    {
        return 29; // USD
    }


    public function featureList() : array
    {
        return
        [
            T_("Up to 19000 product"),
            T_("Discount Advanced"),
            T_("Test"),
        ];
    }

    public function type(): string
    {
        return 'public';
    }
}