<?php
namespace lib\app\plan\plans;


use lib\app\plan\planPrepare;


class gold extends planPrepare
{

	public function name() : string
	{
		return 'gold';
	}


	public function title() : string
	{
		return T_("Gold");
	}


	public function description() : string
	{
		return T_("Description of gold");
	}


	public function priceIRT() : int
	{
		return 200000; // IRT
	}


	public function type() : string
	{
		return 'public';
	}


	public function contain() : array
	{
		return
			[
				'permission'      => ['mode' => 'simple'],
				'staff'           => ['count' => 5],
				'allowedFileSize' => ['size' => \dash\utility\convert::mb_to_byte(5)],
				'totalStorage'    => ['size' => \dash\utility\convert::gb_to_byte(5)],
				// 'freeDomain'           => ['irDomain' => false, 'comDomain' => false],
				'ganje'           => true,
				'removeBrand'          => true,
				'adminOnDomain'        => false,
				'professionalReport'   => true,
				'professionalDiscount' => true,
				'sms'                  =>
					[
						'fa_cost' => 90,
						'en_cost' => 170,
					],
			];
	}

}