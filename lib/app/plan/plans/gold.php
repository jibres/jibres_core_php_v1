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
            T_("Every feature in free plan +"),
            T_("Special Discount code"),
            T_("Special report"),
            T_("Access to Ganje plugin"),
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
                'discount_professional',
                'ganje_product',
                'report_professional',
                'sms_pack',
            ];
    }
}