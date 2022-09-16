<?php
namespace lib\app\plan\plans;


use lib\app\plan\planPrepare;

class diamond extends planPrepare
{

	public function name() : string
	{
		return 'diamond';
	}


	public function title() : string
	{
		return T_("Diamond");
	}


	public function description() : string
	{
		return T_("Diamond description");
	}


	public function priceIRT() : int
	{
		return 900000; // IRT
	}


	public function type() : string
	{
		return 'public';
	}


	public function contain() : array
	{
		return
			[
				'permission'           => ['mode' => 'professional'],
				'staff'                => ['count' => 20],
				'allowedFileSize'      => ['size' => \dash\utility\convert::mb_to_byte(20)],
				'totalStorage'         => ['size' => \dash\utility\convert::gb_to_byte(20)],
				// 'freeDomain'           => ['irDomain' => false, 'comDomain' => false],
				'ganje'                => true,
				'sms'                  =>
					[
						'fa_cost' => 60,
						'en_cost' => 120,
					],
				'removeBrand'          => true,
				'adminOnDomain'        => true,
				'professionalReport'   => true,
				'professionalDiscount' => true,
			];
	}


}