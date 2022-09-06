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
        return T_("For ever!");
    }

    public function priceRial(): int
    {
        return 0; // IRT
    }


    public function priceDollar(): int
    {
        return 0; // USD
    }


    public function outstandingFeatures() : array
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

    public function  featureList()
    {
        return
            [
                T_("Products") =>
                    [
                        T_("Full feature") => true,
                        T_("Count limited") => \dash\fit::text('+10,000'),
                        T_("Image gallery") => true,
                        T_("Advance detail") => false,
                        T_("Free for ever") => true,
                    ],
                T_("Cart & shipping")    =>
                    [
                        T_("Allow to manage cart") => true,
                    ],
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