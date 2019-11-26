<?php
namespace content_pardakhtyar\write\step2;

class view
{
	public static function config()
	{
		$request = \lib\pardakhtyar\sample::fill();
		$data    =
		[
			[
				'trackingNumberPsp'       => $request['trackingNumberPsp'],
				'requestType'             => 5,
				'merchant'                => \lib\pardakhtyar\customer_irani::get($request['merchant']),
				'relatedMerchants'        => null,
				'contract'                => \lib\pardakhtyar\contract::get('sample'),
				'pspRequestShopAcceptors' =>
				[
					[
						'shop'      => \lib\pardakhtyar\shop::get($request['shop']),
						'acceptors' => \lib\pardakhtyar\acceptor::get($request['acceptors']),
					],
				],
				'description'             => null,
			]
		];

		\lib\pardakhtyar\start::fire($data);
	}
}
?>