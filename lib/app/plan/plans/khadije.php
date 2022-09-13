<?php
namespace lib\app\plan\plans;


use lib\app\plan\planPrepare;


class khadije extends planPrepare
{

	public function name() : string
	{
		return 'khadije';
	}


	public function title() : string
	{
		return T_("Khadije");
	}


	public function description() : string
	{
		return '';
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
		return 'khadije';
	}


	public function contain() : array
	{
		return
			[
				'permission'           => true,
				'staff'                => true,
				'allowedFileSize'      => ['size' => \dash\utility\convert::mb_to_byte(20)],
				'totalStorage'         => ['size' => \dash\utility\convert::gb_to_byte(20)],
				// 'freeDomain'           => ['irDomain' => false, 'comDomain' => false],
				'ganje'                => true,
				'sms'                  => ['cost' => 60],
				'removeBrand'          => true,
				'adminOnDomain'        => true,
				'professionalReport'   => true,
				'professionalDiscount' => true,
				'specialFormBuilder'   => true,
			];
	}


}