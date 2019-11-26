<?php
namespace content_pardakhtyar\write\step1;

class view
{
	public static function config()
	{
		$request = \lib\pardakhtyar\sample::fill();
		$data    =
		[
			[
				'trackingNumberPsp'       => $request['trackingNumberPsp'],
				'requestType'             => 13,
				'merchant'                => \lib\pardakhtyar\customer_irani::get($request['merchant']),
				'relatedMerchants'        => null,
				'contract'                => null,
				'pspRequestShopAcceptors' =>
				[
					[
						'shop'      => \lib\pardakhtyar\shop::get($request['shop']),
						'acceptors' => null
					],
				],
				'description'             => null,
			]
		];

		\lib\pardakhtyar\start::fire($data);
	}
}
?>