<?php
namespace lib\app\plan\plans;


use lib\app\plan\planPrepare;

class free extends  planPrepare
{

    public function name(): string
    {
        return 'free';
    }


    public function title(): string
    {
        return T_("Free");
    }

    public function description(): string
    {
        return '';
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

    public function type(): string
    {
        return 'public';
    }

    public function contain(): array
    {
        return
        [
            // nothing!
        ];
    }
}