<?php
namespace lib\app\plan\plans;

use lib\app\plan\plan;

class diamond implements plan
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

    public function featureList() : array
    {
        return
        [
            T_("Up to 19000 product"),
            T_("Discount Advanced"),
            T_("Test"),
        ];
    }
}