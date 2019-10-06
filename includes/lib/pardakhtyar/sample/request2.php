<?php
namespace lib\pardakhtyar\sample;

class request2
{
	public static function get()
	{
		$data =
		[
			'trackingNumberPsp' => 'PF00139707040000A002',
			"merchant" =>
			[
				// farsi
				'firstNameFa'     => 'رضا',
				'lastNameFa'      => 'محیطی',
				'fatherNameFa'    => 'احمد',

				// english
				'firstNameEn'     => 'Reza',
				'lastNameEn'      => 'Mohiti',
				'fatherNameEn'    => 'Ahmad',

				// extra
				'gender'          => 1,
				'birthDate'       => strtotime('1991-04-05'),
				'nationalCode'    => '4440032109',
				'telephoneNumber' => '025-36626496',
				'cellPhoneNumber' => '09109610612',
				// iban
				'merchantIbans'   =>
				[
					\lib\pardakhtyar\shaba::get('IR780700001000114904182001'),
					\lib\pardakhtyar\shaba::get('IR630700035000114904182002'),
				],

			],
			"shop" =>
			[
				'farsiName'       => 'رضامحیطی',
				'telephoneNumber' => '025-33367354',
				'postalCode'      => '3714816445',
				'address'         => 'خیابان شهید محلاتی روبروی اداره قند و شکر پلاک 288',
				'emailAddress'    => 'reza@ermile.com',
				'websiteAddress'  => 'rezamohiti.ir',
			],
			"acceptors" =>
			[
				"acceptorCode"            => "SHP_PF_00000002",
				"shaparakSettlementIbans" =>
				[
					"IR900700035000114904182001"
				],
			]
		];


		return $data;
	}
}
?>