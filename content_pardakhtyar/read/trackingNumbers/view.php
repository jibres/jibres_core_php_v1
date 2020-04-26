<?php
namespace content_pardakhtyar\read\trackingNumbers;

class view
{
	public static function config()
	{
		if(!\dash\request::get('num'))
		{
			\dash\code::boom('we need number to read data!');
		}

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
			// 'statuses'           => '',
			'trackingNumbers'    => [\dash\request::get('num')],
			// 'trackingNumberPsps' => '',
		];


		\lib\pardakhtyar\start::fire($data, 'read');
	}
}
?>