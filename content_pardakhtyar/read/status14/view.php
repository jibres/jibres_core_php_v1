<?php
namespace content_pardakhtyar\read\status14;

class view
{
	public static function config()
	{
		$data =
		[
			// 'requestDate' =>
			// [
			// 	// one month ago
			// 	time() - (60 * 60 * 24 * 365). '000',
			// 	// current
			// 	time() + (60 * 60 * 24 * 365). '000'
			// ],
			// 'requestTypes'       => '',
			'statuses'           => [14],
			// 'trackingNumbers'    => [\dash\request::get('num')],
			// 'trackingNumberPsps' => '',
		];

		\lib\pardakhtyar\start::fire($data, 'read');
	}
}
?>