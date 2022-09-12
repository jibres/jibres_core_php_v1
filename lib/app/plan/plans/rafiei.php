<?php
namespace lib\app\plan\plans;


use lib\app\plan\planPrepare;


class rafiei extends planPrepare
{

	public function name() : string
	{
		return 'rafiei';
	}


	public function title() : string
	{
		return T_("Rafiei");
	}


	public function description() : string
	{
		return '';
	}


	public function featureList()
	{
		return [];
	}


	public function priceIRT() : int
	{
		return 2000000; // IRT
	}


	public function type() : string
	{
		return 'enterprise';
	}


	public static function enterprise() : string
	{
		return 'rafiei';
	}


	public function contain() : array
	{
		return
			[
				'permission'           => ['mode' => 'simple'],
				'staff'                => ['count' => 20],
				'allowedFileSize'      => ['size' => \dash\utility\convert::mb_to_byte(20)],
				'totalStorage'         => ['size' => \dash\utility\convert::gb_to_byte(20)],
				// 'freeDomain'           => ['irDomain' => false, 'comDomain' => false],
				'ganje'                => true,
				'sms'                  => ['cost' => 60],
				'removeBrand'          => true,
				'adminOnDomain'        => true,
				'professionalReport'   => true,
				'professionalDiscount' => true,
			];
	}


}