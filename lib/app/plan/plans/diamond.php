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


    public function outstandingFeatures() : array
    {
        return
            [
                T_("Every feature in free and gold plan +"),
                T_("Remove Jibres brank"),
                T_("Access admin from your domain"),
                T_("5GB storage"),
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
            'admin_domain',
            'discount_professional',
            'remove_brand',
            'ganje_product',
            'report_professional',
            'sms_pack',
        ];
    }
}