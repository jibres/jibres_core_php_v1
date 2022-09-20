<?php
namespace lib\app\plan\plans;


use lib\app\plan\planPrepare;

class advanced extends planPrepare
{

	public function name() : string
	{
		return 'advanced';
	}


	public function title() : string
	{
		return T_("Advanced");
	}


	public function description() : string
	{
		return T_("For someones ready to use Jibres as hero.") . ' ' . T_("<span class='bold'>Everything you need</span> for a growing business.");
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
				'freeDomain'           => ['irDomain' => true, 'comDomain' => true],
				'ganje'                => true,
				'removeBrand'          => true,
				'adminOnDomain'        => true,
				'professionalReport'   => true,
				'professionalDiscount' => true,
				'support'              => ['mode' => 'top_priority'],
				'instagram'            => true,
				'sms'                  =>
					[
						'fa_cost' => 60,
						'en_cost' => 120,
					],
			];
	}


}