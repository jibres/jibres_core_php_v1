<?php
namespace lib\app\plan\plans;


use lib\app\plan\planPrepare;


class rafiei extends planPrepare
{

    public function name(): string
    {
        return 'rafiei';
    }


    public function title(): string
    {
        return T_("Rafiei");
    }

    public function description(): string
    {
        return '';
    }


    public function  featureList()
    {
        return [];
    }



    public function priceRial(): int
    {
        return 2000000; // IRT
    }


    public function priceDollar(): int
    {
        return 90; // USD
    }


    public function outstandingFeatures() : array
    {
        return
        [
            T_("Everything you need ❤"),
            T_("Enterprice plan"),
        ];
    }

    public function type(): string
    {
       return 'enterprise';
    }


    public static function enterprise() : string
    {
        return 'rafiei';
    }

    public function contain(): array
    {
        return
            [
                'admin_domain',
                'discount_professional',
                'remove_brand',
                'ganje_product',
                'report_professional',
                'sms_pack',
            ];
    }
}