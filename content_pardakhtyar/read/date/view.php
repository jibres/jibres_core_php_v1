<?php
namespace content_pardakhtyar\read\date;

class view
{
	public static function config()
	{
		$data =
		[
			'requestDate' =>
			[
				// one month ago
				time() - (60 * 60 * 24 * 365). '000',
				// current
				time() + (60 * 60 * 24 * 365). '000'
			],
			// 'requestTypes'       => '',
			// 'statuses'           => '',
			// 'trackingNumbers'    => ['107672914671153'],
			// 'trackingNumberPsps' => '',
		];

		\lib\pardakhtyar\start::fire($data, 'read');
	}
}
?>