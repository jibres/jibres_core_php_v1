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
        return T_("Small business");
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
            T_("Unlimited product"),
            T_("Unlimited order"),
            T_("Online website"),
            T_("Special application"),
            T_("CRM"),
            T_("CMS"),
            T_("Simple Discount code"),
            T_("1GB storage"),

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