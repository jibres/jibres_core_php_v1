<?php
namespace content_pardakhtyar\write\step5;

class view
{
	public static function config()
	{
		$request = \lib\pardakhtyar\sample::fill();
		$data    =
		[
			[
				'trackingNumberPsp'       => $request['trackingNumberPsp'],
				'requestType'             => 18,
				'merchant'                => \lib\pardakhtyar\customer_irani::get($request['merchant'], true),
				'relatedMerchants'        => null,
				'contract'                => \lib\pardakhtyar\contract::get('sample'),
				'pspRequestShopAcceptors' =>
				[
					[
						'shop'      => \lib\pardakhtyar\shop::get($request['shop']),
						'acceptors' => \lib\pardakhtyar\acceptor::get($request['acceptors'], false, true),
					],
				],
				'description'             => null,
			]
		];

		\lib\pardakhtyar\start::fire($data);
	}
}
?>