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


    public function priceIRT(): int
    {
        return 900000; // IRT
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



    public function  featureList()
    {
        return
            [
                T_("Products") =>
                    [
                        T_("Full feature") => true,
                        T_("Count limited") => \dash\fit::text('+650,000'),
                        T_("Image gallery") => true,
                        T_("Advance detail") => true,
                        T_("Full controlle") => true,
                    ],
                T_("Cart & shipping")    =>
                    [
                        T_("Allow to manage cart") => true,
                        T_("Specail manage") => true,
                    ],
                T_("API base ")    =>
                    [
                        T_("Allow to use from api") => true,
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
            'admin_domain',
            'discount_professional',
            'remove_brand',
            'ganje_product',
            'report_professional',
            'sms_pack',
        ];
    }
}