<?php
namespace lib\app\plan\plans;


use lib\app\plan\planPrepare;


class gold extends  planPrepare
{

    public function name(): string
    {
        return 'gold';
    }


    public function title(): string
    {
        return T_("Gold");
    }

    public function description(): string
    {
        return '';
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

    public function type(): string
    {
       return 'public';
    }
}