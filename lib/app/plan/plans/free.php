<?php
namespace lib\app\plan\plans;


use lib\app\plan\planPrepare;

class free extends planPrepare
{

	public function name() : string
	{
		return 'free';
	}


	public function title() : string
	{
		return T_("Free");
	}


	public function description() : string
	{
		return T_("For ever!");
	}


	public function priceIRT() : int
	{
		return 0; // IRT
	}


	public function type() : string
	{
		return 'public';
	}


	public function contain() : array
	{
		return
			[
				'permission'           => false,
				'staff'                => ['count' => 2],
				'allowedFileSize'      => ['size' => \dash\utility\convert::mb_to_byte(1)],
				'totalStorage'         => ['size' => \dash\utility\convert::gb_to_byte(1)],
				// 'freeDomain'           => ['irDomain' => false, 'comDomain' => false],
				'ganje'                => false,
				'removeBrand'          => false,
				'adminOnDomain'        => false,
				'professionalReport'   => false,
				'professionalDiscount' => false,
				'sms'                  =>
					[
						'fa_cost' => 100,
						'en_cost' => 200,
					],
			];
	}

}