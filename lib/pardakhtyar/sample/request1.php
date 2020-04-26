<?php
namespace lib\pardakhtyar\sample;

class request1
{
	public static function get()
	{
		$data =
		[
			'trackingNumberPsp' => 'PF00139707040000A001',
			"merchant" =>
			[
				// farsi
				'firstNameFa'     => 'جواد',
				'lastNameFa'      => 'عوض زاده',
				'fatherNameFa'    => 'خسروعلی',

				// english
				'firstNameEn'     => 'Javad',
				'lastNameEn'      => 'Adib',
				'fatherNameEn'    => 'KhosroAli',

				// extra
				'gender'          => 1,
				'birthDate'       => strtotime('1990-07-06'),
				'nationalCode'    => '2190053994',
				'telephoneNumber' => '025-36505281',
				'cellPhoneNumber' => '09357269759',
				// iban
				'merchantIbans'   =>
				[
					\lib\pardakhtyar\shaba::get('IR360700001000114904343001'),
					\lib\pardakhtyar\shaba::get('IR480700035000114904343001'),
				],

			],
			"shop" =>
			[
				'farsiName'       => 'جیبرس',
				'telephoneNumber' => '025-36505281',
				'postalCode'      => '3719617540',
				'address'         => 'خیابان هفت تیر، کوچه یکم',
				'emailAddress'    => 'info@jibres.com',
				'websiteAddress'  => 'jibres.com',
			],
			"acceptors" =>
			[
				"acceptorCode"            => "SHP_PF_00000001",
				"shaparakSettlementIbans" =>
				[
					"IR480700035000114904343001"
				],
			]
		];


		return $data;
	}
}
?>