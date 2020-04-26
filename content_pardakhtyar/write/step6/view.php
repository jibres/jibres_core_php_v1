<?php
namespace content_pardakhtyar\write\step6;

class view
{
	public static function config()
	{
		$request = \lib\pardakhtyar\sample::fill();
		$data    =
		[
			[
				'trackingNumberPsp'       => $request['trackingNumberPsp'],
				'requestType'             => 17,
				'merchant'                => \lib\pardakhtyar\customer_irani::get($request['merchant']),
				'relatedMerchants'        => null,
				'contract'                => \lib\pardakhtyar\contract::get('sample'),
				'pspRequestShopAcceptors' =>
				[
					[
						'shop'      => \lib\pardakhtyar\shop::get($request['shop']),
						'acceptors' => \lib\pardakhtyar\acceptor::get($request['acceptors'], true, true),
					],
				],
				'description'             => null,
			]
		];

		\lib\pardakhtyar\start::fire($data);
	}
}
?>